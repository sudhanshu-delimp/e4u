@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        #cke_1_contents {
            height: 150px !important;
        }

        /* table td,th{
                            border-top: 0px !important;
                            border: none;
                        }

                        table td,th{
                            border-top: 0px !important;
                            border: none;
                        } */
        .paging_simple_numbers {
            margin-top: 18px;
        }

        .dataTables_info {
            margin-top: 18px;
        }

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
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">Registrations</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b>
                </span>
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
                            <div class="stat-number">2</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                                <div class="stat-label">This Month</div>
                            </div>
                            <div class="stat-number">25</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="stat-label">This Year</div>
                            </div>
                            <div class="stat-number">125</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="stat-label">All Time</div>
                            </div>
                            <div class="stat-number">1,258</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive custom-badge">
                    <table class="table" id="RegistrationsReportTable" style="width: 100%">
                        <thead class="table-bg">
                            <tr>
                                <th>Ref</th>
                                <th>Member ID</th>
                                <th>Mobile</th>
                                <th>Home State</th>
                                <th>Agent ID</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- === Row 1 === -->
                            <tr>
                                <td>1435</td>
                                <td>V40161</td>
                                <td>5438 028 733</td>
                                <td>Qld</td>
                                <td>A125</td>
                                <td> <span class="badge badge-secondary">On Hold</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-pause-circle"></i> On Hold
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-check-circle "></i> Registered
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-times-circle "></i> Rejected
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-ban "></i> Cancelled
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-user-slash"></i> Suspended
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report"
                                                href="#" data-id="1435">
                                                <i class="fa fa-eye mr-2"></i> View
                                            </a>
                                        </div>
                                    </div>
                                </td>
                               
                            </tr>

                            <!-- === Row 2 === -->
                            <tr>
                                <td>1436</td>
                                <td>V40162</td>
                                <td>5438 111 222</td>
                                <td>NSW</td>
                                <td>A126</td>
                                <td><span class="badge badge-success">Registered</span></td>
                                <td class="text-center">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-pause-circle"></i> On Hold
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-check-circle "></i> Registered
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-times-circle "></i> Rejected
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-ban "></i> Cancelled
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item d-flex align-items-center gap-10" data-toggle="modal"
                                                data-target="#confirm-popup" href="#">
                                                <i class="fa fa-user-slash"></i> Suspended
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="view_member_report dropdown-item d-flex align-items-center gap-10 toggle-report"
                                                href="#" data-id="1436">
                                                <i class="fa fa-eye mr-2"></i> View
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr class="report-row d-none table-detail-row" id="report-1436">
                                <td colspan="7">
                                    <div class="card p-3">
                                        <h5 class="font-weight-bold">Registration Details</h5>
                                        <table class="table mb-0">
                                            <tr>
                                                <th>Ref:</th>
                                                <td class="border-0">1436</td>
                                                <th>Member ID:</th>
                                                <td class="border-0">V40162</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile:</th>
                                                <td class="border-0">5438 111 222</td>
                                                <th>Home State:</th>
                                                <td class="border-0">NSW</td>
                                            </tr>
                                            <tr>
                                                <th>Agent ID:</th>
                                                <td class="border-0">A126</td>
                                                <th>Status:</th>
                                                <td class="border-0">Registered</td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr> --}}

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
                        <img src="{{ asset('assets/dashboard/img/add-task.png') }}" alt="resolved" class="custompopicon">
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
    {{-- end notes --}}
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
  
    <script>
        $(document).ready(function () {
    var table = $('#RegistrationsReportTable').DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
        },
        paging: true,
        order: [[0, 'desc']]
    });

    // Toggle child rows
    $('#RegistrationsReportTable tbody').on('click', '.toggle-report', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var dataId = $(this).data("id");

        if (row.child.isShown()) {
            row.child.hide();
            $(this).html('<i class="fa fa-eye mr-2"></i> View');
        } else {
            // Replace below with dynamic HTML if needed
            var childHtml = `
                <div class="card p-3">
                    <h5 class="font-weight-bold text-blue-primary">Registration Details</h5>
                    <table class="table mb-0">
                        <tr>
                            <th>Ref:</th><td class="border-0">${dataId}</td>
                            <th>Member ID:</th><td class="border-0">V40161</td>
                        </tr>
                       
                        <tr>
                            <th>Mobile:</th>
                            <td class="border-0">5438 111 222</td>
                            <th>Home State:</th>
                            <td class="border-0">NSW</td>
                        </tr>
                        <tr>
                            <th>Agent ID:</th>
                            <td class="border-0">A126</td>
                            <th>Status:</th>
                            <td class="border-0">Registered</td>
                        </tr>
                        <!-- Add other rows -->
                    </table>
                </div>
            `;
            row.child(childHtml).show();
            $(this).html('<i class="fa fa-times mr-2"></i> Close');
        }
    });
});

    </script>
@endpush
