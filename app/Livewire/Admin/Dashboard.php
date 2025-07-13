<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class dashboard extends Component
{
    use AuthorizesRequests;
    public function __construct()
    {
        // Menggunakan middleware permission
        $this->middleware('permission:view dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
        public function users()
    {
        // Check permission dalam method
        if (!auth()->user()->can('manage users')) {
            abort(403, 'Unauthorized');
        }

        return view('admin.users');
    }
}
