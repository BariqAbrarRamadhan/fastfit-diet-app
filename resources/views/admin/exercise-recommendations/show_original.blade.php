@extends('admin.layouts.app')

@section('title', 'Detail Rekomendasi Olahraga')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Detail Rekomendasi Olahraga</h1>
                        <p class="mt-2 text-gray-600">Lihat detail lengkap rekomendasi olahraga</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}"
                           class="inline-flex items-center px-4 py-2 border border-orange-300 rounded-lg text-sm font-medium text-orange-700 bg-orange-50 hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <a href="{{ route('admin.exercise-recommendations.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">                <!-- Main Content Section -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Umum
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $exerciseRecommendation->name }}</h2>
                                <p class="text-lg text-gray-600 leading-relaxed">{{ $exerciseRecommendation->description }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Kategori</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ App\Models\ExerciseRecommendation::getCategories()[$exerciseRecommendation->category] ?? $exerciseRecommendation->category }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Tujuan</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            {{ App\Models\ExerciseRecommendation::getGoals()[$exerciseRecommendation->goal] ?? $exerciseRecommendation->goal }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Tingkat Aktivitas</span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            {{ App\Models\ExerciseRecommendation::getActivityLevels()[$exerciseRecommendation->activity_level] ?? $exerciseRecommendation->activity_level }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Tingkat Kesulitan</span>
                                        @if($exerciseRecommendation->difficulty_level == 'beginner')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        @elseif($exerciseRecommendation->difficulty_level == 'intermediate')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        @endif
                                            {{ App\Models\ExerciseRecommendation::getDifficultyLevels()[$exerciseRecommendation->difficulty_level] ?? $exerciseRecommendation->difficulty_level }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Durasi</span>
                                        <span class="text-gray-900 font-semibold">{{ $exerciseRecommendation->duration_minutes }} menit</span>
                                    </div>
                                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                        <span class="font-medium text-gray-700">Frekuensi</span>
                                        <span class="text-gray-900 font-semibold">{{ $exerciseRecommendation->frequency_per_week }}x per minggu</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    <!-- Instructions -->
                    @if($exerciseRecommendation->instructions)
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
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($exerciseRecommendation->instructions)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Detailed Instructions -->
                    @if($exerciseRecommendation->detailed_instructions && count($exerciseRecommendation->detailed_instructions) > 0)
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
                                <div class="space-y-6">
                                    @foreach($exerciseRecommendation->detailed_instructions as $index => $instruction)
                                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-shrink-0">
                                                    <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                                        {{ $index + 1 }}
                                                    </span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-gray-900 leading-relaxed">
                                                        {{ $instruction['description'] ?? '' }}
                                                    </div>
                                                    @if(isset($instruction['duration']) && $instruction['duration'])
                                                        <div class="mt-2 text-sm text-gray-600">
                                                            <span class="font-medium">Durasi:</span> {{ $instruction['duration'] }}
                                                        </div>
                                                    @endif
                                                    @if(isset($instruction['image']) && $instruction['image'])
                                                        <div class="mt-3">
                                                            <img src="{{ $instruction['image'] }}" alt="Step {{ $index + 1 }}" class="max-w-xs rounded-lg shadow-sm">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Benefits -->
                    @if($exerciseRecommendation->benefits)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Manfaat
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="prose max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($exerciseRecommendation->benefits)) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Structured Benefits -->
                    @if($exerciseRecommendation->structured_benefits && count($exerciseRecommendation->structured_benefits) > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-teal-600 px-6 py-4">
                                <h3 class="text-lg font-semibold text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Manfaat Terstruktur
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($exerciseRecommendation->structured_benefits as $index => $benefit)
                                        @if($benefit)
                                            <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg border border-green-200">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </div>
                                                <div class="text-green-800">{{ $benefit }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Muscle Groups -->
                    @if($exerciseRecommendation->muscle_groups && count($exerciseRecommendation->muscle_groups) > 0)
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
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                    @foreach($exerciseRecommendation->muscle_groups as $muscleGroup)
                                        <div class="inline-flex items-center px-3 py-2 bg-purple-100 text-purple-800 text-sm font-medium rounded-lg">
                                            {{ \App\Models\ExerciseRecommendation::getMuscleGroups()[$muscleGroup] ?? $muscleGroup }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Media -->
                    @if($exerciseRecommendation->main_image || $exerciseRecommendation->video_url)
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
                                @if($exerciseRecommendation->main_image)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-700 mb-3">Gambar Utama</h4>
                                        <img src="{{ $exerciseRecommendation->main_image }}" alt="{{ $exerciseRecommendation->name }}" class="max-w-md rounded-lg shadow-sm">
                                    </div>
                                @endif
                                @if($exerciseRecommendation->video_url)
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-700 mb-3">Video Tutorial</h4>
                                        <a href="{{ $exerciseRecommendation->video_url }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-blue-300 text-sm font-medium rounded-lg text-blue-700 bg-blue-50 hover:bg-blue-100 transition-all duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a4.5 4.5 0 110 9H9"/>
                                            </svg>
                                            Lihat Video
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Status & Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Status & Aksi
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-center">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $exerciseRecommendation->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $exerciseRecommendation->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <form method="POST" action="{{ route('admin.exercise-recommendations.toggle-status', $exerciseRecommendation) }}">
                                @csrf
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white {{ $exerciseRecommendation->is_active ? 'bg-gray-600 hover:bg-gray-700' : 'bg-green-600 hover:bg-green-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $exerciseRecommendation->is_active ? 'focus:ring-gray-500' : 'focus:ring-green-500' }} transition-all duration-200">
                                    @if($exerciseRecommendation->is_active)
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364L18.364 5.636"/>
                                        </svg>
                                        Nonaktifkan
                                    @else
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Aktifkan
                                    @endif
                                </button>
                            </form>

                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}"
                                   class="inline-flex items-center justify-center px-3 py-2 border border-orange-300 text-sm font-medium rounded-lg text-orange-700 bg-orange-50 hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.exercise-recommendations.destroy', $exerciseRecommendation) }}"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekomendasi ini?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-3 py-2 border border-red-300 text-sm font-medium rounded-lg text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Tambahan
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            @if($exerciseRecommendation->calories_burned_per_hour)
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <div class="text-sm text-blue-600 font-medium mb-1">Kalori Terbakar per Jam</div>
                                    <div class="text-2xl font-bold text-blue-900">
                                        {{ number_format($exerciseRecommendation->calories_burned_per_hour) }} <span class="text-sm font-normal">kalori</span>
                                    </div>
                                </div>

                                <div class="bg-green-50 rounded-lg p-4">
                                    <div class="text-sm text-green-600 font-medium mb-1">Estimasi Kalori per Minggu</div>
                                    @php
                                        $weeklyMinutes = $exerciseRecommendation->duration_minutes * $exerciseRecommendation->frequency_per_week;
                                        $weeklyHours = $weeklyMinutes / 60;
                                        $weeklyCalories = $weeklyHours * $exerciseRecommendation->calories_burned_per_hour;
                                    @endphp
                                    <div class="text-2xl font-bold text-green-900">
                                        {{ number_format($weeklyCalories) }} <span class="text-sm font-normal">kalori</span>
                                    </div>
                                </div>
                            @endif

                            @if($exerciseRecommendation->equipment_needed)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="text-sm text-gray-600 font-medium mb-2">Peralatan yang Dibutuhkan</div>
                                    <div class="text-gray-900">{{ $exerciseRecommendation->equipment_needed }}</div>
                                </div>
                            @endif

                            <div class="border-t border-gray-200 pt-4 space-y-3">
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
                            </div>
                        </div>
                    </div>

                    <!-- Target Users -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Pengguna Target
                            </h3>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-600 mb-4">Rekomendasi ini akan ditampilkan kepada pengguna dengan kriteria:</p>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <div class="text-sm">
                                        <span class="text-gray-600">Tujuan:</span>
                                        <span class="font-medium text-gray-900 ml-1">{{ App\Models\ExerciseRecommendation::getGoals()[$exerciseRecommendation->goal] }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <div class="text-sm">
                                        <span class="text-gray-600">Tingkat Aktivitas:</span>
                                        <span class="font-medium text-gray-900 ml-1">{{ App\Models\ExerciseRecommendation::getActivityLevels()[$exerciseRecommendation->activity_level] }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <div class="text-sm">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="font-medium text-gray-900 ml-1">{{ $exerciseRecommendation->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
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