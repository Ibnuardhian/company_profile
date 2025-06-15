<div>
<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="w-screen min-h-screen flex flex-col justify-center items-center bg-white transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h2 class="text-4xl font-bold text-center mb-12">KENAPA MEMILIH LAJOO TRANS?</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 w-full max-w-7xl px-4">
        @foreach($features as $feature)
        <div class="flex flex-col items-center text-center">
            <x-image-with-fallback :src="$feature['src']" :fallback="$feature['fallback']" :alt="$feature['alt']" class="w-56 h-56 object-cover bg-gray-300 mb-6 rounded-lg shadow-lg" />
            <h3 class="font-bold text-xl mb-3 w-56">{{ $feature['title'] }}</h3>
            <p class="text-base text-gray-600 text-justify w-56">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</div>
</div>