<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TurmaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Turma::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'instituicao_id' => Instituicao::factory(),
            'user_id' => User::factory(),
            'codigo_turma' => $this->faker->randomLetter.$this->faker->numberBetween(0, 9999),
            'curso' => $this->faker->name,
            'semestre' => $this->faker->randomDigit,
            'disciplina' => $this->faker->name,
        ];
    }
}
