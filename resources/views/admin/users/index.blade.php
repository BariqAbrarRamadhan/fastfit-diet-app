@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
                    <p class="text-gray-600">Kelola dan pantau semua pengguna aplikasi</p>
                    <div class="flex items-center mt-1 text-sm text-gray-500">
                        <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                        Total: {{ $users->total() }} pengguna terdaftar
                    </div>
                </div>
            </div>            <div class="flex items-center mt-6 md:mt-0 space-x-4">
                <a href="{{ route('admin.users.create') }}"
                   class="bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                    <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                    Tambah Pengguna
                </a>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header with integrated filters -->
        <div class="bg-gray-50 p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-1">Daftar Pengguna</h2>
                    <p class="text-gray-600 text-sm">Kelola dan pantau semua pengguna aplikasi</p>
                </div>
                <div class="flex items-center space-x-3 mt-4 md:mt-0">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"></i>
                        <input type="text" id="searchUsers" placeholder="Cari pengguna..."
                               class="pl-10 pr-4 py-2 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors w-64" />
                    </div>
                    <select id="roleFilter"
                            class="px-4 py-2 text-sm bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        <option value="">Semua Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <button onclick="refreshTable()"
                            class="p-2 text-gray-600 bg-white rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors"
                            title="Refresh">
                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                Pengguna
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                Email                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                Tanggal Bergabung
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center">
                                <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                                Role
                            </div>
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <div class="flex items-center justify-end">
                                <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                                Aksi
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="user-row hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 relative">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-400 to-purple-500 p-0.5">
                                            <img src="{{ $user->image ?? asset('images/placeholder.svg') }}"
                                                 alt="{{ $user->name }}" class="rounded-lg w-full h-full object-cover" />
                                        </div>
                                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white shadow-sm"></div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500">ID: #{{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm text-gray-700 font-medium">{{ $user->email }}</div>
                                    <div class="ml-2 px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded-full border border-blue-200">
                                        Verified
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600 font-medium">{{ $user->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="inline-flex items-center px-3 py-2 rounded-lg text-xs font-semibold 
                                    {{ $user->role === 'admin' ? 'bg-purple-50 text-purple-600 border border-purple-200' : 'bg-indigo-50 text-indigo-600 border border-indigo-200' }}">
                                    <i data-lucide="{{ $user->role === 'admin' ? 'crown' : 'user' }}" class="w-3 h-3 mr-1"></i>
                                    {{ ucfirst($user->role) }}
                                </div>
                            </td>                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    @if ($user->role === 'admin')
                                        <div class="flex items-center px-3 py-2 bg-gray-100 text-gray-400 rounded-lg">
                                            <i data-lucide="lock" class="w-4 h-4 mr-1"></i>
                                            <span class="text-xs font-medium">Protected</span>
                                        </div>
                                    @else
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                           class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-lg transition-colors"
                                           title="Lihat Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="p-2 text-gray-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors"
                                           title="Edit">
                                            <i data-lucide="edit" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-purple-500 rounded-lg flex items-center justify-center mb-4">
                                        <i data-lucide="users" class="w-8 h-8 text-white"></i>
                                    </div>
                                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Pengguna</h3>
                                            <p class="text-gray-500 text-sm mb-4">Mulai dengan menambahkan pengguna pertama</p>
                                            <a href="{{ route('admin.users.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 text-sm font-semibold">
                                                <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                                                Tambah Pengguna Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <div class="bg-gray-50 p-6 border-t border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center text-sm text-gray-600 mb-4 md:mb-0">
                        <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                        Menampilkan {{ $users->firstItem() ?? 0 }} hingga {{ $users->lastItem() ?? 0 }} dari {{ $users->total() ?? 0 }} pengguna
                    </div>
                    <div class="flex items-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($users->onFirstPage())
                            <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" 
                               class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="px-4 py-2 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-lg font-semibold">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="px-4 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors font-medium">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                        {{-- Next Page Link --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" 
                               class="px-3 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition-colors">
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
    <script>
        lucide.createIcons();
        
        // Search functionality
        const searchInput = document.getElementById('searchUsers');
        const roleFilter = document.getElementById('roleFilter');
        const tableRows = document.querySelectorAll('.user-row');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedRole = roleFilter.value.toLowerCase();
            let visibleCount = 0;

            tableRows.forEach(row => {
                const nameElement = row.querySelector('.text-sm.font-bold');
                const emailElement = row.querySelector('td:nth-child(2) .text-sm');
                const roleElement = row.querySelector('td:nth-child(4) .inline-flex');

                if (nameElement && emailElement && roleElement) {
                    const name = nameElement.textContent.toLowerCase();
                    const email = emailElement.textContent.toLowerCase();
                    const role = roleElement.textContent.toLowerCase();

                    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
                    const matchesRole = !selectedRole || role.includes(selectedRole);

                    if (matchesSearch && matchesRole) {
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

        if (roleFilter) {
            roleFilter.addEventListener('change', filterTable);
        }

        function refreshTable() {
            searchInput.value = '';
            roleFilter.value = '';
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
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const userName = this.closest('tr').querySelector('.text-sm.font-bold').textContent.trim();

                if (confirm(`Apakah Anda yakin ingin menghapus pengguna "${userName}"?\n\nTindakan ini tidak dapat dibatalkan.`)) {
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
            element.addEventListener('mouseenter', function() {
                this.classList.add('hover:scale-110');
            });

            element.addEventListener('mouseleave', function() {
                this.classList.remove('hover:scale-110');
            });
        });
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