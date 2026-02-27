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
        Schema::table('categorieen', function (Blueprint $table) {
            $table->unique('naam');
        });

        Schema::table('allergieen', function (Blueprint $table) {
            $table->unique('naam');
        });

        Schema::table('varianten', function (Blueprint $table) {
            $table->unique('naam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
