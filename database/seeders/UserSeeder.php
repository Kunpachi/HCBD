<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email','admin@example.com')->exists()) {
           User::firstOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Administrator',
                    'username' => 'admin',
                    'password' => Hash::make('password123'),
                    'role' => 'admin',
                ]
            );
        }
    }
}
