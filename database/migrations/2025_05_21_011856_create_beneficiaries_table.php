<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();

            // Identifiers
            $table->string('hhid')->nullable();
            $table->integer('pantawidID')->nullable();

            // Low birth weight fields
            $table->year('lowb_y')->nullable();
            $table->boolean('lowb_bin')->nullable();

            // Personal information
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('extName')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();

            // Address details
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city_muni')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('address')->nullable();

            // Other attributes
            $table->string('religion')->nullable();
            $table->string('ip_membership')->nullable();

            // Timestamps
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
