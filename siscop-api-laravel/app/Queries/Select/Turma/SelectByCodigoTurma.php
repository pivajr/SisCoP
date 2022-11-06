<?php

namespace App\Queries\Select\Turma;

use App\Models\Turma;
use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

class SelectByCodigoTurma extends Query
{
    /**
     * @var string
     */
    private $codigoTurma;

    /**
     * @param string $codigoTurma
     */
    public function __construct(string $codigoTurma)
    {
        $this->codigoTurma = $codigoTurma;
    }
    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? Turma::query();
        return $baseQuery->where('codigo_turma', $this->codigoTurma);
    }
}
