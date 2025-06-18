@extends('admin.layouts.app')

@section('title', 'Tambah Rekomendasi Makanan')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <i data-lucide="plus" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Rekomendasi Makanan</h1>
                    <p class="text-gray-600">Buat rekomendasi makanan baru untuk pengguna</p>
                </div>
            </div>
            <a href="{{ route('admin.food-recommendations.index') }}" 
               class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <form action="{{ route('admin.food-recommendations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Basic Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Dasar
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Makanan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name"
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('name') border-red-300 @enderror" 
                                   placeholder="Contoh: Salad Ayam Mediterania"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Makanan
                            </label>
                            <input type="file" 
                                   id="image"
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('image') border-red-300 @enderror">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-sm mt-1">Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('description') border-red-300 @enderror" 
                                  placeholder="Jelaskan kandungan nutrisi dan manfaat makanan ini..."
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Diet & Meal Information -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i data-lucide="heart" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Diet & Waktu Makan
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Diet Types -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Diet <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-2 max-h-40 overflow-y-auto border border-gray-300 rounded-lg p-3 bg-white">
                                @foreach($dietTypes as $key => $value)
                                    <label class="flex items-center p-2 rounded hover:bg-gray-50 transition-colors cursor-pointer">
                                        <input type="checkbox" 
                                               name="diet_types[]" 
                                               value="{{ $key }}"
                                               {{ (collect(old('diet_types'))->contains($key)) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-orange-600 focus:ring-orange-500 mr-3">
                                        <span class="text-gray-700 text-sm">{{ $value }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('diet_types')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meal Type -->
                        <div>
                            <label for="meal_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Makan <span class="text-red-500">*</span>
                            </label>
                            <select id="meal_type"
                                    name="meal_type" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('meal_type') border-red-300 @enderror"
                                    required>
                                <option value="">Pilih waktu makan</option>
                                @foreach($mealTypes as $key => $value)
                                    <option value="{{ $key }}" {{ old('meal_type') === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('meal_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Day -->
                        <div>
                            <label for="day" class="block text-sm font-medium text-gray-700 mb-2">
                                Hari (Opsional)
                            </label>
                            <select id="day"
                                    name="day" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('day') border-red-300 @enderror">
                                <option value="">Pilih hari (opsional)</option>
                                @foreach($dayTypes as $key => $value)
                                    <option value="{{ $key }}" {{ old('day') === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('day')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Calories Information -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i data-lucide="zap" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Kalori
                    </h3>
                    
                    <div>
                        <label for="calories_per_serving" class="block text-sm font-medium text-gray-700 mb-2">
                            Kalori per Porsi
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   id="calories_per_serving"
                                   name="calories_per_serving"
                                   value="{{ old('calories_per_serving') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('calories_per_serving') border-red-300 @enderror"
                                   placeholder="250">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">kcal</span>
                        </div>
                        @error('calories_per_serving')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Status -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Status
                    </h3>
                    
                    <label class="flex items-center p-3 bg-gray-50 rounded-lg cursor-pointer">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-orange-600 focus:ring-orange-500 mr-3">
                        <span class="text-sm font-medium text-gray-700">Aktifkan rekomendasi ini</span>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.food-recommendations.index') }}" 
                       class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white font-medium rounded-lg transition-all duration-300 flex items-center">
                        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                        Simpan Rekomendasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>
@endsection
