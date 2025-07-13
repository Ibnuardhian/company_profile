<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin');
    }
}
