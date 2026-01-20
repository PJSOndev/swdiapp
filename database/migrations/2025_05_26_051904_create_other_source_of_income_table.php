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
        Schema::create('other_source_of_income', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('lowb')->nullable();
            $table->decimal('pension_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('pension_in_kind', 15, 2)->nullable();
            $table->decimal('dividends_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('dividends_in_kind', 15, 2)->nullable();
            $table->decimal('imputed_rental_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('imputed_rental_in_kind', 15, 2)->nullable();
            $table->decimal('other_source_cash', 15, 2)->nullable(); // for monetary values
            $table->decimal('other_source_in_kind', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_source_of_income');
    }
};
