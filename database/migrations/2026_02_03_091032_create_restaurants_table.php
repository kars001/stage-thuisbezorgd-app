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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('naam');
            $table->text('beschrijving');
            $table->string('adres')->nullable();
            $table->json('bezorggebied');
            $table->json('open_en_sluit_tijden');
            $table->float('minimaal_bestelbedrag')->nullable();
            $table->float('bezorgkosten')->nullable();
            $table->string('status');
            $table->string('logo_url')->nullable();
            $table->string('header_url')->nullable();
        });

        Schema::create('producten', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->foreignId('restaurant_id')->constrained('restaurants')->cascadeOnDelete();
            $table->string('naam');
            $table->text('beschrijving');
            $table->float('prijs');
        });

        //Varianten
        Schema::create('varianten', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('naam');
        });

        Schema::create('variant_product', function (Blueprint $table) {
            $table->foreignId('variant_id')->constrained('varianten')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('producten')->cascadeOnDelete();
            $table->primary(['variant_id', 'product_id']);
            $table->float('extra_prijs')->nullable();
        });

        //Allergieen
        Schema::create('allergieen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('naam');
        });

        Schema::create('allergie_product', function (Blueprint $table) {
            $table->foreignId('allergie_id')->constrained('allergieen')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('producten')->cascadeOnDelete();
            $table->primary(['allergie_id', 'product_id']);
        });

        //Categorieen
        Schema::create('categorieen', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletesDatetime();
            $table->string('naam');
        });

        Schema::create('categorie_product', function (Blueprint $table) {
            $table->foreignId('categorie_id')->constrained('categorieen')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('producten')->cascadeOnDelete();
            $table->primary(['categorie_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
        Schema::dropIfExists('producten');

        Schema::dropIfExists('varianten');
        Schema::dropIfExists('variant_product');

        Schema::dropIfExists('allergieen');
        Schema::dropIfExists('allergie_product');

        Schema::dropIfExists('categorieen');
        Schema::dropIfExists('categorie_product');
    }
};
