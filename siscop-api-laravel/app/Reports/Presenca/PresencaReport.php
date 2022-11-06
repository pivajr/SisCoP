<?php

namespace App\Reports\Presenca;

use App\Models\Presenca;
use App\Models\Turma;
use App\Reports\Common\IReport;

use DB;

class PresencaReport implements IReport
{

    /**
     * @param array $filter
     * @return array
     */
    public function query(string $relatorio, array $filter): array
    {
        $turma = Turma::whereId($filter['turma_id'])->firstOrFail();
        $instituicao = $turma->instituicao->nome;
        $turma = "$turma->codigo_turma - $turma->curso";
        $presencas = DB::table('presencas', 'p')->
                         join('users as u', 'u.id', '=', 'p.user_id')->
                         where('p.turma_id', $filter['turma_id'])->
                         orderBy('p.data_presenca');

        if (isset($filter['data'])) {
            $presencas = $presencas->whereDate('p.data_presenca', $filter['data']);
        }

        $presencas = $presencas->get(['p.data_presenca', 'u.ra', 'u.email', 'u.name']);

        return compact('presencas', 'turma', 'instituicao');
    }
}
