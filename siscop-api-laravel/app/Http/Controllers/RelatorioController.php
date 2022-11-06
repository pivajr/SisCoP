<?php

namespace App\Http\Controllers;

use App\Reports\Common\ReportBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *
 */
class RelatorioController extends Controller
{
    /**
     * @var ReportBuilder
     */
    private ReportBuilder $builder;

    /**
     * @param ReportBuilder $builder
     */
    public function __construct(ReportBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param Request $request
     * @param string $relatorio
     * @return Response
     */
    public function pdf(Request $request, string $relatorio): Response
    {
        return $this->builder->download($relatorio, $request->all());
    }
}
