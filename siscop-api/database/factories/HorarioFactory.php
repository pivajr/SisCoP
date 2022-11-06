<?php

namespace Database\Factories;

use App\Models\Horario;
use App\Models\Funcionario;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Horario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $horarioEntrada = now();
        $horarioSaida   = $horarioEntrada->addHours(5);

        return [
            'dia_semana' => $this->faker->numberBetween(1, 7),
            'horario_entrada' => $horarioEntrada->format('H:i:s'),
            'horario_saida' => $horarioSaida->format('H:i:s'),
            'funcionario_id' => Funcionario::factory(),
            'user_id' => User::factory(),
            'turma_id' => Turma::factory(),
        ];
    }
}
