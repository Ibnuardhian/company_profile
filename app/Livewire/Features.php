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
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ornare eros sit amet metus aliquet, quis finibus velit ultricies. Quisque mattis vel velit vel pretium. Suspendisse potenti. Mauris eleifend facilisis nulla, vitae pellentesque tortor dictum et. Duis venenatis nunc malesuada ante interdum tempor. Etiam posuere aliquet enim, lobortis ultrices lectus imperdiet quis. Sed congue lacus ac facilisis tempor. Cras efficitur dolor sit amet felis fringilla egestas. Aliquam eu risus velit. Suspendisse molestie mauris et velit euismod, blandit molestie lectus fermentum. Cras at justo id lorem rhoncus tristique. Sed posuere eros et ante pulvinar, nec finibus elit varius. In laoreet, odio faucibus bibendum luctus, magna velit auctor nisl, nec dictum nisi lorem vel diam. Vestibulum iaculis commodo elit vel mollis. Cras sit amet bibendum neque.'
        ],
        [
            'src' => '/images/default-no-image.png',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 2',
            'title' => 'LAJOO TRANS2',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ornare eros sit amet metus aliquet, quis finibus velit ultricies. Quisque mattis vel velit vel pretium. Suspendisse potenti. Mauris eleifend facilisis nulla, vitae pellentesque tortor dictum et. Duis venenatis nunc malesuada ante interdum tempor. Etiam posuere aliquet enim, lobortis ultrices lectus imperdiet quis. Sed congue lacus ac facilisis tempor. Cras efficitur dolor sit amet felis fringilla egestas. Aliquam eu risus velit. Suspendisse molestie mauris et velit euismod, blandit molestie lectus fermentum. Cras at justo id lorem rhoncus tristique. Sed posuere eros et ante pulvinar, nec finibus elit varius. In laoreet, odio faucibus bibendum luctus, magna velit auctor nisl, nec dictum nisi lorem vel diam. Vestibulum iaculis commodo elit vel mollis. Cras sit amet bibendum neque.'
        ],
        [
            'src' => 'images/meeting.jpg',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 3',
            'title' => 'LAJOO TRANS3',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ornare eros sit amet metus aliquet, quis finibus velit ultricies. Quisque mattis vel velit vel pretium. Suspendisse potenti. Mauris eleifend facilisis nulla, vitae pellentesque tortor dictum et. Duis venenatis nunc malesuada ante interdum tempor. Etiam posuere aliquet enim, lobortis ultrices lectus imperdiet quis. Sed congue lacus ac facilisis tempor. Cras efficitur dolor sit amet felis fringilla egestas. Aliquam eu risus velit. Suspendisse molestie mauris et velit euismod, blandit molestie lectus fermentum. Cras at justo id lorem rhoncus tristique. Sed posuere eros et ante pulvinar, nec finibus elit varius. In laoreet, odio faucibus bibendum luctus, magna velit auctor nisl, nec dictum nisi lorem vel diam. Vestibulum iaculis commodo elit vel mollis. Cras sit amet bibendum neque.'
        ],
        [
            'src' => '/images/default-no-image.png',
            'fallback' => '/images/default-no-image.png',
            'alt' => 'Foto 4',
            'title' => 'LAJOO TRANS4',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ornare eros sit amet metus aliquet, quis finibus velit ultricies. Quisque mattis vel velit vel pretium. Suspendisse potenti. Mauris eleifend facilisis nulla, vitae pellentesque tortor dictum et. Duis venenatis nunc malesuada ante interdum tempor. Etiam posuere aliquet enim, lobortis ultrices lectus imperdiet quis. Sed congue lacus ac facilisis tempor. Cras efficitur dolor sit amet felis fringilla egestas. Aliquam eu risus velit. Suspendisse molestie mauris et velit euismod, blandit molestie lectus fermentum. Cras at justo id lorem rhoncus tristique. Sed posuere eros et ante pulvinar, nec finibus elit varius. In laoreet, odio faucibus bibendum luctus, magna velit auctor nisl, nec dictum nisi lorem vel diam. Vestibulum iaculis commodo elit vel mollis. Cras sit amet bibendum neque.'
        ],
    ];

    public function render()
    {
        return view('livewire.guest.features', [
            'features' => $this->features
        ]);
    }
}
