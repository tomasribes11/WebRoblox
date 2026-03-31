<?php

// database/seeders/UserSeeder.php
// Creates test users for API authentication

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user for API
        User::firstOrCreate(
            ['email' => 'test@webroblox.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Create additional test users
        $testUsers = [
            [
                'name' => 'John Doe',
                'email' => 'john@webroblox.com',
                'password' => 'password123',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@webroblox.com',
                'password' => 'password123',
            ],
        ];

        foreach ($testUsers as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('Test users created successfully!');
        $this->command->info('Email: test@webroblox.com | Password: password123');
        $this->command->info('Email: john@webroblox.com | Password: password123');
        $this->command->info('Email: jane@webroblox.com | Password: password123');
    }
}
