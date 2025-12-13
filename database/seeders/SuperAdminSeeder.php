<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Product Admin',
            'email' => 'product@example.com',
            'password' => Hash::make('password'),
            'role' => 'product_admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sales Admin',
            'email' => 'sales@example.com',
            'password' => Hash::make('password'),
            'role' => 'sales_admin',
            'email_verified_at' => now(),
        ]);
    }
}