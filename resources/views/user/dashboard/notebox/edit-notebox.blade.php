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
          <h1 class="h1">Edit Notebox</h1>
          <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>The Notebox register (<b>Notebox</b>) is a free service to all Viewers. You can use the
                     Notebox service at any time.</li>
                  <li>Edit any of the information you have set out in this Notebox. Once you have completed
                     your changes, click the ‘Update Notebox’ button.
                  </li>
                  <li>Noteboxes are closed publications for Viewers only. Each Notebox contains personal
                     information about the Escort. E4U does not make Noteboxes available to other Punters.</li>
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