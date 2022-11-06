<?php

namespace App\Queries\Select\User;

use App\Models\User;
use App\Queries\Base\Query;
use App\Queries\Select\Common\SelectAll;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectByEmail
 * @package App\Queries\Select\User
 */
class SelectByEmail extends Query
{
    /**
     * @var string
     */
    private string $email;

    /**
     * SelectByEmail constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? (new SelectAll(User::class))->query();
        return $baseQuery->where('email', $this->email);
    }
}
