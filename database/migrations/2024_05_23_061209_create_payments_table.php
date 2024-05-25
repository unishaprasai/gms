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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->string('member_name');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('status');
            $table->string('payment_mode'); // Added payment mode column
            $table->string('membership_type'); // Added membership type column
            $table->timestamps();

            // Foreign key constraint (optional, assuming you have a members table)
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
