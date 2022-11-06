<?php

namespace App\Queries\Select\Funcionario;

use App\Models\Funcionario;
use App\Queries\Select\Common\SelectAll as SelectAllCommon;

class SelectAll extends SelectAllCommon
{
    /**
     * SelectAll constructor.
     */
    public function __construct()
    {
        parent::__construct(Funcionario::class);
    }
}
