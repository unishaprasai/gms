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
        Schema::create('trainer_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_id'); // Foreign key to trainers table
            $table->date('attendance_date');
            $table->string('status');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_attendances');
    }
};



