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
        Schema::create('tbl_lfth', function (Blueprint $table) {
            $table->id();
            $table->string('lfth_hhid')->nullable();
            $table->string('lfth_code')->nullable();
            $table->string('lfth_level')->nullable();
            $table->string('lfth_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_lfth');
    }
};
