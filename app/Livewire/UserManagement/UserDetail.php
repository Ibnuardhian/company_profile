<?php

namespace App\Livewire\UserManagement;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UserDetail extends Component
{
    public $userId;
    public $user;
    public $isOpen = false;
    public $newPassword;
    public $canLoginAs = false;
    public $showRoleAndPermission = false;
    public $createdAt;

    protected $rules = [
        'newPassword' => 'nullable|string|min:6',
    ];

    public function mount($user = null)
    {
        // Jika menerima user object, ambil ID dan load fresh data
        if ($user) {
            $this->userId = is_object($user) ? $user->id : $user;
        }
        
        // Load user dari database dengan relations
        $this->user = User::with('roles')->find($this->userId);
        
        if (!$this->user) {
            throw new \Exception('User tidak ditemukan');
        }
        
        $this->createdAt = Carbon::parse($this->user->created_at)->locale('id')->isoFormat('LLLL');
        
        // Check if current user is superadmin to allow login as feature
        $this->canLoginAs = isSuperAdmin();
    }

    public function resetPassword()
    {
        $this->validate();
        
        if (!empty($this->newPassword)) {
            $this->user->update(['password' => Hash::make($this->newPassword)]);
            
            // Flash message untuk feedback
            $this->dispatch('show-toast', [
                'type' => 'success',
                'message' => 'Password successfully reset for ' . $this->user->name
            ]);
            
            $this->newPassword = '';
        } else {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Please enter a new password'
            ]);
        }
    }

    public function loginAs()
    {
        // Check if current user is superadmin
        if (!isSuperAdmin()) {
            $this->dispatch('show-toast', [
                'type' => 'error',
                'message' => 'Unauthorized. Only superadmin can use login as feature.'
            ]);
            return;
        }
        
        // Simpan admin ID yang sedang login
        $originalAdminId = auth()->id();
        
        // Store original admin info untuk kemudahan kembali
        session()->put('original_admin_id', $originalAdminId);
        session()->put('login_as_user', $this->user->id);
        
        // Logout dari guard yang sedang aktif
        auth()->guard('web')->logout();
        
        // Clear session data yang tidak diperlukan
        session()->forget('password_hash_sanctum');
        session()->invalidate();
        session()->regenerateToken();
        
        // Login sebagai user target
        auth()->guard('web')->login($this->user, true);
        
        // Flash message untuk notifikasi
        session()->flash('login_as_message', 'You are now logged in as ' . $this->user->name);
        
        return redirect()->route('dashboard');
    }

    public function switchBackToAdmin()
    {
        $originalAdminId = session()->get('original_admin_id');
        
        if ($originalAdminId) {
            $adminUser = User::find($originalAdminId);
            
            // Verify that the original admin was actually a superadmin
            if ($adminUser && $adminUser->hasRole('superadmin')) {
                // Logout dari user account
                auth()->guard('web')->logout();
                
                // Clear session data
                session()->forget(['original_admin_id', 'login_as_user']);
                session()->invalidate();
                session()->regenerateToken();
                
                // Login kembali sebagai admin
                auth()->guard('web')->login($adminUser, true);
                
                session()->flash('login_as_message', 'Switched back to admin account');
                
                return redirect()->route('dashboard');
            }
        }
        
        return redirect()->route('login');
    }

    public function render()
    {
        // Debug untuk memastikan user data ada
        if (!$this->user) {
            return view('livewire.usermanagement.userdetail', [
                'error' => 'User data tidak ditemukan'
            ]);
        }
        
        return view('livewire.usermanagement.userdetail');
    }
}
