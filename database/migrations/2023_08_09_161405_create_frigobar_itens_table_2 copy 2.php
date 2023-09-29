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
        Schema::create('frigobar_iten', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frigobar_id')->references('id')->on('frigobar');
            $table->foreignId('iten_id')->references('id')->on('itens');
            $table->integer('quantidade');
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