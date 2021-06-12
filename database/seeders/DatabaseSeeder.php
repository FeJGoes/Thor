<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Plano;
use App\Models\Relationships\ClientePlano;
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
        $this->call([
            ClientesSeeder::class,
            PlanosSeeder::class,
        ]);

        $planos = Plano::pluck('id');

        Cliente::all()->each(function($cliente) use ($planos) {
            ClientePlano::create([
                'cliente_id' => $cliente->id,
                'plano_id' => $planos->random()
            ]);
        });
    }
}
