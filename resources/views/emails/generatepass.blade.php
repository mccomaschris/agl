@component('mail::message')
# AGLWV Password Reset

Hey {{ $user->name }}, the 2017 golf season is almost here. To get you started we've reset your credentials.

Here's your updated login information.

Username: {{ $user->username }}<br>
Password: {{ $new_pass }}

@component('mail::button', ['url' => 'https://www.aglwv.com/login/'])
Login
@endcomponent

Once you login you can update your password.

If you have any questions, drop me a [line](mailto:info@aglwv.com).

Thanks,

Chris McComas
@endcomponent
