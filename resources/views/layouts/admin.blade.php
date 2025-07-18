<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    @if(getFirstLogo())
        <link rel="shortcut icon" href="{{ getFirstLogo() }}" type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- Alpine.js x-cloak style -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <!-- <div x-data="{ slideOverOpen: false }" class="relative z-50 w-auto h-auto"> -->
    <div class="relative z-50 w-auto h-auto">
        
        <!-- Slideover Navigation Component -->
        <x-admin.slideover-navigation />

        <!-- Main Content -->
        <div class="min-h-screen flex flex-col">
            <!-- Top Navigation Component -->
            <x-admin.top-navigation />

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <!-- Flash Messages -->
                @if(session('login_as_message'))
                    <div class="mb-4 bg-blue-100 border border-blue-200 text-blue-700 px-4 py-3 rounded relative" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="block sm:inline">{{ session('login_as_message') }}</span>
                    </div>
                @endif

                @if (isset($header))
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @endif

                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </div>

    @stack('modals')
    
    Alpine.js
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireScripts
</body>

</html>