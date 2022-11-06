<?php

namespace Tests\Unit\Queries\Select\User;

use App\Models\User;
use App\Queries\Select\User\SelectById;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

class SelectByIdTest extends BaseSelectTest
{
    /**
     * @var Collection
     */
    private Collection $user;

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        $users = User::newFactory()->count($this->qtd_registros)->create();
        $this->user = $users->random(1);
        return $users;
    }

    protected function expected(): Collection
    {
        return $this->user;
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectById($this->user->first()->id))->query()->get();
    }
}
