<div class="flex flex-col items-center min-h-screen bg-white py-8 md:py-12 transition-all duration-[1500ms] opacity-0 translate-y-8"
     x-data="{ visible: false }"
     x-intersect:enter="visible = true" x-intersect:leave="visible = false"
     :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}">
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 md:mb-8 text-center">DAFTAR HARGA</h1>
    <x-big-carousel :images="$images" />
</div>
