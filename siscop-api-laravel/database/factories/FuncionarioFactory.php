<?php

namespace Database\Factories;

use App\Models\Funcionario;
use App\Models\Instituicao;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Funcionario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'instituicao_id' => Instituicao::factory(),
            'horario_flexivel' => $this->faker->boolean,
            'solicita_validacao' => $this->faker->boolean,
            'qtd_horas' => $this->faker->numberBetween(0, 24),
        ];
    }
}
