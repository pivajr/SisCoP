<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .text-center {
            text-align: center;
        }

        table { width: 100% }
        thead { display: table-header-group }
        tfoot { display: table-row-group }
        tr { page-break-inside: avoid }
    </style>
</head>
<body>
<p>Relatório gerado no dia {{ now()->format('d/m/Y') }} às {{ now()->format('H:i:s') }}</p>
<h2 class="text-center">{{ $relatorio->nome  }}</h2>
<table>
    <thead>
    <tr>
        @foreach($relatorio->colunas as $relatorioColuna)
            <th>{{ $relatorioColuna->label }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @forelse($data as $obj)
        <tr>
            @foreach ($relatorio->colunas as $relatorioColuna)
                @if($relatorioColuna->format === 'date_time')
                    <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', ((array)$obj)[$relatorioColuna->coluna->nome])->format('d/m/Y H:i:s') }}</td>
                @else
                    <td class="text-center">{{ ((array)$obj)[$relatorioColuna->coluna->nome] ?? '-' }}</td>
                @endif
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ $relatorio->colunas->count() }}" class="text-center">Nenhum registro encontrado</td>
        </tr>
    @endforelse
    </tbody>
</table>
</body>
</html>
