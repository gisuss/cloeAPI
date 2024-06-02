<table>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th colspan="2">
            <strong>Reporte de Raee registrados en sistema</strong>
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
            <th>Marca</th>
            <th>Modelo</th>
            <th>Línea</th>
            <th>Categoría</th>
            <th>Centro</th>
            <th>Estado</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
    @foreach($raees as $raee)
        <tr>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->id }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->marca->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->model }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->linea->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->category->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->centroAcopio->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->centroAcopio->estado->estado }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $raee->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>