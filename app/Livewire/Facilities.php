<?php

namespace App\Livewire;

use Livewire\Component;

class Facilities extends Component
{
    public $images = [];

    public function mount()
    {
        $this->images = [
            'https://images.unsplash.com/photo-1572675339312-3e8b094a544d?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            // asset('images/armada.jpg'),
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
