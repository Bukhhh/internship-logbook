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
    <body class="font-sans text-foreground antialiased selection:bg-amber-700 selection:text-white">
        
        <!-- Background Coklat Kayu Cerah (Light Wood Brown) -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#fdf8f5] bg-gradient-to-br from-[#f5ebe0] via-[#e6ccb2] to-[#ddb892] relative overflow-hidden">
            
            <!-- Warm, subtle decorative blobs -->
            <div class="absolute top-0 -left-4 w-72 h-72 bg-[#d4a373] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-[#faedcd] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

            <!-- The Logo (Size Fixed!) -->
            <div class="z-10 mb-4">
                <a href="/">
                    <!-- Changed to h-16 w-auto so it stays proportionate and polite! -->
                    <!-- The Logo (Strictly Resized!) -->
            <div class="z-10 mb-6 flex justify-center">
                <a href="/">
                    <img src="{{ asset('mylogo.png') }}" alt="Logo" style="height: 200px; width: auto;" class="drop-shadow-md">
                </a>
            </div>
                </a>
            </div>

            <!-- The Glassmorphism Card -->
            <div class="w-full sm:max-w-md px-10 py-8 bg-white/60 backdrop-blur-xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] sm:rounded-3xl border border-white/50 z-10 transition-all duration-300">
                {{ $slot }}
            </div>
            
        </div>
    </body>
</html>
