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
        Schema::create('kits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('image');
            $table->foreignId('product_category_id')->nullable();
            $table->foreignId('product_type_id')->nullable();
            $table->foreignId('product_brand_id')->nullable();
            $table->foreignId('product_collection_id')->nullable();
            $table->foreignId('product_model_id')->nullable();
            $table->foreignId('product_color_id')->nullable();
            $table->foreignId('product_material_id')->nullable();
            $table->foreignId('product_country_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('user_id');
            $table->integer('stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kits');
    }
};
