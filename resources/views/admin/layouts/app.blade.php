<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - FastFit Admin</title>
  <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Alpine.js CDN -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @yield('styles')
</head>

<body class="min-h-screen bg-gray-50">
  <div class="flex h-screen overflow-hidden">
    @include('admin.partials.sidebar')
    <main class="flex-1 overflow-y-auto">
      @yield('content')
      <footer class="bg-gray-100 py-4">
        <div class="container mx-auto px-4 text-center text-gray-600">
          <p>© {{ now()->year }} Platform Diet & Olahraga. Tugas Akhir.</p>
        </div>
      </footer>
    </main>
  </div>
  <script>
    // Initialize Lucide icons when DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
      if (window.lucide && window.lucide.createIcons) {
        window.lucide.createIcons();
      }
    });
  </script>
  <script src="{{ asset('js/admin-notifications.js') }}"></script>
  @yield('scripts')
</body>

</html>