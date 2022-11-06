<?php

namespace App\GraphQL\Queries\Instituicao;

use App\GraphQL\Models\QueryRelation;
use App\GraphQL\Queries\AbstractModelQuery;
use App\Models\Instituicao;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class InstituicoesQuery extends AbstractModelQuery
{
    protected $attributes = [
        'name' => 'instituicoes'
    ];

    public function type(): GraphQLType
    {
        return GraphQL::paginate('Instituicao');
    }

    protected function initialize()
    {
        $this->addStringType('nome', true);
        $this->addStringType('cpf_cnpj', true);
        $this->addStringType('atividade', true);
        $this->addStringType('responsavel', true);
        $this->addStringType('qtd_funcionarios', true);
        $this->addStringType('status', true);
    }

    protected function query(): Builder
    {
        return Instituicao::join('instituicao_users as iu', 'iu.instituicao_id', '=', 'instituicoes.id')->
                            where('iu.user_id', auth()->id())->with(['responsavel', 'status'])->select('instituicoes.*');
    }

    public function relations(Builder $query): array
    {
        return [
            'responsavel' => new QueryRelation('users', 'u', 'user_id', 'instituicoes', 'name', $query),
            'status' => new QueryRelation('instituicao_status', 'i', 'instituicao_status_id', 'instituicoes', 'nome', $query),
        ];
    }
}
