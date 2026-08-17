@extends('layouts.userDashboard')
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

        .table td,
        .table th {
            vertical-align: baseline !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <!-- Page Heading -->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1">My Report</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>You can view all of your Reports here. Simply search the report you are looking for by
                                searching the mobile number. Or scroll through the pages.</li>
                            <li>You can also select a Report/s you wish to edit or remove from your register by clicking
                                the appropriate button. Any Notebox you remove from your register will be permanently
                                removed.</li>
                            <li>New Reports when created or edited, are listed here. The status of the new Report
                                remains as Pending and is not available to other Viewers until approved and published.</li>
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
                                <div class="stat-label ">Today</div>
                            </div>
                            <div class="stat-number today_report">0</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-week"></i></div>
                                <div class="stat-label">This Month</div>
                            </div>
                            <div class="stat-number month_report">0</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div class="stat-label ">This Year</div>
                            </div>
                            <div class="stat-number year_report">0</div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-top">
                                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                                <div class="stat-label">All Time</div>
                            </div>
                            <div class="stat-number all_time_report">0</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-6 col-sm-12">
         <div class="add-punterbox-report">
            <form action="">
               <label class="search-label">Search by mobile number (no spaces)</label>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Search..." aria-label="Search by mobile" aria-describedby="button-search">
                  <div class="input-group-append">
                     <button class="btn btn-search" type="button" id="button-search">Search</button>
                  </div>
               </div>
            </form>
          </div>
      </div>
       --}}
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="myReportListTable" class="table">
                        <thead class="bg-first">
                            <tr>
                                <th>REF</th>
                                <th>Mobile</th>
                                <th>Incident Type</th>
                                <th>Incident Date</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--middle content end here-->
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myReportListTable').DataTable({

                "language": {
                    "zeroRecords": "No Record Found!",
                    searchPlaceholder: "Search by Mobile Number"
                },
                order: [],
                paging: true,
                processing: false,
                serverSide: false,

                lengthMenu: [{{ config('app.paginate_range') }}],
                pageLength: {{ config('app.paginate_length') }},
                ordering: true,
                columnDefs: [{
                        targets: 5,
                        orderable: false
                    } // Action column
                ],
                ajax: {
                    url: "{{ route('user.my-reports') }}",
                    type: "GET",
                    dataSrc: function(json) {
                        console.log("Received Data:", json.today);
                        $(".today_report").text(json.today);
                        $(".month_report").text(json.this_month);
                        $(".year_report").text(json.this_year);
                        $(".all_time_report").text(json.all_time);
                        return json.data;
                    }
                },
                columns: [{
                        data: 'ref',
                        name: 'ref'
                    },
                    {
                        data: 'escorts_mobile',
                        name: 'escorts_mobile',
                        render: function(data, type, row) {

                            let clean = $('<div>').html(data).text();
                            let normalized = clean.replace(/\s+/g, '');
                            if (type === 'sort' || type === 'filter') {
                                return normalized;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'incident_nature',
                        name: 'incident_nature'
                    },
                    {
                        data: 'incident_date',
                        render: function(data, type) {
                            if (!data) return '';

                            if (type === 'display') {
                                let date = data.split(' ')[0];
                                let parts = date.split('-');
                                return `${parts[2]}-${parts[1]}-${parts[0]}`;
                            }

                            return data;
                        }
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
                        searchable: false,
                        class: 'text-center'
                    }
                ]
            });

            // Toggle expandable rows
            $('body').on('click', '.toggle-details', function() {
                var targetId = $(this).data('target');
                $('#' + targetId).toggleClass('d-none');
                $(this).toggleClass('open');
            });


            $('#myReportListTable tbody').on('click', '.view_report', function(e) {
                e.preventDefault();

                const tr = $(this).closest('tr');
                const row = table.row(tr);

                if (row.child.isShown()) {

                    row.child().find('.child-wrapper').slideUp(250, function() {
                        row.child.hide();
                        tr.removeClass('shown');
                    });

                    $(this).removeClass('open');

                } else {

                    row.child(
                        '<div class="child-wrapper" style="display:none;">' +
                        format(row.data()) +
                        '</div>'
                    ).show();

                    row.child().find('.child-wrapper').slideDown(250);

                    tr.addClass('shown');
                    $(this).addClass('open');
                }
            });

            // CLOSE BUTTON HANDLER (only closes, no toggle)
            $(document).on('click', '.close_report_btn', function(e) {
                e.preventDefault();

                const childTr = $(this).closest('tr');
                const parentTr = childTr.prev(); // Parent row
                const row = table.row(parentTr);

                childTr.find('.child-wrapper').slideUp(250, function() {
                    row.child.hide();
                    parentTr.removeClass('shown');
                    parentTr.find('.view_report').removeClass('open');
                });
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
                        <div class="mb-3 d-flex justify-content-end">
                            <button class="btn-sm btn-cancel-modal close_report_btn" type="button"> Close</button>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                               <tr>
                                <th>Our Ref:</th>
                                <td class="border-0">${data.ref ?? 'N/A'}</td>

                                <th>Report Date:</th>
                                <td class="border-0">${formatDate(data.created_at)}</td>
                            </tr>

                            <tr>
                                <th>Incident Date:</th>
                                <td class="border-0">${formatDate(data.incident_date)}</td>

                                <th>Location:</th>
                                <td class="border-0">${data.location ?? 'N/A'}</td>
                            </tr>

                            <tr>
                                <th>Escort's name:</th>
                                <td class="border-0">${data.escorts_name ?? 'N/A'}</td>

                                <th>Escort's email:</th>
                                <td class="border-0">${data.escorts_email ?? 'N/A'}</td>
                            </tr>

                            <tr>
                                <th>Incident Type:</th>
                                <td class="border-0">${data.incident_nature ?? 'N/A'}</td>

                                <th>Rating:</th>
                                <td class="border-0">${data.rating ?? 'N/A'}</td>
                            </tr>

                            <tr>
                                <th>Platform:</th>
                                <td class="border-0">${data.platform ?? 'N/A'}</td>

                                <th>Profile Link:</th>
                                <td  class="border-0">${data.profile_link ?? 'N/A'}</td>
                            </tr>

                            <tr>
                                <th>Summary of Incident:</th>
                                <td colspan="3" class="border-0">
                                    ${data.what_happened ?? 'N/A'}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                `;
            }
        });

        $(document).on('click', '.delete_report', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let url = "{{ route('user.my-report.delete', ':id') }}";
            url = url.replace(':id', id);

            Swal.fire({
                title: 'Are you sure?',
                text: 'This action will permanently remove the report.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#3085d6'
                            });
                            $('#myReportListTable').DataTable().ajax.reload(null, false);
                        }
                    });

                }
            });
        });
    </script>
@endpush
