<?php

namespace App\Services;

use App\Models\Skill;

class SkillDetectionService
{
    public function detect(string $text): array
    {
        $skills = Skill::all();
        $detected = [];

        foreach ($skills as $skill) {
            if (stripos($text, $skill->name) !== false){
                $detected[] = $skill->name;
            }
        }

        return $detected;
    }
}
