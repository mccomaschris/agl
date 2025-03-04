@component('mail::message')
# Password Reset Notification

Hello {{ $user->name }},

Your password has been reset successfully. Below is your new password:

**{{ $newPassword }}**

@component('mail::button', ['url' => url('/login')])
Login Now
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
