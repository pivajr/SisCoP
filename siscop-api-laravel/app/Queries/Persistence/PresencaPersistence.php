<?php

namespace App\Queries\Persistence;

use App\Models\Presenca;
use App\Queries\Base\Persistence;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<Presenca>
 */
class PresencaPersistence extends Persistence
{

    public function fieldsOnce(): void
    {
        $this->obj->latitude = $this->data->latitude;
        $this->obj->longitude = $this->data->longitude;
        $this->obj->user_id = $this->data->user_id;
        $this->obj->instituicao_id = session()->get('instituicao')->id;
        $this->obj->data_presenca = now();

        if (!empty($this->data->turma_id)) {
            $this->obj->turma_id = $this->data->turma_id;
        }
    }

    public function fieldsUpdatable(bool $isUpdate): void
    {
    }

    public function relations(bool $isUpdate): void
    {
    }
}
