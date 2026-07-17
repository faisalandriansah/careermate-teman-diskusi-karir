<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id', 'university', 'major', 'semester', 'phone', 'github_url', 'linkedin_url', 'portfolio_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
