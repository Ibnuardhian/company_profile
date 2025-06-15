<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="text-center bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h1 class="text-4xl font-bold text-center mb-12">GALERI LAJOO TRANS</h1>
    <x-gallery-carousel :images="$images" class="max-w-5xl mx-auto" />
</div>