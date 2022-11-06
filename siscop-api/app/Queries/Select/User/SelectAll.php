<?php

namespace App\Queries\Select\User;

use App\Models\User;
use App\Queries\Base\Query;
use App\Queries\Select\Common\SelectAll as SelectAllCommon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectAll
 * @package App\Queries\Select\User
 */
class SelectAll extends SelectAllCommon
{
    /**
     * SelectAll constructor.
     */
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
