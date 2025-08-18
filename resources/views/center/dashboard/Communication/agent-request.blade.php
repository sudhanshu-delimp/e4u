
@extends('layouts.center')
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

<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Agent Request</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="row collapse" id="notes">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                              <ol>
                                <li>
                                    This form will be pre-populated with your details according to what you have selected in
                                    My Account - <a href="{{ route('centre.notifications-and-features') }}" class="custom_links_design">Notifications & Features</a>.
                                </li>
                                <li>
                                    Complete the form to request a Support Agent for assistance. When completing the form
                                    please ensure all of the details are correct and you have selected the correct option for
                                    communications. Once a Support Agent is appointed, they will remain your Support
                                    Agent for you to <a href="agent-messages" class="custom_links_design">communicate</a> with and address any of your
                                    concerns.
                                </li>
                                  <li>Once the Agent has accepted your request for support, you will receive a Notification.</li>
                              </ol>
                            </div>
                        </div>
                    </div>
                </div>
               @include('partials.snippet.agent_request_form')  
            </div>
        </div>
    <!--middle content end here-->
</div>

@include('partials.snippet.agent_request_confirmation_modal')     
@endsection
@push('script')
 @include('partials.snippet.agent_request_form_js')  
@endpush
