<?php

namespace Database\Seeders;

use App\Models\Tabela;
use App\Models\TabelaRelacao;
use Illuminate\Database\Seeder;

class CargaRelacaoTabelasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relacoes = [
            [
                'tabela_pai' => 'turma_users',
                'tabela_rel' => 'turmas',
                'tabela_pai_alias' => 'tu',
                'tabela_rel_alias' => 't',
                'tabela_pai_fk' => 'turma_id',
                'tabela_rel_fk' => 'id',
            ],
            [
                'tabela_pai' => 'users',
                'tabela_rel' => 'turma_users',
                'tabela_pai_alias' => 'u',
                'tabela_rel_alias' => 'tu',
                'tabela_pai_fk' => 'id',
                'tabela_rel_fk' => 'user_id',
            ],
            [
                'tabela_pai' => 'presencas',
                'tabela_rel' => 'users',
                'tabela_pai_alias' => 'p',
                'tabela_rel_alias' => 'u',
                'tabela_pai_fk' => 'user_id',
                'tabela_rel_fk' => 'id',
            ],
            [
                'tabela_pai' => 'presencas',
                'tabela_rel' => 'turmas',
                'tabela_pai_alias' => 'p',
                'tabela_rel_alias' => 't',
                'tabela_pai_fk' => 'turma_id',
                'tabela_rel_fk' => 'id',
            ],
        ];

        foreach ($relacoes as $relacao) {
            TabelaRelacao::firstOrCreate([
                'tabela_pai_id' => Tabela::whereNome($relacao['tabela_pai'])->first()->id,
                'tabela_rel_id' => Tabela::whereNome($relacao['tabela_rel'])->first()->id,
                'tabela_pai_alias' => $relacao['tabela_pai_alias'],
                'tabela_rel_alias' => $relacao['tabela_rel_alias'],
                'tabela_pai_fk' => $relacao['tabela_pai_fk'],
                'tabela_rel_fk' => $relacao['tabela_rel_fk'],
            ]);
        }
    }
}
