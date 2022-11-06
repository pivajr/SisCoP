<?php

namespace Tests\Unit\Queries\Base;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

/**
 * Class BaseQueryTest
 * @package Queries\Base
 */
abstract class BaseSelectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var int
     */
    protected int $qtd_registros = 15;

    /**
     * @return Collection
     */
    protected abstract function load(): Collection;

    /**
     * @return Collection
     */
    protected abstract function result(): Collection;

    /**
     * @return Collection|null
     */
    protected function expected(): ?Collection
    {
        return null;
    }

    /**
     *
     * @return void
     */
    public function test_total_registros()
    {
        $loaded = $this->load();
        $resultSelect = $this->result();

        $this->assertCount(($this->expected() ?? $loaded)->count(), $resultSelect);
    }

    /**
     *
     */
    public function test_mesma_lista()
    {
        $loaded = $this->load();

       $resultSelect = $this->result()->map(function ($item) {
           return $item->id;
       });

       $expected = ($this->expected() ?? $loaded)->map(function ($item) {
            return $item->id;
       });

       $this->assertEquals($expected, $resultSelect);
    }
}
