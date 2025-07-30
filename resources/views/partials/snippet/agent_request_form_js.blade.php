<script type="text/javascript">
$(document).ready(function() {
   $('#agent_request_frm').on('submit', function() {
        $('#submitTicketBtn').prop('disabled', true).val('Submitting please wait...');
    });
});
</script>

<script>
var redirect_url= "";    
var user_type = '<?php echo auth()->user()->type;?>';
if(user_type =='4')
redirect_url = "/center-dashboard";
else if(user_type =='3')
redirect_url = "/escort-dashboard";
console.log(user_type);
</script>

@if(session('agent_success'))  
<script>
$('#agentconfirmationPopup').modal('show');
$('.close_request_modal').click(function(){
    window.location.href = redirect_url;
});
</script>
@endif
