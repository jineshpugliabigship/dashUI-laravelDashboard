<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@dashui.dev'], // Prevent duplicates
            [
                'name' => 'SuperAdmin DashUI',
                'username' => 'superadmin', // Ensure username is set
                'email' => 'superadmin@dashui.dev',
                'password' => Hash::make('password'),
                'is_active' => '1',
                'phone' => '12345678901', // Provide a unique phone number

                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@dashui.dev'],
            [
                'name' => 'Admin DashUI',
                'username' => 'admin',
                'email' => 'admin@dashui.dev',
                'password' => Hash::make('password'),
                'is_active' => '1',
                'phone' => '1234567890', // Provide a unique phone number
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $manager = User::updateOrCreate(
            ['email' => 'manager@dashui.dev'],
            [
                'name' => 'Manager DashUI',
                'username' => 'manager',
                'email' => 'manager@dashui.dev',
                'password' => Hash::make('password'),
                'is_active' => '1',
                'phone' => '123456789', // Provide a unique phone number
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'mutant@dashui.dev'],
            [
                'name' => 'Mutant',
                'username' => 'mutant',
                'email' => 'mutant@dashui.dev',
                'password' => Hash::make('password'),
                'is_active' => '1',
                'phone' => '12345678', // Provide a unique phone number
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Assign roles
        $superAdmin->assignRole('SuperAdmin');
        $admin->assignRole('Admin');
        $manager->assignRole('Manager');
        $user->assignRole('User');
    }
}
