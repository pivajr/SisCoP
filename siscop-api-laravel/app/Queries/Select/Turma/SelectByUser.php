<?php

namespace App\Queries\Select\Turma;

use App\Models\Turma;
use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

class SelectByUser extends Query
{
    private int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? Turma::query();
        return $baseQuery->where('user_id', $this->userId);
    }
}
