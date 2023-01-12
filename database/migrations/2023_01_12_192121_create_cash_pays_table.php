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
        Schema::create('cash_pays', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->foreignId('cash_id');
            $table->foreignId('user_id');
            $table->decimal('amount', $precision = 11, $scale = 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_pays');
    }
};
