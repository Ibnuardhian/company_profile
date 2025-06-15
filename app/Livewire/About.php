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
                'image' => 'images/meeting.jpg',
            ],
            [
                'title' => 'Visi',
                'slug' => 'visi',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse potenti. Etiam euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque.',
                'image' => 'images/meeting.jpg',
            ],
            [
                'title' => 'Misi',
                'slug' => 'misi',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse potenti. Etiam euismod, urna eu tincidunt consectetur, nisi nisl aliquam nunc, eget aliquam massa nisl quis neque.',
                'image' => 'images/meeting.jpg',
            ],
        ];
        // Kirim seluruh aboutList ke view
        return view('about', [
            'aboutList' => $aboutList,
            'showAll' => true
        ])->layout('layouts.app');
    }
}
