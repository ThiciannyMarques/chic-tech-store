<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marca::create([
            'nome' => 'Dell',
            'slug' => 'dell'
        ]);
        Marca::create([
            'nome' => 'Samsung',
            'slug' => 'samsung'
        ]);
        Marca::create([
            'nome' => 'Asus',
            'slug' => 'asus'
        ]);
    }
}
