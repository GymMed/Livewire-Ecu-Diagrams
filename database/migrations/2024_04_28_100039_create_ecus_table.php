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
        Schema::create('ecus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dump_id');
            $table->string('ecu', 21)->nullable(false);
            $table->string('attribute', 100)->nullable(false);
            $table->string('value', 100)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecus');
    }
};
