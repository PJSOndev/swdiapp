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
        Schema::create('social_security', function (Blueprint $table) {
            $table->id();
            $table->string('ss_hhid')->nullable();
            $table->string('ss_code')->nullable();
            $table->string('ss_level')->nullable();
            $table->string('ss_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_security');
    }
};
