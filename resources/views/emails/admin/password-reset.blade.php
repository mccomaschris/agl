@component('mail::message')
# Password Reset

{{ $user->name }}, your password has been reset by an administrator. 

As a reminder here's your login information: 

Username: {{ $user->username }}<br>
Password: {{ $password }}

@component('mail::button', ['url' => 'https://www.aglwv.com/login/'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
