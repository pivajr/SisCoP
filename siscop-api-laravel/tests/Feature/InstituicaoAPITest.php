<?php

namespace Tests\Feature;

use App\Models\Instituicao;
use App\Models\InstituicaoStatus;
use App\Models\User;
use Illuminate\Support\Collection;
use Tests\Feature\Base\BaseResourceTest;

class InstituicaoAPITest extends BaseResourceTest
{
    protected string $baseUrl = 'instituicao';

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        $statusPendente = InstituicaoStatus::where('slug', 'pendente-de-aprovacao')->first();
        return Instituicao::factory()->count($this->qtd_registros)->create([
            'instituicao_status_id' => $statusPendente->id
        ]);
    }

    /**
     * @return array
     */
    protected function storeData(): array
    {
        /**
         * @var User
         */
        $user = User::factory()->create();

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
     * @param mixed $json
     * @return Collection
     */
    protected function hydrate($json): Collection
    {
        return Instituicao::hydrate($json);
    }

    /**
     *
     */
    public function testAvaliacaoInstituicaoTest()
    {
        $status = InstituicaoStatus::where('slug', 'aprovado')->first() ?? InstituicaoStatus::factory()->aprovado()->create();

        $obj = $this->loadedData->random(1)->first();

        $response = $this->put("/api/$this->baseUrl/cadastro/avaliacao", [
            'instituicao_id' => $obj->id,
            'avaliacao' => $status->slug
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'
        ]);

        $obj = ((array)json_decode($response->getContent()))['data'];

        $this->assertEquals($status->id, $obj->instituicao_status_id);
    }

    public function testIndexTest()
    {
        self::assertTrue(true);
    }
}
