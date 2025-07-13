<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\BlogDetail;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CompanyProfile;
use App\Http\Controllers\FooterController;

Route::view('/', 'home')->name('home');

Route::view('/home', 'home');

// Test route for footer
Route::get('/footer-test', [FooterController::class, 'index'])->name('footer.test');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// Admin routes dengan permission middleware
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard - accessible by all authenticated users with dashboard permission
    // Route ini sudah tidak diperlukan karena dashboard utama sudah menggunakan Livewire component
    
    // User Management - Only Company Admin and Superadmin
    Route::middleware('permission:manage users')->group(function () {
        Route::get('/users', function() {
            return view('livewire.admin.users');
        })->name('users');
    });

    // Company Profile Management - Only Company Admin and Superadmin
    Route::middleware('permission:manage company profile')->group(function () {
        Route::get('/company-profile', CompanyProfile::class)->name('company-profile');
    });

    // Banner Management
    Route::middleware('permission:edit banner')->group(function () {
        Route::get('/banner', function() {
            return view('livewire.admin.banner');
        })->name('banner');
    });

    // Gallery Management
    Route::middleware('permission:manage gallery')->group(function () {
        Route::get('/gallery', function() {
            return view('livewire.admin.gallery');
        })->name('gallery');
    });

    // Pricing Catalog
    Route::middleware('permission:manage pricing catalog')->group(function () {
        Route::get('/pricing', function() {
            return view('livewire.admin.pricing');
        })->name('pricing');
    });

    // Blog Management
    Route::middleware('permission:view blog')->group(function () {
        Route::get('/blog', function() {
            return view('livewire.admin.blog');
        })->name('blog');
        
        Route::middleware('permission:manage blog')->group(function () {
            Route::get('/blog/create', function() {
                return view('livewire.admin.blog-create');
            })->name('blog.create');
        });
    });

    // Address Management
    Route::middleware('permission:edit company address')->group(function () {
        Route::get('/address', function() {
            return view('livewire.admin.address');
        })->name('address');
    });

    // Contact Management
    Route::middleware('permission:edit contact info')->group(function () {
        Route::get('/contact', function() {
            return view('livewire.admin.contact');
        })->name('contact');
    });

    // FAQ Management
    Route::middleware('permission:manage faq')->group(function () {
        Route::get('/faq', function() {
            return view('livewire.admin.faq');
        })->name('faq');
    });
});

Route::get('/about-us', About::class)->name('about-us');
Route::view('/armada', 'services')->name('armada');
Route::view('/daftar-harga', 'daftar-harga')->name('daftar-harga');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.detail');
Route::view('/contact-us', 'contact-us')->name('contact-us');
