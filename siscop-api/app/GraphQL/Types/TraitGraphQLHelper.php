<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

trait TraitGraphQLHelper
{
    protected function addListOfType(string $name, string $type, string $description = '')
    {
        $this->addField($name, Type::listOf(GraphQL::type($type)), true, $description);
    }

    protected function addBooleanType(string $name, bool $nullable = false, string $description = '')
    {
        $this->addField($name, Type::boolean(), $nullable, $description);
    }

    protected function addType(string $name, string $type, string $description = '')
    {
        $this->addField($name, GraphQL::type($type), true, $description);
    }

    protected function addStringType(string $name, bool $nullable = false, string $description = '')
    {
        $this->addField($name, Type::string(), $nullable, $description);
    }

    protected function addIntType(string $name, bool $nullable = false, string $description = '')
    {
        $this->addField($name, Type::int(), $nullable, $description);
    }

    protected function getDataField(string $name, $type, bool $nullable = true, string $description = ''): array
    {
        if ($nullable) {
            return [
                $name => [
                    'type' => $type,
                    'description' => $description
                ]
            ];
        }

        return $this->getDataField($name, Type::nonNull($type), true, $description);
    }
}
