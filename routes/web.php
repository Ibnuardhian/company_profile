<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Livewire\Customers;

Route::view('/', 'home')->name('home');

Route::view('/home', 'home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/about-us', function () {
    return view('about');
})->name('about-us');

Route::view('/services', 'services')->name('services');
Route::view('/our-work', 'our-work')->name('our-work');
Route::view('/contact-us', 'contact-us')->name('contact-us');
Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
