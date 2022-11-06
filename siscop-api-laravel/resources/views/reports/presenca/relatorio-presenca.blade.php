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
    <h1 class="text-center">{{ $instituicao  }}</h1>
    <h2 class="text-center">Relatório de presenças <br> da turma {{ $turma }}</h2>
    <table>
        <thead>
        <tr>
            <th>Data</th>
            <th>RA</th>
            <th>Nome</th>
            <th>E-mail</th>
        </tr>
        </thead>
        <tbody>
        @forelse($presencas as $presenca)
            <tr>
                <td class="text-center">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $presenca->data_presenca)->format('d/m/Y H:i:s') }}</td>
                <td class="text-center">{{ $presenca->ra ?? '-' }}</td>
                <td class="text-center">{{ $presenca->name  }}</td>
                <td class="text-center">{{ $presenca->email  }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhuma presenca encontrada</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
