<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_method')->insert([
            [
                'id' => 1,
                'description' => 'Dinheiro',

            ],
            [
                'id' => 2,
                'description' => 'Boleto Bancário',

            ],
            [
                'id' => 3,
                'description' => 'Carnê',
            ],
            [
                'id' => 4,
                'description' => 'Pix',

            ],
            [
                'id' => 5,
                'description' => 'Cheque',
            ]
        ]);
    }
}
