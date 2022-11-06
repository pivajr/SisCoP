<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\InputType;

class SortFieldType extends InputType
{
    protected $attributes = [
        'name' => 'SortField',
        'description' => ""
    ];

    public function fields(): array
    {
        return [
            'field' =>  [
                'type' => Type::string()
            ],
            'sortType' => [
                'type' => GraphQL::type('SortType')
            ]
        ];
    }
}
