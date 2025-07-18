<div>
    @if(session('original_admin_id'))
        <div class="bg-yellow-100 border-b border-yellow-200 px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-user-secret text-yellow-600 mr-2"></i>
                    <span class="text-sm font-medium text-yellow-800">
                        You are currently logged in as: <strong>{{ Auth::user()->name }}</strong>
                    </span>
                </div>
                <button wire:click="switchBack" 
                        wire:loading.attr="disabled"
                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-yellow-800 bg-yellow-200 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors disabled:opacity-50">
                    <span wire:loading.remove>
                        <i class="fas fa-arrow-left mr-1"></i>
                        Switch Back to Admin
                    </span>
                    <span wire:loading class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-3 w-3 text-yellow-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Switching...
                    </span>
                </button>
            </div>
        </div>
    @endif
</div>
