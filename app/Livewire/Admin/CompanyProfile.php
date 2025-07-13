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
    public $address;
    public $pool_address;
    public $phone_numbers = [];
    public $email;
    public $google_maps_embed_url;

    public function mount()
    {
        $this->companyProfile = CompanyProfileModel::first();
        
        if ($this->companyProfile) {
            $this->name = $this->companyProfile->name;
            $this->description = $this->companyProfile->description;
            $this->vision = $this->companyProfile->vision;
            $this->mission = $this->companyProfile->mission;
            $this->primary_color = $this->companyProfile->primary_color;
            $this->address = $this->companyProfile->address;
            $this->pool_address = $this->companyProfile->pool_address;
            $this->phone_numbers = $this->companyProfile->phone_numbers ?? [];
            $this->email = $this->companyProfile->email;
            $this->google_maps_embed_url = $this->companyProfile->google_maps_embed_url;
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
            'address' => 'nullable|string',
            'pool_address' => 'nullable|string',
            'phone_numbers' => 'nullable|array',
            'phone_numbers.*' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'google_maps_embed_url' => 'nullable|url',
        ]);

        // Filter out empty phone numbers
        $this->phone_numbers = array_filter($this->phone_numbers, function($phone) {
            return !empty(trim($phone));
        });

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'vision' => $this->vision,
            'mission' => $this->mission,
            'primary_color' => $this->primary_color,
            'address' => $this->address,
            'pool_address' => $this->pool_address,
            'phone_numbers' => array_values($this->phone_numbers), // Reindex array
            'email' => $this->email,
            'google_maps_embed_url' => $this->google_maps_embed_url,
        ];

        if ($this->companyProfile) {
            $this->companyProfile->update($data);
        } else {
            $this->companyProfile = CompanyProfileModel::create($data);
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
            $this->address = $this->companyProfile->address;
            $this->pool_address = $this->companyProfile->pool_address;
            $this->phone_numbers = $this->companyProfile->phone_numbers ?? [];
            $this->email = $this->companyProfile->email;
            $this->google_maps_embed_url = $this->companyProfile->google_maps_embed_url;
        }
    }

    public function addPhoneNumber()
    {
        $this->phone_numbers[] = '';
    }

    public function removePhoneNumber($index)
    {
        unset($this->phone_numbers[$index]);
        $this->phone_numbers = array_values($this->phone_numbers); // Reindex array
    }

    public function render()
    {
        return view('livewire.admin.company-profile')
            ->layout('layouts.admin');
    }
}
