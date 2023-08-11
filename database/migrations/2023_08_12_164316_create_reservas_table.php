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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_cliente')->references('id')->on('clientes');
            $table->foreignId('fk_quarto')->references('id')->on('quartos');
            $table->foreignId('fk_funcionario')->references('id')->on('Users');
            $table->foreignId('fk_consumo')->references('id')->on('consumo');
            $table->enum('status', ['pendente', 'cancelado', 'iniciado', 'finalizado']);
            $table->date('dt_reserva');
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->float('valor_diaria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
