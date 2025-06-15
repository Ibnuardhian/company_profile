<!-- CUSTOMER KAMI Section -->
<div class="text-center bg-white min-h-[30vh] py-10">
    <h2 class="font-bold text-2xl">CUSTOMER KAMI</h2>
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
