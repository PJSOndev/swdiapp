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
        Schema::create('tbl_cmow', function (Blueprint $table) {
            $table->id();
            $table->string('cmow_hhid')->nullable();
            $table->string('cmow_code')->nullable();
            $table->string('cmow_level')->nullable();
            $table->string('cmow_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cmow');
    }
};
