<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TracerBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_name',
        'file_path',
        'uploaded_by_admin_id',
        'total_records',
        'upload_date',
        'description',
    ];

    protected $casts = [
        'upload_date' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'uploaded_by_admin_id');
    }

    public function respondents()
    {
        return $this->hasMany(Respondent::class, 'batch_id');
    }

    public function getEmploymentRateAttribute()
    {
        $total = $this->respondents()->count();
        if ($total === 0) return 0;
        
        $employed = $this->respondents()
            ->whereHas('employmentData', function ($query) {
                $query->where('is_presently_employed', true);
            })
            ->count();
            
        return round(($employed / $total) * 100, 2);
    }
}
