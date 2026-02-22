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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained()->onDelete('cascade');
            $table->string('survey_type'); // initial, follow_up, annual
            $table->integer('satisfaction_level'); // 1-5 scale
            $table->text('curriculum_relevance')->nullable();
            $table->text('skills_gained')->nullable();
            $table->text('skills_needed')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('suggestions')->nullable();
            $table->boolean('would_recommend')->default(true);
            $table->date('response_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
