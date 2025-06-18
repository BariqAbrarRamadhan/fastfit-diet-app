@extends('admin.layouts.app')

@section('title', 'Rekomendasi Makanan')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Rekomendasi Makanan</h1>
                    <p class="text-gray-600">Kelola database makanan untuk berbagai program diet</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <i data-lucide="utensils" class="w-4 h-4 mr-2"></i>
                        Total: {{ $foodRecommendations->total() }} rekomendasi makanan
                    </div>
                </div>
                <div class="flex items-center mt-4 md:mt-0">
                    <a href="{{ route('admin.food-recommendations.create') }}"
                        class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-medium">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Tambah Makanan
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
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Rekomendasi Makanan</h2>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                            <input type="text" id="searchInput" placeholder="Cari makanan..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent w-48" />
                        </div>
                        <select id="dietTypeFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Diet</option>
                            @foreach($dietTypes as $key => $value)
                                <option value="{{ $key }}" {{ request('diet_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select id="mealTypeFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Waktu</option>
                            @foreach($mealTypes as $key => $value)
                                <option value="{{ $key }}" {{ request('meal_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select id="dayFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Hari</option>
                            @foreach($dayTypes as $key => $value)
                                <option value="{{ $key }}" {{ request('day') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                        <select id="statusFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <button onclick="refreshTable()"
                            class="p-2 text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
                            title="Refresh">
                            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Makanan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Diet
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Waktu Makan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hari
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kalori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($foodRecommendations as $food)
                            <tr class="food-row hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-purple-600 flex items-center justify-center">
                                                <i data-lucide="utensils" class="w-5 h-5 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $food->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($food->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1">
                                        @if(is_array($food->diet_types))
                                            @foreach($food->diet_types as $dietType)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $dietType }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $mealTypes[$food->meal_type] ?? $food->meal_type }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($food->day)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $dayTypes[$food->day] ?? $food->day }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($food->calories_per_serving)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            {{ $food->calories_per_serving }} kal
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($food->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.food-recommendations.show', $food) }}" 
                                           class="text-gray-400 hover:text-blue-600 transition-colors" title="Lihat">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.food-recommendations.edit', $food) }}" 
                                           class="text-gray-400 hover:text-orange-600 transition-colors" title="Edit">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.food-recommendations.destroy', $food) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-gray-400 hover:text-red-600 transition-colors" 
                                                    title="Hapus" 
                                                    onclick="return confirm('Yakin ingin menghapus makanan ini?')">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mb-4">
                                            <i data-lucide="utensils" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Rekomendasi Makanan</h3>
                                        <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan rekomendasi makanan pertama</p>
                                        <a href="{{ route('admin.food-recommendations.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-medium">
                                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                            Tambah Makanan
                                        </a>
                                    </div>
                                </td>
                            </tr>                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($foodRecommendations->hasPages())
                <div class="border-t border-gray-200 p-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex items-center text-sm text-gray-600 mb-4 md:mb-0">
                            <i data-lucide="utensils" class="w-4 h-4 mr-2"></i>
                            Menampilkan {{ $foodRecommendations->firstItem() ?? 0 }} hingga {{ $foodRecommendations->lastItem() ?? 0 }} dari {{ $foodRecommendations->total() ?? 0 }} makanan
                        </div>
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($foodRecommendations->onFirstPage())
                                <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded border cursor-not-allowed">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </span>
                            @else
                                <a href="{{ $foodRecommendations->previousPageUrl() }}" class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($foodRecommendations->getUrlRange(max(1, $foodRecommendations->currentPage() - 2), min($foodRecommendations->lastPage(), $foodRecommendations->currentPage() + 2)) as $page => $url)
                                @if ($page == $foodRecommendations->currentPage())
                                    <span class="px-3 py-1 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded font-medium">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($foodRecommendations->hasMorePages())
                                <a href="{{ $foodRecommendations->nextPageUrl() }}" class="px-3 py-1 text-gray-600 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
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
        const searchInput = document.getElementById('searchInput');
        const dietTypeFilter = document.getElementById('dietTypeFilter');
        const mealTypeFilter = document.getElementById('mealTypeFilter');
        const dayFilter = document.getElementById('dayFilter');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('.food-row');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedDietType = dietTypeFilter.value.toLowerCase();
            const selectedMealType = mealTypeFilter.value.toLowerCase();
            const selectedDay = dayFilter.value.toLowerCase();
            const selectedStatus = statusFilter.value;
            let visibleCount = 0;

            tableRows.forEach(row => {
                const nameElement = row.querySelector('.text-sm.font-medium');
                const dietElements = row.querySelectorAll('td:nth-child(2) .inline-flex');
                const mealElement = row.querySelector('td:nth-child(3) .inline-flex');
                const dayElement = row.querySelector('td:nth-child(4) .inline-flex');
                const statusElement = row.querySelector('td:nth-child(6) .inline-flex');

                if (nameElement && mealElement) {
                    const name = nameElement.textContent.toLowerCase();
                    const meal = mealElement.textContent.toLowerCase();
                    
                    let dietMatch = !selectedDietType;
                    if (selectedDietType) {
                        dietElements.forEach(element => {
                            if (element.textContent.toLowerCase().includes(selectedDietType)) {
                                dietMatch = true;
                            }
                        });
                    }

                    let dayMatch = !selectedDay;
                    if (selectedDay && dayElement) {
                        dayMatch = dayElement.textContent.toLowerCase().includes(selectedDay);
                    } else if (!selectedDay) {
                        dayMatch = true;
                    }

                    let statusMatch = !selectedStatus;
                    if (selectedStatus && statusElement) {
                        const isActive = statusElement.textContent.toLowerCase().includes('aktif') && !statusElement.textContent.toLowerCase().includes('tidak aktif');
                        statusMatch = (selectedStatus === '1' && isActive) || (selectedStatus === '0' && !isActive);
                    } else if (!selectedStatus) {
                        statusMatch = true;
                    }

                    const matchesSearch = name.includes(searchTerm);
                    const matchesMeal = !selectedMealType || meal.includes(selectedMealType);

                    if (matchesSearch && dietMatch && matchesMeal && dayMatch && statusMatch) {
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
        if (dietTypeFilter) dietTypeFilter.addEventListener('change', filterTable);
        if (mealTypeFilter) mealTypeFilter.addEventListener('change', filterTable);
        if (dayFilter) dayFilter.addEventListener('change', filterTable);
        if (statusFilter) statusFilter.addEventListener('change', filterTable);

        function refreshTable() {
            searchInput.value = '';
            dietTypeFilter.value = '';
            mealTypeFilter.value = '';
            dayFilter.value = '';
            statusFilter.value = '';
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

<script>
    // Initialize Lucide icons
    lucide.createIcons();
    
    // View toggle functionality
    function toggleView(view) {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const tableBtn = document.getElementById('tableViewBtn');
        const gridBtn = document.getElementById('gridViewBtn');
        
        if (view === 'table') {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            tableBtn.classList.add('bg-orange-500', 'text-white');
            tableBtn.classList.remove('bg-gray-300', 'text-gray-600');
            gridBtn.classList.add('bg-gray-300', 'text-gray-600');
            gridBtn.classList.remove('bg-orange-500', 'text-white');
        } else {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            gridBtn.classList.add('bg-orange-500', 'text-white');
            gridBtn.classList.remove('bg-gray-300', 'text-gray-600');
            tableBtn.classList.add('bg-gray-300', 'text-gray-600');
            tableBtn.classList.remove('bg-orange-500', 'text-white');
        }
        
        // Reinitialize icons for the new view
        lucide.createIcons();
    }
    
    // Export functionality (placeholder)
    function exportData() {
        alert('Fitur export akan segera tersedia!');
    }
    
    // Add smooth scroll to top when pagination is clicked
    document.addEventListener('DOMContentLoaded', function() {
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(() => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }, 100);
            });
        });
    });
</script>

@endsection
