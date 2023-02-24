@component('mail::message')


Clic al boton para restablecer la contraseña

@component('mail::button', ['url' => 'https://bsgl.mx/password-reset?token='.$token.'&email='.$email])
Restablecer password
@endcomponent


{{ config('app.name') }}
@endcomponent
