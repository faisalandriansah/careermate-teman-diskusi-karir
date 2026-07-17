<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'career_id', 'company_name', 'position', 'location', 'application_url',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}
