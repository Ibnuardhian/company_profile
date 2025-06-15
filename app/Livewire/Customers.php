<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Asset;

class Customers extends Component
{
    public $customers = [];

    public function mount()
    {
        $this->customers = [
            [ 'src' => asset('images/foto-fadhlan.jpg'), 'alt' => 'Foto 1', 'label' => 'FOTO1' ],
            [ 'src' => asset('images/meeting.jpg'), 'alt' => 'Foto 2', 'label' => 'FOTO2' ],
            [ 'src' => asset('images/default-no-image.png'), 'alt' => 'Foto 3', 'label' => 'FOTO3' ],
            [ 'src' => asset('images/foto-fadhlan.jpg'), 'alt' => 'Foto 4', 'label' => 'FOTO4' ],
            [ 'src' => asset('images/meeting.jpg'), 'alt' => 'Foto 5', 'label' => 'FOTO5' ],
            [ 'src' => asset('images/default-no-image.png'), 'alt' => 'Foto 6', 'label' => 'FOTO6' ],
        ];
    }

    public function render()
    {
        return view('livewire.customers', [
            'customers' => $this->customers
        ]);
    }
}
