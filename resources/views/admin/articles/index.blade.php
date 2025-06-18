@extends('admin.layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')
  <div class="p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div>
      <h1 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Artikel</h1>
      <p class="text-gray-600">Kelola dan pantau artikel untuk pengguna aplikasi diet</p>
      <div class="flex items-center mt-2 text-sm text-gray-500">
        <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
        Total: {{ $articles->total() ?? 0 }} artikel
      </div>
      </div>
      <div class="flex items-center mt-4 md:mt-0">
      <a href="{{ route('admin.articles.create') }}"
        class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-colors font-medium">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Artikel
      </a>
      </div>
    </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
    <div class="flex items-center">
      <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
      <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
      </div>
      <div>
      <h4 class="font-medium text-green-800">Berhasil!</h4>
      <p class="text-green-700 text-sm">{{ session('success') }}</p>
      </div>
    </div>
    </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <!-- Filters -->
    <div class="border-b border-gray-200 p-4">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
      <h2 class="text-lg font-semibold text-gray-900">Daftar Artikel</h2>
      <div class="flex items-center space-x-3">
        <div class="relative">
        <i data-lucide="search"
          class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
        <input type="text" id="searchArticles" placeholder="Cari artikel..."
          class="pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent w-48" />
        </div>
        <select id="categoryFilter"
        class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
        <option value="">Semua Kategori</option>
        <option value="Diet Tips">Diet Tips</option>
        <option value="Nutrition">Nutrition</option>
        <option value="Exercise">Exercise</option>
        <option value="Health">Health</option>
        <option value="Lifestyle">Lifestyle</option>
        <option value="Recipe">Recipe</option>
        </select>
        <button onclick="refreshTable()"
        class="p-2 text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
        title="Refresh">
        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
        </button>
      </div>
      </div>
    </div> <!-- Table Content -->
    <div class="overflow-x-auto">
      <table class="w-full">
      <thead>
        <tr class="bg-gray-50 border-b border-gray-200">
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Artikel
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Kategori
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Waktu Baca
        </th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
          Tanggal
        </th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
          Aksi
        </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        @forelse($articles as $article)
      <tr class="article-row hover:bg-gray-50">
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
        <div class="flex-shrink-0 h-10 w-10">
        <div
        class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-purple-600 flex items-center justify-center">
        <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
        </div>
        </div>
        <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
        {{ $article->title }}
        </div>
        <div class="text-sm text-gray-500">ID: #{{ $article->id }}</div>
        </div>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <span
        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
        {{ $article->category }}
        </span>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
        <i data-lucide="clock" class="w-4 h-4 mr-2 text-gray-400"></i>
        <span class="text-sm text-gray-900">{{ $article->read_time }}</span>
        </div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm text-gray-900">{{ $article->created_at->format('d M Y') }}</div>
        <div class="text-sm text-gray-500">{{ $article->created_at->diffForHumans() }}</div>
      </td>
      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex items-center justify-end space-x-2">
        <a href="{{ route('admin.articles.show', $article) }}"
        class="text-gray-400 hover:text-blue-600 transition-colors" title="Lihat">
        <i data-lucide="eye" class="w-4 h-4"></i>
        </a>
        <a href="{{ route('admin.articles.edit', $article) }}"
        class="text-gray-400 hover:text-orange-600 transition-colors" title="Edit">
        <i data-lucide="edit" class="w-4 h-4"></i>
        </a>
        <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Hapus"
        onclick="return confirm('Yakin ingin menghapus artikel ini?')">
        <i data-lucide="trash-2" class="w-4 h-4"></i>
        </button>
        </form>
        </div>
      </td>
      </tr>
      @empty
      <tr class="empty-row">
      <td colspan="5" class="px-6 py-12 text-center">
        <div class="flex flex-col items-center justify-center">
        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mb-4">
        <i data-lucide="file-text" class="w-8 h-8 text-gray-400"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Artikel</h3>
        <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan artikel pertama</p>
        <a href="{{ route('admin.articles.create') }}"
        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-medium">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Artikel
        </a>
        </div>
      </td>
      </tr> @endforelse
      </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="border-t border-gray-200 p-4">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between">
      <div class="flex items-center text-sm text-gray-600 mb-4 md:mb-0">
      <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
      Menampilkan {{ $articles->firstItem() ?? 0 }} hingga {{ $articles->lastItem() ?? 0 }} dari
      {{ $articles->total() ?? 0 }} artikel
      </div>
      <div class="flex items-center space-x-2">
      {{-- Previous Page Link --}}
      @if ($articles->onFirstPage())
      <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded border cursor-not-allowed">
      <i data-lucide="chevron-left" class="w-4 h-4"></i>
      </span>
      @else
      <a href="{{ $articles->previousPageUrl() }}"
      class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
      <i data-lucide="chevron-left" class="w-4 h-4"></i>
      </a>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($articles->getUrlRange(max(1, $articles->currentPage() - 2), min($articles->lastPage(), $articles->currentPage() + 2)) as $page => $url)
      @if ($page == $articles->currentPage())
      <span class="px-3 py-1 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded font-medium">
      {{ $page }}
      </span>
      @else
      <a href="{{ $url }}"
      class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
      {{ $page }}
      </a>
      @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($articles->hasMorePages())
      <a href="{{ $articles->nextPageUrl() }}"
      class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
      <i data-lucide="chevron-right" class="w-4 h-4"></i>
      </a>
      @else
      <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded border cursor-not-allowed">
      <i data-lucide="chevron-right" class="w-4 h-4"></i>
      </span>
      @endif
      </div>
      </div>
    </div>
    @endif
    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Search functionality
    const searchInput = document.getElementById('searchArticles');
    const categoryFilter = document.getElementById('categoryFilter');
    const tableRows = document.querySelectorAll('.article-row');

    function filterTable() {
    const searchTerm = searchInput.value.toLowerCase();
    const selectedCategory = categoryFilter.value.toLowerCase();
    let visibleCount = 0;

    tableRows.forEach(row => {
      const titleElement = row.querySelector('.text-sm.font-medium');
      const categoryElement = row.querySelector('td:nth-child(2) span');

      if (titleElement && categoryElement) {
      const title = titleElement.textContent.toLowerCase();
      const category = categoryElement.textContent.toLowerCase();

      const matchesSearch = title.includes(searchTerm);
      const matchesCategory = !selectedCategory || category.includes(selectedCategory);

      if (matchesSearch && matchesCategory) {
        row.style.display = '';
        visibleCount++;
      } else {
        row.style.display = 'none';
      }
      }
    });

    // Show/hide empty state
    const emptyRow = document.querySelector('.empty-row');
    if (emptyRow && tableRows.length > 0) {
      emptyRow.style.display = visibleCount === 0 ? '' : 'none';
    }
    }

    // Add event listeners
    if (searchInput) searchInput.addEventListener('input', filterTable);
    if (categoryFilter) categoryFilter.addEventListener('change', filterTable);

    function refreshTable() {
    searchInput.value = '';
    categoryFilter.value = '';
    filterTable();

    // Add loading animation
    const refreshBtn = document.querySelector('[onclick="refreshTable()"]');
    const icon = refreshBtn.querySelector('i');
    icon.classList.add('animate-spin');

    setTimeout(() => {
      icon.classList.remove('animate-spin');
    }, 1000);
    }
  </script>

@endsection