<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\InstituicaoEndereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstituicaoEnderecoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstituicaoEndereco::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'instituicao_id' => Instituicao::factory(),
            'cep' => $this->faker->postcode,
            'uf' => $this->faker->state,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->streetSuffix,
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->buildingNumber,
            'complemento' => '',
        ];
    }
}
