<?php

namespace App\Queries\Persistence;

use App\Models\Funcionario;
use App\Queries\Base\Persistence;

/**
 * Class FuncionarioEnderecoPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<\App\Models\FuncionarioEndereco>
 */
class FuncionarioEnderecoPersistence extends Persistence
{
    /**
     * @var Funcionario
     */
    private Funcionario $funcionario;

    public function __construct(array $data, $obj, Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
        parent::__construct($data, $obj);
    }

    /**
     *
     */
    public function fieldsOnce(): void
    {
        $this->obj->funcionario_id = $this->funcionario->id;
    }

    /**
     * @param bool $isUpdate
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->cep         = $this->data->cep;
        $this->obj->uf          = $this->data->uf;
        $this->obj->cidade      = $this->data->cidade;
        $this->obj->bairro      = $this->data->bairro;
        $this->obj->rua         = $this->data->rua;
        $this->obj->numero      = $this->data->numero;
        $this->obj->complemento = $this->data->complemento;
    }

    /**
     * @param bool $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
    }
}
