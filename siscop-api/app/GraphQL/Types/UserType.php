<?php

namespace App\GraphQL\Types;

use App\Models\User;

class UserType extends AbstractModelType
{
    public function __construct()
    {
        parent::__construct('User');
    }

    protected function setupFields()
    {
        $this->addStringType('name');
        $this->addStringType('email');
        $this->addStringType('password');
        $this->addStringType('cpf_cnpj', true);
        $this->addBooleanType('primeiro_acesso');
    }
}
