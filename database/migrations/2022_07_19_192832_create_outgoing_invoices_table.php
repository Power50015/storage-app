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
            $table->boolean('pay_type')->default(false); //if true pay cash
            $table->foreignId('driver_id')->nullable();
            $table->decimal('discount', $precision = 11, $scale = 2);
            $table->timestamp('date')->useCurrent();
            $table->foreignId('people_id');
            $table->foreignId('warehouse_id');
            $table->foreignId('cash_id')->nullable();
            $table->foreignId('user_id');
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
