<?php

use App\Livewire\Admin\CompanyProfile;
use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\BlogDetail;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\UserController;
use App\Livewire\Admin\GalleryController;
use App\Livewire\Admin\BlogController as AdminBlogController;
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
    
    // User Management - Only Company Admin and Superadmin
    Route::middleware('permission:manage users')->group(function () {
        Route::get('/users', UserController::class)->name('users');
    });

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
        Route::get('/gallery', GalleryController::class)->name('gallery');
    });

    // Pricing Catalog
    Route::middleware('permission:manage pricing catalog')->group(function () {
        Route::get('/pricing', function() {
            return view('livewire.admin.pricing');
        })->name('pricing');
    });

    // Blog Management
    Route::middleware('permission:view blog')->group(function () {
        Route::get('/blog', AdminBlogController::class)->name('blog');
        
        Route::middleware('permission:manage blog')->group(function () {
            Route::get('/blog/create', [AdminBlogController::class, 'create'])->name('blog.create');
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