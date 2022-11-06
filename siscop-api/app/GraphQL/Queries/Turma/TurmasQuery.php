<?php

namespace App\GraphQL\Queries\Turma;

use App\GraphQL\Models\QueryRelation;
use App\GraphQL\Queries\AbstractModelQuery;
use App\GraphQL\Types\TraitGraphQLHelper;
use App\Models\Instituicao;
use App\Models\Turma;
use App\Models\User;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class TurmasQuery extends AbstractModelQuery
{
    protected $attributes = [
        'name' => 'turmas'
    ];

    public function type(): GraphQLType
    {
        return GraphQL::paginate('Turma');
    }

    protected function initialize()
    {
        $this->addStringType('codigo_turma', true);
        $this->addStringType('curso', true);
        $this->addStringType('semestre', true);
        $this->addStringType('disciplina', true);
        $this->addStringType('responsavel', true);
        $this->addStringType('instituicao', true);
    }

    protected function query(): Builder
    {
        $instituicao = session()->get('instituicao')->id;
        return Turma::where('instituicao_id', $instituicao)->select('turmas.*')->with(['responsavel']);
    }

    public function relations(Builder $query): array
    {
        return [
            'responsavel' => new QueryRelation('users', 'u', 'user_id', 'turmas', 'name', $query),
            'instituicao' => new QueryRelation('instituicoes', 'i', 'instituicao_id', 'turmas', 'nome', $query),
        ];
    }
}
