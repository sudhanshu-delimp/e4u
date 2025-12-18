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
                <div class="table-responsive">
                  <table class="table w-100" id="playmateListTable" style="border: none;">
                    <thead style="background-color: #0C223D; color: #ffffff;">
                      <tr>
                        <th class="text-left">Profile</th>
                        <th class="text-left">Playmates</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                   <body>
                   
                   </body>
                  </table>
                </div>
              </div>
        </div>
        <div class="modal fade upload-modal" id="playmates_listings" tabindex="-1" role="dialog" aria-labelledby="extendProfileTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 800px;position: absolute;top: 30px;">
                    <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/app/img/playmate-30.png') }}" class="custompopicon" alt="extend" style="margin-right: 10px;">
                        Playmates List
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="table-responsive">
                                <table class="table w-100" id="playmateListModalTable" style="border: none;">
                                <thead style="background-color: #0C223D; color: #ffffff;">
                                    <tr>
                                    <th class="text-left">Playmates</th>
                                    <th class="text-center">Current Location</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <body>
                                
                                </body>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="modal-footer" style="text-align: center; display: block;"></div>
                </div>
            </div>
        </div>

        <div class="modal fade upload-modal" id="playmates_operations" tabindex="-1" role="dialog" aria-labelledby="extendProfileTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="width: 700px;position: absolute;top: 30px;">
                    <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{asset('assets/app/img/playmate-30.png')}}" class="custompopicon" alt="extend" style="margin-right: 10px;">
                        Add Playmates
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                        <img id="modal_close_extend" src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                    </div>

                    <div class="modal-body playmate_modal_cards">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="profileSearch"></label>
                                        <input type="text" class="form-control" id="profileSearch" placeholder="Search Member ID to add Playmate to the Profile...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form id="myplaymates" action="#" method="Post">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="playmates-card-grid">
                                            
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <button id="my_playmates" type="submit" class="save_profile_btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="modal-footer" style="text-align: center; display: block;">
                        
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('style')
  
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('js/escort/profile_playmate.js') }}"></script>
    <script>
        window.App = window.App || {};
        var table; 
        $(document).ready(function () {
            table = $('#playmateListTable').DataTable({
                serverSide: true,
                processing: true,
                "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                    searchPlaceholder: "Search by Profile Name"
                    },
                initComplete: function() {
                    if ($('#returnToReportBtn').length === 0) {
                    $('.dataTables_filter').append(
                            '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                    );
                    }
                    $('#returnToReportBtn').on('click', function() {
                        var table = $('#playmateListTable').DataTable();
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
                    { data: 'profile_stage_name', name: 'name'},
                    { data: 'playmates',orderable: false, searchable: false},
                    { data: 'action', name: 'Action', orderable: false, searchable: false, className: 'text-center' },
                ]
                });

                // Add placeholder to search input
                $('#sailorTable_filter input').attr('placeholder', 'Search by ID or Tour Name');
        });

        let playmateTable;
        $('#playmates_listings').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let escortId   = button.data('escort-id');
            if ($.fn.DataTable.isDataTable('#playmateListModalTable')) {
                playmateTable.destroy();
                $('#playmateListModalTable body').empty();
            }
            playmateTable = $('#playmateListModalTable').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            ajax: {
                url: "{{ route('escort.dashboard.get-playmate-listings') }}",
                type: "POST",
                data: function (d) {
                    d.escort_id = escortId;
                }
            },
            columns: [
                { data: 'playmate_stage_name', name:'name'},
                { data: 'current_location', orderable: false, className: 'text-center'},
                { data: 'status', orderable: false, className: 'text-center'},
                { data: 'action', orderable: false, className: 'text-center'}
            ]
            });
        });

        $(document).on('click', '.trash-playmate', function () {
            let obj = $(this);
            let playmateHistoryId = obj.data('id');
            Swal.fire({
                title: 'My Playmates',
                text: "Are you sure you want to remove this Playmate? Both Profiles will be removed from each other's Playmate lists.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (!result.isConfirmed) return;
                    $.ajax({
                    url: "{{ route('escort.dashboard.trash-playmate-history') }}",
                    type: "POST",
                    data: {playmateHistoryId},
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Please wait...',
                            text: 'Removing...',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },

                    success: function (response) {
                        Swal.close();
                        if (response.success === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Removed!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            playmateTable.draw();
                            table.draw();
                        } else {
                            Swal.fire('Error', response.message || 'Something went wrong', 'error');
                        }
                    },

                    error: function (xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let firstError = Object.values(errors)[0][0];
                            Swal.fire('Validation Error', firstError, 'warning');
                        }
                        else if (xhr.status === 500) {
                            console.log('xhr', xhr);
                            Swal.fire('Server Error', xhr.statusText, 'error');
                        }
                        else {
                            Swal.fire('Network Error', 'Check your internet connection', 'error');
                        }
                    }
                });
            });
        });

        $('#playmates_operations').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let escortId   = button.data('escort-id');
            let stateId   = button.data('state-id');
            window.App.escortId = escortId;
            window.App.stateId = stateId;
            let storePlaymateUrl = "{{ route('escort.store.playmates', ':escortId') }}";
            $("#myplaymates").attr('action',storePlaymateUrl.replace(':escortId', escortId));
            getAvailablePlaymates();
        });

        $('#playmates_operations').on('hide.bs.modal', function (event) {
            table.draw();
        });
    </script>
@endsection
