<table>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th colspan="2">
            <strong>Reporte de Componentes registrados en sistema</strong>
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
            <th>Name</th>
            <th>Generado por</th>
            <th>Fecha</th>
            <th>¿Reusable?</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
    @foreach($components as $component)
        <tr>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $component->id }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $component->name }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $component->splitedBy->name . ' ' . $component->splitedBy->lastname }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $component->created_at->format('d-m-Y') }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                @if ($component->reusable === 1)
                Si
                @else
                No
                @endif
            </td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $component->raee->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>