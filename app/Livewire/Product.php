<?php

namespace App\Livewire;

use Livewire\Component;

class Product extends Component
{
    public function render()
    {
        $products = [
            [
                'src' => 'images/armada.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Armada',
                'title' => 'Jakarta - Bandung',
                'price' => 'Rp 500.000 - Rp 700.000'
            ],
            [
                'src' => 'images/meeting.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Meeting',
                'title' => 'Bandung - Yogyakarta',
                'price' => 'Rp 1.200.000 - Rp 1.500.000'
            ],
            [
                'src' => 'images/foto-fadhlan.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Fadhlan',
                'title' => 'Jakarta - Surabaya',
                'price' => 'Rp 1.800.000 - Rp 2.200.000'
            ],
            [
                'src' => 'images/armada.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Armada',
                'title' => 'Jakarta - Bandung',
                'price' => 'Rp 500.000 - Rp 700.000'
            ],
            [
                'src' => 'images/meeting.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Meeting',
                'title' => 'Bandung - Yogyakarta',
                'price' => 'Rp 1.200.000 - Rp 1.500.000'
            ],
            [
                'src' => 'images/foto-fadhlan.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Fadhlan',
                'title' => 'Jakarta - Surabaya',
                'price' => 'Rp 1.800.000 - Rp 2.200.000'
            ],
            [
                'src' => 'images/armada.jpg',
                'fallback' => 'images/default-no-image.png',
                'alt' => 'Armada',
                'title' => 'Jakarta - Bandung',
                'price' => 'Rp 500.000 - Rp 700.000'
            ],
        ];
        return view('livewire.product', compact('products'));
    }
}
