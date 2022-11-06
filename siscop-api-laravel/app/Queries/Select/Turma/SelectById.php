<?php

namespace App\Queries\Select\Turma;

use App\Models\Turma;
use App\Queries\Select\Common\SelectById as SelectByIdCommon;

class SelectById extends SelectByIdCommon
{
    public function __construct(int $id)
    {
        parent::__construct(Turma::class, $id);
    }
}
