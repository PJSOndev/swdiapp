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
        Schema::create('tbl_apgsp', function (Blueprint $table) {
            $table->id();
            $table->string('apgsp_hhid')->index()->nullable();
            $table->string('apgsp_code')->nullable();
            $table->string('apgsp_level')->nullable();
            $table->string('apgsp_lowb')->nullable();
            $table->timestamps(); // creates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_apgsp');
    }
};
