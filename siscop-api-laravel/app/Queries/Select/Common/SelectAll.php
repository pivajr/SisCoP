<?php

namespace App\Queries\Select\Common;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectAll
 * @package App\Queries\Select\Common
 * @template T of \Illuminate\Database\Eloquent\Model
 */
class SelectAll extends Query
{
    /**
     * @var string
     */
    private string $model;

    /**
     * SelectAll constructor.
     * @param class-string<T> $model
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        return forward_static_call([$this->model, 'query']);
    }
}
