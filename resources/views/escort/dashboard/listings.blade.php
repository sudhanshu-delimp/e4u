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
            <div class="col-md-12">
                <div class="v-main-heading h3" style="display: inline-block;">{{ ucfirst($type) }} Listings</div>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-4" id="profile_and_tour_options">
                <div class="row collapse" id="notes">
                    <div class="col-md-12 mb-5">
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
                                <li>Where you suspend a listing that is currently posted, you will not be refunded any
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

                                        /*foreach ($relatedEscorts as $escort) {
                                            if ($escort['purchase']) {
                                                foreach ($escort['purchase'] as $purchase) {
                                                    $brb = $escort['profile_name'];
                                                    $totalAmount = 0;
                                                    if (isset($escort['brb'][0]['brb_time'])) {
                                                        $brb =
                                                            '<span id="brb_' .
                                                            $escort['id'] .
                                                            '" >' .
                                                            $escort['profile_name'] .
                                                            ' <sup
                                            title="Brb at ' .
                                                            date(
                                                                'd-m-Y h:i A',
                                                                strtotime($escort['brb'][0]['brb_time']),
                                                            ) .
                                                            '"
                                            class="brb_icon">BRB</sup></span>';
                                                    }
                                                    if (!empty($purchase['start_date'])) {
                                                        $daysDiff = Carbon\Carbon::parse(
                                                            $purchase['end_date'],
                                                        )->diffInDays(Carbon\Carbon::parse($purchase['start_date']));
                                                        [$discount, $rate] = calculateTatalFee(
                                                            $purchase['membership'],
                                                            $daysDiff,
                                                        );
                                                        $totalAmount = $rate;
                                                        $totalAmount -= $discount;
                                                        $totalAmount = formatIndianCurrency($totalAmount);
                                                    }
                                                    $dataTableData[] = [
                                                        //'sl_no' => $i++,
                                                        'sl_no' => $escort['id'],
                                                        //'profile_name' => $escort['profile_name'],
                                                        'profile_name' => $escort['profile_name'] ? $brb : 'NA',
                                                        //'city' =>
                                                        config(
                                                            "escorts.profile.states.$escort[state_id].cities.$escort[city_id].cityName",
                                                        ) .
                                                        '<br>' .
                                                        config("escorts.profile.states.$escort[state_id].stateName"),
                                                        'city' => config(
                                                            "escorts.profile.states.$escort[state_id].stateName",
                                                        ),
                                                        'name' => $escort['name'],
                                                        'start_date' => date(
                                                            'd-m-Y',
                                                            strtotime($purchase['start_date']),
                                                        ),
                                                        'end_date' => date('d-m-Y', strtotime($purchase['end_date'])),
                                                        'days' => Carbon\Carbon::parse(
                                                            $purchase['end_date'],
                                                        )->diffInDays(Carbon\Carbon::parse($purchase['start_date'])),
                                                        'fee' => $totalAmount,
                                                    ];
                                                }
                                            }
                                        }*/
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
             //var shouldHide = '{{$type == "past" ? false :true}}';
              var shouldHide = true;
            var table = $("#listings").DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                searchable: false,
                bStateSave: false,
                pageLength: 10,
                "language": {
                    "zeroRecords": "No record(s) found.",
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
                ajax: {
                    url: "{{ route('escort.list.dataTableListing', $type) }}",
                    data: function(d) {
                        d.type = 'player';
                      //  d.type = "{{$type}}";
                    }
                },
                // data: <?php echo json_encode($dataTableData); ?>,
                /*@if ($type == 'past')
                    order: [
                        [4, 'desc']
                    ],
                @else
                    order: [
                        [4, 'asc']
                    ],
                @endif*/
                columns: [{
                        data: 'id',
                        searchable: true,
                        orderable: false
                    },
                    {
                        data: 'profile_name'
                    },
                    {
                        data: 'city',
                        searchable: false,
                    },
                    {
                        data: 'name',
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
                        data: 'days',
                        searchable: false
                    },
                     { data: 'membership', name: 'membership', searchable: false, orderable:true ,defaultContent: 'NA', visible: shouldHide},
                    {
                        data: 'fee',
                        searchable: false
                    }
                ]
            });
            // $('#listings_filter label').append('<i class="fa fa-search "></i>');
        })
    </script>
@endpush
