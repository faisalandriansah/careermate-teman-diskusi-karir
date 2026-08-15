<?php

namespace App\Services;

use App\Models\Career;

class CareerMatchingService
{
    private const MIN_SCORE = 30;

    private const MIN_SKILL_COUNT_FOR_BEST = 3;

    public function matchAll(array $detectedSkills): array
    {
        $careers = Career::with('skills')->get();
        $results = [];

        foreach ($careers as $career) {
            $requiredSkills = $career->skills;
            $totalWeight = $requiredSkills->sum(fn ($skill) => $skill->pivot->weight);

            if ($totalWeight == 0) {
                continue;
            }

            $matchedWeight = 0;
            $matched = [];
            $gap = [];

            foreach ($requiredSkills as $skill) {
                $isOwned = collect($detectedSkills)
                    ->contains(fn ($s) => strtolower($s['name']) === strtolower($skill->name));

                if ($isOwned) {
                    $matchedWeight += $skill->pivot->weight;
                    $matched[] = $skill->name;
                } else {
                    $gap[] = $skill->name;
                }
            }

            $totalCount = count($requiredSkills);
            $matchedCount = count($matched);
            $weightRatio = $matchedWeight / $totalWeight;
            $countRatio = $matchedCount / $totalCount;
            $countFactor = min($totalCount, self::MIN_SKILL_COUNT_FOR_BEST) / self::MIN_SKILL_COUNT_FOR_BEST;

            $score = round($weightRatio * $countRatio * $countFactor * 100, 2);

            if ($score < self::MIN_SCORE) {
                continue;
            }

            $results[] = [
                'career' => $career,
                'match_score' => $score,
                'matched_skills' => $matched,
                'skill_gap' => $gap,
            ];
        }

        usort($results, fn ($a, $b) => $b['match_score'] <=> $a['match_score']);

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
