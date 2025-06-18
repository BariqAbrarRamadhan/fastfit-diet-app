@extends('layouts.admin')

@section('title', 'Pengaturan')

@section('content')
  <div class="p-6">
    <!-- Header Section -->
    <div
    class="bg-gradient-to-r from-orange-400 via-pink-500 to-purple-600 rounded-3xl p-8 mb-8 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10">
      <div class="flex items-center justify-between">
      <div>
        <h1 class="text-4xl font-bold text-white mb-2">⚙️ Pengaturan</h1>
        <p class="text-white/90 text-lg">Konfigurasi dan pengaturan sistem aplikasi</p>
      </div>
      <div class="hidden md:block">
        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
        <i data-lucide="settings" class="w-12 h-12 text-white"></i>
        </div>
      </div>
      </div>
    </div>
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
    <div class="absolute -bottom-5 -left-5 w-20 h-20 bg-white/10 rounded-full"></div>
    </div>

    <!-- Coming Soon Section -->
    <div class="bg-white/90 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-xl">
    <div class="text-center">
      <div
      class="w-32 h-32 bg-gradient-to-r from-orange-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
      <i data-lucide="wrench" class="w-16 h-16 text-orange-500"></i>
      </div>
      <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-4">
      Fitur Pengaturan Segera Hadir
      </h2>
      <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
      Panel pengaturan comprehensive untuk mengelola konfigurasi aplikasi, preferensi sistem, dan pengaturan keamanan
      akan segera tersedia.
      </p>

      <!-- Feature Preview Cards -->
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
      <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200/50">
        <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="shield" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-blue-900 mb-2">Keamanan</h3>
        <p class="text-blue-700 text-sm">Pengaturan password, 2FA, dan keamanan sistem</p>
      </div>

      <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200/50">
        <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="mail" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-green-900 mb-2">Email</h3>
        <p class="text-green-700 text-sm">Konfigurasi SMTP dan template email</p>
      </div>

      <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200/50">
        <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="palette" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-purple-900 mb-2">Tampilan</h3>
        <p class="text-purple-700 text-sm">Tema, warna, dan kustomisasi interface</p>
      </div>

      <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200/50">
        <div class="w-16 h-16 bg-orange-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="database" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-orange-900 mb-2">Database</h3>
        <p class="text-orange-700 text-sm">Backup, maintenance, dan optimasi</p>
      </div>
      </div>

      <!-- Additional Settings Preview -->
      <div class="grid md:grid-cols-2 gap-6 mt-6">
      <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 border border-indigo-200/50">
        <div class="w-16 h-16 bg-indigo-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="bell" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-indigo-900 mb-2">Notifikasi</h3>
        <p class="text-indigo-700 text-sm">Pengaturan push notification dan reminder</p>
      </div>

      <div class="bg-gradient-to-br from-pink-50 to-pink-100 rounded-2xl p-6 border border-pink-200/50">
        <div class="w-16 h-16 bg-pink-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="globe" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-pink-900 mb-2">Integrasi</h3>
        <p class="text-pink-700 text-sm">API third-party dan webhook configuration</p>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>
@endsection