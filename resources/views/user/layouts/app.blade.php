<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Health App')</title>
    <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    @include('user.partials.header')

    <!-- Main Content -->
    <main class="mx-auto px-6 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <!-- <footer class="bg-white shadow-sm mt-6">
        <div class="container mx-auto px-4 py-4 text-center text-gray-600">
            © {{ now()->year }} Health App. All rights reserved.
        </div>
    </footer> --> <!-- Scripts -->
    <script>
        // Icons are automatically initialized by the lucide.js module
        // This script is kept for backwards compatibility
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>

</html>