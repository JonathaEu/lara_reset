<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quartos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('numero');
            $table->float('valor');
            $table->integer('max_cap');
            $table->foreignId('fk_tipo_qrt')->references('id')->on('tipo_quarto');
            $table->foreignId('fk_cliente')->references('id')->on('clientes');
            $table->foreignId('fk_frigobar')->references('id')->on('frigobar');
            $table->foreignId('fk_estacionamento')->references('id')->on('estacionamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quartos');
    }
};
