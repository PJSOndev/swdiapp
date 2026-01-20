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
        Schema::create('tbl_fastf', function (Blueprint $table) {
            $table->id();
            $table->string('fastf_hhid')->nullable();
            $table->string('fastf_code')->nullable();
            $table->string('fastf_level')->nullable();
            $table->string('fastf_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fastf');
    }
};
