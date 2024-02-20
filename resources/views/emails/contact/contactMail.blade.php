<x-mail::message>
# ¡Saludos👋!<br>
Estás recibiendo este correo electrónico porque se ha registrado una solicitud de contacto de parte de {{ $data->name }} con la siguiente información:

<x-mail::panel>

<x-mail::table>
| E-mail         | Ciudad  |
|:-------------:| :--------:|
| {{ $data->email }} | {{ $data->city }} |
</x-mail::table>

<x-mail::table>
| Mensaje       |
| :-------------: |
| {{ $data->menssage }} |
</x-mail::table>

</x-mail::panel>

Saludos.<br>

<hr>

</x-mail::message>
