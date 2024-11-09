@component('mail::message')
# Welcome to {{ config('app.name') }}!

Hello {{ $user->username }},

We're thrilled to have you on board! To complete your registration, please click the link below to set your new account password.

@component('mail::button', ['url' => route('set_new_password', ['token' => $rememberToken])])
Set Your Password
@endcomponent

Thank you for choosing us, and we look forward to serving you better.

Best regards,
{{ config('app.name') }} Team
@endcomponent
