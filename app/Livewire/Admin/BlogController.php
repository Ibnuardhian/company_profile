<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BlogController extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        // Check permission untuk view blog
        $this->authorize('view blog');
    }

    public function index()
    {
        // Method untuk menampilkan daftar blog
        return view('admin.blog');
    }

    public function create()
    {
        // Check permission untuk manage blog
        $this->authorize('manage blog');
        
        return view('admin.create-blog');
    }

    public function render()
    {
        return view('livewire.admin.blog-controller');
    }
}
