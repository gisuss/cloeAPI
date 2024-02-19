<x-mail::message>
# ¡Hola, {{ $user->name }}👋!<br>
Estás recibiendo este correo electrónico porque se ha solicitado un restablecimiento de contraseña para tu cuenta Cloe.

El enlace para restablecimiento de contraseña es el siguiente:

<x-mail::button :url="$url" color="primary">
Restablecer contraseña
</x-mail::button>

Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este correo electrónico.

Saludos.<br>

<hr>
<br>

<x-mail::panel>
Esta dirección de correo electrónico no está monitorizada, por favor no interactúes con esta cuenta.
</x-mail::panel>

</x-mail::message>
