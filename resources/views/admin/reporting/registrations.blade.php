@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        #cke_1_contents {
            height: 150px !important;
        }

        .paging_simple_numbers {
            margin-top: 18px;
        }
.table-responsive{
            overflow: visible;
        }
        /* .dataTables_info {
                margin-top: 18px;
            } */

        .table-report-info tr td {
            border: 0;
        }

        .popu_heading_style {
            font-family: Poppins;
            font-style: normal;
            font-weight: 500;
            font-size: 20px;
            line-height: 29px;
            color: #0C223D;
        }

        .dropdown-menu-background-color {
            color: #2e2f37;
            text-decoration: none;
            background-color: #eaecf4;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Registrations</h1>
                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                    </h6>
                </div>
                @if (request('from') !== 'sidebar')
                    <div class="back-to-dashboard">
                        <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Registrations is a consolidation of new registrations for Advertisers, Agents and
                                Viewers (<b>Registration</b>).</li>
                            <li>The Operations Team can action a Registration.</li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="stats-container">
                    <div class="stat-card-wrapper">
                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-day"></i></div>
                                <div class="stat-label">Today</div>
                            </div>
                            <div class="stat-number">{{ $todayCount }}</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                                <div class="stat-label">This Month</div>
                            </div>
                            <div class="stat-number">{{ $thisMonthCount }}</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="stat-label">This Year</div>
                            </div>
                            <div class="stat-number">{{ $thisYearCount }}</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="stat-label">All Time</div>
                            </div>
                            <div class="stat-number">{{ $allTimeCount }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 ">
                <div class="table-responsive custom-badge">
                    <table class="table" id="RegistrationsReportTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Ref</th>
                                <th>Member ID</th>
                                <th>Mobile</th>
                                <th>Home State</th>
                                <th>Agent ID</th>
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

        <!--middle content end here-->
        <!--right side bar start from here-->
    </div>
    <!--right side bar end-->
    </div>

    <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id">
                    <input type="hidden" id="status_data_value">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                            class="custompopicon">
                        <span>Confirmation</span>
                    </h5>
                    <input type="hidden" id="status_data_id" name="status_data_id" value="">
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                        aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal"
                        data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="success_popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/unblock.png') }}" alt="resolved" class="custompopicon">
                        <span class="success-modal-title">Resolved</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h6 class="popu_heading_style mt-2">
                        <span class="Lname success-modal-text">We’re happy to inform you that your query has been <br>
                            successfully resolved.</span>
                    </h6>

                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-success-modal" data-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>


    {{-- add notes  --}}
    <div class="modal fade upload-modal" id="add-note-popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/add-task.png') }}" alt="resolved"
                            class="custompopicon">
                        Add Note
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body">
                    <form>
                        <!-- Notes -->
                        <div class="form-group mb-3">
                            <label for="notes"><strong>Notes:</strong></label>
                            <textarea id="notes" name="notes" class="form-control" rows="3" placeholder="Enter notes here..."></textarea>
                        </div>


                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name"><strong>Name:</strong></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter name">
                        </div>

                        <!-- Signature -->
                        <div class="form-group mb-3">
                            <label for="signature"><strong>Signature:</strong></label>
                            <input type="text" id="signature" name="signature" class="form-control"
                                placeholder="Enter signature">
                        </div>
                        <!-- Management Only Section -->
                        <div class="form-group mb-3 d-flex align-items-center justify-content-start gap-10">
                            <label><strong>Management Only:</strong></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cancelMembership"
                                    name="management_action" value="cancel">
                                <label class="form-check-label" for="cancelMembership">Cancel Membership</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="reinstateMembership"
                                    name="management_action" value="reinstate">
                                <label class="form-check-label" for="reinstateMembership">Re-instate Membership</label>
                            </div>
                        </div>


                    </form>
                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-cancel-modal px-4" data-dismiss="modal"
                        aria-label="Close">Cancel</button>
                    <button type="button" class="btn-success-modal px-4" data-dismiss="modal"
                        aria-label="Close">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="viewMemberdetails" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>
    <div class="modal fade upload-modal" id="rejectRegReason" tabindex="-1" role="dialog"
        aria-labelledby="Edit_CompetitorLabel" aria-hidden="true"></div>

    <!-- ****** for reject registration confirm pop-up*********** -->
    <div class="modal fade upload-modal" id="reject-registration-confirm-popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_value">
                    <input type="hidden" id="user_id">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                            class="custompopicon">
                        <span>Confirmation</span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                        aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal"
                        data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>

    {{-- end notes --}}
@endsection


@push('script')
    {{-- <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}

    <script>
        var table = $("#RegistrationsReportTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID",
            },

            processing: true,
            serverSide: true,
            lengthChange: true,
            searchable: false,
            bStateSave: false,

            ajax: {
                url: "{{ route('admin.get_registration_report') }}",
                data: function(d) {
                    d.type = 'player';
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'member_id',
                    name: 'member_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'phone',
                    name: 'phone',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'territory',
                    name: 'territory',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'referred_by_agent_id',
                    name: 'referred_by_agent_id',
                    searchable: true,
                    orderable: true,
                    defaultContent: '--'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],

            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10,
            multiSort: true
        });


        // change status via ajax

        $(document).on('click', '.dropdown-item[data-status-num]', function() {

            const userId = $(this).data('user-id');
            const status = $(this).data('status-num');
            // Store in hidden inputs inside modal
            $('#status_data_id').val(userId);
            $('#status_data_value').val(status);
        });


        // save status code here 

        $(document).on('click', '.saveStatus', function() {
            const userId = $('#status_data_id').val();
            const status = $('#status_data_value').val();

            let data = {
                user_id: userId,
                status: status,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Only add reject_reason if status = 7
            if (status == 7) {
                data.reject_reason = $('.reject-reason').val();
            }

            $.ajax({
                url: "{{ route('admin.change-user-status') }}",
                type: "POST",
                data: data,
                success: function(res) {
                    if (res.success) {
                        if (typeof table !== "undefined") {
                            // Refresh datatable if exists
                            table.ajax.reload(null, false);
                            Swal.close();
                            swal_success_popup("User status has been updated successfully.");
                        }
                        $('.btn-cancel-modal').trigger('click')
                    } else {
                        Swal.close();
                        swal_error_popup(xhr.responseJSON.message);
                    }
                },
                error: function() {
                    alert("Server error!");
                }
            });
        });

        ///////// View Member Details //////////////////////////////
        $(document).on('click', '.view_member_report', function(e) {
            var requestId = $(this).data('id');
            var rowData = table.row($(this).parents('tr')).data();
            const safeData = JSON.stringify(rowData).replace(/'/g, "&apos;").replace(/"/g, "&quot;");

            console.log(rowData);

            let user_img = "{{ asset('assets/img/default_user.png') }}";
            let avatar_base = "{{ asset('avatars') }}/";
            if (rowData.avatar_img !== "" && rowData.avatar_img !== null)
                user_img = avatar_base + rowData.avatar_img;


            var modal_html = `<div id="account-row-${requestId}" class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmationPopup">
                                            <img src="{{ asset('assets/dashboard/img/view-merchant.png') }}" style="width:40px; margin-right:10px;" alt="Request Accepted"> 
                                            View Member Details
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                                        </button>
                                    </div>
                                    <div class="modal-body pb-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card mb-3 p-3">
                                                    <!-- Details Table -->
                                                    <table class="table table-bordered mb-3">
                                                        <tr><th>Name</th><td>${rowData.name ? rowData.name : 'NA'}</td></tr>
                                                        <tr><th>Member ID</th><td>${rowData.member_id ? rowData.member_id : 'NA'}</td></tr>
                                                        <tr><th>Mobile</th><td>${rowData.phone ? rowData.phone : 'NA'}</td></tr>
                                                        <tr><th>Email</th><td>${rowData.email ? rowData.email : 'NA'}</td></tr>
                                                        <tr><th>Home State</th><td>${rowData.territory ? rowData.territory : 'NA'}</td></tr>
                                                        <tr><th>Agent ID</th><td>${rowData.referred_by_agent_id ? rowData.referred_by_agent_id : '--'}</td></tr>
                                                        <tr><th>Status</th><td>${rowData.status ? rowData.status : 'NA'}</td></tr>`;

                                        if (rowData.status === 'Rejected' && rowData.rejection_reason) {
                                            modal_html += `<tr><th>Rejection Reason</th><td>${rowData.rejection_reason}</td></tr>`;
                                        }

                                        modal_html += `</table>
                                <div class="d-flex justify-content-end mb-2">
                                    <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
                            </div>`;

            $('#viewMemberdetails').html(modal_html);
            $('#viewMemberdetails').modal('show');

        });



        ///////// reject reason modal //////////////////////////////
        $(document).on('click', '.reject-registration-btn', function(e) {
            var currentStatus = $(this).closest('.dropdown.no-arrow').data('current-status');

            if (currentStatus != 6) {
                var requestId = $(this).data('id');
                var modal_html = `<div id="account-row-${requestId}" class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="confirmationPopup"> <i class="fa fa-exclamation-triangle text-danger"></i>
                                        Reject Reason
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                                    </button>
                                 </div>
                                 <div class="modal-body pb-0">
                                       <div class="row">
                                          <div class="col-12">
                                                
                                          <div class="card mb-3 p-3">
                                              <div class="row">
                                                <div class="col-12 mb-12">
                                                    <textarea class="form-control reject-reason" placeholder="Enter Reason"></textarea>
                                                </div>
                                              </div>
                                                <div class="d-flex justify-content-end  mt-2">
                                                   <!-- Print Button -->  
                                                 <button type="button" class="btn-success-modal mr-2 mt-3 confirm-reject-registration" data-toggle="modal">Save</button>
                                                <button type="button" class="btn-cancel-modal mr-2 mt-3" data-dismiss="modal" aria-label="Close">Close</button>
                                                </div>
                                             </div>
                                                   
                                          </div>
                                       </div>
                                 </div>
                              
                              </div>
                           </div>`;


                $('#viewMemberdetails').html(modal_html);
                $('#viewMemberdetails').modal('show');
            } else {
                $('#confirm-popup').modal('show');
            }
        });

        $(document).on("click", ".confirm-reject-registration", function(e) {
            e.preventDefault();

            var reason = $(".reject-reason").val().trim();

            // remove previous error
            $(".reject-reason-error").remove();

            if (reason === "") {
                $(".reject-reason").after(
                    '<small class="text-danger reject-reason-error">Reason is required.</small>');
                $("#reject-registration-confirm-popup").modal("hide");
                return false;
            }

            // open modal if valid
            $("#reject-registration-confirm-popup").modal("show");
        });
    </script>
@endpush
