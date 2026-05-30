<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentData extends Model
{
    use HasFactory;

    protected $fillable = [
        'respondent_id',
        'is_presently_employed',
        'present_occupation',
        'company_name',
        'company_address_contact',
        'place_of_work',
        'position_designation',
        'professional_skills',
        'is_first_job',
        'is_course_related',
    ];

    protected $casts = [
        'is_presently_employed' => 'boolean',
        'is_first_job' => 'boolean',
        'is_course_related' => 'boolean',
    ];

    public function respondent()
    {
        return $this->belongsTo(Respondent::class);
    }

    public function getWorkLocationAttribute()
    {
        return match($this->place_of_work) {
            'local' => 'Local',
            'abroad' => 'Abroad',
            default => 'Unknown'
        };
    }

    public function getEmploymentTypeAttribute()
    {
        if (!$this->is_presently_employed) return 'Unemployed';
        if ($this->is_course_related) return 'Course-Related';
        return 'Non-Course-Related';
    }
}
