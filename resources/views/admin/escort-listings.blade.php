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
            <div class="card collapse" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>All current (published) Listings are displayed in this table.</li>
                        <li>You have limited Action access according to your security level.</li>
                        <li>Prefixes:</li>
                        <p>1. ACT &nbsp;&nbsp;2. NSW &nbsp;&nbsp;3. Vic &nbsp;&nbsp;4. Qld &nbsp;&nbsp;5. SA &nbsp;&nbsp;6. W A &nbsp;&nbsp;7. Tas &nbsp;&nbsp;8. NT</p>
                    </ol>

                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 20px;">

            <div class="total_listing">
                <div><span>Platinum Listings : </span></div>
                <div><span class="platinumListing">4,456</span></div>
            </div>
            <div class="total_listing">
                <div><span>Gold Listings : </span></div>
                <div><span class="goldListing">4,456</span></div>
            </div>
            <div class="total_listing">
                <div><span>Silver Listings : </span></div>
                <div><span class="silverListing">4,456</span></div>
            </div>
            <div class="total_listing">
                <div><span>Total Listings : </span></div>
                <div><span class="totalListing">4,456</span></div>
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
                    <th colspan="3" class="text-left border-0">Server time: <span class="serverTime">{{date('d-m-Y h:i a')}}</span></th>
                    <th colspan="4" class="text-center border-0">Refresh time:<span class="refreshSeconds"> 15</span></th>
                    <th colspan="4" class="text-right border-0">Up time: <span class="uptimeClass">{{ getAppUptime() }}</span></th>
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


<div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="emailReport"><img src="{{ asset('assets/dashboard/img/view-listing.png')}}" class="custompopicon"> Listing</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body" id="escortPopupModalBody">
                <iframe src="" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</div>
@include('modal.pin-change',['mode'=>'pinAuth'])
@endsection

@push('script')
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        ajaxReload();
        let countdown = 15;
        setInterval(() => {
            countdown--;
            $(".refreshSeconds").text(' ' + countdown);

            if (countdown <= 0) {
                $('#escort_listings').DataTable().ajax.reload(null, false);
                countdown = 15;

            }

        }, 1000);

        $('#customSearch').on('keyup', function() {
            $('#escort_listings').DataTable().search(this.value).draw();
        });
    })

    let isInitialLoad = true;
    //SetPinModal
    function ajaxReload() {
        var table = $('#escort_listings').DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Member ID or Profile Name"
            },
            autoWidth: false,
            info: true,
            lengthChange: true,
            searching: true,
            order: [
                [5, 'desc']
            ],
            bStateSave: false,
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: "{{ route('escort.current.list.escort-dataTableListing', 'current') }}",
                type: "GET",
                dataSrc: function(json) {
                    // var totalRows = json.data.length; 
                    if (isInitialLoad) {
                        var totalRows = json.recordsTotal || json.recordsFiltered;

                        $(".totalListing").text(json.membershipCounts.total);
                        $(".platinumListing").text(json.membershipCounts.platinum);
                        $(".goldListing").text(json.membershipCounts.gold);
                        $(".silverListing").text(json.membershipCounts.silver);
                        $(".serverTime").text(json.server_time);
                        $(".uptimeClass").html(json.server_up_time);
                        isInitialLoad = false;
                    }

                    return json.data;
                }
            },
            columns: [
                /* { data: 'member_id', name: 'member_id' },
                { data: 'stage_name', name: 'stage_name' },
                { data: 'state_name', name: 'state_name' },
                { data: 'pro_name', name: 'pro_name' },
                { data: 'membership', name: 'membership', orderable: false  },
                { data: 'start_date_formatted', name: 'start_date'},
                { data: 'end_date_formatted', name: 'end_date', orderable: false  },
                { data: 'days_number', name: 'days_number' , orderable: false },
                { data: 'days_left', name: 'days_left',orderable: false  },
                {data: 'enabled',name: 'enabled',searchable: false,orderable: false,defaultContent: 'NA'},
                { data: 'action', name: 'action', orderable: false } */
                {
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
                    orderable: false
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
            ],
            order: [5, 'asc'],
            columnDefs: [{
                    targets: 0
                }, // First column
                {
                    targets: 1
                }, // Third column
                {
                    targets: 2
                }, // Third column 
                {
                    targets: 4
                },
                {
                    targets: 5
                },
                {
                    targets: 6
                },
                {
                    targets: 8
                },
                {
                    targets: 9
                },
                {
                    targets: 10,
                    orderable: false,
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
                                    <a class="dropdown-item d-flex justify-content-start gap-10 align-items-center" href="` + row.profileUrl + `" target="_blank"><i class="fa fa-eye "></i> View Listing
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
            ]
        });

    }

    $(document).on('click', '.view-listing', function(e) {
        e.preventDefault(); // prevent default link behavior

        const escortId = $(this).data('id');

        $.ajax({
            url: '{{route("escort.current.single-list.escort-dataTableListing")}}/' + escortId, // replace with your actual route
            method: 'GET',
            success: function(response) {
                console.log(response.profileurl);

                $("#escortPopupModalBodyIframe").attr('src', response.profileurl)
            },
            error: function(xhr) {
                console.error('Failed to fetch data');
                $('#view-listing .modal-body').html('<p class="text-danger">Error loading data...</p>');
            }
        });
    });

    $(document).ready(function() {
        function checkAndApplyResponsive() {
            if ($(window).width() < 1500) {
                if (!$('.massage_table_class').hasClass('table-responsive')) {
                    $('.massage_table_class').addClass('table-responsive');
                }
            } else {
                $('.massage_table_class').removeClass('table-responsive');
            }
        }

        // Initial check
        checkAndApplyResponsive();

        // Recheck on window resize
        $(window).resize(function() {
            checkAndApplyResponsive();
        });
    });

    var purchaseId = 0;
    $("#SetPinModal").on('show.bs.modal', function(event) {
        let button = $(event.relatedTarget);
        let modalObject = $(this);
        purchaseId = button.data('purchase-id');

        modalObject.find('input[name="action"]').val('suspendListedProfile');
    });

    var suspendListedProfile = function() {
        $.ajax({
            url: `{{route('admin.suspend_listed_profile', '_PURCHASE_')}}`.replace('_PURCHASE_', purchaseId),
            method: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                showLoadingPopup('Processing Payment', 'Do not refresh or close this page.');
            },
            success: function(response, textStatus, xhr) {
                Swal.close();
                displaySwal(xhr);

            },
            error: function(xhr) {
                Swal.close();
                displaySwal(xhr);
            }
        });
    }
</script>

@endpush