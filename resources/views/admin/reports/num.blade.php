@extends('layouts.admin')
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
                            <div class="stat-number today_report">2</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                                <div class="stat-label">This Month</div>
                            </div>
                            <div class="stat-number month_report">25</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="stat-label">This Year</div>
                            </div>
                            <div class="stat-number year_report">125</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="stat-label">All Time</div>
                            </div>
                            <div class="stat-number all_time_report">1258</div>
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

        {{-- confirm modal --}}
    <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog" aria-labelledby="confirmPopupLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id">
                    <input type="hidden" id="status_data_value">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"  class="custompopicon">
                        <span>Confirmation <span class="ref_clas"></span></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h6 class="popu_heading_style mt-2">
                        <span id="Lname">Are you sure you want to <span class="add_review_title"></span> this Report?</span>
                    </h6>

                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal" aria-label="Close">Save</button>
                </div>
            </div>
        </div>
    </div>


    {{-- published modal --}}
    <div class="modal fade upload-modal" id="confirm_publish_popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <h5 class="modal-title d-flex align-items-center " id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/published.png') }}" id="custompopicon" alt="published"
                            class="custompopicon">
                        <span class="success-modal-title">Published</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <h6 class="popu_heading_style mt-2">
                        <span id="" class="success-modal-text">We’re happy to inform you that your query
                        has been <br> successfully resolved.</span>
                    </h6>

                </div>

                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="button" class="btn-success-modal px-4" data-dismiss="modal"
                        aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>

        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myReportListTable').DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Mobile...",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                "language": {
                    "zeroRecords": "No Record Found!",
                    searchPlaceholder: "Search by member_id..."
                },
                paging: true,
                processing: false,
                serverSide: false,
                pageLength: 10,
                lengthMenu: [
                    [10, 20, 50, 100],
                    [10, 20, 50, 100]
                ],
                ordering: true,
                columnDefs: [{
                        targets: 5,
                        orderable: false
                    } // Action column
                ],
                ajax: {
                    url: "{{ route('admin.num.ajax') }}",
                    type: "GET",
                    dataSrc: function (json) {
                        console.log("Received Data:", json); // ✅ Debug here
                        $(".today_report").text(json.today);
                        $(".month_report").text(json.this_month);
                        $(".year_report").text(json.this_year);
                        $(".all_time_report").text(json.all_time);
                        return json.data; // ✅ Return the data array for DataTables to render
                    }
                },
                columns: [{
                        data: 'ref',
                        name: 'ref'
                    },
                    {
                        data: 'member_id',
                        name: 'member_id'
                    },
                    {
                        data: 'member_name',
                        name: 'member_name'
                    },
                    {
                        data: 'incident_date',
                        name: 'incident_date'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Handle expand/collapse
            $('#myReportListTable tbody').on('click', '.view_report', function(e) {
                e.preventDefault();

                const tr = $(this).closest('tr');
                const row = table.row(tr);

                if (row.child.isShown()) {
                    // Close the details
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).removeClass('open');
                } else {
                    // Open the details
                    console.log(row.data());
                    
                    row.child(format(row.data())).show();
                    tr.addClass('shown');
                    $(this).addClass('open');
                }
            });

            function formatDate(dateString) {
                if (!dateString) return 'N/A';
                const date = new Date(dateString);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function format(data) {
                return `
                    <div class="details-content p-3 bg-light border rounded">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Ref:</th>
                                    <td class="border-0">${data.ref ?? 'N/A'}</td>
                                    <th>Incident Date:</th>
                                    <td class="border-0">${data.incident_date ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Member ID:</th>
                                    <td class="border-0">${data.user.member_id ?? 'N/A'}</td>
                                    <th>Member Name:</th>
                                    <td class="border-0">${data.user.name ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Type:</th>
                                    <td class="border-0">${data.incident_nature ?? 'N/A'}</td>
                                    <th>Location:</th>
                                    <td class="border-0">${data.location ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Incident Create:</th>
                                    <td class="border-0">${formatDate(data.created_at) ?? 'N/A'}</td>
                                    <th>Status:</th>
                                    <td class="border-0">${data.status ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Summary of Incident:</th>
                                    <td colspan="3" class="border-0">${data.what_happened ?? 'N/A'}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }

            // $('#myReportListTable tbody').on('click', '.update_status', function(e) {
            //     e.preventDefault();

            //     const reportId = $(this).data('id');
            //     const newStatus = $(this).data('status');
            //     console.log('report & new ', reportId, newStatus);
                

              
            // });

            $(document).on('click', '.update_status', function(e) {
                e.preventDefault();
                let reportId = $(this).data('id');
                let status = $(this).data('status');
                let ref = $(this).data('ref');
                //let st = status == 'published' ? 'publish' : 'reject';

                if(status == 'on_hold'){
                    st = 'mark as on hold';
                }else if(status == 'rejected'){
                    st = 'reject';
                }else if(status == 'pending'){
                    st = 'pending';
                }else{
                    st = 'publish';
                }

                $('#status_data_id').val(reportId);
                $('#status_data_value').val(status);
                $('.add_review_title').text(st);
                //$('.ref_class').text(ref);
                //$("#success-popup").modal('show');

                console.log(reportId, status);  
                
            });

            $(document).on('click', '.saveStatus', function(e) {
                e.preventDefault();
                let reviewId = $('#status_data_id').val();
                let status = $('#status_data_value').val();
                var reviewData = {
                    'id' :reviewId,
                    'status' :status,
                }

                let imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
                if(status == 'published'){
                    $(".success-modal-title").text('Published');
                    imageUrl = '{{ asset("assets/dashboard/img/published.png") }}';
                    $("#custompopicon").attr('src', imageUrl );

                    $(".success-modal-text").text('This report is now Published');

                }else if(status == 'rejected'){
                    $(".success-modal-title").text('Rejected');
                    imageUrl = '{{ asset("assets/dashboard/img/rejected.png") }}';
                    $("#custompopicon").attr('src', imageUrl );
                    $(".success-modal-text").text('This report is now Rejected.');
                }else if(status == 'on_hold'){
                    $(".success-modal-title").text('On Hold');
                    $("#custompopicon").attr('src', imageUrl );
                    $(".success-modal-text").text('This report is now On Hold.');
                }else{
                    $(".success-modal-title").text('Pending');
                    $("#custompopicon").attr('src', imageUrl);
                    $(".success-modal-text").text('We’re sorry to inform you that your report has been updated to pending.');
                }
                
                var url = "{{route('admin.num.status.ajax')}}";
                updateMemberReportStatus(reviewData, url);
            });

            function updateMemberReportStatus(reportData, routeUrl)
            {
                const reportId = $(this).data('id');

                $.ajax({
                    url: routeUrl, // replace with your actual route
                    method: 'POST',
                    data:{
                        'id':reportData.id,
                        'status':reportData.status,
                    },
                    success: function(response) {
                        if(response.error == false){

                            $('#myReportListTable').DataTable().ajax.reload(null, false);
                            $("#confirm_publish_popup").modal('show');
                        }
                    },
                    error: function(xhr) {
                        console.error('Failed to fetch data');
                        $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
                    }
                });
            }

            $(document).on('click', '.close_report_btn', function(e) {
                e.preventDefault();
                $("#print-advertiser-reviews").hide();
            });


        });

    </script>
    
    </script>
@endpush
