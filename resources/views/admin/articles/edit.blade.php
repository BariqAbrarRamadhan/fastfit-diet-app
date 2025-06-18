@extends('admin.layouts.app')

@section('title', 'Edit Artikel')

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
        <h1 class="text-2xl font-bold text-gray-900">Edit Artikel</h1>
        <p class="text-gray-600">Perbarui konten artikel yang sudah ada</p>
      </div>
      </div>
      <a href="{{ route('admin.articles.index') }}"
      class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
      <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
      Kembali
      </a>
    </div>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data"
      class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Title Field -->
      <div>
      <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
        <i data-lucide="edit-3" class="w-4 h-4 mr-2 text-orange-500"></i>
        Judul Artikel <span class="text-red-500 ml-1">*</span>
      </label>
      <input type="text" name="title" value="{{ old('title', $article->title) }}" required
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
        placeholder="Masukkan judul artikel yang menarik...">
      @error('title')
      <p class="text-red-500 text-sm mt-1 flex items-center">
      <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>{{ $message }}
      </p>
    @enderror
      </div>

      <!-- Excerpt Field -->
      <div>
      <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
        <i data-lucide="file-text" class="w-4 h-4 mr-2 text-purple-500"></i>
        Excerpt (ringkasan)
      </label>
      <input type="text" name="excerpt" value="{{ old('excerpt', $article->excerpt) }}"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
        placeholder="Ringkasan singkat yang menarik perhatian...">
      @error('excerpt')
      <p class="text-red-500 text-sm mt-1 flex items-center">
      <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>{{ $message }}
      </p>
    @enderror
      </div> <!-- Content Field -->
      <div>
      <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
        <i data-lucide="align-left" class="w-4 h-4 mr-2 text-green-500"></i>
        Isi Artikel <span class="text-red-500 ml-1">*</span>
      </label>
      <textarea name="content" rows="8" required
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors resize-y"
        placeholder="Tulis konten artikel yang informatif dan bermanfaat...">{{ old('content', $article->content) }}</textarea>
      <div class="flex justify-between text-sm text-gray-500 mt-1">
        <span>Gunakan format HTML jika diperlukan</span>
        <span id="contentCounter">0 karakter</span>
      </div>
      @error('content')
      <p class="text-red-500 text-sm mt-1 flex items-center">
      <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>{{ $message }}
      </p>
    @enderror
      </div>

      <!-- Category Field -->
      <div>
      <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
        <i data-lucide="tag" class="w-4 h-4 mr-2 text-blue-500"></i>
        Kategori
      </label>
      <select name="category"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
        <option value="">Pilih Kategori</option>
        <option value="Diet Tips" {{ old('category', $article->category) == 'Diet Tips' ? 'selected' : '' }}>Diet Tips
        </option>
        <option value="Nutrition" {{ old('category', $article->category) == 'Nutrition' ? 'selected' : '' }}>Nutrition
        </option>
        <option value="Exercise" {{ old('category', $article->category) == 'Exercise' ? 'selected' : '' }}>Exercise
        </option>
        <option value="Health" {{ old('category', $article->category) == 'Health' ? 'selected' : '' }}>Health</option>
        <option value="Lifestyle" {{ old('category', $article->category) == 'Lifestyle' ? 'selected' : '' }}>Lifestyle
        </option>
        <option value="Recipe" {{ old('category', $article->category) == 'Recipe' ? 'selected' : '' }}>Recipe</option>
      </select>
      @error('category')
      <p class="text-red-500 text-sm mt-1 flex items-center">
      <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>{{ $message }}
      </p>
    @enderror
      </div>

      <!-- Read Time Field -->
      <div>
      <label class="flex items-center text-sm font-semibold text-gray-700 mb-2">
        <i data-lucide="clock" class="w-4 h-4 mr-2 text-indigo-500"></i>
        Waktu Baca
      </label>
      <div class="relative">
        <input type="text" name="read_time" value="{{ old('read_time', $article->read_time) }}"
        class="w-full px-4 py-3 pr-16 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
        placeholder="5">
        <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">menit</span>
      </div>
      @error('read_time')
      <p class="text-red-500 text-sm mt-1 flex items-center">
      <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>{{ $message }}
      </p>
    @enderror
      </div>

      <!-- Featured Image Field -->
      <div>
      <label class="text-sm font-semibold text-gray-700 mb-2 block">
        <i data-lucide="image" class="w-4 h-4 mr-2 text-pink-500 inline"></i>
        Gambar (opsional)
      </label>
      <div class="space-y-3">
        <input type="file" name="image" accept="image/*"
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
        @if($article->image)
      <div class="relative inline-block">
      <img src="{{ $article->image }}" alt="Gambar Artikel"
        class="w-32 h-32 object-cover rounded-lg shadow-sm border border-gray-200">
      <div class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs px-2 py-1 rounded-full">
        Current
      </div>
      </div>
      @endif
      </div>
      @error('image')
      <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
      <a href="{{ route('admin.articles.index') }}"
        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
        <i data-lucide="x" class="w-4 h-4 mr-2"></i>
        Batal
      </a>
      <button type="submit"
        class="bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
        <i data-lucide="save" class="w-4 h-4 mr-2"></i>
        Update Artikel
      </button>
      </div>
    </form>
    </div>
  </div>

  <script>
    lucide.createIcons();

    // Character counter for content
    const contentTextarea = document.querySelector('textarea[name="content"]');
    const contentCounter = document.getElementById('contentCounter');

    if (contentTextarea && contentCounter) {
    function updateCounter() {
      const count = contentTextarea.value.length;
      contentCounter.textContent = `${count} karakter`;

      if (count > 1000) {
      contentCounter.classList.add('text-orange-500', 'font-semibold');
      } else {
      contentCounter.classList.remove('text-orange-500', 'font-semibold');
      }
    }

    contentTextarea.addEventListener('input', updateCounter);
    updateCounter(); // Initial count
    }

    // Auto-resize textarea
    if (contentTextarea) {
    contentTextarea.addEventListener('input', function () {
      this.style.height = 'auto';
      this.style.height = (this.scrollHeight) + 'px';
    });

    // Set initial height
    contentTextarea.style.height = 'auto';
    contentTextarea.style.height = (contentTextarea.scrollHeight) + 'px';
    }
    // Form validation enhancement
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
    const title = document.querySelector('input[name="title"]').value.trim();
    const content = document.querySelector('textarea[name="content"]').value.trim();

    if (!title || !content) {
      e.preventDefault();
      showError('Validasi Gagal', 'Judul dan isi artikel harus diisi!');
      return false;
    }

    if (title.length < 5) {
      e.preventDefault();
      showError('Validasi Gagal', 'Judul artikel minimal 5 karakter!');
      return false;
    }

    if (content.length < 20) {
      e.preventDefault();
      showError('Validasi Gagal', 'Isi artikel minimal 20 karakter!');
      return false;
    }

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalContent = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 mr-2 animate-spin"></i>Memperbarui...';
    submitBtn.disabled = true;

    // Show processing notification
    showInfo('Memproses...', 'Artikel sedang diperbarui, mohon tunggu sebentar.');

    // Re-enable button if form submission fails
    setTimeout(() => {
      if (submitBtn.disabled) {
      submitBtn.innerHTML = originalContent;
      submitBtn.disabled = false;
      lucide.createIcons();
      }
    }, 10000);
    });
  </script>
@endsection