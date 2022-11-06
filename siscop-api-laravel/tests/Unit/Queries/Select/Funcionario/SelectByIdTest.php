<?php


namespace Queries\Select\Funcionario;


use App\Models\Funcionario;
use App\Queries\Select\Funcionario\SelectById;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

/**
 * Class SelectByIdTest
 * @package Queries\Select\Funcionario
 */
class SelectByIdTest extends BaseSelectTest
{
    /**
     * @var Collection
     */
    private Collection $funcionario;

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        $instituicoes = Funcionario::newFactory()->count($this->qtd_registros)->create();
        $this->funcionario = $instituicoes->random(1);

        return $instituicoes;
    }

    /**
     * @return Collection|null
     */
    protected function expected(): ?Collection
    {
        return $this->funcionario;
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectById($this->funcionario->first()->id))->query()->get();
    }
}
