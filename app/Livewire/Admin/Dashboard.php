<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;

    public function mount()
    {
        // Check permission saat component dimount
        $this->authorize('view dashboard');
    }

    protected function recentUsers()
    {
        $users = \App\Models\User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'superadmin');
        })
        ->latest()
        ->take(5)
        ->get();

        // Ambil data sessions
        $sessions = \DB::table('sessions')->select('user_id', 'last_activity')->get();
        $activeUserIds = $sessions->pluck('user_id')->filter()->unique();

        // Map user_id ke last_activity
        $lastLoginMap = $sessions->groupBy('user_id')->map(function($items) {
            return $items->max('last_activity');
        });

        foreach ($users as $user) {
            $user->is_active = $activeUserIds->contains($user->id);
            $lastLogin = $lastLoginMap[$user->id] ?? null;
            if ($lastLogin) {
                $user->last_login = \Carbon\Carbon::createFromTimestamp($lastLogin)
                    ->addHours(7)
                    ->format('M d, Y H:i');
            } else {
                $user->last_login = null;
            }
        }

        return $users;
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'recentUsers' => $this->recentUsers()
        ])->layout('layouts.admin');
    }
}
