<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conf_menu')->insert([
            [
                'id' => 1,
                'description' => 'Cadastro',
                'icon' => 'nav-icon fa fa-clipboard',
                'actived' => true
            ],
            [
                'id' => 2,
                'description' => 'Movimentação',
                'icon' => 'nav-icon nav-icon fa-solid fa-money-check-dollar',
                'actived' => true
            ],
            [
                'id' => 3,
                'description' => 'Financeiro',
                'icon' => 'nav-icon fas fa-phone-square',
                'actived' => true
            ],
            [
                'id' => 4,
                'description' => 'Gerencial',
                'icon' => 'nav-icon fas fa-sliders-h',
                'actived' => true
            ],
            [
                'id' => 5,
                'description' => 'Relatórios',
                'icon' => 'nav-icon fa-solid fa-book',
                'actived' => true
            ],
            [
                'id' => 6,
                'description' => 'Integração',
                'icon' => 'nav-icon fa-regular fa-circle-nodes',
                'actived' => true
            ]
        ]);
    }
}
