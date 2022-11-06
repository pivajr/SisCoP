<?php

namespace Database\Seeders;

use App\Models\Funcionalidade;
use App\Models\Perfil;
use Illuminate\Database\Seeder;

class CargaPerfilFuncionalidadesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Perfil::where('slug', 'administrador')->first();
        $funcionalidades = Funcionalidade::get()->map(function ($f) {
            return $f->id;
        });

        $administrador->funcionalidades()->sync($funcionalidades);

    }
}
