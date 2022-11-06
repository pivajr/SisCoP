<?php

namespace Tests\Unit\Queries\Base;

use App\Queries\Base\Persistence;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Throwable;

/**
 * Class BasePersistenceTest
 * @package Queries\Base
 */
abstract class BasePersistenceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var string
     */
    protected string $table;

    /**
     * @var Generator
     */
    protected Generator $faker;

    /**
     * @var array
     */
    protected array $cachedInsertData;

    /**
     * @var array
     */
    protected array $cachedUpdateData;

    /**
     * BasePersistenceTest constructor.
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
     * @return array
     */
    public abstract function dataForInsert(): array;

    /**
     * @return array
     */
    public abstract function dataForUpdate(): array;

    /**
     * @return Persistence
     */
    public abstract function getPersistenceForInsert(): Persistence;

    /**
     * @return Persistence
     */
    public abstract function getPersistenceForUpdate(): Persistence;

    /**
     * @return array
     */
    public function translateApiForDatabaseColumns(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function hideFromSelect(): array
    {
        return [];
    }

    /**
     * @param string $column
     * @param $value
     * @return mixed
     */
    protected function mutate(string $column, $value)
    {
        return $value;
    }

    /**
     *
     * @throws Throwable
     */
    public function test_insert_objeto()
    {
        $this->getPersistenceForInsert()->executeWithTransaction();
        $this->assertDatabaseHas($this->table, $this->translateFieldsDatabase($this->cachedInsertData));
    }

    /**
     *
     * @throws Throwable
     */
    public function test_update_objeto()
    {
        $this->getPersistenceForUpdate()->executeWithTransaction(true);
        $this->assertDatabaseHas($this->table, $this->translateFieldsDatabase($this->cachedUpdateData));
    }

    /**
     * @param array $base
     * @return array
     */
    protected function translateFieldsDatabase(array $base): array
    {
        $newArray = [];
        $columns = $this->translateApiForDatabaseColumns();
        $hideColumns = $this->hideFromSelect();

        foreach ($base as $key => $value) {
            $newKey = $columns[$key] ?? $key;

            if (!in_array($newKey, $hideColumns)) {
                $newArray[$newKey] = $this->mutate($newKey, $value);
            }
        }

        return $newArray;
    }
}
