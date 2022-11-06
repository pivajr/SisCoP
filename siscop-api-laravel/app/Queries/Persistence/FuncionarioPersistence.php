<?php

namespace App\Queries\Persistence;

use App\Models\FuncionarioEndereco;
use App\Models\User;
use App\Queries\Base\Persistence;

/**
 * Class FuncionarioPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<\App\Models\Funcionario>
 */
class FuncionarioPersistence extends Persistence
{

    /**
     *
     */
    public function fieldsOnce(): void
    {
        $user = (new UserPersistence((array)$this->data, new User()))->execute();

        $this->obj->user_id = $user->id;
        $this->obj->instituicao_id = session()->get('instituicao')->id;
    }

    /**
     * @param bool $isUpdate
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->horario_flexivel = $this->data->horario_flexivel;
        $this->obj->solicita_validacao = $this->data->solicita_validacao;
        $this->obj->qtd_horas = $this->data->qtd_horas;
    }

    /**
     * @param bool $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
        foreach ($this->data->enderecos as $endereco) {
            (new FuncionarioEnderecoPersistence($endereco, new FuncionarioEndereco(), $this->obj))->execute($isUpdate);
        }
    }
}
