<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Aureane dos Santos Moraes',
            'email' => 'aureane.moraes@outlook.com',
            'password' => bcrypt('12345678'),
            'cpf' => '006.070.922-70',
            'birthdate' => '1996-12-18',
            'is_admin' => 1,
            'rg' => '384364',
            'uf_rg' => 'AP',
            'gender' => 1,
            'ethnicity' => 1,
            'civil_status' => 1,
            'scholarity' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
