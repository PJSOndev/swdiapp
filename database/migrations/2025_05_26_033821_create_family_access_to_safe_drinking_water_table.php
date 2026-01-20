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
        Schema::create('tbl_fasdw', function (Blueprint $table) {
            $table->id();
            $table->string('fasdw_hhid')->nullable();
            $table->string('fasdw_code')->nullable();
            $table->string('fasdw_level')->nullable();
            $table->string('fasdw_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_fasdw');
    }
};
