@component('mail::message')
<h2>Hello {{$body['name']}},</h2>
<p>This is comfirmation mail for update your security level change</p>
 

    {{-- @component('mail::button', ['url' => $body['url']])@endcomponent  --}}
 
 

 
Thanks,<br>
{{ config('app.name') }}<br>
E4u Team.
@endcomponent
