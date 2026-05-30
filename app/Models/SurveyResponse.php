<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyResponse extends Model
{
    protected $fillable = [
        'alumni_id',
        'survey_type',
        'satisfaction_level',
        'curriculum_relevance',
        'skills_gained',
        'skills_needed',
        'challenges_faced',
        'suggestions',
        'would_recommend',
        'response_date',
    ];

    protected $casts = [
        'would_recommend' => 'boolean',
        'response_date' => 'date',
    ];

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }
}
