<?php

namespace App\Queries\Persistence;

use App\Models\InstituicaoUser;
use App\Models\User;
use App\Queries\Base\Persistence;

/**
 * Class UserPersistence
 * @package App\Queries\Persistence
 * @extends Persistence<InstituicaoUser>
 */
class InstituicaoUserPersistence extends Persistence
{

    /**
     * @var User
     */
    private User $user;

    public function __construct(array $data, $obj, User $user)
    {
        $this->user = $user;
        parent::__construct($data, $obj);
    }

    public function fieldsOnce(): void
    {
        $this->obj->instituicao_id = $this->data->instituicao_id ?? session()->get('instituicao')->id;
        $this->obj->user_id = $this->user->id;
    }

    public function fieldsUpdatable(bool $isUpdate): void
    {
        $this->obj->perfil_id = $this->data->perfil_id;
    }

    public function relations(bool $isUpdate): void
    {
    }
}
