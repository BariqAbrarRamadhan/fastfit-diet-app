@php
    $navigation = [
        ['name' => 'Home', 'href' => '/dashboard', 'icon' => 'home'],
        ['name' => 'Petunjuk Penggunaan', 'href' => '/user-guide', 'icon' => 'help-circle'],
        ['name' => 'Informasi Diet', 'href' => '/diet-info', 'icon' => 'clipboard-list'],
        ['name' => 'Artikel', 'href' => '/articles', 'icon' => 'book-open'],
    ];
    $currentPath = request()->path();
@endphp

<header
    class="bg-gradient-to-r from-orange-50 via-pink-50 to-purple-50 border-b border-orange-200/30 sticky top-0 z-50 backdrop-blur-xl bg-white/80 shadow-lg">
    <div class="mx-auto px-6 flex items-center justify-between h-20">
        <div class="flex items-center">
            <!-- Logo Section -->
            <a href="{{ url('/dashboard') }}" class="flex items-center mr-8 group">
                <div
                    class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center mr-3 transition-transform duration-300 group-hover:scale-105 shadow-lg">
                    <img src="{{ asset('icons/favicon.ico') }}" alt="Logo" class="rounded-xl w-10 h-10" />
                </div>
                <div>
                    <span
                        class="font-bold text-2xl bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">FastFit</span>
                    <p class="text-xs text-gray-600 -mt-1">Diet & Fitness App</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex space-x-2">
                @foreach ($navigation as $item)
                    <a href="{{ url($item['href']) }}"
                        class="group relative flex items-center px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 {{ $currentPath === trim($item['href'], '/') ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-xl' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-100 hover:to-purple-100 hover:text-orange-600' }}">

                        <div
                            class="w-6 h-6 rounded-lg {{ $currentPath === trim($item['href'], '/') ? 'bg-white/20' : 'bg-orange-100 group-hover:bg-orange-200' }} flex items-center justify-center mr-3 transition-all duration-300">
                            <i data-lucide="{{ $item['icon'] }}"
                                class="w-4 h-4 {{ $currentPath === trim($item['href'], '/') ? 'text-white' : 'text-orange-500' }}"></i>
                        </div>

                        <span>{{ $item['name'] }}</span>

                        @if (isset($item['badge']) && $item['badge'])
                            <span
                                class="absolute -top-2 -right-2 flex items-center justify-center h-6 w-6 rounded-full bg-red-500 text-white text-xs font-bold shadow-lg animate-pulse">
                                {{ $item['badge'] }}
                            </span>
                        @endif

                        <!-- Active indicator -->
                        @if ($currentPath === trim($item['href'], '/'))
                            <div
                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1 w-2 h-2 bg-white rounded-full shadow-lg">
                            </div>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Search (commented out but styled for future use) -->
            <!-- 
            <div class="relative hidden xl:block">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                </div>
                <input type="text" placeholder="Cari resep dan informasi..."
                    class="block w-80 pl-12 pr-4 py-3 bg-white/80 backdrop-blur-sm border border-white/20 rounded-2xl text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition-all duration-300 shadow-lg" />
            </div>

            <button class="p-3 rounded-2xl text-gray-600 hover:text-orange-500 hover:bg-orange-50 transition-all duration-300 relative">
                <i data-lucide="bell" class="w-6 h-6"></i>
                <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full flex items-center justify-center">
                    <span class="w-1.5 h-1.5 bg-white rounded-full"></span>
                </span>
            </button>
            -->

            <!-- User Profile -->
            <a href="{{ url('/profile') }}" class="flex items-center group">
                <div
                    class="w-12 h-12 rounded-2xl bg-gradient-to-r from-purple-400 to-pink-500 flex items-center justify-center transition-transform duration-300 group-hover:scale-105 shadow-lg">
                    <img src="{{ asset('images/placeholder.svg') }}" alt="User avatar"
                        class="rounded-xl w-10 h-10 object-cover" />
                </div>
                <div class="hidden md:block ml-3">
                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-gray-600">{{ Auth::user()->email ?? 'user@fastfit.com' }}</p>
                </div>
            </a>
        </div> <!-- Mobile Menu Toggle -->
        <button id="mobile-menu-toggle"
            class="lg:hidden p-3 rounded-2xl text-gray-600 hover:text-orange-500 hover:bg-orange-50 transition-all duration-300 relative z-10 cursor-pointer"
            type="button">
            <i id="mobile-menu-icon" data-lucide="menu" class="w-6 h-6 pointer-events-none"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white/95 backdrop-blur-xl border-t border-orange-200/30 shadow-xl">
        <div class="mx-auto px-6 py-6">
            <div class="space-y-3">
                @foreach ($navigation as $item)
                    <a href="{{ url($item['href']) }}"
                        class="flex items-center px-4 py-4 rounded-2xl text-sm font-medium transition-all duration-300 {{ $currentPath === trim($item['href'], '/') ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-orange-100 hover:to-purple-100 hover:text-orange-600' }}">

                        <div
                            class="w-10 h-10 rounded-xl {{ $currentPath === trim($item['href'], '/') ? 'bg-white/20' : 'bg-orange-100' }} flex items-center justify-center mr-4">
                            <i data-lucide="{{ $item['icon'] }}"
                                class="w-5 h-5 {{ $currentPath === trim($item['href'], '/') ? 'text-white' : 'text-orange-500' }}"></i>
                        </div>

                        <span class="flex-1">{{ $item['name'] }}</span>

                        @if (isset($item['badge']) && $item['badge'])
                            <span
                                class="flex items-center justify-center h-6 w-6 rounded-full bg-red-500 text-white text-xs font-bold">
                                {{ $item['badge'] }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </div>

            <!-- Mobile User Info -->
            <div class="mt-6 pt-6 border-t border-orange-200/30">
                <a href="{{ url('/profile') }}"
                    class="flex items-center px-4 py-4 rounded-2xl bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200/50 hover:from-purple-100 hover:to-pink-100 transition-all duration-300">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-r from-purple-400 to-pink-500 flex items-center justify-center mr-4">
                        <img src="{{ asset('images/placeholder.svg') }}" alt="User avatar"
                            class="rounded-xl w-10 h-10 object-cover" />
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-600">Lihat & Edit Profil</p>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<style>
    /* Ensure mobile menu toggle is clickable */
    #mobile-menu-toggle {
        touch-action: manipulation;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }

    #mobile-menu-toggle:active {
        transform: scale(0.95);
    }

    /* Smooth menu animation */
    #mobile-menu {
        transition: all 0.3s ease-in-out;
    }

    @media (max-width: 1023px) {
        #mobile-menu-toggle {
            display: flex !important;
        }
    }
