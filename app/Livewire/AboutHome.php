<?php

namespace App\Livewire;

use Livewire\Component;

class AboutHome extends Component
{
    public array $aboutData = [];

    public function mount(): void
    {
        $this->aboutData = [
            'title' => 'Lajoo trans Home',
            'slug' => 'about-us',
            'description' => 'Deskripsi singkat tentang Lajoo trans1.',
        ];
    }

    public function render()
    {
        return view('livewire.about-home', [
            'aboutData' => $this->aboutData,
        ]);
    }
}
