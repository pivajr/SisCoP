<?php

namespace App\Queries\Select\Horario;

use App\Models\Horario;
use App\Queries\Base\Query;
use App\Queries\Select\Common\SelectAll as SelectAllCommon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectAll
 * @package App\Queries\Select\Horario
 */
class SelectAll extends SelectAllCommon
{
    /**
     * SelectAll constructor.
     */
    public function __construct()
    {
        parent::__construct(Horario::class);
    }
}
