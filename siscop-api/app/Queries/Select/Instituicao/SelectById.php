<?php


namespace App\Queries\Select\Instituicao;

use App\Models\Instituicao;
use App\Queries\Select\Common\SelectById as SelectByIdCommon;

class SelectById extends SelectByIdCommon
{
    public function __construct(int $id)
    {
        parent::__construct(Instituicao::class, $id);
    }
}
