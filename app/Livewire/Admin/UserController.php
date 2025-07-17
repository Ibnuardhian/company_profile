<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        // Check permission saat component dimount
        if (!auth()->user()->can('manage users')) {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        // Method untuk menampilkan daftar users
        return view('admin.users');
    }

    public function render()
    {
        return view('livewire.admin.user-controller')
        ->layout('layouts.admin');
    }
}
