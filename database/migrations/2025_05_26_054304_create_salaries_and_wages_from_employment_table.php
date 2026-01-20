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
        Schema::create('salaries_and_wages_from_employment', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('lowb')->nullable();
            $table->unsignedBigInteger('swdi_entry_id')->nullable();
            $table->integer('popn_group')->nullable();
            $table->decimal('cash_comm',15,2)->nullable();
            $table->decimal('cash_allowance',15,2)->nullable();
            $table->decimal('basic_comp_in_kind',15,2)->nullable();
            $table->integer('region_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries_and_wages_from_employment');
    }
};
