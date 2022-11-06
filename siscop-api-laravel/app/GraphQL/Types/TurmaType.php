<?php

namespace App\GraphQL\Types;

use App\Models\Instituicao;
use App\Models\Turma;
use App\Models\TurmaHorario;
use App\Models\User;

class TurmaType extends AbstractModelType
{
    public function __construct()
    {
        parent::__construct('Turma');
    }

    protected function setupFields()
    {
        $this->addStringType('codigo_turma');
        $this->addStringType('curso');
        $this->addStringType('semestre');
        $this->addStringType('disciplina');
        $this->addType('responsavel', 'User');
        $this->addType('instituicao', 'Instituicao');
        $this->addListOfType('horarios', 'TurmaHorario');
    }
}
