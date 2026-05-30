<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->enum('employment_status', ['employed', 'unemployed', 'self_employed', 'further_studies', 'not_seeking'])->nullable()->after('graduation_year');
            $table->string('current_job_title')->nullable()->after('employment_status');
            $table->string('company_name')->nullable()->after('current_job_title');
            $table->boolean('job_aligned_with_course')->nullable()->after('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->dropColumn(['employment_status', 'current_job_title', 'company_name', 'job_aligned_with_course']);
        });
    }
};
