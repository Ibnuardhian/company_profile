<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible, 'mt-10': window.innerWidth < 768}" class="w-screen min-h-screen flex flex-col justify-center items-center bg-white transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h1 class="text-4xl font-bold text-center mb-12">REKOMENDASI UNTUK ANDA</h1>
    <div class="flex justify-center w-full">
        @php
            $count = count($products);
            $gridCols = $count > 4 ? 4 : $count;
        @endphp
        <div class="grid gap-8 w-full max-w-7xl px-4 justify-items-center place-content-center"
            style="grid-template-columns: repeat({{ $gridCols }}, minmax(0, 1fr));">
            @foreach($products as $product)
                <x-feature-card 
                    :src="$product['src']" 
                    :fallback="$product['fallback']" 
                    :alt="$product['alt']" 
                    :title="$product['title']" 
                    :desc="$product['price']" 
                    buttonLabel="Beli Sekarang"
                />
            @endforeach
        </div>
    </div>
</div>
