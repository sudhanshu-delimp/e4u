@extends('layouts.escort')
@section('style')
    <style>
        .child-table thead th{
            background-color: #022c3d !important;
            color: #fff;
            padding-left: 5px;
        }
        .btn-primary {
            border-color: unset !important;
        }
        td.dt-control {
        cursor: pointer;
        text-align: center;
        }
        td.dt-control::before {
        content: "⌄";
        font-weight: bold;
        }
        tr.shown td.dt-control::before {
        content: "⌃";
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Tours Schedule</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    
                      <ol>
                            <li>All of your Tours are listed here for a twelve month period. To view at Tour that is older than 12 months, <a href="{{url('escort-dashboard/list-tour/past')}}" class="custom_links_design">click here</a>.</li>
                            <li>There are multiple functions available to you by clicking Action.
                            </li>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive pl-1 pt-3 list-sec" id="sailorTableArea">
                   <table id="sailorTable" class="table table-striped" width="100%">
                      <thead>
                         <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Tour Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Action</th>
                         </tr>
                      </thead>
                      <tbody></tbody>
                   </table>
                </div>
             </div>    
        </div>
    </div>
    <div class="modal fade upload-modal" id="tour_location_cancel" tabindex="-1" aria-labelledby="new-ban-3" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{asset('assets/dashboard/img/travel.png')}}" class="custompopicon">
                        <span class="text-white">  Cancel Tour</span>                        
                     </h5>
                    <button type="button" class="close cancelTourcloseSuccessBtn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                
                <div class="modal-body pb-0 agent-tour">
                    <form id="cancelTourForm" action="{{route('escort.tour.cancel_tour_location')}}" method="POST">
                        <h4>You are about to cancel your Tour. Are you sure you want to cancel your Tour?</h4>
                        <hr style="background-color: #0C223D" class="mt-3">
                        <input type="hidden" id="cancel_tour_id" value="119">
                        <div class="note">
                            <p class="font-weight-bold">Notes:</p>
                            <ol>
                                <li>If you cancel your Tour, any remaining Fees paid will be credited back to
                                    you. Cancellation is immediate.</li>
                                <li>You can reactivate this Tour by going to the Tours group in the menu.</li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-md-12 my-3 d-flex align-items-center justify-content-between">
                                <div class="">Date : <span>27-01-2026</span></div>

                                <div class="form-group mb-0">
                                    <input type="hidden" name="item_id">
                                    <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit" class="btn-success-modal ml-2 cancelTourbtn">Cancel Tour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
@endsection
@section('script') 
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
         url: "{{ route('escort.tour.dataTable','purchased') }}",
         data: function (d) {
          
         }
      },
      columns: [
        {
            className: 'dt-control',
            orderable: false,
            data: null,
            defaultContent: ''
        },
         { data: 'id', name: 'id' },
         { data: 'name', name: 'name' },
         { data: 'start_date', name: 'start_date' , searchable: false },
         { data: 'end_date', name: 'end_date' , searchable: false },
         { data: 'days_number', name: 'days_number' , searchable: false },
         { data: 'status', name: 'status' , orderable: false, searchable: false},
         { data: 'action', name: 'Action', orderable: false, searchable: false },
      ],
      order: [3,'asc'],
   });

   $('#sailorTable tbody').on('click', 'td.dt-control', function () {
        let tr  = $(this).closest('tr');
        let row = table.row(tr);
        let id  = row.data().id;
        console.log(id);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            return;
        }
         // Close other open rows (optional)
        table.rows('.shown').every(function () {
            this.child.hide();
            $(this.node()).removeClass('shown');
        });
        row.child(`
        <div class="p-3">
            <table class="table table-sm table-bordered w-100 child-table" id="child-table-${id}">
                <thead class="bg-first">
                    <tr>
                        <th>Location</th>
                        <th>Days</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Loading...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    `).show();

    tr.addClass('shown');
    loadChildTable(id);
   });
});
var loadChildTable = function(tour_id){
    $.ajax({
        url: '{{route("escort.tour.location_listing")}}',
        type: "POST",
        dataType: "json",
        data:{tour_id},
        beforeSend: function () {

        },
    }).done(function (response) {
        console.log(response);
        if (response.success) {
            $(`#child-table-${tour_id} tbody`).html(response.html);
        }
    }).fail(function (xhr, status, error) {
        console.error("Error:", error);
    });
}

$("#tour_location_cancel").on('show.bs.modal', function(event){
    let button = $(event.relatedTarget);
    $(this).find('input[name="item_id"]').val(button.data('item-id'));
});

$("#cancelTourForm").on('submit', function(e){
    e.preventDefault();
    let form = $(this);
    let url  = form.attr('action');
    $.ajax({
        url: url,
        method: form.attr('method'),
        data: form.serialize(),
        success: function (response) {
            console.log(response);
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        }
    });

});
    </script>
@endsection
