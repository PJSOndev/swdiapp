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
        Schema::create('respondent_details', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('respondent_fname')->nullable();
            $table->string('respondent_mname')->nullable();
            $table->string('respondent_lname')->nullable();
            $table->string('respondent_ename')->nullable();
            $table->date('date_of_interview')->nullable();
            $table->timestamp('time_started')->nullable();
            $table->integer('wave_no')->nullable();
            $table->integer('accomplished_by')->nullable();
            $table->integer('ml_swo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondent_details');
    }
};
