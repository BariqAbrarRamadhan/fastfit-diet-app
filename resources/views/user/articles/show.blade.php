@extends('user.layouts.app')

@section('title', $article->title)

@section('content')
  <div class="min-h-screen">
    <!-- Back Navigation -->
    <div class="mb-6">
    <a href="{{ route('articles.index') }}"
      class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-xl shadow-sm border border-gray-200 text-gray-600 hover:text-orange-600 hover:border-orange-200 transition-all duration-300">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      Kembali ke Artikel
    </a>
    </div>

    <!-- Article Content -->
    <article class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden mb-8">
    <!-- Article Header -->
    @if($article->image)
    <div class="relative h-64 md:h-96 bg-gradient-to-br from-orange-100 to-purple-100 overflow-hidden">
      <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover" />
      <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>

      <!-- Article Title Overlay -->
      <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
      @if($article->category)
      <div class="mb-3">
      <span
      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-white/20 backdrop-blur-sm">
      <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
      {{ $article->category }}
      </span>
      </div>
    @endif
      <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $article->title }}</h1>
      </div>
    </div>
    @else
    <div class="p-8 border-b border-gray-100">
      @if($article->category)
      <div class="mb-4">
      <span
      class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-700">
      <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
      {{ $article->category }}
      </span>
      </div>
    @endif
      <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
    </div>
    @endif

    <!-- Article Meta -->
    <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
      <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600">
      <div class="flex items-center gap-2">
        <i data-lucide="calendar" class="w-4 h-4 text-orange-500"></i>
        <span>Dipublikasikan {{ $article->created_at->format('d M Y') }}</span>
      </div>

      @if($article->read_time)
      <div class="flex items-center gap-2">
      <i data-lucide="clock" class="w-4 h-4 text-purple-500"></i>
      <span>{{ $article->read_time }} baca</span>
      </div>
    @endif

      <div class="flex items-center gap-2">
        <i data-lucide="user" class="w-4 h-4 text-blue-500"></i>
        <span>Admin FastFit</span>
      </div>
      </div>
    </div>

    <!-- Article Excerpt -->
    @if($article->excerpt)
    <div class="px-8 py-6 bg-gradient-to-r from-orange-50 to-purple-50 border-b border-gray-100">
      <div class="flex items-start gap-4">
      <div
      class="w-12 h-12 bg-gradient-to-r from-orange-400 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
      <i data-lucide="quote" class="w-6 h-6 text-white"></i>
      </div>
      <div>
      <h3 class="font-semibold text-gray-900 mb-2">Ringkasan</h3>
      <p class="text-gray-700 italic leading-relaxed">{{ $article->excerpt }}</p>
      </div>
      </div>
    </div>
    @endif

    <!-- Article Content -->
    <div class="px-8 py-8">
      <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
      {!! nl2br(e($article->content)) !!}
      </div>
    </div>

    <!-- Article Footer -->
    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <div class="text-sm text-gray-500">
        <p>Artikel ini dipublikasikan pada {{ $article->created_at->format('d M Y, H:i') }}</p>
        @if($article->updated_at != $article->created_at)
      <p>Terakhir diperbarui: {{ $article->updated_at->format('d M Y, H:i') }}</p>
      @endif
      </div>

      <!-- Share Buttons -->
      <div class="flex items-center gap-3">
        <span class="text-sm text-gray-600 font-medium">Bagikan:</span>
        <button onclick="shareArticle()"
        class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors duration-300"
        title="Bagikan artikel">
        <i data-lucide="share-2" class="w-4 h-4"></i>
        </button>
        <button onclick="copyLink()"
        class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition-colors duration-300"
        title="Salin link">
        <i data-lucide="link" class="w-4 h-4"></i>
        </button>
      </div>
      </div>
    </div>
    </article>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
    <div class="flex items-center gap-3 mb-6">
      <div class="w-8 h-8 bg-gradient-to-r from-orange-400 to-purple-500 rounded-lg flex items-center justify-center">
      <i data-lucide="book-open" class="w-4 h-4 text-white"></i>
      </div>
      <h2 class="text-2xl font-bold text-gray-900">Artikel Terkait</h2>
    </div>

    <div
      class="grid grid-cols-1 md:grid-cols-{{ $relatedArticles->count() > 2 ? '3' : $relatedArticles->count() }} gap-6">
      @foreach($relatedArticles as $related)
      <article class="group">
      <a href="{{ route('articles.show', $related) }}" class="block">
      @if($related->image)
      <div class="relative h-40 bg-gradient-to-br from-orange-100 to-purple-100 rounded-lg overflow-hidden mb-4">
      <img src="{{ $related->image }}" alt="{{ $related->title }}"
      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
      </div>
      @else
      <div
      class="h-40 bg-gradient-to-br from-orange-100 to-purple-100 rounded-lg flex items-center justify-center mb-4">
      <i data-lucide="book-open" class="w-8 h-8 text-orange-300"></i>
      </div>
      @endif

      <h3
      class="font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-orange-600 transition-colors duration-300">
      {{ $related->title }}
      </h3>

      @if($related->excerpt)
      <p class="text-gray-600 text-sm mb-3 line-clamp-2">
      {{ $related->excerpt }}
      </p>
      @endif

      <div class="flex items-center gap-4 text-xs text-gray-500">
      <span class="flex items-center gap-1">
      <i data-lucide="calendar" class="w-3 h-3"></i>
      {{ $related->created_at->format('d M Y') }}
      </span>
      @if($related->read_time)
      <span class="flex items-center gap-1">
      <i data-lucide="clock" class="w-3 h-3"></i>
      {{ $related->read_time }}
      </span>
      @endif
      </div>
      </a>
      </article>
    @endforeach
    </div>

    <div class="mt-8 text-center">
      <a href="{{ route('articles.index') }}"
      class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl font-semibold hover:from-orange-600 hover:to-purple-700 transition-all duration-300">
      <i data-lucide="book-open" class="w-4 h-4"></i>
      Lihat Semua Artikel
      </a>
    </div>
    </div>
    @endif
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Share article function
    function shareArticle() {
    const url = window.location.href;
    const title = "{{ $article->title }}";

    if (navigator.share) {
      navigator.share({
      title: title,
      url: url
      }).catch(console.error);
    } else {
      copyLink();
    }
    }

    // Copy link function
    function copyLink() {
    const url = window.location.href;

    if (navigator.clipboard) {
      navigator.clipboard.writeText(url).then(() => {
      // Create temporary notification
      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
      notification.textContent = 'Link berhasil disalin!';
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 3000);
      });
    }
    }

    // Add entrance animation
    document.addEventListener('DOMContentLoaded', function () {
    const article = document.querySelector('article');
    article.style.opacity = '0';
    article.style.transform = 'translateY(20px)';
    article.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

    setTimeout(() => {
      article.style.opacity = '1';
      article.style.transform = 'translateY(0)';
    }, 100);
    });
  </script>
@endsection