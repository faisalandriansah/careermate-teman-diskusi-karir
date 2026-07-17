<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisResult extends Model
{
    protected $fillable = [
        'user_id', 'cv_file_id', 'career_id', 'match_score', 'skills_json', 'skills_json', 'skill_gap_json', 'roadmap_json', 'ai_summary',
    ];

    protected $casts = [
        'skills_json' => 'array',
        'skill_gap_json' => 'array',
        'roadmap_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cvFile()
    {
        return $this->belongsTo(CVFile::class);
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
