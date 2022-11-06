<?php

namespace App\Queries\Base;

use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class Persistence
 * @package App\Queries\Base
 * @template T of \Illuminate\Database\Eloquent\Model
 */
abstract class Persistence implements IPersistence
{
    /**
     * @var object
     */
    protected object $data;

    /**
     * @var T
     */
    protected $obj;

    /**
     * Persistence constructor.
     * @param array $data
     * @param T $obj
     */
    public function __construct(array $data, $obj)
    {
        $this->data = (object)$data;
        $this->obj = $obj;
    }

    /**
     * @param bool $isUpdate
     * @return T
     * @throws Throwable
     */
    public function executeWithTransaction(bool $isUpdate = false)
    {
        DB::beginTransaction();

        try {
            $this->obj = $this->execute($isUpdate);
            DB::commit();
            return $this->obj;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * @param bool $isUpdate
     * @return T
     */
    public function execute(bool $isUpdate = false)
    {
        if (!$isUpdate) {
            $this->fieldsOnce();
        }

        $this->fieldsUpdatable($isUpdate);
        $this->obj->save();
        $this->relations($isUpdate);

        return $this->obj;
    }
}
