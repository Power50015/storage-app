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
        Schema::create('outgoing_invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user');
            $table->foreignId('customer');
            $table->boolean('pay_type')->default(false); //if true pay cash
            $table->foreignId('cash_type')->nullable();
            $table->decimal('discount', $precision = 8, $scale = 2);
            $table->date('date');
            $table->foreignId('warehouse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outgoing_invoices');
    }
};
