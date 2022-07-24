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
        Schema::create('incoming_invoice_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user');
            $table->foreignId('incoming_invoice');
            $table->foreignId('product');
            $table->decimal('price', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('incoming_invoice_contents');
    }
};
