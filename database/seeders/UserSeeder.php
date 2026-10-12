<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567800',
                'address' => 'Jl. Admin No. 1, Jakarta',
            ]
        );

        // Regular users
        $users = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 10, Jakarta',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567891',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
            ],
            [
                'name' => 'Agus Wijaya',
                'email' => 'agus@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 12, Jakarta',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567893',
                'address' => 'Jl. Thamrin No. 25, Jakarta',
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567894',
                'address' => 'Jl. Diponegoro No. 8, Jakarta',
            ],
            [
                'name' => 'Rina Wati',
                'email' => 'rina@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567895',
                'address' => 'Jl. Imam Bonjol No. 15, Jakarta',
            ],
            [
                'name' => 'Doni Kusuma',
                'email' => 'doni@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567896',
                'address' => 'Jl. Hayam Wuruk No. 30, Jakarta',
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567897',
                'address' => 'Jl. Gajah Mada No. 22, Jakarta',
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567898',
                'address' => 'Jl. Cikini No. 17, Jakarta',
            ],
            [
                'name' => 'Nina Indah',
                'email' => 'nina@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'phone' => '081234567899',
                'address' => 'Jl. Menteng No. 5, Jakarta',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
            ['email' => $userData['email']],
            $userData
        );
}
    }
}