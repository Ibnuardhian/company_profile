<!-- Slide Over Navigation -->
<template x-teleport="body">
    <div x-show="slideOverOpen" @keydown.window.escape="slideOverOpen=false" class="relative z-[99]">
        <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="fixed inset-y-0 left-0 flex max-w-full pr-10">
                    <div x-show="slideOverOpen" @click.away="slideOverOpen = false"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                        class="w-screen max-w-xs">
                        <div class="flex flex-col h-full bg-gray-800 text-white shadow-xl">
                            <!-- Header -->
                            <div class="flex items-center justify-between px-4 py-4 bg-gray-900">
                                <h2 class="text-lg font-semibold text-white">Admin Panel</h2>
                                <button @click="slideOverOpen=false"
                                    class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-white rounded-md hover:bg-gray-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Navigation -->
                            <nav class="flex-1 px-4 py-6 overflow-y-auto">
                                <ul class="space-y-2">
                                    <li>
                                        <a href="{{ route('dashboard') }}" @click="slideOverOpen = false"
                                            class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('dashboard') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors duration-200">
                                            <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    @can('view company profile')
                                        <li>
                                            <a href="{{ route('admin.company-profile') }}" @click="slideOverOpen = false"
                                                class="flex items-center px-4 py-3 text-sm rounded-lg {{ request()->routeIs('admin.company.profile.edit') ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} transition-colors duration-200">
                                                <i class="fas fa-building mr-3 w-5"></i>
                                                Company Profile
                                            </a>
                                        </li>
                                    @endcan
                                    @can('manage users')
                                        <li>
                                            <a href="#" @click="slideOverOpen = false"
                                                class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                                <i class="fas fa-users mr-3 w-5"></i>
                                                Users
                                            </a>
                                        </li>
                                    @endcan
                                    <li>
                                        <a href="#" @click="slideOverOpen = false"
                                            class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                            <i class="fas fa-blog mr-3 w-5"></i>
                                            Blog Posts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" @click="slideOverOpen = false"
                                            class="flex items-center px-4 py-3 text-sm rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition-colors duration-200">
                                            <i class="fas fa-images mr-3 w-5"></i>
                                            Gallery
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" @click="slideOverOpen = false"
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
                                        src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Admin') . '&color=7F9CF5&background=EBF4FF' }}"
                                        alt="{{ Auth::user()->name ?? 'Admin' }}">
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white">
                                            {{ Auth::user()->name ?? 'Admin' }}</p>
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
