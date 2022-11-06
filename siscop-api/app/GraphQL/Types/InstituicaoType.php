<?php

namespace App\GraphQL\Types;

use App\Models\Instituicao;
use App\Models\InstituicaoStatus;
use App\Models\User;

class InstituicaoType extends AbstractModelType
{
    public function __construct()
    {
        parent::__construct('Instituicao');
    }

    protected function setupFields()
    {
        info('>>> setup');
        $this->addStringType('nome');
        info('>>> nome string type');
        $this->addStringType('cpf_cnpj');
        info('>>> cpf string type');
        $this->addStringType('atividade', true);
        info('>>> atividade string type');
        $this->addType('responsavel', 'User');
        info('>>> responsvel user type');
        $this->addIntType('qtd_funcionarios');
        info('>>> qtd int type');
        $this->addType('status', 'InstituicaoStatus');
        info('>>> status InstituicaoStatus type');
    }
}
