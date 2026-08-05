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
            $pattern = '/\b' . preg_quote($skill->name, '/') . '\b/i';
            if (preg_match($pattern, $text)) {
                $detected[] = [
                    'id' => $skill->id,
                    'name' => $skill->name,
                ];
            }
        }

        return $detected;
    }
}
