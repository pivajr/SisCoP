<?php

namespace App\GraphQL\Queries\User;

use App\GraphQL\Models\QueryRelation;
use App\GraphQL\Queries\AbstractModelQuery;
use App\Models\User;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UsersQuery extends AbstractModelQuery
{
    protected $attributes = [
        'name' => 'users'
    ];

    public function type(): GraphQLType
    {
        return GraphQL::paginate('User');
    }

    protected function initialize()
    {
        $this->addStringType('name', true);
        $this->addStringType('email', true);
        $this->addBooleanType('primeiro_acesso', true);
    }

    protected function query(): Builder
    {
        $instituicao = session()->get('instituicao')->id;
        return User::query()->join('instituicao_users as iu', 'iu.user_id', '=', 'users.id')->
                     where('iu.instituicao_id', $instituicao)->
                     select('users.*');
    }

    public function relations(Builder $query): array
    {
        return [
        ];
    }
}
