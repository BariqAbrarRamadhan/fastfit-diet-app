@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 relative overflow-hidden">
        <!-- Enhanced Decorative Background Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-orange-200/10 to-purple-200/10 rounded-full -translate-x-48 -translate-y-48">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-tl from-purple-200/10 to-orange-200/10 rounded-full translate-x-48 translate-y-48">
        </div>

        <div class="relative z-10 p-6 pt-16 lg:pt-6">
            <!-- Enhanced Header -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                            Admin Dashboard
                        </h1>
                        <p class="text-gray-600 text-lg">Selamat datang kembali, <span
                                class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</span></p>
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                        </div>
                    </div>
                    <!-- <div class="flex items-center mt-6 md:mt-0 space-x-4">
                            <div class="hidden md:flex items-center space-x-3">
                                <div class="relative">
                                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                                    <input
                                        type="text"
                                        placeholder="Cari data..."
                                        class="pl-10 pr-4 py-3 text-sm bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                                    />
                                </div>
                                <button class="p-3 text-gray-600 bg-white/70 rounded-xl border border-gray-200 hover:bg-white hover:shadow-lg transition-all duration-300">
                                    <i data-lucide="bell" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <div class="relative">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-400 to-purple-500 p-0.5">
                                    <div class="w-full h-full rounded-xl bg-white flex items-center justify-center">
                                        <img
                                            src="{{ auth()->user()->image ?? asset('images/placeholder.svg') }}"
                                            alt="Admin avatar"
                                            class="rounded-xl w-10 h-10 object-cover"
                                        />
                                    </div>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                            </div>
                        </div> -->
                </div>
            </div>
            <!-- Enhanced Tab Navigation -->
            <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden mb-8">
                    <div class="flex border-b border-gray-200/50">
                        @foreach (['overview' => ['label' => 'Overview', 'icon' => 'layout-dashboard'], 'analytics' => ['label' => 'Analytics', 'icon' => 'bar-chart-3'], 'reports' => ['label' => 'Reports', 'icon' => 'file-text']] as $tab => $data)
                            <a
                                href="{{ route('admin.dashboard', ['tab' => $tab]) }}"
                                class="flex-1 px-6 py-4 font-semibold text-center transition-all duration-300 {{ ($activeTab ?? 'overview') === $tab ? 'text-orange-500 bg-gradient-to-r from-orange-50/50 to-orange-100/50 border-b-3 border-orange-500 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50/50' }}"
                            >
                                <div class="flex items-center justify-center">
                                    <i data-lucide="{{ $data['icon'] }}" class="w-5 h-5 mr-2"></i>
                                    {{ $data['label'] }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div> -->
            <!-- Enhanced Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($stats as $index => $stat)
                    @php
                        $gradients = [
                            'from-blue-400 to-blue-500',
                            'from-green-400 to-green-500',
                            'from-orange-400 to-orange-500',
                            'from-purple-400 to-purple-500'
                        ];
                        $bgGradients = [
                            'from-blue-50/50 to-blue-100/30',
                            'from-green-50/50 to-green-100/30',
                            'from-orange-50/50 to-orange-100/30',
                            'from-purple-50/50 to-purple-100/30'
                        ];
                        $borderColors = [
                            'border-blue-200/30',
                            'border-green-200/30',
                            'border-orange-200/30',
                            'border-purple-200/30'
                        ];
                    @endphp
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 transform hover:scale-105 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-6">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-r {{ $gradients[$index % 4] }} flex items-center justify-center shadow-lg">
                                <i data-lucide="{{ $stat['icon'] }}" class="w-7 h-7 text-white"></i>
                            </div>
                            <!-- <div class="flex items-center bg-gradient-to-r {{ $bgGradients[$index % 4] }} rounded-xl px-3 py-2 border {{ $borderColors[$index % 4] }}">
                                        <span class="text-xs font-bold {{ $stat['isPositive'] ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $stat['change'] }}
                                        </span>
                                        <i data-lucide="{{ $stat['isPositive'] ? 'trending-up' : 'trending-down' }}" class="w-4 h-4 ml-1 {{ $stat['isPositive'] ? 'text-green-600' : 'text-red-600' }}"></i>
                                    </div> -->
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">{{ $stat['title'] }}</h3>
                            <p class="text-3xl font-bold text-gray-900 group-hover:text-dark group-hover:{{ $gradients[$index % 4] }} group-hover:bg-clip-text transition-all duration-300">
                                {{ $stat['value'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Enhanced Activity Charts and Recent Activities Section -->
            <!-- <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8"> -->
            <!-- Activity Chart -->
            <!-- <div class="lg:col-span-2 bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-1">
                                        Aktivitas Pengguna
                                    </h2>
                                    <p class="text-gray-600 text-sm">Grafik aktivitas pengguna dalam periode tertentu</p>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button class="p-2 text-gray-500 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-300">
                                        <i data-lucide="filter" class="w-5 h-5"></i>
                                    </button>
                                    <select class="px-3 py-2 text-sm bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">
                                        <option>7 hari terakhir</option>
                                        <option>30 hari terakhir</option>
                                        <option>90 hari terakhir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="h-64 bg-gradient-to-br from-orange-50/30 to-purple-50/30 rounded-2xl border-2 border-dashed border-gray-200 flex items-center justify-center group hover:border-orange-300 transition-all duration-300">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:shadow-lg transition-all duration-300">
                                        <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Grafik Aktivitas</h3>
                                    <p class="text-gray-500 text-sm">Grafik interaktif akan ditampilkan di sini</p>
                                    <button class="mt-4 px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-semibold">
                                        Lihat Detail Grafik
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> -->

            <!-- Recent Activities -->
            <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                        <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-1">
                                        Aktivitas Terbaru
                                    </h2>
                                    <p class="text-gray-600 text-sm">Log aktivitas pengguna terkini</p>
                                </div>
                                <button class="p-2 text-gray-500 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-300">
                                    <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4 space-y-4 max-h-80 overflow-y-auto">
                            @foreach ($recentActivities as $activity)
                                <div class="flex items-start p-3 hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-purple-50/30 rounded-xl transition-all duration-300 group">
                                    <div class="flex-shrink-0 w-10 h-10 relative mr-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-orange-400 to-purple-500 p-0.5">
                                            <img
                                                src="{{ $activity['avatar'] }}"
                                                alt="{{ $activity['user'] }}"
                                                class="rounded-xl w-full h-full object-cover"
                                            />
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-800 group-hover:text-gray-900">
                                            <span class="font-bold group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-orange-500 group-hover:to-purple-600 group-hover:bg-clip-text transition-all duration-300">{{ $activity['user'] }}</span> 
                                            {{ $activity['action'] }}
                                        </p>
                                        <div class="flex items-center mt-1 text-xs text-gray-500">
                                            <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                            {{ $activity['time'] }}
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ml-2">
                                        <div class="w-2 h-2 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="bg-gradient-to-r from-gray-50/50 to-gray-100/30 p-4 border-t border-gray-200/30 text-center">
                            <a href="{{ url('/admin/activities') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-semibold shadow-lg hover:shadow-xl">
                                <i data-lucide="activity" class="w-4 h-4 mr-2"></i>
                                Lihat Semua Aktivitas
                                <i data-lucide="arrow-right" class="w-3 h-3 ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div> -->

            <!-- Enhanced Users Table Section --><!-- Enhanced Users Table Section -->
            <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Pengguna Terbaru
                                </h2>
                                <p class="text-gray-600 text-sm">Kelola dan pantau aktivitas pengguna terbaru</p>
                            </div>
                            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                                <div class="relative">
                                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                                    <input
                                        type="text"
                                        placeholder="Cari pengguna..."
                                        class="pl-10 pr-4 py-3 text-sm bg-white/70 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                                    />
                                </div>
                                <button class="p-3 text-gray-600 bg-white/70 rounded-xl border border-gray-200 hover:bg-white hover:shadow-lg transition-all duration-300">
                                    <i data-lucide="filter" class="w-5 h-5"></i>
                                </button>
                                <button class="px-4 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <div class="flex items-center">
                                        <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                                        <span class="text-sm font-semibold">Tambah User</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50/80 to-gray-100/50 border-b border-gray-200/30">
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                            Pengguna
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                            Email
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                            Tanggal Bergabung
                                        </div>
                                    </th>                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                                            Role
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">
                                        <div class="flex items-center justify-end">
                                            <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                                            Aksi
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white/50 divide-y divide-gray-200/30">
                                @foreach ($recentUsers as $user)
                                    <tr class="group hover:bg-gradient-to-r hover:from-orange-50/30 hover:to-purple-50/30 transition-all duration-300">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-12 w-12 relative">
                                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-400 to-purple-500 p-0.5">
                                                        <img
                                                            src="{{ $user['image'] ?? asset('images/placeholder.svg') }}"
                                                            alt="{{ $user['name'] }}"
                                                            class="rounded-xl w-full h-full object-cover"
                                                        />
                                                    </div>
                                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white shadow-lg"></div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-gray-900 group-hover:text-transparent group-hover:bg-gradient-to-r group-hover:from-orange-500 group-hover:to-purple-600 group-hover:bg-clip-text transition-all duration-300">
                                                        {{ $user['name'] }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">ID: #{{ $user['id'] ?? '001' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm text-gray-700 font-medium">{{ $user['email'] }}</div>
                                                <div class="ml-2 px-2 py-1 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 text-xs rounded-full border border-blue-200/50">
                                                    Verified
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-600 font-medium">{{ $user['created_at'] }}</div>
                                            <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($user['created_at'])->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="inline-flex items-center px-3 py-2 rounded-xl text-xs font-bold bg-gradient-to-r from-indigo-50 to-indigo-100 text-indigo-600 border border-indigo-200/50">
                                                <i data-lucide="crown" class="w-3 h-3 mr-1"></i>                                        {{ ucfirst($user['role']) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex items-center justify-end space-x-2">
                                                <button class="p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-300 group">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                </button>
                                                <button class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-all duration-300 group">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </button>
                                                <button class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all duration-300 group">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50/50 to-gray-100/30 p-6 border-t border-gray-200/50">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center text-sm text-gray-600 mb-4 md:mb-0">
                                <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                                Menampilkan {{ count($recentUsers) }} dari {{ $totalUsers ?? 100 }} pengguna
                            </div>
                            <div class="flex items-center space-x-3">
                                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-white/70 rounded-lg border border-gray-200 hover:bg-white hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center">
                                        <i data-lucide="chevron-left" class="w-4 h-4 mr-1"></i>
                                        Sebelumnya
                                    </div>
                                </button>
                                <div class="flex items-center space-x-1">
                                    <button class="w-8 h-8 text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg">1</button>
                                    <button class="w-8 h-8 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">2</button>
                                    <button class="w-8 h-8 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">3</button>
                                    <span class="text-gray-400">...</span>
                                    <button class="w-8 h-8 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">10</button>
                                </div>
                                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-white/70 rounded-lg border border-gray-200 hover:bg-white hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center">
                                        Selanjutnya
                                        <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-orange-50/30 to-purple-50/30 p-4 text-center border-t border-gray-200/30">
                        <a href="{{ url('/admin/users') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl font-semibold">
                            <i data-lucide="users" class="w-5 h-5 mr-2"></i>
                            Lihat Semua Pengguna
                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                        </a>
                    </div>
                </div> -->
        </div>
    </div>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Enhanced dashboard interactivity
        document.addEventListener('DOMContentLoaded', function () {
            // Search functionality for users table
            const searchInput = document.querySelector('input[placeholder="Cari pengguna..."]');
            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const tableRows = document.querySelectorAll('tbody tr');

                    tableRows.forEach(row => {
                        const userName = row.querySelector('td:first-child').textContent.toLowerCase();
                        const userEmail = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                        if (userName.includes(searchTerm) || userEmail.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Add subtle animations for stat cards
            const statCards = document.querySelectorAll('.group');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Auto-refresh indicators for activity status
            setInterval(() => {
                const statusIndicators = document.querySelectorAll('.animate-pulse');
                statusIndicators.forEach(indicator => {
                    indicator.style.opacity = indicator.style.opacity === '0.5' ? '1' : '0.5';
                });
            }, 2000);
        });
    </script>
@endsection