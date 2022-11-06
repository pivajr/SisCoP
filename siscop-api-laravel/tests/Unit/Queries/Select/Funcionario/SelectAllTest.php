<?php

namespace Queries\Select\Funcionario;

use App\Models\Funcionario;
use App\Queries\Select\Funcionario\SelectAll;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

/**
 * Class SelectAllTest
 * @package Queries\Select\Funcionario
 */
class SelectAllTest extends BaseSelectTest
{
    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return Funcionario::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectAll())->query()->get();
    }
}
