<?php

namespace App\Queries\Select\Funcionalidade;

use App\Queries\Base\Query;
use Illuminate\Database\Eloquent\Builder;

class SelectAllBySlugPerfil extends Query
{
    private int $perfilId;
    private string $slug;

    public function __construct(string $slug, int $perfilId)
    {
        $this->perfilId = $perfilId;
        $this->slug = $slug;
    }

    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? (new SelectAllByPerfil($this->perfilId))->query();
        return $baseQuery->where('funcionalidades.slug', $this->slug);
    }
}
