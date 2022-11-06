<?php

namespace Tests\Unit\Queries\Persistence;

use App\Models\User;
use App\Queries\Base\Persistence;
use App\Queries\Persistence\UserPersistence;
use Hash;
use Tests\Unit\Queries\Base\BasePersistenceTest;

/**
 * Class UserPersistenceTest
 * @package Tests\Unit\Queries\Persistence
 */
class UserPersistenceTest extends BasePersistenceTest
{
    /**
     * @var string
     */
    protected string $table = 'users';

    /**
     * @return array
     */
    public function dataForInsert(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'password' => $this->faker->randomNumber(5),
            'cpf_cnpj' => $this->faker->randomNumber(5),
            'ra' => $this->faker->randomNumber(5)
        ];
    }

    /**
     * @return array
     */
    public function dataForUpdate(): array
    {
        return $this->dataForInsert();
    }

    /**
     * @return Persistence
     */
    public function getPersistenceForInsert(): Persistence
    {
        $this->cachedInsertData = $this->dataForInsert();
        return new UserPersistence($this->cachedInsertData, new User());
    }

    /**
     * @return Persistence
     */
    public function getPersistenceForUpdate(): Persistence
    {
        $user = User::newFactory()->create();
        $this->cachedUpdateData = $this->dataForUpdate();
        return new UserPersistence($this->cachedUpdateData, $user);
    }

    public function translateApiForDatabaseColumns(): array
    {
        return [
            'nome' => 'name',
            'senha' => 'password'
        ];
    }

    public function hideFromSelect(): array
    {
        return [
            'password'
        ];
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return mixed
     */
    protected function mutate(string $column, $value)
    {
        info("$column - $value");
        switch ($column) {
            case 'password':
                return Hash::make($value);
        }

        return $value;
    }
}
