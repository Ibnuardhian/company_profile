<?php

namespace App\Livewire;

use Livewire\Component;

class Gallery extends Component
{
    public $images = [];

    public function mount()
    {
        $this->images = [
            asset('images/meeting.jpg'),
            asset('images/foto-fadhlan.jpg'),
            asset('images/default-no-image.png'),
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg',
        ];
    }

    public function render()
    {
        return view('livewire.guest.gallery', [
            'images' => $this->images,
        ])->layout('layouts.app');
    }
}
