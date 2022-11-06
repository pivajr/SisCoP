<?php

namespace App\Queries\Select\Turma;

use App\Models\Turma;
use \App\Queries\Select\Common\SelectByInstituicao as SelectByInstituicaoCommon;

class SelectByInstituicao extends SelectByInstituicaoCommon
{
    public function __construct(int $instituicao_id)
    {
        parent::__construct(Turma::class, $instituicao_id);
    }
}
