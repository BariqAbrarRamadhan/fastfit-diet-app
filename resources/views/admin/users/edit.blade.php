@extends('admin.layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 relative overflow-hidden">
        <!-- Enhanced Decorative Background Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-orange-200/10 to-purple-200/10 rounded-full -translate-x-48 -translate-y-48">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-tl from-purple-200/10 to-orange-200/10 rounded-full translate-x-48 translate-y-48">
        </div>

        <div class="relative z-10 p-6 pt-16 lg:pt-6">
            <!-- Enhanced Header -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('admin.users.index') }}"
                            class="mr-6 p-3 rounded-xl bg-white/70 border border-gray-200 text-gray-600 hover:bg-gradient-to-r hover:from-orange-50 hover:to-purple-50 hover:text-orange-600 transition-all duration-300 group">
                            <i data-lucide="arrow-left" class="w-5 h-5 group-hover:animate-pulse"></i>
                        </a>
                        <div>
                            <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                Edit Pengguna
                            </h1>
                            <p class="text-gray-600 text-lg">Perbarui informasi untuk {{ $user->name }}</p>
                            <div class="flex items-center mt-2 text-sm text-gray-500">
                                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                ID: #{{ $user->id }} • Bergabung {{ $user->created_at->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 md:mt-0">
                        <div
                            class="px-4 py-2 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-600 rounded-xl border border-blue-200/50 text-sm font-medium">
                            <i data-lucide="edit-3" class="w-4 h-4 mr-2 inline"></i>
                            Mode Edit
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200/50 text-green-600 rounded-2xl p-6 mb-8 shadow-lg">
                    <div class="flex items-center">
                        <i data-lucide="check-circle" class="w-6 h-6 mr-3 text-green-500"></i>
                        <div>
                            <h4 class="font-bold">Berhasil!</h4>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Enhanced Main Form -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Enhanced Basic Information Section -->
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Informasi Dasar
                                </h3>
                                <p class="text-gray-600 text-sm">Perbarui data utama pengguna</p>
                            </div>
                            <div class="p-8 space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-700 mb-3">
                                        <i data-lucide="user" class="w-4 h-4 mr-2 inline text-orange-500"></i>
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                        placeholder="Masukkan nama lengkap pengguna"
                                        class="w-full px-4 py-3 text-sm bg-white/70 border {{ $errors->has('name') ? 'border-red-300 bg-red-50/30' : 'border-gray-200' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:bg-white" />
                                    @if($errors->has('name'))
                                        <p class="mt-2 text-sm text-red-500 flex items-center bg-red-50 p-2 rounded-lg">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-700 mb-3">
                                        <i data-lucide="mail" class="w-4 h-4 mr-2 inline text-purple-500"></i>
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                        placeholder="user@example.com"
                                        class="w-full px-4 py-3 text-sm bg-white/70 border {{ $errors->has('email') ? 'border-red-300 bg-red-50/30' : 'border-gray-200' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 hover:bg-white" />
                                    @if($errors->has('email'))
                                        <p class="mt-2 text-sm text-red-500 flex items-center bg-red-50 p-2 rounded-lg">
                                            <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="role" class="block text-sm font-bold text-gray-700 mb-3">
                                            <i data-lucide="shield" class="w-4 h-4 mr-2 inline text-orange-500"></i>
                                            Peran
                                        </label>
                                        <select id="role" name="role"
                                            class="w-full px-4 py-3 text-sm bg-white/70 border {{ $errors->has('role') ? 'border-red-300 bg-red-50/30' : 'border-gray-200' }} rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300 hover:bg-white">
                                            <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                                👤 Pengguna</option>
                                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                        </select>
                                        @if($errors->has('role'))
                                            <p class="mt-2 text-sm text-red-500 flex items-center bg-red-50 p-2 rounded-lg">
                                                <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                                {{ $errors->first('role') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Enhanced Sidebar -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Enhanced Photo Upload Section -->
                        <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Foto Profil
                                </h3>
                                <p class="text-gray-600 text-sm">Upload foto profil baru (opsional)</p>
                            </div>
                            <div class="p-6">
                                <div id="image-preview"
                                    class="border-2 border-dashed rounded-2xl p-6 text-center border-gray-300 hover:border-orange-500 bg-gradient-to-br from-orange-50/30 to-purple-50/30 hover:from-orange-100/50 hover:to-purple-100/50 transition-all duration-300 group">
                                    @if($user->image)
                                        <div class="relative">
                                            <div
                                                class="w-32 h-32 mx-auto bg-gradient-to-r from-orange-400 to-purple-500 rounded-2xl p-1">
                                                <img id="preview-img" src="{{ $user->image }}" alt="Preview"
                                                    class="w-full h-full object-cover rounded-2xl" />
                                            </div>
                                            <button type="button" onclick="clearImage()"
                                                class="absolute -top-2 -right-2 p-2 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-xl shadow-lg hover:from-red-500 hover:to-red-600 transition-all duration-300"
                                                title="Hapus gambar">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                            <div class="mt-4 text-sm text-green-600 font-medium">
                                                ✅ Foto saat ini
                                            </div>
                                        </div>
                                    @else
                                        <div class="py-8" id="upload-content">
                                            <div
                                                class="w-16 h-16 mx-auto bg-gradient-to-r from-orange-400 to-purple-500 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                                <i data-lucide="upload" class="w-8 h-8 text-white"></i>
                                            </div>
                                            <div class="mt-2">
                                                <label for="image"
                                                    class="cursor-pointer text-lg font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent hover:from-orange-600 hover:to-purple-700 transition-all duration-300">
                                                    Pilih Foto Baru
                                                </label>
                                                <input id="image" name="image" type="file" accept="image/*" class="sr-only"
                                                    onchange="previewImage(event)" />
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">PNG, JPG, JPEG, GIF hingga 5MB</p>
                                        </div>
                                    @endif
                                </div>
                                @if($errors->has('image'))
                                    <p class="mt-3 text-sm text-red-500 flex items-center bg-red-50 p-3 rounded-xl">
                                        <i data-lucide="alert-circle" class="w-4 h-4 mr-2"></i>
                                        {{ $errors->first('image') }}
                                    </p>
                                @endif
                            </div>
                        </div> -->

                        <!-- Enhanced Account Information -->
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Informasi Akun
                                </h3>
                                <p class="text-gray-600 text-sm">Detail akun dan aktivitas pengguna</p>
                            </div>
                            <div class="p-6 space-y-4">
                                <div
                                    class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-50/50 to-indigo-50/50 rounded-xl border border-blue-200/30">
                                    <div class="flex items-center">
                                        <i data-lucide="hash" class="w-4 h-4 text-blue-500 mr-3"></i>
                                        <span class="text-sm text-gray-600">ID Pengguna</span>
                                    </div>
                                    <span class="font-bold text-blue-600">#{{ $user->id }}</span>
                                </div>
                                <div
                                    class="flex items-center justify-between p-3 bg-gradient-to-r from-green-50/50 to-emerald-50/50 rounded-xl border border-green-200/30">
                                    <div class="flex items-center">
                                        <i data-lucide="calendar-plus" class="w-4 h-4 text-green-500 mr-3"></i>
                                        <span class="text-sm text-gray-600">Bergabung</span>
                                    </div>
                                    <span class="font-bold text-green-600">{{ $user->created_at->format('d M Y') }}</span>
                                </div>
                                <div
                                    class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50/50 to-pink-50/50 rounded-xl border border-purple-200/30">
                                    <div class="flex items-center">
                                        <i data-lucide="clock" class="w-4 h-4 text-purple-500 mr-3"></i>
                                        <span class="text-sm text-gray-600">Login Terakhir</span>
                                    </div>
                                    <span
                                        class="font-bold text-purple-600">{{ $user->last_login ? $user->last_login->format('d M Y, H:i') : 'Belum pernah' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Action Buttons -->
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                            <div class="bg-gradient-to-r from-orange-50/80 to-purple-50/80 p-6 border-b border-gray-200/50">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                                    Tindakan
                                </h3>
                                <p class="text-gray-600 text-sm">Simpan perubahan atau batalkan edit</p>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    <button type="submit"
                                        class="w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl font-bold text-lg group">
                                        <i data-lucide="save" class="w-5 h-5 mr-3 group-hover:animate-pulse"></i>
                                        Simpan Perubahan
                                    </button>
                                    <a href="{{ route('admin.users.index') }}"
                                        class="w-full flex items-center justify-center px-6 py-4 text-gray-600 bg-white/70 border border-gray-200 rounded-xl hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 hover:text-gray-700 transition-all duration-300 font-semibold group">
                                        <i data-lucide="arrow-left"
                                            class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                        Kembali ke Daftar
                                    </a>
                                </div>

                                <!-- Enhanced Warning Section -->
                                <div
                                    class="mt-6 p-4 bg-gradient-to-r from-yellow-50/80 to-orange-50/80 rounded-xl border border-yellow-200/50">
                                    <div class="flex items-start">
                                        <i data-lucide="alert-triangle" class="w-5 h-5 text-yellow-500 mr-3 mt-0.5"></i>
                                        <div>
                                            <h4 class="text-sm font-bold text-yellow-700 mb-1">Perhatian:</h4>
                                            <ul class="text-xs text-yellow-600 space-y-1">
                                                <li>• Perubahan akan mempengaruhi akses pengguna</li>
                                                <li>• Email harus tetap unik dalam sistem</li>
                                                <li>• Admin tidak dapat mengubah role sendiri</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> <!-- Enhanced JavaScript -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Harap pilih file gambar yang valid (JPEG, JPG, PNG, GIF)');
                    return;
                }

                // Validate file size (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 5MB');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    const container = document.getElementById('image-preview');
                    container.innerHTML = `
                                <div class="relative">
                                    <div class="w-32 h-32 mx-auto bg-gradient-to-r from-orange-400 to-purple-500 rounded-2xl p-1">
                                        <img id="preview-img" src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-2xl">
                                    </div>
                                    <button type="button" onclick="clearImage()" class="absolute -top-2 -right-2 p-2 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-xl shadow-lg hover:from-red-500 hover:to-red-600 transition-all duration-300" title="Hapus gambar">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                    <div class="mt-4 text-sm text-green-600 font-medium">
                                        ✅ Foto baru dipilih
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</p>
                                </div>
                            `;
                    lucide.createIcons();
                };
                reader.readAsDataURL(file);
            }
        }

        function clearImage() {
            const container = document.getElementById('image-preview');
            const fileInput = document.getElementById('image');

            fileInput.value = '';
            container.innerHTML = `
                        <div class="py-8" id="upload-content">
                            <div class="w-16 h-16 mx-auto bg-gradient-to-r from-orange-400 to-purple-500 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="upload" class="w-8 h-8 text-white"></i>
                            </div>
                            <div class="mt-2">
                                <label for="image" class="cursor-pointer text-lg font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent hover:from-orange-600 hover:to-purple-700 transition-all duration-300">
                                    Pilih Foto Baru
                                </label>
                                <input id="image" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(event)">
                            </div>
                            <p class="mt-2 text-sm text-gray-500">PNG, JPG, JPEG, GIF hingga 5MB</p>
                        </div>
                    `;
            lucide.createIcons();
        }

        // Initialize Lucide icons
        lucide.createIcons();

        // Form validation enhancement
        document.querySelector('form').addEventListener('submit', function (e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!name) {
                e.preventDefault();
                alert('Nama lengkap tidak boleh kosong!');
                return false;
            }

            if (!email) {
                e.preventDefault();
                alert('Email tidak boleh kosong!');
                return false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                e.preventDefault();
                alert('Format email tidak valid!');
                return false;
            }
        });
    </script>
@endsection