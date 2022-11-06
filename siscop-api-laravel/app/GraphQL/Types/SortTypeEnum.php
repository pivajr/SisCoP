<?php

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\EnumType;

class SortTypeEnum extends EnumType
{
    protected $attributes = [
        'name' => 'Sort Type',
        'description' => 'Tipos de Ordenação possível',
        'values' => [
            'ASC' => 'asc',
            'DESC' => 'desc',
        ],
    ];
}
