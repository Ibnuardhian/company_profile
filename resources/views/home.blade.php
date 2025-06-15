<x-app-layout>
    <div class="w-full">
        <div x-data="{ active: 0, images: ['images/meeting.jpg', 'images/default-no-image.png'] }" class="relative w-full overflow-hidden">
            <template x-for="(img, idx) in images" :key="idx">
                <div x-show="active === idx" 
                     x-transition:enter="transition-opacity duration-700"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-700"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="w-full h-[90vh] flex items-center justify-center transition-all duration-500">
                    <img :src="img" alt="Banner" class="object-cover w-full h-full" />
                </div>
            </template>
            <!-- Prev Button -->
            <button @click="active = active === 0 ? images.length - 1 : active - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 rounded-full p-2 shadow hover:bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-700"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </button>
            <!-- Next Button -->
            <button @click="active = active === images.length - 1 ? 0 : active + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 rounded-full p-2 shadow hover:bg-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-gray-700"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </button>
            <!-- Dots -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                <template x-for="(img, idx) in images" :key="idx">
                    <button @click="active = idx" :class="{'bg-blue-600': active === idx, 'bg-gray-300': active !== idx}" class="w-3 h-3 rounded-full"></button>
                </template>
            </div>
        </div>
    </div>
    @livewire('features')
    @livewire('about-home')
    @livewire('facilities')
    @livewire('testimonials')
    @livewire('customers')
</x-app-layout>