</style>

<script>
    // Mobile Menu Toggle Functionality
    document.addEventListener('DOMContentLoaded', function () {
        console.log('DOM loaded, initializing mobile menu...'); // Debug log

        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('mobile-menu-icon');

        console.log('Elements found:', {
            toggle: !!mobileMenuToggle,
            menu: !!mobileMenu,
            icon: !!menuIcon
        }); // Debug log

        if (mobileMenuToggle && mobileMenu && menuIcon) {
            mobileMenuToggle.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                console.log('Mobile menu toggle clicked'); // Debug log

                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuIcon.setAttribute('data-lucide', 'x');
                    console.log('Menu opened'); // Debug log
                } else {
                    mobileMenu.classList.add('hidden');
                    menuIcon.setAttribute('data-lucide', 'menu');
                    console.log('Menu closed'); // Debug log
                }

                // Reinitialize Lucide icons for the changed icon
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                } else {
                    console.warn('Lucide not available'); // Debug log
                }
            });

            // Close mobile menu when clicking on menu items
            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function () {
                    mobileMenu.classList.add('hidden');
                    menuIcon.setAttribute('data-lucide', 'menu');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function (event) {
                if (!mobileMenuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        menuIcon.setAttribute('data-lucide', 'menu');
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    }
                }
            });
        } else {
            console.error('Mobile menu elements not found!'); // Debug log
        }        // Initialize Lucide icons
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons();
            console.log('Lucide icons initialized'); // Debug log
        } else {
            console.warn('Lucide library not loaded'); // Debug log
        }
    });
</script>