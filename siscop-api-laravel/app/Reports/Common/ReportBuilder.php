<?php

namespace App\Reports\Common;

use App\Models\Relatorio;
use App\Reports\Presenca\PresencaReport;

use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Http\Response;

/**
 *
 */
class ReportBuilder
{
    private Report $report;
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * @param string $relatorio
     * @param array $filter
     * @return Response
     */
    public function download(string $relatorio, array $filter): Response
    {
        $data = $this->report->query($relatorio, $filter);
        /**
         * @var Relatorio
         */
        $relatorio = $this->report->relatorio;

        return PDF::loadView("reports.report", compact('relatorio', 'data'))->setOrientation($relatorio->orientacao)->download("$relatorio->nome_arquivo.pdf");
    }
}
