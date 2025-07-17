<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CompanyProfile as CompanyProfileModel;
use App\Models\Contact;

class CompanyProfile extends Component
{
    public $slideOverOpen = false;
    use WithFileUploads;
    public $companyProfile;
    public $showEditForm = false;
    public $showContactForm = false;
    
    public $name;
    public $logo_path;
    public $logo_upload; // For handling file uploads
    public $description;
    public $vision;
    public $mission;
    public $address;
    public $pool_address;
    public $google_maps_embed_url;

    // Contact properties
    public $contactType = 'phone';
    public $contactLabel = '';
    public $contactValue = '';
    public $contactIsPrimary = false;
    public $editingContactId = null;

    public function mount()
    {
        $this->companyProfile = CompanyProfileModel::with('contacts')->first();
        
        if ($this->companyProfile) {
            $this->name = $this->companyProfile->name;
            $this->logo_path = $this->companyProfile->logo_path;
            $this->description = $this->companyProfile->description;
            $this->vision = $this->companyProfile->vision;
            $this->mission = $this->companyProfile->mission;
            $this->address = $this->companyProfile->address;
            $this->pool_address = $this->companyProfile->pool_address;
            $this->google_maps_embed_url = $this->companyProfile->google_maps_embed_url;
        }
    }

    public function toggleEditForm()
    {
        $this->showEditForm = !$this->showEditForm;
    }

    public function save()
    {
        // Add logging
        \Log::info('Save method called', [
            'name' => $this->name,
            'description' => $this->description,
            'has_company_profile' => !is_null($this->companyProfile)
        ]);

        // For auto-save, we'll use more lenient validation
        $this->validate([
            'name' => 'nullable|string|max:255',
            'logo_path' => 'nullable|string',
            'logo_upload' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'address' => 'nullable|string',
            'pool_address' => 'nullable|string',
            'google_maps_embed_url' => 'nullable|url',
        ]);

        if (!$this->companyProfile) {
            // Create new company profile if it doesn't exist
            $data = [
                'name' => $this->name,
                'logo_path' => $this->logo_path,
                'description' => $this->description,
                'vision' => $this->vision,
                'mission' => $this->mission,
                'address' => $this->address,
                'pool_address' => $this->pool_address,
                'google_maps_embed_url' => $this->google_maps_embed_url,
            ];
            
            \Log::info('Creating new company profile', $data);
            $this->companyProfile = CompanyProfileModel::create($data);
            \Log::info('Company profile created with ID: ' . $this->companyProfile->id);
        } else {
            // Only update fields that have changed
            $dataToUpdate = [];
            
            if ($this->name !== $this->companyProfile->name) {
                $dataToUpdate['name'] = $this->name;
            }
            if ($this->logo_path !== $this->companyProfile->logo_path) {
                $dataToUpdate['logo_path'] = $this->logo_path;
            }
            if ($this->description !== $this->companyProfile->description) {
                $dataToUpdate['description'] = $this->description;
            }
            if ($this->vision !== $this->companyProfile->vision) {
                $dataToUpdate['vision'] = $this->vision;
            }
            if ($this->mission !== $this->companyProfile->mission) {
                $dataToUpdate['mission'] = $this->mission;
            }
            if ($this->address !== $this->companyProfile->address) {
                $dataToUpdate['address'] = $this->address;
            }
            if ($this->pool_address !== $this->companyProfile->pool_address) {
                $dataToUpdate['pool_address'] = $this->pool_address;
            }
            if ($this->google_maps_embed_url !== $this->companyProfile->google_maps_embed_url) {
                $dataToUpdate['google_maps_embed_url'] = $this->google_maps_embed_url;
            }

            \Log::info('Fields to update', $dataToUpdate);

            // Only run update if there are changes
            if (!empty($dataToUpdate)) {
                $this->companyProfile->update($dataToUpdate);
                \Log::info('Company profile updated successfully');
                // Refresh the model with fresh data from database
                $this->companyProfile->refresh();
            } else {
                \Log::info('No changes detected, skipping update');
            }
        }

        // Don't close edit form or show flash message for auto-save
        // Only show message when explicitly saving (can be handled separately)
    }

    public function saveWithMessage()
    {
        $this->save();
        $this->showEditForm = false;
        session()->flash('message', 'Company profile updated successfully!');
    }

