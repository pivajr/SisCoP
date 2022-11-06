<?php

namespace App\GraphQL\Types;

use App\Models\InstituicaoStatus;

class InstituicaoStatusType extends AbstractModelType
{
    public function __construct()
    {
        parent::__construct('InstituicaoStatus');
    }

    protected function setupFields()
    {
        $this->addStringType('nome');
        $this->addStringType('slug');
    }
}
