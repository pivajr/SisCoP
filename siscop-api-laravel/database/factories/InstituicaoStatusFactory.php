<?php

namespace Database\Factories;

use App\Models\InstituicaoStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstituicaoStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InstituicaoStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

        ];
    }

    /**
     * @return InstituicaoStatusFactory
     */
    public function pendente()
    {
        return $this->registerStatusState('Pendente de Aprovação');
    }

    /**
     * @return InstituicaoStatusFactory
     */
    public function aprovado()
    {
        info('>>> aprovado');
        return $this->registerStatusState('Aprovado');
    }

    /**
     * @return InstituicaoStatusFactory
     */
    public function reprovado()
    {
        return $this->registerStatusState('Reprovado');
    }

    /**
     * @return InstituicaoStatusFactory
     */
    public function desativado()
    {
        return $this->registerStatusState('Desativado');
    }

    /**
     * @param string $status
     * @return InstituicaoStatusFactory
     */
    private function registerStatusState(string $status)
    {
        return $this->state(function (array $attributes) use ($status) {
            return [
                'nome' => $status,
                'slug' => Str::slug($status)
            ];
        });
    }
}
