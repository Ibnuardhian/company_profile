<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends Controller
{
    use AuthorizesRequests;
    public function __construct()
    {
        // Menggunakan middleware permission
        $this->middleware('permission:view dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        // Check permission dalam method
        if (!auth()->user()->can('manage users')) {
            abort(403, 'Unauthorized');
        }

        return view('admin.users');
    }

    public function companyProfile()
    {
        $this->authorize('view company profile');
        
        return view('admin.company-profile');
    }

    public function editCompanyProfile()
    {
        $this->authorize('edit company profile');
        
        return view('admin.edit-company-profile');
    }

    public function gallery()
    {
        $this->authorize('manage gallery');
        
        return view('admin.gallery');
    }

    public function blog()
    {
        $this->authorize('view blog');
        
        return view('admin.blog');
    }

    public function createBlog()
    {
        $this->authorize('manage blog');
        
        return view('admin.create-blog');
    }
}
