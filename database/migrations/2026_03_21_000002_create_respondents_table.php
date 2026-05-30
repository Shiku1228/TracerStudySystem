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
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('tracer_batches')->onDelete('cascade');
            
            // General Information (Questions 1-10)
            $table->string('full_name');
            $table->text('present_address');
            $table->text('provincial_address');
            $table->string('email_address');
            $table->string('contact_number');
            $table->enum('civil_status', ['single', 'married', 'separated', 'widowed']);
            $table->enum('gender', ['female', 'male', 'prefer_not_to_say', 'other']);
            $table->date('birthday');
            $table->enum('course_graduated', ['ASSOCIATE IN COMPUTER TECHNOLOGY', 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE', 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY']);
            $table->integer('graduation_year');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
