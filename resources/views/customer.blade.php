<!-- CUSTOMER KAMI Section -->
<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="text-center bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
    <h1 class="text-4xl font-bold mb-8">CUSTOMER KAMI</h1>
    <div id="customer-carousel" class="flex justify-center gap-10 mt-8 max-w-6xl mx-auto flex-wrap">
        @foreach(array_chunk($customers, 3) as $chunk)
            <div class="carousel-group hidden flex gap-10 justify-center w-full mb-4">
                @foreach($chunk as $customer)
                    <div class="w-52 h-44 flex flex-col items-center justify-center mb-6 transition-transform duration-500 scale-0 opacity-0 customer-hover-scale">
                        <img src="{{ $customer['src'] }}" alt="{{ $customer['alt'] }}" class="w-52 h-36 object-cover rounded bg-gray-300 customer-img-greyscale" onerror="this.onerror=null;this.src='{{ asset('images/default-no-image.png') }}';">
                        <div class="font-bold text-base mt-2">{{ $customer['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    @vite('resources/js/customer-carousel.js')
</div>
