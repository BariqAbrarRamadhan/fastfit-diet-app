@extends('layouts.admin')

@section('title', 'Laporan')

@section('content')
  <div class="p-6">
    <!-- Header Section -->
    <div
    class="bg-gradient-to-r from-orange-400 via-pink-500 to-purple-600 rounded-3xl p-8 mb-8 relative overflow-hidden">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10">
      <div class="flex items-center justify-between">
      <div>
        <h1 class="text-4xl font-bold text-white mb-2">📊 Laporan</h1>
        <p class="text-white/90 text-lg">Lihat dan analisis data statistik aplikasi</p>
      </div>
      <div class="hidden md:block">
        <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
        <i data-lucide="chart-bar" class="w-12 h-12 text-white"></i>
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
      <i data-lucide="construction" class="w-16 h-16 text-orange-500"></i>
      </div>
      <h2 class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-4">
      Fitur Laporan Segera Hadir
      </h2>
      <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
      Kami sedang mengembangkan fitur laporan yang comprehensive untuk memberikan insight mendalam tentang data
      pengguna, aktivitas, dan performa aplikasi.
      </p>

      <!-- Feature Preview Cards -->
      <div class="grid md:grid-cols-3 gap-6 mt-8">
      <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200/50">
        <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="users" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-blue-900 mb-2">Laporan Pengguna</h3>
        <p class="text-blue-700 text-sm">Statistik pendaftaran, aktivitas, dan demografi pengguna</p>
      </div>

      <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200/50">
        <div class="w-16 h-16 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-green-900 mb-2">Laporan Performa</h3>
        <p class="text-green-700 text-sm">Analisis engagement dan pencapaian target diet</p>
      </div>

      <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200/50">
        <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4">
        <i data-lucide="calendar" class="w-8 h-8 text-white"></i>
        </div>
        <h3 class="font-bold text-purple-900 mb-2">Laporan Berkala</h3>
        <p class="text-purple-700 text-sm">Export data harian, mingguan, dan bulanan</p>
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