<?php

namespace Database\Seeders;

use App\Models\Tabela;
use Illuminate\Database\Seeder;

class CargaTabelasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tabelas = [
            [
                'nome' => 'turmas',
                'descricao' => 'Tabela responsável por armazenar todas as turmas',
                'selecionavel' => true,
                'alias' => 't'
            ],
            [
                'nome' => 'users',
                'descricao' => 'Tabela responsável por armazenar todos os usuários',
                'selecionavel' => true,
                'alias' => 'u'
            ],
            [
                'nome' => 'turma_users',
                'descricao' => 'Tabela responsável por vincular os usuários a turma',
                'selecionavel' => false,
                'alias' => 'tu'
            ],
            [
                'nome' => 'turma_horarios',
                'descricao' => 'Tabela responsável por armazenar todos os horários das turmas',
                'selecionavel' => true,
                'alias' => 'th'
            ],
            [
                'nome' => 'presencas',
                'descricao' => 'Tabela responsável por armazenar todas as presencas dos usuários',
                'selecionavel' => true,
                'alias' => 'p'
            ]
        ];


        foreach ($tabelas as $tabela) {
            Tabela::firstOrCreate($tabela);
        }
    }
}
