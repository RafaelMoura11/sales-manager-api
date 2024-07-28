<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    public function run()
    {
        $userCpf = '12345678901'; // Exemplo de CPF de um usuário existente

        $sales = [
            ['user_cpf' => $userCpf, 'customer_id' => 1, 'product_id' => 1, 'quantity' => 2, 'final_price' => 150.00 * 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 2, 'product_id' => 2, 'quantity' => 1, 'final_price' => 300.50, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 3, 'product_id' => 3, 'quantity' => 5, 'final_price' => 75.99 * 5, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 1, 'product_id' => 4, 'quantity' => 3, 'final_price' => 450.00 * 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 2, 'product_id' => 5, 'quantity' => 4, 'final_price' => 25.50 * 4, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 3, 'product_id' => 1, 'quantity' => 1, 'final_price' => 150.00, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 1, 'product_id' => 2, 'quantity' => 2, 'final_price' => 300.50 * 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 2, 'product_id' => 3, 'quantity' => 3, 'final_price' => 75.99 * 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 3, 'product_id' => 4, 'quantity' => 1, 'final_price' => 450.00, 'created_at' => now(), 'updated_at' => now()],
            ['user_cpf' => $userCpf, 'customer_id' => 1, 'product_id' => 5, 'quantity' => 2, 'final_price' => 25.50 * 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('sales')->insert($sales);
    }
}
