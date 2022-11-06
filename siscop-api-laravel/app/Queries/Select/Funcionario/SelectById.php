<?php

namespace App\Queries\Select\Funcionario;

use App\Models\Funcionario;
use App\Queries\Select\Common\SelectById as SelectByIdCommon;

class SelectById extends SelectByIdCommon
{
    public function __construct(int $id)
    {
        parent::__construct(Funcionario::class, $id);
    }
}
