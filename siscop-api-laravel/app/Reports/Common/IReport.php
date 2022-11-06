<?php

namespace App\Reports\Common;

/**
 *
 */
interface IReport
{
    /**
     * @param array $filter
     * @return array
     */
    public function query(string $relatorio, array $filter): array;
}
