<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'full_name',
        'present_address',
        'provincial_address',
        'email_address',
        'contact_number',
        'civil_status',
        'gender',
        'birthday',
        'course_graduated',
        'graduation_year',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(TracerBatch::class);
    }

    public function employmentData()
    {
        return $this->hasOne(EmploymentData::class);
    }

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->full_name)[0] ?? '';
    }

    public function getLastNameAttribute()
    {
        $parts = explode(' ', $this->full_name);
        return count($parts) > 1 ? end($parts) : '';
    }

    public function getCourseCodeAttribute()
    {
        return match($this->course_graduated) {
            'ASSOCIATE IN COMPUTER TECHNOLOGY' => 'ACT',
            'BACHELOR OF SCIENCE IN COMPUTER SCIENCE' => 'BSCS',
            'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY' => 'BSIT',
            default => 'OTHER'
        };
    }

    public function getAgeAttribute()
    {
        return $this->birthday ? $this->birthday->age : null;
    }
}
