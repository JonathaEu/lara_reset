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
        Schema::create('frigobar_itens', function (Blueprint $table) {
            $table->foreignId('cod_frig')->references('id')->on('frigobar');
            $table->foreignId('cod_itens')->references('id')->on('itens');
            $table->integer('qtd consumida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frigobar_itens');
    }
};
