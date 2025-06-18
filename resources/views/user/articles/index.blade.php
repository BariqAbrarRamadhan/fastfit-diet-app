@extends('user.layouts.app')

@section('title', 'Artikel Kesehatan & Diet')

@section('content')
  <div class="min-h-screen">
    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
    <div class="text-center">
      <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-4">
      Artikel Kesehatan & Diet
      </h1>
      <p class="text-gray-600 text-lg max-w-2xl mx-auto">
      Temukan tips, panduan, dan informasi terbaru seputar kesehatan, diet, dan gaya hidup sehat
      </p>
    </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
    <form method="GET" action="{{ route('articles.index') }}" class="flex flex-col md:flex-row gap-4">
      <div class="flex-1 relative">
      <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
        <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
      </div>
      <input type="text" name="search" value="{{ $search }}"
        placeholder="Cari artikel berdasarkan judul atau konten..."
        class="block w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300" />
      </div>

      <div class="md:w-48">
      <select name="category"
        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-300">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
      <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>
      {{ $cat }}
      </option>
      @endforeach
      </select>
      </div>

      <div class="flex gap-2">
      <button type="submit"
        class="px-6 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-purple-700 transition-all duration-300 flex items-center gap-2">
        <i data-lucide="search" class="w-4 h-4"></i>
        Cari
      </button>

      @if($search || $category)
      <a href="{{ route('articles.index') }}"
      class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 flex items-center gap-2">
      <i data-lucide="x" class="w-4 h-4"></i>
      Reset
      </a>
    @endif
      </div>
    </form>
    </div>

    <!-- Articles Grid -->
    @if($articles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
    @foreach($articles as $article)
    <article
      class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 group">
      @if($article->image)
      <div class="relative h-48 bg-gradient-to-br from-orange-100 to-purple-100 overflow-hidden">
      <img src="{{ $article->image }}" alt="{{ $article->title }}"
      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
      </div>
    @else
      <div class="h-48 bg-gradient-to-br from-orange-100 to-purple-100 flex items-center justify-center">
      <i data-lucide="book-open" class="w-16 h-16 text-orange-300"></i>
      </div>
    @endif

      <div class="p-6">
      @if($article->category)
      <div class="mb-3">
      <span
      class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
      <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
      {{ $article->category }}
      </span>
      </div>
    @endif

      <h3
      class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-orange-600 transition-colors duration-300">
      {{ $article->title }}
      </h3>

      @if($article->excerpt)
      <p class="text-gray-600 text-sm mb-4 line-clamp-3">
      {{ $article->excerpt }}
      </p>
    @endif

      <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
      <div class="flex items-center gap-4">
      <span class="flex items-center gap-1">
      <i data-lucide="calendar" class="w-4 h-4"></i>
      {{ $article->created_at->format('d M Y') }}
      </span>
      @if($article->read_time)
      <span class="flex items-center gap-1">
      <i data-lucide="clock" class="w-4 h-4"></i>
      {{ $article->read_time }}
      </span>
      @endif
      </div>
      </div>

      <a href="{{ route('articles.show', $article) }}"
      class="inline-flex items-center gap-2 text-orange-600 font-semibold hover:text-orange-700 transition-colors duration-300">
      Baca Selengkapnya
      <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
      </a>
      </div>
    </article>
    @endforeach
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="text-sm text-gray-600 mb-4 md:mb-0">
      Menampilkan {{ $articles->firstItem() }} hingga {{ $articles->lastItem() }} dari {{ $articles->total() }}
      artikel
      </div>
      <div>
      {{ $articles->appends(request()->query())->links() }}
      </div>
    </div>
    </div>
    @endif
    @else
    <!-- Empty State -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
    <div
      class="w-24 h-24 bg-gradient-to-br from-orange-100 to-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
      <i data-lucide="book-open" class="w-12 h-12 text-orange-400"></i>
    </div>
    <h3 class="text-2xl font-bold text-gray-900 mb-4">
      @if($search || $category)
      Artikel Tidak Ditemukan
    @else
      Belum Ada Artikel
    @endif
    </h3>
    <p class="text-gray-600 mb-6 max-w-md mx-auto">
      @if($search || $category)
      Maaf, tidak ada artikel yang sesuai dengan pencarian Anda. Coba dengan kata kunci yang berbeda.
    @else
      Artikel kesehatan dan diet akan segera tersedia untuk membantu perjalanan sehat Anda.
    @endif
    </p>
    @if($search || $category)
    <a href="{{ route('articles.index') }}"
      class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-purple-700 transition-all duration-300">
      <i data-lucide="refresh-cw" class="w-4 h-4"></i>
      Lihat Semua Artikel
    </a>
    @endif
    </div>
    @endif
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Add entrance animations
    document.addEventListener('DOMContentLoaded', function () {
    const articles = document.querySelectorAll('article');
    articles.forEach((article, index) => {
      article.style.opacity = '0';
      article.style.transform = 'translateY(20px)';
      article.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

      setTimeout(() => {
      article.style.opacity = '1';
      article.style.transform = 'translateY(0)';
      }, index * 100);
    });
    });
  </script>
@endsection