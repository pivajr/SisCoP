<?php

namespace App\GraphQL\Models;

use Illuminate\Database\Eloquent\Builder;

class QueryRelation
{
    private $table;
    private $alias;
    private $fk;
    private $pk;
    private $baseTable;
    private $query;
    private $orderColumn;
    private $hasJoin = false;

    public function __construct(string $table, string $alias, string $fk, string $baseTable, string $orderColumn, Builder $query, string $pk = 'id')
    {
        $this->table = $table;
        $this->alias = $alias;
        $this->fk = $fk;
        $this->pk = $pk;
        $this->baseTable = $baseTable;
        $this->orderColumn = $orderColumn;
        $this->query = $query;
    }

    public function where(string $column, $value)
    {
        if (!$this->hasJoin) {
            $this->query = $this->join();
        }

        return $this->query->where("$this->alias.$column", 'like', "%$value%");
    }

    public function orderBy(string $type)
    {
        if (!$this->hasJoin) {
            $this->query = $this->join();
        }

        return $this->query->orderBy("$this->alias.$this->orderColumn", $type);
    }

    private function join()
    {
        $this->hasJoin = true;

        return $this->query->join("$this->table as $this->alias", "$this->alias.$this->pk", '=', "$this->baseTable.$this->fk");
    }
}
