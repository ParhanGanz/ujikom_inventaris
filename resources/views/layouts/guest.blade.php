<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inventaris SMAKNIS') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Custom CSS untuk 3D Card Flip -->
        <style>
            .perspective-1000 {
                perspective: 1000px;
            }
            .transform-style-3d {
                transform-style: preserve-3d;
            }
            .backface-hidden {
                backface-visibility: hidden;
                -webkit-backface-visibility: hidden;
            }
            .rotate-y-180 {
                transform: rotateY(180deg);
            }
        </style>

        <!-- Alpine.js untuk kontrol state animasi -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-100 min-h-screen flex flex-col justify-center items-center py-6 px-4 sm:px-6 lg:px-8">
        
        {{ $slot }}

        <!-- Footer Ringkas -->
        <div class="mt-6 text-center text-xs text-slate-500">
            &copy; {{ date('Y') }} <span class="font-semibold text-slate-600">Inventaris SMAKNIS</span>
        </div>

    </body>
</html>