<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'PHP',
            'Laravel',
            'JavaScript',
            'React',
            'Vue.js',
            'MySQL',
            'PostgreSQL',
            'Git',
            'Docker',
            'Linux',
            'REST API',
            'Python',
            'TensorFlow',
            'Power BI',
            'Communication',
            'Leadership',
            'Problem Solving',
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate([
                'name' => $skill
            ]);
        }
    }
}