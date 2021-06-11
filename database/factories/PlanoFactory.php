<?php

namespace Database\Factories;

use App\Models\Plano;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plano::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ativo' => $this->faker->boolean(),
            'tipo' => $this->faker->randomElement(['Free','Basic','Plus']),
            'mensalidade' => $this->faker->randomFloat(2,100,500),
        ];
    }
}
