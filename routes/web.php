<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\BlogDetail;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\CompanyProfile;

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

// Admin routes dengan permission middleware
Route::middleware(['auth:sanctum', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard - accessible by all authenticated users with dashboard permission
    Route::get('/dashboard', [Dashboard::class, 'dashboard'])
        ->middleware('permission:view dashboard')
        ->name('dashboard');

    // User Management - Only Company Admin and Superadmin
    Route::middleware('permission:manage users')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    });

    // Company Profile Management - Only Company Admin and Superadmin
    Route::middleware('permission:manage company profile')->group(function () {
        Route::get('/company-profile', CompanyProfile::class)->name('company-profile');
    });

    // About Company - Company Admin and Company User
    Route::middleware('permission:edit about company')->group(function () {
        Route::get('/about', [AdminController::class, 'about'])->name('about');
        Route::put('/about', [AdminController::class, 'updateAbout'])->name('about.update');
    });

    // Banner Management
    Route::middleware('permission:edit banner')->group(function () {
        Route::get('/banner', [AdminController::class, 'banner'])->name('banner');
        Route::put('/banner', [AdminController::class, 'updateBanner'])->name('banner.update');
    });

    // Gallery Management
    Route::middleware('permission:manage gallery')->group(function () {
        Route::get('/gallery', [AdminController::class, 'gallery'])->name('gallery');
        Route::post('/gallery', [AdminController::class, 'storeGallery'])->name('gallery.store');
        Route::delete('/gallery/{gallery}', [AdminController::class, 'destroyGallery'])->name('gallery.destroy');
    });

    // Pricing Catalog
    Route::middleware('permission:manage pricing catalog')->group(function () {
        Route::get('/pricing', [AdminController::class, 'pricing'])->name('pricing');
        Route::post('/pricing', [AdminController::class, 'storePricing'])->name('pricing.store');
        Route::put('/pricing/{pricing}', [AdminController::class, 'updatePricing'])->name('pricing.update');
        Route::delete('/pricing/{pricing}', [AdminController::class, 'destroyPricing'])->name('pricing.destroy');
    });

    // Blog Management
    Route::middleware('permission:view blog')->group(function () {
        Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
        
        Route::middleware('permission:manage blog')->group(function () {
            Route::get('/blog/create', [AdminController::class, 'createBlog'])->name('blog.create');
            Route::post('/blog', [AdminController::class, 'storeBlog'])->name('blog.store');
            Route::get('/blog/{blog}/edit', [AdminController::class, 'editBlog'])->name('blog.edit');
            Route::put('/blog/{blog}', [AdminController::class, 'updateBlog'])->name('blog.update');
            Route::delete('/blog/{blog}', [AdminController::class, 'destroyBlog'])->name('blog.destroy');
        });
    });

    // Address Management
    Route::middleware('permission:edit company address')->group(function () {
        Route::get('/address', [AdminController::class, 'address'])->name('address');
        Route::put('/address', [AdminController::class, 'updateAddress'])->name('address.update');
    });

    // Contact Management
    Route::middleware('permission:edit contact info')->group(function () {
        Route::get('/contact', [AdminController::class, 'contact'])->name('contact');
        Route::put('/contact', [AdminController::class, 'updateContact'])->name('contact.update');
    });

    // FAQ Management
    Route::middleware('permission:manage faq')->group(function () {
        Route::get('/faq', [AdminController::class, 'faq'])->name('faq');
        Route::post('/faq', [AdminController::class, 'storeFaq'])->name('faq.store');
        Route::put('/faq/{faq}', [AdminController::class, 'updateFaq'])->name('faq.update');
        Route::delete('/faq/{faq}', [AdminController::class, 'destroyFaq'])->name('faq.destroy');
    });
});

Route::get('/about-us', About::class)->name('about-us');
Route::view('/armada', 'services')->name('armada');
Route::view('/daftar-harga', 'daftar-harga')->name('daftar-harga');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog/{slug}', BlogDetail::class)->name('blog.detail');
Route::view('/contact-us', 'contact-us')->name('contact-us');
