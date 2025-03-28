@component('mail::message')
    <h2>Hello {{$body['user_name']}},</h2>
    <p>&emsp; This is to notify you that, Your playmate {{$body['playmate_name']}} ({{$body['playmate_profile_name']}})
        profile is going to be deactivated tomorrow {{date('d-m-Y', strtotime('+1 day'))}}.</p>

    Thanks,
    {{ config('app.name') }}
@endcomponent
