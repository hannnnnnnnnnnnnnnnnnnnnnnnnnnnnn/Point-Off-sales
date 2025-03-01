<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-[#D4F7E6]"> <!-- Soft Muda Hijau -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
               <!-- Logo -->
            <div class="flex justify-center mb-3 ">
                <img src="{{ asset('img/1.png') }}" alt="Point of Sales Logo" class="w-28 h-auto">
            </div>

            <div class="w-full sm:max-w-md mt-3 px-6 py-8 bg-[#E6F9EB] rounded-2xl border border-[#6ACD86]"> <!-- Hijau muda dan border lebih lembut -->
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-semibold text-[#6ACD86]">Selamat Datang </h1> <!-- Judul dengan hijau lebih soft -->
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
