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
        Schema::create('swdi_family_composition', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->integer('line_number')->nullable();
            $table->string('grantee_fname')->nullable();
            $table->string('grantee_mname')->nullable();
            $table->string('grantee_lname')->nullable();
            $table->string('grantee_ename')->nullable();
            $table->string('relationship_to_the_grantee')->nullable();
            $table->integer('sex')->nullable();
            $table->string('age')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('marital_status')->nullable();
            $table->integer('hea')->nullable();
            $table->integer('currently_attending_school')->nullable();
            $table->string('primary_occupation')->nullable();
            $table->string('class_of_worker')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swdi_family_composition');
    }
};
