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
        Schema::create('tbl_nscfyb', function (Blueprint $table) {
            $table->id();
            $table->string('nscfyb_hhid')->nullable();
            $table->string('nscfyb_lowb')->nullable();
            $table->integer('nscfyb_code')->nullable();
            $table->string('nscfyb_level')->nullable();
            $table->unsignedBigInteger('nscfyb_swdi_entry_id')->nullable();
            $table->decimal('nscfyb_weight',15,2)->nullable();
            $table->integer('nscfyb_age_month')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_nscfyb');
    }
};
