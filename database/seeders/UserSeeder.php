<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Custom users for seeding
        $users = [
            [
                'name' => 'kelompok 2',
                'email' => 'kelompok2@ipb.ac.id',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'avatar' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
