@extends('admin.layouts.app')

@section('title', 'Edit Rekomendasi Olahraga')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Edit Rekomendasi Olahraga</h1>
                        <p class="mt-2 text-gray-600">Perbarui informasi rekomendasi olahraga</p>
                    </div>
                    <a href="{{ route('admin.exercise-recommendations.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Form Section -->
                <div class="lg:col-span-3">
                    <form method="POST" action="{{ route('admin.exercise-recommendations.update', $exerciseRecommendation) }}" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Informasi Dasar
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Olahraga <span class="text-red-500">*</span>
                                    </label>                                    <div class="relative">
                                        <input type="text" 
                                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}"
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $exerciseRecommendation->name) }}"
                                               placeholder="Contoh: Push Up, Jogging, Yoga">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>                                    <textarea class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }}" 
                                              id="description"
                                              name="description" 
                                              rows="4"
                                              placeholder="Jelaskan apa itu olahraga ini dan manfaatnya...">{{ old('description', $exerciseRecommendation->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>                        <!-- Classification -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Klasifikasi
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kategori <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('category') ? 'border-red-500' : 'border-gray-300' }}" 
                                                    id="category" name="category">
                                                <option value="">Pilih Kategori</option>
                                                @foreach($categories as $key => $value)
                                                    <option value="{{ $key }}" {{ old('category', $exerciseRecommendation->category) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('category')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="difficulty_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tingkat Kesulitan <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('difficulty_level') ? 'border-red-500' : 'border-gray-300' }}"
                                                    id="difficulty_level" name="difficulty_level">
                                                <option value="">Pilih Tingkat Kesulitan</option>
                                                @foreach($difficulties as $key => $value)
                                                    <option value="{{ $key }}" {{ old('difficulty_level', $exerciseRecommendation->difficulty_level) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('difficulty_level')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Muscle Groups -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Kelompok Otot yang Dilatih
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach(\App\Models\ExerciseRecommendation::getMuscleGroups() as $key => $value)
                                        <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-all duration-200">
                                            <input type="checkbox" 
                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2" 
                                                   name="muscle_groups[]" 
                                                   value="{{ $key }}"
                                                   {{ in_array($key, old('muscle_groups', $exerciseRecommendation->muscle_groups ?: [])) ? 'checked' : '' }}>
                                            <span class="ml-3 text-sm font-medium text-gray-900">{{ $value }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                @error('muscle_groups')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>                        <!-- Target & Activity -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Target & Aktivitas
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="goal" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tujuan <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('goal') ? 'border-red-500' : 'border-gray-300' }}" 
                                                    id="goal" name="goal">
                                                <option value="">Pilih Tujuan</option>
                                                @foreach($goals as $key => $value)
                                                    <option value="{{ $key }}" {{ old('goal', $exerciseRecommendation->goal) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('goal')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="activity_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tingkat Aktivitas <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('activity_level') ? 'border-red-500' : 'border-gray-300' }}"
                                                    id="activity_level" name="activity_level">
                                                <option value="">Pilih Tingkat Aktivitas</option>
                                                @foreach($activityLevels as $key => $value)
                                                    <option value="{{ $key }}" {{ old('activity_level', $exerciseRecommendation->activity_level) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('activity_level')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Duration, Frequency & Calories -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Durasi, Frekuensi & Kalori
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                                            Durasi (menit) <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="number"
                                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('duration_minutes') ? 'border-red-500' : 'border-gray-300' }}"
                                                   id="duration_minutes" 
                                                   name="duration_minutes"
                                                   value="{{ old('duration_minutes', $exerciseRecommendation->duration_minutes) }}"
                                                   min="1" max="300" placeholder="30">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm">min</span>
                                            </div>
                                        </div>
                                        @error('duration_minutes')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="frequency_per_week" class="block text-sm font-medium text-gray-700 mb-2">
                                            Frekuensi per Minggu <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="number"
                                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('frequency_per_week') ? 'border-red-500' : 'border-gray-300' }}"
                                                   id="frequency_per_week" 
                                                   name="frequency_per_week"
                                                   value="{{ old('frequency_per_week', $exerciseRecommendation->frequency_per_week) }}"
                                                   min="1" max="7" placeholder="3">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm">x/week</span>
                                            </div>
                                        </div>
                                        @error('frequency_per_week')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="calories_burned_per_hour" class="block text-sm font-medium text-gray-700 mb-2">
                                            Kalori Terbakar/Jam
                                        </label>
                                        <div class="relative">
                                            <input type="number"
                                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('calories_burned_per_hour') ? 'border-red-500' : 'border-gray-300' }}"
                                                   id="calories_burned_per_hour" 
                                                   name="calories_burned_per_hour"
                                                   value="{{ old('calories_burned_per_hour', $exerciseRecommendation->calories_burned_per_hour) }}"
                                                   min="0" placeholder="300">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 text-sm">cal/h</span>
                                            </div>
                                        </div>
                                        @error('calories_burned_per_hour')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">Estimasi kalori yang terbakar per jam</p>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Equipment -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-gray-600 to-gray-800 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    Peralatan
                                </h3>
                            </div>
                            <div class="p-6">
                                <div>
                                    <label for="equipment_needed" class="block text-sm font-medium text-gray-700 mb-2">
                                        Peralatan yang Dibutuhkan
                                    </label>
                                    <div class="relative">
                                        <input type="text" 
                                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('equipment_needed') ? 'border-red-500' : 'border-gray-300' }}"
                                               id="equipment_needed" 
                                               name="equipment_needed"
                                               value="{{ old('equipment_needed', $exerciseRecommendation->equipment_needed) }}"
                                               placeholder="Contoh: Matras yoga, Dumbbell, Tidak ada">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('equipment_needed')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Media -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Media
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">
                                            Gambar Utama
                                        </label>
                                        <div class="relative">
                                            <input type="text" 
                                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('main_image') ? 'border-red-500' : 'border-gray-300' }}" 
                                                   id="main_image" 
                                                   name="main_image" 
                                                   value="{{ old('main_image', $exerciseRecommendation->main_image) }}" 
                                                   placeholder="URL gambar utama olahraga">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('main_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">URL gambar yang akan ditampilkan sebagai gambar utama</p>
                                    </div>
                                    
                                    <div>
                                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                            URL Video
                                        </label>
                                        <div class="relative">
                                            <input type="url" 
                                                   class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('video_url') ? 'border-red-500' : 'border-gray-300' }}" 
                                                   id="video_url" 
                                                   name="video_url" 
                                                   value="{{ old('video_url', $exerciseRecommendation->video_url) }}" 
                                                   placeholder="https://youtube.com/watch?v=...">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a4.5 4.5 0 110 9H9"/>
                                                </svg>
                                            </div>
                                        </div>
                                        @error('video_url')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">URL video tutorial (YouTube, Vimeo, dll)</p>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Instructions -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Instruksi/Cara Melakukan
                                </h3>
                            </div>
                            <div class="p-6">
                                <div>
                                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                                        Instruksi Umum
                                    </label>
                                    <textarea class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('instructions') ? 'border-red-500' : 'border-gray-300' }}" 
                                              id="instructions"
                                              name="instructions" 
                                              rows="6"
                                              placeholder="Jelaskan langkah-langkah detail cara melakukan olahraga ini...">{{ old('instructions', $exerciseRecommendation->instructions) }}</textarea>
                                    @error('instructions')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>                        <!-- Detailed Instructions -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                    Instruksi Detail (Step-by-Step)
                                </h3>
                            </div>
                            <div class="p-6">
                                <div id="detailed-instructions-container" class="space-y-4">
                                    @if(old('detailed_instructions') || $exerciseRecommendation->detailed_instructions)
                                        @foreach(old('detailed_instructions', $exerciseRecommendation->detailed_instructions ?: [['step' => 1, 'description' => '', 'image' => '', 'duration' => '']]) as $index => $instruction)
                                            <div class="instruction-step bg-gray-50 rounded-lg border border-gray-200 p-4" data-step="{{ $index + 1 }}">
                                                <div class="flex items-center justify-between mb-3">
                                                    <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-2">
                                                            Step {{ $index + 1 }}
                                                        </span>
                                                    </h4>
                                                    <button type="button" class="remove-step inline-flex items-center px-3 py-1.5 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" style="{{ $index == 0 ? 'display: none;' : '' }}">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                                    <div class="lg:col-span-2">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Deskripsi Langkah
                                                        </label>
                                                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                                  name="detailed_instructions[{{ $index }}][description]" 
                                                                  rows="3" 
                                                                  placeholder="Deskripsi langkah...">{{ $instruction['description'] ?? '' }}</textarea>
                                                        <input type="hidden" name="detailed_instructions[{{ $index }}][step]" value="{{ $index + 1 }}">
                                                    </div>
                                                    <div class="space-y-3">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                                URL Gambar
                                                            </label>
                                                            <input type="text" 
                                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                                   name="detailed_instructions[{{ $index }}][image]" 
                                                                   placeholder="URL gambar (opsional)"
                                                                   value="{{ $instruction['image'] ?? '' }}">
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                                Durasi
                                                            </label>
                                                            <input type="text" 
                                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                                   name="detailed_instructions[{{ $index }}][duration]" 
                                                                   placeholder="Durasi (opsional)"
                                                                   value="{{ $instruction['duration'] ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="instruction-step bg-gray-50 rounded-lg border border-gray-200 p-4" data-step="1">
                                            <div class="flex items-center justify-between mb-3">
                                                <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-2">
                                                        Step 1
                                                    </span>
                                                </h4>
                                                <button type="button" class="remove-step inline-flex items-center px-3 py-1.5 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" style="display: none;">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                                <div class="lg:col-span-2">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                                        Deskripsi Langkah
                                                    </label>
                                                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                              name="detailed_instructions[0][description]" 
                                                              rows="3" 
                                                              placeholder="Deskripsi langkah..."></textarea>
                                                    <input type="hidden" name="detailed_instructions[0][step]" value="1">
                                                </div>
                                                <div class="space-y-3">
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            URL Gambar
                                                        </label>
                                                        <input type="text" 
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                               name="detailed_instructions[0][image]" 
                                                               placeholder="URL gambar (opsional)">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                                            Durasi
                                                        </label>
                                                        <input type="text" 
                                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                               name="detailed_instructions[0][duration]" 
                                                               placeholder="Durasi (opsional)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <button type="button" id="add-instruction-step" class="inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Tambah Step
                                    </button>
                                </div>
                            </div>
                        </div>                        <!-- Benefits -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Manfaat
                                </h3>
                            </div>
                            <div class="p-6 space-y-6">
                                <div>
                                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">
                                        Manfaat Umum
                                    </label>
                                    <textarea class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 {{ $errors->has('benefits') ? 'border-red-500' : 'border-gray-300' }}" 
                                              id="benefits"
                                              name="benefits" 
                                              rows="4"
                                              placeholder="Jelaskan manfaat dari olahraga ini...">{{ old('benefits', $exerciseRecommendation->benefits) }}</textarea>
                                    @error('benefits')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Manfaat Terstruktur
                                    </label>
                                    <div id="structured-benefits-container" class="space-y-3">
                                        @if(old('structured_benefits') || $exerciseRecommendation->structured_benefits)
                                            @foreach(old('structured_benefits', $exerciseRecommendation->structured_benefits ?: ['']) as $index => $benefit)
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                            {{ $index + 1 }}
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <input type="text" 
                                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                               name="structured_benefits[]" 
                                                               placeholder="Manfaat {{ $index + 1 }}..." 
                                                               value="{{ $benefit }}">
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button type="button" class="remove-benefit inline-flex items-center p-2 border border-red-300 text-red-700 bg-white hover:bg-red-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" style="{{ $index == 0 ? 'display: none;' : '' }}">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
                                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                        1
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <input type="text" 
                                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                                           name="structured_benefits[]" 
                                                           placeholder="Manfaat 1...">
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="remove-benefit inline-flex items-center p-2 border border-red-300 text-red-700 bg-white hover:bg-red-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" style="display: none;">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" id="add-benefit" class="inline-flex items-center px-4 py-2 border border-green-300 text-sm font-medium rounded-md text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Tambah Manfaat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>                        <!-- Status -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-700 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Status
                                </h3>
                            </div>
                            <div class="p-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-2" 
                                           id="is_active" 
                                           name="is_active"
                                           value="1" 
                                           {{ old('is_active', $exerciseRecommendation->is_active) ? 'checked' : '' }}>
                                    <span class="ml-3 text-sm font-medium text-gray-900">
                                        Aktif (tampilkan kepada pengguna)
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-end space-x-4">
                                    <a href="{{ route('admin.exercise-recommendations.index') }}"
                                       class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Batal
                                    </a>
                                    <button type="submit" 
                                            class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Update Rekomendasi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Exercise Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Rekomendasi
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">Dibuat:</span>
                                <span class="ml-1">{{ $exerciseRecommendation->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                <span class="font-medium">Terakhir diupdate:</span>
                                <span class="ml-1">{{ $exerciseRecommendation->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="font-medium text-gray-700">Status:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $exerciseRecommendation->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $exerciseRecommendation->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Guide -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Panduan Pengisian
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="text-sm text-gray-600 space-y-3">
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Nama:</span> Gunakan nama yang jelas dan mudah dipahami
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Deskripsi:</span> Jelaskan secara singkat apa itu olahraga ini
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Kategori:</span> Pilih sesuai jenis olahraga
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Tujuan:</span> Sesuaikan dengan hasil yang ingin dicapai
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Tingkat Aktivitas:</span> Target pengguna berdasarkan keaktifan mereka
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Durasi:</span> Waktu ideal per sesi latihan
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <svg class="w-4 h-4 mt-0.5 mr-2 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <div>
                                        <span class="font-medium text-gray-900">Frekuensi:</span> Berapa kali dalam seminggu
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate estimated total calories per week
    const duration = document.getElementById('duration_minutes');
    const frequency = document.getElementById('frequency_per_week');
    const caloriesPerHour = document.getElementById('calories_burned_per_hour');
    
    function updateEstimate() {
        if (duration.value && frequency.value && caloriesPerHour.value) {
            const totalMinutes = duration.value * frequency.value;
            const totalHours = totalMinutes / 60;
            const totalCalories = Math.round(totalHours * caloriesPerHour.value);
            
            // Show estimate (you can add a span element to display this)
            console.log(`Estimasi kalori per minggu: ${totalCalories} kalori`);
        }
    }
    
    [duration, frequency, caloriesPerHour].forEach(input => {
        input.addEventListener('input', updateEstimate);
    });

    // Get initial instruction step count
    let instructionStepCount = document.querySelectorAll('.instruction-step').length;
    
    document.getElementById('add-instruction-step').addEventListener('click', function() {
        const container = document.getElementById('detailed-instructions-container');
        const newStep = document.createElement('div');
        newStep.className = 'instruction-step bg-gray-50 rounded-lg border border-gray-200 p-4';
        newStep.setAttribute('data-step', instructionStepCount + 1);
        
        newStep.innerHTML = `
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-2">
                        Step ${instructionStepCount + 1}
                    </span>
                </h4>
                <button type="button" class="remove-step inline-flex items-center px-3 py-1.5 border border-red-300 text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Langkah
                    </label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                              name="detailed_instructions[${instructionStepCount}][description]" 
                              rows="3" 
                              placeholder="Deskripsi langkah..."></textarea>
                    <input type="hidden" name="detailed_instructions[${instructionStepCount}][step]" value="${instructionStepCount + 1}">
                </div>
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            URL Gambar
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               name="detailed_instructions[${instructionStepCount}][image]" 
                               placeholder="URL gambar (opsional)">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi
                        </label>
                        <input type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                               name="detailed_instructions[${instructionStepCount}][duration]" 
                               placeholder="Durasi (opsional)">
                    </div>
                </div>
            </div>
        `;
        
        container.appendChild(newStep);
        instructionStepCount++;
        updateRemoveButtons();
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-step')) {
            e.target.closest('.instruction-step').remove();
            updateInstructionSteps();
        }
    });

    function updateInstructionSteps() {
        const steps = document.querySelectorAll('.instruction-step');
        steps.forEach((step, index) => {
            const stepNumber = index + 1;
            step.setAttribute('data-step', stepNumber);
            step.querySelector('.bg-blue-100').textContent = `Step ${stepNumber}`;
            step.querySelector('input[type="hidden"]').value = stepNumber;
            
            // Update names to maintain sequential indexing
            const inputs = step.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/detailed_instructions\[\d+\]/, `detailed_instructions[${index}]`);
                }
            });
        });
        instructionStepCount = steps.length;
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-step');
        removeButtons.forEach(button => {
            button.style.display = removeButtons.length > 1 ? 'inline-flex' : 'none';
        });
    }

    // Structured Benefits Management
    let benefitCount = document.querySelectorAll('#structured-benefits-container > div').length;
    
    document.getElementById('add-benefit').addEventListener('click', function() {
        const container = document.getElementById('structured-benefits-container');
        const newBenefit = document.createElement('div');
        newBenefit.className = 'flex items-center space-x-3';
        
        newBenefit.innerHTML = `
            <div class="flex-shrink-0">
                <span class="inline-flex items-center justify-center w-6 h-6 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                    ${benefitCount + 1}
                </span>
            </div>
            <div class="flex-1">
                <input type="text" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                       name="structured_benefits[]" 
                       placeholder="Manfaat ${benefitCount + 1}...">
            </div>
            <div class="flex-shrink-0">
                <button type="button" class="remove-benefit inline-flex items-center p-2 border border-red-300 text-red-700 bg-white hover:bg-red-50 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        `;
        
        container.appendChild(newBenefit);
        benefitCount++;
        updateBenefitRemoveButtons();
        updateBenefitNumbers();
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-benefit')) {
            e.target.closest('.flex.items-center.space-x-3').remove();
            updateBenefitRemoveButtons();
            updateBenefitNumbers();
        }
    });

    function updateBenefitRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-benefit');
        removeButtons.forEach(button => {
            button.style.display = removeButtons.length > 1 ? 'inline-flex' : 'none';
        });
    }

    function updateBenefitNumbers() {
        const benefitItems = document.querySelectorAll('#structured-benefits-container > div');
        benefitItems.forEach((item, index) => {
            const number = item.querySelector('.bg-green-100');
            const input = item.querySelector('input[name="structured_benefits[]"]');
            if (number) number.textContent = index + 1;
            if (input) input.placeholder = `Manfaat ${index + 1}...`;
        });
        benefitCount = benefitItems.length;
    }

    // Initial setup
    updateRemoveButtons();
    updateBenefitRemoveButtons();
});
</script>
@endpush