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
    public $showContactForm = false;

    protected $rules = [
        'name' => 'nullable|string|max:255',
        'logo_path' => 'nullable|string',
        'logo_upload' => 'nullable|image|max:2048',
        'description' => 'nullable|string',
        'vision' => 'nullable|string',
        'mission' => 'nullable|string',
        'address' => 'nullable|string',
        'pool_address' => 'nullable|string',
        'google_maps_embed_url' => 'nullable|url',
        'contactType' => 'required|string|in:phone,email,whatsapp,website,address,social',
        'contactLabel' => 'required|string|max:255',
        'contactValue' => 'required|string|max:500',
        'contactIsPrimary' => 'boolean',
    ];

    public $messages = [
        'name.string' => 'Nama perusahaan harus berupa teks.',
        'name.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',
        'logo_upload.image' => 'File yang diupload harus berupa gambar.',
        'logo_upload.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        'description.string' => 'Deskripsi harus berupa teks.',
        'vision.string' => 'Visi harus berupa teks.',
        'mission.string' => 'Misi harus berupa teks.',
        'address.string' => 'Alamat harus berupa teks.',
        'pool_address.string' => 'Alamat pool harus berupa teks.',
        'google_maps_embed_url.url' => 'Google Maps URL harus berupa URL yang valid.',
        'contactType.required' => 'Tipe kontak wajib dipilih.',
        'contactType.in' => 'Tipe kontak yang dipilih tidak valid.',
        'contactLabel.required' => 'Label kontak wajib diisi.',
        'contactLabel.string' => 'Label kontak harus berupa teks.',
        'contactLabel.max' => 'Label kontak tidak boleh lebih dari 255 karakter.',
        'contactValue.required' => 'Nilai kontak wajib diisi.',
        'contactValue.string' => 'Nilai kontak harus berupa teks.',
        'contactValue.max' => 'Nilai kontak tidak boleh lebih dari 500 karakter.',
        'contactIsPrimary.boolean' => 'Status primary harus berupa true atau false.',
    ];

    /**
     * Get custom validation messages
     */
    protected function messages()
    {
        return $this->messages;
    }
    
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
        // Check if user has permission to view/edit company profile or edit address or edit contact
        if (!auth()->user()->can('view company profile') && 
            !auth()->user()->can('manage company profile') && 
            !auth()->user()->can('edit company address') &&
            !auth()->user()->can('edit contact info')) {
            abort(403, 'Unauthorized. You do not have permission to access this page.');
        }

        $this->companyProfile = CompanyProfileModel::with(['contacts' => function($query) {
            $query->orderBy('type');
        }])->first();
        
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

    public function save()
    {
        // Check permissions first
        $canManageProfile = auth()->user()->can('manage company profile');
        $canEditAddress = auth()->user()->can('edit company address');
        
        if (!$canManageProfile && !$canEditAddress) {
            session()->flash('error', 'You do not have permission to save changes.');
            return;
        }

        // Validate only company profile fields (excluding contact fields)
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
        ], $this->messages);

        if (!$this->companyProfile) {
            // Create new company profile if it doesn't exist
            $data = [];
            
            // Only include fields based on permissions
            if ($canManageProfile) {
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
            } elseif ($canEditAddress) {
                $data = [
                    'name' => 'Company Name', // Default value
                    'address' => $this->address,
                    'pool_address' => $this->pool_address,
                ];
            }
            
            \Log::info('Creating new company profile', $data);
            $this->companyProfile = CompanyProfileModel::create($data);
            \Log::info('Company profile created with ID: ' . $this->companyProfile->id);
        } else {
            // Only update fields that have changed and user has permission for
            $dataToUpdate = [];
            
            if ($canManageProfile) {
                // User can edit all fields
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
                if ($this->google_maps_embed_url !== $this->companyProfile->google_maps_embed_url) {
                    $dataToUpdate['google_maps_embed_url'] = $this->google_maps_embed_url;
                }
            }
            
            // Both permissions can edit address fields
            if ($canManageProfile || $canEditAddress) {
                if ($this->address !== $this->companyProfile->address) {
                    $dataToUpdate['address'] = $this->address;
                }
                if ($this->pool_address !== $this->companyProfile->pool_address) {
                    $dataToUpdate['pool_address'] = $this->pool_address;
                }
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

        // No auto-save message for manual save
    }

    public function saveWithMessage()
    {
        try {
            $this->save();
            session()->flash('message', 'Company profile updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exception to show errors
            throw $e;
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
        // Check if user has permission to manage company profile or edit contact info
        if (!auth()->user()->can('manage company profile') && !auth()->user()->can('edit contact info')) {
            session()->flash('error', 'You do not have permission to save contacts.');
            return;
        }

        $contactRules = [
            'contactType' => $this->rules['contactType'],
            'contactLabel' => $this->rules['contactLabel'],
            'contactValue' => $this->rules['contactValue'],
            'contactIsPrimary' => $this->rules['contactIsPrimary'],
        ];

        $this->validate($contactRules, $this->messages);

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
        // Check if user has permission to manage company profile or edit contact info
        if (!auth()->user()->can('manage company profile') && !auth()->user()->can('edit contact info')) {
            session()->flash('error', 'You do not have permission to edit contacts.');
            return;
        }

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
        // Check if user has permission to manage company profile or edit contact info
        if (!auth()->user()->can('manage company profile') && !auth()->user()->can('edit contact info')) {
            session()->flash('error', 'You do not have permission to delete contacts.');
            return;
        }

        $contact = Contact::find($contactId);
        if ($contact && $contact->company_profile_id == $this->companyProfile->id) {
            $contact->delete();
            session()->flash('message', 'Contact deleted successfully!');
        }
    }

    public function toggleContactStatus($contactId)
    {
        // Check if user has permission to manage company profile or edit contact info
        if (!auth()->user()->can('manage company profile') && !auth()->user()->can('edit contact info')) {
            session()->flash('error', 'You do not have permission to toggle contact status.');
            return;
        }

        $contact = Contact::find($contactId);
        if ($contact && $contact->company_profile_id == $this->companyProfile->id) {
            $contact->update(['is_active' => !$contact->is_active]);
            
            // Refresh the company profile with contacts to get updated data
            $this->companyProfile = $this->companyProfile->fresh(['contacts' => function($query) {
                $query->orderBy('type');
            }]);
            
            session()->flash('message', 'Contact status updated!');
        }
    }

    public function updatedLogoUpload()
    {
        $this->validate([
            'logo_upload' => $this->rules['logo_upload'], // Max 2MB
        ], $this->messages);

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
            $this->companyProfile = CompanyProfileModel::with(['contacts' => function($query) {
                $query->orderBy('type');
            }])->first();
            
            // Reset the upload property
            $this->logo_upload = null;
            
            session()->flash('message', 'Logo uploaded successfully!');
        }
    }

    public function render()
    {
        // Refresh company profile with contacts
        if ($this->companyProfile) {
            $this->companyProfile->load(['contacts' => function($query) {
                $query->orderBy('type');
            }]);
        }
        
        return view('livewire.admin.company-profile')
            ->layout('layouts.admin');
    }
}
