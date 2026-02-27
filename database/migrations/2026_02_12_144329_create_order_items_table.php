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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->float('prijs');
            $table->integer('aantal');
            $table->foreignId('bestellingen_id')->constrained('bestellingen')->cascadeOnDelete();
            $table->foreignId('producten_id')->constrained('producten')->cascadeOnDelete();
            $table->foreignId('varianten_id')->constrained('varianten')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
