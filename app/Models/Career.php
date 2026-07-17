<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['title', 'description', 'icon'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'career_skills')
            ->withPivot('weight')
            ->withTimestamps();
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }

    public function analysisResults()
    {
        return $this->hasMany(AnalysisResult::class);
    }
}
