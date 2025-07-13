<?php

if (!function_exists('getContactIcon')) {
    function getContactIcon($type) {
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
}

if (!function_exists('getContactLink')) {
    function getContactLink($type, $value) {
        switch($type) {
            case 'email':
                return 'mailto:' . $value;
            case 'phone':
                return 'tel:' . $value;
            case 'whatsapp':
                return 'https://wa.me/' . preg_replace('/[^0-9]/', '', $value);
            case 'website':
                return $value;
            case 'facebook':
            case 'instagram':
            case 'twitter':
            case 'youtube':
            case 'linkedin':
            case 'telegram':
            case 'tiktok':
                return $value;
            default:
                return null;
        }
    }
}
