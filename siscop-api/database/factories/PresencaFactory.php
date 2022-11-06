<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\Presenca;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresencaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Presenca::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'turma_id' => Turma::factory(),
            'instituicao_id' => Instituicao::factory(),
            'data_presenca' => $this->faker->dateTimeBetween('-5weeks'),
        ];
    }
}
