<div class="mt-24">
    @if(isset($aboutList) && is_array($aboutList))
        @php
            $aboutHome = collect($aboutList)->firstWhere('slug', 'about-home') ?? collect($aboutList)->firstWhere('slug', 'about-us');
            $visi = collect($aboutList)->firstWhere('slug', 'visi');
            $misi = collect($aboutList)->firstWhere('slug', 'misi');
        @endphp
        @if($aboutHome)
            <div class="flex flex-col items-center justify-center h-full w-full mb-24">
                <h1 class="text-4xl font-bold mb-8 uppercase">{{ $aboutHome['title'] ?? 'LAJOO TRANS' }}</h1>
                <div class="flex flex-row w-full max-w-5xl justify-center items-center gap-8 mx-auto my-auto">
                    <div class="flex items-center justify-center w-64 h-64 bg-gray-200 rounded-lg overflow-hidden">
                        <x-image-with-fallback :src="$aboutHome['image']" fallback="images/default-no-image.png" alt="Foto {{ $aboutHome['title'] ?? 'LAJOO TRANS' }}" class="object-cover w-full h-full" />
                    </div>
                    <div class="flex-1 flex flex-col justify-between h-64">
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {{ $aboutHome['description'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex flex-col items-center justify-center h-full w-full mb-24">
            <h1 class="text-3xl font-bold mb-8 uppercase">VISI & MISI</h1>
            <div class="flex flex-col gap-16 w-full max-w-5xl mx-auto">
                @if($visi)
                <div class="flex flex-row w-full justify-center items-center gap-8">
                    <div class="flex-1 flex flex-col justify-start h-64">
                        <h2 class="text-xl font-bold mb-4 uppercase">VISI LAJOO TRANS</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {{ $visi['description'] ?? '' }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center w-64 h-64">
                        <x-image-with-fallback :src="$visi['image'] ?? 'images/meeting.jpg'" fallback="images/default-no-image.png" alt="Foto Visi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                </div>
                @endif
                @if($misi)
                <div class="flex flex-row w-full justify-center items-center gap-8">
                    <div class="flex items-center justify-center w-64 h-64">
                        <x-image-with-fallback :src="$misi['image'] ?? 'images/meeting.jpg'" fallback="images/default-no-image.png" alt="Foto Misi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                    <div class="flex-1 flex flex-col justify-start h-64">
                        <h2 class="text-xl font-bold mb-4 uppercase">MISI LAJOO TRANS</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {{ $misi['description'] ?? '' }}
                        </p>
                    </div>

                </div>
                @endif
            </div>
        </div>
    @endif
    @livewire('features')
</div>