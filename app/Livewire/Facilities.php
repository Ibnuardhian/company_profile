<?php

namespace App\Livewire;

use Livewire\Component;

class Facilities extends Component
{
    public $images = [];

    public function mount()
    {
        $this->images = [
            asset('images/armada.jpg'),
            // asset('images/default-no-image.png'),
        ];
    }

    public function render()
    {
        return view('livewire.facilities', [
            'images' => $this->images,
        ]);
    }
}
