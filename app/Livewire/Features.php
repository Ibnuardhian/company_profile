<?php

namespace App\Livewire;

use Livewire\Component;

class Features extends Component
{
    public $features = [
        [
            'src' => 'images/meeting.jpg',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 1',
            'title' => 'LAJOO TRANS1',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dapibus.'
        ],
        [
            'src' => '/images/default-no-image.png',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 2',
            'title' => 'LAJOO TRANS2',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dapibus.'
        ],
        [
            'src' => 'images/meeting.jpg',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 3',
            'title' => 'LAJOO TRANS3',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dapibus.'
        ],
        [
            'src' => '/images/default-no-image.png',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 4',
            'title' => 'LAJOO TRANS4',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dapibus.'
        ],
    ];

    public function render()
    {
        return view('livewire.features', [
            'features' => $this->features
        ]);
    }
}
