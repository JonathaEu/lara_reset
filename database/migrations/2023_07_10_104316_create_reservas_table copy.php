<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')->references('id')->on('clientes');
            $table->foreignId('quartos_id')->references('id')->on('quartos');
            $table->foreignId('users_id')->references('id')->on('Users');
            $table->enum('status', ['pendente', 'cancelado', 'iniciado', 'finalizado']);
            $table->date('dt_inicial');
            $table->date('dt_final');
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
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