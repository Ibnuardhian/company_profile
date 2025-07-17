<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Navigation extends Component
{
    use AuthorizesRequests;

    public $slideOverOpen = false;

    public function openSlideover()
    {
        $this->slideOverOpen = true;
    }

    public function closeSlideover()
    {
        $this->slideOverOpen = false;
    }

    public function render()
    {
        return view('livewire.admin.navigation');
    }
}
