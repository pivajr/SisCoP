<?php

namespace App\Queries\Select\Turma;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

class SelectByIdInstituicao extends Query
{
    private $turmaId;
    private $instituicaoId;

    public function __construct($turmaId, $instituicaoId)
    {
        $this->turmaId = $turmaId;
        $this->instituicaoId = $instituicaoId;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = (new SelectById($this->turmaId))->query($base);
        return (new SelectByInstituicao($this->instituicaoId))->query($baseQuery);
    }
}
