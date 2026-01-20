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
        Schema::table('income_from_entrepreneural_sustenance_activities', function (Blueprint $table) {
            $table->string('ic2_type_3')->nullable();
            $table->decimal('ic2_gross_3', 15, 2)->nullable()->after('ic2_type_3');
            $table->decimal('ic2_deduct_3', 15, 2)->nullable()->after('ic2_gross_3');

            $table->string('ic2_activity_4')->nullable()->after('ic2_deduct_3');
            $table->string('ic2_type_4')->nullable()->after('ic2_activity_4');
            $table->decimal('ic2_gross_4', 15, 2)->nullable()->after('ic2_type_4');
            $table->decimal('ic2_deduct_4', 15, 2)->nullable()->after('ic2_gross_4');

            $table->string('ic2_activity_5')->nullable()->after('ic2_deduct_4');
            $table->string('ic2_type_5')->nullable()->after('ic2_activity_5');
            $table->decimal('ic2_gross_5', 15, 2)->nullable()->after('ic2_type_5');
            $table->decimal('ic2_deduct_5', 15, 2)->nullable()->after('ic2_gross_5');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('income_from_entrepreneural_sustenance_activities', function (Blueprint $table) {
            //
        });
    }
};
