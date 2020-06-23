<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->decimal('cantidad', 8, 2);
            $table->integer('numero_pagos');
            $table->decimal('cuota', 8, 2);
            $table->decimal('total', 8, 2);
            $table->dateTime('fecha_ministracion',0);
            $table->dateTime('fecha_vencimiento',0);
            $table->timestamps();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
