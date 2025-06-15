<div>
    <!-- Section Testimoni Card 2 Horizontal -->
    <div class="bg-white min-h-[30vh] py-10 transition-all duration-[1500ms]">
        <div class="text-center text-3xl font-bold mb-8 bg-white">TESTIMONI</div>
        <div class="flex flex-col items-center">
            <div class="relative flex w-full max-w-4xl justify-center mb-4">
                <!-- Left Chevron Button -->
                <button class="absolute left-0 -translate-x-full top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-3 shadow flex items-center justify-center mr-12" aria-label="Sebelumnya" wire:click="previous">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <!-- Testimonial Cards (max 2 at a time) -->
                @foreach(array_slice($testimonials, $index, 2) as $i => $testimonial)
                    <div class="w-1/2 mx-2">
                        <div
                            key="testimonial-{{ $index + $i }}-{{ Str::slug($testimonial['nama']) }}"
                            class="testimonial-card-custom bg-gray-100 rounded-xl w-full p-6 flex flex-col gap-2 items-start shadow-md transition-all duration-500 opacity-0 scale-90"
                            wire:key="testimonial-{{ $index + $i }}-{{ Str::slug($testimonial['nama']) }}"
                            x-data="{ show: false }"
                            x-init="$nextTick(() => { show = true })"
                            x-effect="show = false; setTimeout(() => show = true, 10)"
                            :class="show ? 'popup-transition' : 'opacity-0 scale-90'"
                        >
                            <div class="flex items-center gap-3 w-full">
                                <img src="{{ $testimonial['foto'] }}" alt="Foto Pelanggan" class="w-10 h-10 rounded-full object-cover border-2 border-gray-400 bg-white" onerror="this.onerror=null;this.src='/images/default-no-image.png';" />
                                <div>
                                    <div class="font-bold">{{ $testimonial['nama'] }}</div>
                                    <div class="italic text-base">{{ $testimonial['jenis'] }}</div>
                                </div>
                            </div>
                            <div class="testimonial-isi mt-2 text-base leading-relaxed max-w-[290px] break-words">
                                {{ $testimonial['isi'] }}
                            </div>
                            <div class="flex w-full justify-end items-end mt-auto">
                                <div class="text-xl text-gray-800">
                                    @for($b=0; $b<$testimonial['bintang']; $b++)
                                        ☆
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Right Chevron Button -->
                <button class="absolute right-0 translate-x-full top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-3 shadow flex items-center justify-center ml-12" aria-label="Berikutnya" wire:click="next">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        </div>
        <style>
            .popup-transition {
                opacity: 1 !important;
                transform: scale(1) !important;
                transition: opacity 0.5s cubic-bezier(0.4,0,0.2,1), transform 0.5s cubic-bezier(0.4,0,0.2,1);
            }
            .testimonial-card-custom {
                min-height: 220px;
                max-height: 220px;
                display: flex;
                flex-direction: column;
            }
            .testimonial-isi {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
                min-height: 72px;
                max-height: 96px;
            }
        </style>
    </div>
</div>