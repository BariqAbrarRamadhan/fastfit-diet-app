<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Program Diet & Olahraga Khusus Untuk Anda">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Diet & Exercise App')</title>

  <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">

  {{-- Inter Font Google --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  @yield('styles')
</head>

<body class="font-inter bg-white text-gray-900">

  {{-- Authentication Wrapper / Global Layout --}}
  @auth
    {{-- Tambahkan navigasi atau layout khusus jika dibutuhkan --}}
  @endauth

  {{-- Content --}}
  @yield('content')

  {{-- Tambahkan script tambahan jika dibutuhkan --}}
  @yield('scripts')

</body>

</html>