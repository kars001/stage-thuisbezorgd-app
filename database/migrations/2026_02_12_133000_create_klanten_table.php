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
        Schema::create('klanten', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('adres');
            $table->string('email')->unique();
            $table->string('telefoonnummer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klanten');
    }
};
