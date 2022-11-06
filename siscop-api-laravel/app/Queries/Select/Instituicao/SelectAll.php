<?php

namespace App\Queries\Select\Instituicao;

use App\Models\Instituicao;
use App\Queries\Base\Query;
use App\Queries\Select\Common\SelectAll as SelectAllCommon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectAll
 * @package App\Queries\Select\Instituicao
 */
class SelectAll extends SelectAllCommon
{
    /**
     * SelectAll constructor.
     */
    public function __construct()
    {
        parent::__construct(Instituicao::class);
    }
}
