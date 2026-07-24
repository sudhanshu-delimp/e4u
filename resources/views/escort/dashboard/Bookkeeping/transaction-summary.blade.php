@extends('layouts.escort')
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
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Transaction Summary</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
        </div>
        <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="mb-0">
                            <li>All Advertiser transactions are recorded here.</li>
                            <li>You can view any historical transaction as well as print or email the transaction
                                summary.</li>
                            <li class="mb-0">To download the transaction summary, click Download located in the Action
                                options.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!--middle content-->
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table w-100" id="transactionSummaryTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Ref</th>
                                <th>Service Type</th>
                                <th>Transaction Date</th>
                                <th>Transaction Value</th>
                                <th>Card</th>
                                <th>Completed By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('escort.dashboard.Bookkeeping.modal.transaction-summary')
@endsection
@push('script')
    <script>
        var table;
        $(document).ready(function() {
            $('#amount').on('change', function() {
                if ($(this).val() === 'other') {
                    $('#custom_amount').prop('disabled', false);
                } else {
                    $('#custom_amount').prop('disabled', true).val('');
                }
            })
        })

        table = $('#transactionSummaryTable').DataTable({
            serverSide: true,
            processing: true,
            pageLength: 25,
            "language": {
                "zeroRecords": "There is no record of the search criteria you entered.",
                searchPlaceholder: "Search by Ref, Service Type, Card"
            },
            initComplete: function() {
                //  if ($('#returnToReportBtn').length === 0) {
                //      $('.dataTables_filter').append(
                //          '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
                //      );
                //  }
                $('#returnToReportBtn').on('click', function() {
                    table.search('').draw();
                });
            },

            ajax: {
                url: "{{ route('escort.payment.transaction_summary.datatable') }}",
                data: function(d) {

                }
            },
            columns: [{
                    data: 'ref_no',
                    name: 'ref_no',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'service',
                    name: 'service',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'transaction_at',
                    name: 'created_at',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'amount',
                    name: 'amount',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'card',
                    name: 'card',
                    searchable: true,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'completed_by_member_id',
                    name: 'completed_by',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ],
            order: [2, 'desc'],
        });

        $('#view-listing').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            let id = button.data('item');
            let modal = $(this);
            modal.find('#listingModalContent').html(`<div class="text-center p-3">Loading...</div>`);
            $.ajax({
                url: `{{ route('escort.payment.detail') }}`,
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

        $(document).on('click', '.print_payment_summary', function(e) {
            e.preventDefault();
            window.open($(this).attr('href'), '_blank');
        })
    </script>
@endpush
