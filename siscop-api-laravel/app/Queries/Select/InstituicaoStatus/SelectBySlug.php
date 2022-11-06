<?php

namespace App\Queries\Select\InstituicaoStatus;

use App\Models\InstituicaoStatus;
use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SelectBySlug
 * @package App\Queries\Select\InstituicaoStatus
 */
class SelectBySlug extends Query
{
    /**
     * @var string
     */
    private string $slug;

    /**
     * SelectBySlug constructor.
     * @param string $slug
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        return (new \App\Queries\Select\Common\SelectBySlug(InstituicaoStatus::class, $this->slug))->query($base);
    }
}
