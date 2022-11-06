<?php

namespace Tests\Feature;

use App\Models\Horario;
use Illuminate\Support\Collection;
use Tests\Feature\Base\BaseResourceTest;

class HorarioAPITest
{
    protected string $baseUrl = 'horario';

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return Horario::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @return array
     */
    protected function storeData(): array
    {
        return [
        ];
    }

    /**
     * @param mixed $json
     * @return Collection
     */
    protected function hydrate($json): Collection
    {
        return Horario::hydrate($json);
    }
}
