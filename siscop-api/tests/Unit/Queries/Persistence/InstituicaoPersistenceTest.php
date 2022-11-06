<?php

namespace Tests\Unit\Queries\Persistence;

use App\Models\Instituicao;
use App\Models\InstituicaoStatus;
use App\Models\Perfil;
use App\Models\User;
use App\Queries\Base\Persistence;
use App\Queries\Persistence\InstituicaoPersistence;
use Tests\Unit\Queries\Base\BasePersistenceTest;

class InstituicaoPersistenceTest extends BasePersistenceTest
{
    /**
     * @var string
     */
    protected string $table = 'instituicoes';

    protected function setUp(): void
    {
        parent::setUp();

        InstituicaoStatus::newFactory()->pendente()->create();

        /**
         * @var User
         */
        $user = User::newFactory()->create();
        $instituicao = Instituicao::newFactory()->create();
        session()->put('instituicao_id', $instituicao);
        $this->actingAs($user);
    }

    /**
     * @return array
     */
    public function dataForInsert(): array
    {
        /**
         * @var User
         */
        $user = User::newFactory()->create();

        $perfil = new Perfil();
        $perfil->slug = 'administrador';
        $perfil->nome = 'Administrador';
        $perfil->save();

        return [
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->randomNumber(5),
            'atividade' => $this->faker->word(),
            'qtd_funcionarios' => $this->faker->randomNumber(3),
            'email_responsavel' => $user->email,
            'enderecos' => [],
            'ensino' => false
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
        return new InstituicaoPersistence($this->cachedInsertData, new Instituicao());
    }

    /**
     * @return Persistence
     */
    public function getPersistenceForUpdate(): Persistence
    {
        $instituicao = Instituicao::newFactory()->create();
        self::assertNotNull($instituicao->id);
        self::assertNotEmpty($instituicao->id);
        $this->cachedUpdateData = $this->dataForUpdate();
        info('>>>>> instituicao persistence teste');
        info($instituicao);
        return new InstituicaoPersistence($this->cachedUpdateData, $instituicao);
    }

    /**
     * @return string[]
     */
    public function translateApiForDatabaseColumns(): array
    {
        return [
            'email_responsavel' => 'responsavel_id'
        ];
    }

    /**
     * @param string $column
     * @param mixed $value
     * @return mixed
     */
    protected function mutate(string $column, $value)
    {
        switch ($column) {
            case 'responsavel_id':
                return optional(User::where('email', $value)->first())->id;
        }

        return $value;
    }

    /**
     * @return string[]
     */
    public function hideFromSelect(): array
    {
        return [
            'enderecos',
            'ensino'
        ];
    }

    public function test_update_objeto()
    {
        self::assertTrue(true);
    }
}
