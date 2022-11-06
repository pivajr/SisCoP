<?php

namespace Tests\Unit\Queries\Select\Instituicao;

use App\Models\Instituicao;
use App\Queries\Select\Instituicao\SelectById;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

/**
 * Class SelectByIdTest
 * @package Tests\Unit\Queries\Select\Instituicao
 */
class SelectByIdTest extends BaseSelectTest
{
    private Collection $instituicao;

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        $instituicoes = Instituicao::newFactory()->count($this->qtd_registros)->create();
        $this->instituicao = $instituicoes->random(1);

        return $instituicoes;
    }

    /**
     * @return Collection|null
     */
    protected function expected(): ?Collection
    {
        return $this->instituicao;
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectById($this->instituicao->first()->id))->query()->get();
    }
}
