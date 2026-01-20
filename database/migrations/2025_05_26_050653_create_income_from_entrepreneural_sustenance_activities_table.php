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
        Schema::create('income_from_entrepreneural_sustenance_activities', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('lowb')->nullable();
            $table->string('ic2_type_1')->nullable();
            $table->decimal('ic2_gross_1', 15, 2)->nullable(); // for monetary values
            $table->decimal('ic2_deduct_1', 15, 2)->nullable();
            $table->string('ic2_activity_2')->nullable(); // for monetary values
            $table->string('ic2_type_2')->nullable();
            $table->decimal('ic2_gross_2', 15, 2)->nullable(); // for monetary values
            $table->decimal('ic2_deduct_2', 15, 2)->nullable();
            $table->string('ic2_activity_3')->nullable(); // for monetary values
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_from_entrepreneural_sustenance_activities');
    }
};
