@extends('layouts.app')

@section('content')
  <div
    class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 flex flex-col justify-center items-center p-4">
    <div class="w-full max-w-md">
    <!-- Enhanced Card with Modern Design -->
    <div
      class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-8 relative overflow-hidden">
      <!-- Decorative Background Elements -->
      <div
      class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-200/30 to-purple-200/30 rounded-full -translate-y-16 translate-x-16">
      </div>
      <div
      class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-purple-200/30 to-orange-200/30 rounded-full translate-y-12 -translate-x-12">
      </div>

      <!-- Header Section -->
      <div class="text-center mb-8 relative z-10">
      <div class="w-20 h-20 rounded-2xl mx-auto flex items-center justify-center mb-6 shadow-lg">
        <img src="{{ asset('icons/favicon.ico') }}" alt="Diet App Logo" class="rounded-xl w-[60px] h-[60px]" />
      </div>
      <h1 class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2 py-2">
        Selamat Datang Kembali
      </h1>
      <p class="text-gray-600">Lanjutkan perjalanan kesehatan Anda</p>
      </div> <!-- Alert Messages with Enhanced Design -->
      @if (session('success'))
      <div
      class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl flex items-center shadow-sm relative z-10">
      <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
      <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
      </svg>
      </div>
      <span class="font-medium">{{ session('success') }}</span>
      </div>
    @endif

      @if (session('info'))
      <div
      class="mb-6 p-4 bg-blue-50 border border-blue-200 text-blue-800 rounded-xl flex items-center shadow-sm relative z-10">
      <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
      <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      </div>
      <span class="font-medium">{{ session('info') }}</span>
      </div>
    @endif

      @if (session('error'))
      <div
      class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-center shadow-sm relative z-10">
      <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
      <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
      </div>
      <span class="font-medium">{{ session('error') }}</span>
      </div>
    @endif <!-- Enhanced Form -->
      <form method="POST" action="{{ route('login.post') }}" class="space-y-6 relative z-10">
      @csrf
      <div class="space-y-2">
        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
          </path>
          </svg>
        </div>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required
          class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
          placeholder="nama@email.com" />
        </div>
        @error('email')
      <span class="text-sm text-red-500 flex items-center mt-1">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      {{ $message }}
      </span>
      @enderror
      </div>

      <div class="space-y-2">
        <div class="flex items-center justify-between">
        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
        <!-- <a href="" class="text-sm text-orange-500 hover:text-orange-600 hover:underline transition-colors duration-200">
          Lupa password?
        </a> -->
        </div>
        <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
          </path>
          </svg>
        </div>
        <input id="password" name="password" type="password" required
          class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 bg-gray-50 hover:bg-white"
          placeholder="Masukkan password" />
        </div>
        @error('password')
      <span class="text-sm text-red-500 flex items-center mt-1">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      {{ $message }}
      </span>
      @enderror
      </div> <!-- Enhanced Submit Button -->
      <button type="submit" id="login-btn"
        class="w-full bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white font-bold py-3.5 rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none relative overflow-hidden">
        <div
        class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
        </div>
        <span id="login-btn-text" class="relative z-10 flex items-center justify-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
        </svg>
        Masuk
        </span>
        <span id="login-btn-loading" class="hidden relative z-10">
        <svg class="animate-spin h-5 w-5 inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor"
          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
          </path>
        </svg>
        Masuk...
        </span>
      </button>
      </form>

      <!-- Enhanced Footer -->
      <div class="mt-8 text-center relative z-10">
      <div class="relative">
        <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
        <span class="px-4 bg-white text-gray-500">atau</span>
        </div>
      </div>
      <p class="text-gray-600 mt-4">
        Belum memiliki akun?
        <a href="{{ route('register') }}"
        class="text-purple-600 hover:text-purple-700 font-semibold hover:underline transition-colors duration-200 ml-1">
        Daftar sekarang
        </a>
      </p>
      </div>
    </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const btnText = document.getElementById('login-btn-text');
    const btnLoading = document.getElementById('login-btn-loading');
    const loginBtn = document.getElementById('login-btn');

    // Function to reset button state
    function resetButtonState() {
      btnText.classList.remove('hidden');
      btnLoading.classList.add('hidden');
      loginBtn.disabled = false;
    }      // Handle form submission
    form.addEventListener('submit', function (e) {
      // Check if form is valid
      if (form.checkValidity()) {
      btnText.classList.add('hidden');
      btnLoading.classList.remove('hidden');
      loginBtn.disabled = true;

      // Set timeout to reset button state if something goes wrong
      setTimeout(function () {
        resetButtonState();
      }, 10000); // Reset after 10 seconds
      }
    });

    // Reset button state when page loads (in case of redirect back)
    resetButtonState();

    // Reset button state if there are validation errors on page load
    if (document.querySelector('.text-red-500')) {
      resetButtonState();
    }

    // Reset button state on window focus (when user comes back to tab)
    window.addEventListener('focus', function () {
      resetButtonState();
    });
    });
  </script>
@endsection