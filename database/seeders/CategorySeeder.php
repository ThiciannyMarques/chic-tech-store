<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categories::create([
            'name' => 'Computador',
            'slug' => 'dell'
        ]);
        Categories::create([
            'name' => 'Notebook',
            'slug' => 'samsung'
        ]);
        Categories::create([
            'name' => 'Celular',
            'slug' => 'asus'
        ]);
    }
}
