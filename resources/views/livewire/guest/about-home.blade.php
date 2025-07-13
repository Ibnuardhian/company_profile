<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-col items-center justify-start bg-white min-h-[50vh] w-full transition-all duration-[1500ms] opacity-0 translate-y-8">
    <div class="flex flex-col items-center justify-center h-full w-full px-4 md:px-0">
        <h1 class="text-2xl md:text-4xl font-bold mb-6 md:mb-8 text-center">{{ $companyName }}</h1>
        <div class="flex flex-col md:flex-row w-full max-w-5xl justify-center items-center gap-6 md:gap-8 mx-auto my-auto">
            <div class="flex items-center justify-center w-full md:w-64 h-48 md:h-64 mb-4 md:mb-0">
                <img src="{{ $companyImage }}" alt="Company Image"
                    class="object-cover w-full h-full rounded-lg shadow-lg" />
            </div>
            <div class="flex-1 flex flex-col justify-between h-auto md:h-64 w-full">
                <p class="mb-6 md:mb-8 text-justify text-sm md:text-base">
                    {!! nl2br(e(\Illuminate\Support\Str::limit($companyDescription, 600, '...'))) !!}
                </p>
                <div class="flex justify-end">
                    <a href="{{ route('about-us') }}">
                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide transition-colors duration-100 rounded-md text-neutral-500 bg-neutral-50 focus:ring-2 focus:ring-offset-2 focus:ring-neutral-100 hover:text-neutral-600 hover:bg-neutral-100 w-full md:w-auto">
                            Lihat Detail &gt;
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>