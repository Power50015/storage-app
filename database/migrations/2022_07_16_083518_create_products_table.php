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
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('sku')->nullable();
            $table->text('image');
            $table->foreignId('product_category_id');
            $table->foreignId('product_type_id');
            $table->foreignId('product_brand_id')->nullable();
            $table->foreignId('product_collection_id')->nullable();
            $table->foreignId('product_model_id')->nullable();
            $table->foreignId('product_color_id');
            $table->foreignId('product_material_id');
            $table->foreignId('product_country_id');
            $table->decimal('price', $precision = 11, $scale = 2)->nullable();
            $table->foreignId('user_id');
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
