<?php

namespace App\Queries\Select\Common;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectBySlug
 * @package App\Queries\Select\Common
 * @template T of \Illuminate\Database\Eloquent\Model
 */
class SelectBySlug extends Query
{
    /**
     * @var string
     */
    private string $model;
    /**
     * @var string
     */
    private string $slug;

    /**
     * SelectById constructor.
     * @param class-string<T> $model
     * @param string $slug
     */
    public function __construct(string $model, string $slug)
    {
        $this->model = $model;
        $this->slug = $slug;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? forward_static_call([$this->model, 'query']);
        return $baseQuery->where('slug', $this->slug);
    }
}
