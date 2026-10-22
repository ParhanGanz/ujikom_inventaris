<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name', 'Inventaris SMAKNIS'))
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#4f46e5',
                            600: '#4338ca',
                            700: '#3730a3',
                        }
                    },
                    fontFamily: {
                        sans: ['Figtree', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine.js Collapse Plugin -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-700">

    <!-- Sidebar -->
    @include('layouts.sidebar2')

    <!-- Main Content Wrapper -->
    <div class="ml-64 flex min-h-screen min-w-0 flex-col">

        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="min-w-0 flex-1 p-4 pb-24 sm:p-6 sm:pb-24 lg:p-8 lg:pb-24">
            <div class="mx-auto w-full max-w-7xl">
                @yield('content')
            </div>
        </main>

    </div>

    <!-- Footer tetap di bawah layar -->
    @include('layouts.footer')

    </div>

</body>

</html>
