@component('mail::message')
# Reminder: Your Profile listing is Expiring Soon

Hi {{ $escort->user->name ?? $escort->user->member_id }},

Your escort profile **{{ $escort->name ?? 'on our site' }}** listing is set to expire on  
{{ \Carbon\Carbon::parse($escort->end_time)->format('Y-m-d') }}.

To continue being listed, please extend your profile listing before the expiry date.

@component('mail::button', ['url' => route('escort.list','current')])
Extend Now
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent