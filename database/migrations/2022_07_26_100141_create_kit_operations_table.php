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
        Schema::create('kit_operations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('action');
            $table->foreignId('user_id');
            $table->foreignId('kit_id');
            $table->foreignId('warehouse_id');
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kit_operations');
    }
};
