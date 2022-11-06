<?php

namespace App\Queries\Base;

interface IPersistence
{
    public function fieldsOnce(): void;
    public function fieldsUpdatable(bool $isUpdate): void;
    public function relations(bool $isUpdate): void;
}
