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
                            <li>You can select a payment option from the drop down including your preferred amount you want
                                to pay.</li>
                            <li>SMS 2FA applies to this feature.</li>
                            {{-- <li>You can enable the Auto Recharge feature <a href="#"
                                class="custom_links_design">here</a> as well.</li> --}}
                            <li>You can view how much credit you have available in the summary below. When creating a
                                Listing or Tour, your available credit will be displayed on the checkout payment page.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <div class="common-card">
                    <div class="wallet-header">
                        <div class="card-top">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M3 6V17C3 18.6569 4.34315 20 6 20H20C20.5523 20 21 19.5523 21 19V16M19 8H5C3.89543 8 3 7.10457 3 6V6C3 4.89543 3.89543 4 5 4H18C18.5523 4 19 4.44772 19 5V8ZM19 8H20C20.5523 8 21 8.44772 21 9V12M21 12H18C16.8954 12 16 12.8954 16 14V14C16 15.1046 16.8954 16 18 16H21M21 12V16"
                                            stroke="#ff3c5f" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Add Money</h2>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-10 flex-wrap">
                        <div class="wallet-summary-card balance">

                            <div class="wallet-summary-icon">

                                <!-- Wallet SVG -->
                                <svg fill="#ff3c5f" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 511.999 511.999" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <g>
                                                <g>
                                                    <path d="M256.298,101.846c-92.85,0-206.983,143.686-206.983,260.579c0,44.352,15.783,79.881,46.928,105.612 c35.323,29.174,89.169,43.962,160.054,43.962c70.625,0,124.319-14.906,159.567-44.319c31.069-25.916,46.82-61.673,46.82-106.262 C462.685,244.98,348.887,101.846,256.298,101.846z M264.276,302.614c23.697,12.525,53.196,28.124,53.196,59.042 c0,27.843-18.793,51.339-44.341,58.603v7.908c0,9.18-7.448,16.628-16.628,16.628c-9.18,0-16.628-7.448-16.628-16.628v-7.908 c-25.548-7.264-44.341-30.76-44.341-58.603c0-9.18,7.448-16.628,16.628-16.628c9.18,0,16.628,7.448,16.628,16.628 c0,15.285,12.428,27.713,27.713,27.713s27.713-12.428,27.713-27.713c0-10.89-18.036-20.417-35.486-29.64 c-23.697-12.525-53.196-28.124-53.196-59.042c0-27.843,18.793-51.339,44.341-58.603v-7.908c0-9.18,7.448-16.628,16.628-16.628 c9.18,0,16.628,7.448,16.628,16.628v7.908c25.548,7.264,44.341,30.76,44.341,58.603c0,9.18-7.448,16.628-16.628,16.628 c-9.18,0-16.628-7.448-16.628-16.628c0-15.285-12.428-27.713-27.713-27.713s-27.713,12.428-27.713,27.713 C228.791,283.864,246.825,293.391,264.276,302.614z">
                                                    </path>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path d="M347.037,20.547c-7.686-3.941-17.126-1.354-21.705,5.976c-6.95,11.14-16.639,13.932-23.545,14.311 c-12.016,0.855-24.087-5.25-32.454-15.816C256.752,9.115,236.844,0,214.728,0c-22.116,0-42.024,9.115-54.604,25.017 c-3.746,4.72-4.634,11.085-2.338,16.66c1.859,4.508,10.991,25.543,26.151,46.511c23.911-12.465,48.487-19.6,72.36-19.6 c23.868,0,48.444,7.139,72.347,19.615c15.169-20.974,24.306-42.019,26.166-46.528C358.1,33.678,354.722,24.498,347.037,20.547z">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                            </div>

                            <div>
                                <span class="wallet-summary-label">
                                    Available Balance
                                </span>

                                <span class="wallet-summary-value">
                                    {{ formatCurrency($user->wallet->balance) }}
                                </span>
                            </div>

                        </div>
                        <div class="wallet-summary-card reward">
                            <div class="wallet-summary-icon">

                                <!-- Gift SVG -->
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">

                                <rect x="3" y="8" width="18" height="4" rx="1"></rect>
                                <path d="M5 12v8h14v-8"></path>
                                <path d="M12 8v12"></path>
                                <path d="M12 8H8.5a2.5 2.5 0 1 1 2.5-2.5V8Z"></path>
                                <path d="M12 8h3.5A2.5 2.5 0 1 0 13 5.5V8Z"></path>

                            </svg>

                            </div>

                            <div>
                                <span class="wallet-summary-label">
                                Loyalty Reward
                            </span>

                                <span class="wallet-summary-value">
                               {{ $user->wallet->earn_days . ' ' . ($user->wallet->earn_days > 1 ? 'Days' : 'Day') }}
                            </span>
                            </div>

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
                                        <option value="100">{{ formatCurrency(100, 'AU$') }}</option>
                                        <option value="200">{{ formatCurrency(200, 'AU$') }}</option>
                                        <option value="500">{{ formatCurrency(500, 'AU$') }}</option>
                                        <option value="750">{{ formatCurrency(750, 'AU$') }}</option>
                                        <option value="1000">{{ formatCurrency(1000, 'AU$') }}</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-3 my-1">
                                    <label>Enter Amount</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">AU$</span>
                                        </div>
                                        <input type="text" name="custom_amount" id="custom_amount" class="form-control"
                                            placeholder="Enter amount e.g. 1,000" disabled>
                                    </div>

                                </div>

                                <div class="col-md-2 my-1">
                                    <button type="button" class="btn-success-modal btn-block" data-toggle="modal"
                                        data-target="#confirmModal" data-backdrop="static" data-keyboard="false">
                                        Add Money
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @include('escort.dashboard.modal.payment_form')
                    @include('modal.two-step-verification', ['action' => true, 'inPaymentMode' => true])
                </div>
                <div class="col-lg-12 mt-3">
                    <!-- Transaction History -->
                    <div class="common-card">
                        <div class="card-top mb-4">
                            <div class="card-icon">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">

                                    <path d="M3 12a9 9 0 1 0 3-6.7"></path>
                                    <path d="M3 4v5h5"></path>
                                    <path d="M12 7v5l3 2"></path>
                                </svg>
                            </div>
                            <div class="card-heading">
                                <h2>Transaction History</h2>
                            </div>
                        </div>
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
    </div>

    <!-- Modal -->
    <div class="modal fade upload-modal" id="confirmModal" tabindex="-1" role="dialog"
        aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                    <p class="lead">You have opted to top up your Account in the amount of <strong
                            class="display_amount"></strong>.</p>
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
                    <button id="modalPaymentButton" class="btn-success-modal text-white" type="button"
                        data-toggle="modal" data-target="#process-payment-modal" data-backdrop="static"
                        data-keyboard="false" name="action" value="wallet">Proceed to Payment</button>
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
            pageLength: {{ $datatable_entries }},
            lengthMenu: [{{ config('app.paginate_range') }}],
        });
    </script>
@endprepend
