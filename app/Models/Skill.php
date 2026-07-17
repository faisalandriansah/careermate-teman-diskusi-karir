<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_skills')
            ->withPivot('weight')
            ->withTimestamps();
    }
}
