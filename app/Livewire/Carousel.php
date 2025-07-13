<?php

namespace App\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $images = [];

    public function mount($images = null)
    {
        $this->images = $images ?? [
            'https://plus.unsplash.com/premium_photo-1661963542752-9a8a1d72fb28?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NXx8YnVzfGVufDB8MHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1544190312-44b545e98ef0?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGJ1c3xlbnwwfDB8MHx8fDA%3D',
            'https://images.unsplash.com/photo-1509749837427-ac94a2553d0e?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8dHJhdmVsJTIwYnVzfGVufDB8MHwwfHx8MA%3D%3D',
            'https://plus.unsplash.com/premium_photo-1716999429837-d1d47dc55143?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTA4fHx0cmF2ZWwlMjB3aXRoJTIwYnVzfGVufDB8MHwwfHx8MA%3D%3D',
            'https://images.unsplash.com/photo-1694089051551-69f464c7a886?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTMzfHx0cmF2ZWwlMjB3aXRoJTIwYnVzfGVufDB8MHwwfHx8MA%3D%3D',
        ];
    }

    public function render()
    {
        return view('livewire.guest.carousel', [
            'images' => $this->images,
        ]);
    }
}
