<?php

if (!function_exists('canAccess')) {
    /**
     * Check if the current user can access a specific permission
     *
     * @param string $permission
     * @return bool
     */
    function canAccess(string $permission): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return auth()->user()->can($permission);
    }
}

if (!function_exists('hasRole')) {
    /**
     * Check if the current user has a specific role
     *
     * @param string $role
     * @return bool
     */
    function hasRole(string $role): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return auth()->user()->hasRole($role);
    }
}

if (!function_exists('isSuperAdmin')) {
    /**
     * Check if the current user is a superadmin
     *
     * @return bool
     */
    function isSuperAdmin(): bool
    {
        return hasRole('superadmin');
    }
}

if (!function_exists('isCompanyAdmin')) {
    /**
     * Check if the current user is a company admin
     *
     * @return bool
     */
    function isCompanyAdmin(): bool
    {
        return hasRole('company admin');
    }
}

if (!function_exists('isCompanyUser')) {
    /**
     * Check if the current user is a company user
     *
     * @return bool
     */
    function isCompanyUser(): bool
    {
        return hasRole('company user');
    }
}

if (!function_exists('getUserPermissions')) {
    /**
     * Get all permissions for the current user
     *
     * @return \Illuminate\Support\Collection
     */
    function getUserPermissions()
    {
        if (!auth()->check()) {
            return collect();
        }

        return auth()->user()->getAllPermissions();
    }
}

if (!function_exists('getUserRoles')) {
    /**
     * Get all roles for the current user
     *
     * @return \Illuminate\Support\Collection
     */
    function getUserRoles()
    {
        if (!auth()->check()) {
            return collect();
        }

        return auth()->user()->getRoleNames();
    }
}
