@section('page-title', 'Dashboard')

@section('content')
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
            @if(!$showEditForm)
                <button wire:click="toggleEditForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit Profile
                </button>
            @else
                <div class="space-x-2">
                    <button wire:click="save" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Save
                    </button>
                    <button wire:click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                </div>
            @endif
        </div>
        
        @if(!$showEditForm)
            <!-- View Mode -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Company Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Company Information</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Company Name</label>
                        <p class="mt-1 text-gray-800">{{ $companyProfile->name ?? 'No company name set' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Description</label>
                        <p class="mt-1 text-gray-800">{{ $companyProfile->description ?? 'No description set' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Primary Color</label>
                        <div class="mt-1 flex items-center space-x-2">
                            <div class="w-8 h-8 rounded border" style="background-color: {{ $companyProfile->primary_color ?? '#3B82F6' }}"></div>
                            <span class="text-gray-800">{{ $companyProfile->primary_color ?? '#3B82F6' }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Additional Information</h2>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Created</label>
                        <p class="mt-1 text-gray-800">{{ $companyProfile->created_at ? $companyProfile->created_at->format('d M Y H:i') : 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Last Updated</label>
                        <p class="mt-1 text-gray-800">{{ $companyProfile->updated_at ? $companyProfile->updated_at->format('d M Y H:i') : 'N/A' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Logo</label>
                        <p class="mt-1 text-gray-800">{{ $companyProfile->logo_path ?? 'No logo uploaded' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Mission & Vision -->
            <div class="mt-8 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Mission</h2>
                    <p class="mt-3 text-gray-800">{{ $companyProfile->mission ?? 'No mission statement set' }}</p>
                </div>
                
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">Vision</h2>
                    <p class="mt-3 text-gray-800">{{ $companyProfile->vision ?? 'No vision statement set' }}</p>
                </div>
            </div>
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
            </form>
        @endif
    </div>
</div>
