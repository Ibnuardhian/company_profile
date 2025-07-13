<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="bg-white min-h-[30vh] py-10 px-4 md:px-0 transition-all duration-[1500ms] opacity-0 translate-y-8">
    <div class="flex flex-col md:flex-row justify-center items-start gap-8 w-full max-w-5xl mx-auto">
        <!-- Left: Accordion Questions -->
        <div class="w-full md:w-1/2">
            <div x-data="{ 
                    activeAccordion: '', 
                    setActiveAccordion(id) { 
                        this.activeAccordion = (this.activeAccordion == id) ? '' : id 
                    } 
                }" class="relative w-full mx-auto overflow-hidden text-sm font-normal bg-white border border-gray-200 divide-y divide-gray-200 rounded-md">
                @foreach($questions as $idx => $q)
                    <div x-data="{ id: 'accordion-{{ $idx }}' }" class="cursor-pointer group">
                        <button @click="setActiveAccordion(id)" class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline">
                            <span>{{ $q['q'] }}</span>
                            <svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion==id }" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div x-show="activeAccordion==id" x-collapse x-cloak>
                            <div class="p-4 pt-0 opacity-70 transition-all duration-500 ease-in-out">{{ $q['a'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Right: Company Info -->
        <div class="w-full md:w-1/2 flex flex-col gap-4">
            <div>
                <span class="font-bold italic text-lg">{{ $companyProfile->name }}</span>
                <div class="mt-2">
                    <span class="font-semibold">Alamat</span>
                    <div class="text-sm opacity-80 mt-1">{{ $companyProfile->address }}</div>
                    @if($companyProfile->pool_address !== 'Data belum diisi')
                        <div class="mt-2 font-semibold">Pool {{ $companyProfile->name }}</div>
                        <div class="text-sm opacity-80 mt-1">{{ $companyProfile->pool_address }}</div>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <span class="font-bold italic">KONTAK KAMI</span>
                <ul class="mt-2 space-y-1">
                    @if($companyProfile->formatted_phone_numbers && count($companyProfile->formatted_phone_numbers) > 0)
                        @foreach($companyProfile->formatted_phone_numbers as $phone)
                            <li class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16.7 13.1c-.2-.1-1.2-.6-1.4-.7-.2-.1-.4-.1-.6.1-.2.2-.7.7-.8.9-.1.2-.3.2-.5.1-.2-.1-.8-.3-1.5-.9-.6-.5-1-1.1-1.1-1.3-.1-.2 0-.4.1-.5.1-.1.2-.3.3-.4.1-.1.1-.2.2-.4.1-.2 0-.3 0-.4 0-.1-.6-1.5-.8-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4.1-.5.3-.2.2-.7.7-.7 1.7 0 1 .7 2 1.1 2.4.4.4 1.5 1.7 3.6 2.3.5.1.9.2 1.2.1.4-.1 1.2-.5 1.4-1 .2-.5.2-.9.1-1-.1-.1-.2-.1-.4-.2z"/>
                                </svg> 
                                {{ $phone['label'] }} : {{ $phone['number'] }}
                            </li>
                        @endforeach
                    @else
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16.7 13.1c-.2-.1-1.2-.6-1.4-.7-.2-.1-.4-.1-.6.1-.2.2-.7.7-.8.9-.1.2-.3.2-.5.1-.2-.1-.8-.3-1.5-.9-.6-.5-1-1.1-1.1-1.3-.1-.2 0-.4.1-.5.1-.1.2-.3.3-.4.1-.1.1-.2.2-.4.1-.2 0-.3 0-.4 0-.1-.6-1.5-.8-2-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.4.1-.5.3-.2.2-.7.7-.7 1.7 0 1 .7 2 1.1 2.4.4.4 1.5 1.7 3.6 2.3.5.1.9.2 1.2.1.4-.1 1.2-.5 1.4-1 .2-.5.2-.9.1-1-.1-.1-.2-.1-.4-.2z"/>
                            </svg> 
                            Nomor Telepon : Data belum diisi
                        </li>
                    @endif
                    <li class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 2v.01L12 13 4 6.01V6h16zM4 20v-9.99l8 7 8-7V20H4z"/>
                        </svg> 
                        Alamat Email : <span class="italic">{{ $companyProfile->email }}</span>
                    </li>
                </ul>
            </div>
            <div class="mt-4">
                <span class="font-bold italic">LOKASI {{ strtoupper($companyProfile->name) }}</span>
                <div class="mt-2 border rounded overflow-hidden w-full max-w-xs">
                    @if($companyProfile->google_maps_embed_url)
                        <iframe src="{{ $companyProfile->google_maps_embed_url }}" 
                                width="100%" 
                                height="250" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4703.10554011983!2d106.83971377573359!3d-6.412367362713644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb001230284f%3A0xf4ea649da2603a61!2srumah%20nenek%20Am!5e1!3m2!1sid!2sid!4v1750077484161!5m2!1sid!2sid" 
                                width="100%" 
                                height="250" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
