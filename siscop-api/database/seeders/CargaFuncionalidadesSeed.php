<?php

namespace Database\Seeders;

use App\Models\Funcionalidade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CargaFuncionalidadesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfils = [
            'Cadastro de Usuário',
            'Consulta de Usuário'
        ];

        foreach ($perfils as $perfil) {
            Funcionalidade::firstOrCreate([
                'nome' => $perfil,
                'slug' => Str::slug($perfil)
            ]);
        }
    }
}
