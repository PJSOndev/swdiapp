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
        Schema::create('tbl_num_meals', function (Blueprint $table) {
            $table->id();
            $table->string('meal_hhid')->nullable();
            $table->string('meal_code')->nullable();
            $table->string('meal_level')->nullable();
            $table->string('meal_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_num_meals');
    }
};
