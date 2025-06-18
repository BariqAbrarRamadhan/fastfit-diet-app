@extends('admin.layouts.app')

@section('title', 'Detail Rekomendasi Olahraga')

    @section('content')
        <div class="p-6">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <i data-lucide="eye" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Detail Rekomendasi Olahraga</h1>
                            <p class="text-gray-600">Lihat detail lengkap rekomendasi olahraga</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}"
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                            <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                            Edit
                        </a>
                        <a href="{{ route('admin.exercise-recommendations.index') }}"
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Informasi Dasar
                            </h3>
                        </div>
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $exerciseRecommendation->name }}</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $exerciseRecommendation->description }}</p>
                        </div>
                    </div>

                    <!-- Classification -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i data-lucide="tag" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Klasifikasi & Target
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Kategori</label>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $exerciseRecommendation->category_label }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tujuan</label>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        {{ $exerciseRecommendation->goal_label }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tingkat Aktivitas</label>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        {{ $exerciseRecommendation->activity_level_label }}
                                    </span>
                                </div>
                                @if($exerciseRecommendation->calories_burned_per_hour)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Kalori per Jam</label>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                            {{ $exerciseRecommendation->calories_burned_per_hour }} kcal
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Media -->
                    @if($exerciseRecommendation->image || $exerciseRecommendation->video_url)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="border-b border-gray-200 p-4">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i data-lucide="image" class="w-5 h-5 mr-2 text-orange-500"></i>
                                    Media
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                @if($exerciseRecommendation->image)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Gambar</label>
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ $exerciseRecommendation->image }}" alt="{{ $exerciseRecommendation->name }}"
                                                class="w-16 h-16 object-cover rounded-lg border border-gray-200"
                                                onerror="this.src='{{ asset('images/default-exercise.jpg') }}'">
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-700 font-mono bg-gray-50 p-2 rounded border break-all">
                                                    {{ $exerciseRecommendation->image }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($exerciseRecommendation->video_url)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-2">Video Tutorial</label>
                                        <div class="space-y-2">
                                            <p class="text-sm text-gray-700 font-mono bg-gray-50 p-2 rounded border break-all">
                                                {{ $exerciseRecommendation->video_url }}
                                            </p>
                                            <a href="{{ $exerciseRecommendation->video_url }}" target="_blank"
                                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded font-medium transition-colors">
                                                <i data-lucide="external-link" class="w-4 h-4 mr-1"></i>
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
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="border-b border-gray-200 p-4">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i data-lucide="book-open" class="w-5 h-5 mr-2 text-orange-500"></i>
                                    Instruksi
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="text-gray-700 whitespace-pre-line">{{ $exerciseRecommendation->instructions }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-6">
                        <div class="border-b border-gray-200 p-4">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Informasi Tambahan
                            </h3>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Status</label>
                                @if($exerciseRecommendation->is_active)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i data-lucide="x-circle" class="w-4 h-4 mr-1"></i>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </div>

                            <!-- Timestamps -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Riwayat</label>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>Dibuat:</span>
                                        <span>{{ $exerciseRecommendation->created_at->format('d M Y H:i') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Diperbarui:</span>
                                        <span>{{ $exerciseRecommendation->updated_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-2">Aksi Cepat</label>
                                <div class="space-y-2">
                                    <a href="{{ route('admin.exercise-recommendations.edit', $exerciseRecommendation) }}"
                                        class="w-full bg-orange-50 hover:bg-orange-100 text-orange-700 px-3 py-2 rounded font-medium transition-colors flex items-center">
                                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                        Edit Data
                                    </a>
                                    <a href="{{ route('admin.exercise-recommendations.index') }}"
                                        class="w-full bg-gray-50 hover:bg-gray-100 text-gray-700 px-3 py-2 rounded font-medium transition-colors flex items-center">
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

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
@endsection