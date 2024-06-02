<x-mail::message>
# ¡Saludos👋!<br>
Estás recibiendo este correo electrónico porque se ha registrado una solicitud de contacto con la siguiente información:

<x-mail::panel>
Nombre: {{ $data['name'] }} <br>
Email: {{ $data['email'] }} <br>
Teléfono: {{ $data['phone'] }} <br>
Estado: {{ $data['estado'] }} <br>
Ciudad: {{ $data['ciudad'] }} <br>
Mensaje: {{ $data['message'] }} <br>
</x-mail::panel>

Saludos.<br>

</x-mail::message>
