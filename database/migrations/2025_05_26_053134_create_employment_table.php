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
        Schema::create('tbl_emp', function (Blueprint $table) {
            $table->id();
            $table->string('emp_hhid')->nullable();
            $table->string('emp_lowb')->nullable();
            $table->integer('emp_code')->nullable();
            $table->string('emp_level')->nullable();
            $table->unsignedBigInteger('emp_swdi_entry_id')->nullable();
            $table->integer('emp_occupation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_emp');
    }
};
