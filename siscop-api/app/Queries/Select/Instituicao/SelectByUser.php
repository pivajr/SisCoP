<?php

namespace App\Queries\Select\Instituicao;

use App\Models\Instituicao;
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
        $baseQuery = $base ?? Instituicao::query();

        return $baseQuery->join('instituicao_users as iu', 'iu.instituicao_id', '=', 'instituicoes.id')->
                            where('iu.user_id', $this->userId)->select('instituicoes.*');
    }
}
