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
                    @php
                        $phoneContacts = $companyProfile->activeContacts->whereIn('type', ['phone', 'whatsapp']);
                    @endphp
                    @if($phoneContacts->count() > 0)
                        @foreach($phoneContacts as $contact)
                            <li class="flex items-center gap-2">
                                @if($contact->type === 'whatsapp')
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.567-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                @endif
                                {{ $contact->label }} : {{ $contact->value }}
                            </li>
                        @endforeach
                    @else
                        <li class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
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
