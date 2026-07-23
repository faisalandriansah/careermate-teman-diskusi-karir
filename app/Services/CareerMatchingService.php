<?php

namespace App\Services;

use App\Models\Career;

class CareerMatchingService
{
    public function match(array $detectedSkills): array
    {
        $careers = Career::with('skills')->get();

        $bestMatch = null;
        $bestScore = -1;
        $bestGap = [];

        foreach ($careers as $career) {
            $requiredSkills = $career->skills;
            $totalWeight = $requiredSkills->sum(fn($skill) => $skill->pivot->weight);
            if ($totalWeight == 0) {
                continue;
            }

            $matchedWeight = 0;
            $gap = [];

            foreach ($requiredSkills as $skill) {
                $isOwned = collect($detectedSkills)
                    ->contains(fn($s) => strtolower($s) === strtolower($skill->name));
                if ($isOwned) {
                    $matchedWeight += $skill->pivot->weight;
                } else {
                    $gap[] = $skill->name;
                }
            }

            $score = round(($matchedWeight / $totalWeight) * 100, 2);

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestMatch = $career;
                $bestGap = $gap;
            }
        }

        return [
            'career' => $bestMatch,
            'match_score' => $bestScore,
            'skill_gap' => $bestGap,
        ];
    }
}
