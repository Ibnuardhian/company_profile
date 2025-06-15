<?php

// This file has been replaced by TestimonialController.php. Safe to delete.

namespace App\Livewire;

use Livewire\Component;

class Testimonials extends Component
{
    public $testimonials = [
        [
            'nama' => 'Mohamed Fadhlan Sukaji',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
        [
            'nama' => 'NAMA PELANGGAN2',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
        [
            'nama' => 'NAMA PELANGGAN3',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
        [
            'nama' => 'NAMA PELANGGAN4',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
        [
            'nama' => 'NAMA PELANGGAN5',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
        [
            'nama' => 'NAMA PELANGGAN6',
            'jenis' => 'Jenis kendaraan',
            'foto' => '/images/foto-fadhlan.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
            'bintang' => 5
        ],
    ];
    public $index = 0;

    public function next()
    {
        $this->index = ($this->index + 2) % count($this->testimonials);
    }

    public function previous()
    {
        $this->index = ($this->index - 2 + count($this->testimonials)) % count($this->testimonials);
    }

    public function render()
    {
        return view('livewire.testimonials');
    }
}
