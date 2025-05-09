@component('mail::message')
    <h2>Dear {{$body['escort_name']}},</h2>
    <h2>Escort ID: {{$body['member_id']}},</h2>
    <p>Your request for a Mobile SIM has been processed. Please allow 48 hours
        for the SIM to arrive. We have expressed posted your Mobile SIM to your
        nominated address.<br><br>
        If you do not receive your SIM within 48 hours, please lodge a Support Ticket
and quote the reference number stated in your A-Alert.
    </p>
    
@endcomponent
