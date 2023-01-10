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
        Schema::create('returned_outgoing_invoice_contents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('price', $precision = 11, $scale = 2);
            $table->integer('quantity');
            $table->foreignId('returned_outgoing_invoice_id');
            $table->foreignId('product_id');
            $table->foreignId('user_id');
            $table->foreignId('people_id')->nullable();
            $table->foreignId('warehouse_id');
            $table->timestamp('date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returned_outgoing_invoice_contents');
    }
};
