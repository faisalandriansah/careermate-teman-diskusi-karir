<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerMatchResult extends Model
{
    protected $fillable = [
        'analysis_result_id',
        'career_id',
        'match_score',
        'matched_skills_json',
        'skill_gap_json',
        'ai_summary',
        'roadmap_json',
        'is_best_match'
    ];

    protected $casts = [
        'matched_skills_json' => 'array',
        'skill_gap_json' => 'array',
        'roadmap_json' => 'array',
        'is_best_match' => 'boolean',
    ];

    public function analysisResult()
    {
        return $this->belongsTo(AnalysisResult::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
