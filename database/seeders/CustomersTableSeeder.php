<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            ['name' => 'João Silva', 'email' => 'joao.silva@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Maria Oliveira', 'email' => 'maria.oliveira@example.com', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carlos Souza', 'email' => 'carlos.souza@example.com', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
