<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@careermate.com'],
            [
                'name' => 'Administrator',
                'password' => 'admin123', // akan otomatis di-hash jika model memakai cast 'hashed'
                'role' => 'admin',
            ]
        );
    }
}