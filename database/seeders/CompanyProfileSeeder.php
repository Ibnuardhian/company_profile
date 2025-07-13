<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyProfile::create([
            'name' => 'PT TRANSMANIA',
            'description' => 'Perusahaan transportasi terpercaya yang melayani berbagai kebutuhan perjalanan Anda.',
            'vision' => 'Menjadi perusahaan transportasi terdepan di Indonesia yang memberikan layanan terbaik.',
            'mission' => 'Mengembangkan layanan transportasi berkualitas tinggi, memberikan pelayanan terbaik kepada pelanggan, dan berkontribusi pada kemajuan transportasi Indonesia.',
            'primary_color' => '#FF0000',
            'address' => 'Jalan Lorem Ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'pool_address' => 'Jalan Pool Lorem Ipsum, Depok, Jawa Barat, Indonesia',
            'google_maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4703.10554011983!2d106.83971377573359!3d-6.412367362713644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb001230284f%3A0xf4ea649da2603a61!2srumah%20nenek%20Am!5e1!3m2!1sid!2sid!4v1750077484161!5m2!1sid!2sid',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
