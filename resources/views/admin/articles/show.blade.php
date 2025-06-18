@extends('admin.layouts.app')

@section('title', 'Detail Artikel')

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
        <h1 class="text-2xl font-bold text-gray-900">Detail Artikel</h1>
        <p class="text-gray-600">Informasi lengkap artikel</p>
      </div>
      </div>
      <div class="flex items-center space-x-3">
      <a href="{{ route('admin.articles.edit', $article) }}"
        class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
        <i data-lucide="edit-3" class="w-4 h-4 mr-2"></i>
        Edit
      </a>
      <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline-block"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
        @csrf
        @method('DELETE')
        <button type="submit"
        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
        Hapus
        </button>
      </form>
      <a href="{{ route('admin.articles.index') }}"
        class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
        Kembali
      </a>
      </div>
    </div>
    </div>

    <!-- Article Content -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <!-- Article Header -->
    <div class="p-6 border-b border-gray-200">
      <h2 class="text-3xl font-bold text-gray-900 mb-4 leading-tight">
      {{ $article->title }}
      </h2>

      <!-- Article Meta -->
      <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
      <div class="flex items-center space-x-2">
        <i data-lucide="calendar" class="w-4 h-4 text-orange-500"></i>
        <span>{{ $article->created_at->format('d M Y') }}</span>
      </div>

      @if($article->category)
      <div class="flex items-center space-x-2">
      <i data-lucide="tag" class="w-4 h-4 text-purple-500"></i>
      <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold">
      {{ $article->category }}
      </span>
      </div>
    @endif

      @if($article->read_time)
      <div class="flex items-center space-x-2">
      <i data-lucide="clock" class="w-4 h-4 text-green-500"></i>
      <span>{{ $article->read_time }} menit</span>
      </div>
    @endif

      <div class="flex items-center space-x-2">
        <i data-lucide="eye" class="w-4 h-4 text-blue-500"></i>
        <span>{{ $article->views ?? 0 }} views</span>
      </div>
      </div>

      <!-- Excerpt -->
      @if($article->excerpt)
      <div class="mt-4 p-4 bg-orange-50 rounded-lg border-l-4 border-orange-500">
      <p class="text-gray-700 italic leading-relaxed">{{ $article->excerpt }}</p>
      </div>
    @endif
    </div>

    <!-- Article Image -->
    @if($article->image)
    <div class="p-6 border-b border-gray-200">
      <div class="rounded-lg overflow-hidden shadow-sm">
      <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-64 object-cover">
      </div>
    </div>
    @endif

    <!-- Article Content -->
    <div class="p-6">
      <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
      {!! nl2br(e($article->content)) !!}
      </div>
    </div>

    <!-- Article Footer -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
      <div class="flex items-center justify-between">
      <div class="text-sm text-gray-500">
        <p>Dibuat: {{ $article->created_at->format('d M Y, H:i') }}</p>
        @if($article->updated_at != $article->created_at)
      <p>Diperbarui: {{ $article->updated_at->format('d M Y, H:i') }}</p>
      @endif
      </div>

      <div class="flex items-center space-x-2">
        <span
        class="px-3 py-1 text-xs font-semibold rounded-full
              {{ $article->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
        {{ ucfirst($article->status ?? 'draft') }}
        </span>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script>
    lucide.createIcons();

    function duplicateArticle() {
    if (confirm('Apakah Anda ingin menduplikat artikel ini?')) {
      // You can implement duplicate functionality here
      alert('Fitur duplikat akan segera tersedia!');
    }
    }

    function shareArticle() {
    const url = window.location.href;
    const title = "{{ $article->title }}";

    if (navigator.share) {
      navigator.share({
      title: title,
      url: url
      });
    } else {
      // Fallback: copy to clipboard
      navigator.clipboard.writeText(url).then(() => {
      alert('Link artikel berhasil disalin!');
      });
    }
    }
  </script>
@endsection