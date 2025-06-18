@php
    $currentRoute = Route::currentRouteName();
    $currentPath = request()->path();    // Helper function to check if menu is active
    function isMenuActive($route, $currentRoute, $currentPath)
    {
        // Exact route match
        if ($currentRoute === $route) {
            return true;
        }

        // Path-based matching for articles
        if (str_contains($route, 'articles') && str_contains($currentPath, 'admin/articles')) {
            return true;
        }

        // Path-based matching for users
        if (str_contains($route, 'users') && str_contains($currentPath, 'admin/users')) {
            return true;
        }        // Path-based matching for food recommendations
        if (str_contains($route, 'food-recommendations') && str_contains($currentPath, 'admin/food-recommendations')) {
            return true;
        }

        // Path-based matching for exercise recommendations
        if (str_contains($route, 'exercise-recommendations') && str_contains($currentPath, 'admin/exercise-recommendations')) {
            return true;
        }

        // Path-based matching for reports
        if (str_contains($route, 'reports') && str_contains($currentPath, 'admin/reports')) {
            return true;
        }

        // Path-based matching for settings
        if (str_contains($route, 'settings') && str_contains($currentPath, 'admin/settings')) {
            return true;
        }

        return false;
    }
    $menuItems = [
        [
            'title' => 'Dashboard',
            'icon' => 'bar-chart-3',
            'route' => 'admin.dashboard',
            'badge' => null,
        ],
        [
            'title' => 'Pengguna',
            'icon' => 'users',
            'route' => 'admin.users.index',
            'badge' => null,
        ],
        [
            'title' => 'Artikel',
            'icon' => 'file-text',
            'route' => 'admin.articles.index',
            'badge' => null,
        ],
        [
            'title' => 'Rekomendasi Makanan',
            'icon' => 'utensils',
            'route' => 'admin.food-recommendations.index',
            'badge' => null,
        ],
        [
            'title' => 'Rekomendasi Olahraga',
            'icon' => 'dumbbell',
            'route' => 'admin.exercise-recommendations.index',
            'badge' => null,
        ],
    ];
@endphp

