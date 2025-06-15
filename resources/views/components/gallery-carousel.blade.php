@props(['images' => [], 'class' => ''])
<div x-data="{
    active: 0,
    perSlide: window.innerWidth < 768 ? 1 : 3,
    get total() { return Math.ceil({{ count($images) }} / this.perSlide) },
    updatePerSlide() {
        this.perSlide = window.innerWidth < 768 ? 1 : 3;
    }
}"
     x-init="window.addEventListener('resize', () => { updatePerSlide(); active = 0 })"
     class="relative w-full {{ $class }}" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96 flex items-center justify-center">
        <template x-for="group in total" :key="group">
            <div x-show="active === (group-1)" x-transition:enter="transition-opacity duration-[1200ms]" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-[1200ms]" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="w-full flex justify-center gap-4 absolute inset-0">
                @php
                    $chunks1 = array_chunk($images, 1);
                    $chunks3 = array_chunk($images, 3);
                @endphp
                <!-- Mobile: 1 per slide -->
                <div class="w-full flex justify-center md:hidden mx-4">
                    @foreach($chunks1 as $g => $chunk)
                        <template x-if="active === {{ $g }} && perSlide === 1">
                            <div class="w-full flex justify-center gap-4">
                                @foreach($chunk as $img)
                                    <div class="flex-1 flex items-center justify-center">
                                        <img src="{{ $img }}" class="block max-w-full h-44 md:h-80 object-cover rounded-lg shadow" alt="Gallery Image">
                                    </div>
                                @endforeach
                            </div>
                        </template>
                    @endforeach
                </div>
                <!-- Desktop: 3 per slide -->
                <div class="w-full flex justify-center gap-4 hidden md:flex mx-4">
                    @foreach($chunks3 as $g => $chunk)
                        <template x-if="active === {{ $g }} && perSlide === 3">
                            <div class="w-full flex justify-center gap-4">
                                @foreach($chunk as $img)
                                    <div class="flex-1 flex items-center justify-center">
                                        <img src="{{ $img }}" class="block max-w-full h-44 md:h-80 object-cover rounded-lg shadow" alt="Gallery Image">
                                    </div>
                                @endforeach
                            </div>
                        </template>
                    @endforeach
                </div>
            </div>
        </template>
    </div>
    <!-- Slider controls -->
    <button type="button" @click="active = (active - 1 + total) % total" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
            </svg>
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" @click="active = (active + 1) % total" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none">
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>
