@extends('admin.layouts.app')

@section('title', 'Detail Rekomendasi Olahraga')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50/30 via-white to-blue-50/30">
    <div class="space-y-6 p-6">
        <!-- Modern Header -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 p-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mr-6 shadow-xl">
                        <i data-lucide="eye" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent leading-tight">
                            Detail Rekomendasi Olahraga
                        </h1>
                        <p class="text-gray-600 text-lg mt-2">Lihat detail lengkap rekomendasi olahraga</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}" 
                       class="bg-orange-500/90 hover:bg-orange-600 text-white border-2 border-orange-500 hover:border-orange-600 px-8 py-4 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                        <i data-lucide="edit" class="w-5 h-5 mr-3"></i>
                        Edit
                    </a>
                    <a href="{{ route('admin.exercise-recommendations.index') }}" 
                       class="bg-white/80 hover:bg-white text-gray-700 border-2 border-gray-200 hover:border-blue-300 px-8 py-4 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                        <i data-lucide="arrow-left" class="w-5 h-5 mr-3"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500/5 to-indigo-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="info" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Informasi Dasar</h3>
                                <p class="text-gray-600">Detail utama olahraga</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $exerciseRecommendation->name }}</h2>
                            <p class="text-lg text-gray-600 leading-relaxed">{{ $exerciseRecommendation->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Classification & Goals -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500/5 to-pink-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="tag" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Klasifikasi & Target</h3>
                                <p class="text-gray-600">Kategori dan tujuan olahraga</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-purple-50/50 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-purple-800 mb-3 flex items-center">
                                    <i data-lucide="layers" class="w-5 h-5 mr-2"></i>
                                    Kategori
                                </h4>
                                <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-xl font-medium">
                                    {{ $exerciseRecommendation->category_label }}
                                </span>
                            </div>
                            <div class="bg-orange-50/50 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-orange-800 mb-3 flex items-center">
                                    <i data-lucide="target" class="w-5 h-5 mr-2"></i>
                                    Tujuan
                                </h4>
                                <span class="bg-orange-100 text-orange-800 px-4 py-2 rounded-xl font-medium">
                                    {{ $exerciseRecommendation->goal_label }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Level & Calories -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-red-500/5 to-orange-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-orange-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="activity" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Aktivitas & Kalori</h3>
                                <p class="text-gray-600">Tingkat aktivitas dan pembakaran kalori</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-red-50/50 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-red-800 mb-3 flex items-center">
                                    <i data-lucide="activity" class="w-5 h-5 mr-2"></i>
                                    Tingkat Aktivitas
                                </h4>
                                <span class="bg-red-100 text-red-800 px-4 py-2 rounded-xl font-medium">
                                    {{ $exerciseRecommendation->activity_level_label }}
                                </span>
                            </div>
                            @if($exerciseRecommendation->calories_burned_per_hour)
                            <div class="bg-yellow-50/50 rounded-2xl p-6">
                                <h4 class="text-lg font-semibold text-yellow-800 mb-3 flex items-center">
                                    <i data-lucide="zap" class="w-5 h-5 mr-2"></i>
                                    Kalori per Jam
                                </h4>
                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-xl font-medium">
                                    {{ $exerciseRecommendation->calories_burned_per_hour }} kcal
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Media -->
                @if($exerciseRecommendation->image || $exerciseRecommendation->video_url)
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-cyan-500/5 to-teal-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="image" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Media & Visual</h3>
                                <p class="text-gray-600">Gambar dan video tutorial</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8 space-y-6">
                        @if($exerciseRecommendation->image)
                        <div class="bg-cyan-50/50 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-cyan-800 mb-4 flex items-center">
                                <i data-lucide="image" class="w-5 h-5 mr-2"></i>
                                Gambar Utama
                            </h4>
                            <div class="flex items-center space-x-4">
                                <img src="{{ $exerciseRecommendation->image }}" 
                                     alt="{{ $exerciseRecommendation->name }}"
                                     class="w-20 h-20 object-cover rounded-xl shadow-lg"
                                     onerror="this.src='{{ asset('images/default-exercise.jpg') }}'">
                                <div class="flex-1">
                                    <p class="text-sm text-cyan-700 font-mono bg-cyan-100 p-2 rounded-lg break-all">
                                        {{ $exerciseRecommendation->image }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($exerciseRecommendation->video_url)
                        <div class="bg-teal-50/50 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-teal-800 mb-4 flex items-center">
                                <i data-lucide="video" class="w-5 h-5 mr-2"></i>
                                Video Tutorial
                            </h4>
                            <div class="space-y-3">
                                <p class="text-sm text-teal-700 font-mono bg-teal-100 p-2 rounded-lg break-all">
                                    {{ $exerciseRecommendation->video_url }}
                                </p>
                                <a href="{{ $exerciseRecommendation->video_url }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition-all duration-200">
                                    <i data-lucide="external-link" class="w-4 h-4 mr-2"></i>
                                    Buka Video
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Instructions -->
                @if($exerciseRecommendation->instructions)
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500/5 to-green-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Instruksi & Panduan</h3>
                                <p class="text-gray-600">Cara melakukan olahraga</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="bg-emerald-50/50 rounded-2xl p-6">
                            <h4 class="text-lg font-semibold text-emerald-800 mb-4 flex items-center">
                                <i data-lucide="file-text" class="w-5 h-5 mr-2"></i>
                                Langkah-langkah
                            </h4>
                            <div class="prose max-w-none text-emerald-700">
                                {!! nl2br(e($exerciseRecommendation->instructions)) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-indigo-500/5 to-purple-600/5 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i data-lucide="info" class="w-6 h-6 mr-3 text-indigo-500"></i>
                            Informasi Tambahan
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Status -->
                        <div class="bg-gray-50/50 rounded-xl p-4">
                            <h6 class="font-bold text-gray-700 mb-3 flex items-center">
                                <i data-lucide="toggle-left" class="w-4 h-4 mr-2"></i>
                                Status:
                            </h6>
                            @if($exerciseRecommendation->is_active)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium flex items-center">
                                    <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
                                    Aktif
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full font-medium flex items-center">
                                    <i data-lucide="x-circle" class="w-4 h-4 mr-2"></i>
                                    Tidak Aktif
                                </span>
                            @endif
                        </div>

                        <!-- Timestamps -->
                        <div class="bg-blue-50/50 rounded-xl p-4">
                            <h6 class="font-bold text-blue-700 mb-3 flex items-center">
                                <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                                Riwayat:
                            </h6>
                            <div class="space-y-2 text-blue-600">
                                <div class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <div>
                                        <div class="font-medium">Dibuat</div>
                                        <div class="text-sm">{{ $exerciseRecommendation->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <div>
                                        <div class="font-medium">Diperbarui</div>
                                        <div class="text-sm">{{ $exerciseRecommendation->updated_at->format('d M Y H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="bg-orange-50/50 rounded-xl p-4">
                            <h6 class="font-bold text-orange-700 mb-3 flex items-center">
                                <i data-lucide="zap" class="w-4 h-4 mr-2"></i>
                                Aksi Cepat:
                            </h6>
                            <div class="space-y-3">
                                <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}" 
                                   class="w-full bg-orange-100 hover:bg-orange-200 text-orange-800 px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center">
                                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                    Edit Data
                                </a>
                                <a href="{{ route('admin.exercise-recommendations.index') }}" 
                                   class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center">
                                    <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@endsection
