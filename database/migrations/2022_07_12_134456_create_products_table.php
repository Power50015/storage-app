<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category');
            $table->foreignId('type');
            $table->foreignId('brand')->nullable();
            $table->foreignId('collection')->nullable();
            $table->foreignId('model')->nullable();
            $table->string('name');
            $table->foreignId('color');
            $table->foreignId('material');
            $table->longText('description')->nullable();
            $table->string('sku')->nullable();
            $table->foreignId('country');
            $table->text('image');
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
