<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::create([
            'titulo' => 'Officia dolor veniam velit enim ullamco dolor commodo adipisicing sint duis.',
            'preco' => 18.99,
            'quantidade' => 3,
            'categoria_id' => 1,
            'marca_id' => 2,
            'descricao' => 'Eu aute consectetur est laboris sunt excepteur anim magna id proident eiusmod in. Voluptate anim proident do duis adipisicing labore. Dolor culpa ea est quis tempor ea fugiat. Dolore aliquip eiusmod ad in minim anim amet id tempor qui est. Tempor occaecat sint non incididunt laboris irure ea nulla dolore.'
        ]);
    }
}
