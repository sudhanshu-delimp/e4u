@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
    }
        .modal-lg {
        max-width: 600px !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <div class="row">        
    <div class="d-sm-flex align-items-center justify-content-between col-md-12">
        <div class="custom-heading-wrapper">
            <h1 class="h1">My Wallet</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
         @if (request('from') == 'dashboard')
        <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
        </div>
        @endif
    </div>

    </div>

    <div class="row collapse" id="notes">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                    <ol>
                        <li>You can select a payment option from the drop down including your preferred amount you want to pay.</li>
                        <li>SMS 2FA applies to this feature.</li>
                        {{-- <li>You can enable the Auto Recharge feature <a href="#"
                                class="custom_links_design">here</a> as well.</li> --}}
                        <li>You can view how much credit you have available in the summary below. When creating a Listing or Tour, your available credit will be displayed on the checkout payment page.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="wallet-card">
                <div class="wallet-header">
                    <h5>Add Money</h5>
                    <div class="d-flex gap-10 flex-wrap">
                        <div class="balance-box">
                            Available Balance: {{formatCurrency($user->wallet->balance)}}
                        </div>
                        <div class="balance-box">
                            Loyalty Reward: {{$user->wallet->earn_days .' '. ($user->wallet->earn_days > 1 ? 'Days':'Day')}}
                        </div>
                    </div>
                </div>


                <div class="add-money-box mb-4">
                    <form id="walletForm" action="#" method=" POST">
                        <div class="form-row align-items-end">
                            <div class="col-md-3 my-1">
                                <label>Select Top Up Amount</label>
                                <select class="form-control" name="amount" id="amount">
                                    <option value="">Select Amount</option>
                                    <option value="100">{{formatCurrency(100,'AU$')}}</option>
                                    <option value="200">{{formatCurrency(200,'AU$')}}</option>
                                    <option value="500">{{formatCurrency(500,'AU$')}}</option>
                                    <option value="750">{{formatCurrency(750,'AU$')}}</option>
                                    <option value="1000">{{formatCurrency(1000,'AU$')}}</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-3 my-1">
                                <label>Enter Amount</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">AU$</span>
                                    </div>
                                    <input type="text" name="custom_amount" id="custom_amount" class="form-control" placeholder="Enter amount e.g. 1,000"
                                        disabled>
                                </div>

                            </div>

                            <div class="col-md-2 my-1">
                                <button type="button" class="btn-success-modal btn-block" data-toggle="modal" data-target="#confirmModal" data-backdrop="static" data-keyboard="false">
                                    Add Money
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @include('escort.dashboard.modal.payment_form')
                @include('modal.two-step-verification',['action'=>true,'inPaymentMode'=>true])

                <!-- Transaction History -->

                <h5 class="my-4">Transaction History</h5>

                <div class="table-responsive">

                    <table class="table w-100" id="TransactionTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Balance</th>
                            </tr>
                        </thead>

                        <tbody> </tbody>

                    </table>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade upload-modal" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">

            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel"><img src="/assets/dashboard/img/add-credit.png"
                        class="custompopicon" alt="cross"> Add Credit to My Account</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>

            <div class="modal-body text-center">
                <!-- <div class="spinner-border text-primary my-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div> -->
                <p class="lead">You have opted to top up your Account in the amount of <strong class="display_amount"></strong>.</p>
                <p>Are you sure that is the correct amount? If the amount is correct click <strong>Proceed</strong> to
                    complete your payment.</p>

                <!-- <div class="mt-3 p-2 bg-light rounded">
                    <h5>Never Worry About Running Out of Credit</h5>
                    <p>Would you like to enable Auto-recharge?</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="autoRechargeCheck">
                        <label class="form-check-label" for="autoRechargeCheck">Yes</label>
                    </div>
                    <small class="d-block text-muted mt-2">If enabled, the recharge will occur automatically when
                        balance falls below AU$100.00.</small>
                </div> -->

            </div>

            <div class="modal-footer">
                <button id="modalPaymentButton" class="btn-success-modal text-white" type="button" data-toggle="modal" data-target="#process-payment-modal" data-backdrop="static" data-keyboard="false" name="action" value="wallet">Proceed to Payment</button>
            </div>

        </div>
    </div>
</div>

</div>
@endsection
@prepend('script')
<script>
    var walletAmount = 0;
    var table;
    var walletForm = $("#walletForm");
    var walletFormButton = walletForm.find(':button');

    walletFormButton.prop('disabled', true);
    $(document).ready(function() {
        $('#amount').on('change', function() {
            if ($(this).val() === 'other') {
                $('#custom_amount').prop('disabled', false);
            } else {
                $('#custom_amount').prop('disabled', true).val('');
            }
        })
    });

    var checkAmount = function() {
        let selectAmount = walletForm.find('select[name="amount"]').val();
        let customAmount = walletForm.find('input[name="custom_amount"]').val();

        if ((selectAmount && selectAmount !== 'other') || (customAmount.trim() !== '' && customAmount.trim() > 0)) {
            walletFormButton.prop('disabled', false);
        } else {
            walletFormButton.prop('disabled', true);
        }
    }

    walletForm.find('select[name="amount"], input[name="custom_amount"]').on('change keyup', function() {
        checkAmount();
    });

    $("#confirmModal").on('show.bs.modal', async function(event) {
        let modal = $(this);
        let buttonElement = $(event.relatedTarget);
        let form = buttonElement.parents('form');

        walletAmount = form.find('select[name="amount"]').val();

        if (walletAmount === 'other') {
            walletAmount = form.find('input[name="custom_amount"]').val();
        }

        if (walletAmount && walletAmount > 0) {
            modal.find('.display_amount').text(formatCurrency(walletAmount, 'AU$'))

            await encryptValue(walletAmount).then(function(res) {
                modal.find('#modalPaymentButton').attr('fee_token', res.encrypted);
            });
        }
    });

    table = $('#TransactionTable').DataTable({
        serverSide: true,
        processing: true,
        "language": {
            "zeroRecords": "There is no record of the search criteria you entered.",
            searchPlaceholder: "Search..."
        },
        initComplete: function() {
            // if ($('#returnToReportBtn').length === 0) {
            //     $('.dataTables_filter').append(
            //         '<button id="returnToReportBtn" class="create-tour-sec my-3">Return to Report</button>'
            //     );
            // }
            $('#returnToReportBtn').on('click', function() {
                table.search('').draw();
            });
        },

        ajax: {
            url: "{{ route('escort.wallet_transaction') }}",
            data: function(d) {

            }
        },
        columns: [{
                data: 'created_date',
                name: 'created_at',
                searchable: false,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'description',
                name: 'id',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'transaction_type',
                name: 'type',
                searchable: true,
                orderable: false,
                defaultContent: 'NA'
            },
            {
                data: 'transaction_amount',
                name: 'amount',
                searchable: true,
                orderable: true,
                defaultContent: 'NA'
            },
            {
                data: 'transaction_balance_after',
                name: 'balance_after',
                searchable: false,
                orderable: false,
                defaultContent: 'NA'
            },
        ],
        order: [1, 'desc'],
        pageLength: {{$datatable_entries }},
        lengthMenu: [{{ config('app.paginate_range') }}], 
    });
</script>
@endprepend