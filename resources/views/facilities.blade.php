<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-col items-center min-h-screen bg-white py-12 transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-center">ARMADA KAMI</h1>
    <div class="w-full max-w-3xl aspect-square bg-gray-200 flex items-center justify-center shadow-md">
        <x-image-with-fallback 
            src="images/meeting.jpg" 
            fallback="images/default-no-image.png" 
            alt="Lajoo Trans Banner" 
            class="object-cover w-full h-full" 
        />
    </div>
</div>

