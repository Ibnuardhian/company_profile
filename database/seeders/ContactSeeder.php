<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\CompanyProfile;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the company profile
        $companyProfile = CompanyProfile::first();
        
        if (!$companyProfile) {
            $this->command->error('Company profile not found. Please run CompanyProfileSeeder first.');
            return;
        }

        // Email contacts
        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'email',
            'label' => 'Email Utama',
            'value' => 'lajootrans@gmail.com',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'email',
            'label' => 'Email Customer Service',
            'value' => 'cs@lajootrans.com',
            'is_primary' => false,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Phone contacts
        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'phone',
            'label' => 'Telepon Kantor',
            'value' => '08xx-xxxx-xxxx',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'whatsapp',
            'label' => 'WhatsApp Customer Service',
            'value' => '08yy-yyyy-yyyy',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'phone',
            'label' => 'Telepon Pool',
            'value' => '08zz-zzzz-zzzz',
            'is_primary' => false,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        // Social media contacts
        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'facebook',
            'label' => 'Facebook',
            'value' => 'https://facebook.com/lajootrans',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'instagram',
            'label' => 'Instagram',
            'value' => 'https://instagram.com/lajootrans',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 2,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'youtube',
            'label' => 'YouTube',
            'value' => 'https://youtube.com/@lajootrans',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 3,
        ]);

        Contact::create([
            'company_profile_id' => $companyProfile->id,
            'type' => 'website',
            'label' => 'Website Resmi',
            'value' => 'https://www.lajootrans.com',
            'is_primary' => true,
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
