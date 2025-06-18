@extends('admin.layouts.app')

@section('title', 'Detail Pengguna')

  @section('content')
    <div class="p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex items-center justify-between">
      <div class="flex items-center">
      <div
      class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
      <i data-lucide="user" class="w-6 h-6 text-white"></i>
      </div>
      <div>
      <h1 class="text-2xl font-bold text-gray-900">Detail Pengguna</h1>
      <p class="text-gray-600">Informasi lengkap profil pengguna</p>
      </div>
      </div>
      <div class="flex items-center space-x-3">
      <a href="{{ route('admin.users.edit', $user->id) }}"
      class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
      <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
      Edit
      </a>
      <a href="{{ route('admin.users.index') }}"
      class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
      <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
      Kembali
      </a>
      </div>
    </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- User Profile Card -->
    <div class="lg:col-span-1">
      <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
      <!-- Profile Header -->
      <div class="bg-gradient-to-r from-orange-500 to-purple-600 p-6 text-center">
      <div class="relative inline-block">
      @if($user->photo)
      <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
      class="w-20 h-20 rounded-full border-4 border-white shadow-sm object-cover">
      @else
      <div
      class="w-20 h-20 rounded-full border-4 border-white shadow-sm bg-white/20 flex items-center justify-center">
      <i data-lucide="user" class="w-10 h-10 text-white"></i>
      </div>
      @endif
      <div
        class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
        <i data-lucide="check" class="w-3 h-3 text-white"></i>
      </div>
      </div>
      <h2 class="text-xl font-bold text-white mt-4">{{ $user->name }}</h2>
      <p class="text-white/80">{{ ucfirst($user->role) }}</p>
      </div>

      <!-- Contact Information -->
      <div class="p-6 space-y-4">
      <div class="flex items-center space-x-3">
      <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
        <i data-lucide="mail" class="w-5 h-5 text-orange-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-600">Email</p>
        <p class="font-medium text-gray-900">{{ $user->email }}</p>
      </div>
      </div>

      <div class="flex items-center space-x-3">
      <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
        <i data-lucide="calendar" class="w-5 h-5 text-blue-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-600">Bergabung</p>
        <p class="font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
      </div>
      </div>

      <div class="flex items-center space-x-3">
      <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
        <i data-lucide="clock" class="w-5 h-5 text-green-500"></i>
      </div>
      <div>
        <p class="text-sm text-gray-600">Terakhir Aktif</p>
        <p class="font-medium text-gray-900">{{ $user->updated_at->diffForHumans() }}</p>
      </div>
      </div>
      </div>

      <!-- Action Buttons -->
      <!-- <div class="p-6 bg-gray-50 border-t border-gray-200">
      <div class="grid grid-cols-2 gap-3">
      <button
        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
        <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
        Pesan
      </button>
      <button
        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center">
        <i data-lucide="user-x" class="w-4 h-4 mr-2"></i>
        Suspend
      </button>
      </div>
      </div> -->
      </div>
    </div>

    <!-- User Details -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Basic Information -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="border-b border-gray-200 p-4">
      <h3 class="text-lg font-semibold text-gray-900 flex items-center">
      <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
      Informasi Pengguna
      </h3>
      </div>
      <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
        <p class="text-gray-900 font-medium">{{ $user->name }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
        <p class="text-gray-900 font-medium">{{ $user->email }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Role Pengguna</label>
        <span
        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
            {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
        {{ ucfirst($user->role) }}
        </span>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Dibuat</label>
        <p class="text-gray-900 font-medium">{{ $user->created_at->format('d M Y, H:i') }}</p>
      </div>
      </div>
      </div>
      </div>

      <!-- Statistics -->
      <!-- <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="border-b border-gray-200 p-4">
      <h3 class="text-lg font-semibold text-gray-900 flex items-center">
      <i data-lucide="bar-chart-3" class="w-5 h-5 mr-2 text-purple-500"></i>
      Statistik Pengguna
      </h3>
      </div>
      <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
        <div class="w-12 h-12 bg-blue-500 rounded-lg mx-auto mb-3 flex items-center justify-center">
        <i data-lucide="target" class="w-6 h-6 text-white"></i>
        </div>
        <p class="text-2xl font-bold text-gray-900">15</p>
        <p class="text-sm text-gray-600">Program Diet</p>
      </div>

      <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
        <div class="w-12 h-12 bg-green-500 rounded-lg mx-auto mb-3 flex items-center justify-center">
        <i data-lucide="trending-down" class="w-6 h-6 text-white"></i>
        </div>
        <p class="text-2xl font-bold text-gray-900">8.5kg</p>
        <p class="text-sm text-gray-600">Berat Turun</p>
      </div>

      <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-200">
        <div class="w-12 h-12 bg-purple-500 rounded-lg mx-auto mb-3 flex items-center justify-center">
        <i data-lucide="award" class="w-6 h-6 text-white"></i>
        </div>
        <p class="text-2xl font-bold text-gray-900">92%</p>
        <p class="text-sm text-gray-600">Pencapaian</p>
      </div>
      </div>
      </div>
      </div> -->

      <!-- Recent Activity -->
      <!-- <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <div class="border-b border-gray-200 p-4">
      <h3 class="text-lg font-semibold text-gray-900 flex items-center">
      <i data-lucide="activity" class="w-5 h-5 mr-2 text-green-500"></i>
      Aktivitas Terbaru
      </h3>
      </div>
      <div class="p-6">
      <div class="space-y-4">
      <div class="flex items-start space-x-4 p-4 bg-green-50 rounded-lg border border-green-200">
        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
        <i data-lucide="check" class="w-4 h-4 text-white"></i>
        </div>
        <div class="flex-1">
        <p class="font-medium text-gray-900">Profil Diperbarui</p>
        <p class="text-sm text-gray-600">Pengguna memperbarui informasi profil</p>
        <p class="text-xs text-gray-500 mt-1">{{ $user->updated_at->diffForHumans() }}</p>
        </div>
      </div>

      <div class="flex items-start space-x-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
        <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
        </div>
        <div class="flex-1">
        <p class="font-medium text-gray-900">Login Akun</p>
        <p class="text-sm text-gray-600">Pengguna login ke aplikasi</p>
        <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
        </div>
      </div>

      <div class="flex items-start space-x-4 p-4 bg-purple-50 rounded-lg border border-purple-200">
        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
        <i data-lucide="user-plus" class="w-4 h-4 text-white"></i>
        </div>
        <div class="flex-1">
        <p class="font-medium text-gray-900">Akun Dibuat</p>
        <p class="text-sm text-gray-600">Akun pengguna berhasil dibuat</p>
        <p class="text-xs text-gray-500 mt-1">{{ $user->created_at->diffForHumans() }}</p>
        </div>
      </div>
      </div>
      </div>
      </div> -->
    </div>
    </div>
    </div>

  <style>
    @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
    }

    .animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
    }

    .hover-lift {
    transition: all 0.3s ease;
    }

    .hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Add hover effects to cards
    const cards = document.querySelectorAll('.bg-white\\/80');
    cards.forEach(card => {
      card.classList.add('hover-lift');
    });

    // Add fade-in animation to elements
    const elements = document.querySelectorAll('.bg-white\\/80, .bg-gradient-to-r');
    elements.forEach((element, index) => {
      setTimeout(() => {
      element.classList.add('animate-fade-in-up');
      }, index * 100);
    });

    // Action button click handlers
    const messageBtn = document.querySelector('button:has(svg)');
    const suspendBtn = document.querySelectorAll('button')[1];

    if (messageBtn) {
      messageBtn.addEventListener('click', function () {
      // Add message functionality here
      console.log('Message user clicked');
      });
    }

    if (suspendBtn) {
      suspendBtn.addEventListener('click', function () {
      if (confirm('Are you sure you want to suspend this user?')) {
        // Add suspend functionality here
        console.log('Suspend user clicked');
      }
      });
    }
    });
  </script>
@endsection