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
        Schema::create('employment_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('respondent_id')->constrained('respondents')->onDelete('cascade');
            
            // Employment Information (Questions 11-19)
            $table->boolean('is_presently_employed');
            $table->string('present_occupation')->nullable();
            $table->string('company_name')->nullable();
            $table->text('company_address_contact')->nullable();
            $table->enum('place_of_work', ['local', 'abroad'])->nullable();
            $table->string('position_designation')->nullable();
            $table->text('professional_skills')->nullable();
            $table->boolean('is_first_job')->nullable();
            $table->boolean('is_course_related')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_data');
    }
};
