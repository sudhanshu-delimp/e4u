
@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    

    <div class="row">
        <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
            <h1 class="h1">Agent Request</h1>
            <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
        </div>
        <div class="col-md-12 my-4">
            <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                    <li>This form will be pre-populated with your details according to what you have selected in your <a href="notifications-features" class="custom_links_design">Notifications & Features</a> settings.
                Use this form to request an Agent for assistance.</li>
                    {{-- <li>Select the Agent you wish to appoint from the list of available Agents (Step 1).</li> --}}
                    <li>Complete the form to request a Support Agent for assistance. When completing the form
                      please ensure all of the details are correct and you have selected the correct option for
                      communications. Once a Support Agent is appointed, they will remain your Support
                      Agent for you to <a href="agent-messages" class="custom_links_design"> communicate </a>with and address any of your
                      concerns.</li>
                    <li>Once the Agent has accepted your request for support, you will receive a confirmation
                      email.</li>
                </ol>
            </div>
            </div>
        </div>
    </div>

        <div class="row">
            
            <div class="col-md-12">
               
                <form action="{{route('escort.agent-request')}}" method="post" name="agent_request_frm" id="agent_request_frm">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group w-50">
                                <label for="email"><b>First Name</b> </label>
                                <input id="name" placeholder="First Name" name="first_name" type="text" class="form-control" required="">
                            </div>
                            <div class="form-group w-50">
                                <label for="email"><b>Last Name</b> </label>
                                <input id="name" placeholder="Last Name" name="last_name" type="text" class="form-control" >

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Email</b></label>
                                <input id="name" placeholder="Email Address" name="email" type="text" class="form-control" required>

                            </div>

                            <div class="form-group w-50">
                                <label for="email"><b>Mobile Number</b> </label>
                                <input id="name" placeholder="Mobile Number" name="mobile_number" type="text" class="form-control" required>
                            </div>

                            {{-- <div class="form-group custom-radio mb-0">
                                <label for="email"><b>Contact preference</b> </label><br>
                                <input type="radio" name="contact_by_email" value="1">
                                <label class="m-0" for="html">Show me Agent list</label><br>
                                <input type="radio" id="css" name="contact_by_mobile" value="1">
                                <label for="css">Have Agent contact me (select method below)</label><br>
                            </div> --}}

                            <div class="form-group">
                                <label for="email"><b>Agent</b></label><br>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox"  name="contact_by_email" value="1">
                                    <label class="form-check-label" for="Method_Message">Contact me by email</label>
                                </div>
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="checkbox" name="contact_by_mobile" value="1">
                                    <label class="form-check-label" for="Method_Text">Contact me by mobile</label>
                                </div>
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleFormControlTextarea1">
                                    <b>Comments</b> (please provide any additional information to assist us)
                                </label>
                                <textarea class="form-control" id="comments" name="comments" placeholder="Up to 300 characters"></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="submitTicketBtn" value="Submit Request" class="new-btn-sec btn btn-primary shadow-none" name="submit">
                    @csrf
                    @include('partials.snippet.error')
                </form>


                                    

            </div>
        </div>
    <!--middle content end here-->
</div>


<div class="modal fade upload-modal" id="agentconfirmationPopup" tabindex="-1" role="dialog" aria-labelledby="confirmationPopup" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="confirmationPopup">Agent Request Submitted</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
                <div class="row">
                   <div class="col-12 mb-3">
                        <p>Your Request for a Support Agent has been submitted. A Support Agent will be in touch
                            with you according to your preferred method.</p>
                            <p>If a Support Agent has not contacted you within 24 hours, please raise a Support Ticket
                                quoting the following reference : 
                                @if(session('req_ref_number'))
                                {{ session('req_ref_number') }}.
                                @endif
                            </p>
                   </div>
                </div>
          </div>
          <div class="modal-footer text-center justify-content-center">             
             <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">Close</button>
          </div>
       </div>
    </div>
 </div>
@endsection
@push('script')
<!-- file upload plugin start here -->


<script type="text/javascript">
$(document).ready(function() {
   $('#agent_request_frm').on('submit', function() {
        $('#submitTicketBtn').prop('disabled', true).val('Submitting please wait...');
        //let data = {'title':'Agent Request','message':'Sending Request'};
        //wal_waiting_popup(data);
    });
});
</script>

@if(session('agent_success'))
<script>
$('#agentconfirmationPopup').modal('show');
</script>
@endif
@endpush
