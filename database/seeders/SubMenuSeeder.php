<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conf_sub_menus')->insert([
            [
                'id' => 1,
                'menu_id' => 1,
                'description' => 'Pessoas',
                'icon' => 'nav-icon fa-solid fa-person',
                'route' => 'person',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'menu_id' => 1,
                'description' => 'Clientes',
                'icon' => 'nav-icon fa-solid fa-address-card',
                'route' => 'customer',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'menu_id' => 1,
                'description' => 'Fornecedores',
                'icon' => 'nav-icon fa-solid fa-truck',
                'route' => 'provider',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'menu_id' => 1,
                'description' => 'Plano de Contas',
                'icon' => 'nav-icon fa-solid fa-notebook',
                'route' => 'provider',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'menu_id' => 4,
                'description' => 'Usuários',
                'icon' => 'nav-icon fa-solid fa-users',
                'route' => 'users',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'menu_id' => 4,
                'description' => 'Empresa',
                'icon' => 'nav-icon fa-solid fa-building-memo',
                'route' => 'company',
                'actived' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}