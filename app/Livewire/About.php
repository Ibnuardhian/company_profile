<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public $showAll = false;

    public function render()
    {
        $aboutList = [
            [
                'title' => 'Lajoo trans Home',
                'slug' => 'about-us',
                'description' => 'Deskripsi singkat tentang Lajoo trans1.',
            ],
            [
                'title' => 'Visi',
                'slug' => 'visi',
                'description' => 'Deskripsi singkat tentang visi',
            ],
            [
                'title' => 'Misi',
                'slug' => 'misi',
                'description' => 'Deskripsi singkat tentang misi',
            ],
        ];
        // Kirim seluruh aboutList ke view
        return view('about', [
            'aboutList' => $aboutList,
            'showAll' => true
        ])->layout('layouts.app');
    }
}
