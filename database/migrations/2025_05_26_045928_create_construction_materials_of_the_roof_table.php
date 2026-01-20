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
        Schema::create('tbl_cmr', function (Blueprint $table) {
            $table->id();
            $table->string('`crm_hhid')->nullable();
            $table->string('`crm_code')->nullable();
            $table->string('`crm_level')->nullable();
            $table->string('`crm_lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_cmr');
    }
};
