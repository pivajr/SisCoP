<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\InstituicaoEnsino;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstituicaoEnsinoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstituicaoEnsino::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'instituicao_id' => Instituicao::factory(),
            'nivel' => $this->faker->randomElement(['F', 'M', 'S', 'P']),
            'qtd_estudantes' => $this->faker->numberBetween(10, 3000),
            'nivel_controle' => $this->faker->randomElement(['Funcionario', 'Estudantes', 'Ambos']),
            'tipo_instituicao' => $this->faker->randomElement(['M', 'E', 'F']),
        ];
    }
}
