<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample users data
        $users = [
            [
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1234qwer'), // Hashed password
                'photo' => 'path/to/photo1.jpg',
                'phone' => '1234567890',
                'address' => 'Admin Address',
                'role' => 'admin',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agent User',
                'username' => 'agent',
                'email' => 'agent@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1234qwer'), // Hashed password
                'photo' => 'path/to/photo2.jpg',
                'phone' => '0987654321',
                'address' => 'Agent Address',
                'role' => 'agent',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('1234qwer'), // Hashed password
                'photo' => 'path/to/photo3.jpg',
                'phone' => '1122334455',
                'address' => 'User Address',
                'role' => 'user',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert sample data into users table
        DB::table('users')->insert($users);
    }
}