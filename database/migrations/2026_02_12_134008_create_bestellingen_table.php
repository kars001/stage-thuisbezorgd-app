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
        Schema::create('bestellingen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('status');
            $table->float('verzendkosten')->nullable();
            $table->float('totaalprijs')->nullable();
            $table->foreignId('klanten_id')->constrained('klanten')->cascadeOnDelete();
            $table->foreignId('restaurant_id')->constrained('restaurants')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bestellingen');
    }
};
