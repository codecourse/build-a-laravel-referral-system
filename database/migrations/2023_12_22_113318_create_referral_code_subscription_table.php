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
        Schema::create('referral_code_subscription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_code_id')->constrained();
            $table->foreignId('subscription_id')->constrained();
            $table->unsignedFloat('multiplier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_code_subscription');
    }
};
