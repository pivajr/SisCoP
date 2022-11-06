<?php

namespace Database\Seeders;

use App\Models\Tabela;
use App\Models\TabelaColuna;
use Illuminate\Database\Seeder;

class CargaTabelaColunasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tabelas = Tabela::all();

        foreach($tabelas as $tabela) {
            $colunas = collect(\DB::select("desc $tabela->nome"))->where('Key', '!=', 'MUL')->all();

            foreach ($colunas as $coluna) {
                TabelaColuna::firstOrCreate([
                    'tabela_id' => $tabela->id,
                    'nome' => $coluna->Field
                ]);
            }
        }

        info(collect());
    }
}
