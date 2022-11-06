<?php

namespace App\Queries\Select\Turma;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

class SelectByUserInstituicao extends Query
{
    private $userId;
    private $instituicaoId;

    public function __construct($userId, $instituicaoId)
    {
        $this->userId = $userId;
        $this->instituicaoId = $instituicaoId;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = (new SelectByUser($this->userId))->query($base);
        return (new SelectByInstituicao($this->instituicaoId))->query($baseQuery);
    }
}
