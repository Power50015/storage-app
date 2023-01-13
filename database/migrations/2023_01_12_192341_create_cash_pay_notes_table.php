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
        Schema::create('cash_pay_notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('tag')->nullable();
            $table->text('note');
            $table->foreignId('user_id');
            $table->foreignId('cash_pay_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_pay_notes');
    }
};