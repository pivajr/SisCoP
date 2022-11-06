<?php

namespace App\Queries\Select\User;

use App\Models\User;
use App\Queries\Select\Common\SelectById as SelectByIdCommon;

/**
 * Class SelectById
 * @package App\Queries\Select\User
 */
class SelectById extends SelectByIdCommon
{
    /**
     * SelectById constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        parent::__construct(User::class, $id);
    }
}
