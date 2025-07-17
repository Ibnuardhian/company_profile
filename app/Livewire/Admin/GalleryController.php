<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GalleryController extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        // Check permission untuk manage gallery
        $this->authorize('manage gallery');
    }

    public function index()
    {
        // Method untuk menampilkan gallery admin
        return view('admin.gallery');
    }

    public function render()
    {
        return view('livewire.admin.gallery-controller');
    }
}
