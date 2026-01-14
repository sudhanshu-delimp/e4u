@extends('layouts.userDashboard')
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
<div class="container-fluid pl-3 pl-lg-5 register-pin-up mb-5">
    <!--middle content start here-->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Submit</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4 mycont">
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <p>To help us assist you better:</p>
                    <ol>
                        <li>When describing your problem or enquiry, please try to provide as much information as possible.</li>
                        <li>Upload any documents or images you have.</li>
                        <li>Allow us a couple of days to respond.</li>
                    </ol>
                </div>
            </div>
            <br>
            <form class="mb-4 col-md-9" id="supportTicket" method="post" action="{{route('support-ticket.create')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="sel1"><b>Department</b></label>
                    <select class="form-control" name="department" required>
                        <option id="placeholder" selected="" disabled="" value="">Choose Department</option>
                        <option value="Accounts">Accounts</option>
                        <option value="Photo verification">Photo verification</option>
                        <option value="Support">Support</option>
                        <option value="Technical">Technical</option>
                        <option value="Website Report">Website Report</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Priority</b></label>
                    <select class="form-control" name="priority">
                        <option value="Normal">Normal</option>
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Service type</b></label>
                    <select class="form-control" name="service_type" required>
                        <option id="placeholder" selected="" disabled="" value="">Choose Service</option>
                        {{-- <option value="Alert notifications">Alert notifications</option>
                        <option value="Escort Agent">Escort Agent</option>
                        <option value="Viewer review">Viewer review</option>
                        <option value="Ugly Mugs register">Ugly Mugs register</option>
                        <option value="Other">Other</option> --}}

                        <option value="My Account">My Account</option>
                        <option value="Legbox">Legbox</option>
                        <option value="Listed Profile">Listed Profile</option>
                        <option value="Notifications & Features">Notifications & Features</option>
                        <option value="Punterbox">Punterbox</option>
                        <option value="Other">Other</option>
                    </select>

                </div>
                <div class="form-group">
                    <label for="sel1"><b>Subject</b></label>
                    <input type="text" class="form-control" placeholder=" " name="subject" value="" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1"><b>Message</b></label>
                    <textarea class="form-control" rows="5" id="comment" name="message" required></textarea>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sel1"><b>Document / Image upload</b>
                    </label>
                    <p>If you have any other documentation that can assist us with your query, including images, please upload them.</p>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input">
                        <label class="custom-file-label" for="customFileLang">Insert file upload</label>
                    </div>
                    </select>
                </div>


                <input type="hidden"  name="user_type"  value="viewer">
                <input type="submit" name="submit" id="submitTicketBtn" class=" create-tour-sec dctour mt-3" value="Submit Ticket">
            </form>
        </div>
    </div>
    <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
$(document).ready(function() {
   $('#supportTicket').on('submit', function() {
        $('#submitTicketBtn')
            .prop('disabled', true)
            .val('Sending please wait...');
    });
});
</script>
@endpush