<?php

namespace Tests\Unit\Queries\Select\User;

use App\Models\User;
use App\Queries\Select\User\SelectAll;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

class SelectAllTest extends BaseSelectTest
{
    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        return User::newFactory()->count($this->qtd_registros)->create();
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectAll())->query()->get();
    }
}
