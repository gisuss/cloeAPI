<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de centros de acopio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
  <body>
    <img class="mb-2" src="{{ public_path() . '/images/logo/logo_cloe_positivo.png' }}" alt="Logo de CLOE" width="100" height="">

    @if ($isAdmin)
        <div class="mb-4">
            <p class="h3 text-right mb-0">Reporte general de centros de acopio</p>
            <p class="text-monospace text-right mb-0">Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y h:m a') }}</p>
        </div>
    @endif
    
    <table class="table table-striped table-borderless table-sm">
        <caption class="text-monospace">Lista de centros de acopio registrados en sistema</caption>
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Encargado</th>
                <th scope="col">Estado</th>
                <th scope="col">Estatus</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($centros as $centro)
                <tr>
                    <th scope="row">{{ $centro->id }}</th>
                    <td>{{ $centro->name }}</th>
                    <td>{{ $centro->encargado->name . ' ' . $centro->encargado->lastname }}</td>
                    <td>{{ $centro->estado->estado }}</td>
                    <td>
                        @if ($centro->active === 1)
                            <span class="badge badge-pill badge-success">Activo</span>
                        @else
                            <span class="badge badge-pill badge-warning">Inactivo</span>
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