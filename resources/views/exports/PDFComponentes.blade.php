<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de componentes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
  <body>
    <img class="mb-2" src="{{ public_path() . '/images/logo/logo_cloe_positivo.png' }}" alt="Logo de CLOE" width="100" height="">

    @if ($isAdmin)
        <div class="mb-4">
            <p class="h3 text-right mb-0">Reporte general de componentes</p>
            <p class="text-monospace text-right mb-0">Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>
    @else
        <div class="mb-4">
            <p class="h3 text-right mb-0">Reporte de componentes - Centro: {{ $centro }}</p>
            <p class="text-monospace text-right mb-0">Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
        </div>
    @endif
    
    <table class="table table-striped table-borderless table-sm">
        <caption class="text-monospace">Lista de componentes registrados en sistema</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Generado por</th>
                <th scope="col">Fecha</th>
                <th scope="col">¿Reusable?</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($componentes as $componente)
                <tr>
                    <th scope="row">{{ $componente->id }}</th>
                    <td>{{ $componente->name }}</th>
                    <td>{{ $componente->splitedBy->name . ' ' . $componente->splitedBy->lastname }}</td>
                    <td>{{ $componente->created_at->format('d-m-Y') }}</td>
                    <td>
                        @if ($componente->reusable === 1)
                            <span class="badge badge-pill badge-success">Si</span>
                        @else
                            <span class="badge badge-pill badge-warning">No</span>
                        @endif
                    </td>
                </tr>
            @empty
                <p class="text-monospace">No hay data registrada.</p>
            @endforelse
        </tbody>
    </table>
  </body>
</html>