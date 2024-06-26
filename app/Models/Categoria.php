<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Categoria extends Model
{   
    use HasSlug;
    use HasFactory;

    protected $fillable = ['nome', 'slug'];

    public function protudos(){

        return $this->hasMany(Produto::class);

    }

    public function getSlugOptions(): SlugOptions {

        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
