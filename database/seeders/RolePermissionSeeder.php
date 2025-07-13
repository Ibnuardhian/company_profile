<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for company profile system
        $permissions = [
            // User Management
            'manage users',
            
            // Company Profile Management
            'view company profile',
            'manage company profile',
            
            // Banner Management
            'edit banner',
            
            // Gallery Management
            'manage gallery',
            
            // Pricing/Catalog
            'manage pricing catalog',
            
            // Blog Management
            'manage blog',
            'view blog',
            
            // Address Management
            'edit company address',
            
            // Contact Management
            'edit contact info',
            
            // FAQ Management
            'manage faq',
            
            // Dashboard Access
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // 1. Superadmin Role (akan menggunakan Gate::before() intercept)
        $superadminRole = Role::create(['name' => 'superadmin']);
        // Superadmin tidak perlu permission eksplisit karena akan menggunakan Gate::before()
        
        // 2. Company Admin Role
        $companyAdminRole = Role::create(['name' => 'company admin']);
        $companyAdminRole->givePermissionTo([
            'manage users',
            'view company profile',
            'manage company profile',
            'edit banner',
            'manage gallery',
            'manage pricing catalog',
            'manage blog',
            'view blog',
            'edit company address',
            'edit contact info',
            'manage faq',
            'view dashboard',
        ]);

        // 3. Company User Role
        $companyUserRole = Role::create(['name' => 'company user']);
        $companyUserRole->givePermissionTo([
            'view company profile',
            'manage company profile',
            'edit banner',
            'manage gallery',
            'manage pricing catalog',
            'manage blog',
            'view blog',
            'manage faq',
            'view dashboard',
        ]);
    }
}
