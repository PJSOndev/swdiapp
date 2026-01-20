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
        Schema::create('tbl_soi', function (Blueprint $table) {
            $table->id();
            $table->string('osi_hhid')->index()->nullable(); // Household ID
            $table->string('osi_lowb')->nullable(); // Line of Work/Business
            $table->decimal('osi_reciept_in_cash', 12, 2)->nullable();
            $table->decimal('osi_reciept_in_kind', 12, 2)->nullable();
            $table->decimal('osi_reciept_subtotal', 12, 2)->nullable();
            $table->decimal('osi_aid_in_cash', 12, 2)->nullable();
            $table->decimal('osi_aid_in_kind', 12, 2)->nullable();
            $table->decimal('osi_subtotal', 12, 2)->nullable();
            $table->string('osi_support')->nullable(); // e.g. donor/organization name
            $table->decimal('osi_support_in_cash', 12, 2)->nullable();
            $table->decimal('osi_support_in_kind', 12, 2)->nullable();
            $table->decimal('osi_support_subtotal', 12, 2)->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_soi');
    }
};
