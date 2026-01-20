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
        Schema::table('users', function (Blueprint $table) {
            // Add new columns
            $table->unsignedBigInteger('area_assigned_id')
                  ->nullable()
                  ->after('email');

            $table->enum('role', ['CL/ML', 'RPMO', 'RPC', 'Admin', 'SWO III', 'RD'])
                  ->default('CL/ML')
                  ->after('area_assigned_id');

            // Optional: foreign key if you have an 'areas' table
            // $table->foreign('area_assigned_id')
            //       ->references('id')
            //       ->on('areas')
            //       ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key first if enabled
            // $table->dropForeign(['area_assigned_id']);

            $table->dropColumn(['area_assigned_id', 'role']);
        });
    }
};
