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
        Schema::create('newenrollments', function (Blueprint $table) {
            $table->id();
        $table->string('plan_title');
        $table->string('customer_name');
        $table->string('customer_email');
        $table->string('status')->default('Pending'); // Add status column with default value
        $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newenrollments');
    }
};
