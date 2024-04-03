<?php

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Usuario;
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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->string('slug', 400);
            $table->integer('quantidade');
            $table->longText('descricao')->nullable();
            $table->boolean('publicacao')->default(0);
            $table->boolean('emEstoque')->default(0);
            $table->decimal('preco', 10, 2);
            $table->foreignIdFor(Usuario::class, 'created_by')->nullable();
            $table->foreignId(Usuario::class, 'updated_by')->nullable();
            $table->foreignIdFor(Marca::class, 'marca_id')->nullable();
            $table->foreignIdFor(Categoria::class, 'categoria_id')->nullable();
            $table->softDeletes();
            $table->foreignIdFor(Usuario::class, 'deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
