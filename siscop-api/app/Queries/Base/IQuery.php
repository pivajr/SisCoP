<?php
namespace App\Queries\Base;

use Illuminate\Database\Eloquent\Builder;

interface IQuery
{
    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder;
}
