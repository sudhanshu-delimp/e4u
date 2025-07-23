<script type="text/javascript">
$(document).ready(function() {
   $('#agent_request_frm').on('submit', function() {
        $('#submitTicketBtn').prop('disabled', true).val('Submitting please wait...');
    });
});
</script>

@if(session('agent_success'))
<script>
$('#agentconfirmationPopup').modal('show');
</script>
@endif