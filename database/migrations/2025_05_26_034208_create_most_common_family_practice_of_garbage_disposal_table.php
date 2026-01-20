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
        Schema::create('tbl_mcfpgd', function (Blueprint $table) {
            $table->id();
            $table->string('mcfpgd_hhid')->nullable();
            $table->string('mcfpgd_code')->nullable();
            $table->string('mcfpgd_level')->nullable();
            $table->string('mcfpgd_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_mcfpgd');
    }
};
