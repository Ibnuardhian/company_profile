<?php

namespace Database\Seeders;

use App\Models\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqCategorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'layanan umum',
                'sort_order' => 1,
            ],
            [
                'name' => 'harga & pembayaran',
                'sort_order' => 2,
            ],
            [
                'name' => 'pemesanan & booking',
                'sort_order' => 3,
            ],
            [
                'name' => 'kebijakan perusahaan',
                'sort_order' => 4,
            ],
            [
                'name' => 'teknis & operasional',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            FaqCategory::create($category);
        }
    }
}
