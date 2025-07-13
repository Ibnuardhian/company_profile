<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

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
        <style>[x-cloak] { display: none !important; }</style>
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <!-- Slide Over Navigation -->
        <div x-data="{ 
                slideOverOpen: false 
            }"
            class="relative z-50 w-auto h-auto">
            
            <template x-teleport="body">
                <div 
                    x-show="slideOverOpen"
                    @keydown.window.escape="slideOverOpen=false"
                    class="relative z-[99]">
                    <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-50"></div>
                    <div class="fixed inset-0 overflow-hidden">
                        <div class="absolute inset-0 overflow-hidden">
                            <div class="fixed inset-y-0 left-0 flex max-w-full pr-10">
                                <div 
                                    x-show="slideOverOpen" 
                                    @click.away="slideOverOpen = false"
                                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                                    x-transition:enter-start="-translate-x-full" 
                                    x-transition:enter-end="translate-x-0" 
                                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                                    x-transition:leave-start="translate-x-0" 
                                    x-transition:leave-end="-translate-x-full" 
                                    class="w-screen max-w-xs">
                                    <div class="flex flex-col h-full bg-gray-800 text-white shadow-xl">
                                        <!-- Header -->
                                        <div class="flex items-center justify-between px-4 py-4 bg-gray-900">
                                            <h2 class="text-lg font-semibold text-white">Admin Panel</h2>
                                            <button @click="slideOverOpen=false" class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-white rounded-md hover:bg-gray-700 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        
                                        <!-- Navigation -->
                                        <nav class="flex-1 px-4 py-6 overflow-y-auto">
                                            <ul class="space-y-2">
                                                <li>
                                                    <a href="{{ route('dashboard') }}" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors duration-200">
                                                        <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                                                        Dashboard
                                                    </a>
                                                </li>
                                                @can('edit company profile')
                                                <li>
                                                    <a href="#" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('company.profile.edit') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors duration-200">
                                                        <i class="fas fa-building mr-3 w-5"></i>
                                                        Company Profile
                                                    </a>
                                                </li>
                                                @endcan
                                                @can('manage users')
                                                <li>
                                                    <a href="#" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                                        <i class="fas fa-users mr-3 w-5"></i>
                                                        Users
                                                    </a>
                                                </li>
                                                @endcan
                                                <li>
                                                    <a href="#" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                                        <i class="fas fa-blog mr-3 w-5"></i>
                                                        Blog Posts
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                                        <i class="fas fa-images mr-3 w-5"></i>
                                                        Gallery
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" 
                                                       @click="slideOverOpen = false"
                                                       class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                                        <i class="fas fa-cog mr-3 w-5"></i>
                                                        Settings
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                        
                                        <!-- User Menu -->
                                        <div class="p-4 border-t border-gray-700">
                                            <div class="flex items-center mb-3">
                                                <img class="h-8 w-8 rounded-full" 
                                                     src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&color=7F9CF5&background=EBF4FF' }}" 
                                                     alt="{{ Auth::user()->name ?? 'Admin' }}">
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-white">{{ Auth::user()->name ?? 'Admin' }}</p>
                                                    <p class="text-xs text-gray-400">Administrator</p>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" 
                                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors duration-200">
                                                    <i class="fas fa-sign-out-alt mr-3 w-5"></i>
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Main Content -->
            <div class="min-h-screen flex flex-col">
                <!-- Top Navigation -->
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center">
                            <button @click="slideOverOpen = true" 
                                    type="button" 
                                    class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-gray-50 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none">
                                <i class="fas fa-bars mr-2"></i>
                                Menu
                            </button>
                            <h2 class="text-xl font-semibold text-gray-800 ml-4">
                                @yield('page-title', 'Dashboard')
                            </h2>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Notifications -->
                            <div class="relative">
                                <button class="text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                                    <i class="fas fa-bell text-lg"></i>
                                    <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                                </button>
                            </div>
                            
                            <!-- User Menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&color=7F9CF5&background=EBF4FF' }}" 
                                         alt="{{ Auth::user()->name ?? 'Admin' }}">
                                </button>
                                
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    <a href="{{ route('profile.show') }}" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i>Profile
                                    </a>
                                    <a href="#" 
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i>Settings
                                    </a>
                                    <hr class="my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" 
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-6">
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
        @livewireScripts
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </body>
</html>
