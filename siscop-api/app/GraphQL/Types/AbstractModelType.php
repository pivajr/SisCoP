<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

abstract class AbstractModelType extends GraphQLType
{
    use TraitGraphQLHelper;

    protected $attributes;
    protected array $fieldsAttribute = [];

    public function __construct($model)
    {
        info(">>> model: $model");
        $this->attributes = [
            'name' => $model,
            'description' => "Collection de $model",
            'model' => $model
        ];

        info(">>>> $model initialize");
        $this->addIntType('id', false, 'ID da model');
        info("<<<< id field");

        $this->setupFields();

        info("<<<< $model initialize");
    }

    abstract protected function setupFields();

    public function fields(): array
    {
        info(">>>> fields");
        info(collect($this->fieldsAttribute));
        return $this->fieldsAttribute;
    }

    protected function addField(string $name, $type, bool $nullable = true, string $description = '')
    {
        $this->fieldsAttribute = array_merge($this->fieldsAttribute, $this->getDataField($name, $type, $nullable, $description));
    }
}
