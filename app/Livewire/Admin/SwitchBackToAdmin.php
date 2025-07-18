<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class SwitchBackToAdmin extends Component
{
    public function switchBack()
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
                
                return redirect()->route('admin.dashboard');
            }
        }
        
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.switch-back-to-admin');
    }
}
