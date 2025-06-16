<?php

namespace App\Livewire;

use Livewire\Component;

class Price extends Component
{
        public function mount()
    {
        $this->images = [
            asset('images/armada.jpg'),
            // asset('images/default-no-image.png'),
        ];
    }
    
    public function render()
    {
        return view('livewire.price',[
            'images' => $this->images,
        ]);
    }
}
