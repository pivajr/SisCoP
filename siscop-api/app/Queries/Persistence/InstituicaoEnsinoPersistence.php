<?php


namespace App\Queries\Persistence;

use App\Models\Instituicao;
use App\Queries\Base\Persistence;

/**
 * Class InstituicaoEnsinoPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<\App\Models\InstituicaoEnsino>
 */
class InstituicaoEnsinoPersistence extends Persistence
{
    /**
     * @var Instituicao
     */
    private Instituicao $instituicao;

    public function __construct(array $data, $obj, Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
        parent::__construct($data, $obj);
    }

    /**
     *
     */
    public function fieldsOnce(): void
    {
        $this->obj->instituicao_id = $this->instituicao->id;
    }

    /**
     * @param bool $isUpdate
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->nivel = $this->data->nivel;
        $this->obj->qtd_estudantes = $this->data->qtd_estudantes;
        $this->obj->nivel_controle = $this->data->nivel_controle;
        $this->obj->tipo_instituicao = $this->data->tipo_instituicao;
    }

    /**
     * @param bool $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
    }
}
