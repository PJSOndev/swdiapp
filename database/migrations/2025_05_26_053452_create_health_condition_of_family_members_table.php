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
        Schema::create('tbl_hcfm', function (Blueprint $table) {
            $table->id();
            $table->string('hcfm_hhid')->nullable();
            $table->string('hcfm_lowb')->nullable();
            $table->integer('hcfm_code')->nullable();
            $table->string('hcfm_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_hcfm');
    }
};
