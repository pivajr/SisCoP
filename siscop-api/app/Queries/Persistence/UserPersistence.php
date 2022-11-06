<?php


namespace App\Queries\Persistence;

use App\Models\InstituicaoUser;
use App\Models\Parametro;
use App\Models\User;
use App\Queries\Base\Persistence;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<User>
 */
class UserPersistence extends Persistence
{

    /**
     *
     */
    public function fieldsOnce(): void
    {
    }

    /**
     *
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        $senhaPadrao = optional(Parametro::where('codigo', 'senha-padrao')->first())->valor ?? '!mud@r123';
        info('>>> user persistence');
        $this->obj->name = $this->data->name ?? 'Anônimo';
        $this->obj->email = $this->data->email;
        $this->obj->password = Hash::make($this->data->password ?? $senhaPadrao);
        $this->obj->cpf_cnpj = $this->data->cpf_cnpj ?? null;
        $this->obj->ra = $this->data->ra ?? null;
        $this->obj->predicted_token = $this->data->predicted_token ?? null;
        $this->obj->primeiro_acesso = $this->data->primeiro_acesso ?? !$isUpdate;
        info('<<< user persistence');
    }

    /**
     * @param bool $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
        if (isset($this->data->perfil_id)) {
            info('>>> relations');
            (new InstituicaoUserPersistence((array)$this->data, new InstituicaoUser(), $this->obj))->execute($isUpdate);
            info('<<< relations');
        }
    }
}
