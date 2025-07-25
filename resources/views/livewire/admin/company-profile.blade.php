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

        <!-- Company Profile Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Information - Directly Editable -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Company Information</h2>

                    <!-- Logo Upload Section -->
                    <div class="flex items-start space-x-6">
                        <div class="flex flex-col items-center space-y-3">
                            <div
                                class="relative w-32 h-32 border-2 border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                                <!-- Show temporary preview if uploading -->
                                @if($logo_upload)
                                    <img src="{{ $logo_upload->temporaryUrl() }}" alt="Preview"
                                        class="w-full h-full object-cover rounded-lg">
                                @elseif($companyProfile && $companyProfile->logo_path)
                                    <img src="{{ asset('storage/' . $companyProfile->logo_path) }}" alt="Company Logo"
                                        class="w-full h-full object-cover rounded-lg"
                                        onerror="this.src='{{ asset('images/default-no-image.png') }}'">
                                @else
                                    <img src="{{ asset('images/default-no-image.png') }}" alt="No Logo"
                                        class="w-full h-full object-cover rounded-lg opacity-50">
                                @endif

                                <!-- Loading overlay -->
                                <div wire:loading wire:target="logo_upload"
                                    class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                                    <div class="text-white text-xs">Processing...</div>
                                </div>
                            </div>
                            <div class="w-36">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="logo_input">Upload file</label>
                                <input wire:model="logo_upload"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 {{ !canAccess('manage company profile') ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    id="logo_input" type="file" accept="image/*"
                                    {{ !canAccess('manage company profile') ? 'disabled' : '' }}>
                                @if($errors->has('logo_upload')) <span
                                class="text-red-500 text-xs">{{ $errors->first('logo_upload') }}</span> @endif

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
                                <input type="text" wire:model="name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ !canAccess('manage company profile') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                    placeholder="Enter company name"
                                    {{ !canAccess('manage company profile') ? 'readonly' : '' }}>
                                @if($errors->has('name')) <span
                                class="text-red-500 text-xs">{{ $errors->first('name') }}</span> @endif
                            </div>

                            <!-- Description -->
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Deskripsi</label>
                                <textarea wire:model="description" placeholder="Type your message here."
                                    class="flex w-full h-auto min-h-[80px] px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 resize-none {{ !canAccess('manage company profile') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                    {{ !canAccess('manage company profile') ? 'disabled' : '' }}></textarea>
                                @if($errors->has('description')) <span
                                class="text-red-500 text-xs">{{ $errors->first('description') }}</span> @endif
                            </div>
                        </div>
                    </div>

                    <!-- Visi and Misi in a row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Visi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Visi</label>
                            <textarea wire:model="vision" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none {{ !canAccess('manage company profile') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                placeholder="Enter company vision"
                                {{ !canAccess('manage company profile') ? 'readonly' : '' }}></textarea>
                            @if($errors->has('vision')) <span
                            class="text-red-500 text-xs">{{ $errors->first('vision') }}</span> @endif
                        </div>

                        <!-- Misi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Misi</label>
                            <textarea wire:model="mission" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none {{ !canAccess('manage company profile') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                placeholder="Enter company mission"
                                {{ !canAccess('manage company profile') ? 'readonly' : '' }}></textarea>
                            @if($errors->has('mission')) <span
                            class="text-red-500 text-xs">{{ $errors->first('mission') }}</span> @endif
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Address Information</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Address</label>
                        <textarea wire:model="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                            placeholder="Enter company address"
                            {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'readonly' : '' }}></textarea>
                        @if($errors->has('address')) <span
                        class="text-red-500 text-xs">{{ $errors->first('address') }}</span> @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Pool Address</label>
                        <textarea wire:model="pool_address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                            placeholder="Enter pool address"
                            {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'readonly' : '' }}></textarea>
                        @if($errors->has('pool_address')) <span
                        class="text-red-500 text-xs">{{ $errors->first('pool_address') }}</span> @endif
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                        <div>
                            @if(!empty($companyProfile) && !empty($companyProfile->google_maps_embed_url))
                                <iframe src="{{ $companyProfile->google_maps_embed_url }}" width="100%" height="100"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            @endif
                            <label class="block text-sm font-medium text-gray-600 mt-3 mb-1">Google Maps URL</label>
                            <input type="url" wire:model="google_maps_embed_url"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                placeholder="Enter Google Maps embed URL"
                                {{ (!canAccess('manage company profile') && !canAccess('edit company address')) ? 'readonly' : '' }}>
                            @if($errors->has('google_maps_embed_url')) <span
                            class="text-red-500 text-xs">{{ $errors->first('google_maps_embed_url') }}</span> @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                @if(canAccess('manage company profile') || canAccess('edit company address'))
                    <button wire:click="saveWithMessage()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                @else
                    <button disabled
                        class="bg-gray-400 cursor-not-allowed text-white font-bold py-2 px-6 rounded-lg opacity-50">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                @endif
            </div>

            <!-- Contact Informations-->
            @if($companyProfile && $companyProfile->contacts && count($companyProfile->contacts) > 0)
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Contact Informations</h2>
                        @if(canAccess('manage company profile') || canAccess('edit contact info'))
                            <button wire:click="toggleContactForm"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Add Contact
                            </button>
                        @else
                            <button disabled
                                class="bg-gray-400 cursor-not-allowed text-white font-bold py-2 px-4 rounded text-sm opacity-50">
                                Add Contact
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($companyProfile->contacts as $contact)
                            <div class="bg-gray-50 p-4 rounded-lg border {{ $contact->is_active ? '' : 'opacity-50' }}">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="font-semibold text-gray-800">{{ $contact->label }}</h3>
                                        <span
                                            class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded uppercase">{{ $contact->type }}</span>
                                        @if($contact->is_primary)
                                            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded ml-1">Primary</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        @if(canAccess('manage company profile') || canAccess('edit contact info'))
                                            <button wire:click="editContact({{ $contact->id }})"
                                                class="text-blue-600 hover:text-blue-800 text-xs p-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button wire:click="deleteContact({{ $contact->id }})"
                                                class="text-red-600 hover:text-red-800 text-xs p-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            <button disabled
                                                class="text-gray-400 cursor-not-allowed text-xs p-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button disabled
                                                class="text-gray-400 cursor-not-allowed text-xs p-1">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
                                        <div class="flex items-center">
                                            @if(canAccess('manage company profile') || canAccess('edit contact info'))
                                                <button type="button"
                                                    wire:click="toggleContactStatus({{ $contact->id }})"
                                                    class="relative inline-flex h-4 w-7 focus:outline-none rounded-full transition-colors duration-200 {{ $contact->is_active ? 'bg-green-500' : 'bg-gray-300' }}">
                                                    <span class="w-4 h-4 duration-200 ease-in-out bg-white rounded-full shadow-sm transform transition-transform {{ $contact->is_active ? 'translate-x-3' : 'translate-x-0' }}"></span>
                                                </button>
                                            @else
                                                <div class="relative inline-flex h-4 w-7 rounded-full opacity-50 cursor-not-allowed {{ $contact->is_active ? 'bg-green-500' : 'bg-gray-300' }}">
                                                    <span class="w-4 h-4 duration-200 ease-in-out bg-white rounded-full shadow-sm transform transition-transform {{ $contact->is_active ? 'translate-x-3' : 'translate-x-0' }}"></span>
                                                </div>
                                            @endif
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
                        @if(canAccess('manage company profile') || canAccess('edit contact info'))
                            <button wire:click="toggleContactForm"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-sm">
                                Add Contact
                            </button>
                        @else
                            <button disabled
                                class="bg-gray-400 cursor-not-allowed text-white font-bold py-2 px-4 rounded text-sm opacity-50">
                                Add Contact
                            </button>
                        @endif
                    </div>
                    <p class="text-gray-500 italic">No Contact Informations added yet.</p>
                </div>
            @endif

            <!-- Contact Form Modal -->
            @if($showContactForm && (canAccess('manage company profile') || canAccess('edit contact info')))
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
                                        <select wire:model="contactType"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            <option value="phone">Phone</option>
                                            <option value="email">Email</option>
                                            <option value="whatsapp">WhatsApp</option>
                                            <option value="website">Website</option>
                                            <option value="address">Address</option>
                                            <option value="social">Social Media</option>
                                        </select>
                                        @if($errors->has('contactType')) <span
                                        class="text-red-500 text-sm">{{ $errors->first('contactType') }}</span> @endif
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Label</label>
                                        <input type="text" wire:model="contactLabel"
                                            placeholder="e.g., Customer Service, Support, etc."
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @if($errors->has('contactLabel')) <span
                                        class="text-red-500 text-sm">{{ $errors->first('contactLabel') }}</span> @endif
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-600">Value</label>
                                        <input type="text" wire:model="contactValue"
                                            placeholder="Contact value (phone, email, URL, etc.)"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        @if($errors->has('contactValue')) <span
                                        class="text-red-500 text-sm">{{ $errors->first('contactValue') }}</span> @endif
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="contactIsPrimary" id="contactIsPrimary"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <label for="contactIsPrimary" class="ml-2 block text-sm text-gray-600">Set as primary
                                            contact for this type</label>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-2 mt-6">
                                    <button type="button" wire:click="toggleContactForm"
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        {{ $editingContactId ? 'Update' : 'Save' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
    </div>
</div>