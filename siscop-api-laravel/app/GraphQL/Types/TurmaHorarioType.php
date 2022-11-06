<?php

namespace App\GraphQL\Types;

use App\Models\Turma;
use App\Models\TurmaHorario;

class TurmaHorarioType extends AbstractModelType
{
    public function __construct()
    {
        parent::__construct('Turma');
    }

    protected function setupFields()
    {
        $this->addIntType('dia_semana');
        $this->addBooleanType('ativo');
//        $this->addType('turma', 'Turma');
        $this->addStringType('inicio');
        $this->addStringType('termino');
        $this->addStringType('extensao');
    }
}
