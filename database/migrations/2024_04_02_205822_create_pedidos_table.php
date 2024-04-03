<?php

use App\Models\Usuario;
use App\Models\UsuarioEndereco;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpParser\Builder\Use_;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('preco_total', 20,2);
            $table->string('status', 45);
            $table->string('session_id', 255);
            $table->foreignIdFor(UsuarioEndereco::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Usuario::class, 'created_by')->nullable();
            $table->foreignIdFor(Usuario::class, 'updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
