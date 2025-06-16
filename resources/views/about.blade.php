<div>
    @if(isset($aboutList) && is_array($aboutList))
        @php
            $aboutHome = collect($aboutList)->firstWhere('slug', 'about-home') ?? collect($aboutList)->firstWhere('slug', 'about-us');
            $visi = collect($aboutList)->firstWhere('slug', 'visi');
            $misi = collect($aboutList)->firstWhere('slug', 'misi');
        @endphp
        @if($aboutHome)
            <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-col items-center justify-center h-full w-full mb-24 text-center bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
                <h1 class="text-4xl font-bold mb-8 uppercase mx-4 md:mx-0">{{ $aboutHome['title'] ?? 'LAJOO TRANS' }}</h1>
                <div class="flex flex-row w-full max-w-5xl justify-center items-start gap-8 mx-auto my-auto flex-col md:flex-row">
                    <div class="flex items-center justify-center w-64 h-64 bg-gray-200 rounded-lg overflow-hidden hidden md:flex">
                        <x-image-with-fallback :src="$aboutHome['image']" fallback="images/default-no-image.png" alt="Foto {{ $aboutHome['title'] ?? 'LAJOO TRANS' }}" class="object-cover w-full h-full" />
                    </div>
                    <div class="flex-1 flex flex-col justify-between mx-4 md:mx-0">
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {!! nl2br(e($aboutHome['description'] ?? '')) !!}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex flex-col items-center justify-center h-full w-full mb-24">
            <h1 class="text-3xl font-bold mb-8 uppercase">VISI & MISI</h1>
            <div class="flex flex-col gap-16 w-full max-w-5xl mx-auto">
                @if($visi)
                <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-row w-full justify-center items-start gap-8 flex-col md:flex-row bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
                    <div class="flex-1 flex flex-col justify-start mx-4 md:mx-0">
                        <h2 class="text-xl font-bold mb-4 uppercase">VISI LAJOO TRANS</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {!! nl2br(e($visi['description'] ?? '')) !!}
                        </p>
                    </div>
                    <div class="flex items-center justify-center w-64 h-64 hidden md:flex">
                        <x-image-with-fallback :src="$visi['image']" fallback="images/default-no-image.png" alt="Foto Visi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                </div>
                @endif
                @if($misi)
                <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-row w-full justify-center items-start gap-8 flex-col md:flex-row bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
                    <div class="flex items-center justify-center w-64 h-64 hidden md:flex">
                        <x-image-with-fallback :src="$misi['image']" fallback="images/default-no-image.png" alt="Foto Misi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                    <div class="flex-1 flex flex-col justify-start mx-4 md:mx-0">
                        <h2 class="text-xl font-bold mb-4 uppercase">MISI LAJOO TRANS</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {!! nl2br(e($misi['description'] ?? '')) !!}
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    @endif
    @livewire('features')
    @livewire('gallery')
</div>