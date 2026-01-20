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
        Schema::create('ability_of_parents_to_discern_problems', function (Blueprint $table) {
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
        Schema::dropIfExists('ability_of_parents_to_discern_problems');
    }
};
