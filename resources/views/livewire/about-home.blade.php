<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-col items-center justify-start py-8 bg-white min-h-[50vh] w-full transition-all duration-[1500ms] opacity-0 translate-y-8">
    @if (($aboutData['slug'] ?? null) === 'about-us')
    <div class="flex flex-col items-center justify-center h-full w-full">
        <h1 class="text-4xl font-bold mb-8">{{ $aboutData['title'] ?? 'LAJOO TRANS' }}</h1>
        <div class="flex flex-row w-full max-w-5xl justify-center items-center gap-8 mx-auto my-auto">
            <div class="flex items-center justify-center w-64 h-64">
                <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png" alt="Foto"
                    class="object-cover w-full h-full rounded-lg shadow-lg" />
            </div>
            <div class="flex-1 flex flex-col justify-between h-64">
                <p class="mb-8 text-justify">
                    {{ $aboutData['description'] ?? '' }}
                </p>
                <div class="flex justify-end">
                    <a href="{{ route('about-us') }}">
                        <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow">
                            Lihat Detail &gt;
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>