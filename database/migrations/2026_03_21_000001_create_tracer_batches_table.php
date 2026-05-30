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
        Schema::create('tracer_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name');
            $table->string('file_path');
            $table->foreignId('uploaded_by_admin_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_records')->default(0);
            $table->timestamp('upload_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracer_batches');
    }
};
