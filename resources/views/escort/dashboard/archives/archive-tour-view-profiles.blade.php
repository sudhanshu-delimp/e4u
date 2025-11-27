@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/parsley/src/parsley.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">   
   <div class="row">
      <div class="col-md-12">
         @if(request()->segment(2) != "list-tour")
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb bread-sec pl-0">
               <li class="breadcrumb-item"><a href="{{ url('escort-dashboard/archive-tours') }}" style="
                  "><i class="fas fa-long-arrow-alt-left"></i>&nbsp;&nbsp;Back To</a></li>
               <li class="breadcrumb-item active" aria-current="page">Manage Escorts - Tours</li>
            </ol>
         </nav>
         @endif
        
         <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">{{ $type == 'past' ? 'Archive' : 'Current' }}
                    Tours</h1>
               {{-- <h1 class="h1">{{ucfirst($type)}} Tours</h1> --}}
               <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 mb-4">
               <div class="card collapse" id="notes" style="">
                  <div class="card-body">
                     <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                     <ol>
                        <li>Use this feature to edit your Tour.</li>
                  <li>You can change any Profile's start or finish date, Membership Type and remove a Profile from the Tour.</li>
                  <li>Any changes to the Tour will automatically adjust your Fee to reflect the changes, including any refund. Refunds will be added to your Account as a Credit to be used for future listings and Tours.</li>
               
                     </ol>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="row">
         
            <div class="col-md-5">
            </div>
            <div class="col-md-4">
            </div>
            
            <div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title mb-0 dynamicTour" id="exampleModalLongTitle">Create New Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                     </div>
                     <div id="addTourForm">
                        <form id="myTour" method="post" action="{{route('escort.store.tour')}}">
                           @csrf
                           <div class="modal-body">
                              <div class="row pl-3">
                                 <div class="form-group mb-2 pt-2">
                                    <label for="staticEmail2">Tour Name <span style='color:red'>*</span></label>
                                 </div>
                                 <div class="form-group mx-sm-3 mb-2">
                                    <input type="text" name="name" required data-parsley-required-message=" Please enter Tour Name" class="form-control" id=" " placeholder=" " value="" data-parsley-errors-container="#Tname">
                                 </div>
                              </div>
                              <span id="Tname"></span>
                                 <div id="accordion" class="myacording-design mb-0 pt-3 cv">
                                 @include('escort.dashboard.archives.partials.tourModal')

                              </div>
                              <div class="col-md-12 p-0">
                                 <button type="button" class="btn btn-primary create-tour-sec w-100 addLocation" data-count="1">Add Location <i class="fa fa-fw fa-plus" style="color: #fff;"></i> </button>
                              </div>
                           </div>
                           <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                              <button type="submit" class="btn btn-secondary create-tour-sec" id="poli_payment">Save</button>
                              <button type="button" class="btn btn-primary create-tour-sec resetTour">Reset</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal delete" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                     </div>
                     <div id="addTourForm2">
                        <form id="deleteMyTour" method="post" action="{{route('escort.delete.tour',':id')}}">
                           @csrf
                           <div class="col-md-12 p-0">
                              <span>Are you sure, You want to delete.  </span>
                           </div>
                           <input type="hidden" id="deleteId" value="">
                           <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                              <button type="submit" class="btn btn-secondary create-tour-sec">Ok</button>
                              <button type="button" class="btn btn-primary create-tour-sec" data-dismiss="modal" aria-label="Close">close</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal delete" id="pesrmissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header main_bg_color border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                        </span>
                        </button>
                     </div>
                     <div id="addTourForm1">
                        <div class="col-md-12 p-0">
                           <span id="msg">  </span>
                        </div>
                        <input type="hidden" id="deleteId" value="">
                        <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                           <button type="submit" class="btn btn-secondary create-tour-sec permission">Ok</button>
                           <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal delete" id="AccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header main_bg_color border-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"> <span aria-hidden="true">
                        </span>
                        </button>
                     </div>

                        <div class="col-md-12 p-0">
                           <span id="msg"> Access Denied </span>
                        </div>
                        <div class="modal-footer border-0 pt-5" style="justify-content: flex-start;">
                        
                           <button type="button" class="btn btn-primary create-tour-sec nopermission" data-dismiss="modal" aria-label="Close">close</button>
                        </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive pl-1 pt-3 list-sec" id="sailorTableArea">
                  <table id="sailorTable" class="table table-striped" width="100%">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Tour Name</th>
                           <th>Start Date</th>
                           <th>End Date</th>
                           <th>Days</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
</div>
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
   var table; 
   $(document).ready(function () {
      table = $('#sailorTable').DataTable({
      serverSide: true,
      processing: true,
       "language": {
            "zeroRecords": "There is no record of the search criteria you entered.",
            searchPlaceholder: "Search by ID or Profile Name"
         },
      initComplete: function() {
         if ($('#returnToReportBtn').length === 0) {
            $('.dataTables_filter').append(
                  '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
            );
         }
         $('#returnToReportBtn').on('click', function() {
            var table = $('#sailorTable').DataTable();
            table.search('').draw();
         });
      },
				
      ajax: {
         url: "{{ route('escort.tour.dataTable', $type) }}",
         data: function (d) {
          
         }
      },
      columns: [
         { data: 'id', name: 'id' },
         { data: 'name', name: 'name' },
         { data: 'start_date', name: 'start_date' , searchable: false },
         { data: 'end_date', name: 'end_date' , searchable: false },
         { data: 'days_number', name: 'days_number' , searchable: false },
         { data: 'status', name: 'status' , orderable: false, searchable: false },
         { data: 'action', name: 'Action', orderable: false, searchable: false },
      ]
   });

   // Add placeholder to search input
   $('#sailorTable_filter input').attr('placeholder', 'Search by ID or Tour Name');
});


   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

   $(document).on('click','.tourDelete', function(e){
    e.preventDefault();
    $this = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "This will delete the tour and all related data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel"
    }).then((result)=>{
        if (result.isConfirmed) {
            $.ajax({
                url: $(this).attr('href'),
                type: "POST",
                beforeSend: function () {
                    Swal.fire({
                        title: "Deleting...",
                        text: "Please wait while we remove this tour.",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Tour and its related data have been deleted.",
                        icon: "success"
                    });

                    table.row( $this.parents('tr') ).remove().draw();
                },
                error: function (xhr) {
                    Swal.fire("Error!", "Something went wrong while deleting.", "error");
                }
            });
        }
        else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Cancelled", "Your tour is safe :)", "info");
        }
    })
})

</script>
@endpush
