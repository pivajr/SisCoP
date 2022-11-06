<?php
namespace Tests\Feature;

use App\Models\Funcionario;
use App\Models\Instituicao;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\Feature\Base\BaseResourceTest;

class FuncionarioAPITest extends BaseResourceTest
{
    protected string $baseUrl = 'funcionario';

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return Funcionario::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @return array
     */
    protected function storeData(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'senha' => $this->faker->randomNumber(5),
            'cpf_cnpj' => $this->faker->randomNumber(5),
            'ra' => $this->faker->randomNumber(5),
            'horario_flexivel' => $this->faker->boolean,
            'solicita_validacao' => $this->faker->boolean,
            'qtd_horas' => $this->faker->numberBetween(0, 24),
            'enderecos' => []
        ];
    }

    /**
     * @param mixed $json
     * @return Collection
     */
    protected function hydrate($json): Collection
    {
        return Funcionario::hydrate($json);
    }
}
