<div>
    @if(isset($companyName))
        <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-col items-center justify-center h-full w-full mb-24 text-center bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
            <h1 class="text-4xl font-bold mb-8 uppercase mx-4 md:mx-0">{{ $companyName ?? 'Data belum diisi' }}</h1>
            <div class="flex flex-row w-full max-w-5xl justify-center items-start gap-8 mx-auto my-auto flex-col md:flex-row">
                <div class="flex items-center justify-center w-64 h-64 bg-gray-200 rounded-lg overflow-hidden hidden md:flex">
                    <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png" alt="Foto {{ $companyName ?? 'Data belum diisi' }}" class="object-cover w-full h-full" />
                </div>
                <div class="flex-1 flex flex-col justify-between mx-4 md:mx-0">
                    <p class="mb-8 text-justify text-sm md:text-base">
                        {!! nl2br(e($companyDescription ?? 'Data belum diisi')) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center h-full w-full mb-24">
            <h1 class="text-3xl font-bold mb-8 uppercase">VISI & MISI</h1>
            <div class="flex flex-col gap-16 w-full max-w-5xl mx-auto">
                @if(isset($companyVision))
                <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-row w-full justify-center items-start gap-8 flex-col md:flex-row bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
                    <div class="flex-1 flex flex-col justify-start mx-4 md:mx-0">
                        <h2 class="text-xl font-bold mb-4 uppercase">VISI {{ $companyName ?? 'Data belum diisi' }}</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {!! nl2br(e($companyVision ?? 'Data belum diisi')) !!}
                        </p>
                    </div>
                    <div class="flex items-center justify-center w-64 h-64 hidden md:flex">
                        <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png" alt="Foto Visi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                </div>
                @endif
                @if(isset($companyMission))
                <div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="flex flex-row w-full justify-center items-start gap-8 flex-col md:flex-row bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
                    <div class="flex items-center justify-center w-64 h-64 hidden md:flex">
                        <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png" alt="Foto Misi" class="object-cover w-full h-full rounded-lg shadow-lg" />
                    </div>
                    <div class="flex-1 flex flex-col justify-start mx-4 md:mx-0">
                        <h2 class="text-xl font-bold mb-4 uppercase">MISI {{ $companyName ?? 'Data belum diisi' }}</h2>
                        <p class="mb-8 text-justify text-sm md:text-base">
                            {!! nl2br(e($companyMission ?? 'Data belum diisi')) !!}
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