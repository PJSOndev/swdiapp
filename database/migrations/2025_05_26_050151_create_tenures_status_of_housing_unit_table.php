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
        Schema::create('tbl_tshu', function (Blueprint $table) {
            $table->id();
            $table->string('tshu_hhid')->nullable();
            $table->string('tshu_code')->nullable();
            $table->string('tshu_level')->nullable();
            $table->string('tshu_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tshu');
    }
};
