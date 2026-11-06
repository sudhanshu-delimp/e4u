@extends('layouts.admin')
@section('style')
    <style>
        td,
        th {
            vertical-align: middle !important;
        }

        #transactionSummaryTable td {
            white-space: normal !important;
            word-break: break-word;
        }

        .avatar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Transaction Summary  </h1>
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
            <div class="col-md-12 ">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>All Advertiser transactions are recorded here.</li>
                            <li>You can view any historical transaction as well as print or email the transaction
                                summary.</li>
                            <li>To download the transaction summary, click Download located in the Action options.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive common-card">
                    <table class="table w-100" id="transactionSummaryTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Trans. Ref ID</th>
                                 <th style="width:150px;">Profile/Order ID</th>
                                <th>Member ID</th>
                                <th>Completed By</th>
                                <th>Service Type</th>
                                <th>Transaction Date</th>
                                <th>Transaction Value</th>
                                <th>Card</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                        <tr>
                            <th colspan="8" class="border-0"></th>
                        </tr>
                        <tfoot class="bg-first t-foot">
                            <tr>
                                <th colspan="3" class="text-left border-0">Server time: <span
                                        class="serverTime">{{ date('d-m-Y h:i a') }}</span></th>
                                <th colspan="2" class="text-center border-0">Refresh time:<span class="refreshSeconds">
                                        15</span></th>
                                <th colspan="4" class="text-right border-0" style="text-align: right!important;">Up time:
                                    <span class="uptimeClass">{{ getAppUptime() }}</span>
                                </th>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('escort.dashboard.Bookkeeping.modal.transaction-summary')
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' ' + countdown);

                if (countdown <= 0) {
                    // $('#transactionSummaryTable').DataTable().ajax.reload(null, false);
                    countdown = 15;

                }

            }, 1000);

            $('#customSearch').on('keyup', function() {
                // $('#transactionSummaryTable').DataTable().search(this.value).draw();
            });


        });
        
        var table = $('#advertiserSuspenstionTable').DataTable({
        language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Member ID"
        },
        info: true,
        lengthChange: true,
        searching: true,
        stateSave: true,
        processing: true,
        serverSide: true,
        paging: true,

        order: [[2, 'asc']], // Sort by start_date

        ajax: {
        url: $("select[name='advertiser_type']").val(),
        type: "GET",
        dataSrc: function(json) {
        var totalRows = json.recordsTotal || json.recordsFiltered;
        $(".totalListing").text(totalRows);
        $(".serverTime").text(json.server_time);
        $(".uptimeClass").html(json.server_up_time);

        return json.data;
        }
        },

        columns: [
        {
        data: 'profile_id',
        name: 'profile_id',
        orderable: false
        },
        {
        data: 'member_id',
        name: 'member_id'
        },
        {
        data: 'start_date',
        name: 'start_date'
        },
        {
        data: 'end_date',
        name: 'end_date'
        },
        {
        data: 'days',
        name: 'days'
        },
        {
        data: 'location',
        name: 'location'
        },
        {
        data: 'action',
        name: 'action',
        orderable: false,
        className: 'text-center'
        }
        ]
        });

        $('#view-listing').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let id = button.data('item');
            let modal = $(this);
            modal.find('#listingModalContent').html(`<div class="text-center p-3">Loading...</div>`);
            $.ajax({
                url: `{{ route('admin.payment.detail') }}`,
                type: 'POST',
                data: {
                    id: id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    modal.find('#listingModalContent').html(response.html);
                    modal.find('a.print_payment_summary').attr('href', response.print_url);
                },
                error: function() {
                    modal.find('#listingModalContent').html(
                        `<div class="text-danger p-3">Failed to load data</div>`);
                }
            });

        });
    </script>
@endpush
