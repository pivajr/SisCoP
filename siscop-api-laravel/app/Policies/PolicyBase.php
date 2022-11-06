<?php

namespace App\Policies;

use App\Queries\Select\Funcionalidade\SelectAllBySlugPerfil;

abstract class PolicyBase
{
    protected function can(string $slug): bool
    {
        $perfil = session()->get('perfil');
        info((new SelectAllBySlugPerfil($slug, optional($perfil)->id ?? 0))->query()->toSql());
        return (new SelectAllBySlugPerfil($slug, optional($perfil)->id ?? 0))->count()  > 0;
    }
}
