<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ativo' => $this->faker->boolean(),
            'nome' => $this->faker->name(),
            'senha' => '$2y$10$Mn2D83wmZ5NxJstCAp2qbelNgXuwRWhSJBOtiss1Il4jUEGxa.PNW', // Abc102030*
            'email' => $this->faker->email(),
            'telefone' => $this->faker->cellphoneNumber(),
            'estado' => $this->faker->randomElement(['AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RO', 'RS', 'RR', 'SC', 'SE', 'SP', 'TO']),
            'cidade' => $this->faker->city(),
            'data_nascimento' => $this->faker->date(),
            'avatar' => $this->faker->slug(),
        ];
    }
}
