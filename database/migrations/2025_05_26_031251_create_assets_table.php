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
        Schema::create('assets', function (Blueprint $table) {
            $table->id(); // auto-increment primary key
            $table->string('asset_hhid')->nullable();
            $table->unsignedBigInteger('asset_swdi_entry_id')->nullable();
            $table->string('asset_desc')->nullable();
            $table->decimal('asset_amt', 15, 2)->nullable(); // for monetary values
            $table->string('asset_lowb')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
