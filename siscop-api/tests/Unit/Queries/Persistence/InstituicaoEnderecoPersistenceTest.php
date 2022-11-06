<?php

namespace Tests\Unit\Queries\Persistence;

use App\Models\Instituicao;
use App\Models\InstituicaoEndereco;
use App\Queries\Base\Persistence;
use App\Queries\Persistence\InstituicaoEnderecoPersistence;
use Tests\Unit\Queries\Base\BasePersistenceTest;
use Throwable;

class InstituicaoEnderecoPersistenceTest extends BasePersistenceTest
{
    protected string $table = 'instituicao_enderecos';

    /**
     * @var Instituicao
     */
    private Instituicao $instituicao;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->instituicao = Instituicao::newFactory()->create();
    }

    /**
     * @return array
     */
    public function dataForInsert(): array
    {
        return [
            'instituicao_id' => $this->instituicao->id,
            'cep' => $this->faker->postcode,
            'uf' => $this->faker->randomLetter,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->state,
            'rua' => $this->faker->streetName,
            'numero' => $this->faker->randomNumber(3),
            'complemento' => $this->faker->words(3, true),
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
        return new InstituicaoEnderecoPersistence($this->cachedInsertData, new InstituicaoEndereco(), $this->instituicao);
    }

    /**
     * @return Persistence
     */
    public function getPersistenceForUpdate(): Persistence
    {
        $this->cachedUpdateData = $this->dataForUpdate();
        $instituicaoEndereco = InstituicaoEndereco::newFactory()->create([
            'instituicao_id' => $this->instituicao->id
        ]);
        return new InstituicaoEnderecoPersistence($this->cachedUpdateData, $instituicaoEndereco, $this->instituicao);
    }

    /**
     * @throws Throwable
     */
    public function test_nao_altera_instituicao()
    {
        $this->cachedUpdateData = $this->dataForUpdate();
        $instituicaoEndereco = InstituicaoEndereco::newFactory()->create();
        (new InstituicaoEnderecoPersistence($this->cachedUpdateData, $instituicaoEndereco, $this->instituicao))->executeWithTransaction(true);

        $this->assertDatabaseMissing($this->table, $this->translateFieldsDatabase($this->cachedUpdateData));
    }
}
