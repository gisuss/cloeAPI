<x-mail::message>
# ¡Hola, {{ $user->name }}👋!<br>
Te saludamos nuevamente de parte de equipo de Cloe, estás recibiendo este correo electrónico porque se ha detectado un cambio de contraseña para tu cuenta.

Los datos para ingresar al sistema son los siguientes:

<x-mail::table>
| Usuario | Contraseña |
|:----:|:----:| 
| {{ $user->username }} | {{ $pass }} |
</x-mail::table>

No extravíes tu contraseña ya que será única para tu ingreso al sistema.

También puedes hacer uso de tu correo electrónico para el inicio de sesión.

Saludos.<br>

<hr>
<br>

<x-mail::panel>
Esta dirección de correo electrónico no está monitorizada, por favor no interactúes con esta cuenta.
</x-mail::panel>

</x-mail::message>

