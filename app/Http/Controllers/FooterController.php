<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    public function getContacts()
    {
        return DB::table('contacts')->get();
    }

    public function getIconByType($type)
    {
        $icons = [
            'email' => '<i class="fa-solid fa-envelope"></i>',
            'phone' => '<i class="fa-solid fa-phone"></i>',
            'whatsapp' => '<i class="fa-brands fa-whatsapp"></i>',
            'facebook' => '<i class="fa-brands fa-facebook"></i>',
            'instagram' => '<i class="fa-brands fa-instagram"></i>',
            'twitter' => '<i class="fa-brands fa-twitter"></i>',
            'youtube' => '<i class="fa-brands fa-youtube"></i>',
            'linkedin' => '<i class="fa-brands fa-linkedin"></i>',
            'telegram' => '<i class="fa-brands fa-telegram"></i>',
            'tiktok' => '<i class="fa-brands fa-tiktok"></i>',
            'website' => '<i class="fa-solid fa-globe"></i>',
            'address' => '<i class="fa-solid fa-location-dot"></i>',
            'skype' => '<i class="fa-brands fa-skype"></i>',
        ];

        return $icons[$type] ?? '<i class="fa-solid fa-circle-info"></i>';
    }

    public function getContactsWithIcons()
    {
        $contacts = $this->getContacts();
        
        return $contacts->map(function ($contact) {
            $contact->icon = $this->getIconByType($contact->type);
            return $contact;
        });
    }

    public function index()
    {
        $contacts = $this->getContactsWithIcons();
        
        return view('components.footer', compact('contacts'));
    }
}
