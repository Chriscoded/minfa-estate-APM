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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('payment_medium');
            $table->string('proof')->nullable();
            $table->string('amount');
            $table->string('period');
            $table->date('expire_date');
            $table->unsignedBigInteger('tenant_id');
            $table->enum('status', ['unconfirmed', 'confirmed']);
            $table->enum('active_expired', ['active', 'expired']);
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
