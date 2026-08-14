<?php

namespace App\Services;

use App\Models\Career;

class CareerMatchingService
{
    public function matchAll(array $detectedSkills): array
    {
        $careers = Career::with('skills')->get();
        $results = [];

        foreach ($careers as $career) {
            $requiredSkills = $career->skills;
            $totalWeight = $requiredSkills->sum(fn($skill) => $skill->pivot->weight);

            if ($totalWeight == 0) {
                continue;
            }

            $matchedWeight = 0;
            $matched = [];
            $gap = [];

            foreach ($requiredSkills as $skill) {
                $isOwned = collect($detectedSkills)
                    ->contains(fn($s) => strtolower($s['name']) === strtolower($skill->name));

                if ($isOwned) {
                    $matchedWeight += $skill->pivot->weight;
                    $matched[] = $skill->name;
                } else {
                    $gap[] = $skill->name;
                }
            }

            $score = round(($matchedWeight / $totalWeight) * 100, 2);

            $results[] = [
                'career' => $career,
                'match_score' => $score,
                'matched_skills' => $matched,
                'skill_gap' => $gap,
            ];
        }

        usort($results, fn($a, $b) => $b['match_score'] <=> $a['match_score']);

        return $results;
    }

    public function match(array $detectedSkills): array
    {
        $all = $this->matchAll($detectedSkills);

        if (empty($all)) {
            return [
                'career' => null,
                'match_score' => 0,
                'skill_gap' => [],
            ];
        }

        $best = $all[0];

        return [
            'career' => $best['career'],
            'match_score' => $best['match_score'],
            'skill_gap' => $best['skill_gap'],
        ];
    }
}
