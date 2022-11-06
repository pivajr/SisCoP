<?php

namespace App\Queries\Select\InstituicaoUser;

use App\Models\InstituicaoUser;
use App\Queries\Select\Common\SelectAll;
use Illuminate\Database\Eloquent\Builder;

class SelectByUser extends SelectAll
{
    private int $user;
    private $instituicao;

    public function __construct(int $user, int $instituicao = null)
    {
        $this->instituicao = $instituicao;
        $this->user = $user;
        parent::__construct(InstituicaoUser::class);
    }

    public function query(Builder $base = null): Builder
    {
        $baseQuery = $baseQuery = $base ?? (new SelectAll(InstituicaoUser::class))->query();
        $query = $baseQuery->where('user_id', $this->user);

        if (!empty($this->instituicao)) {
            return $query->where('instituicao_id', $this->instituicao);
        }

        return $query;
    }
}
