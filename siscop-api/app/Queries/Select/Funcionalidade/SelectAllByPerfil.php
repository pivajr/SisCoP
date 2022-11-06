<?php

namespace App\Queries\Select\Funcionalidade;

use App\Models\Funcionalidade;
use App\Queries\Base\Query;
use App\Queries\Select\Common\SelectAll;
use Illuminate\Database\Eloquent\Builder;

class SelectAllByPerfil extends Query
{
    private int $perfilId;

    public function __construct(int $perfilId)
    {
        $this->perfilId = $perfilId;
    }

    /**
     * @param Builder|null $base
     * @return Builder
     */
    public function query(Builder $base = null): Builder
    {
        $baseQuery = $base ?? (new SelectAll(Funcionalidade::class))->query();
        return $baseQuery->join('perfil_funcionalidades', 'perfil_funcionalidades.funcionalidade_id', '=', 'funcionalidades.id')
                         ->where('perfil_funcionalidades.perfil_id', $this->perfilId);
    }
}
