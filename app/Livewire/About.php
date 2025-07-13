<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CompanyProfile;

class About extends Component
{
    public $showAll = true;
    public $companyName;
    public $companyDescription;
    public $companyVision;
    public $companyMission;

    public function mount(): void
    {
        $profile = CompanyProfile::first();

        $this->companyName = $profile->name ?? 'Data belum diisi';
        $this->companyDescription = $profile->description ?? 'Data belum diisi';
        $this->companyVision = $profile->vision ?? 'Data belum diisi';
        $this->companyMission = $profile->mission ?? 'Data belum diisi';
    }

    public function render()
    {
        return view('about')->layout('layouts.app');
    }
}
