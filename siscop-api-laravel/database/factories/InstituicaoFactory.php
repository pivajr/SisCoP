<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\InstituicaoStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstituicaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instituicao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->numberBetween(9999, 999999),
            'atividade' => $this->faker->word,
            'responsavel_id' => User::factory(),
            'qtd_funcionarios' => $this->faker->numberBetween(30, 9999),
            'instituicao_status_id' => fn () => optional(InstituicaoStatus::where('slug', 'aprovado')->first())->id ?? InstituicaoStatus::factory()->aprovado()->create()->id
        ];
    }
}
