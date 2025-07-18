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

    /**
     * Define which role IDs each role can manage.
     */
    private const MANAGEABLE_ROLES = [
        1 => [2, 3],
        2 => [3],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterRole(): void
    {
        $this->resetPage();
    }

    /**
     * Get IDs of roles the current user is allowed to manage.
     */
    private function manageableRoleIds(): array
    {
        $role = auth()->user()->roles->first();
        if (! $role) {
            return [];
        }

        return self::MANAGEABLE_ROLES[$role->id] ?? [];
    }

    /**
     * Fetch roles the user can assign or filter by.
     */
    private function getAvailableRoles()
    {
        $ids = $this->manageableRoleIds();
        return $ids ? Role::whereIn('id', $ids)->get() : collect();
    }

    public function render()
    {
        $excludeCurrent = auth()->id();
        $userRoleIds = $this->manageableRoleIds();

        // Base query excluding self
        $query = User::with('roles')
            ->where('id', '!=', $excludeCurrent);

        // Apply RBAC: if no manageable roles, return empty
        if (empty($userRoleIds)) {
            $users = collect();
        } else {
            $query->whereHas('roles', fn($q) => $q->whereIn('id', $userRoleIds));

            // Search filter
            if ($this->search) {
                $query->where(fn($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%")
                      ->orWhere('id', 'like', "%{$this->search}%")
                );
            }

            // Role filter
            if ($this->filterRole) {
                $query->whereHas('roles', fn($q) =>
                    $q->where('name', $this->filterRole)
                );
            }

            $users = $query->orderBy('id')->paginate(10);
        }

        return view('livewire.usermanagement.index', [
            'users' => $users,
            'roles' => $this->getAvailableRoles(),
        ])
        ->layout('layouts.admin');
    }
}
