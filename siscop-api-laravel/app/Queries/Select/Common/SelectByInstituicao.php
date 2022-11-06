<?php

namespace App\Queries\Select\Common;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectById
 * @package App\Queries\Select\Common
 * @template T of \Illuminate\Database\Eloquent\Model
 */
class SelectByInstituicao extends Query
{
    /**
     * @var string
     */
    private string $model;
    /**
     * @var int
     */
    private int $id;

    /**
     * SelectById constructor.
     * @param class-string<T> $model
     * @param int $id
     */
    public function __construct(string $model, int $id)
    {
        $this->model = $model;
        $this->id = $id;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? forward_static_call([$this->model, 'query']);
        return $baseQuery->where('instituicao_id', $this->id);
    }
}
