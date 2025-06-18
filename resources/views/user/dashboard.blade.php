@extends('user.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen">
        <!-- Header Section with Greeting -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-8">
            <div class="flex justify-between lg:flex-row lg:items-center lg:space-y-0">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div
                        class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <i data-lucide="user" class="w-6 h-6 sm:w-8 sm:h-8 text-white"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h1
                            class="text-xl sm:text-2xl lg:text-3xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
                            Hello, {{ $userData['name'] }}!
                        </h1>
                        <div class="relative mt-3 mb-2">
                            <div class="flex items-start space-x-2">
                                <div class="flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-orange-400 opacity-60" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z" />
                                    </svg>
                                </div>
                                <blockquote class="flex-1">
                                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed font-medium italic bg-gradient-to-r from-gray-600 to-gray-800 bg-clip-text">
                                        "{{ $quote }}"
                                    </p>
                                </blockquote>
                            </div>
                            <div
                                class="absolute -left-1 top-0 w-0.5 h-full bg-gradient-to-b from-orange-400 to-purple-500 opacity-30 rounded-full">
                            </div>
                        </div>
                        <div class="flex items-center mt-2 text-xs sm:text-sm text-gray-500">
                            <i data-lucide="calendar" class="w-3 h-3 sm:w-4 sm:h-4 mr-1"></i>
                            <span class="hidden sm:inline">{{ now()->format('l, d F Y') }}</span>
                            <span class="sm:hidden">{{ now()->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center lg:justify-end">
                    @php
                        $bmiCategory = '';
                        $categoryColor = 'bg-blue-100 text-blue-800';
                        $cardBgColor = 'bg-gradient-to-br from-blue-50 to-indigo-100';
                        $cardBorderColor = 'border-blue-200';
                        $labelColor = 'text-blue-600';
                        $valueColor = 'text-blue-900';

                        if ($userData['bmi'] < 18.5) {
                            $bmiCategory = 'Kurang';
                            $categoryColor = 'bg-cyan-100 text-cyan-800';
                            $cardBgColor = 'bg-gradient-to-br from-cyan-50 to-blue-100';
                            $cardBorderColor = 'border-cyan-200';
                            $labelColor = 'text-cyan-600';
                            $valueColor = 'text-cyan-900';
                        } elseif ($userData['bmi'] < 24.9) {
                            $bmiCategory = 'Normal';
                            $categoryColor = 'bg-green-100 text-green-800';
                            $cardBgColor = 'bg-gradient-to-br from-green-50 to-emerald-100';
                            $cardBorderColor = 'border-green-200';
                            $labelColor = 'text-green-600';
                            $valueColor = 'text-green-900';
                        } elseif ($userData['bmi'] < 29.9) {
                            $bmiCategory = 'Berat Berlebih';
                            $categoryColor = 'bg-orange-100 text-orange-800';
                            $cardBgColor = 'bg-gradient-to-br from-orange-50 to-amber-100';
                            $cardBorderColor = 'border-orange-200';
                            $labelColor = 'text-orange-600';
                            $valueColor = 'text-orange-900';
                        } else {
                            $bmiCategory = 'Obesitas';
                            $categoryColor = 'bg-red-100 text-red-800';
                            $cardBgColor = 'bg-gradient-to-br from-red-50 to-pink-100';
                            $cardBorderColor = 'border-red-200';
                            $labelColor = 'text-red-600';
                            $valueColor = 'text-red-900';
                        }
                    @endphp
                    <div
                        class="{{ $cardBgColor }} backdrop-blur-sm rounded-lg p-3 text-center border {{ $cardBorderColor }} shadow-lg min-w-[100px] hover:shadow-xl transition-shadow duration-300">
                        <div class="text-xs {{ $labelColor }} mb-1 font-medium">BMI</div>
                        <div class="text-base sm:text-lg font-bold {{ $valueColor }}">
                            {{ number_format($userData['bmi'], 1) }}
                        </div>
                        <div class="inline-block px-2 py-0.5 rounded-full {{ $categoryColor }} text-xs font-medium mt-1">
                            {{ $bmiCategory }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center shadow-sm">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                </div>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-center shadow-sm">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                </div>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Check-in Harian, Rekomendasi Makanan, Pelacakan Air Minum, Profil Kesehatan -->
            <div class="space-y-6">
                <!-- Enhanced Daily Check-in Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center space-x-2">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                                <h2 class="font-bold text-lg">Check-in Harian</h2>
                            </div>
                            <span class="text-xs bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                {{ now()->format('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Weight Input Section -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i data-lucide="scale" class="w-5 h-5 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">Berat Badan Hari Ini</p>
                                    <p class="text-sm text-gray-600">Catat perkembangan Anda</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('dashboard.saveWeight') }}" class="space-y-4">
                                @csrf
                                <div class="flex items-center space-x-3">
                                    <div class="flex-1 relative"> <input type="number" step="0.1" name="weight"
                                            placeholder="0.0" value="{{ number_format($userData['weight']['current'], 1) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-center text-lg font-semibold">
                                        <span
                                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">kg</span>
                                    </div>
                                    <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-200 shadow-md hover:shadow-lg">
                                        <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                                        Simpan
                                    </button>
                                </div>
                            </form>

                            @if ($userData['weight']['yesterday'])
                                <div class="mt-4 p-3 bg-white/50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                            <span>Kemarin: {{ number_format($userData['weight']['yesterday'], 1) }} kg</span>
                                        </div>
                                        @if ($userData['weight']['change'] != 0)
                                            <div
                                                class="flex items-center {{ $userData['weight']['change'] < 0 ? 'text-green-600' : 'text-orange-600' }}">
                                                <i data-lucide="{{ $userData['weight']['change'] < 0 ? 'trending-down' : 'trending-up' }}"
                                                    class="w-4 h-4 mr-1"></i>
                                                <span class="font-semibold">
                                                    {{ $userData['weight']['change'] > 0 ? '+' : '' }}{{ number_format($userData['weight']['change'], 1) }}
                                                    kg
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tips Section -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 border border-blue-100">
                            <div class="flex items-center mb-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                    <i data-lucide="lightbulb" class="w-4 h-4 text-blue-600"></i>
                                </div>
                                <p class="font-semibold text-gray-800">Tips Check-in Harian</p>
                            </div>
                            <ul class="space-y-2">
                                <li class="flex items-start text-sm text-gray-700">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span>Timbang berat badan di pagi hari setelah bangun tidur</span>
                                </li>
                                <li class="flex items-start text-sm text-gray-700">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span>Gunakan timbangan yang sama setiap hari</span>
                                </li>
                                <li class="flex items-start text-sm text-gray-700">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span>Konsistensi adalah kunci keberhasilan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Water Tracking -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 p-4">
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center">
                                <i data-lucide="droplets" class="w-6 h-6 mr-2"></i>
                                <h2 class="font-bold text-lg">Pelacakan Air Minum</h2>
                            </div>
                            <span class="text-xs bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                {{ now()->format('d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Water Progress Circle -->
                        <div class="flex justify-center">
                            <div class="relative w-32 h-32 water-progress-container">
                                <!-- Background Circle -->
                                <svg class="w-32 h-32 transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-blue-100" stroke="currentColor" stroke-width="3" fill="none" d="M18 2.0845
                                                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <!-- Progress Circle -->
                                    <path id="water-progress-circle"
                                        class="text-blue-500 transition-all duration-1000 ease-out" stroke="currentColor"
                                        stroke-width="3" fill="none"
                                        stroke-dasharray="{{ $userData['waterIntake']['goal'] > 0 ? ((int) $userData['waterIntake']['current'] / (int) $userData['waterIntake']['goal']) * 100 : 0 }}, 100"
                                        d="M18 2.0845
                                                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                                                a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <!-- Center Text -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <p class="text-lg font-bold text-gray-800">
                                            {{ $userData['waterIntake']['current'] }}ml
                                        </p>
                                        <p class="text-xs text-gray-500">dari {{ $userData['waterIntake']['goal'] }}ml</p>
                                        <p class="text-xs text-blue-500 font-medium">
                                            {{ $userData['waterIntake']['goal'] > 0 ? round(((int) $userData['waterIntake']['current'] / (int) $userData['waterIntake']['goal']) * 100) : 0 }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Add Buttons -->
                        <div class="grid grid-cols-4 gap-2">
                            @foreach([250, 330, 500, 750] as $volume)
                                <form method="POST" action="{{ route('dashboard.addWater') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="volume" value="{{ $volume }}">
                                    <button type="submit"
                                        class="w-full p-2 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                                        <div class="flex flex-col items-center">
                                            <i data-lucide="glass-water"
                                                class="w-5 h-5 text-blue-500 mb-1 group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-medium text-blue-700">{{ $volume }}ml</span>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <!-- Progress Status -->
                        <div class="p-3 bg-gray-50 rounded-lg">
                            @if ($userData['waterIntake']['current'] >= $userData['waterIntake']['goal'])
                                <div class="flex items-center text-green-600">
                                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                                    <span class="text-sm font-medium">Selamat! Target air minum hari ini tercapai!</span>
                                </div>
                            @else
                                <div class="flex items-center text-blue-600">
                                    <i data-lucide="target" class="w-5 h-5 mr-2"></i>
                                    <span class="text-sm">
                                        Anda perlu minum
                                        <strong>{{ (int) $userData['waterIntake']['goal'] - (int) $userData['waterIntake']['current'] }}ml</strong>
                                        lagi untuk mencapai target.
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Exercise Recommendations Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-4">
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center">
                                <i data-lucide="dumbbell" class="w-6 h-6 mr-2"></i>
                                <h2 class="font-bold text-lg">Rekomendasi Olahraga</h2>
                            </div>
                            <span class="text-xs bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full">
                                Hari Ini
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($exerciseRecommendations->isNotEmpty())
                            <div class="space-y-4"> @foreach($exerciseRecommendations->take(3) as $exercise) <div
                                    class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-4 border border-purple-100 hover:border-purple-300 hover:shadow-md transition-all duration-300 group"
                                    data-exercise-id="{{ $exercise->id }}" data-exercise-name="{{ $exercise->name }}"
                                    data-exercise-description="{{ $exercise->description }}"
                                    data-exercise-category="{{ $exercise->category_label }}"
                                    data-exercise-activity-level="{{ $exercise->activity_level_label }}"
                                    data-exercise-calories="{{ $exercise->calories_burned_per_hour }}"
                                    data-exercise-goal="{{ $exercise->goal_label }}"
                                    data-exercise-image="{{ $exercise->display_image }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-3 flex-1">
                                            <div
                                                class="w-8 h-8 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i data-lucide="activity" class="w-4 h-4 text-white"></i>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h4
                                                        class="font-semibold text-gray-900 text-sm group-hover:text-purple-600 transition-colors">
                                                        {{ $exercise->name }}
                                                    </h4>
                                                    <div class="flex items-center space-x-1">
                                                        @php
                                                            $userLogs = $exercise->exerciseLogs()->where('user_id', auth()->id())->count();
                                                        @endphp
                                                        @if($userLogs > 0)
                                                            <span
                                                                class="text-xs font-medium text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                                                {{ $userLogs }}x selesai
                                                            </span>
                                                        @endif
                                                        <span
                                                            class="text-xs font-semibold text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full">
                                                            {{ $exercise->category_label }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <p class="text-xs text-gray-600 leading-relaxed mb-3">
                                                    {{ Str::limit($exercise->description, 80) }}
                                                </p>
                                                <div class="flex items-center justify-between mb-3">
                                                    <div class="flex items-center space-x-3 text-xs text-gray-500">
                                                        @if($exercise->calories_burned_per_hour)
                                                            <div class="flex items-center">
                                                                <i data-lucide="zap" class="w-3 h-3 mr-1"></i>
                                                                <span>{{ $exercise->calories_burned_per_hour }} kal/jam</span>
                                                            </div>
                                                        @endif
                                                        <div class="flex items-center">
                                                            <i data-lucide="activity" class="w-3 h-3 mr-1"></i>
                                                            <span>{{ $exercise->activity_level_label }}</span>
                                                        </div>
                                                    </div>
                                                </div><!-- Action Buttons -->
                                                <div class="flex space-x-2">
                                                    <button onclick="openExerciseDetailModal({{ $exercise->id }})"
                                                        class="flex-1 text-xs px-3 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-all duration-300 flex items-center justify-center">
                                                        <i data-lucide="eye" class="w-3 h-3 mr-1"></i>
                                                        Detail
                                                    </button>
                                                    <button
                                                        onclick="openExerciseModal({{ $exercise->id }}, '{{ $exercise->name }}')"
                                                        class="flex-1 text-xs px-3 py-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 flex items-center justify-center">
                                                        <i data-lucide="plus" class="w-3 h-3 mr-1"></i>
                                                        Catat
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="dumbbell" class="w-8 h-8 text-purple-500"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Rekomendasi Olahraga</h3>
                                <p class="text-gray-600 text-sm">Lengkapi profil dan kuesioner untuk mendapatkan rekomendasi
                                    olahraga yang sesuai.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced User Information Card / Profil Kesehatan -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-4">
                        <div class="flex items-center text-white">
                            <i data-lucide="user-circle" class="w-6 h-6 mr-2"></i>
                            <h2 class="font-bold text-lg">Profil Kesehatan</h2>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Program Recommendation -->
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-4 border border-orange-100">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="star" class="w-5 h-5 text-orange-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 mb-1">Program Rekomendasi</p>
                                    <p class="font-bold text-orange-600 text-lg mb-2">
                                        {{ $userData['programRecommendation'] }}
                                    </p>
                                    <a href="{{ url('/diet-info') }}"
                                        class="text-orange-500 text-sm hover:underline flex items-center mt-2">
                                        Lihat informasi lengkap
                                        <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- BMI Section -->
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="activity" class="w-5 h-5 text-green-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 mb-1">BMI (Indeks Massa Tubuh)</p>
                                    <div class="flex items-center mb-2">
                                        <span
                                            class="text-2xl font-bold text-green-600">{{ number_format($userData['bmi'], 1) }}</span>
                                        <span class="ml-2 text-sm text-gray-500">
                                            @if ($userData['bmi'] < 18.5)
                                                (Kekurangan berat badan)
                                            @elseif ($userData['bmi'] < 24.9)
                                                (Normal)
                                            @elseif ($userData['bmi'] < 29.9)
                                                (Kelebihan berat badan)
                                            @else
                                                (Obesitas)
                                            @endif
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-3 mb-1">
                                        <div class="bg-gradient-to-r from-green-400 to-emerald-500 h-3 rounded-full transition-all duration-300"
                                            style="width: {{ min(($userData['bmi'] / 40) * 100, 100) }}%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>Kurang</span>
                                        <span>Normal</span>
                                        <span>Berlebih</span>
                                        <span>Obesitas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column - Progress Harian, Rekomendasi Olahraga, Metrik Kesehatan, Artikel Terbaru -->
            <div class="space-y-6">
                <!-- Daily Progress -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4">
                        <div class="flex items-center text-white">
                            <i data-lucide="calendar-days" class="w-6 h-6 mr-2"></i>
                            <h2 class="font-bold text-lg">Progress Harian</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <form method="POST" action="{{ route('dashboard.prevDay') }}">
                                @csrf
                                <button type="submit" id="prev-day-btn"
                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-all duration-300 {{ isset($currentDay) && $currentDay === 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ isset($currentDay) && $currentDay === 0 ? 'disabled' : '' }}>
                                    <i data-lucide="arrow-left"
                                        class="w-4 h-4 text-gray-600 transition-transform duration-200"></i>
                                </button>
                            </form>
                            <div class="flex space-x-2" id="day-selector">
                                @foreach ($userData['dailyProgress'] as $index => $day)
                                    <form method="POST" action="{{ route('dashboard.setDay') }}">
                                        @csrf
                                        <input type="hidden" name="day_index" value="{{ $index }}">
                                        <button type="submit" data-day-index="{{ $index }}"
                                            class="day-button flex flex-col items-center justify-center w-12 h-12 rounded-xl transition-all duration-300 transform {{ isset($currentDay) && $index === $currentDay ? 'bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg scale-105' : 'bg-gray-50 text-gray-700 hover:bg-gray-100 hover:scale-105' }}">
                                            <span class="text-xs font-medium">{{ $day['day'] }}</span>
                                            <span class="text-sm font-bold">{{ $day['date'] }}</span>
                                            @if(isset($day['current']) && $day['current'])
                                                <div class="w-2 h-2 bg-orange-400 rounded-full mt-1"></div>
                                            @endif
                                        </button>
                                    </form>
                                @endforeach
                            </div>

                            <form method="POST" action="{{ route('dashboard.nextDay') }}">
                                @csrf
                                <button type="submit" id="next-day-btn"
                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-all duration-300 {{ isset($currentDay) && $currentDay >= count($userData['dailyProgress']) - 1 ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ isset($currentDay) && $currentDay >= count($userData['dailyProgress']) - 1 ? 'disabled' : '' }}>
                                    <i data-lucide="arrow-right"
                                        class="w-4 h-4 text-gray-600 transition-transform duration-200"></i>
                                </button>
                            </form>
                        </div>
                        <!-- Daily Progress Details -->
                        <div class="space-y-4" id="daily-progress-details">
                            <div id="weight-progress-card"
                                class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100 transform transition-all duration-500">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-lucide="scale" class="w-4 h-4 text-green-600"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800">Berat Badan</p>
                                </div>
                                @if (isset($selectedDay) && $selectedDay['weight'])
                                    <div class="flex items-center"> <span
                                            class="text-2xl font-bold text-gray-800 weight-value">{{ number_format($selectedDay['weight'], 1) }}
                                            kg</span>
                                        @if (isset($currentDay) && $currentDay > 0 && $userData['dailyProgress'][$currentDay - 1]['weight'])
                                            @php
                                                $prevWeight = $userData['dailyProgress'][$currentDay - 1]['weight'];
                                                $weightChange = $selectedDay['weight'] - $prevWeight;
                                            @endphp <span
                                                class="ml-3 px-2 py-1 rounded-full text-xs font-medium weight-change-badge {{ $weightChange < 0 ? 'bg-green-100 text-green-600' : ($weightChange > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600') }}">
                                                {{ $weightChange < 0 ? '↓' : ($weightChange > 0 ? '↑' : '→') }}
                                                {{ number_format(abs($weightChange), 1) }} kg
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-gray-400 italic">Belum ada data</p>
                                @endif
                            </div>

                            <div id="water-progress-card"
                                class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-100 transform transition-all duration-500">
                                <div class="flex items-center mb-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-lucide="droplets" class="w-4 h-4 text-blue-600"></i>
                                    </div>
                                    <p class="font-semibold text-gray-800">Air Minum</p>
                                </div>
                                @if (isset($selectedDay) && $selectedDay['water'])
                                    <div class="flex items-center mb-3">
                                        <span class="text-2xl font-bold text-gray-800 water-value">{{ $selectedDay['water'] }}
                                            ml</span>
                                        <span class="ml-2 text-sm text-gray-500">dari {{ $userData['waterIntake']['goal'] }}
                                            ml</span>
                                    </div>
                                    <div class="w-full bg-blue-100 rounded-full h-3 overflow-hidden">
                                        @php
                                            $waterProgress = min(($selectedDay['water'] / $userData['waterIntake']['goal']) * 100, 100);
                                        @endphp
                                        <div id="daily-water-progress-bar"
                                            class="bg-gradient-to-r from-blue-400 to-cyan-500 h-3 rounded-full transition-all duration-1000 ease-out"
                                            style="width: {{ $waterProgress }}%"></div>
                                    </div>
                                @else
                                    <p class="text-gray-400 italic">Belum ada data</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Meal Recommendations Card -->
                @if (isset($selectedDay) && isset($selectedDay['meals']))
                    <div id="meal-recommendations-card"
                        class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl p-4 border border-orange-100 transform transition-all duration-500">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <i data-lucide="utensils" class="w-4 h-4 text-orange-600"></i>
                            </div>
                            <p class="font-semibold text-gray-800">Rekomendasi Makanan Hari Ini</p>
                        </div>
                        <div class="space-y-3">
                            @foreach($selectedDay['meals'] as $mealType => $meal)
                                <div
                                    class="bg-white/60 rounded-lg p-3 border border-orange-200/50 hover:bg-white/80 transition-all duration-300 {{ isset($meal['consumed']) && $meal['consumed'] ? 'bg-green-50 border-green-200' : '' }}">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-start space-x-3 flex-1">
                                            <div
                                                class="w-6 h-6 bg-gradient-to-br from-orange-400 to-red-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <i data-lucide="{{ $meal['icon'] }}" class="w-3 h-3 text-white"></i>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-1">
                                                    <h4
                                                        class="font-medium text-gray-900 text-sm {{ isset($meal['consumed']) && $meal['consumed'] ? 'line-through text-gray-500' : '' }}">
                                                        {{ $meal['name'] }}
                                                    </h4>
                                                    <span
                                                        class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded-full">
                                                        {{ $meal['calories'] }} kal
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-600 leading-relaxed">
                                                    {{ $meal['description'] }}
                                                </p>
                                                <div class="mt-2 flex items-center justify-between">
                                                    <span
                                                        class="text-xs text-gray-500 capitalize bg-gray-100 px-2 py-0.5 rounded-full">
                                                        {{ ucfirst(str_replace('_', ' ', $mealType)) }}
                                                    </span>

                                                    <!-- Meal consumption button -->
                                                    <form method="POST" action="{{ route('dashboard.consumeMeal') }}"
                                                        class="inline">
                                                        @csrf
                                                        <input type="hidden" name="meal_type" value="{{ $mealType }}">
                                                        <input type="hidden" name="date" value="{{ $selectedDay['full_date'] }}">
                                                        <button type="submit"
                                                            class="text-xs px-2 py-1 rounded-full transition-colors {{ isset($meal['consumed']) && $meal['consumed'] ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }}">
                                                            @if(isset($meal['consumed']) && $meal['consumed'])
                                                                <i data-lucide="check" class="w-3 h-3 inline mr-1"></i>Consumed
                                                            @else
                                                                <i data-lucide="plus" class="w-3 h-3 inline mr-1"></i>Tambah
                                                            @endif
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div> <!-- Total Calories for the day -->
                        @php
                            $consumedCalories = 0;
                            $totalCalories = 0;
                            foreach ($selectedDay['meals'] as $meal) {
                                $totalCalories += $meal['calories'];
                                if (isset($meal['consumed']) && $meal['consumed']) {
                                    $consumedCalories += $meal['calories'];
                                }
                            }
                        @endphp
                        <div class="mt-4 pt-3 border-t border-orange-200">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <i data-lucide="calculator" class="w-4 h-4 text-orange-500 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-700">Kalori Dikonsumsi</span>
                                </div>
                                <span class="text-lg font-bold text-orange-600">{{ $consumedCalories }} kal</span>
                            </div>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>dari {{ $totalCalories }} kal yang direkomendasikan</span>
                            </div>
                            <div class="mt-2">
                                <div class="w-full bg-orange-100 rounded-full h-2">
                                    @php
                                        // Target kalori harian berdasarkan program diet spesifik
                                        $targetCalories = 1800; // Default
                                        $programLower = strtolower($userData['programRecommendation']);

                                        if (str_contains($programLower, 'dash')) {
                                            $targetCalories = 1600; // Diet DASH cenderung lebih rendah kalori
                                        } elseif (str_contains($programLower, 'mediterania') || str_contains($programLower, 'mediterranean')) {
                                            $targetCalories = 1900; // Diet Mediterania sedang
                                        } elseif (str_contains($programLower, 'rendah lemak') || str_contains($programLower, 'low fat')) {
                                            $targetCalories = 1500; // Diet rendah lemak biasanya rendah kalori
                                        } elseif (str_contains($programLower, 'rendah karbohidrat') || str_contains($programLower, 'low carb')) {
                                            $targetCalories = 1700; // Diet rendah karbo
                                        } elseif (str_contains($programLower, 'seimbang') || str_contains($programLower, 'balanced')) {
                                            $targetCalories = 2000; // Pola makan seimbang
                                        } elseif (str_contains($programLower, 'gain') || str_contains($programLower, 'massa otot')) {
                                            $targetCalories = 2200; // Untuk penambahan massa otot
                                        } elseif (str_contains($programLower, 'maintain')) {
                                            $targetCalories = 1900; // Maintenance
                                        }

                                        $calorieProgress = min(($consumedCalories / $targetCalories) * 100, 100);
                                    @endphp
                                    <div class="bg-gradient-to-r from-orange-400 to-red-500 h-2 rounded-full transition-all duration-1000 ease-out"
                                        style="width: {{ $calorieProgress }}%">
                                    </div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>0 kal</span>
                                    <span>Target: {{ $targetCalories }} kal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Health Metrics Card -->setelah saya
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-600 p-4">
                        <div class="flex items-center text-white">
                            <i data-lucide="heart" class="w-6 h-6 mr-2"></i>
                            <h2 class="font-bold text-lg">Metrik Kesehatan</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                            <!-- Current Weight -->
                            <div
                                class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                                <div
                                    class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i data-lucide="scale" class="w-6 h-6 text-blue-600"></i>
                                </div>
                                <div class="text-xl font-bold text-gray-800">
                                    {{ $userData['weight']['current'] ? number_format($userData['weight']['current'], 1) . ' kg' : 'Belum ada data' }}
                                </div>
                                <div class="text-xs text-gray-600 mt-1">Berat Saat Ini</div>
                            </div>
                            <!-- Target -->
                            <div
                                class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                <div
                                    class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i data-lucide="target" class="w-6 h-6 text-purple-600"></i>
                                </div>
                                <div class="text-xl font-bold text-gray-800">
                                    {{ $userData['weight']['target'] ? number_format($userData['weight']['target'], 1) . ' kg' : 'Belum diset' }}
                                </div>
                                <div class="text-xs text-gray-600 mt-1">Target Berat</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Recommendations -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4">
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center">
                                <i data-lucide="book-open" class="w-6 h-6 mr-2"></i>
                                <h2 class="font-bold text-lg">Artikel Terbaru</h2>
                            </div>
                            <a href="{{ url('/articles') }}"
                                class="text-white/80 hover:text-white text-sm font-medium transition-colors">
                                Lihat Semua →
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach ($visibleArticles as $article)
                                <div class="group">
                                    <a href="{{ route('articles.show', $article['id']) }}" class="block">
                                        <div
                                            class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                                            <div class="flex space-x-4">
                                                <div class="relative w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}"
                                                        class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
                                                    <div
                                                        class="absolute top-1 left-1 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded text-xs font-medium text-indigo-600">
                                                        {{ $article['category'] }}
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h3
                                                        class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-2 mb-1">
                                                        {{ $article['title'] }}
                                                    </h3>
                                                    <p class="text-sm text-gray-600 line-clamp-2 mb-2">
                                                        {{ $article['excerpt'] }}
                                                    </p>
                                                    <div class="flex items-center text-xs text-gray-500">
                                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                        <span>{{ $article['readTime'] }} membaca</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exercise Detail Modal -->
    <div id="exerciseDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div
            class="bg-white rounded-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden shadow-2xl transform transition-all duration-300 scale-95">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-lucide="activity" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h2 id="exerciseDetailTitle" class="text-2xl font-bold">Detail Olahraga</h2>
                            <p class="text-white/80 text-sm">Panduan lengkap gerakan olahraga</p>
                        </div>
                    </div>
                    <button onclick="closeExerciseDetailModal()"
                        class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="overflow-y-auto max-h-[calc(90vh-120px)]">
                <div class="p-6">
                    <!-- Loading State -->
                    <div id="exerciseDetailLoading" class="flex items-center justify-center py-12">
                        <div class="text-center">
                            <div
                                class="w-16 h-16 border-4 border-purple-200 border-t-purple-500 rounded-full animate-spin mx-auto mb-4">
                            </div>
                            <p class="text-gray-600">Memuat detail olahraga...</p>
                        </div>
                    </div>

                    <!-- Exercise Detail Content -->
                    <div id="exerciseDetailContent" class="hidden space-y-6"> <!-- Exercise Info -->
                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-6 border border-purple-100">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Exercise Image -->
                                <div class="md:col-span-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Contoh Gerakan</h3>
                                    <div class="bg-white rounded-xl overflow-hidden border border-purple-200 shadow-sm">
                                        <img id="exerciseImage" src="" alt="Contoh gerakan olahraga"
                                            class="w-full h-48 object-cover cursor-pointer hover:scale-105 transition-transform duration-300"
                                            onclick="openImageModal(this.src, this.alt)">
                                        <div class="p-3 bg-gray-50">
                                            <p class="text-xs text-gray-600 text-center">Klik gambar untuk memperbesar</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Exercise Details -->
                                <div class="md:col-span-2">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Olahraga</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <i data-lucide="clock" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Durasi</p>
                                                    <p id="exerciseDuration" class="font-semibold text-gray-900">-</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <i data-lucide="trending-up" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Tingkat Kesulitan</p>
                                                    <p id="exerciseDifficulty" class="font-semibold text-gray-900">-</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <i data-lucide="zap" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Kalori Terbakar</p>
                                                    <p id="exerciseCalories" class="font-semibold text-gray-900">-</p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                    <i data-lucide="tag" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-gray-600">Kategori</p>
                                                    <p id="exerciseCategory" class="font-semibold text-gray-900">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mt-4">
                                        <h4 class="text-md font-semibold text-gray-900 mb-2">Deskripsi</h4>
                                        <p id="exerciseDescription" class="text-gray-700 leading-relaxed text-sm">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Exercise Steps -->
                        <div class="bg-white rounded-xl border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i data-lucide="list-ordered" class="w-5 h-5 mr-2 text-purple-500"></i>
                                    Langkah-langkah Gerakan
                                </h3>
                            </div>
                            <div id="exerciseSteps" class="p-6">
                                <!-- Steps will be loaded here -->
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-4 pt-4 border-t border-gray-200">
                            <button id="exerciseLogBtn" onclick="openExerciseModalFromDetail()"
                                class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 flex items-center justify-center">
                                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                                Catat Olahraga Ini
                            </button>
                            <button onclick="closeExerciseDetailModal()"
                                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal for enlarged view -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 hidden items-center justify-center z-50 p-4">
        <div class="relative max-w-4xl max-h-[90vh] w-full h-full flex items-center justify-center">
            <!-- Close Button -->
            <button onclick="closeImageModal()"
                class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-colors z-10">
                <i data-lucide="x" class="w-6 h-6 text-white"></i>
            </button>

            <!-- Image -->
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">

            <!-- Image Caption -->
            <div class="absolute bottom-4 left-4 right-4 bg-black/50 backdrop-blur-sm text-white p-3 rounded-lg">
                <p id="modalImageCaption" class="text-center font-medium"></p>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Add some interactive animations
        document.addEventListener('DOMContentLoaded', function () {
            // Animate cards on scroll
            const cards = document.querySelectorAll('.rounded-xl');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Enhanced Water Tracking Animations
            initWaterTrackingAnimations();

            // Enhanced Daily Progress Animations
            initDailyProgressAnimations();

            // Add interactive hover effects
            addInteractiveEffects();
        });

        // Water Tracking Enhancements
        function initWaterTrackingAnimations() {
            // Animate water progress circle
            const waterCircle = document.querySelector('.text-blue-500[stroke-dasharray]');
            if (waterCircle) {
                const dashArray = waterCircle.getAttribute('stroke-dasharray');
                const progress = parseFloat(dashArray.split(',')[0]);

                // Reset progress to 0 and animate
                waterCircle.setAttribute('stroke-dasharray', '0, 100');

                setTimeout(() => {
                    waterCircle.style.transition = 'stroke-dasharray 2s ease-in-out';
                    waterCircle.setAttribute('stroke-dasharray', dashArray);
                }, 500);

                // Add pulsing effect for completed goals
                if (progress >= 100) {
                    waterCircle.style.filter = 'drop-shadow(0 0 8px rgba(59, 130, 246, 0.6))';
                    setInterval(() => {
                        waterCircle.style.opacity = waterCircle.style.opacity === '0.8' ? '1' : '0.8';
                    }, 1000);
                }
            }

            // Animate water percentage counter
            const waterPercentage = document.querySelector('.text-blue-500.font-medium');
            if (waterPercentage) {
                const targetPercent = parseInt(waterPercentage.textContent);
                let currentPercent = 0;

                const interval = setInterval(() => {
                    if (currentPercent <= targetPercent) {
                        waterPercentage.textContent = currentPercent + '%';
                        currentPercent++;
                    } else {
                        clearInterval(interval);
                    }
                }, 30);
            }

            // Add ripple effect to water buttons
            const waterButtons = document.querySelectorAll('form[action*="addWater"] button');
            waterButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    // Create ripple effect
                    const ripple = document.createElement('span');
                    const rect = button.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                                                                                                position: absolute;
                                                                                                width: ${size}px;
                                                                                                height: ${size}px;
                                                                                                left: ${x}px;
                                                                                                top: ${y}px;
                                                                                                background: rgba(59, 130, 246, 0.3);
                                                                                                border-radius: 50%;
                                                                                                transform: scale(0);
                                                                                                animation: ripple 0.6s ease-out;
                                                                                                pointer-events: none;
                                                                                            `;

                    button.style.position = 'relative';
                    button.style.overflow = 'hidden';
                    button.appendChild(ripple);

                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Animate water drop icons
            const waterIcons = document.querySelectorAll('[data-lucide="droplets"]');
            waterIcons.forEach(icon => {
                setInterval(() => {
                    icon.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                        icon.style.transform = 'scale(1)';
                    }, 200);
                }, 3000);
            });
        }

        // Daily Progress Enhancements
        function initDailyProgressAnimations() {
            // Animate day selection buttons
            const dayButtons = document.querySelectorAll('form[action*="setDay"] button');
            dayButtons.forEach((button, index) => {
                // Staggered entrance animation
                setTimeout(() => {
                    button.style.transform = 'translateY(0) scale(1)';
                    button.style.opacity = '1';
                }, index * 100);

                // Add click animation
                button.addEventListener('click', function (e) {
                    // Remove active class from all buttons
                    dayButtons.forEach(btn => {
                        btn.classList.remove('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg');
                        btn.classList.add('bg-gray-50', 'text-gray-700');
                    });

                    // Add active class to clicked button
                    this.classList.remove('bg-gray-50', 'text-gray-700');
                    this.classList.add('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg');

                    // Add bounce effect
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 100);

                    // Create ripple effect for day selection
                    createDaySelectionRipple(this);

                    // Animate progress details update
                    animateProgressDetailsUpdate();
                });
            });

            // Animate progress bars with enhanced effects
            const progressBars = document.querySelectorAll('.bg-gradient-to-r.from-blue-400.to-cyan-500');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                bar.style.transition = 'width 1.5s ease-out';
                bar.style.position = 'relative';
                bar.style.overflow = 'hidden';

                // Add shimmer effect
                const shimmer = document.createElement('div');
                shimmer.style.cssText = `
                                                                                            position: absolute;
                                                                                            top: 0;
                                                                                            left: -100%;
                                                                                            width: 100%;
                                                                                            height: 100%;
                                                                                            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
                                                                                            animation: shimmer 2s infinite;
                                                                                        `;

                const shimmerStyle = document.createElement('style');
                shimmerStyle.textContent = `
                                                                                            @keyframes shimmer {
                                                                                                0% { left: -100%; }
                                                                                                100% { left: 100%; }
                                                                                            }
                                                                                        `;

                if (!document.querySelector('style[data-shimmer]')) {
                    shimmerStyle.setAttribute('data-shimmer', 'true');
                    document.head.appendChild(shimmerStyle);
                }

                bar.appendChild(shimmer);

                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });

            // Add floating animation to weight and water data with enhanced effects
            const dataCards = document.querySelectorAll('.bg-gradient-to-br.from-green-50, .bg-gradient-to-br.from-blue-50');
            dataCards.forEach((card, index) => {
                // Initial animation
                card.style.transform = 'translateY(20px)';
                card.style.opacity = '0';

                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.transform = 'translateY(0)';
                    card.style.opacity = '1';
                }, 200 + (index * 150));

                // Add periodic subtle animation
                setInterval(() => {
                    if (!card.matches(':hover')) {
                        card.style.transform = 'translateY(-1px)';
                        setTimeout(() => {
                            card.style.transform = 'translateY(0)';
                        }, 500);
                    }
                }, 8000 + (index * 1000)); // Staggered timing
            });

            // Enhanced navigation arrows with directional indicators
            const navButtons = document.querySelectorAll('form[action*="prevDay"] button, form[action*="nextDay"] button');
            navButtons.forEach(button => {
                const isPrev = button.closest('form[action*="prevDay"]');

                button.addEventListener('click', function () {
                    if (!this.disabled) {
                        // Add click feedback
                        this.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);

                        // Create slide transition effect
                        const progressDetails = document.querySelector('#daily-progress-details');
                        if (progressDetails) {
                            progressDetails.style.opacity = '0.7';
                            progressDetails.style.transform = isPrev ? 'translateX(-10px)' : 'translateX(10px)';
                        }
                    }
                });
            });
        }

        // Create ripple effect for day selection
        function createDaySelectionRipple(button) {
            const ripple = document.createElement('div');
            const rect = button.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);

            ripple.style.cssText = `
                                                                                        position: absolute;
                                                                                        width: ${size}px;
                                                                                        height: ${size}px;
                                                                                        left: 50%;
                                                                                        top: 50%;
                                                                                        transform: translate(-50%, -50%) scale(0);
                                                                                        border-radius: 50%;
                                                                                        background: rgba(255, 255, 255, 0.6);
                                                                                        animation: dayRipple 0.6s ease-out;
                                                                                        pointer-events: none;
                                                                                        z-index: 1;
                                                                                    `;

            const style = document.createElement('style');
            style.textContent = `
                                                                                        @keyframes dayRipple {
                                                                                            to {
                                                                                                transform: translate(-50%, -50%) scale(2);
                                                                                                opacity: 0;
                                                                                            }
                                                                                        }
                                                                                    `;

            if (!document.querySelector('style[data-day-ripple]')) {
                style.setAttribute('data-day-ripple', 'true');
                document.head.appendChild(style);
            }

            button.style.position = 'relative';
            button.style.overflow = 'hidden';
            button.appendChild(ripple);

            setTimeout(() => ripple.remove(), 600);
        }

        // Animate progress details update
        function animateProgressDetailsUpdate() {
            const progressDetails = document.querySelector('#daily-progress-details');
            if (progressDetails) {
                // Fade out
                progressDetails.style.transition = 'all 0.3s ease';
                progressDetails.style.opacity = '0.5';
                progressDetails.style.transform = 'scale(0.98)';

                setTimeout(() => {
                    // Fade back in with new data
                    progressDetails.style.opacity = '1';
                    progressDetails.style.transform = 'scale(1)';

                    // Add a subtle bounce effect
                    progressDetails.style.animation = 'none';
                    setTimeout(() => {
                        progressDetails.style.animation = 'scaleIn 0.4s ease-out';
                    }, 10);
                }, 300);
            }
        }
    </script>

    <!-- Exercise Log Modal -->
    <div id="exerciseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div
            class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4 transform scale-95 transition-all duration-300">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                        <i data-lucide="dumbbell" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Catat Olahraga</h3>
                        <p class="text-gray-600 text-sm" id="exerciseName">-</p>
                    </div>
                </div>
                <button onclick="closeExerciseModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form action="{{ route('dashboard.addExerciseLog') }}" method="POST" id="exerciseForm">
                @csrf
                <input type="hidden" name="exercise_recommendation_id" id="exerciseId">

                <div class="space-y-4">
                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
                            Durasi (menit)
                        </label>
                        <input type="number" name="duration_minutes" min="1" max="300" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="Contoh: 30">
                    </div>

                    <!-- Intensity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="zap" class="w-4 h-4 inline mr-1"></i>
                            Intensitas
                        </label>
                        <select name="intensity" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Pilih intensitas</option>
                            <option value="low">Rendah</option>
                            <option value="moderate">Sedang</option>
                            <option value="high">Tinggi</option>
                        </select>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i data-lucide="edit-3" class="w-4 h-4 inline mr-1"></i>
                            Catatan (opsional)
                        </label>
                        <textarea name="notes" rows="3" maxlength="500"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                            placeholder="Bagaimana perasaan Anda setelah olahraga?"></textarea>
                    </div>
                </div>

                <div class="flex items-center space-x-3 mt-6">
                    <button type="button" onclick="closeExerciseModal()"
                        class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg hover:from-purple-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                        <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openExerciseModal(exerciseId, exerciseName) {
            document.getElementById('exerciseId').value = exerciseId;
            document.getElementById('exerciseName').textContent = exerciseName;
            const modal = document.getElementById('exerciseModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            // Animate modal
            setTimeout(() => {
                modal.querySelector('.bg-white').style.transform = 'scale(1)';
            }, 10);
        }

        function closeExerciseModal() {
            const modal = document.getElementById('exerciseModal');
            modal.querySelector('.bg-white').style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                // Reset form
                document.getElementById('exerciseForm').reset();
            }, 300);
        }        // Close modal when clicking outside
        document.getElementById('exerciseModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeExerciseModal();
            }
        });        // Exercise Detail Modal Functions
        let currentExerciseId = null;
        let currentExerciseName = '';

        function openExerciseDetailModal(exerciseId) {
            console.log('=== Opening Exercise Detail Modal ===');
            console.log('Exercise ID:', exerciseId);

            currentExerciseId = exerciseId;
            const modal = document.getElementById('exerciseDetailModal');

            if (!modal) {
                console.error('Exercise detail modal not found!');
                return;
            }

            // Show modal immediately
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            console.log('Modal opened');

            // Animate modal
            setTimeout(() => {
                const modalContent = modal.querySelector('.bg-white');
                if (modalContent) {
                    modalContent.style.transform = 'scale(1)';
                }
            }, 10);            // Get exercise data from card attributes and show immediately
            const exerciseCard = document.querySelector(`[data-exercise-id="${exerciseId}"]`);
            console.log('Exercise card found:', exerciseCard);
            console.log('Card selector:', `[data-exercise-id="${exerciseId}"]`);

            if (exerciseCard) {
                const fallbackData = {
                    name: exerciseCard.getAttribute('data-exercise-name') || 'Detail Olahraga',
                    description: exerciseCard.getAttribute('data-exercise-description') || 'Tidak ada deskripsi tersedia.',
                    activity_level_label: exerciseCard.getAttribute('data-exercise-activity-level') || 'Tidak ditentukan',
                    calories_burned_per_hour: exerciseCard.getAttribute('data-exercise-calories') || 'Tidak tersedia',
                    category_label: exerciseCard.getAttribute('data-exercise-category') || 'Umum',
                    goal_label: exerciseCard.getAttribute('data-exercise-goal') || 'Umum',
                    display_image: exerciseCard.getAttribute('data-exercise-image') || '/images/default-exercise.jpg',
                    instructions: [
                        'Lakukan gerakan ini sesuai dengan kemampuan Anda.',
                        'Mulai dengan intensitas ringan dan tingkatkan secara bertahap.',
                        'Jaga postur tubuh yang benar selama melakukan gerakan.',
                        'Jika merasa tidak nyaman, hentikan aktivitas dan konsultasi dengan ahli.'
                    ]
                }; console.log('Displaying fallback data immediately:', fallbackData);

                // Hide loading and show content first
                const loading = document.getElementById('exerciseDetailLoading');
                const content = document.getElementById('exerciseDetailContent');

                if (loading) {
                    loading.classList.add('hidden');
                    console.log('Loading hidden');
                }
                if (content) {
                    content.classList.remove('hidden');
                    console.log('Content shown');
                }

                // Show content immediately without loading state
                displayExerciseDetails(fallbackData);
                console.log('displayExerciseDetails called with fallback data');

                // Try to get better instructions from API in background (non-blocking)
                setTimeout(() => {
                    fetchExerciseDetailsBackground(exerciseId);
                }, 1000);

            } else {
                // If no card data, show loading and fetch from API
                document.getElementById('exerciseDetailLoading').classList.remove('hidden');
                document.getElementById('exerciseDetailContent').classList.add('hidden');

                fetchExerciseDetailsWithTimeout(exerciseId);
            }
        }

        function closeExerciseDetailModal() {
            const modal = document.getElementById('exerciseDetailModal');
            modal.querySelector('.bg-white').style.transform = 'scale(0.95)';
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                currentExerciseId = null;
                currentExerciseName = '';
            }, 300);
        }

        function openExerciseModalFromDetail() {
            if (currentExerciseId && currentExerciseName) {
                closeExerciseDetailModal();
                setTimeout(() => {
                    openExerciseModal(currentExerciseId, currentExerciseName);
                }, 300);
            }
        }

        // Image Modal Functions
        function openImageModal(imageSrc, imageAlt) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalImageCaption');

            if (modal && modalImage && modalCaption) {
                modalImage.src = imageSrc;
                modalImage.alt = imageAlt;
                modalCaption.textContent = imageAlt;

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                // Reinitialize Lucide icons for the close button
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            }
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        // Close image modal when clicking outside the image
        document.addEventListener('DOMContentLoaded', function () {
            const imageModal = document.getElementById('imageModal');
            if (imageModal) {
                imageModal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        closeImageModal();
                    }
                });
            }
        });

        async function fetchExerciseDetailsWithTimeout(exerciseId) {
            try {
                console.log('Fetching exercise details with timeout for ID:', exerciseId);

                // Create a promise that rejects after 5 seconds
                const timeoutPromise = new Promise((_, reject) => {
                    setTimeout(() => reject(new Error('Request timeout')), 5000);
                });

                // Create the fetch promise
                const fetchPromise = fetchExerciseDetails(exerciseId);

                // Race between fetch and timeout
                await Promise.race([fetchPromise, timeoutPromise]);

            } catch (error) {
                console.error('Fetch with timeout failed:', error);

                // Use fallback data or show error
                const exerciseCard = document.querySelector(`[data-exercise-id="${exerciseId}"]`);
                if (exerciseCard) {
                    const fallbackData = {
                        name: exerciseCard.getAttribute('data-exercise-name') || 'Detail Olahraga',
                        description: exerciseCard.getAttribute('data-exercise-description') || 'Tidak ada deskripsi tersedia.',
                        activity_level_label: exerciseCard.getAttribute('data-exercise-activity-level') || 'Tidak ditentukan',
                        calories_burned_per_hour: exerciseCard.getAttribute('data-exercise-calories') || 'Tidak tersedia',
                        category_label: exerciseCard.getAttribute('data-exercise-category') || 'Umum',
                        goal_label: exerciseCard.getAttribute('data-exercise-goal') || 'Umum',
                        instructions: ['Lakukan gerakan ini sesuai dengan kemampuan Anda.', 'Mulai dengan intensitas ringan dan tingkatkan secara bertahap.', 'Jaga postur tubuh yang benar selama melakukan gerakan.']
                    };
                    console.log('Using timeout fallback data:', fallbackData);
                    displayExerciseDetails(fallbackData);
                } else {
                    displayExerciseError('Gagal memuat detail olahraga. Silakan coba lagi.');
                }
            }
        } async function fetchExerciseDetailsBackground(exerciseId) {
            try {
                console.log('Background fetch for exercise details ID:', exerciseId);

                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
                }

                const response = await fetch(`/exercise-recommendations/${exerciseId}`, {
                    method: 'GET',
                    headers: headers
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.success && result.data.instructions) {
                        // Only update if we got better instructions
                        console.log('Got enhanced data from API:', result.data);
                        displayExerciseSteps(result.data.instructions);
                    }
                }
            } catch (error) {
                console.log('Background fetch failed (not critical):', error);
                // Ignore background fetch errors
            }
        } async function fetchExerciseDetails(exerciseId) {
            try {
                console.log('Fetching exercise details for ID:', exerciseId);

                // Add CSRF token for Laravel
                const csrfToken = document.querySelector('meta[name="csrf-token"]');
                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                };

                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.getAttribute('content');
                }

                const response = await fetch(`/exercise-recommendations/${exerciseId}`, {
                    method: 'GET',
                    headers: headers
                });

                console.log('Response status:', response.status);

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();
                console.log('API Response:', result);

                if (result.success) {
                    displayExerciseDetails(result.data);
                } else {
                    console.error('API Error:', result);
                    throw new Error(result.message || 'Failed to fetch exercise details');
                }
            } catch (error) {
                console.error('Error fetching exercise details:', error);

                // Try to use fallback data before showing error
                const exerciseCard = document.querySelector(`[data-exercise-id="${exerciseId}"]`);
                if (exerciseCard) {
                    const fallbackData = {
                        name: exerciseCard.getAttribute('data-exercise-name') || 'Detail Olahraga',
                        description: exerciseCard.getAttribute('data-exercise-description') || 'Tidak ada deskripsi tersedia.',
                        activity_level_label: exerciseCard.getAttribute('data-exercise-activity-level') || 'Tidak ditentukan',
                        calories_burned_per_hour: exerciseCard.getAttribute('data-exercise-calories') || 'Tidak tersedia',
                        category_label: exerciseCard.getAttribute('data-exercise-category') || 'Umum',
                        goal_label: exerciseCard.getAttribute('data-exercise-goal') || 'Umum',
                        instructions: ['Instruksi tidak tersedia saat ini, tetapi Anda dapat melakukan olahraga ini sesuai kemampuan Anda.']
                    };
                    console.log('Using fallback data due to error:', fallbackData);
                    displayExerciseDetails(fallbackData);
                } else {
                    displayExerciseError(error.message);
                }
            }
        } function displayExerciseDetails(exercise) {
            console.log('=== displayExerciseDetails called ===');
            console.log('Exercise data:', exercise);
            currentExerciseName = exercise.name;

            // Make sure we have the modal elements
            const loading = document.getElementById('exerciseDetailLoading');
            const content = document.getElementById('exerciseDetailContent');

            console.log('Loading element:', loading);
            console.log('Content element:', content);

            if (!loading || !content) {
                console.error('Modal elements not found');
                return;
            }

            // Update modal content
            const titleElement = document.getElementById('exerciseDetailTitle');
            const durationElement = document.getElementById('exerciseDuration');
            const difficultyElement = document.getElementById('exerciseDifficulty');
            const caloriesElement = document.getElementById('exerciseCalories');
            const descriptionElement = document.getElementById('exerciseDescription');

            if (titleElement) titleElement.textContent = exercise.name || 'Detail Olahraga';
            if (durationElement) durationElement.textContent = exercise.duration || 'Sesuai kemampuan';
            if (difficultyElement) difficultyElement.textContent = exercise.activity_level_label || 'Tidak ditentukan';

            // Handle calories display
            let caloriesText = 'Tidak tersedia';
            if (exercise.calories_burned_per_hour) {
                const caloriesNum = parseInt(exercise.calories_burned_per_hour);
                if (!isNaN(caloriesNum)) {
                    caloriesText = `${caloriesNum} kal/jam`;
                } else if (typeof exercise.calories_burned_per_hour === 'string') {
                    caloriesText = exercise.calories_burned_per_hour.includes('kal/jam')
                        ? exercise.calories_burned_per_hour
                        : `${exercise.calories_burned_per_hour} kal/jam`;
                }
            }
            if (caloriesElement) caloriesElement.textContent = caloriesText; if (descriptionElement) descriptionElement.textContent = exercise.description || 'Tidak ada deskripsi tersedia.';            // Update exercise image
            const imageElement = document.getElementById('exerciseImage');
            if (imageElement) {
                const imageSrc = exercise.display_image || exercise.image || '/images/default-exercise.jpg';
                imageElement.src = imageSrc;
                imageElement.alt = `Contoh gerakan ${exercise.name || 'olahraga'}`;
            }

            // Update exercise category
            const categoryElement = document.getElementById('exerciseCategory');
            if (categoryElement) categoryElement.textContent = exercise.category_label || 'Umum';

            // Display exercise steps
            displayExerciseSteps(exercise.instructions || []);// Update log button
            const logBtn = document.getElementById('exerciseLogBtn');
            if (logBtn) {
                logBtn.setAttribute('onclick', `openExerciseModalFromDetail()`);
            }

            // Content is already shown, just log completion
            console.log('Exercise details populated successfully');
        }

        function displayExerciseSteps(instructions) {
            const stepsContainer = document.getElementById('exerciseSteps');

            if (!stepsContainer) {
                console.error('Steps container not found');
                return;
            }

            // Handle empty or null instructions
            if (!instructions || (Array.isArray(instructions) && instructions.length === 0)) {
                stepsContainer.innerHTML = `
                                            <div class="text-center py-8">
                                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <i data-lucide="info" class="w-8 h-8 text-gray-400"></i>
                                                </div>
                                                <p class="text-gray-500">Langkah-langkah belum tersedia untuk olahraga ini.</p>
                                                <p class="text-gray-400 text-sm mt-2">Lakukan olahraga sesuai kemampuan Anda.</p>
                                            </div>
                                        `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
                return;
            }

            // Parse instructions if it's a JSON string
            let parsedInstructions = instructions;
            if (typeof instructions === 'string') {
                if (instructions.trim().startsWith('[') || instructions.trim().startsWith('{')) {
                    try {
                        parsedInstructions = JSON.parse(instructions);
                    } catch (e) {
                        // If JSON parsing fails, split by newlines or treat as single instruction
                        parsedInstructions = instructions.split('\n').filter(step => step.trim().length > 0);
                    }
                } else {
                    // Plain text, split by newlines or numbers
                    parsedInstructions = instructions.split(/\n|\d+\./).filter(step => step.trim().length > 0);
                }
            }

            // Ensure we have an array
            if (!Array.isArray(parsedInstructions)) {
                parsedInstructions = [parsedInstructions.toString()];
            }

            if (parsedInstructions.length === 0) {
                stepsContainer.innerHTML = `
                                            <div class="text-center py-8">
                                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <i data-lucide="info" class="w-8 h-8 text-gray-400"></i>
                                                </div>
                                                <p class="text-gray-500">Langkah-langkah belum tersedia untuk olahraga ini.</p>
                                                <p class="text-gray-400 text-sm mt-2">Lakukan olahraga sesuai kemampuan Anda.</p>
                                            </div>
                                        `;
                if (typeof lucide !== 'undefined') lucide.createIcons();
                return;
            }

            let stepsHTML = '<div class="space-y-4">';
            parsedInstructions.forEach((step, index) => {
                // Handle both object and string formats
                const stepText = typeof step === 'object' ? (step.description || step.text || step.toString()) : step.toString().trim();
                const stepImage = typeof step === 'object' ? step.image : null;
                const stepDuration = typeof step === 'object' ? step.duration : null;

                if (stepText.length === 0) return; // Skip empty steps

                stepsHTML += `
                                            <div class="flex space-x-4 p-4 bg-gray-50 rounded-xl border border-gray-200 hover:bg-gray-100 transition-colors">
                                                <div class="flex-shrink-0">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                                        ${index + 1}
                                                    </div>
                                                </div>
                                                <div class="flex-1">
                                                    ${stepImage ? `
                                                        <div class="mb-3">
                                                            <img src="${stepImage}" alt="Langkah ${index + 1}" 
                                                                 class="w-full h-32 object-cover rounded-lg border border-gray-200 cursor-pointer hover:scale-105 transition-transform"
                                                                 onclick="openImageModal('${stepImage}', 'Langkah ${index + 1}')">
                                                        </div>
                                                    ` : ''}
                                                    <p class="text-gray-700 leading-relaxed">${stepText}</p>
                                                    ${stepDuration ? `
                                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                                            <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                                            <span>Durasi: ${stepDuration}</span>
                                                        </div>
                                                    ` : ''}
                                                </div>
                                            </div>
                                        `;
            });
            stepsHTML += '</div>';

            stepsContainer.innerHTML = stepsHTML;

            // Reinitialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        }

        function displayExerciseError(errorMessage = 'Terjadi kesalahan saat memuat detail olahraga.') {
            document.getElementById('exerciseDetailLoading').classList.add('hidden');
            document.getElementById('exerciseDetailContent').innerHTML = `
                                            <div class="text-center py-12">
                                                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                                    <i data-lucide="alert-circle" class="w-8 h-8 text-red-500"></i>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Gagal Memuat Detail</h3>
                                                <p class="text-gray-600 mb-4">${errorMessage}</p>
                                                <div class="space-y-2 mb-4">
                                                    <button onclick="fetchExerciseDetails(${currentExerciseId})" 
                                                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                                        Coba Lagi
                                                    </button>
                                                    <button onclick="closeExerciseDetailModal()" 
                                                        class="block mx-auto px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                                        Tutup
                                                    </button>
                                                </div>
                                                <details class="text-left bg-gray-50 p-4 rounded-lg">
                                                    <summary class="cursor-pointer text-sm font-medium text-gray-600 mb-2">Detail Error</summary>
                                                    <pre class="text-xs text-gray-500 whitespace-pre-wrap">${errorMessage}</pre>
                                                </details>
                                            </div>
                                        `;
            document.getElementById('exerciseDetailContent').classList.remove('hidden');

            // Reinitialize Lucide icons
            lucide.createIcons();
        }

        // Image Modal for exercise step images
        function openImageModal(imageSrc, title) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-[60] p-4';
            modal.innerHTML = `
                                                    <div class="relative max-w-4xl max-h-full">
                                                        <button onclick="this.parentElement.parentElement.remove()" 
                                                            class="absolute -top-4 -right-4 w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-gray-800 z-10">
                                                            <i data-lucide="x" class="w-5 h-5"></i>
                                                        </button>
                                                        <img src="${imageSrc}" alt="${title}" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                                                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4 rounded-b-lg">
                                                            <p class="text-center font-medium">${title}</p>
                                                        </div>
                                                    </div>
                                                `;

            document.body.appendChild(modal);

            // Close on click outside
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.remove();
                }
            });

            // Reinitialize Lucide icons
            lucide.createIcons();
        }

        // Close detail modal when clicking outside
        document.getElementById('exerciseDetailModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeExerciseDetailModal();
            }
        });
    </script>
@endsection