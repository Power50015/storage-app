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
        Schema::create('returned_outgoing_invoice_notes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('tag')->nullable();
            $table->text('note');
            $table->foreignId('user_id');
            $table->foreignId('returned_outgoing_invoice_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returned_outgoing_invoice_notes');
    }
};
