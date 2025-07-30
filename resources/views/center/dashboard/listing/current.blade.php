@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
      <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
      {{-- middle content start here --}}
         <div class="row">
            
               <div class="col-md-12 custom-heading-wrapper">
                  <h1 class="h1">Current Listings</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes" style="">
                     <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                              
                        </ol>
                     </div>
                  </div>
               </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive custom-table-responsive  list-sec">
                  <table id="listings" class="table  custom--common-table" width="100%">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Profile Name</th>
                              <th>Location</th>
                              <th>Stage Name</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Days</th>
                                 <th>Membership</th>
                              <th>Fee Paid</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td colspan="9" class="text-center">
                                 No record(s) found.
                              </td>                              
                           </tr>
                        </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>  
      {{-- end here --}}
   </div>
</div>      
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    
@endpush
