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
        Schema::create('tbl_ifmfa', function (Blueprint $table) {
            $table->id();
            $table->string('ifmfa_hhid')->nullable();
            $table->string('ifmfa_code')->nullable();
            $table->integer('ifmfa_level')->nullable();
            $table->string('ifmfa_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ifmfa');
    }
};
