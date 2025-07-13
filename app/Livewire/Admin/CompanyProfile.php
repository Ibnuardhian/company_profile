<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CompanyProfile as CompanyProfileModel;

class CompanyProfile extends Component
{
    public $companyProfile;
    public $showEditForm = false;
    
    public $name;
    public $description;
    public $vision;
    public $mission;
    public $primary_color;

    public function mount()
    {
        $this->companyProfile = CompanyProfileModel::first();
        
        if ($this->companyProfile) {
            $this->name = $this->companyProfile->name;
            $this->description = $this->companyProfile->description;
            $this->vision = $this->companyProfile->vision;
            $this->mission = $this->companyProfile->mission;
            $this->primary_color = $this->companyProfile->primary_color;
        }
    }

    public function toggleEditForm()
    {
        $this->showEditForm = !$this->showEditForm;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'primary_color' => 'nullable|string',
        ]);

        if ($this->companyProfile) {
            $this->companyProfile->update([
                'name' => $this->name,
                'description' => $this->description,
                'vision' => $this->vision,
                'mission' => $this->mission,
                'primary_color' => $this->primary_color,
            ]);
        } else {
            $this->companyProfile = CompanyProfileModel::create([
                'name' => $this->name,
                'description' => $this->description,
                'vision' => $this->vision,
                'mission' => $this->mission,
                'primary_color' => $this->primary_color,
            ]);
        }

        $this->showEditForm = false;
        session()->flash('message', 'Company profile updated successfully!');
    }

    public function cancel()
    {
        $this->showEditForm = false;
        if ($this->companyProfile) {
            $this->name = $this->companyProfile->name;
            $this->description = $this->companyProfile->description;
            $this->vision = $this->companyProfile->vision;
            $this->mission = $this->companyProfile->mission;
            $this->primary_color = $this->companyProfile->primary_color;
        }
    }

    public function render()
    {
        return view('livewire.admin.company-profile')
            ->layout('layouts.admin');
    }
}
