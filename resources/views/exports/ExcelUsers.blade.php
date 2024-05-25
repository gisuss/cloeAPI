<table>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th colspan="2">
            <strong>Reporte de Usuarios registrados en sistema</strong>
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
            <th>Email</th>
            @if ($isAdmin)
                <th>Centro</th>
            @endif
            <th>Estado</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $user->id }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $user->name . ' ' . $user->lastname }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $user->email }}</td>
            @if ($isAdmin && $user->getRoleNames()[0] === 'Admin')
                <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">-</td>
            @else
                <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $user->centro->name }}</td>
            @endif
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">{{ $user->estado->estado }}</td>
            <td align="center" style="border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                @if ($user->active === 1)
                    Activo
                @else
                    Inactivo
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>