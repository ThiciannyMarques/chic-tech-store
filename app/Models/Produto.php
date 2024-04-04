<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Produto extends Model
{
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'publicacao',
        'emEstoque',
        'preco',
        'created_by',
        'deleted_by',
        'updated_by'
    ];


    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('titulo')
            ->saveSlugsTo('slug');
    }

    public function produto_imagens(){
        return $this->hasMany(ProdutoImagem::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }



}
