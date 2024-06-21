<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company')->insert([
            [
                'id' => 1,
                'document' => '11111111111111',
                'company_name' => 'Sua Empresa',

            ]
        ]);
    }
}
