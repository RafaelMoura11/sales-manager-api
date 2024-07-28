<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Produto A', 'category' => 'Eletrônicos', 'price' => 150.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Produto B', 'category' => 'Eletrodomésticos', 'price' => 300.50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Produto C', 'category' => 'Roupas', 'price' => 75.99, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Produto D', 'category' => 'Móveis', 'price' => 450.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Produto E', 'category' => 'Acessórios', 'price' => 25.50, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
