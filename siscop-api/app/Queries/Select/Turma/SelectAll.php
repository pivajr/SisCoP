<?php

namespace App\Queries\Select\Turma;

use App\Models\Turma;
use App\Queries\Select\Common\SelectAll as SelectAllCommon;

/**
 * Class SelectAll
 * @package App\Queries\Select\Turma
 */
class SelectAll extends SelectAllCommon
{
    /**
     * SelectAll constructor.
     */
    public function __construct()
    {
        parent::__construct(Turma::class);
    }
}
