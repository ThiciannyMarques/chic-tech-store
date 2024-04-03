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
        Schema::create('usuario_enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 45);
            $table->string('endereco1', 255);
            $table->string('endereco2', 255)->nullable();
            $table->string('cidade', 255);
            $table->string('estado', 45)->nullable();
            $table->string('codigo_postal', 45);
            $table->boolean('principal')->default(1);
            $table->foreignId('usuario_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_enderecos');
    }
};
