@component('mail::message')
# Informacion

Usted se encuentra registrado!

{{ $user->name }}: {{ $user->email }}

@component('mail::button', ['url' => config('app.url')])
Visitar sitio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
