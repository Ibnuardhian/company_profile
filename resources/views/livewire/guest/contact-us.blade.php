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
                        $activeContacts = $companyProfile->activeContacts->where('is_active', true);
                    @endphp
                    @if($activeContacts->count() > 0)
                        @foreach($activeContacts as $contact)
                            <li class="flex items-center gap-2">
                                @if($contact->type === 'whatsapp')
                                    <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i>
                                @elseif($contact->type === 'phone')
                                    <i class="fas fa-phone text-blue-500 text-lg"></i>
                                @elseif($contact->type === 'email')
                                    <i class="fas fa-envelope text-gray-600 text-lg"></i>
                                @elseif($contact->type === 'website')
                                    <i class="fas fa-globe text-purple-500 text-lg"></i>
                                @elseif($contact->type === 'instagram')
                                    <i class="fa-brands fa-instagram"></i>
                                @elseif($contact->type === 'facebook')
                                    <i class="fa-brands fa-square-facebook text-blue-500"></i>
                                @else
                                    <i class="fas fa-info-circle text-gray-500 text-lg"></i>
                                @endif
                                {{ $contact->label }} : 
                                @if($contact->type === 'email' || $contact->type === 'website')
                                    <span class="italic">{{ $contact->value }}</span>
                                @else
                                    {{ $contact->value }}
                                @endif
                            </li>
                        @endforeach
                    @else
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone text-gray-500 text-lg"></i>
                            Kontak : Data belum diisi
                        </li>
                    @endif
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
