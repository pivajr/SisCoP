<?php

namespace Tests\Feature\Base;

use App\Models\Instituicao;
use App\Models\InstituicaoUser;
use App\Models\User;
use Database\Factories\InstituicaoFactory;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

/**
 * Class BaseResourceTest
 * @package Tests\Feature\Base
 */
abstract class BaseResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var int
     */
    protected int $qtd_registros = 15;

    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var Collection
     */
    protected Collection $loadedData;

    /**
     * @var Generator
     */
    protected Generator $faker;

    /**
     * BaseResourceTest constructor.
     * @param string|null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = Factory::create();
    }

    /**
     * @return Collection
     */
    protected abstract function load(): Collection;

    /**
     * @return array
     */
    protected abstract function storeData(): array;

    protected function storeArrayData(): array {
        return [];
    }

    /**
     * @return array
     */
    protected function updateData(): array {
        return $this->storeData();
    }

    protected function updateArrayData(): array {
        return $this->storeArrayData();
    }

    /**
     * @param mixed $json
     * @return Collection
     */
    protected abstract function hydrate($json): Collection;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->loadedData = $this->load();

        $instituicaoUser = InstituicaoUser::factory()->admin()->create();

        Sanctum::actingAs($instituicaoUser->user);

        info($instituicaoUser->instituicao);
        info($instituicaoUser->user);

        info('>>> setUp::'.get_called_class());
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexTest()
    {
        $expected = $this->loadedData->map(function ($item) {
            return $item->id;
        });
        $response = $this->get("/api/$this->baseUrl");
        $responseData = json_decode($response->getContent());

        $response->assertStatus(200);

        $result = $this->hydrate($responseData->data)->map(function ($item) {
            return $item->id;
        });

        $this->assertResourceCollectionStructure($response);
        $this->assertEquals($expected, $result);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreTest()
    {
        $arrayData = $this->storeArrayData();

        if (count($arrayData) > 0) {
            $response = $this->post("/api/$this->baseUrl", $arrayData);
        } else {
            $response = $this->post("/api/$this->baseUrl", $this->storeData());
        }

        self::assertContains($response->status(), [200, 201]);
        $response->assertJsonStructure([
            'data'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowTest()
    {
        $obj = $this->loadedData->random(1)->first();

        $response = $this->get("/api/$this->baseUrl/$obj->id");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUpdateTest()
    {
        $obj = $this->loadedData->random(1)->first();

        $arrayData = $this->updateArrayData();

        if (count($arrayData) > 0) {
            $response = $this->post("/api/$this->baseUrl", $arrayData);
        } else {
            $response = $this->post("/api/$this->baseUrl", $this->updateData());
        }

        self::assertContains($response->status(), [200, 201]);
        $response->assertJsonStructure([
            'data'
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDestroyTest()
    {
        $obj = $this->loadedData->random(1)->first();

        $response = $this->delete("/api/$this->baseUrl/$obj->id");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id'
        ]);
    }

    /**
     * @param TestResponse $response
     */
    protected function assertResourceCollectionStructure(TestResponse $response): void
    {
        $response->assertJsonStructure([
            'data',
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active'
                    ]
                ],
                'path',
                'per_page',
                'to',
                'total'
            ]
        ]);
    }
}
