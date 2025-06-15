<div class="mt-24">
    @if(isset($aboutList) && is_array($aboutList))
        @foreach($aboutList as $aboutData)
            <div class="flex flex-col items-center justify-center h-full w-full mb-12">
                <h1 class="text-4xl font-bold mb-8">{{ $aboutData['title'] ?? 'LAJOO TRANS' }}</h1>
                <div class="flex flex-row w-full max-w-5xl justify-center items-center gap-8 mx-auto my-auto">
                    <div class="flex items-center justify-center w-64 h-64">
                        <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png" alt="Foto" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                    <div class="flex-1 flex flex-col justify-between h-64">
                        <p class="mb-8 text-justify">
                            {{ $aboutData['description'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>