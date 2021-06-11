<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Plano;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cliente::factory()
            ->has(Plano::factory(), 'planos')
            ->count(25)
            ->create();

    }
}
