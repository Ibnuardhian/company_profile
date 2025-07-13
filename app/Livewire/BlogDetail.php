<?php

namespace App\Livewire;

use Livewire\Component;

class BlogDetail extends Component
{
    public $slug;
    public $blog;

    public function mount($slug)
    {
        // Dummy data, should match with Blog.php
        $blogs = [
            [
                'title' => 'Tips Liburan Hemat',
                'slug' => 'tips-liburan-hemat',
                'desc' => 'Liburan tidak harus mahal. Berikut beberapa tips agar liburan Anda tetap hemat namun menyenangkan.',
                'image' => 'images/armada.jpg',
                'content' => 'Liburan tidak harus mahal. Berikut beberapa tips agar liburan Anda tetap hemat namun menyenangkan. 1. Rencanakan jauh hari. 2. Pilih destinasi lokal. 3. Manfaatkan promo. 4. Bawa bekal sendiri. 5. Gunakan transportasi umum.'
            ],
            [
                'title' => 'Destinasi Wisata Favorit 2025',
                'slug' => 'destinasi-wisata-favorit-2025',
                'desc' => 'Simak destinasi wisata yang paling banyak dikunjungi tahun 2025.',
                'image' => 'images/meeting.jpg',
                'content' => 'Simak destinasi wisata yang paling banyak dikunjungi tahun 2025. Bali, Yogyakarta, Lombok, dan Raja Ampat masih menjadi primadona wisatawan.'
            ],
            [
                'title' => 'Cara Memilih Armada yang Tepat',
                'slug' => 'cara-memilih-armada-yang-tepat',
                'desc' => 'Memilih armada yang tepat sangat penting untuk kenyamanan perjalanan Anda.',
                'image' => 'images/foto-fadhlan.jpg',
                'content' => 'Memilih armada yang tepat sangat penting untuk kenyamanan perjalanan Anda. Pastikan armada bersih, terawat, dan sesuai kebutuhan.'
            ],
        ];
        $this->blog = collect($blogs)->firstWhere('slug', $slug);
    }

    public function render()
    {
        return view('livewire.guest.blog-detail')->layout('layouts.app');
    }
}
