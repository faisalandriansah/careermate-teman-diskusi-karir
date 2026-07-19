<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'title' => 'Backend Developer',
                'description' => 'Develop server-side applications.',
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'Develop user interfaces.',
            ],
            [
                'title' => 'Full Stack Developer',
                'description' => 'Develop frontend and backend.',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Manage infrastructure and deployment.',
            ],
            [
                'title' => 'AI Engineer',
                'description' => 'Develop AI solutions.',
            ],
        ];

        foreach ($careers as $career) {
            Career::firstOrCreate(
                ['title' => $career['title']],
                $career
            );
        }
    }
}