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
        Schema::create('incoming_invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user');
            $table->integer('supplier');
            $table->string('number');
            $table->boolean('pay_type')->default(false); //if true pay cash
            $table->integer('cash_type')->nullable();
            $table->decimal('discount', $precision = 8, $scale = 2);
            $table->decimal('total', $precision = 8, $scale = 2);
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incoming_invoices');
    }
};
