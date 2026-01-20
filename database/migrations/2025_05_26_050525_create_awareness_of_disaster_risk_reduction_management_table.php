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
        Schema::create('awareness_of_disaster_risk_reduction_management', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('code')->nullable();
            $table->string('level')->nullable();
            $table->string('lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awareness_of_disaster_risk_reduction_management');
    }
};
