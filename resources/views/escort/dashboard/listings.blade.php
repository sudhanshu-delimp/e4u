@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .select2-container .select2-choice,
        .select2-result-label {
            font-size: 1.5em;
            height: 52px !important;
            overflow: auto;
        }

        .select2-arrow,
        .select2-chosen {
            padding-top: 6px;
        }

        span.select2.select2-container.select2-container--default>span.selection>span {
            height: 52px !important;
        }

        #listings_length {
            width: 30%;
            top: 40px;
            position: relative;
        }

        .brb_icon {
            color: white;
            background-color: #e5365a;
            border-radius: 15%;
            padding: 0 5px;
        }

        .list-sec td {
            font-size: 16px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">{{ ucfirst($type) }} Listings</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="profile_and_tour_options">
                <div class="row collapse" id="notes">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <?php
                            if ($type == "current") {
                            ?>
                            <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol>
                                <li>Use this feature to check all of your current listings, no matter the Location. This
                                    report does not include listings associated with a Tour.
                                </li>
                                <li>You can change the Profile listing by selecting 'Action'. You will be able to:
                                    <ol type="a" class="ol_lower_alpha_bracket">
                                        <li>Edit, Suspend or Delete the listing; and</li>
                                        <li>Switch on and off your Be Right Back (<b>BRB</b>) notification. When you activate
                                            your BRB, a floating notification will appear at the top of your Profile
                                            advising when you will be returning, but allowing your Profile still to be
                                            viewed.
                                        </li>
                                    </ol>
                                </li>
                                <li>Where you suspend a listing that is currently Listed, you will not be refunded any
                                    Fee.
                                </li>
                            </ol>
                            <?php
                            } else if ($type == "past") {
                            ?>
                                <h3 class="NotesHeader"><b>Notes:</b></h3>
                                <ol>
                                    <li>Use this feature to view or delete any of your past Profile listings.</li>
                                    <li>You can re-post a Profile by selecting 'Re-Post' under the Action function.</li>
                                    <li>Old Profile listings will purge when you delete the Profile from your Archives or
                                        the Profile has not been active for 2 years.
                                    </li>
                                </ol>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive custom-table-responsive pl-1 pt-3 list-sec">
                            <table id="listings" class="table table-striped custom--common-table" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Profile Name</th>
                                        <th>Location</th>
                                        <th>Stage Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Days</th>
                                        <th>Membership</th>
                                        <th>Status</th>
                                        <th>Fee @if ($type == 'past')
                                                Paid
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                        $dataTableData = [];

                                        
                                    @endphp

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
              var shouldHide = true;
            var table = $("#listings").DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,
                pageLength: 10,
                "language": {
                    "zeroRecords": "There is no record of the search criteria you entered.",
                    searchPlaceholder: "Search by ID or Profile Name"
                },
                drawCallback: function(settings) {
                    var api = this.api();
                    //var records = api.data().length;
                    var length = table.page.info().recordsTotal;
                    if (length <= 10) {
                       $('.dataTables_paginate').show();
                    } else {
                       $('.dataTables_paginate').show();
                    }
                },
                initComplete: function() {
                    if ($('#returnToReportBtn').length === 0) {
                        $('.dataTables_filter').append(
                            '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                        );
                    }
                    $('#returnToReportBtn').on('click', function() {
                        var table = $('#listings').DataTable();
                        table.search('').draw();
                    });
                },
                ajax: {
                    url: "{{ route('escort.list.dataTableListing', $type) }}",
                    data: function(d) {
                        d.type = 'player';
                      //  d.type = "{{$type}}";
                    }
                },

                columns: [{
                        data: 'id',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'profile_name'
                    },
                    {
                        data: 'location',
                        searchable: false,
                    },
                    {
                        data: 'stage_name',
                        searchable: true,
                    },
                    {
                        data: 'start_date',
                        searchable: false,
                    },
                    {
                        data: 'end_date',
                        searchable: false,
                    },
                    {
                        data: 'days_number',
                        searchable: false
                    },
                     { data: 'membership', name: 'membership', searchable: false, orderable:true ,defaultContent: 'NA', visible: shouldHide},
                     {
                        data: 'status',
                        searchable: false
                    },
                    {
                        data: 'fee',
                        searchable: false
                    }
                ]
            });
            
        })
    </script>
@endpush
