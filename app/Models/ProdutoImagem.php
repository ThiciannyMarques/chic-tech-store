<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoImagem extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'imagem'
    ];

    function produto(){
        return $this->belongsTo(Produto::class);
    }

}
