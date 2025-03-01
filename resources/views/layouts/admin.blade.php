<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - {{ config('app.name', 'Laravel') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        @include('sidebar.index') <!-- Memanggil Sidebar -->

        <!-- Konten Utama -->
        <div class="flex-1 ">
            @yield('content') <!-- Menampilkan konten dari setiap halaman -->
        </div>
    </div>
</body>
</html>
