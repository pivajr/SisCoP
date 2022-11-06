<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends PolicyBase
{
    use HandlesAuthorization;

    public function cadastro(): bool
    {
        return $this->can('cadastro-de-usuario');
    }

    public function consulta(): bool
    {
        return $this->can('consulta-de-usuario');
    }
}
