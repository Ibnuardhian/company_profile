<?php

namespace App\Livewire\UserManagement;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $filterRole;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRole()
    {
        $this->resetPage();
    }


    public function render()
    {
        $query = User::with('roles');
        
        if (!empty($this->search)) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('id', 'like', '%' . $this->search . '%');
            });
        }
        
        if ($this->filterRole) {
            $query->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('name', $this->filterRole);
            });
        }
        
        $users = $query->orderBy('id')->paginate(10);
        
        return view('livewire.usermanagement.index', [
            'users' => $users,
            'roles' => Role::all(),
        ])->layout('layouts.admin');
    }
}