<div x-data="{
    isCollapsed: false,
    isMobileMenuOpen: false,
    openSubmenu: null,
    toggleSubmenu(title) {
        this.openSubmenu = this.openSubmenu === title ? null : title;
    }
}" class="flex flex-col"> <!-- Mobile Menu Toggle -->
    <div
        class="lg:hidden fixed top-0 left-0 right-0 z-30 bg-gradient-to-r from-orange-400 via-pink-500 to-purple-600 shadow-xl">
        <div class="flex items-center justify-between px-4 py-3">
            <div class="flex items-center">
                <button x-on:click="isMobileMenuOpen = !isMobileMenuOpen"
                    class="p-2 rounded-xl text-white hover:bg-white/20 backdrop-blur-sm transition-all duration-300">
                    <i x-show="!isMobileMenuOpen" data-lucide="menu" class="w-6 h-6"></i>
                    <i x-show="isMobileMenuOpen" data-lucide="x" class="w-6 h-6"></i>
                </button>
                <div class="ml-3 flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center mr-3">
                        <img src="{{ asset('icons/favicon.ico') }}" alt="Logo" class="rounded-lg w-8 h-8" />
                    </div>
                    <div>
                        <span class="font-bold text-white text-lg">FastFit</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <img src="{{ asset('images/placeholder.svg') }}" alt="Admin avatar"
                        class="rounded-lg w-8 h-8 object-cover" />
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <!-- <div x-show="isMobileMenuOpen" x-on:click="isMobileMenuOpen = false"
        class="fixed inset-0 z-20 bg-black bg-opacity-50 transition-opacity lg:hidden"
        x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div> -->
    <!-- Mobile Sidebar -->
    <div x-show="isMobileMenuOpen"
        class="fixed top-0 left-0 z-30 h-full w-72 bg-white/90 backdrop-blur-xl shadow-2xl border-r border-white/20 transform transition-transform lg:hidden"
        x-transition:enter="transition-transform ease-out duration-300" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transition-transform ease-in duration-200"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
        <!-- Mobile Header -->
        <div class="p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center mr-3">
                        <img src="{{ asset('icons/favicon.ico') }}" alt="Logo" class="rounded-lg w-10 h-10" />
                    </div>
                    <div>
                        <span class="font-bold text-dark text-xl">FastFit</span>
                        <p class="text-dark/90 text-sm">Admin Dashboard</p>
                    </div>
                </div>
                <button x-on:click="isMobileMenuOpen = false"
                    class="p-2 rounded-xl text-dark hover:bg-dark/20 backdrop-blur-sm transition-all duration-300">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
        </div>

        <div class="flex flex-col h-full">
            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto px-4 pb-4">
                <div class="space-y-2"> @foreach ($menuItems as $item)
                    @php
                        $isActive = isMenuActive($item['route'], $currentRoute, $currentPath);
                    @endphp
                    <div>
                        @if (isset($item['submenu']))
                            <button x-on:click="toggleSubmenu('{{ $item['title'] }}')"
                                class="flex items-center justify-between w-full px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600' }}">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-white/20' : 'bg-orange-100' }} flex items-center justify-center mr-3">
                                        <i data-lucide="{{ $item['icon'] }}"
                                            class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-orange-500' }}"></i>
                                    </div>
                                    <span class="font-medium">{{ $item['title'] }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    @if (isset($item['badge']) && $item['badge'])
                                        <span
                                            class="px-2 py-1 text-xs font-bold bg-red-500 text-white rounded-full">{{ $item['badge'] }}</span>
                                    @endif
                                    <i x-show="openSubmenu !== '{{ $item['title'] }}'" data-lucide="chevron-right"
                                        class="w-4 h-4 transition-transform duration-300"></i>
                                    <i x-show="openSubmenu === '{{ $item['title'] }}'" data-lucide="chevron-down"
                                        class="w-4 h-4 transition-transform duration-300"></i>
                                </div>
                            </button>
                            <div x-show="openSubmenu === '{{ $item['title'] }}'"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="mt-2 ml-6 space-y-1">
                                @foreach ($item['submenu'] as $subitem)
                                    <a href="{{ route($subitem['route']) }}"
                                        class="block px-4 py-2 text-sm rounded-lg {{ request()->is(trim(str_replace(route('admin.dashboard'), '', route($subitem['route'])), '/') . '*') ? 'bg-gradient-to-r from-orange-100 to-purple-100 text-orange-600 font-medium' : 'text-gray-600 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-500' }} transition-all duration-300"
                                        x-on:click="isMobileMenuOpen = false">
                                        {{ $subitem['title'] }}
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <a href="{{ route($item['route']) }}"
                                class="flex items-center justify-between px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600' }}"
                                x-on:click="isMobileMenuOpen = false">
                                <div class="flex items-center">
                                    <div
                                        class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-white/20' : 'bg-orange-100' }} flex items-center justify-center mr-3">
                                        <i data-lucide="{{ $item['icon'] }}"
                                            class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-orange-500' }}"></i>
                                    </div>
                                    <span class="font-medium">{{ $item['title'] }}</span>
                                </div>
                                @if (isset($item['badge']) && $item['badge'])
                                    <span
                                        class="px-2 py-1 text-xs font-bold bg-red-500 text-white rounded-full">{{ $item['badge'] }}</span>
                                @endif
                            </a>
                        @endif
                    </div>
                @endforeach
                    <!-- Logout Section -->
                    <div
                        class="                                        p-4 border-t border-white/20 bg-gradient-to-b from-transparent to-white/50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full px-4 py-3 text-sm text-red-600 rounded-xl bg-red-200 hover:bg-red-100 hover:text-red-700 transition-all duration-300 font-medium">
                                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mr-3">
                                    <i data-lucide="log-out" class="w-5 h-5 text-red-500"></i>
                                </div>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <!-- Desktop Sidebar -->
    <aside x-bind:class="isCollapsed ? 'w-20' : 'w-72'"
        class="hidden lg:block bg-white backdrop-blur-xl border-r border-white/20 transition-all duration-300">
        <div class="flex flex-col h-full bg-zinc-100">
            <!-- Desktop Header -->
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center mr-3">
                            <img src="{{ asset('icons/favicon.ico') }}" alt="Logo" class="rounded-lg w-10 h-10" />
                        </div>
                        <div x-show="!isCollapsed">
                            <span class="font-bold text-dark text-xl">FastFit</span>
                            <p class="text-dark/90 text-sm">Admin Dashboard</p>
                        </div>
                    </div>
                    <button x-on:click="isCollapsed = !isCollapsed"
                        class="p-2 rounded-xl text-dark hover:bg-dark/20 backdrop-blur-sm transition-all duration-300"
                        title="Toggle Sidebar">
                        <i x-show="!isCollapsed" data-lucide="chevron-left" class="w-5 h-5"></i>
                        <i x-show="isCollapsed" data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto px-4 pb-4">
                <ul class="space-y-2"> @foreach ($menuItems as $item)
                    @php
                        $isActive = isMenuActive($item['route'], $currentRoute, $currentPath);
                    @endphp
                    <li>
                        @if (isset($item['submenu'])) <button x-on:click="toggleSubmenu('{{ $item['title'] }}')"
                                class="flex items-center justify-between w-full px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600' }}"
                                title="{{ $item['title'] }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-white/20' : 'bg-orange-100' }} flex items-center justify-center"
                                        x-bind:class="isCollapsed ? '' : 'mr-3'">
                                        <i data-lucide="{{ $item['icon'] }}"
                                            class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-orange-500' }}"></i>
                                    </div>
                                    <span x-show="!isCollapsed" class="font-medium">{{ $item['title'] }}</span>
                                </div>
                                <div x-show="!isCollapsed" class="flex items-center space-x-2">
                                    @if (isset($item['badge']) && $item['badge'])
                                        <span
                                            class="px-2 py-1 text-xs font-bold bg-red-500 text-white rounded-full">{{ $item['badge'] }}</span>
                                    @endif
                                    <i x-show="openSubmenu !== '{{ $item['title'] }}'" data-lucide="chevron-right"
                                        class="w-4 h-4 transition-transform duration-300"></i>
                                    <i x-show="openSubmenu === '{{ $item['title'] }}'" data-lucide="chevron-down"
                                        class="w-4 h-4 transition-transform duration-300"></i>
                                </div>
                            </button>
                            <div x-show="!isCollapsed && openSubmenu === '{{ $item['title'] }}'"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="mt-2 ml-6 space-y-1"> @foreach ($item['submenu'] as $subitem)
                                    <a href="{{ route($subitem['route']) }}"
                                        class="block px-4 py-2 text-sm rounded-lg {{ $currentRoute === $subitem['route'] ? 'bg-gradient-to-r from-orange-100 to-purple-100 text-orange-600 font-medium' : 'text-gray-600 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-500' }} transition-all duration-300">
                                        {{ $subitem['title'] }}
                                    </a>
                                @endforeach
                        </div> @else <a href="{{ route($item['route']) }}"
                                class="flex items-center justify-between px-4 py-3 text-sm rounded-xl transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600' }}"
                                title="{{ $item['title'] }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg {{ $isActive ? 'bg-white/20' : 'bg-orange-100' }} flex items-center justify-center"
                                        x-bind:class="isCollapsed ? '' : 'mr-3'">
                                        <i data-lucide="{{ $item['icon'] }}"
                                            class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-orange-500' }}"></i>
                                    </div>
                                    <span x-show="!isCollapsed" class="font-medium">{{ $item['title'] }}</span>
                                </div> @if (isset($item['badge']) && $item['badge'])
                                    <span x-show="!isCollapsed"
                                        class="px-2 py-1 text-xs font-bold bg-red-500 text-white rounded-full">{{ $item['badge'] }}</span>
                                @endif
                            </a>
                        @endif
                    </li>
                @endforeach
                </ul>
            </nav>

            <!-- User Profile Section -->
            <div x-show="!isCollapsed" class="p-4 border-t border-white/20">
                <div class="bg-gradient-to-r from-orange-50 to-purple-50 rounded-xl p-4 border border-orange-200/50">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-400 to-purple-500 flex items-center justify-center">
                            <img src="{{ asset('images/placeholder.svg') }}" alt="Admin avatar"
                                class="rounded-lg w-10 h-10 object-cover" />
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900 text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-gray-600 text-xs">{{ Auth::user()->email ?? 'admin@fastfit.com' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Section -->
            <div class="p-4 border-t border-white/20 bg-gradient-to-b from-transparent to-white/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 text-sm text-red-600 rounded-xl bg-red-200 hover:bg-red-100 hover:text-red-700 transition-all duration-300 font-medium"
                        x-bind:class="isCollapsed ? 'justify-center' : ''" title="Keluar">
                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center"
                            x-bind:class="isCollapsed ? '' : 'mr-3'">
                            <i data-lucide="log-out" class="w-5 h-5 text-red-500"></i>
                        </div>
                        <span x-show="!isCollapsed">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>
</div>