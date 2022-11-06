<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Collection;
use Tests\Feature\Base\BaseResourceTest;

class UserAPITest extends BaseResourceTest
{
    /**
     * @var string
     */
    protected string $baseUrl = 'usuario';

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return User::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @param mixed $json
     * @return Collection
     */
    protected function hydrate($json): Collection
    {
        return User::hydrate($json);
    }

    /**
     * @return array
     */
    protected function storeData(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->randomNumber(5),
            'cpf_cnpj' => $this->faker->randomNumber(5),
            'ra' => $this->faker->randomNumber(5)
        ];
    }

    protected function storeArrayData(): array
    {
        $usuarios = [$this->storeData()];
        return compact('usuarios');
    }
}
