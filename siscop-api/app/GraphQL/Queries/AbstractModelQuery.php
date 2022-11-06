<?php

namespace App\GraphQL\Queries;

use App\GraphQL\Types\TraitGraphQLHelper;
use Illuminate\Database\Eloquent\Builder;
use Rebing\GraphQL\Support\Query;

abstract class AbstractModelQuery extends Query
{
    use TraitGraphQLHelper;
    private array $argsAttribute = [];

    public function __construct()
    {
        $this->initialize();
        $this->addListOfType('sortBy', 'SortField');
        $this->addIntType('page', true);
        $this->addIntType('per_page', true);
    }

    public function args(): array
    {
        return $this->argsAttribute;
    }

    public function resolve($root, $args): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $collectionArgs = collect($args);
        $query = $this->query();
        $relations = $this->relations($query);

        foreach ($args as $column => $value) {
            $relation =$relations[$column] ?? null;

            if ($relation) {
                $query = $relation->where('name', $value);
            } else if (!in_array($column, ['page', 'per_page', 'sortBy'])) {
                $query = $query->where($column, 'like', "%$value%");
            } else if ($column === 'sortBy') {
                foreach ($value as $sortDef) {
                    $field = $sortDef['field'];
                    $type  = $sortDef['sortType'];

                    $relation = $relations[$field] ?? null;

                    if ($relation) {
                        $query = $relation->orderBy($type);
                    } else {
                        $query = $query->orderBy($field, $type);
                    }
                }
            }

            info(">>>> sort");
            info($value);
        }


        return $query->paginate($args['per_page'] ?? 15, ['*'], 'page', $args['page'] ?? 1);
    }

    abstract protected function initialize();
    abstract protected function query(): Builder;
    abstract protected function relations(Builder $query): array;

    protected function addField(string $name, $type, bool $nullable = true, string $description = '')
    {
        $this->argsAttribute = array_merge($this->argsAttribute, $this->getDataField($name, $type, $nullable, $description));
    }
}
