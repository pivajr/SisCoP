<?php

namespace App\Reports\Common;

use App\Models\Relatorio;
use App\Models\RelatorioColuna;
use App\Models\TabelaRelacao;
use DB;
use Illuminate\Database\Query\Builder;

class Report implements IReport
{
    public Relatorio $relatorio;
    public $tabelasUsadas;

    public function __construct()
    {
        $this->tabelasUsadas = collect([]);
    }

    public function query(string $relatorio, array $filter): array
    {
        $this->relatorio = Relatorio::whereSlug($relatorio)->firstOrFail();

        $query = DB::query();

        info("###############################");
        info("########  DEBUG  ##############");
        info("###############################");

        foreach ($this->relatorio->tabelas as $tabelaRelatorio) {
            $relacoes = $tabelaRelatorio->tabela->relacoes;
            $tabela = $tabelaRelatorio->tabela;

            info(">>>> tabela: $tabela->nome");
            info(">>>> relacoes: $relacoes");

            if ($this->tabelasUsadas->isEmpty()) {
                $query = DB::table("$tabela->nome as $tabela->alias");
                $this->tabelasUsadas->push("$tabela->nome as $tabela->alias");
            }

            foreach ($relacoes as $relacao) {
                info(">>>> tabela pai: ".$relacao->tabelaPai->nome);
                info(">>>> alias pai: $relacao->tabela_pai_alias");
                info(">>>> fk pai: ".$relacao->tabela_pai_fk);
                info(">>>> tabela relacao: ".$relacao->tabelaRelacao->nome);
                info(">>>> alias relacao: ".$relacao->tabela_rel_alias);
                info(">>>> fk relacao: ".$relacao->tabela_rel_fk);

                $query = $this->joinExists($query, $relacao, $relacao->tabelaPai->nome, $relacao->tabela_pai_alias, $relacao->tabela_pai_fk, $relacao->tabela_rel_alias, $relacao->tabela_rel_fk);
                $query = $this->joinExists($query, $relacao, $relacao->tabelaRelacao->nome, $relacao->tabela_rel_alias, $relacao->tabela_rel_fk, $relacao->tabela_pai_alias, $relacao->tabela_pai_fk);

                info('------------------------------');
            }

            info('------------------------------');
        }

        foreach ($this->relatorio->colunas as $rc) {
            if ($rc->order_by) {
                $query = $query->orderBy($rc->coluna->nome, $rc->order_by);
            }
        }

        $columns = $this->relatorio->colunas->map(function (RelatorioColuna $rc) {
            return "$rc->alias.".$rc->coluna->nome;
        })->all();

        info(">>>> columns: ".collect($columns));

        $query = $query->select($columns);

        foreach ($this->relatorio->parametros as $relatorioParametro) {
            info(">>>>> parametro: $relatorioParametro->nome");
            info(">>>>> coluna: $relatorioParametro->alias.$relatorioParametro->coluna");

            if (isset($filter[$relatorioParametro->nome])) {
                info('>>>>> valor: '.$filter[$relatorioParametro->nome]);
                if ($relatorioParametro->date) {
                    $query = $query->whereDate("$relatorioParametro->alias.$relatorioParametro->coluna", $filter[$relatorioParametro->nome]);
                } else {
                    $query = $query->where("$relatorioParametro->alias.$relatorioParametro->coluna", $filter[$relatorioParametro->nome]);
                }
            }

            abort_if($relatorioParametro->required && !isset($filter[$relatorioParametro->nome]), 400, "O parâmetro $relatorioParametro->nome deve ser preenchido");
        }

        info(">>> SQL: ".$query->toSql());
        info(">>> Binds: ".collect($query->getBindings()));

        info("###############################");
        info("########  FIM DEBUG  ##########");
        info("###############################");

        return $query->get()->all();
    }

    /**
     * @param Builder $query
     * @param string $table
     * @param string $aliasFrom
     * @param string $columnFrom
     * @param string $aliasTo
     * @param string $columnTo
     * @return Builder
     */
    private function join(Builder $query, string $table, string $aliasFrom, string $columnFrom, string $aliasTo, string $columnTo): Builder
    {
        $joinTable = "$table as $aliasFrom";
        if (!$this->tabelasUsadas->contains($joinTable)) {
            info(">>>> joinTable: $joinTable");
            info(">>>> table: $table");
            info(">>>> aliasFrom: $aliasFrom");
            info(">>>> columnFrom: $columnFrom");
            info(">>>> aliasTo: $aliasTo");
            info(">>>> columnTo: $columnTo");

            $query = $query->join($joinTable, "$aliasFrom.$columnFrom", '=', "$aliasTo.$columnTo");

            $this->tabelasUsadas->push($joinTable);
        }

        return $query;
    }

    private function joinExists(Builder $query, TabelaRelacao $relacao, string $table, string $aliasFrom, string $columnFrom, string $aliasTo, string $columnTo): Builder
    {
        info('>>>>> total: '.$this->relatorio->tabelas->where('tabela_id', $relacao->tabela_rel_id)->count());
        if ($this->relatorio->tabelas->where('tabela_id', $relacao->tabela_rel_id)->isNotEmpty()) {
            $query = $this->join($query, $table, $aliasFrom, $columnFrom, $aliasTo, $columnTo);
            info(">>>>> SQl: " . $query->toSql());
        }

        return $query;
    }
}
