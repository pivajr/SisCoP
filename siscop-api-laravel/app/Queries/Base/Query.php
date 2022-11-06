<?php

namespace App\Queries\Base;

abstract class Query implements IQuery
{
    public function first()
    {
        return $this->query()->first();
    }

    public function firstOrFail()
    {
        return $this->query()->firstOrFail();
    }

    public function count(): int
    {
        return $this->query()->count();
    }
}
