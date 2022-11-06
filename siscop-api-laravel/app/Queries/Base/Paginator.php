<?php

namespace App\Queries\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

/**
 *
 */
class Paginator
{
    /**
     * @var Query
     */
    private Query $query;

    private Builder $builder;

    public function __construct(Query $query)
    {
        $this->query = $query;
        $this->builder = $this->query->query();
    }

    /**
     * @param array $relations
     * @return $this
     */
    public function with(array $relations): Paginator
    {
        $this->builder = $this->builder->with($relations);
        return $this;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        $request = request();
        $page = $request->page;
        $per_page = $request->per_page;

        return $this->builder->paginate($per_page, ['*'], 'page', $page);
    }
}
