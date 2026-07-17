<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CVFile extends Model
{
    protected $table = 'c_v_files';

    protected $fillable = [
        'user_id', 'file_name', 'file_path', 'mime_type', 'file_size', 'extracted_text',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function analysisResults()
    {
        return $this->hasMany(AnalysisResult::class);
    }
}
