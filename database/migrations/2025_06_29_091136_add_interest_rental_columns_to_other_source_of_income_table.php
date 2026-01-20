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
        Schema::table('other_source_of_income', function (Blueprint $table) {
            $table->decimal('interest_cash', 15, 2)->nullable()->after('imputed_rental_in_kind');
            $table->decimal('interest_in_kind', 15, 2)->nullable()->after('interest_cash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('other_source_of_income', function (Blueprint $table) {
            //
        });
    }
};
