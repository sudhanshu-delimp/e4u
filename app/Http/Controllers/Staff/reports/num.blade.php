@extends('layouts.staff')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .details-row {
            background-color: #f9f9f9;
        }

        .details-row th {
            color: var(--blue--text);
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">NUM Reports</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>NUM Reports is a consolidation of reports made by Escorts (<b>Report</b>) on their
                                respective clients. Reports are to be actioned within 24 hours.</li>
                            <li>To action a Report, other than approval (publish) or rejected, the Escort’s consent
                                must be obtained. Where a Report, in the view of administration staff, needs to be
                                amended, the Report can be amended and the amendment forwarded to the Escort
                                for approval (Support Ticket). The Member can not be contacted by phone.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
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
                            <div class="stat-number">1258</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myReportListTable" class="table">
                        <thead class="bg-first">
                            <tr>
                                <th>REF</th>
                                <th>Member ID </th>
                                <th>Member </th>
                                <th>Incident Date</th>
                                <th>Incident Location</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123</td>
                                <td>E40161</td>
                                <td>Julie</td>
                                <td>03-05-2025</td>
                                <td>Brisbane</td>
                                <td>Pending</td>
                                 <td class="text-center"> 
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">

                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#"> <i class="fa fa-pause-circle"></i> On Hold</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#edit_req"> <i class="fa fa-check-circle"></i> Publish</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#renew_req"> <i class="fa fa-times-circle "></i>Rejected </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center gap-10 justify-content-start" href="#" data-toggle="modal" data-target="#reject_popup"> <i class="fa fa-eye"></i> View Report </a>
                                 </div>
                              </div>
                           </td>
                                
                            </tr>

                          


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--middle content end here-->
    </div>
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        var table = $("#myReportListTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Memeber ID"
            },
            info: true,
            paging: true,
            lengthChange: true,
            searching: true,
            bStateSave: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.toggle-details').on('click', function() {
                const $this = $(this);
                const $row = $this.closest('tr');
                const $nextRow = $row.next('.details-row');

                // Close all others
                $('.details-row').not($nextRow).addClass('d-none');

                // Toggle current
                $nextRow.toggleClass('d-none');
            });
        });
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
