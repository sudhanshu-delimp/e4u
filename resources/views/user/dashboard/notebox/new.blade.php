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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
      <div class="custom-heading-wrapper col-md-12">
          <h1 class="h1">Add Notebox</h1>
          <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>The My Notebox feature is a free service to Viewers that you can use any time.</li>
                  <li>To commence a new Notebox, select the Escort Type you want to create – Female,
                     Male or Trans etc.</li>
                  <li>Complete the form to add a new record to your Notebox list. When completing the form
                     please ensure all of the details are correct and you have selected the correct option
                     under Status Type to describe the Escort’s status, as well as for your personal Rating.</li>
                  <li>My Notebox is a closed publication for you only. Each Notebox contains personal
                     information about the Escort which only you can see (like a diary note).</li>
                  <li>Status Type filters meanings:
                     <ul style="list-style-type: disc;">
                        <li>Average means looks ok and pleasant enough but the sex was wanting.</li>
                        <li>Dog means an absolutely ugly and disgusting Escort.</li>
                        <li>Great fuck means had a great and wonderful time.</li>
                        <li>Waste of time means the Escort was nothing like they represented in their profile.</li>
                     </ul>
                  </li>
                  <li>Rating scale is a linear numeric scale where Punters can rate the likelihood of meeting
                     the Escort again. The question the Viewer should pose when applying the rating is
                     ‘Would I meet with this Escort again?’. The scale is calibrated 0 to 10 with 0 meaning
                     ‘Not at all likely’ and 10 meaning ‘Extremely likely’.</li>
                </ol>
            </div>
          </div>
      </div>
  </div>
  <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12">
         <h3><b>Coming Soon...</b></h3>
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
@endpush