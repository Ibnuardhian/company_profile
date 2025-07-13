<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\BlogDetail;

Route::view('/', 'home')->name('home');

Route::view('/home', 'home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('livewire.admin.dashboard');
    })->name('dashboard');
});

Route::get('/about-us', About::class)->name('about-us');
Route::view('/armada', 'services')->name('armada');
Route::view('/daftar-harga', 'daftar-harga')->name('daftar-harga');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.detail');
Route::view('/contact-us', 'contact-us')->name('contact-us');
