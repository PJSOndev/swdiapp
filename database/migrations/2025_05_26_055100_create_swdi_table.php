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
        Schema::create('swdi', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('grantee_fname')->nullable();
            $table->string('grantee_mname')->nullable();
            $table->string('grantee_lname')->nullable();
            $table->string('grantee_ename')->nullable();
            $table->string('religion')->nullable();
            $table->string('ip_membership')->nullable();
            $table->integer('region')->nullable();
            $table->integer('province')->nullable();
            $table->integer('city_municipality')->nullable();
            $table->integer('barangay')->nullable();
            $table->string('purok_street')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swdi');
    }
};
