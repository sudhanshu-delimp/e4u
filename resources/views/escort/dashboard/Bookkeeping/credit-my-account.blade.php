@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">My Wallet</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
        </div>

        <div class="row collapse" id="notes">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>You can select a payment option by clicking the card, or simply insert the amount you want
                                to pay.</li>
                            <li>SMS 2FA applies to this feature.</li>
                            <li>You can enable the Auto Recharge feature <a href="#"
                                    class="custom_links_design">here</a> as well.</li>
                            <li>You can view how much credit you have available in the summary below. When creating a
                                Listing or Tour, your available credit will be displayed on the payment page.</li>
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
                        <div class="balance-box">
                            Available Balance: AU$250.00
                        </div>
                    </div>


                    <div class="add-money-box mb-4">
                        <form>
                            <div class="form-row align-items-end">


                                <div class="col-md-3">
                                    <label>Select Top Up Amount</label>
                                    <select class="form-control">
                                        <option value="100">AU$100</option>
                                        <option value="200">AU$200</option>
                                        <option value="500">AU$500</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Enter Amount</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">AU$</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Enter amount e.g. 100"
                                            disabled>
                                    </div>

                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn-success-modal btn-block">
                                        Add Money
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>


                    <!-- Transaction History -->

                    <h5 class="mb-3">Transaction History</h5>

                    <div class="table-responsive">

                        <table class="table w-100">
                            <thead class="table-bg">
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>04 Apr 2026</td>
                                    <td>Repayment</td>
                                    <td class="credit">Credit</td>
                                    <td class="amount-plus">+AU$200</td>
                                    <td>AU$250</td>
                                </tr>

                                <tr>
                                    <td>01 Apr 2026</td>
                                    <td>Service Fee</td>
                                    <td class="debit">Debit</td>
                                    <td class="amount-minus">-AU$50</td>
                                    <td>AU$50</td>
                                </tr>

                                <tr>
                                    <td>29 Mar 2026</td>
                                    <td>Wallet Top Up</td>
                                    <td class="credit">Credit</td>
                                    <td class="amount-plus">+AU$100</td>
                                    <td>AU$100</td>
                                </tr>

                            </tbody>

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
                    <div class="spinner-border text-primary my-3" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="lead">You have opted to top up your Account in the amount of <strong>AU$<span
                                id="selectedAmountDisplay"></span></strong>.</p>
                    <p>Are you sure that is the correct amount? If the amount is correct click <strong>Proceed</strong> to
                        complete your payment.</p>

                    <div class="mt-3 p-2 bg-light rounded">
                        <h5>Never Worry About Running Out of Credit</h5>
                        <p>Would you like to enable Auto-recharge?</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="autoRechargeCheck">
                            <label class="form-check-label" for="autoRechargeCheck">Yes</label>
                        </div>
                        <small class="d-block text-muted mt-2">If enabled, the recharge will occur automatically when
                            balance falls below AU$100.00.</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                    <button type="button" class="nex_sterp_btn btn-success-modal"
                        onclick="proceedPayment()">Proceed</button>
                </div>

            </div>
        </div>
    </div>

    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->



    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script>
        let selectedAmount = 0;

        function selectAmount(amount) {
            selectedAmount = amount;
            document.getElementById('selectedAmountDisplay').innerText = selectedAmount.toFixed(2);
            $('#confirmModal').modal('show');
        }

        function customAmountSelected() {
            const input = document.getElementById('customAmount').value;
            if (input && input > 0) {
                selectAmount(Number(input));
            } else {
                alert('Please enter a valid amount.');
            }
        }

        function proceedPayment() {
            const autoRecharge = document.getElementById('autoRechargeCheck').checked;
            alert('Payment of AU$' + selectedAmount.toFixed(2) + ' submitted.\nAuto Recharge: ' + (autoRecharge ?
                'Enabled' : 'Disabled'));
            $('#confirmModal').modal('hide');
            // Add further integration (2FA, API submission, etc.) here
        }
    </script>

    <script type="text/javascript">
        $('#userProfile').parsley({

        });



        $('#userProfile').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);

            if (form.parsley().isValid()) {

                var url = form.attr('action');
                var data = new FormData(form[0]);
                $.ajax({
                    method: form.attr('method'),
                    url: url,
                    data: data,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (!data.error) {
                            $.toast({
                                heading: 'Success',
                                text: 'Details successfully saved',
                                icon: 'success',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Records Not update',
                                icon: 'error',
                                loader: true,
                                position: 'top-right', // Change it to false to disable loader
                                loaderBg: '#9EC600' // To change the background
                            });

                        }
                    },

                });
            }
        });
        $('#city').select2({
            allowClear: true,
            placeholder: 'Select City',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('city.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        state_id: $('#state').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#state').select2({
            allowClear: true,
            placeholder: 'Select State',
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: false // add additional parameters
                }
            },
            tags: false,
            minimumInputLength: 2,
            tokenSeparators: [','],
            ajax: {
                url: "{{ route('state.list') }}",
                dataType: "json",
                type: "GET",
                data: function(params) {
                    console.log(params);
                    var queryParameters = {
                        query: params.term,
                        country_id: $('#country').val()
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {

                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });


        $('#country').on('change', function(e) {
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });
    </script>
@endpush
