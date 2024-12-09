<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'title' => 'Officia dolor veniam velit enim ullamco dolor commodo adipisicing sint duis.',
            'price' => 18.99,
            'quantity' => 3,
            'category_id' => 1,
            'brand_id' => 2,
            'description' => 'Eu aute consectetur est laboris sunt excepteur anim magna id proident eiusmod in. Voluptate anim proident do duis adipisicing labore. Dolor culpa ea est quis tempor ea fugiat. Dolore aliquip eiusmod ad in minim anim amet id tempor qui est. Tempor occaecat sint non incididunt laboris irure ea nulla dolore.'
        ]);
    }
}
