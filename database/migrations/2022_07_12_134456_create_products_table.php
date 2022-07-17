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
            $table->integer('category');
            $table->integer('type');
            $table->integer('brand')->nullable();
            $table->integer('collection')->nullable();
            $table->integer('model')->nullable();
            $table->string('name');
            $table->integer('color');
            $table->integer('material');
            $table->longText('description')->nullable();
            $table->string('sku')->nullable();
            $table->integer('country');
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
