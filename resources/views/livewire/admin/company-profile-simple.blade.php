<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Company Profile Management</h1>
        </div>
        
        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Company Name Section -->
        <div class="max-w-md">
            <h2 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Company Information</h2>
            
            <div class="space-y-4">
                <!-- Company Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">Company Name</label>
                    <input type="text" 
                           wire:model="name" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Enter company name">
                    @error('name') 
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Save Button -->
                <div class="flex justify-start">
                    <button wire:click="save()" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200 ease-in-out transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
