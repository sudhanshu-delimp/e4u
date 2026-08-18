@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
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

    .toggle-details i {
        color: #333;
        transition: color 0.3s ease, transform 0.2s ease;
    }

    .toggle-details.open i {
        transform: rotate(90deg);
        color: #ff3c5f;
    }

    .tooltip-inner {
        background-color: #000 !important;
        color: #fff;
        font-weight: 500 !important;
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .tooltip.bs-tooltip-top .arrow::before {
        border-top-color: #000 !important;
    }

    .table.num_view_table th {
        font-weight: bold;
        color: var(--blue--text);
        padding: 5px !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Dashboard</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                </h6>
            </div>
            @if (request('from') == 'dashboard')
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
            @endif
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <ol>
                        <li>The Punterbox register <b>(Punterbox)</b> is a free service to all Viewers. You can use
                            the Punterbox service at any time. Your details, when you undertake a search, are
                            kept confidential.</li>
                        <li>You can only search for an Escort by their mobile number. Search your next
                            booking by their mobile number itself, e.g. 0400123456. Do not include any
                            prefixes, e.g. +61 or spaces.
                        </li>
                        <li>E4U makes no claims:</li>
                        <ol class="level-2">
                            <li>as to the accuracy or legitimacy of the allegations contained in a Report; and</li>
                            <li>nor do we investigate the authenticity of the Reports (provided in confidence
                                by Viewers).</li>
                        </ol>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Heading -->

    <div class="row">
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
   </div> --}}
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
            order: [
                [3, 'desc']
            ],
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
                url: "{{ route('user.punterboxdashboard') }}",
                type: "GET",
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
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                }
            ]
        });

        // Handle expand/collapse
        $(document).on('click', '#myReportListTable .toggle-details', function(e) {
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
                    <div class="details-content p-3">
                        <table class="table mb-0 num_view_table">
                            <tbody>
                                <tr>
                                    <th>Ref:</th>
                                    <td class="border-0">${data.ref ?? 'N/A'}</td>
                                    <th>Incident Date:</th>
                                    <td class="border-0">${formatDate(data.incident_date) ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Escorts's name:</th>
                                    <td class="border-0">${data.escorts_name ?? 'N/A'}</td>
                                    <th>Incident Type:</th>
                                    <td class="border-0">${data.incident_nature ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Report Date:</th>
                                    <td class="border-0">${formatDate(data.created_at) ?? 'N/A'}</td>
                                    <th>Location:</th>
                                    <td class="border-0">${data.location ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Escorts's email:</th>
                                    <td class="border-0">${data.escorts_email ?? 'N/A'}</td>
                                    <th>Rating:</th>
                                    <td class="border-0">${data.rating ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                     <th>Platform:</th>
                                    <td  class="border-0">${data.platform ?? 'N/A'}</td>
                                     <th>Profile Link:</th>
                                    <td  class="border-0">${data.profile_link ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Summary of Incident:</th>
                                    <td  class="border-0">${data.what_happened ?? 'N/A'}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                `;
        }

    });
</script>
@endpush
