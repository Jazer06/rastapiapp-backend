<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // admin
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Courier',
            'email' => 'courier@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // courier
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // user
        ]);
    }
}
