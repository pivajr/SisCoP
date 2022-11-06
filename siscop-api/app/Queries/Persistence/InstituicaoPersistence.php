<?php

namespace App\Queries\Persistence;

use App\Models\InstituicaoEndereco;
use App\Models\InstituicaoEnsino;
use App\Models\InstituicaoStatus;
use App\Models\InstituicaoUser;
use App\Models\Perfil;
use App\Models\User;
use App\Queries\Base\Persistence;
use App\Queries\Select\InstituicaoStatus\SelectBySlug;
use App\Queries\Select\User\SelectByEmail;

/**
 * Class InstituicaoPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<\App\Models\Instituicao>
 */
class InstituicaoPersistence extends Persistence
{
    /**
     * @return void
     */
    public function fieldsOnce(): void
    {
    }

    /**
     * @param bool $isUpdate
     * @return void
     */
    public function fieldsUpdatable(bool $isUpdate): void
    {
        info('>>> instituicaoPersistence');
        /**
         * @var User
         */
        $user = $this->getUser();

        /**
         * @var InstituicaoStatus
         */
        $instituicaoStatus = (new SelectBySlug($this->data->status ?? 'pendente-de-aprovacao'))->first();

        $this->obj->nome = $this->data->nome;
        $this->obj->cpf_cnpj = $this->data->cpf_cnpj;
        $this->obj->atividade = $this->data->atividade;
        $this->obj->responsavel_id = $user->id;
        $this->obj->qtd_funcionarios = $this->data->qtd_funcionarios;
        $this->obj->instituicao_status_id = $instituicaoStatus->id;
        info('<<< instituicaoPersistence');
    }

    /**
     * @param bool $isUpdate
     */
    public function relations(bool $isUpdate): void
    {
        foreach ($this->data->enderecos as $endereco) {
            (new InstituicaoEnderecoPersistence($endereco, new InstituicaoEndereco(), $this->obj))->execute($isUpdate);
        }

        $ensino = $this->data->ensino ?? false;

        if ($ensino) {
            (new InstituicaoEnsinoPersistence((array)$this->data, new InstituicaoEnsino(), $this->obj))->execute($isUpdate);
        }

        $perfil_id = Perfil::where('slug', 'administrador')->firstOrFail()->id;
        $instituicao_id = $this->obj->id;

        (new InstituicaoUserPersistence(compact('perfil_id', 'instituicao_id'), new InstituicaoUser(), auth()->user()))->execute($isUpdate);
    }

    private function getUser(): User
    {
        $user = (new SelectByEmail($this->data->email_responsavel))->query()->first();

        if (is_null($user)) {
            $email = $this->data->email_responsavel;
            $name  = $this->data->nome_responsavel;

            $user = (new UserPersistence(compact('name', 'email'), new User()))->execute();
        }

        info('>>> user');
        info($user);

        return $user;
    }
}
