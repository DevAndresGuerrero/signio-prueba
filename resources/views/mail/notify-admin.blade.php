@component('mail::message')
# Informacion

Admin notification.

@foreach ($data as $d)
+ Pais: {{ $d->country }} - Total: {{ $d->total }}
@endforeach

@component('mail::button', ['url' => config('app.url')])
Visitar sitio
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
