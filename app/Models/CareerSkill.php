<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSkill extends Model
{
    protected $fillable = ['career_id', 'skill_id', 'weight'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
