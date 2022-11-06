<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CargaPerfilsSeed::class);
        $this->call(CargaFuncionalidadesSeed::class);
        $this->call(CargaPerfilFuncionalidadesSeed::class);
        $this->call(CargaInstituicaoStatusSeed::class);
        $this->call(CargaTabelasSeed::class);
        $this->call(CargaRelacaoTabelasSeed::class);
        $this->call(CargaTabelaColunasSeed::class);
    }
}
