<div>
    @if(isset($error))
        <div class="text-red-500 text-sm">{{ $error }}</div>
    @else
        <button class="text-primary-600 hover:text-primary-700 font-semibold w-8 hover:scale-125 transition ease-in-out"
            wire:click="$set('isOpen', true)">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
                class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
        </button>

        @if ($isOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 relative max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-800">User Details</h2>
                        <button class="text-gray-400 hover:text-gray-600 transition-colors text-2xl w-8 h-8 flex items-center justify-center"
                            wire:click="$set('isOpen', false)">
                            &times;
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="p-6 space-y-6">
                        <!-- User Information Section -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">User Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">ID</label>
                                    <p class="text-sm text-gray-800 bg-white px-3 py-2 rounded border">{{ $user->id ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                                    <p class="text-sm text-gray-800 bg-white px-3 py-2 rounded border">{{ $user->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                    <p class="text-sm text-gray-800 bg-white px-3 py-2 rounded border">{{ $user->email ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Joined Date</label>
                                    <p class="text-sm text-gray-800 bg-white px-3 py-2 rounded border">{{ $createdAt ?? 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <!-- Roles Section -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-600 mb-2">Roles</label>
                                <div class="flex flex-wrap gap-2">
                                    @if($user && $user->roles && $user->roles->isNotEmpty())
                                        @foreach($user->roles as $role)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            No roles assigned
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Reset Password Section -->
                        <div class="bg-red-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-red-800 mb-4">Reset Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-red-700 mb-2">New Password</label>
                                    <input id="newPassword" 
                                           type="password" 
                                           wire:model="newPassword" 
                                           placeholder="Enter new password (min. 6 characters)"
                                           autocomplete="new-password"
                                           class="w-full rounded-md border-red-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm px-3 py-2">
                                    @if ($errors->has('newPassword'))
                                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('newPassword') }}</p>
                                    @endif
                                </div>
                                <button wire:click="resetPassword"
                                        wire:loading.attr="disabled"
                                        wire:target="resetPassword"
                                        class="w-full bg-red-600 hover:bg-red-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    <span wire:loading.remove wire:target="resetPassword">Reset Password</span>
                                    <span wire:loading wire:target="resetPassword" class="flex items-center justify-center">
                                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Resetting...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 p-6 border-t border-gray-200 bg-gray-50">
                        <button wire:click="$toggle('isOpen')" 
                                wire:loading.attr="disabled"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 disabled:opacity-50">
                            Close
                        </button>
                        @if($canLoginAs)
                        <button wire:click="loginAs"
                                wire:loading.attr="disabled"
                                wire:target="loginAs"
                                class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="loginAs">Login As User</span>
                            <span wire:loading wire:target="loginAs" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Logging in...
                            </span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
