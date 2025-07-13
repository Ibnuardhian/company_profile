<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Company Profile Management</h1>
        </div>
        
        @if(!$showEditForm)
            <!-- View Mode -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Information - Directly Editable -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Company Information</h2>
                    
                    <!-- Logo Upload Section -->
                    <div class="flex items-start space-x-6">
                        <div class="flex flex-col items-center space-y-3">
                            <div class="relative w-32 h-32 border-2 border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                                <!-- Show temporary preview if uploading -->
                                @if($logo_upload)
                                    <img src="{{ $logo_upload->temporaryUrl() }}" 
                                         alt="Preview" 
                                         class="w-full h-full object-cover rounded-lg">
                                @elseif($companyProfile && $companyProfile->logo_path)
                                    <img src="{{ asset('storage/' . $companyProfile->logo_path) }}" 
                                         alt="Company Logo" 
                                         class="w-full h-full object-cover rounded-lg"
                                         onerror="this.src='{{ asset('images/default-no-image.png') }}'">
                                @else
                                    <img src="{{ asset('images/default-no-image.png') }}" 
                                         alt="No Logo" 
                                         class="w-full h-full object-cover rounded-lg opacity-50">
                                @endif
                                
                                <!-- Loading overlay -->
                                <div wire:loading wire:target="logo_upload" class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                    <div class="text-white text-xs">Processing...</div>
                                </div>
                            </div>
                            <div class="w-36">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="logo_input">Upload file</label>
                                <input wire:model="logo_upload" class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="logo_input" type="file" accept="image/*">
                                @error('logo_upload') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                
                                <!-- Loading indicator -->
                                <div wire:loading wire:target="logo_upload" class="text-xs text-blue-600 mt-1">
                                    Uploading...
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex-1 space-y-4">
                            <!-- Company Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Company Name</label>
                                <input type="text" 
                                       wire:model.live="name" 
                                       wire:blur="save"
                                       value="{{ $name ?? '' }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Enter company name">
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                                <textarea wire:model.live="description" 
                                          wire:blur="save"
                                          placeholder="Type your message here."
                                          class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 resize-none">{{ $description ?? '' }}</textarea>
                                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Visi and Misi in a row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Visi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Visi</label>
                            <textarea wire:model.live="vision" 
                                      wire:blur="save"
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                      placeholder="Enter company vision">{{ $vision ?? '' }}</textarea>
                            @error('vision') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Misi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Misi</label>
                            <textarea wire:model.live="mission" 
                                      wire:blur="save"
                                      rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                      placeholder="Enter company mission">{{ $mission ?? '' }}</textarea>
                            @error('mission') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Address Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Address Information</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                        <textarea wire:model.live="address" 
                                  wire:blur="save"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="Enter company address">{{ $address ?? '' }}</textarea>
                        @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Pool Address</label>
                        <textarea wire:model.live="pool_address" 
                                  wire:blur="save"
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                  placeholder="Enter pool address">{{ $pool_address ?? '' }}</textarea>
                        @error('pool_address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Google Maps URL</label>
                        <input type="url" 
                               wire:model.live="google_maps_embed_url" 
                               wire:blur="save"
                               value="{{ $google_maps_embed_url ?? '' }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Enter Google Maps embed URL">
                        @error('google_maps_embed_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button wire:click="save()" 
                        onclick="console.log('=== SUBMIT BUTTON CLICKED ==='); console.log('Timestamp:', new Date().toLocaleString()); console.log('Current form data:', { name: @js($name), description: @js($description), vision: @js($vision), mission: @js($mission), address: @js($address), pool_address: @js($pool_address) }); console.log('=== END SUBMIT LOG ===');"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>

            <!-- Contact Informations-->
            @if($companyProfile && $companyProfile->contacts && count($companyProfile->contacts) > 0)
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Contact Informations</h2>
                        <button wire:click="toggleContactForm" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Add Contact
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($companyProfile->contacts as $contact)
                            <div class="bg-gray-50 p-4 rounded-lg border {{ $contact->is_active ? '' : 'opacity-50' }}">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $contact->label }}</h3>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded uppercase">{{ $contact->type }}</span>
                                        @if($contact->is_primary)
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded ml-1">Primary</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <button wire:click="editContact({{ $contact->id }})" class="text-blue-600 hover:text-blue-800 text-xs p-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click="deleteContact({{ $contact->id }})" class="text-red-600 hover:text-red-800 text-xs p-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <div x-data="{ switchOn: {{ $contact->is_active ? 'true' : 'false' }} }" class="flex items-center">
                                            <input type="checkbox" class="hidden" :checked="switchOn">
                                            <button 
                                                type="button" 
                                                @click="switchOn = !switchOn; $wire.toggleContactStatus({{ $contact->id }})"
                                                :class="switchOn ? 'bg-green-500' : 'bg-gray-300'" 
                                                class="relative inline-flex h-4 w-7 focus:outline-none rounded-full transition-colors duration-200"
                                                x-cloak>
                                                <span :class="switchOn ? 'translate-x-3' : 'translate-x-0'" class="w-4 h-4 duration-200 ease-in-out bg-white rounded-full shadow-sm transform transition-transform"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm break-all">{{ $contact->value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Contact Informations</h2>
                        <button wire:click="toggleContactForm" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                            Add Contact
                        </button>
                    </div>
                    <p class="text-gray-500 italic">No Contact Informations added yet.</p>
                </div>
            @endif

            <!-- Contact Form Modal -->
            @if($showContactForm)
                <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                {{ $editingContactId ? 'Edit Contact' : 'Add New Contact' }}
                            </h3>
                            
                            <form wire:submit.prevent="saveContact">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Type</label>
                                        <select wire:model="contactType" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="phone">Phone</option>
                                            <option value="email">Email</option>
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="website">Website</option>
                                            <option value="address">Address</option>
                                            <option value="social">Social Media</option>
                                        </select>
                                        @error('contactType') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Label</label>
                                        <input type="text" wire:model="contactLabel" placeholder="e.g., Customer Service, Support, etc." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('contactLabel') <span class="text-red-500 text-sm"></span> @enderror
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Value</label>
                                        <input type="text" wire:model="contactValue" placeholder="Contact value (phone, email, URL, etc.)" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('contactValue') <span class="text-red-500 text-sm"></span> @enderror
                                    </div>
                                    
                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="contactIsPrimary" id="contactIsPrimary" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <label for="contactIsPrimary" class="ml-2 block text-sm text-gray-600">Set as primary contact for this type</label>
                                    </div>
                                </div>
                                
                                <div class="flex justify-end space-x-2 mt-6">
                                    <button type="button" wire:click="toggleContactForm" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        {{ $editingContactId ? 'Update' : 'Save' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <!-- Edit Mode -->
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Information -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Company Information</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Company Name</label>
                            <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Description</label>
                            <textarea wire:model="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Primary Color</label>
                            <input type="color" wire:model="primary_color" class="mt-1 block w-16 h-10 rounded border-gray-300">
                            @error('primary_color') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <!-- Mission & Vision -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Mission & Vision</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Mission</label>
                            <textarea wire:model="mission" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('mission') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Vision</label>
                            <textarea wire:model="vision" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('vision') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information Section -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Contact Info -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Contact Information</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Address</label>
                            <textarea wire:model="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Pool Address</label>
                            <textarea wire:model="pool_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('pool_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Email</label>
                            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <!-- Phone Numbers and Maps -->
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Phone & Maps</h2>
                        
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-medium text-gray-600">Phone Numbers</label>
                                <button type="button" wire:click="addPhoneNumber" class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-1 px-2 rounded">
                                    Add Phone
                                </button>
                            </div>
                            @if(is_array($phone_numbers) && count($phone_numbers) > 0)
                                @foreach($phone_numbers as $index => $phone)
                                    <div class="flex items-center space-x-2 mb-2">
                                        <input type="text" wire:model="phone_numbers.{{ $index }}" placeholder="Phone number" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <button type="button" wire:click="removePhoneNumber({{ $index }})" class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-1 px-2 rounded">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <button type="button" wire:click="addPhoneNumber" class="w-full border-2 border-dashed border-gray-300 rounded-md p-4 text-gray-500 hover:border-gray-400">
                                    Click to add phone number
                                </button>
                            @endif
                            @error('phone_numbers.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Google Maps Embed URL</label>
                            <input type="url" wire:model="google_maps_embed_url" placeholder="https://..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('google_maps_embed_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
