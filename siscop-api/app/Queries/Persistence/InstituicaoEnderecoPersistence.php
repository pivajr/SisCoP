<?php


namespace App\Queries\Persistence;

use App\Models\Instituicao;
use App\Queries\Base\Persistence;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InstituicaoEnderecoPersistence
 *
 * @package App\Queries\Persistence
 * @extends Persistence<\App\Models\InstituicaoEndereco>
 */
class InstituicaoEnderecoPersistence extends Persistence
{

    /**
     * @var Instituicao
     */
    private Instituicao $instituicao;


    /**
     * InstituicaoEnderecoPersistence constructor.
     * @param array $data
     * @param mixed $obj
     * @param Instituicao $instituicao
     */
    public function __construct(array $data, $obj, Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
        parent::__construct($data, $obj);
    }


    /**
     * @return void
     */
    public function fieldsOnce(): void
    {
        $this->obj->instituicao_id = $this->instituicao->id;
    }


    /**
     * @param bool $isUpdate
     * @return void
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->cep         = $this->data->cep;
        $this->obj->uf          = $this->data->uf;
        $this->obj->cidade      = $this->data->cidade;
        $this->obj->bairro      = $this->data->bairro;
        $this->obj->rua         = $this->data->rua;
        $this->obj->numero      = $this->data->numero;
        $this->obj->complemento = $this->data->complemento ?? '';
    }


    /**
     * @param boolean $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
    }
}
