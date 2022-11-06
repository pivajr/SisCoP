<?php

namespace App\Queries\Persistence;

use App\Models\Turma;
use App\Models\TurmaHorario;
use App\Queries\Base\Persistence;
use App\Queries\Select\User\SelectByEmail;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<Turma>
 */
class TurmaPersistence extends Persistence
{

    public function fieldsOnce(): void
    {
        $this->obj->instituicao_id = session()->get('instituicao')->id;
        $this->obj->codigo_turma = $this->data->codigo_turma;
        $this->obj->curso = $this->data->curso;
        $this->obj->semestre = $this->data->semestre;
        $this->obj->disciplina = $this->data->disciplina;
    }

    public function fieldsUpdatable(bool $isUpdate): void
    {
        $user = (new SelectByEmail($this->data->user_email))->firstOrFail();
        $this->obj->user_id = $user->id;
    }

    public function relations(bool $isUpdate): void
    {
        foreach ($this->data->horarios as $horario) {
            $horarioObj = isset($horario['id']) ? $this->obj->horarios->where('id', $horario['id'])->first() : new TurmaHorario();
            (new TurmaHorarioPersistence($horario, $horarioObj, $this->obj->id))->execute($isUpdate);
        }
    }
}
