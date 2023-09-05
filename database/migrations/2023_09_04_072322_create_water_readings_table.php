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
        Schema::create('water_readings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('current_readings');
            $table->string('previous_readings');
            $table->string('rate');
            $table->string('amount');
            $table->string('month');
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_readings');
    }
};
