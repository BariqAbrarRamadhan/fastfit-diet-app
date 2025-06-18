@extends('layouts.app')

@section('content')
  <!-- Enhanced CSS Styles -->
  <style>
    html {
    scroll-behavior: smooth;
    }

    .hero-animation {
    animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

    0%,
    100% {
      transform: translateY(0px) rotate(3deg);
    }

    50% {
      transform: translateY(-10px) rotate(3deg);
    }
    }

    .feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(10deg);
    }

    .gradient-text {
    background: linear-gradient(135deg, #f97316, #a855f7);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    }

    /* Mobile Menu Transition */
    .mobile-menu-transition {
    transition: all 0.3s ease-in-out;
    max-height: 0;
    overflow: hidden;
    }

    .mobile-menu-transition.open {
    max-height: 300px;
    }

    /* Navbar Scroll Effect */
    .navbar-scrolled {
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Section Padding Fix */
    .section-padding {
    scroll-margin-top: 100px;
    }
  </style>

  <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 relative overflow-hidden">
    <!-- Enhanced Decorative Background Elements -->
    <div
    class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-orange-200/20 to-purple-200/20 rounded-full -translate-x-48 -translate-y-48">
    </div>
    <div
    class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-tl from-purple-200/20 to-orange-200/20 rounded-full translate-x-48 translate-y-48">
    </div>
    <div
    class="absolute top-1/3 left-1/4 w-32 h-32 bg-gradient-to-r from-orange-100/40 to-purple-100/40 rounded-full">
    </div>
    <div
    class="absolute bottom-1/3 right-1/4 w-24 h-24 bg-gradient-to-r from-purple-100/40 to-orange-100/40 rounded-full"
    style="animation-delay: 2s;"></div>
    <!-- Enhanced Navigation -->
    <nav id="navbar"
    class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-white/20 shadow-lg transition-all duration-300">
    <div class="container mx-auto px-4 lg:px-6 py-4">
      <div class="flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg">
          <img src="{{ asset('icons/favicon.ico') }}" alt="Fast Fit Logo" class="w-8 h-8 rounded-lg" />
        <!-- <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
          </path>
        </svg> -->
        </div>
        <span class="text-xl font-bold gradient-text">
        Fast Fit
        </span>
      </div>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="#hero" class="nav-link text-gray-600 hover:text-orange-500 transition-colors font-medium">Beranda</a>
        <a href="#features"
        class="nav-link text-gray-600 hover:text-orange-500 transition-colors font-medium">Fitur</a>
        <a href="{{ route('login') }}"
        class="px-5 py-2.5 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
        Masuk
        </a>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden">
        <button id="mobile-menu-btn"
        class="text-gray-600 hover:text-orange-500 transition-colors p-2 rounded-lg hover:bg-gray-100">
        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        </button>
      </div>
      </div>

      <!-- Mobile Navigation -->
      <div id="mobile-menu" class="mobile-menu-transition md:hidden border-t border-gray-200 mt-4">
      <div class="flex flex-col space-y-3 py-4">
        <a href="#hero"
        class="nav-link text-gray-600 hover:text-orange-500 transition-colors font-medium py-2 px-2 rounded-lg hover:bg-orange-50">Beranda</a>
        <a href="#features"
        class="nav-link text-gray-600 hover:text-orange-500 transition-colors font-medium py-2 px-2 rounded-lg hover:bg-orange-50">Fitur</a>
        <a href="{{ route('login') }}"
        class="px-5 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white rounded-xl hover:from-orange-600 hover:to-purple-700 transition-all duration-300 font-semibold shadow-lg text-center mt-2">
        Masuk
        </a>
      </div>
      </div>
    </div>
    </nav>
    <!-- Main Content -->
    <div class="container mx-auto px-4 lg:px-6 py-20 text-center max-w-6xl relative z-10">
    <!-- Hero Section -->
    <div id="hero" class="section-padding mb-20 pt-8">
      <div class="hero-animation w-32 h-32 rounded-3xl mx-auto flex items-center justify-center mb-8 shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
        <img src="{{ asset('icons/favicon.ico') }}" alt="Fast Fit Logo" class="w-20 h-20 rounded-2xl" />
      </div>

      <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight mb-8">
      <span class="bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
        Program Diet & Olahraga
      </span>
      <br>
      <span class="bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
        Khusus Untuk Anda
      </span>
      </h1>

      <p class="text-lg md:text-xl lg:text-2xl text-gray-600 mb-12 max-w-4xl mx-auto leading-relaxed">
      Kesehatan yang optimal adalah investasi terbaik untuk masa depan Anda.
      Mulai perjalanan transformasi hidup sehat dengan panduan yang tepat.
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
      <a href="{{ route('login') }}"
        class="bg-gradient-to-r from-orange-500 to-purple-600 hover:from-orange-600 hover:to-purple-700 text-white font-bold px-8 lg:px-10 py-3 lg:py-4 text-lg lg:text-xl rounded-2xl inline-flex items-center transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
        <svg class="w-5 h-5 lg:w-6 lg:h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
        </svg>
        Mulai Program Anda
      </a>
      <a href="{{ route('register') }}"
        class="bg-white/80 backdrop-blur-sm hover:bg-white text-gray-700 hover:text-gray-900 font-semibold px-6 lg:px-8 py-3 lg:py-4 text-base lg:text-lg rounded-2xl inline-flex items-center transition-all duration-300 border border-gray-200 hover:border-gray-300 shadow-lg hover:shadow-xl">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
        </svg>
        Daftar Gratis
      </a>
      </div>
    </div> <!-- Enhanced Features Section -->
    <div id="features" class="">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8 bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent py-4">
        Mengapa Memilih Fast Fit?
      </h2>
      <div class="section-padding grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 mt-16">
        <!-- Feature 1 -->
        <div
        class="feature-card bg-white/60 backdrop-blur-sm rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-white/20 relative overflow-hidden group">
        <div
          class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-200/30 to-transparent rounded-full -translate-y-10 translate-x-10">
        </div>
        <div class="relative z-10">
          <div class="feature-icon w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-500 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Program Personalisasi</h3>
          <p class="text-gray-600 leading-relaxed">Program diet dan olahraga yang disesuaikan dengan kebutuhan spesifik
          Anda berdasarkan profil kesehatan.</p>
        </div>
        </div>
  
        <!-- Feature 2 -->
        <div
        class="feature-card bg-white/60 backdrop-blur-sm rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-white/20 relative overflow-hidden group">
        <div
          class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-200/30 to-transparent rounded-full -translate-y-10 translate-x-10">
        </div>
        <div class="relative z-10">
          <div
          class="feature-icon w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Berbasis Metode Ilmiah</h3>
          <p class="text-gray-600 leading-relaxed">Menggunakan metode Forward Chaining dan algoritma pintar untuk
          rekomendasi yang akurat dan terpercaya.</p>
        </div>
        </div>
  
        <!-- Feature 3 -->
        <div
        class="feature-card bg-white/60 backdrop-blur-sm rounded-2xl p-6 lg:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-white/20 relative overflow-hidden group">
        <div
          class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-200/30 to-transparent rounded-full -translate-y-10 translate-x-10">
        </div>
        <div class="relative z-10">
          <div
          class="feature-icon w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Hasil Terukur</h3>
          <p class="text-gray-600 leading-relaxed">Pantau kemajuan Anda dengan metrik yang jelas, terukur, dan laporan
          progress yang komprehensif.</p>
        </div>
        </div>
        </div>
        
    </div>

    <!-- Additional Benefits Section -->
    <!-- <div id="benefits"
      class="section-padding mt-20 bg-white/40 backdrop-blur-sm rounded-3xl p-8 lg:p-12 shadow-xl border border-white/20 relative overflow-hidden">
      <div
      class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-orange-200/20 to-purple-200/20 rounded-full -translate-x-20 -translate-y-20">
      </div>
      <div
      class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-purple-200/20 to-orange-200/20 rounded-full translate-x-16 translate-y-16">
      </div>

      <div class="relative z-10">
      <h2
        class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8 bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
        Mengapa Memilih Fast Fit?
      </h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mt-8">
        <div class="flex items-start space-x-4">
        <div
          class="w-12 h-12 bg-gradient-to-r from-orange-400 to-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
          </path>
          </svg>
        </div>
        <div>
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Mudah Digunakan</h4>
          <p class="text-gray-600">Interface yang intuitif dan user-friendly untuk pengalaman yang menyenangkan.</p>
        </div>
        </div>

        <div class="flex items-start space-x-4">
        <div
          class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
          </path>
          </svg>
        </div>
        <div>
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Data Aman</h4>
          <p class="text-gray-600">Privasi dan keamanan data Anda adalah prioritas utama kami.</p>
        </div>
        </div>

        <div class="flex items-start space-x-4">
        <div
          class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
          </path>
          </svg>
        </div>
        <div>
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Tracking Lengkap</h4>
          <p class="text-gray-600">Monitor progress berat badan, konsumsi air, dan pencapaian target harian.</p>
        </div>
        </div>

        <div class="flex items-start space-x-4">
        <div
          class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
          </path>
          </svg>
        </div>
        <div>
          <h4 class="text-lg font-semibold text-gray-800 mb-2">Dukungan 24/7</h4>
          <p class="text-gray-600">Tim support siap membantu perjalanan kesehatan Anda kapan saja.</p>
        </div>
        </div>
      </div>
      </div>
    </div> -->
    </div>
    <!-- Enhanced Footer -->
    <footer class="bg-white/60 backdrop-blur-sm py-8 w-full mt-auto border-t border-white/20 relative z-10">
    <div class="container mx-auto px-4 text-center">
      <div class="flex items-center justify-center space-x-3 mb-4">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center">
        <img src="{{ asset('icons/favicon.ico') }}" alt="Fast Fit Logo" class="w-6 h-6 rounded-lg" />
      </div>
      <span class="text-lg font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
        Fast Fit
      </span>
      </div>
      <p class="text-gray-600 mb-2">Platform Diet & Olahraga</p>
      <p class="text-gray-500 text-sm">© 2025 Fast Fit. Tugas Akhir - Sistem Rekomendasi Diet.</p>
    </div>
    </footer>
  </div>

  <!-- JavaScript for Enhanced Functionality -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    let isMenuOpen = false;

    mobileMenuBtn.addEventListener('click', function () {
      isMenuOpen = !isMenuOpen;

      if (isMenuOpen) {
      mobileMenu.classList.add('open');
      menuIcon.classList.add('hidden');
      closeIcon.classList.remove('hidden');
      } else {
      mobileMenu.classList.remove('open');
      menuIcon.classList.remove('hidden');
      closeIcon.classList.add('hidden');
      }
    });

    // Close mobile menu when clicking nav links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', function () {
      if (isMenuOpen) {
        isMenuOpen = false;
        mobileMenu.classList.remove('open');
        menuIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
      }
      });
    });

    // Enhanced Smooth Scroll for Navigation Links
    navLinks.forEach(link => {
      link.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');

      if (targetId.startsWith('#')) {
        const targetSection = document.querySelector(targetId);
        if (targetSection) {
        const navbar = document.getElementById('navbar');
        const navbarHeight = navbar.offsetHeight;
        const targetPosition = targetSection.offsetTop - navbarHeight - 20;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        }
      }
      });
    });

    // Navbar Scroll Effect
    const navbar = document.getElementById('navbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function () {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // Add scrolled class for enhanced styling
      if (scrollTop > 50) {
      navbar.classList.add('navbar-scrolled');
      } else {
      navbar.classList.remove('navbar-scrolled');
      }

      // Hide/show navbar on scroll (optional)
      if (scrollTop > lastScrollTop && scrollTop > 100) {
      // Scrolling down
      navbar.style.transform = 'translateY(-100%)';
      } else {
      // Scrolling up
      navbar.style.transform = 'translateY(0)';
      }

      lastScrollTop = scrollTop;
    });

    // Intersection Observer for Animation
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
      });
    }, observerOptions);

    // Observe feature cards for animation
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(30px)';
      card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(card);
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function (e) {
      if (isMenuOpen && !mobileMenuBtn.contains(e.target) && !mobileMenu.contains(e.target)) {
      isMenuOpen = false;
      mobileMenu.classList.remove('open');
      menuIcon.classList.remove('hidden');
      closeIcon.classList.add('hidden');
      }
    });

    // Prevent scroll when mobile menu is open
    const body = document.body;
    const observer2 = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
      if (mutation.target.classList.contains('open')) {
        body.style.overflow = 'hidden';
      } else {
        body.style.overflow = '';
      }
      });
    });

    observer2.observe(mobileMenu, { attributes: true, attributeFilter: ['class'] });
    });
  </script>
@endsection