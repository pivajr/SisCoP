<?php

namespace Database\Factories;

use App\Models\Instituicao;
use App\Models\InstituicaoUser;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstituicaoUserFactory extends Factory
{
    protected $model = InstituicaoUser::class;
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
        ];
    }

    /**
     * @return InstituicaoUserFactory
     */
    public function admin(): InstituicaoUserFactory
    {
        return $this->state(fn(array $attributes) => [
           'perfil_id' =>fn() => Perfil::where('slug', 'administrador')->first()->id
        ]);
    }

    public function basico(): InstituicaoUserFactory
    {
        return $this->state(fn(array $attributes) => [
            'perfil_id' =>fn() => Perfil::where('slug', 'basico')->first()->id
        ]);
    }
}
