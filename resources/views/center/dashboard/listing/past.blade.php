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
                  <h1 class="h1">Past Listings</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
               </div>
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes" style="">
                     <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b></h3>
                        
                        <ol>
                              
                        </ol>
                     </div>
                  </div>
               </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive custom-table-responsive">
                  <table id="currentListings" class="table  custom--common-table" width="100%">
                        <thead class="table-bg">
                           <tr>
                              
                              <th>Profile Name</th>
                              <th>Location</th>
                              <th>Business Name</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Days</th>
                             
                              <th style="width:70px">Fee Paid</th>
                           </tr>
                        </thead>
                        <tbody>
                           
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
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script>
   var table = $("#currentListings").DataTable({
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: false,
    order: [[0, 'desc']],
    pageLength: {{$datatable_entries }},
   lengthMenu: [10,25, 50, 75, 100],     

    ajax: {
        url: "{{ route('center.past-listing') }}",
        type: "POST",
        contentType: "application/json",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: function (d) {
            d.type = 'player';
            return JSON.stringify(d);
        }
    },

    columns: [
            { data: 'profile_name', name: 'profile_name', searchable: true, orderable:true ,defaultContent: 'NA' },
            { data: 'address', name: 'address', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'business_name', name: 'business_name', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'start_date', name: 'start_date', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'end_date', name: 'end_date', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'days', name: 'days', searchable: true, orderable:true ,defaultContent: 'NA'},
            { data: 'fee_paid', name: 'fee_paid', searchable: false, orderable:false, defaultContent: 'NA', class:'text-center' },
    ],


});


   
</script>
    
@endpush
