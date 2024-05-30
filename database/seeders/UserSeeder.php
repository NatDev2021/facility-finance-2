<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'document' => '11111111111',
                'name' => 'Adminitrador',
                'email' => 'admin@admin.com',
                'email_verified_at' => date("Y-m-d H:i:s"),
                'password' => Hash::make('admin@' . date("Y")),
                'actived' => true,
                'profile' => 'admin',
                'image_profile' => 'avatar.png',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
