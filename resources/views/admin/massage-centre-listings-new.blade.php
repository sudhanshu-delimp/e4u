@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }


    #cke_1_contents {
        height: 150px !important;
    }

    #listings_paginate span {
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
                <h1 class="h1">Massage Centre Listings</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>                     </span>
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
                            &nbsp;&nbsp;6. WA &nbsp;&nbsp;7. Tas &nbsp;&nbsp;8. NT.</p>

                    </ol>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 ">
            <div class="row my-3">
                 <div class="col-lg-12 d-flex justify-content-between" style="gap: 20px;">
                <a class="nav-link collapse-item btn-switch" href="{{ route('admin.escort-listings') }}">
                    Switch to Escort Listings
                </a>
                <div class="d-flex justify-content-end" style="gap: 50px;">

                    <div class="total_listing">
                        <div><span>Total Listings : </span></div>
                        <div><span class="totalListing">4,456</span></div>
                    </div>
                </div>
            </div>
        </div>
            <div class="massage_table_class">
                <table class="table" id="listings" style="width:100%;">
                    <thead class="table-bg">
                        <tr>
                            <th>Member ID </th>
                            <th>Member</th>
                            <th>Listing</th>
                            <th>Profile Name</th>
                            <th>Masseurs</th>
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
                            <th colspan="3" class="text-left border-0">Server time: <span class="serverTime">
                                    {{date('d-m-Y h:i a')}}</span></th>
                            <th colspan="4" class="text-center border-0">Refresh time:<span class="refreshSeconds">
                                    15</span></th>
                            <th colspan="4" class="text-right border-0">Up time: <span
                                    class="uptimeClass">{{ getAppUptime() }}</span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    <div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog"
        aria-labelledby="emailReportLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailReport"> <img
                            src="{{ asset('assets/dashboard/img/view-listing.png') }}" class="custompopicon"> Listing
                    </h5>
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

    <div class="modal fade upload-modal programmatic show" id="iframeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img
                            src="{{ asset('../assets/dashboard/img/info.png') }}" class="custompopicon">
                        {{ auth()->user()->member_id }} : Profile
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('../assets/app/img/newcross.png') }} "
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">

                    <iframe id="modalFrame" width="100%" height="600px" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    @include('modal.pin-change',['mode'=>'pinAuth'])
    <!-- end -->
    @endsection
    @push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script type="text/javascript">
        $(document).ready(function(e) {
            ajaxReload();
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {

                    $('#listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                $('#listings').DataTable().search(this.value).draw();
            });
        });

        let isInitialLoad = true;

        function ajaxReload() {

            var table = $("#listings").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Member ID or Profile Name"
                },
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: true,
                info: true,
                searching: true,
                bStateSave: false,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
                order: [8, 'DESC'],
                stateSave: false,

                ajax: {
                    url: "{{ route('admin.massage.center.dataTableListing') }}",
                    type: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: function(d) {
                        d.type = 'player';
                        return JSON.stringify(d);
                    },
                    dataSrc: function(json) {
                        if (isInitialLoad) {
                            $(".totalListing").text(json.current_listing_count || 0);
                            $(".serverTime").text(json.server_time);
                            $(".uptimeClass").html(json.server_up_time);
                            isInitialLoad = false;
                        }

                        return json.data;
                    }
                },

                columns: [{
                        data: 'member_id',
                        name: 'member_id',
                    },
                    {
                        data: 'member',
                        name: 'member'
                    },
                    {
                        data: 'listing',
                        name: 'listing',
                        orderable: false,
                        sortable: false
                    },
                    {
                        data: 'profile_name',
                        name: 'profile_name',
                        orderable: false
                    },
                    {
                        data: 'masseurs',
                        name: 'masseurs',
                        orderable: false
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        orderable: false
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                        orderable: false
                    },
                    {
                        data: 'days',
                        name: 'days',
                        orderable: true
                    },
                    {
                        data: 'left_days',
                        name: 'left_days',
                        orderable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                    }
                ],

            });
            table.state.clear();

        }

        $(document).on('click', '.view-listing', function(e) {
            e.preventDefault(); // prevent default link behavior

            const escortId = $(this).data('id');

            $.ajax({
                url: '{{ route("escort.current.single-list.dataTableListing") }}/' +
                    escortId, // replace with your actual route
                method: 'GET',
                success: function(response) {


                    $("#escortPopupModalBodyIframe").attr('src', response.profileurl)
                },
                error: function(xhr) {
                    console.error('Failed to fetch data');
                    $('#view-listing .modal-body').html(
                        '<p class="text-danger">Error loading data...</p>');
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

        function openModal(url) {
            document.getElementById('modalFrame').src = url;
            var modal = new bootstrap.Modal(document.getElementById('iframeModal'));
            modal.show();
        }
        document.getElementById('iframeModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('modalFrame').src = '';
        });

        var purchaseId = 0;
        $("#SetPinModal").on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let modalObject = $(this);
            purchaseId = button.data('purchase-id');

            modalObject.find('input[name="action"]').val('suspendListedProfile');
        });
        var suspendListedProfile = function() {
            let pinModalElement = $('#SetPinModal');
            $.ajax({
                url: `{{route('admin.center.suspend_listed_profile', '_PURCHASE_')}}`.replace('_PURCHASE_', purchaseId),
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    showLoadingPopup('Processing Payment', 'Do not refresh or close this page.');
                },
                success: function(response, textStatus, xhr) {
                    pinModalElement.find('#pinDisplaySet').text('');
                    pinModalElement.modal('hide');
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