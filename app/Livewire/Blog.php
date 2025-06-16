<?php

namespace App\Livewire;

use Livewire\Component;

class Blog extends Component
{
    public $blogs = [
        [
            'title' => 'Tips Liburan Hemat',
            'slug' => 'tips-liburan-hemat',
            'desc' => 'Liburan tidak harus mahal. Berikut beberapa tips agar liburan Anda tetap hemat namun menyenangkan.',
            'image' => 'images/armada.jpg',
        ],
        [
            'title' => 'Destinasi Wisata Favorit 2025',
            'slug' => 'destinasi-wisata-favorit-2025',
            'desc' => 'Simak destinasi wisata yang paling banyak dikunjungi tahun 2025.',
            'image' => 'images/meeting.jpg',
        ],
        [
            'title' => 'Cara Memilih Armada yang Tepat',
            'slug' => 'cara-memilih-armada-yang-tepat',
            'desc' => 'Memilih armada yang tepat sangat penting untuk kenyamanan perjalanan Anda.',
            'image' => 'images/foto-fadhlan.jpg',
        ],
    ];

    public function render()
    {
        return view('livewire.blog', [
            'blogs' => $this->blogs
        ])->layout('layouts.app');
    }
}
