<table>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th colspan="2">
            <strong>Reporte de centros de acopio registrados en sistema</strong>
        </th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th colspan="2">
            <strong>Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</strong>
        </th>
    </tr>
    <tr>
        <th colspan="2"></th>
    </tr>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Encargado</th>
            <th>Estado</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
    @foreach($centros as $centro)
        <tr>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $centro->id }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $centro->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $centro->encargado->name . ' ' . $centro->encargado->lastname }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $centro->estado->estado }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                @if ($centro->active === 1)
                    Activo
                @else
                    Inactivo
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>