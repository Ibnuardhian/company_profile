<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles and permissions first
        $this->call(RolePermissionSeeder::class);

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@company.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('superadmin');

        User::factory()->create([
            'name' => 'Company Admin',
            'email' => 'admin@company.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('company admin');

        User::factory()->create([
            'name' => 'Company User',
            'email' => 'user@company.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ])->assignRole('company user');
    }
}
