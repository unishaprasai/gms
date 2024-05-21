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
        Schema::create('trainersappointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trainer_id'); // Trainer's ID
            $table->string('customer_name'); // Customer's Name
            $table->date('date'); // Date of the appointment
            $table->time('time'); // Time of the appointment
            $table->string('status')->default('Completed'); // Status of the appointment (default: 'Pending')
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainersappointments');
    }
};
