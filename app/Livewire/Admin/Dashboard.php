<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        // Check permission saat component dimount
        $this->authorize('view dashboard');
    }

    protected function recentUsers()
    {
        return \App\Models\User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'superadmin');
        })
        ->latest()
        ->take(5)
        ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'recentUsers' => $this->recentUsers()
        ])->layout('layouts.admin');
    }
}
