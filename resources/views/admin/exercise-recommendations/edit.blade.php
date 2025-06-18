@extends('admin.layouts.app')

@section('title', 'Edit Rekomendasi Olahraga')

    @section('content')
        <div class="p-6">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <i data-lucide="edit" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Rekomendasi Olahraga</h1>
                            <p class="text-gray-600">Perbarui informasi rekomendasi olahraga</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.exercise-recommendations.index') }}"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">
                    <form action="{{ route('admin.exercise-recommendations.update', $exerciseRecommendation) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Informasi Dasar
                            </h3>

                            <div class="grid grid-cols-1 gap-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Olahraga <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $exerciseRecommendation->name) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-300 @enderror"
                                        placeholder="Contoh: Push Up, Yoga, Lari" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="description" name="description" rows="3"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('description') border-red-300 @enderror"
                                        placeholder="Jelaskan manfaat dan tujuan olahraga ini..."
                                        required>{{ old('description', $exerciseRecommendation->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Classification -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i data-lucide="tag" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Klasifikasi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="category" name="category"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('category') border-red-300 @enderror"
                                        required>
                                        <option value="">Pilih kategori</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" {{ old('category', $exerciseRecommendation->category) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Goal -->
                                <div>
                                    <label for="goal" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tujuan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="goal" name="goal"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('goal') border-red-300 @enderror"
                                        required>
                                        <option value="">Pilih tujuan</option>
                                        @foreach($goals as $key => $value)
                                            <option value="{{ $key }}" {{ old('goal', $exerciseRecommendation->goal) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('goal')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Activity Level -->
                                <div>
                                    <label for="activity_level" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tingkat Aktivitas <span class="text-red-500">*</span>
                                    </label>
                                    <select id="activity_level" name="activity_level"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('activity_level') border-red-300 @enderror"
                                        required>
                                        <option value="">Pilih tingkat</option>
                                        @php
                                            $activityLevels = [
                                                'sedentary' => 'Sangat Rendah',
                                                'moderately_active' => 'Sedang',
                                                'extra_active' => 'Sangat Tinggi'
                                            ];
                                        @endphp
                                        @foreach($activityLevels as $key => $value)
                                            <option value="{{ $key }}" {{ old('activity_level', $exerciseRecommendation->activity_level) == $key ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('activity_level')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Media & Details -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i data-lucide="image" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Media & Detail
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <!-- Image -->
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                        URL Gambar
                                    </label>
                                    <input type="url" id="image" name="image"
                                        value="{{ old('image', $exerciseRecommendation->image) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('image') border-red-300 @enderror"
                                        placeholder="https://example.com/image.jpg">
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Video URL -->
                                <div>
                                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                                        URL Video Tutorial
                                    </label>
                                    <input type="url" id="video_url" name="video_url"
                                        value="{{ old('video_url', $exerciseRecommendation->video_url) }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('video_url') border-red-300 @enderror"
                                        placeholder="https://youtube.com/watch?v=...">
                                    @error('video_url')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Calories -->
                            <div class="mb-4">
                                <label for="calories_burned_per_hour" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kalori Terbakar per Jam
                                </label>
                                <input type="number" id="calories_burned_per_hour" name="calories_burned_per_hour"
                                    value="{{ old('calories_burned_per_hour', $exerciseRecommendation->calories_burned_per_hour) }}"
                                    min="0" max="2000"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('calories_burned_per_hour') border-red-300 @enderror"
                                    placeholder="Contoh: 300">
                                @error('calories_burned_per_hour')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instructions -->
                            <div>
                                <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                                    Instruksi/Cara Melakukan
                                </label>
                                <textarea id="instructions" name="instructions" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('instructions') border-red-300 @enderror"
                                    placeholder="Jelaskan langkah-langkah melakukan olahraga ini...">{{ old('instructions', $exerciseRecommendation->instructions) }}</textarea>
                                @error('instructions')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <i data-lucide="toggle-left" class="w-5 h-5 mr-2 text-orange-500"></i>
                                Status
                            </h3>

                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $exerciseRecommendation->is_active) ? 'checked' : '' }}
                                    class="w-4 h-4 text-orange-600 bg-gray-100 border-gray-300 rounded focus:ring-orange-500">
                                <label for="is_active" class="ml-2 text-sm text-gray-700">
                                    Aktifkan rekomendasi ini
                                </label>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="border-t border-gray-200 pt-6 flex justify-end space-x-3">
                            <a href="{{ route('admin.exercise-recommendations.index') }}"
                                class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 flex items-center">
                                <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', function () {
            // Auto-resize textareas
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function () {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            });

            // Add hover effects to form sections
            const formSections = document.querySelectorAll('.bg-gradient-to-r');
            formSections.forEach(section => {
                section.addEventListener('mouseenter', function () {
                    this.style.transform = 'translateY(-2px)';
                    this.style.transition = 'all 0.3s ease';
                });

                section.addEventListener('mouseleave', function () {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection