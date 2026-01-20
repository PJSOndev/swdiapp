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
        Schema::create('tbl_emp_skills', function (Blueprint $table) {
            $table->id();
            $table->string('es_hhid')->nullable();
            $table->string('es_lowb')->nullable();
            $table->integer('es_code')->nullable();
            $table->string('es_level')->nullable();
            $table->integer('es_swdi_entry_id')->nullable();
            $table->string('es_sex')->nullable();
            $table->date('es_date_of_birth')->nullable();
            $table->integer('es_age')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_emp_skills');
    }
};
