<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false"
    :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible, 'mt-10': window.innerWidth < 768}"
    class="w-screen min-h-screen flex flex-col justify-center items-center bg-white transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h1 class="text-4xl font-bold text-center mb-12">KENAPA MEMILIH LAJOO TRANS?</h1>
    <div class="flex flex-wrap gap-8 w-full max-w-7xl px-4">
        @foreach($features as $feature)
            <x-feature-card :src="$feature['src']" :fallback="$feature['fallback']" :alt="$feature['alt']"
                :title="$feature['title']" :desc="$feature['desc']" />
        @endforeach
    </div>
</div>