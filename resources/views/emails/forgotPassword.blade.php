@component('mail::message')
    <h2>Hello {{$body['name']}},</h2>
    <p>The email is a sample email for Laravel Tutorial: How to Send an Email using Laravel 8 from @component('mail::button', ['url' => $body['url']])
            Bacancy Technology
        @endcomponent</p>

    <p>Visit @component('mail::button', ['url' => $body['url']])
            For create new password
        @endcomponent </p>


    Happy coding!<br>

    Thanks,<br>
    {{ config('app.name') }}<br>
    Laravel Team.
@endcomponent
