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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id'); // Foreign key for member
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->date('attendance_date'); // Date column for storing the attendance date
            $table->string('status'); // Column for storing status (present, absent, late)
            $table->string('shift'); // Column for storing status (present, absent, late)
            $table->decimal('percentage', 5, 2); // Decimal column for storing percentage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};