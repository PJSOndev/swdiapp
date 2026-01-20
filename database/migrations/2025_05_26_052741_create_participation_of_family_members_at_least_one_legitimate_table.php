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
        Schema::create('participation_of_family_members_at_least_one_legitimate', function (Blueprint $table) {
            $table->id();
            $table->string('hhid')->nullable();
            $table->string('code')->nullable();
            $table->string('level')->nullable();
            $table->string('lowb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participation_of_family_members_at_least_one_legitimate');
    }
};
