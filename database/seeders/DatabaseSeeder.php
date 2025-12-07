<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Default admin user
        User::updateOrCreate(
            ['email' => 'admin@wefind.com'],
            [
                'name'       => 'Admin User',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'status'     => 'active',          // new column
                'department' => 'Administration',  // new column
            ]
        );
    }
}
