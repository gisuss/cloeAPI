<x-mail::message>
# ¡Hola👋!<br>
Estás recibiendo este correo electrónico porque se ha solicitado un cambio de contraseña para tu cuenta.

El PIN para restablecimiento de contraseña es el siguiente:

<x-mail::table>
| PIN | 
|:----:| 
{{ $pin }}
</x-mail::table>

Este PIN para restablecer tu contraseña caduca en 60 minutos.

Si no has solicitado un cambio de contraseña, puedes ignorar o eliminar este correo electrónico.

Saludos.<br>

<hr>
<br>

<x-mail::panel>
Esta dirección de correo electrónico no está monitorizada, por favor no interactúes con esta cuenta.
</x-mail::panel>

</x-mail::message>
