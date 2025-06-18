@extends('admin.layouts.app')

@section('title', 'Rekomendasi Olahraga')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Manajemen Rekomendasi Olahraga</h1>
                    <p class="text-gray-600">Kelola database olahraga untuk berbagai program kesehatan</p>
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <i data-lucide="activity" class="w-4 h-4 mr-2"></i>
                        Total: {{ $exercises->total() }} rekomendasi olahraga
                    </div>
                </div>
                <div class="flex items-center mt-4 md:mt-0">
                    <a href="{{ route('admin.exercise-recommendations.create') }}"
                        class="flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-medium">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Tambah Olahraga
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
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"> <!-- Filters -->
            <div class="border-b border-gray-200 p-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Rekomendasi Olahraga</h2>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <i data-lucide="search"
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                            <input type="text" id="searchInput" placeholder="Cari olahraga..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent w-48" />
                        </div>
                        <select id="categoryFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <select id="goalFilter"
                            class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">Semua Tujuan</option>
                            @foreach($goals as $key => $value)
                                <option value="{{ $key }}" {{ request('goal') == $key ? 'selected' : '' }}>{{ $value }}</option>
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
            </div> <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Olahraga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tujuan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Level Aktivitas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kalori/Jam
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
                        @forelse($exercises as $exercise)
                            <tr class="exercise-row hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="w-10 h-10 rounded-lg bg-gradient-to-r from-orange-500 to-purple-600 flex items-center justify-center">
                                                <i data-lucide="activity" class="w-5 h-5 text-white"></i>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $exercise->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($exercise->description, 50) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $categories[$exercise->category] ?? $exercise->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        {{ $goals[$exercise->goal] ?? $exercise->goal }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $exercise->activity_level_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($exercise->calories_burned_per_hour)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                            {{ $exercise->calories_burned_per_hour }} kal
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($exercise->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.exercise-recommendations.show', $exercise) }}"
                                            class="text-gray-400 hover:text-blue-600 transition-colors" title="Lihat">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.exercise-recommendations.edit', $exercise) }}"
                                            class="text-gray-400 hover:text-orange-600 transition-colors" title="Edit">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form method="POST"
                                            action="{{ route('admin.exercise-recommendations.destroy', $exercise) }}"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors"
                                                title="Hapus" onclick="return confirm('Yakin ingin menghapus olahraga ini?')">
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
                                            <i data-lucide="activity" class="w-8 h-8 text-gray-400"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Rekomendasi Olahraga</h3>
                                        <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan rekomendasi olahraga
                                            pertama</p>
                                        <a href="{{ route('admin.exercise-recommendations.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-medium">
                                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                            Tambah Olahraga
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($exercises->hasPages())
                <div class="bg-gray-50 border-t border-gray-200 px-6 py-3">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan {{ $exercises->firstItem() ?? 0 }} hingga {{ $exercises->lastItem() ?? 0 }} dari
                            {{ $exercises->total() ?? 0 }} olahraga
                        </div>
                        <div class="flex items-center space-x-2">
                            {{-- Previous Page Link --}}
                            @if ($exercises->onFirstPage())
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </span>
                            @else
                                <a href="{{ $exercises->appends(request()->query())->previousPageUrl() }}"
                                    class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600 transition-all duration-300">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($exercises->appends(request()->query())->getUrlRange(max(1, $exercises->currentPage() - 2), min($exercises->lastPage(), $exercises->currentPage() + 2)) as $page => $url)
                                @if ($page == $exercises->currentPage())
                                    <span
                                        class="px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg font-bold shadow-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-4 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600 transition-all duration-300 font-medium">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($exercises->hasMorePages())
                                <a href="{{ $exercises->appends(request()->query())->nextPageUrl() }}"
                                    class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600 transition-all duration-300">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@push('scripts')
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const goalFilter = document.getElementById('goalFilter');
        const statusFilter = document.getElementById('statusFilter');
        const tableRows = document.querySelectorAll('.exercise-row');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedGoal = goalFilter.value;
            const selectedStatus = statusFilter.value;
            let visibleCount = 0; tableRows.forEach(row => {
                const nameElement = row.querySelector('.text-sm.font-bold');
                const categoryElement = row.querySelector('td:nth-child(2) .inline-flex');
                const goalElement = row.querySelector('td:nth-child(3) .inline-flex');
                const statusElement = row.querySelector('td:nth-child(6) .inline-flex');

                if (nameElement && categoryElement && goalElement && statusElement) {
                    const name = nameElement.textContent.toLowerCase();
                    const category = categoryElement.textContent.toLowerCase();
                    const goal = goalElement.textContent.toLowerCase();
                    const status = statusElement.textContent.toLowerCase();

                    const matchesSearch = name.includes(searchTerm);
                    const matchesCategory = !selectedCategory || category.includes(selectedCategory.toLowerCase());
                    const matchesGoal = !selectedGoal || goal.includes(selectedGoal.toLowerCase());
                    const matchesStatus = !selectedStatus || (selectedStatus === '1' && status.includes('aktif') && !status.includes('tidak')) || (selectedStatus === '0' && status.includes('tidak aktif'));

                    if (matchesSearch && matchesCategory && matchesGoal && matchesStatus) {
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

        if (searchInput) {
            searchInput.addEventListener('input', filterTable);
        }

        if (categoryFilter) {
            categoryFilter.addEventListener('change', filterTable);
        } if (goalFilter) {
            goalFilter.addEventListener('change', filterTable);
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', filterTable);
        }

        function refreshTable() {
            searchInput.value = '';
            categoryFilter.value = '';
            goalFilter.value = '';
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

        // Confirm delete with better styling
        document.querySelectorAll('form[action*="destroy"]').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const exerciseName = this.closest('tr').querySelector('.text-sm.font-bold').textContent.trim();

                if (confirm(`Apakah Anda yakin ingin menghapus olahraga "${exerciseName}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
                    // Show loading state
                    const deleteBtn = this.querySelector('button[type="submit"]');
                    deleteBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>';
                    deleteBtn.disabled = true;

                    this.submit();
                }
            });
        });

        // Add tooltips for action buttons
        document.querySelectorAll('[title]').forEach(element => {
            element.addEventListener('mouseenter', function () {
                this.classList.add('hover:scale-110');
            });

            element.addEventListener('mouseleave', function () {
                this.classList.remove('hover:scale-110');
            });
        });

        // Add smooth scroll to top when pagination is clicked
        document.addEventListener('DOMContentLoaded', function () {
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function () {
                    setTimeout(() => {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }, 100);
                });
            });
        });
    </script>
@endpush

@endsection