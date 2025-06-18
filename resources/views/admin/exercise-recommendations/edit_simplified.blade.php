@extends('admin.layouts.app')

@section('title', 'Edit Rekomendasi Olahraga')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50/30 via-white to-blue-50/30">
    <div class="space-y-6 p-6">
        <!-- Modern Header -->
        <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 p-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mr-6 shadow-xl">
                        <i data-lucide="edit" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent leading-tight">
                            Edit Rekomendasi Olahraga
                        </h1>
                        <p class="text-gray-600 text-lg mt-2">Perbarui informasi rekomendasi olahraga yang sudah ada</p>
                    </div>
                </div>
                <a href="{{ route('admin.exercise-recommendations.index') }}" 
                   class="bg-white/80 hover:bg-white text-gray-700 border-2 border-gray-200 hover:border-orange-300 px-8 py-4 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-3"></i>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Column -->
            <div class="lg:col-span-2">
                <!-- Modern Form -->
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-500/5 to-red-600/5 px-8 py-6 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="edit" class="w-6 h-6 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">Form Edit Rekomendasi Olahraga</h3>
                                <p class="text-gray-600">Perbarui informasi olahraga dengan detail</p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.exercise-recommendations.update', $exerciseRecommendation) }}" method="POST" class="p-8 space-y-8">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="bg-gradient-to-r from-blue-50/50 to-indigo-50/50 rounded-2xl p-6 border border-blue-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="info" class="w-6 h-6 mr-3 text-blue-500"></i>
                                Informasi Dasar
                            </h3>
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 gap-6">
                                    <div class="relative">
                                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-3">
                                            Nama Olahraga <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name', $exerciseRecommendation->name) }}"
                                               class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-800 placeholder-gray-500 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" 
                                               placeholder="Contoh: Push Up, Jogging, Yoga Hatha"
                                               required>
                                        @error('name')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="relative">
                                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="description" 
                                              name="description" 
                                              rows="4"
                                              class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 text-gray-800 placeholder-gray-500 resize-none @error('description') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror" 
                                              placeholder="Jelaskan apa itu olahraga ini dan manfaatnya secara umum..."
                                              required>{{ old('description', $exerciseRecommendation->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>                          
                        
                        <!-- Classification -->
                        <div class="bg-gradient-to-r from-purple-50/50 to-pink-50/50 rounded-2xl p-6 border border-purple-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="tag" class="w-6 h-6 mr-3 text-purple-500"></i>
                                Klasifikasi Olahraga
                            </h3>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div class="relative">
                                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-3">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="category" 
                                            name="category" 
                                            class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-gray-800 @error('category') border-red-300 focus:border-red-500 focus:ring-red-500/20 @enderror"
                                            required>
                                        <option value="" disabled>Pilih Kategori Olahraga</option>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}" {{ old('category', $exerciseRecommendation->category) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Target & Activity Level -->
                        <div class="bg-gradient-to-r from-orange-50/50 to-red-50/50 rounded-2xl p-6 border border-orange-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="target" class="w-6 h-6 mr-3 text-orange-500"></i>
                                Target & Tingkat Aktivitas
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-3">
                                        <i data-lucide="crosshair" class="w-4 h-4 inline mr-2 text-orange-500"></i>
                                        Tujuan *
                                    </label>
                                    <select name="goal" 
                                            class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('goal') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                            required>
                                        <option value="">🎯 Pilih Tujuan</option>
                                        @foreach($goals as $key => $value)
                                            <option value="{{ $key }}" {{ old('goal', $exerciseRecommendation->goal) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('goal')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-3">
                                        <i data-lucide="activity" class="w-4 h-4 inline mr-2 text-red-500"></i>
                                        Tingkat Aktivitas *
                                    </label>
                                    <select name="activity_level" 
                                            class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('activity_level') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                            required>
                                        <option value="">⚡ Pilih Tingkat Aktivitas</option>
                                        @foreach($activityLevels as $key => $value)
                                            <option value="{{ $key }}" {{ old('activity_level', $exerciseRecommendation->activity_level) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('activity_level')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-3">
                                        <i data-lucide="zap" class="w-4 h-4 inline mr-2 text-yellow-500"></i>
                                        Kalori/Jam
                                    </label>
                                    <div class="relative">
                                        <input type="number" 
                                               name="calories_burned_per_hour" 
                                               value="{{ old('calories_burned_per_hour', $exerciseRecommendation->calories_burned_per_hour) }}"
                                               min="0"
                                               class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('calories_burned_per_hour') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                               placeholder="300">
                                        <span class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-500 text-base font-medium">kcal</span>
                                    </div>
                                    @error('calories_burned_per_hour')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-500 text-sm mt-2">🔥 Estimasi kalori per jam</p>
                                </div>
                            </div>
                        </div>

                        <!-- Media -->
                        <div class="bg-gradient-to-r from-cyan-50/50 to-teal-50/50 rounded-2xl p-6 border border-cyan-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="image" class="w-6 h-6 mr-3 text-cyan-500"></i>
                                Media & Visual
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-3">
                                        <i data-lucide="image" class="w-4 h-4 inline mr-2 text-cyan-500"></i>
                                        Gambar Utama
                                    </label>
                                    <input type="text" 
                                           name="image" 
                                           value="{{ old('image', $exerciseRecommendation->image) }}"
                                           class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-cyan-500/20 focus:border-cyan-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('image') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                           placeholder="🖼️ URL gambar utama olahraga">
                                    @error('image')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-500 text-sm mt-2">📸 URL gambar yang akan ditampilkan sebagai gambar utama</p>
                                </div>

                                <div>
                                    <label class="block text-base font-bold text-gray-700 mb-3">
                                        <i data-lucide="video" class="w-4 h-4 inline mr-2 text-teal-500"></i>
                                        URL Video Tutorial
                                    </label>
                                    <input type="url" 
                                           name="video_url" 
                                           value="{{ old('video_url', $exerciseRecommendation->video_url) }}"
                                           class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('video_url') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                           placeholder="🎥 https://youtube.com/watch?v=...">
                                    @error('video_url')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-500 text-sm mt-2">🎬 URL video tutorial (YouTube, Vimeo, dll)</p>
                                </div>
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="bg-gradient-to-r from-emerald-50/50 to-green-50/50 rounded-2xl p-6 border border-emerald-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="book-open" class="w-6 h-6 mr-3 text-emerald-500"></i>
                                Instruksi & Panduan
                            </h3>
                            
                            <div>
                                <label class="block text-base font-bold text-gray-700 mb-3">
                                    <i data-lucide="file-text" class="w-4 h-4 inline mr-2 text-emerald-500"></i>
                                    Instruksi/Cara Melakukan
                                </label>
                                <textarea name="instructions" 
                                          rows="6"
                                          class="w-full px-5 py-4 text-base border-2 border-gray-200 rounded-2xl focus:outline-none focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-300 bg-white hover:bg-gray-50 @error('instructions') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror"
                                          placeholder="📝 Jelaskan langkah-langkah detail cara melakukan olahraga ini...">{{ old('instructions', $exerciseRecommendation->instructions) }}</textarea>
                                @error('instructions')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-gradient-to-r from-gray-50/50 to-slate-50/50 rounded-2xl p-6 border border-gray-200/30">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i data-lucide="toggle-left" class="w-6 h-6 mr-3 text-gray-500"></i>
                                Status Aktivasi
                            </h3>
                            <div class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1"
                                       {{ old('is_active', $exerciseRecommendation->is_active) ? 'checked' : '' }}
                                       class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2">
                                <label for="is_active" class="ml-3 text-base font-medium text-gray-700">
                                    Aktifkan rekomendasi olahraga ini
                                </label>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">💡 Rekomendasi yang aktif akan ditampilkan kepada pengguna</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4 pt-6">
                            <a href="{{ route('admin.exercise-recommendations.index') }}" 
                               class="px-8 py-4 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-8 py-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                                <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                                Perbarui Rekomendasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Guide -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/50 overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-indigo-500/5 to-purple-600/5 px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xl font-bold text-gray-800 flex items-center">
                            <i data-lucide="lightbulb" class="w-6 h-6 mr-3 text-indigo-500"></i>
                            Panduan Edit
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="bg-blue-50/50 rounded-xl p-4">
                            <h6 class="font-bold text-blue-700 mb-3 flex items-center">
                                <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                                Field yang Diperlukan:
                            </h6>
                            <ul class="space-y-2 text-blue-600">
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong>Nama:</strong> Nama olahraga yang jelas</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong>Deskripsi:</strong> Penjelasan singkat</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong>Kategori:</strong> Jenis olahraga</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong>Kalori:</strong> Estimasi kalori yang terbakar per jam</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mt-2 mr-3 flex-shrink-0"></span>
                                    <span><strong>Instruksi:</strong> Panduan cara melakukan olahraga</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-green-50/50 rounded-xl p-4">
                            <h6 class="font-bold text-green-700 mb-3 flex items-center">
                                <i data-lucide="target" class="w-4 h-4 mr-2"></i>
                                Tips Edit:
                            </h6>
                            <p class="text-green-600">Pastikan untuk mengecek kembali semua informasi sebelum menyimpan perubahan. Data yang sudah diubah akan langsung tersimpan.</p>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
        
        // Add hover effects to form sections
        const formSections = document.querySelectorAll('.bg-gradient-to-r');
        formSections.forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.transition = 'all 0.3s ease';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endsection
