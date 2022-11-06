<?php

namespace Tests\Unit\Queries\Select\Instituicao;

use App\Models\Instituicao;
use App\Queries\Select\Instituicao\SelectAll;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

/**
 * Class SelectAllTest
 * @package Tests\Unit\Queries\Select\Instituicao
 */
class SelectAllTest extends BaseSelectTest
{

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return Instituicao::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectAll())->query()->get();
    }
}
