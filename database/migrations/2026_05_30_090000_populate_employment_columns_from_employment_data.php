<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Populate employment_status and job_aligned_with_course from employment_data table
        DB::statement('
            UPDATE respondents r
            LEFT JOIN employment_data ed ON r.id = ed.respondent_id
            SET 
                r.employment_status = CASE 
                    WHEN ed.is_presently_employed = 1 THEN "employed"
                    WHEN ed.is_presently_employed = 0 THEN "unemployed"
                    ELSE NULL
                END,
                r.job_aligned_with_course = ed.is_course_related
            WHERE ed.id IS NOT NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set the columns back to NULL
        DB::statement('
            UPDATE respondents 
            SET employment_status = NULL, job_aligned_with_course = NULL
        ');
    }
};
