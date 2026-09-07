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

    /* .dataTables_filter label {
            display: none;
        } */
    /* .dataTables_length{
            display: none;
        } */
    #escort_listings {
        /* margin-bottom: 0px !important; */
    }

    .brb_icon {
        color: white;
        background-color: #e5365a;
        border-radius: 15%;
        padding: 0 5px;
    }

    .extend_icon {
        color: white;
        background-color: #1cc88a;
        border-radius: 15%;
        padding: 0 5px;
    }

    #escort_listings_paginate span {
        display: contents;
    }

    table.dataTable thead th,
    table.dataTable tfoot th {
        font-weight: normal !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content-->
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between col-md-12">
            <div class="custom-heading-wrapper">
                <h1 class="h1">Escort Listings</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b> </span>
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
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All current (published) Listings are displayed in this table.</li>
                        <li>You have limited Action access according to your security level.</li>
                        <li>Prefixes:</li>
                        <p>1. ACT &nbsp;&nbsp;2. NSW &nbsp;&nbsp;3. Vic &nbsp;&nbsp;4. Qld &nbsp;&nbsp;5. SA
                            &nbsp;&nbsp;6. W A &nbsp;&nbsp;7. Tas &nbsp;&nbsp;8. NT</p>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-12 d-flex justify-content-between" style="gap: 20px;">
            <a class="nav-link collapse-item btn-switch" href="{{ route('admin.massage-centre-listings') }}">
                Switch to Massage Centre Listings
            </a>
            <div class="d-flex justify-content-end" style="gap: 20px;">

                <div class="total_listing">
                    <div><span>Platinum : </span></div>
                    <div><span class="platinumListing">0</span></div>
                </div>
                <div class="total_listing">
                    <div><span>Gold : </span></div>
                    <div><span class="goldListing">0</span></div>
                </div>
                <div class="total_listing">
                    <div><span>Silver : </span></div>
                    <div><span class="silverListing">0</span></div>
                </div>
                <div class="total_listing">
                    <div><span>Free : </span></div>
                    <div><span class="freeListing">0</span></div>
                </div>
                <div class="total_listing">
                    <div><span>Suspend : </span></div>
                    <div><span class="suspendListing">0</span></div>
                </div>
                <div class="total_listing">
                    <div><span>Total Listings : </span></div>
                    <div><span class="totalListing">0</span></div>
                </div>
            </div>
        </div>

    </div>
    <div class="massage_table_class">
        <table class="table" id="escort_listings" style="width:100%;">
            <thead class="table-bg">
                <tr>
                    <th>Member ID</th>
                    <th>Member</th>
                    <th>Listing</th>
                    <th>Profile Name</th>
                    <th>Membership</th>
                    <th style="90px;!important;">Listed</th>
                    <th style="90px;!important;">De-listed</th>
                    <th>Days</th>
                    <th>Remaining</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-content">
                <tr>
                    <td colspan="11" class="theme-color text-center">Loading...</td>
                </tr>
            </tbody>
            <tr>
                <th colspan="11" class="border-0"></th>
            </tr>
            <tfoot class="bg-first t-foot">
                <tr>
                    <th colspan="3" class="text-left border-0">Server time: <span
                            class="serverTime">{{ date('d-m-Y h:i a') }}</span></th>
                    <th colspan="4" class="text-center border-0">Refresh time:<span class="refreshSeconds"> 15</span>
                    </th>
                    <th colspan="4" class="text-right border-0">Up time: <span
                            class="uptimeClass">{{ getAppUptime() }}</span></th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>
</div>
</div>

<!--middle content end here-->
<!--right side bar start from here-->
</div>
<!--right side bar end-->
</div>


<!-- See Email Report popup -->


<div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog"
    aria-labelledby="emailReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="emailReport"><img
                        src="{{ asset('assets/dashboard/img/view-listing.png') }}" class="custompopicon"> Listing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body" id="escortPopupModalBody">
                <iframe src="" id="escortPopupModalBodyIframe" frameborder="0"
                    style="width:100%; height:80vh;" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</div>
@include('modal.pin-change', ['mode' => 'pinAuth'])
@endsection

@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    var table = $('#escort_listings').DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Member ID"
        },
        info: true,
        lengthChange: true,
        searching: true,
        order: [
            [5, 'asc']
        ],
        bStateSave: false,
        processing: true,
        serverSide: true,
        paging: true,
        ajax: {
            url: "{{ route('escort.current.list.escort-dataTableListing', 'current') }}",
            type: "GET",
            dataSrc: function(json) {
                $(".totalListing").text(json.membershipCounts.total);
                $(".platinumListing").text(json.membershipCounts.platinum);
                $(".goldListing").text(json.membershipCounts.gold);
                $(".silverListing").text(json.membershipCounts.silver);
                $(".freeListing").text(json.membershipCounts.free);
                $(".suspendListing").text(json.membershipCounts.current_suspend);
                $(".serverTime").text(json.server_time);
                $(".uptimeClass").html(json.server_up_time);
                return json.data;
            }
        },
        columns: [{
                data: 'member_id',
                name: 'member_id',
                searchable: true,
                orderable: true
            },
            {
                data: 'name',
                name: 'name',
                orderable: true
            },
            {
                data: 'location',
                name: 'location',
                searchable: false,
                orderable: false
            },
            {
                data: 'pro_name',
                name: 'pro_name',
                searchable: false,
                orderable: false
            },
            {
                data: 'membership',
                name: 'membership',
                searchable: false,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'start_date',
                name: 'start_date',
                searchable: false,
                orderable: true
            },
            {
                data: 'end_date',
                name: 'end_date',
                searchable: false,
                orderable: false
            },
            {
                data: 'days_number',
                name: 'days_number',
                searchable: false,
                orderable: true
            },
            {
                data: 'days_left',
                name: 'days_left',
                searchable: false,
                orderable: true
            },

            {
                data: 'statusBtn',
                name: 'statusBtn',
                searchable: false,
                orderable: false,
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                class: 'text-center',
                render: function(data, type, row) {
                    if (row.statusOriginal == 'listed') {
                        return `
                            <div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="` +
                            row.profileUrl + `" target="_blank"><i class="fa fa-eye "></i> View Listing
                                    </a>
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center border-top" href="#" data-toggle="modal" data-target="#SetPinModal" data-purchase-id=${row.id}><i class="fa fa-ban "></i> Suspend 
                                    </a>
                                </div>
                            </div>
                        `;

                    } else {
                        return `
                            <div class="dropdown no-arrow ml-3">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center view-listing" 
                                    data-toggle="modal" data-target="#view-listing" data-id="` + row.escort.id + `" href="#">
                                        <i class="fa fa-eye "></i> View Listing
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                }
            }
        ],
    });

    $("select[name='advertiser_type']").on("change", function() {
        var url = $(this).val();
        table.ajax.url(url).load();
    });

    let countdown = 15;
    setInterval(() => {
        countdown--;
        $(".refreshSeconds").text(' ' + countdown);

        if (countdown <= 0) {
            table.draw();
            countdown = 15;

        }

    }, 1000);
</script>
@endpush