<table>
    <tr>
        <th colspan="2">
            <strong>Reporte de Usuarios registrados en sistema</strong>
        </th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th>Reporte a la fecha</th>
        <th>Fecha: {{ \Carbon\Carbon::now()->format('d-m-Y h:m a') }}</th>
    </tr>
    <tr>
        <th></th>
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
            <td>{{ $user->id }}</td>
            <td>{{ $user->name . ' ' . $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            @if ($isAdmin && $user->getRoleNames()[0] === 'Admin')
                <td>-</td>
            @else
                <td>{{ $user->centro->name }}</td>
            @endif
            <td>{{ $user->estado->estado }}</td>
            <td>
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