<?php

namespace App\Livewire;

use App\Models\CompanyProfile;
use App\Models\Faq;
use Livewire\Component;

class ContactUs extends Component
{
    public $questions;
    public $companyProfile;

    public function mount()
    {
        $this->companyProfile = CompanyProfile::main();
        
        // Fetch FAQ data from database
        $faqs = Faq::with('category')
            ->where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();
        
        // Transform FAQ data to match the expected format
        $this->questions = $faqs->map(function ($faq) {
            return [
                'q' => $faq->question,
                'a' => $faq->answer
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.guest.contact-us');
    }
}
