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
        Schema::create('returned_incoming_invoice_kits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->timestamp('date')->useCurrent();
            $table->integer('quantity');
            $table->foreignId('incoming_invoice_id');
            $table->foreignId('kit_id');
            $table->foreignId('user_id');
            $table->foreignId('people_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returned_incoming_invoice_kits');
    }
};
