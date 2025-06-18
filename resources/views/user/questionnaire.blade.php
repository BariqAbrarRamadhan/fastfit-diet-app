@extends('layouts.app')

@section('title', 'Kuesioner')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 relative overflow-hidden">
        <!-- Enhanced Decorative Background Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-orange-200/10 to-purple-200/10 rounded-full -translate-x-48 -translate-y-48 animate-pulse">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-tl from-purple-200/10 to-orange-200/10 rounded-full translate-x-48 translate-y-48 animate-pulse">
        </div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-orange-100/5 to-purple-100/5 rounded-full animate-spin"
            style="animation-duration: 20s;"></div>

        <div class="relative z-10 container mx-auto px-4 py-8 flex-1 flex flex-col min-h-screen">
            <!-- Enhanced Back Button -->
            <div class="mb-8 animate-fade-in-down">
                <a href="{{ url('/') }}"
                    class="group inline-flex items-center px-6 py-3 text-orange-500 hover:text-white bg-white/80 hover:bg-gradient-to-r hover:from-orange-500 hover:to-purple-600 backdrop-blur-sm border border-orange-200 hover:border-transparent rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-2 group-hover:animate-pulse"></i>
                    <span class="font-medium">Kembali ke Beranda</span>
                </a>
            </div>

            <!-- Enhanced Main Card -->
            <div
                class="max-w-5xl mx-auto w-full bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 overflow-hidden animate-fade-in-up">
                <!-- Card Header with Gradient -->
                <div class="">
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8">
                        @if ($currentStep <= $totalSteps)
                            <!-- Enhanced Progress Indicator -->
                            <div class="w-full mb-10">
                                <div class="flex justify-between items-center mb-6">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-10 h-10 bg-orange-400 rounded-full flex items-center justify-center shadow-lg">
                                            <span class="text-white text-sm font-bold">{{ $currentStep }}</span>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-700">
                                                Langkah {{ $currentStep }} dari {{ $totalSteps }}
                                            </span>
                                            <div class="text-xs text-gray-500">Kuesioner Kesehatan</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="text-lg font-bold text-transparent bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text">
                                            {{ round(($currentStep / $totalSteps) * 100) }}%
                                        </span>
                                        <div class="w-16 h-16 relative">
                                            <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                                                <path class="text-gray-200" stroke="currentColor" stroke-width="2" fill="none"
                                                    d="M18 2.0845
                                                                                            a 15.9155 15.9155 0 0 1 0 31.831
                                                                                            a 15.9155 15.9155 0 0 1 0 -31.831" />
                                                <path stroke="url(#progressGradient)" stroke-width="3" fill="none"
                                                    stroke-dasharray="{{ ($currentStep / $totalSteps) * 100 }}, 100"
                                                    stroke-linecap="round" d="M18 2.0845
                                                                                            a 15.9155 15.9155 0 0 1 0 31.831
                                                                                            a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    class="progress-circle" />
                                                <defs>
                                                    <linearGradient id="progressGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                        <stop offset="0%" style="stop-color:#f97316;stop-opacity:1" />
                                                        <stop offset="100%" style="stop-color:#9333ea;stop-opacity:1" />
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <i data-lucide="heart" class="w-6 h-6 text-orange-500 animate-pulse"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full h-4 bg-gray-200 rounded-full overflow-hidden shadow-inner">
                                    <div class="h-full bg-gradient-to-r from-orange-500 to-purple-600 rounded-full transition-all duration-1000 ease-out shadow-lg progress-bar"
                                        style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
                                </div>
                                <!-- Step Dots -->
                                <div class="flex justify-center mt-6 space-x-2">
                                    @for ($i = 1; $i <= $totalSteps; $i++)
                                        <div
                                            class="w-3 h-3 rounded-full transition-all duration-300 {{ $i <= $currentStep ? 'bg-purple-500 shadow-lg' : 'bg-gray-300 hover:bg-gray-400' }}">
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        @endif

                        <!-- Step Content -->
                        @if ($currentStep == 1)
                            <!-- Enhanced Step 1: Tujuan -->
                            <div class="space-y-8 animate-fade-in">
                                <div class="text-center space-y-6">
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-6 shadow-xl">
                                        <i data-lucide="target" class="w-12 h-12 text-orange-400"></i>
                                    </div>
                                    <h2
                                        class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4">
                                        Apa tujuan utama Anda?
                                    </h2>
                                    <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                        Pilih tujuan yang paling sesuai dengan kebutuhan Anda saat ini untuk mendapatkan program
                                        yang tepat dan personal
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 gap-6 mt-12">
                                    @php
                                        $goals = [
                                            'weight_loss' => [
                                                'label' => 'Penurunan Berat Badan',
                                                'description' => 'Menurunkan berat badan dengan cara yang sehat dan berkelanjutan melalui program diet yang tepat',
                                                'icon' => 'trending-down',
                                                'color' => 'from-red-400 to-orange-500',
                                                'bg' => 'from-red-50 to-orange-50'
                                            ],
                                            'maintain_weight' => [
                                                'label' => 'Menjaga Berat Badan',
                                                'description' => 'Mempertahankan berat badan ideal dan pola hidup sehat yang sudah tercapai',
                                                'icon' => 'activity',
                                                'color' => 'from-blue-400 to-cyan-500',
                                                'bg' => 'from-blue-50 to-cyan-50'
                                            ],
                                            'muscle_gain' => [
                                                'label' => 'Penambahan Massa Otot',
                                                'description' => 'Membangun massa otot dan meningkatkan kekuatan tubuh dengan program latihan yang intensif',
                                                'icon' => 'trending-up',
                                                'color' => 'from-green-400 to-emerald-500',
                                                'bg' => 'from-green-50 to-emerald-50'
                                            ]
                                        ];
                                    @endphp

                                    @foreach ($goals as $value => $goal)
                                        <form method="POST" action="{{ route('questionnaire.store', 1) }}" class="goal-option">
                                            @csrf
                                            <input type="hidden" name="goal" value="{{ $value }}">
                                            <button type="submit"
                                                class="group w-full p-8 border-3 border-gray-200 hover:border-transparent rounded-3xl text-left transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 bg-white hover:bg-gradient-to-br hover:{{ $goal['bg'] }} relative overflow-hidden">
                                                <!-- Gradient overlay on hover -->
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-r {{ $goal['color'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300 rounded-3xl">
                                                </div>

                                                <div class="relative flex items-center space-x-8">
                                                    <div
                                                        class="w-20 h-20 bg-gradient-to-r {{ $goal['color'] }} rounded-3xl flex items-center justify-center transform transition-all duration-300 group-hover:rotate-6 shadow-lg group-hover:shadow-xl">
                                                        <i data-lucide="{{ $goal['icon'] }}" class="w-10 h-10 text-white"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3
                                                            class="font-bold text-2xl mb-3 text-gray-800 group-hover:bg-clip-text transition-all duration-300">
                                                            {{ $goal['label'] }}
                                                        </h3>
                                                        <p
                                                            class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300 leading-relaxed">
                                                            {{ $goal['description'] }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                                        <div
                                                            class="w-12 h-12 bg-gradient-to-r {{ $goal['color'] }} rounded-full flex items-center justify-center shadow-lg">
                                                            <i data-lucide="arrow-right" class="w-6 h-6 text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>

                        @elseif ($currentStep == 2)
                            <!-- Enhanced Step 2: Informasi Pribadi -->
                            <div class="space-y-8 animate-fade-in">
                                <div class="text-center space-y-6">
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-6 shadow-xl">
                                        <i data-lucide="user" class="w-12 h-12 text-orange-400"></i>
                                    </div>
                                    <h2
                                        class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4">
                                        Informasi Pribadi
                                    </h2>
                                    <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                        Informasi ini membantu kami menyesuaikan program dengan kebutuhan spesifik Anda
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('questionnaire.store', 2) }}" class="space-y-8 mt-12">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="form-group"> <label for="gender"
                                                class="flex items-center text-sm font-bold text-gray-800 mb-3">
                                                <i data-lucide="users" class="w-4 h-4 mr-2 text-orange-500"></i>
                                                Jenis Kelamin
                                            </label>
                                            <select id="gender" name="gender"
                                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 bg-white hover:shadow-lg">
                                                <option value="" {{ !old('gender', $formData['gender'] ?? '') ? 'selected' : '' }} disabled>Pilih jenis kelamin</option>
                                                <option value="pria" {{ old('gender', $formData['gender'] ?? '') == 'pria' ? 'selected' : '' }}>Pria</option>
                                                <option value="wanita" {{ old('gender', $formData['gender'] ?? '') == 'wanita' ? 'selected' : '' }}>Wanita</option>
                                            </select> @error('gender')
                                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                                    <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                    {{ $errors->first('gender') }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div class="form-group"> <label for="age"
                                                class="flex items-center text-sm font-bold text-gray-800 mb-3">
                                                <i data-lucide="calendar" class="w-4 h-4 mr-2 text-orange-500"></i>
                                                Usia (tahun)
                                            </label>
                                            <input type="number" id="age" name="age"
                                                value="{{ old('age', $formData['age'] ?? '') }}" min="15" max="80"
                                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 hover:shadow-lg"
                                                placeholder="Masukkan usia Anda" /> @error('age')
                                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                        {{ $errors->first('age') }}
                                                    </p>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <div class="form-group"> <label for="height"
                                                class="flex items-center text-sm font-bold text-gray-800 mb-3">
                                                <i data-lucide="ruler" class="w-4 h-4 mr-2 text-orange-500"></i>
                                                Tinggi Badan (cm)
                                            </label>
                                            <input type="number" id="height" name="height"
                                                value="{{ old('height', $formData['height'] ?? '') }}" min="100" max="250"
                                                step="0.1"
                                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 hover:shadow-lg"
                                                placeholder="Masukkan tinggi badan Anda" /> @error('height')
                                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                        {{ $errors->first('height') }}
                                                    </p>
                                                @enderror
                                        </div>

                                        <div class="form-group"> <label for="weight"
                                                class="flex items-center text-sm font-bold text-gray-800 mb-3">
                                                <i data-lucide="scale" class="w-4 h-4 mr-2 text-orange-500"></i>
                                                Berat Badan Saat Ini (kg)
                                            </label>
                                            <input type="number" id="weight" name="weight"
                                                value="{{ old('weight', $formData['weight'] ?? '') }}" min="30" max="200"
                                                step="0.1"
                                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 hover:shadow-lg"
                                                placeholder="Masukkan berat badan Anda" /> @error('weight')
                                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                        {{ $errors->first('weight') }}
                                                    </p>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-12 pt-8 border-t border-gray-200">
                                        @if ($currentStep > 1)
                                            <button type="button" onclick="goBack()"
                                                class="px-8 py-4 border-2 border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium flex items-center cursor-pointer">
                                                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                                Kembali
                                            </button>
                                        @else
                                            <div></div>
                                        @endif
                                        <button type="submit"
                                            class="px-8 py-4 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center">
                                            Lanjutkan
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        @elseif ($currentStep == 3)
                            <!-- Enhanced Step 3: Tingkat Aktivitas -->
                            <div class="space-y-8 animate-fade-in">
                                <div class="text-center space-y-6">
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-6 shadow-xl">
                                        <i data-lucide="activity" class="w-12 h-12 text-orange-400"></i>
                                    </div>
                                    <h2
                                        class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4">
                                        Tingkat Aktivitas Harian
                                    </h2>
                                    <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                        Pilih tingkat aktivitas yang paling mendekati rutinitas harian Anda untuk perhitungan
                                        kalori yang akurat
                                    </p>
                                </div>

                                <div class="space-y-6 mt-12">
                                    @php
                                        $activities = [
                                            'sedentary' => [
                                                'title' => 'Tidak Aktif',
                                                'description' => 'Pekerjaan meja, hampir tidak ada aktivitas fisik, jarang berolahraga',
                                                'icon' => 'laptop',
                                                'color' => 'from-red-400 to-pink-500'
                                            ],
                                            'moderately_active' => [
                                                'title' => 'Cukup Aktif',
                                                'description' => 'Aktivitas sedang 3-5 hari/minggu, olahraga ringan hingga sedang',
                                                'icon' => 'zap',
                                                'color' => 'from-blue-400 to-cyan-500'
                                            ],
                                            'extra_active' => [
                                                'title' => 'Ekstra Aktif',
                                                'description' => 'Aktivitas sangat berat atau latihan intens 6-7 hari/minggu',
                                                'icon' => 'flame',
                                                'color' => 'from-green-400 to-emerald-500'
                                            ]
                                        ];
                                    @endphp

                                    @foreach ($activities as $value => $activity)
                                        <form method="POST" action="{{ route('questionnaire.store', 3) }}">
                                            @csrf
                                            <input type="hidden" name="activity_level" value="{{ $value }}">
                                            <button type="submit"
                                                class="group w-full p-8 border-3 border-gray-200 hover:border-transparent rounded-3xl text-left transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 bg-white relative overflow-hidden">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-r {{ $activity['color'] }} opacity-0 group-hover:opacity-5 transition-opacity duration-300 rounded-3xl">
                                                </div>

                                                <div class="relative flex items-center space-x-8">
                                                    <div
                                                        class="w-20 h-20 bg-gradient-to-r {{ $activity['color'] }} rounded-3xl flex items-center justify-center transform transition-all duration-300 group-hover:rotate-6 shadow-lg">
                                                        <i data-lucide="{{ $activity['icon'] }}" class="w-10 h-10 text-white"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3
                                                            class="font-bold text-2xl mb-3 text-gray-800 group-hover:bg-clip-text transition-all duration-300">
                                                            {{ $activity['title'] }}
                                                        </h3>
                                                        <p
                                                            class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300 leading-relaxed">
                                                            {{ $activity['description'] }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                                        <div
                                                            class="w-12 h-12 bg-gradient-to-r {{ $activity['color'] }} rounded-full flex items-center justify-center shadow-lg">
                                                            <i data-lucide="arrow-right" class="w-6 h-6 text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>

                                <div class="flex justify-between items-center mt-12 pt-8 border-t border-gray-200">
                                    @if ($currentStep > 1)
                                        <button type="button" onclick="goBack()"
                                            class="px-8 py-4 border-2 border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium flex items-center cursor-pointer">
                                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                            Kembali
                                        </button>
                                    @endif
                                </div>
                            </div>

                        @elseif ($currentStep == 4)
                            <!-- Enhanced Step 4: Target Berat Badan -->
                            <div class="space-y-8 animate-fade-in">
                                <div class="text-center space-y-6">
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-6 shadow-xl">
                                        <i data-lucide="target" class="w-12 h-12 text-orange-400"></i>
                                    </div>
                                    <h2
                                        class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4">
                                        Target Berat Badan
                                    </h2>
                                    <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                        Masukkan target berat badan yang realistis dan ingin Anda capai
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('questionnaire.store', 4) }}" class="space-y-8 mt-12">
                                    @csrf
                                    <div class="max-w-md mx-auto">
                                        <div
                                            class="bg-gradient-to-r from-orange-50 to-purple-50 p-6 rounded-2xl border border-orange-200 mb-6">
                                            <div class="text-center">
                                                <i data-lucide="info" class="w-8 h-8 text-orange-500 mx-auto mb-2"></i>
                                                <p class="text-sm font-medium text-gray-700">Berat Badan Ideal Anda</p>
                                                <p class="text-3xl font-bold text-orange-500">{{ $beratBadanIdeal ?? '65' }} kg
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group"> <label for="target_weight"
                                                class="flex items-center justify-center text-sm font-bold text-gray-800 mb-3">
                                                <i data-lucide="target" class="w-4 h-4 mr-2 text-orange-500"></i>
                                                Target Berat Badan (kg)
                                            </label>
                                            <input type="number" id="target_weight" name="target_weight"
                                                value="{{ old('target_weight', $formData['target_weight'] ?? $beratBadanIdeal ?? '65') }}"
                                                min="30" max="200" step="0.1"
                                                class="w-full px-6 py-4 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 hover:shadow-lg text-center text-xl font-bold"
                                                placeholder="Masukkan target berat badan" required /> @error('target_weight')
                                                    <p class="text-red-500 text-sm mt-2 flex items-center justify-center">
                                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                        {{ $errors->first('target_weight') }}
                                                    </p>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-between items-center mt-12 pt-8 border-t border-gray-200">
                                        @if ($currentStep > 1)
                                            <button type="button" onclick="goBack()"
                                                class="px-8 py-4 border-2 border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium flex items-center cursor-pointer">
                                                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                                Kembali
                                            </button>
                                        @else
                                            <div></div>
                                        @endif
                                        <button type="submit"
                                            class="px-8 py-4 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center">
                                            Lanjutkan
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        @elseif (in_array($currentStep, [5, 6, 7]))
                            <!-- Enhanced Health Questions (Steps 5-7) -->
                            <div class="space-y-8 animate-fade-in">
                                @php
                                    $healthQuestions = [
                                        5 => [
                                            'title' => 'Riwayat Penyakit Jantung',
                                            'question' => 'Apakah Anda memiliki riwayat penyakit jantung?',
                                            'icon' => 'heart',
                                            'field' => 'is_heart_disease',
                                            'details' => [
                                                'description' => 'Penyakit jantung adalah kondisi medis yang mempengaruhi fungsi jantung dan pembuluh darah, termasuk berbagai kelainan pada jantung dan sistem kardiovaskular.',
                                                'types' => [
                                                    'Penyakit Jantung Koroner (PJK)' => 'Penyumbatan pada arteri yang memasok darah ke otot jantung',
                                                    'Gagal Jantung' => 'Kondisi ketika jantung tidak dapat memompa darah secara efektif',
                                                    'Aritmia' => 'Gangguan irama jantung yang tidak normal',
                                                    'Penyakit Katup Jantung' => 'Kelainan pada katup-katup jantung yang mengatur aliran darah'
                                                ],
                                                'symptoms' => [
                                                    'Nyeri dada atau ketidaknyamanan',
                                                    'Sesak napas',
                                                    'Kelelahan yang tidak biasa',
                                                    'Pembengkakan pada kaki atau pergelangan kaki',
                                                    'Detak jantung tidak teratur'
                                                ],
                                                'impact_on_diet' => 'Penderita penyakit jantung memerlukan diet rendah sodium, lemak jenuh terbatas, dan peningkatan konsumsi omega-3 serta serat.'
                                            ]
                                        ],
                                        6 => [
                                            'title' => 'Riwayat Hipertensi',
                                            'question' => 'Apakah Anda memiliki riwayat hipertensi?',
                                            'icon' => 'activity',
                                            'field' => 'is_hypertension',
                                            'details' => [
                                                'description' => 'Hipertensi atau tekanan darah tinggi adalah kondisi ketika tekanan darah dalam arteri meningkat secara persisten, yaitu ≥140/90 mmHg.',
                                                'types' => [
                                                    'Hipertensi Primer' => 'Hipertensi yang tidak diketahui penyebab pastinya (90% kasus)',
                                                    'Hipertensi Sekunder' => 'Hipertensi yang disebabkan oleh kondisi medis lain seperti penyakit ginjal'
                                                ],
                                                'symptoms' => [
                                                    'Sakit kepala (terutama di belakang kepala)',
                                                    'Pusing atau vertigo',
                                                    'Penglihatan kabur',
                                                    'Nyeri dada',
                                                    'Kelelahan',
                                                    'Mimisan (pada kasus berat)'
                                                ],
                                                'impact_on_diet' => 'Penderita hipertensi membutuhkan diet rendah sodium (garam), DASH diet, peningkatan kalium, dan pembatasan alkohol.'
                                            ]
                                        ],
                                        7 => [
                                            'title' => 'Riwayat Dislipidemia',
                                            'question' => 'Apakah Anda memiliki riwayat dislipidemia?',
                                            'icon' => 'droplet',
                                            'field' => 'is_dyslipidemia',
                                            'details' => [
                                                'description' => 'Dislipidemia adalah gangguan metabolisme lipid yang ditandai dengan peningkatan atau penurunan kadar lemak dalam darah di luar batas normal.',
                                                'types' => [
                                                    'Hiperkolesterolemia' => 'Kadar kolesterol total tinggi (>200 mg/dL)',
                                                    'LDL Tinggi' => 'Kolesterol jahat tinggi (>100 mg/dL)',
                                                    'HDL Rendah' => 'Kolesterol baik rendah (<40 mg/dL pria, <50 mg/dL wanita)',
                                                    'Hipertrigliseridemia' => 'Kadar trigliserida tinggi (>150 mg/dL)'
                                                ],
                                                'symptoms' => [
                                                    'Umumnya tidak ada gejala (silent disease)',
                                                    'Dapat menyebabkan plaque di arteri',
                                                    'Meningkatkan risiko stroke dan serangan jantung',
                                                    'Pada kasus berat: xanthoma (benjolan kuning di kulit)'
                                                ],
                                                'impact_on_diet' => 'Memerlukan diet rendah lemak jenuh dan trans, peningkatan serat larut, omega-3, dan kontrol porsi makanan.'
                                            ]
                                        ]
                                    ];
                                    $stepNumber = (int) $currentStep;
                                    $current = null;
                                    if ($stepNumber >= 5 && $stepNumber <= 7 && isset($healthQuestions[$stepNumber])) {
                                        $current = $healthQuestions[$stepNumber];
                                    } else {
                                        $current = $healthQuestions[5];
                                    }
                                @endphp

                                <div class="text-center space-y-6">
                                    <div class="w-24 h-24 rounded-full mx-auto flex items-center justify-center mb-6 shadow-xl">
                                        <i data-lucide="{{ $current['icon'] }}" class="w-12 h-12 text-orange-400"></i>
                                    </div>
                                    <div
                                        class="flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-4">
                                        <h2
                                            class="text-3xl sm:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4 text-center">
                                            {{ $current['title'] }}
                                        </h2>
                                        <button type="button" onclick="openDiseaseModal({{ $currentStep }})"
                                            class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full flex items-center justify-center hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110 flex-shrink-0">
                                            <i data-lucide="info" class="w-5 h-5 text-white"></i>
                                        </button>
                                    </div>
                                    <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                        {{ $current['question'] }}
                                    </p>
                                    <div class="flex items-center justify-center space-x-2 text-sm text-blue-600">
                                        <i data-lucide="info" class="w-4 h-4"></i>
                                        <span>Klik tombol info untuk mengetahui detail penyakit</span>
                                    </div>
                                    <p class="text-sm text-gray-500">Informasi ini membantu kami memberikan rekomendasi yang
                                        aman</p>
                                </div>

                                <div class="space-y-6 mt-12 max-w-2xl mx-auto">
                                    @foreach ([1 => 'Ya, Saya Memiliki', 0 => 'Tidak, Saya Tidak Memiliki'] as $value => $label)
                                        <form method="POST" action="{{ route('questionnaire.store', $currentStep) }}">
                                            @csrf
                                            <input type="hidden" name="{{ $current['field'] }}" value="{{ $value }}">
                                            <button type="submit"
                                                class="group w-full p-8 border-3 border-gray-200 hover:border-transparent rounded-3xl text-left transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 bg-white relative overflow-hidden">
                                                @php
                                                    $colors = $value ? 'from-green-400 to-emerald-500' : 'from-blue-400 to-cyan-500';
                                                    $iconName = $value ? 'check-circle' : 'x-circle';
                                                @endphp

                                                <div
                                                    class="absolute inset-0 bg-gradient-to-r {{ $colors }} opacity-0 group-hover:opacity-5 transition-opacity duration-300 rounded-3xl">
                                                </div>

                                                <div class="relative flex items-center space-x-8">
                                                    <div
                                                        class="w-20 h-20 bg-gradient-to-r {{ $colors }} rounded-3xl flex items-center justify-center transform transition-all duration-300 group-hover:rotate-6 shadow-lg">
                                                        <i data-lucide="{{ $iconName }}" class="w-10 h-10 text-white"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3
                                                            class="font-bold text-2xl mb-3 text-gray-800 clip-text transition-all duration-300">
                                                            {{ $label }}
                                                        </h3>
                                                        <p
                                                            class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">
                                                            {{ $value ? 'Memiliki riwayat atau sedang dalam pengobatan' : 'Tidak memiliki riwayat kondisi kesehatan ini' }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0">
                                                        <div
                                                            class="w-12 h-12 bg-gradient-to-r {{ $colors }} rounded-full flex items-center justify-center shadow-lg">
                                                            <i data-lucide="arrow-right" class="w-6 h-6 text-white"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </form>
                                    @endforeach
                                </div>

                                <div class="flex justify-between items-center mt-12 pt-8 border-t border-gray-200">
                                    @if ($currentStep > 1)
                                        <button type="button" onclick="goBack()"
                                            class="px-8 py-4 border-2 border-gray-300 text-gray-600 rounded-xl hover:bg-gray-50 transition-all duration-300 font-medium flex items-center cursor-pointer">
                                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                            Kembali
                                        </button>
                                    @endif
                                </div>
                            </div>

                        @elseif ($currentStep == 8)
                            <!-- Enhanced Completion Page -->
                            <div class="text-center space-y-8 animate-fade-in">
                                <div class="relative">
                                    <div
                                        class="w-32 h-32 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full mx-auto flex items-center justify-center mb-8 shadow-2xl">
                                        <i data-lucide="check-circle-2" class="w-16 h-16 text-white"></i>
                                    </div>
                                    <!-- Floating celebration particles -->
                                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-40 h-40">
                                        <div class="absolute w-4 h-4 bg-orange-400 rounded-full animate-ping"
                                            style="top: 10%; left: 20%;"></div>
                                        <div class="absolute w-3 h-3 bg-purple-400 rounded-full animate-pulse"
                                            style="top: 30%; right: 10%; animation-delay: 0.5s;"></div>
                                        <div class="absolute w-5 h-5 bg-green-400 rounded-full"
                                            style="bottom: 20%; left: 10%; animation-delay: 1s;"></div>
                                        <div class="absolute w-3 h-3 bg-blue-400 rounded-full animate-ping"
                                            style="bottom: 10%; right: 20%; animation-delay: 1.5s;"></div>
                                    </div>
                                </div>

                                <h2
                                    class="text-5xl font-bold bg-gradient-to-r from-green-500 to-emerald-600 bg-clip-text text-transparent">
                                    Kuesioner Selesai!
                                </h2>
                                <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                                    Terima kasih telah mengisi kuesioner dengan lengkap. Sekarang kami akan menyiapkan program
                                    yang tepat untuk Anda.
                                </p>

                                @if (session('error'))
                                    <div
                                        class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl max-w-md mx-auto flex items-center">
                                        <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="mt-12">
                                    <form method="POST" action="{{ route('questionnaire.submit') }}">
                                        @csrf
                                        <button type="submit"
                                            class="group px-12 py-6 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl text-xl font-bold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-2 flex items-center mx-auto">
                                            <i data-lucide="sparkles" class="w-6 h-6 mr-3 group-hover:animate-spin"></i>
                                            Lihat Rekomendasi Program
                                            <i data-lucide="arrow-right"
                                                class="w-6 h-6 ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-4xl mx-auto">
                                    <div
                                        class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-2xl border border-orange-200">
                                        <i data-lucide="utensils" class="w-8 h-8 text-orange-500 mx-auto mb-3"></i>
                                        <h3 class="font-bold text-gray-800 mb-2">Program Diet</h3>
                                        <p class="text-sm text-gray-600">Rekomendasi makanan yang sesuai</p>
                                    </div>
                                    <div
                                        class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-2xl border border-purple-200">
                                        <i data-lucide="dumbbell" class="w-8 h-8 text-purple-500 mx-auto mb-3"></i>
                                        <h3 class="font-bold text-gray-800 mb-2">Program Olahraga</h3>
                                        <p class="text-sm text-gray-600">Latihan yang tepat untuk Anda</p>
                                    </div>
                                    <div
                                        class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-2xl border border-green-200">
                                        <i data-lucide="heart" class="w-8 h-8 text-green-500 mx-auto mb-3"></i>
                                        <h3 class="font-bold text-gray-800 mb-2">Pantauan Kesehatan</h3>
                                        <p class="text-sm text-gray-600">Tracking progress harian</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Enhanced Footer -->
            <footer class="mt-16 text-center text-gray-500 animate-fade-in-up">
                <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 max-w-md mx-auto">
                    <p class="flex items-center justify-center">
                        <i data-lucide="heart" class="w-4 h-4 mr-2 text-red-500 animate-pulse"></i>
                        © {{ now()->year }} Platform Diet & Olahraga
                    </p>
                    <p class="text-sm mt-1">Tugas Akhir - Sistem Rekomendasi Diet</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Disease Information Modal -->
    <div id="diseaseModal"
        class="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 opacity-0 invisible transition-all duration-300 flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-[90vh] w-full overflow-hidden">
            <div class="bg-white rounded-2xl shadow-2xl max-h-[100vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-orange-500 to-purple-600 p-6 text-white relative">
                    <button onclick="closeDiseaseModal()"
                        class="absolute top-4 right-4 w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-colors">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <i id="modalIcon" data-lucide="heart" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 id="modalTitle" class="text-2xl font-bold">Informasi Penyakit</h3>
                            <p class="text-white/90">Detail medis dan dampak terhadap diet</p>
                        </div>
                    </div>
                </div> <!-- Modal Content -->
                <div class="p-6 space-y-6 modal-content">
                    <!-- Description -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 info-card">
                        <h4 class="font-bold text-blue-900 mb-2 flex items-center">
                            <i data-lucide="book-open" class="w-4 h-4 mr-2"></i>
                            Definisi
                        </h4>
                        <p id="modalDescription" class="text-blue-800 leading-relaxed"></p>
                    </div>

                    <!-- Types -->
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 info-card">
                        <h4 class="font-bold text-green-900 mb-3 flex items-center">
                            <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                            Jenis-jenis
                        </h4>
                        <div id="modalTypes" class="space-y-2"></div>
                    </div>

                    <!-- Symptoms -->
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 info-card">
                        <h4 class="font-bold text-yellow-900 mb-3 flex items-center">
                            <i data-lucide="alert-triangle" class="w-4 h-4 mr-2"></i>
                            Gejala Umum
                        </h4>
                        <div id="modalSymptoms" class="grid grid-cols-1 md:grid-cols-2 gap-2"></div>
                    </div>

                    <!-- Impact on Diet -->
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 info-card">
                        <h4 class="font-bold text-orange-900 mb-2 flex items-center">
                            <i data-lucide="utensils" class="w-4 h-4 mr-2"></i>
                            Dampak pada Diet
                        </h4>
                        <p id="modalDietImpact" class="text-orange-800 leading-relaxed"></p>
                    </div>

                    <!-- Disclaimer -->
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 info-card">
                        <h4 class="font-bold text-red-900 mb-2 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                            Penting untuk Diingat
                        </h4>
                        <p class="text-red-800 text-sm leading-relaxed">
                            Informasi ini hanya untuk edukasi. Selalu konsultasikan dengan dokter atau ahli kesehatan
                            untuk diagnosis dan pengobatan yang tepat. Jangan gunakan informasi ini sebagai pengganti
                            saran medis profesional.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.6s ease-out;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.6s ease-out;
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }

        .progress-circle {
            transition: stroke-dasharray 1s ease-in-out;
        }

        .progress-bar {
            position: relative;
            overflow: hidden;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .goal-option button:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* Modal Styles */
        #diseaseModal {
            backdrop-filter: blur(8px);
        }

        #diseaseModal .bg-white {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-content {
            max-height: calc(80vh - 2rem);
            overflow-y: auto;
        }

        .info-card {
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            #diseaseModal .max-w-4xl {
                max-width: 95vw;
                margin: 1rem;
            }

            #diseaseModal .p-6 {
                padding: 1rem;
            }

            #diseaseModal .grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script>
        // Disease information data
        const diseaseInfo = {
            5: {
                title: 'Riwayat Penyakit Jantung',
                icon: 'heart',
                description: 'Penyakit jantung adalah kondisi medis yang mempengaruhi fungsi jantung dan pembuluh darah, termasuk berbagai kelainan pada jantung dan sistem kardiovaskular.',
                types: {
                    'Penyakit Jantung Koroner (PJK)': 'Penyumbatan pada arteri yang memasok darah ke otot jantung',
                    'Gagal Jantung': 'Kondisi ketika jantung tidak dapat memompa darah secara efektif',
                    'Aritmia': 'Gangguan irama jantung yang tidak normal',
                    'Penyakit Katup Jantung': 'Kelainan pada katup-katup jantung yang mengatur aliran darah'
                },
                symptoms: [
                    'Nyeri dada atau ketidaknyamanan',
                    'Sesak napas',
                    'Kelelahan yang tidak biasa',
                    'Pembengkakan pada kaki atau pergelangan kaki',
                    'Detak jantung tidak teratur'
                ],
                dietImpact: 'Penderita penyakit jantung memerlukan diet rendah sodium, lemak jenuh terbatas, dan peningkatan konsumsi omega-3 serta serat.'
            },
            6: {
                title: 'Riwayat Hipertensi',
                icon: 'activity',
                description: 'Hipertensi atau tekanan darah tinggi adalah kondisi ketika tekanan darah dalam arteri meningkat secara persisten, yaitu ≥140/90 mmHg.',
                types: {
                    'Hipertensi Primer': 'Hipertensi yang tidak diketahui penyebab pastinya (90% kasus)',
                    'Hipertensi Sekunder': 'Hipertensi yang disebabkan oleh kondisi medis lain seperti penyakit ginjal'
                },
                symptoms: [
                    'Sakit kepala (terutama di belakang kepala)',
                    'Pusing atau vertigo',
                    'Penglihatan kabur',
                    'Nyeri dada',
                    'Kelelahan',
                    'Mimisan (pada kasus berat)'
                ],
                dietImpact: 'Penderita hipertensi membutuhkan diet rendah sodium (garam), DASH diet, peningkatan kalium, dan pembatasan alkohol.'
            },
            7: {
                title: 'Riwayat Dislipidemia',
                icon: 'droplet',
                description: 'Dislipidemia adalah gangguan metabolisme lipid yang ditandai dengan peningkatan atau penurunan kadar lemak dalam darah di luar batas normal.',
                types: {
                    'Hiperkolesterolemia': 'Kadar kolesterol total tinggi (>200 mg/dL)',
                    'LDL Tinggi': 'Kolesterol jahat tinggi (>100 mg/dL)',
                    'HDL Rendah': 'Kolesterol baik rendah (<40 mg/dL pria, <50 mg/dL wanita)',
                    'Hipertrigliseridemia': 'Kadar trigliserida tinggi (>150 mg/dL)'
                },
                symptoms: [
                    'Umumnya tidak ada gejala (silent disease)',
                    'Dapat menyebabkan plaque di arteri',
                    'Meningkatkan risiko stroke dan serangan jantung',
                    'Pada kasus berat: xanthoma (benjolan kuning di kulit)'
                ],
                dietImpact: 'Memerlukan diet rendah lemak jenuh dan trans, peningkatan serat larut, omega-3, dan kontrol porsi makanan.'
            }
        };

        function openDiseaseModal(step) {
            const modal = document.getElementById('diseaseModal');
            const info = diseaseInfo[step];

            if (!info) return;

            // Update modal content
            document.getElementById('modalTitle').textContent = info.title;
            document.getElementById('modalIcon').setAttribute('data-lucide', info.icon);
            document.getElementById('modalDescription').textContent = info.description;
            document.getElementById('modalDietImpact').textContent = info.dietImpact;

            // Update types
            const typesContainer = document.getElementById('modalTypes');
            typesContainer.innerHTML = '';
            Object.entries(info.types).forEach(([type, description]) => {
                const typeDiv = document.createElement('div');
                typeDiv.className = 'flex items-start space-x-2 text-green-800';
                typeDiv.innerHTML = `
                                <i data-lucide="check-circle" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <span class="font-semibold">${type}:</span>
                                    <span class="ml-1">${description}</span>
                                </div>
                            `;
                typesContainer.appendChild(typeDiv);
            });

            // Update symptoms
            const symptomsContainer = document.getElementById('modalSymptoms');
            symptomsContainer.innerHTML = '';
            info.symptoms.forEach(symptom => {
                const symptomDiv = document.createElement('div');
                symptomDiv.className = 'flex items-center space-x-2 text-yellow-800 text-sm';
                symptomDiv.innerHTML = `
                                <i data-lucide="circle" class="w-3 h-3 fill-current"></i>
                                <span>${symptom}</span>
                            `;
                symptomsContainer.appendChild(symptomDiv);
            });

            // Show modal with transition
            modal.classList.remove('opacity-0', 'invisible');
            modal.classList.add('opacity-100', 'visible');
            document.body.style.overflow = 'hidden';

            // Reinitialize Lucide icons
            lucide.createIcons();

            // Close modal when clicking outside
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeDiseaseModal();
                }
            });
        }

        function closeDiseaseModal() {
            const modal = document.getElementById('diseaseModal');
            modal.classList.add('opacity-0', 'invisible');
            modal.classList.remove('opacity-100', 'visible');
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDiseaseModal();
            }
        });

        function goBack() {
            fetch('{{ route('questionnaire.back') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert('Terjadi kesalahan saat kembali.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat kembali.');
                });
        }

        // Initialize Lucide icons
        lucide.createIcons();

        // Add form validation animations
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('input[type="number"], select');

            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    if (this.value) {
                        this.classList.add('border-green-500');
                        this.classList.remove('border-gray-300');
                    } else {
                        this.classList.remove('border-green-500');
                        this.classList.add('border-gray-300');
                    }
                });
            });

            // Animate progress circle
            const progressCircle = document.querySelector('.progress-circle');
            if (progressCircle) {
                setTimeout(() => {
                    progressCircle.style.strokeDasharray = progressCircle.getAttribute('stroke-dasharray');
                }, 500);
            }
        });
    </script>
@endsection