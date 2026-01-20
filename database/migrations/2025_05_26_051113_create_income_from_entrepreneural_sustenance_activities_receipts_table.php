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
        Schema::create('income_from_entrepreneural_sustenance_activities_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('lowb')->nullable();
            $table->decimal('rgsr_ofw_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('rgsr_ofw_in_kind', 15, 2)->nullable();
            $table->decimal('rgsr_entities_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('rgsr_entities_in_kind', 15, 2)->nullable();
            $table->decimal('rgsr_fourps_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('rgsr_fourps_in_kind', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_from_entrepreneural_sustenance_activities_receipts');
    }
};
