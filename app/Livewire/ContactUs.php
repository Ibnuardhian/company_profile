<?php

namespace App\Livewire;

use Livewire\Component;

class ContactUs extends Component
{
    public $questions = [
        [
            'q' => 'Apa itu Lajoo Trans?',
            'a' => 'Lajoo Trans adalah perusahaan transportasi profesional yang melayani berbagai kebutuhan perjalanan Anda.'
        ],
        [
            'q' => 'Bagaimana cara memesan layanan?',
            'a' => 'Anda dapat memesan layanan melalui website, WhatsApp, atau langsung ke kantor kami.'
        ],
        [
            'q' => 'Apakah tersedia layanan antar-jemput?',
            'a' => 'Ya, kami menyediakan layanan antar-jemput sesuai permintaan pelanggan.'
        ],
        [
            'q' => 'Apa saja armada yang tersedia?',
            'a' => 'Kami memiliki berbagai jenis armada mulai dari minibus, bus pariwisata, hingga kendaraan premium.'
        ],
        [
            'q' => 'Bagaimana metode pembayarannya?',
            'a' => 'Pembayaran dapat dilakukan melalui transfer bank, tunai, atau metode pembayaran digital.'
        ],
    ];

    public function render()
    {
        return view('livewire.contact-us');
    }
}
