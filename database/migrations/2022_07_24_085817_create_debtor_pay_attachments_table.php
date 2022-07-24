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
        Schema::create('debtor_pay_attachments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('attachment');
            $table->foreignId('user');
            $table->foreignId('debtor_pay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debtor_pay_attachments');
    }
};
