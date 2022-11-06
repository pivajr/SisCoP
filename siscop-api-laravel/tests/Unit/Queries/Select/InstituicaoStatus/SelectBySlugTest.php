<?php


namespace Tests\Unit\Queries\Select\InstituicaoStatus;


use App\Models\InstituicaoStatus;
use App\Queries\Select\InstituicaoStatus\SelectBySlug;
use Illuminate\Support\Collection;
use Tests\Unit\Queries\Base\BaseSelectTest;

/**
 * Class SelectBySlugTest
 * @package Tests\Unit\Queries\Select\InstituicaoStatus
 */
class SelectBySlugTest extends BaseSelectTest
{
    /**
     * @var Collection
     */
    private Collection $instituicaoStatus;

    /**
     * @return Collection
     */
    protected function load(): Collection
    {
        $factory = InstituicaoStatus::newFactory();

        $status = collect([
            $factory->pendente()->create(),
            $factory->aprovado()->create(),
            $factory->desativado()->create()
        ]);

        $this->instituicaoStatus = $status->random(1);

        return $status;
    }

    /**
     * @return Collection|null
     */
    protected function expected(): ?Collection
    {
        return $this->instituicaoStatus;
    }

    /**
     * @return Collection
     */
    protected function result(): Collection
    {
        return (new SelectBySlug($this->instituicaoStatus->first()->slug))->query()->get();
    }
}
