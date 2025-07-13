<?php

namespace App\Livewire;

use Livewire\Component;

class AboutHome extends Component
{
    public $companyName;
    public $companyDescription;
    public $companyImage;

    public function mount(): void
    {
        $profile = \App\Models\CompanyProfile::first();

        $this->companyName = $profile->name ?? 'Data belum diisi';
        $this->companyDescription = $profile->description ?? 'Data belum diisi';
        $this->companyImage = 'https://images.unsplash.com/photo-1629400919536-bc724a8792d4?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTU3fHx0cmF2ZWwlMjB3aXRoJTIwYnVzfGVufDB8MHwwfHx8MA%3D%3D';
    }

    public function render()
    {
        return view('livewire.guest.about-home')->layout('layouts.app');
    }
}
