@props([
    'src', 'fallback', 'alt', 'title', 'desc', 'buttonLabel' => null, 'buttonLink' => null
])

<div class="rounded-lg overflow-hidden bg-white text-neutral-700 w-[270px] flex flex-col items-center mx-auto mb-8 border border-gray-300 {{ $buttonLabel ? 'h-[420px] shadow-xl' : 'h-[360px] shadow' }}">
    <div class="relative w-full">
        <x-image-with-fallback :src="$src" :fallback="$fallback" :alt="$alt" class="w-full h-52 object-cover bg-gray-300" />
    </div>
    <div class="p-5 w-full flex flex-col items-center">
        <h3 class="mb-2 text-base font-bold leading-none tracking-tight text-center">{{ $title }}</h3>
        <p class="mb-4 text-sm text-neutral-500 text-justify">
            {{ \Illuminate\Support\Str::limit($desc, 120) }}
        </p>
        @if($buttonLabel && $buttonLink)
            <a href="{{ $buttonLink }}" class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">{{ $buttonLabel }}</a>
        @elseif($buttonLabel)
            <button class="inline-flex items-center justify-center w-full h-10 px-4 py-2 text-sm font-medium text-white transition-colors rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-neutral-950 hover:bg-neutral-950/90">{{ $buttonLabel }}</button>
        @endif
    </div>
</div>
