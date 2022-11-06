<?php

namespace App\Queries\Persistence;

use App\Models\TurmaHorario;
use App\Queries\Base\Persistence;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<TurmaHorario>
 */
class TurmaHorarioPersistence extends Persistence
{
    private int $turmaId;

    public function __construct(array $data, $obj, int $turmaId)
    {
        parent::__construct($data, $obj);

        $this->turmaId = $turmaId;
    }

    public function fieldsOnce(): void
    {
        $this->obj->dia_semana = $this->data->dia_semana;
        $this->obj->turma_id = $this->turmaId;
    }

    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->ativo = $this->data->ativo;
        $this->obj->inicio = $this->data->inicio;
        $this->obj->termino = $this->data->termino;
        $this->obj->extensao = $this->data->extensao;
    }

    public function relations(bool $isUpdate): void
    {
        // TODO: Implement relations() method.
    }
}
