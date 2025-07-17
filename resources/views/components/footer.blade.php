<!-- Footer Layout -->
<footer class="bg-gray-800 text-gray-300 py-12">
    <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between gap-12">
        <!-- Logo & Description -->
        <div class="md:w-1/4 flex flex-col">
            <div class="mb-4">
                <span class="text-xl sm:text-2xl md:text-3xl lg:text-4xl xl:text-5xl text-white font-bold leading-tight">
                    {{ \DB::table('company_profile')->value('name') }}
                </span>
            </div>
            <p class="mb-4">We are a young company always looking for new and creative ideas to help you with our products in your everyday work.</p>
            <a href="#" class="text-green-400 hover:underline">Our Team</a>
        </div>
        
        <!-- Contact -->
        <div class="md:w-3/5">
            <h3 class="text-2xl text-white mb-4">Contact</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <!-- Address from company profile -->
                <x-contact-component 
                    icon='<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a2 2 0 00-2.828 0l-4.243 4.243a8 8 0 1011.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"/>'
                    iconType="svg"
                    :value="\DB::table('company_profile')->value('address')" />
                
                <!-- Dynamic contacts from contacts table -->
                @php
                    $contacts = \DB::table('contacts')->where('is_primary', 1)->get();
                @endphp
                
                @foreach($contacts as $contact)
                    <x-contact-component 
                        :icon="getContactIcon($contact->type)"
                        iconType="fontawesome"
                        :label="ucfirst($contact->type)"
                        :value="$contact->value"
                        :link="getContactLink($contact->type, $contact->value)" />
                @endforeach
            </div>
        </div>
        
        <!-- Links -->
        <div class="md:w-1/4">
            <h3 class="text-2xl text-white mb-4">Links</h3>
            <ul class="space-y-2">
                <li><a href="/" class="hover:underline">Home</a></li>
                <li><a href="/about-us" class="hover:underline">Tentang</a></li>
                <li><a href="/armada" class="hover:underline">Armada</a></li>
                <li><a href="/daftar-harga" class="hover:underline">Daftar Harga</a></li>
                <li><a href="/blog" class="hover:underline">Blog</a></li>
                <li><a href="/contact-us" class="hover:underline">Hubungi Kami</a></li>
            </ul>
        </div>
    </div>
</footer>
