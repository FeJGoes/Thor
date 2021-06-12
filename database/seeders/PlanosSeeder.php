<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('planos')->insert([
            ['ativo' => true, 'tipo' => 'Free', 'mensalidade' => 0.00],
            ['ativo' => true, 'tipo' => 'Basic', 'mensalidade' => 100.00],
            ['ativo' => true, 'tipo' => 'Plus', 'mensalidade' => 187.00],
        ]);
    }
}