    public function cancel()
    {
        $this->showEditForm = false;
        if ($this->companyProfile) {
            $this->name = $this->companyProfile->name;
            $this->logo_path = $this->companyProfile->logo_path;
            $this->description = $this->companyProfile->description;
            $this->vision = $this->companyProfile->vision;
            $this->mission = $this->companyProfile->mission;
            $this->address = $this->companyProfile->address;
            $this->pool_address = $this->companyProfile->pool_address;
            $this->google_maps_embed_url = $this->companyProfile->google_maps_embed_url;
        }
    }

    // Contact Management Methods
    public function toggleContactForm()
    {
        $this->showContactForm = !$this->showContactForm;
        $this->resetContactForm();
    }

    public function resetContactForm()
    {
        $this->contactType = 'phone';
        $this->contactLabel = '';
        $this->contactValue = '';
        $this->contactIsPrimary = false;
        $this->editingContactId = null;
    }

    public function saveContact()
    {
        $this->validate([
            'contactType' => 'required|string|in:phone,email,whatsapp,website,address,social',
            'contactLabel' => 'required|string|max:255',
            'contactValue' => 'required|string|max:500',
            'contactIsPrimary' => 'boolean',
        ]);

        // Ensure we have a company profile
        if (!$this->companyProfile) {
            session()->flash('error', 'Please save company profile first before adding contacts.');
            return;
        }

        // If setting as primary, remove primary from other contacts of same type
        if ($this->contactIsPrimary) {
            Contact::where('company_profile_id', $this->companyProfile->id)
                ->where('type', $this->contactType)
                ->where('id', '!=', $this->editingContactId)
                ->update(['is_primary' => false]);
        }

        $contactData = [
            'company_profile_id' => $this->companyProfile->id,
            'type' => $this->contactType,
            'label' => $this->contactLabel,
            'value' => $this->contactValue,
            'is_primary' => $this->contactIsPrimary,
            'is_active' => true,
            'sort_order' => Contact::where('company_profile_id', $this->companyProfile->id)->max('sort_order') + 1,
        ];

        if ($this->editingContactId) {
            Contact::where('id', $this->editingContactId)->update($contactData);
            session()->flash('message', 'Contact updated successfully!');
        } else {
            Contact::create($contactData);
            session()->flash('message', 'Contact added successfully!');
        }

        $this->showContactForm = false;
        $this->resetContactForm();
    }

    public function editContact($contactId)
    {
        $contact = Contact::find($contactId);
        if ($contact && $contact->company_profile_id == $this->companyProfile->id) {
            $this->editingContactId = $contact->id;
            $this->contactType = $contact->type;
            $this->contactLabel = $contact->label;
            $this->contactValue = $contact->value;
            $this->contactIsPrimary = $contact->is_primary;
            $this->showContactForm = true;
        }
    }

    public function deleteContact($contactId)
    {
        $contact = Contact::find($contactId);
        if ($contact && $contact->company_profile_id == $this->companyProfile->id) {
            $contact->delete();
            session()->flash('message', 'Contact deleted successfully!');
        }
    }

    public function toggleContactStatus($contactId)
    {
        $contact = Contact::find($contactId);
        if ($contact && $contact->company_profile_id == $this->companyProfile->id) {
            $contact->update(['is_active' => !$contact->is_active]);
            session()->flash('message', 'Contact status updated!');
        }
    }

    public function updatedLogoUpload()
    {
        $this->validate([
            'logo_upload' => 'image|max:2048', // Max 2MB
        ]);

        // Store the uploaded file
        if ($this->logo_upload) {
            // Delete old logo if exists
            if ($this->logo_path) {
                $oldLogoPath = public_path('storage/' . $this->logo_path);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            // Store new logo
            $path = $this->logo_upload->store('logos', 'public');
            $this->logo_path = $path;
            
            // Save immediately after upload
            $this->save();
            
            // Refresh the company profile object to get the updated data
            $this->companyProfile = CompanyProfileModel::with('contacts')->first();
            
            // Reset the upload property
            $this->logo_upload = null;
            
            session()->flash('message', 'Logo uploaded successfully!');
        }
    }

    public function render()
    {
        // Refresh company profile with contacts
        if ($this->companyProfile) {
            $this->companyProfile->load('contacts');
        }
        
        return view('livewire.admin.company-profile')
            ->layout('layouts.admin');
    }
}
