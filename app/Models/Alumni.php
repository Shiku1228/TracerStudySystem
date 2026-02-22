<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alumni extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'first_name',
        'last_name',
        'middle_name',
        'birth_date',
        'gender',
        'phone',
        'address',
        'course',
        'major',
        'batch_year',
        'graduation_date',
        'gpa',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'graduation_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employments(): HasMany
    {
        return $this->hasMany(Employment::class);
    }

    public function surveyResponses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
