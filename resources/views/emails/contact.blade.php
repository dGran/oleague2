@component('mail::message')
Hola Administrador,
<br><br>
Se ha recibido un mensaje desde el Formuario de Contacto.
<br><br>
Nombre: {{ $datos['nombre'] }}
<br>
E-Mail: {{ $datos['email'] }}
@component('mail::panel')
    {{ $datos['mensaje'] }}
@endcomponent

{{-- Gracias,<br>
{{ config('app.name') }} --}}
@endcomponent