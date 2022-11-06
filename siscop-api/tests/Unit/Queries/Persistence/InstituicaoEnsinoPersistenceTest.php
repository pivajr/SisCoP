<?php

namespace Tests\Unit\Queries\Persistence;

use App\Models\Instituicao;
use App\Models\InstituicaoEnsino;
use App\Queries\Base\Persistence;
use App\Queries\Persistence\InstituicaoEnsinoPersistence;
use Tests\Unit\Queries\Base\BasePersistenceTest;
use Throwable;

class InstituicaoEnsinoPersistenceTest extends BasePersistenceTest
{
    /**
     * @var string
     */
    protected string $table = 'instituicao_ensinos';

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
            'nivel' => $this->faker->randomElement(['F', 'M', 'S', 'P']),
            'qtd_estudantes' => $this->faker->numberBetween(10, 3000),
            'nivel_controle' => $this->faker->randomElement(['Funcionario', 'Estudantes', 'Ambos']),
            'tipo_instituicao' => $this->faker->randomElement(['M', 'E', 'F']),
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
        return new InstituicaoEnsinoPersistence($this->cachedInsertData, new InstituicaoEnsino(), $this->instituicao);
    }

    /**
     * @return Persistence
     */
    public function getPersistenceForUpdate(): Persistence
    {
        $this->cachedUpdateData = $this->dataForUpdate();
        $instituicaoEnsino = InstituicaoEnsino::newFactory()->create([
            'instituicao_id' => $this->instituicao->id
        ]);

        return new InstituicaoEnsinoPersistence($this->cachedUpdateData, $instituicaoEnsino, $this->instituicao);
    }

    /**
     * @throws Throwable
     */
    public function test_nao_altera_instituicao()
    {
        $this->cachedUpdateData = $this->dataForUpdate();
        $instituicaoEndereco = InstituicaoEnsino::newFactory()->create();
        (new InstituicaoEnsinoPersistence($this->cachedUpdateData, $instituicaoEndereco, $this->instituicao))->executeWithTransaction(true);

        $this->assertDatabaseMissing($this->table, $this->translateFieldsDatabase($this->cachedUpdateData));
    }
}
