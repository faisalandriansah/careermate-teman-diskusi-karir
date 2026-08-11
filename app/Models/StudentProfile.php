<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'university',
        'major',
        'semester',
        'phone',
        'github_url',
        'linkedin_url',
        'portfolio_url',
        'photo_path',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return $this->photo_path ? asset('storage/' . $this->photo_path)
            : null;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // biar field wajib biar dianggap lengkap github/linkedin/porto gak wajib opsional saja
    public function isComplete(): bool
    {
        return !empty($this->university)
            && !empty($this->major)
            && !empty($this->semester)
            && !empty($this->phone);
    }
}
