@extends('layouts.escort')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Playmates</h1>
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
                      <p></p>
                      <ol>
                            <li>Your Playmates are listed here which you can view and manage.</li>
                            <li>To remove a Playmate from your Playmate list, simply click the 'Remove' link in Action.
                                Please note that when you remove a Playmate, they are also removed from all of your
                                Profiles where the Playmate is currently attached to.</li>
                            <li>You can also view your Profiles that a Playmate is attached to by clicking the 'List' link
                                in Action.</li>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        <div class="row my-2">
            <!-- My Playmates -->
            <div class="col-md-12 mb-4">
                <div class="table-responsive-xl">
                  <table class="table table-bordered" id="playmateListTable_2" style="border: none;">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                      <tr>
                        <th class="text-left">Playmate</th>
                        <th class="text-left">Current Location</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                   <body>
                    <tr role="row" class="odd">
                        <td class="sorting_1">Kendra | E20118</td>
                        <td>Uttar Pradesh</td>
                        <td>Unlisted</td>
                        <td><div class="dropdown no-arrow archive-dropdown">
                        <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style=""><a class="dropdown-item d-flex align-items-center justify-content-start gap-10" id="cdTour" href="https://e4udev2.perth-cake1.powerwebhosting.com.au/escort-dashboard/create-tour/28"> <i class="fa fa-eye "></i> View</a></div></div>
                    </td>
                </tr>
                   </body>
                  </table>
                </div>
              </div>
        </div>
@endsection
@section('style')
  
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
    var table; 
    $(document).ready(function () {
    table = $('#playmateListTable').DataTable({
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
            url: "{{ route('escort.dashboard.my-playmates') }}",
            type: "POST",
            data: function (d) {
            
            }
        },
        columns: [
            { data: 'stage_name', name: 'id' },
            { data: 'current_location', name: 'current_location' },
            { data: 'status', name: 'status' , orderable: false, searchable: false},
            { data: 'action', name: 'Action', orderable: false, searchable: false },
        ]
        });

        // Add placeholder to search input
        $('#sailorTable_filter input').attr('placeholder', 'Search by ID or Tour Name');
    });
    </script>
@endsection
