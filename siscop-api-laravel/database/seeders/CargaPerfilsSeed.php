<?php

namespace Database\Seeders;

use App\Models\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CargaPerfilsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfils = [
            'Administrador',
            'Basico'
        ];

        foreach ($perfils as $perfil) {
            Perfil::firstOrCreate([
                'nome' => $perfil,
                'slug' => Str::slug($perfil)
            ]);
        }
    }
}
