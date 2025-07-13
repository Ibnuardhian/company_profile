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
            'name' => 'PT. Teknologi Indonesia',
            'description' => 'Perusahaan teknologi terdepan yang menyediakan solusi inovatif untuk berbagai kebutuhan bisnis digital.',
            'vision' => 'Menjadi perusahaan teknologi terkemuka di Indonesia yang memberikan solusi terbaik untuk kemajuan digitalisasi.',
            'mission' => 'Mengembangkan teknologi berkualitas tinggi, memberikan pelayanan terbaik kepada klien, dan berkontribusi pada kemajuan teknologi Indonesia.',
            'primary_color' => '#3B82F6',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
