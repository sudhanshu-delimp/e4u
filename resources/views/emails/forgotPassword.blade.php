@component('mail::message')
# Hello {{ $body['name'] }},

We received a request to reset your password. Click the button below to create a new password for your account.

@component('mail::button', ['url' => $body['url']])
Create New Password
@endcomponent

If you did not request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent
