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
      <div class="col-md-12 custom-heading-wrapper justify-content-between">
         <div class="d-flex align-items-center">
          <h1 class="h1">My Noteboxes</h1>
          <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
           @if (request('from') !== 'sidebar')
          <div class="back-to-dashboard">
              <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                  <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
              </a>
          </div>
          @endif 
      </div>
  </div>
    <div class="row">
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>You can view all of your Noteboxes here. Simply search the Notebox you are looking
                     for by searching the mobile number. Or scroll through the pages.</li>
                  <li>You can also select a Notebox you wish to edit or remove from your register by clicking
                     the appropriate button. Any Notebox you remove from your register will be permanently
                     removed.</li>
                  <li>New Noteboxes when created or edited, are listed here.</li>
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