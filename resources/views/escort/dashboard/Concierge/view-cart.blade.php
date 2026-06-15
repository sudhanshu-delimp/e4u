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

        input[type="radio"].is-invalid+label {
            color: red !important;
        }

        #swal2-title {
            font-size: x-large;
        }

        .parsley-errors-list {
            text-align: left !important;
            margin-left: 0 !important;
            padding-left: 0 !important;
        }

        .parsley-errors-list li {
            text-align: left !important;
        }

        #deliveryAddressForm input,
        #deliveryAddressForm select,
        #deliveryAddressForm textarea {
            color: #000 !important;
        }

        legend {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .cardImage img {
            height: 40px !important;
        }

        .modal-lg {

            max-width: 600px;
        }



        /* Card */

        .thank-you-card {
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
        }

        /* Image */

        .thank-you-card img {
            width: 120px;
            margin-bottom: 20px;
        }

        /* Title */

        .thank-you-card h2 {
            margin: 10px 0;
            font-size: 24px;
        }

        /* Text */

        .thank-you-card p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* Buttons */
    </style>
    <script src="https://cdn.pinpayments.com/pin.v2.js"></script>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 add-punterbox-report">
        <!--middle content start here-->

        {{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex justify-content-between align-items-center col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Cart</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
                <div class="product_view">
                    <span class="back-to-product" id="viewCart">
                        <a href="{{ route('escort.products') }}"> <i class="fa fa-arrow-left"></i> Back</a>
                    </span>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-1" style="font-size: 20px;"><b>Notes:</b> </p>
                        <ol>
                            <li>Order your products here for delivery to your door or by post.</li>
                            <li>Please ensure:
                                <ol class="level-2">
                                    <li>your order is complete and the details are correct</li>
                                    <li>there is access to your stay if we are delivering</li>
                                    <li>you have you mobile nearby. We will call you 15 minutes out</li>
                                    <li>Escorts4U has partnered with the Condom Man to offer a convenient delivery service
                                        to the
                                        door, within the Perth CBD, and Express Post to other capital cities.</li>
                                </ol>
                            </li>
                            <li>SMS 2FA applies to payment.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}


        <!-- Progress Bar -->
        <div class="row mx-1">
            <ul class="list-unstyled multi-steps">
                <li id="pro-step-1" class="is-active">Order
                    <div class="pro-status-bar pro-status-bar--success">
                        <div class="pro-status-bar__bar" id="bar1"></div>
                    </div>
                </li>
                <li id="pro-step-2">Shipping
                    <div class="pro-status-bar pro-status-bar--success">
                        <div class="pro-status-bar__bar" id="bar2"></div>
                    </div>
                </li>

                <li id="pro-step-3">Transaction Summary
                    <div class="pro-status-bar pro-status-bar--success">
                        <div class="pro-status-bar__bar" id="bar3"></div>
                    </div>
                </li>

                <li id="pro-step-4">Payment Status
                </li>
            </ul>
        </div>

        <!-- Step 1 -->
        <div id="step1" class="step-content active">
            {{-- step 1 --}}
            <div class="row mt-4">

                <div class="col-md-12">


                    <div class="d-sm-flex align-items-center justify-content-between mb-3 mt-4">
                        <h2><b>Order Products</b></h2>
                    </div>
                    <div class="table-responsive-xl">
                        <div id="loader"
                            style="display:none; text-align:center; padding:20px; font-weight: 300; position: absolute;  left: 42% !important;top: 45% !important">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        </div>
                        <table class="table table-bordered display" width="100%">
                            <thead class="bg-first">
                                <tr>
                                    <th scope="col" class="text-c enter font-weight-bold"><input type="checkbox"
                                            id="select-all" style="width:17px; height:17px"> Product
                                    </th>
                                    <th scope="col" class="text-ce nter font-weight-bold">Code</th>
                                    <th scope="col" class="text-c enter font-weight-bold">Description </th>
                                    <th scope="col" class="text-c enter font-weight-bold">Unit Price<sup>(1)</sup></th>
                                    <th scope="col" class="text-c enter font-weight-bold">Qty</th>
                                    <th scope="col" class="text-c enter font-weight-bold">Total
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="table-content"> </tbody>

                            <tfoot class="bg-first">
                                <tr>
                                    <th colspan="5" class="text-right font-weight-bold">
                                        Total:
                                    </th>
                                    <th>
                                        <span id="grand-total">$0.00</span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn-common" onclick="next()">Next <i class="fas fa-arrow-right text-white pl-2"></i></button>
            </div>
        </div>

        <!-- Step 2 -->
        <div id="step2" class="step-content">
            {{-- step 2 --}}
            <div class="row mt-5">

                <div class="col-lg-12 col-sm-12 col-md-12 right-sidebar-bg" style="background: none">
                    <div class="card p-4">
                        <div class="d-sm-flex align-items-center justify-content-between mb-3">
                            <h2><b>Delivery Address</b></h2>
                        </div>
                        <div class="form-row">


                            <form action="/" id="deliveryAddressForm" data-parsley-validate>

                                <div class="row">

                                    <!-- Mobile -->
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <label><b>Mobile Number</b></label>
                                        <input type="text" class="form-control" name="phone" placeholder="0145 028 758"
                                            required data-parsley-type="digits" data-parsley-minlength="10"
                                            data-parsley-required-message="Mobile number is required"
                                            data-parsley-type-message="Only digits allowed"
                                            data-parsley-minlength-message="Mobile must be at least 10 digits">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <label><b>Email</b></label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="you@domain.com.au" required
                                            data-parsley-required-message="Email is required"
                                            data-parsley-type-message="Enter a valid email address">
                                    </div>

                                    <!-- Address -->
                                    <!-- Address -->
                                    <div class="col-md-12 my-2">
                                        <label><b>Address</b></label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Unit 1, 1 The Street" required
                                            data-parsley-required-message="Address is required">
                                    </div>

                                    <!-- Address 2 (Optional) -->
                                    <div class="col-md-12 my-2">
                                        <label><b>Address 2 (Optional)</b></label>
                                        <input type="text" class="form-control" name="address_2"
                                            placeholder="Suburb WA 6000"
                                            data-parsley-required-message="Address 2 is required">
                                    </div>
                                    <!-- City -->
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                        <label><b>City</b></label>
                                        <input type="text" class="form-control" name="city" placeholder="City"
                                            required data-parsley-required-message="City is required">
                                    </div>

                                    <!-- Pincode -->
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                        <label><b>Postcode</b></label>
                                        <input type="text" class="form-control" name="pincode" placeholder="6001"
                                            required data-parsley-type="digits" maxlength="4"
                                            data-parsley-required-message="Postcode is required"
                                            data-parsley-type-message="Only digits allowed">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-2">
                                        <label><b>Landmark</b></label>
                                        <input type="text" class="form-control" name="landmark"
                                            placeholder="Near ABC Mall">
                                    </div>
                                    <!-- Special Instructions -->

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-5">
                                        <input type="radio" name="delivery_type" id="door" value="door"
                                            required checked data-parsley-required-message="Choose a delivery type">
                                        <label for="door"><b>Delivery to the door</b></label>
                                        <input type="radio" name="delivery_type" id="post" value="post">
                                        <label for="post"><b>Post</b></label>
                                    </div>
                                    <div class="col-md-12 my-2">
                                        <label><b>Any Special Instructions?</b></label>
                                        <textarea class="form-control common_textarea" name="special_instructions" rows="5"
                                            placeholder="Like building access if we are delivering to your door."required
                                            data-parsley-required-message="Special instructions are required"></textarea>
                                    </div>
                                    <!-- Billing Address Toggle -->
                                    <div class="col-12 mt-3">
                                        <input type="checkbox" id="sameAddress" name="sameAddress"
                                            onclick="toggleBilling()">
                                        <label for="sameAddress"><b>Billing address same as delivery</b></label>
                                    </div>

                                </div>

                                <!-- Billing Section -->
                                <div id="billingSection" class="mt-4">

                                    <div class="d-sm-flex align-items-center justify-content-between my-3">
                                        <h2><b>Billing Address</b></h2>
                                    </div>

                                    <div class="row">

                                        <!-- Phone -->
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label><b>Mobile Number</b></label>
                                            <input type="text" name="billing_phone" class="form-control"
                                                placeholder="0145 028 758" required data-parsley-type="digits"
                                                data-parsley-minlength="10"
                                                data-parsley-required-message="Billing phone is required">
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label><b>Email</b></label>
                                            <input type="email" name="billing_email" class="form-control"
                                                placeholder="you@domain.com.au" required
                                                data-parsley-required-message="Billing email is required">
                                        </div>

                                        <!-- Address Line 1 -->
                                        <div class="col-md-12 my-2">
                                            <label><b>Address Line 1</b></label>
                                            <input type="text" name="billing_address_line1" class="form-control"
                                                placeholder="Unit 1, 1 The Street" required
                                                data-parsley-required-message="Billing address line 1 is required">
                                        </div>

                                        <!-- Address Line 2 (optional) -->
                                        <div class="col-md-12 my-2">
                                            <label><b>Address Line 2</b></label>
                                            <input type="text" name="billing_address_line2" class="form-control"
                                                placeholder="Apartment, suite, etc (optional)">
                                        </div>

                                        <!-- City -->
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label><b>City</b></label>
                                            <input type="text" name="billing_city" class="form-control"
                                                placeholder="City" required
                                                data-parsley-required-message="Billing city is required">
                                        </div>

                                        <!-- Pincode -->
                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                            <label><b>Postcode</b></label>
                                            <input type="text" name="billing_pincode" class="form-control"
                                                maxlength="4" placeholder="6001" required data-parsley-type="digits"
                                                data-parsley-required-message="Billing Postcode is required">
                                        </div>

                                        <!-- Landmark (optional) -->
                                        <div class="col-md-12">
                                            <label><b>Landmark</b></label>
                                            <input type="text" name="billing_landmark" class="form-control"
                                                placeholder="Near school, mall, etc">
                                        </div>



                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="my-3 text-right d-flex justify-content-between flex-wrap gap-20">

                        <button onclick="prev()" class="btn-common" id="btnBack"> <i
                                class="fas fa-arrow-left text-white pr-2"></i> Back</button>
                        <button onclick="next()" class="btn-common">Next</button>

                    </div>
                </div>

            </div>


        </div>

        <!-- Step 4 -->
        <div id="step3" class="step-content text-center py -5  border-0" style="background-color: #f3f3f3">
            <div class="row">

                <div class="col-lg-12 col-sm-12 col-md-12 right-sidebar-bg" style="background: none">
                    <div class="card p-4">
                        <div class="paymnt_summery mb-3 summary-bg d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Transaction Summary</h4>
                            <div class="member-id">
                                <span class="pr-2 "><i class="fa fa-user"></i></span>
                                <span>Member ID: {{ auth()->user()->member_id }}</span>
                            </div>
                        </div>
                        <div id="transactionLoader"
                            style="display:none; text-align:center; padding:20px; font-weight: 300; position: absolute;  left: 42% !important;top: 80% !important">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle ">
                                <thead class="summary-bg text-white text-left">
                                    <tr>
                                        <th>Code</th>
                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="transaction_summary">




                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Replace with your image -->
            <div class="my-3 text-right d-flex justify-content-between flex-wrap gap-20">
                <button onclick="prev()" class="btn-common" id="btnBack"> <i
                        class="fas fa-arrow-left text-white pr-2"></i>Back</button>
                <button onclick="next()" class="btn-common" id="processOrder">Proceed to Checkout</button>

            </div>
        </div>
        <div id="step4" class="step-content text-center py-5">
            <div class="thank-you-card">
                <!-- Replace with your image -->
                <img src="{{ asset('assets/dashboard/img/success.png') }}" alt="order">

                <h2>Order Completed</h2>
                <p>Thank you for your purchase!</p>
                <button type="button" class="btn-common"> <a href="{{ route('escort.orders') }}" class="text-white">
                        View
                        Orders</a></button>
                <button onclick="finish()" class="btn-common">Finish</button>
            </div>
        </div>



        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span> </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

        <!--middle content end here-->
    </div>
    <!-- Modal -->
    <div class="modal fade upload-modal " id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src=" {{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body text-center position-relative">

                    <!-- Loader -->
                    <div id="imageLoader" class="position-absolute top-50 start-50 translate-middle">
                        <div class="spinner-border" role="status"></div>
                    </div>

                    <!-- Image -->
                    <img id="modalImage" src="" class="img-fluid d-none">

                </div>

            </div>
        </div>

    </div>


    <div class="modal fade upload-modal" id="process-payment-modal" tabindex="-1" aria-labelledby="renew_discountLabel"
        data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/secure-payment.png') }}" class="custompopicon"
                            alt="View Centre">
                        Secure Payment
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-5">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <div class="card p-3">
                                <!-- Order Summary -->
                                <div class="order_summary_adjustment">
                                    <p><strong>Order Summary</strong></p>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span class="paymentSubtotal">{{ formatCurrency(0) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>Wallet Used:</span>
                                        <span id="walletUsed"> {{ formatCurrency(0) }}</span>
                                    </div>

                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Total Fee:</span>
                                        <span id="total_fee"> {{ formatCurrency(0) }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>GST (Inclusive):</strong>
                                        <strong class="taxAmount" style="border: none">$1.20</strong>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center  mb-2">
                                        <strong>Delivery Charge:</strong>
                                        <strong class="deliveryCharge"
                                            style="border-bottom:1px solid">{{ formatCurrency(0) }}</strong>

                                    </div>


                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>Total Due:</strong>
                                        <strong class="paymentTotal totalDue">{{ formatCurrency(0) }}</strong>
                                    </div>
                                </div>

                                <hr>

                                {{-- <a style="color: #000;" data-toggle="collapse" href="#collapseExample" role="button"
                            aria-expanded="false" aria-controls="collapseExample">
                            <p class="apply_benefits"><strong>Apply Benefits</strong> <i class="fa fa-chevron-down"></i>
                            </p>
                        </a> --}}


                                <div class="col lapse p-0" id="collapse Example">
                                    <div class="wallet_details">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5><img src="{{ asset('assets/dashboard/img/wallet.png') }}"> Wallet
                                                    Money :
                                                    <span
                                                        id="walletAmount">{{ formatCurrency(Auth::user()->wallet->balance) }}</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card p-3 " style="border-radius:0px;">
                                        <form id="adjustment-form">
                                            <div class="form-row benefit_section">
                                                <div class="form-group col-12">
                                                    <label class="mb-0" for="Wallet">Wallet Money</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">AU$</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="wallet_amount"
                                                            placeholder="Enter amount.">
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end w-100 gap-10">
                                                    <button type="button" class="reset-btn btn-cancel-modal"
                                                        name="action" value="reset" id="resetWallet">Reset</button>
                                                    <button type="button" class="apply-btn" id="applyWallet"
                                                        name="action" value="apply">Apply</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="finish-payment-form d-none mt-2">

                                    <button type="button" data-action="wallet" id="finish_payment"
                                        class="btn-success-modal btn-block">
                                        Finish Payment
                                    </button>
                                </div>
                                <div class="support mt-3 payment_note">
                                    <p class="mb-0"><strong>Notes:</strong></p>
                                    <ol>
                                        <li>You can apply any portion of your Wallet towards the Fee.</li>
                                        <li>By selecting 'Pay Now', 2FA will be activated to verify it is you.</li>
                                        <li>For a detailed summary of this transaction, go to <a
                                                href="{{ route('escort.payment.transaction_summary') }}"
                                                class="custom_links_design" target="_blank"> Transaction Summary</a>.</li>
                                    </ol>
                                </div>

                            </div>



                        </div>

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                            <form action="{{ route('escort.payment.process') }}" class="pin" method="post"
                                id="payment-form">

                                <div class="card p-3">

                                    @csrf
                                    <div class="errors alert alert-danger" id="errorList" style="display:none">
                                    </div>
                                    <!-- Billing -->
                                    <h6 class="font-weight-bold mb-0">Billing Details</h6>
                                    <hr class="mt-0">
                                    <div class="form-row">
                                        <div class="form-group col-12">
                                            {{-- <label class="mb-0" for="add1">Address 1</label> --}}
                                            <input id="address-line1" class="form-control address_line1" disabled
                                                placeholder="Address 1">
                                        </div>
                                        <div class="form-group col-12">
                                            {{-- <label class="mb-0" for="add2">Address 2</label> --}}
                                            <input id="address-line2" class="form-control" placeholder="Address 2"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="City">City</label> --}}
                                            <input id="address-city" class="form-control address_city" placeholder="City"
                                                disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="State">State</label> --}}
                                            <input id="address-state" class="form-control" placeholder="State" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="Postcode">Postcode</label> --}}
                                            <input id="address-postcode" class="form-control" placeholder="Postcode"
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <label class="mb-0" for="Country">Country</label> --}}
                                        <input id="address-country" class="form-control address_country"
                                            placeholder="Country" disabled>
                                    </div>

                                    <!-- Card -->


                                    <div class="card_details">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="font-weight-bold mb-0">Card Details</h6>

                                            <div class="d-flex align-items-center cardImage">
                                                <img src="{{ asset('assets/dashboard/img/visa.png') }}" alt="Visa"
                                                    class="me-2">
                                                <img src="{{ asset('assets/dashboard/img/master-card.png') }}"
                                                    alt="MasterCard">
                                            </div>
                                        </div>
                                        <hr class="mt-0">
                                        <div class="form-group">
                                            <input id="cc-number" class="form-control number" placeholder="Card Number">
                                            <small class="text-danger error-msg" data-field="number"></small>

                                        </div>

                                        <div class="form-group">
                                            <input id="cc-name" class="form-control name" placeholder="Name on Card">
                                            <small class="text-danger error-msg" data-field="name"></small>

                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <input id="cc-expiry-month" class="form-control expiry_month"
                                                    placeholder="MM">
                                                <small class="text-danger error-msg" data-field="expiry_month"></small>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <input id="cc-expiry-year" class="form-control expiry_year"
                                                    placeholder="YYYY">
                                                <small class="text-danger error-msg" data-field="expiry_year"></small>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <input id="cc-cvc" class="form-control cvc" placeholder="CVC">
                                                <small class="text-danger error-msg" data-field="cvc"></small>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="my-3 text-right">
                                        {{-- <button onclick="prev()" class="btn-common" id="btnBacklast"> <i
                                                class="fas fa-arrow-left text-white pr-2"></i>
                                            Back</button> --}}
                                        <button type="button" class="btn-success-modal btn-block" id="makeOrder">Pay
                                            Now</button>

                                        {{-- <button type="submit" name="action" value="pay_now" class="btn-success-modal btn-block">
                                            Pay Now
                                        </button> --}}
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.two-step-verification', ['action' => true, 'inPaymentMode' => true])
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script src='https://cdn.pinpayments.com/pin.v2.js'></script>
    <script>
        let loginUserId = '{{ Auth::user()->id }}';
    </script>
    <script type="text/javascript" src="{{ asset('escort/js/main.js') }}"></script>

    <script>
        let cart = getCart();
        let productIds = Object.keys(cart) ?? '[]';
        let finalCart = getFinalCart();
        let step = 1;
        let paymentForm = $('form.pin');

        // localStorage.setItem('checkout_step_' + loginUserId, step);
        let isDirty = false;





        function loadProducts() {

            $("#loader").show();
            $.ajax({
                url: "{{ route('escort.get.products') }}",
                type: "POST",
                data: {
                    ids: productIds,
                    cart: cart,
                    finalCart: finalCart,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {
                    $("#loader").hide();
                    if (response.status == true) {
                        window.location.href = "{{ route('escort.products') }}";
                    }
                    $(".table-content").html(response.html);
                    getCheckedCheckBox();
                    calculateTotals();
                },

                error: function(xhr, status, error) {
                    $("#loader").hide();

                    // Log the actual error in console for debugging
                    // Handle unauthorized
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: "warning",
                            title: "Unauthorized",
                            text: "Your login session expired. Please log in again."
                        });
                        return;
                    }

                    // Handle 500 server error
                    if (xhr.status === 500) {
                        Swal.fire({
                            icon: "error",
                            title: "Server Error",
                            text: "Something went wrong on the server. Try again later."
                        });
                        return;
                    }

                    $("#loader").hide();

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again."
                    });
                }
            });
        }



        function loadTransactionSummary() {
            let details = getDeliveryDetails();
            let finalCart = getFinalCart();
            let shipping = details.delivery_type;
            $("#transactionLoader").show();
            $.ajax({
                url: "{{ route('escort.transaction.summary') }}",
                type: "POST",
                data: {
                    ids: productIds,
                    cart: cart,
                    shipping: shipping,
                    finalCart: finalCart,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {
                    $("#transactionLoader").hide();
                    $(".transaction_summary").html(response.html);
                },
                error: function(xhr, status, error) {
                    $("#transactionLoader").hide();
                    // Handle unauthorized
                    if (xhr.status === 401) {
                        Swal.fire({
                            icon: "warning",
                            title: "Unauthorized",
                            text: "Your login session expired. Please log in again."
                        });
                        return;
                    }

                    // Handle 500 server error
                    if (xhr.status === 500) {
                        Swal.fire({
                            icon: "error",
                            title: "Server Error",
                            text: "Something went wrong on the server. Try again later."
                        });
                        return;
                    }

                    $("#transactionLoader").hide();

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Something went wrong. Please try again."
                    });
                }
            });
        }
        let steps = localStorage.getItem('checkout_step_' + loginUserId);
        // console.log(steps);
        if (steps == 1 || steps == null) {
            loadProducts();

        }

        $(document).on("change", ".qty-select", function() {
            let id = $(this).data("id");
            let qty = parseInt($(this).val());

            // Update only qty
            if (cart[id]) {
                cart[id].qty = qty;
            }

            saveCart(cart);

            // Call calculation function
            calculateTotals();
        });

        function removeItemFromCart(id) {

            let cart = getCart(); // your function that returns cart object
            let finalCart = getFinalCart();
            delete cart[id];
            finalCart = finalCart.filter(item => item != id);

            localStorage.setItem('cart_' + loginUserId, JSON.stringify(cart));
            localStorage.setItem('finalCart_' + loginUserId, JSON.stringify(finalCart));

            location.reload(true);
        }

        function calculateTotals() {
            let grandTotal = 0;

            // Loop through ALL rows
            $(".qty-select").each(function() {
                let id = $(this).data("id");
                let row = $(this).closest("tr");

                let qty = parseInt($(this).val());
                let price = parseFloat(row.find("td:nth-child(4)").text().replace("$", ""));

                // Check if this product is checked
                let isChecked = $(`.product-check[data-id="${id}"]`).is(":checked");
                let rowTotal = qty * price;
                if (isChecked) {
                    // Calculate row total only if checked


                    $(`.total-cell[data-id="${id}"]`).text("$" + rowTotal.toFixed(2));

                    grandTotal += rowTotal;
                } else {
                    // If NOT checked, set row total to $0.00 (or leave it blank)
                    $(`.total-cell[data-id="${id}"]`).text("$" + rowTotal.toFixed(2));
                }
            });

            // Update footer grand total
            $("#grand-total").text("$" + grandTotal.toFixed(2));
        }


        const step1 = document.getElementById('pro-step-1');
        const step2 = document.getElementById('pro-step-2');
        const step3 = document.getElementById('pro-step-3');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');

        function showStep() {
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            document.getElementById("step" + step).classList.add("active");
        }

        $(document).on("change", "#select-all", function() {
            let checked = this.checked;
            $(".product-check").prop("checked", checked).trigger("change");
        });

        $(document).on("change", ".product-check", function() {
            let finalCart = getFinalCart();
            let id = $(this).data("id");
            if (this.checked) {
                if (!finalCart.includes(id))
                    finalCart.push(id);
            } else {
                finalCart = finalCart.filter(itemId => itemId !== id);
            }
            getCheckedCheckBox();
            
            saveFinalCart(finalCart);

            calculateTotals();

        });


        function getCheckedCheckBox() {
            let total = $('.product-check').length;
            let checked = $('.product-check:checked').length;

            if (total > 0)
                $('#select-all').prop('checked', total == checked);
        }



        function next() {
            if (step === 1) {

                let finalCart = getFinalCart();

                if (Object.keys(finalCart).length === 0) {
                    Swal.fire('Please select at least one product before continuing.', '', 'error');
                    return;
                }
                updateOrderSummary();
                updateDeliveryAddress();

                step = 2;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step1.classList.remove("is-active");
                bar1.style.width = "100%"; // fill progress bar
                step2.classList.add("is-active");
            } else if (step === 2) {

                let isValid = true;
                if (!validateStep2()) return false;

                if (!isValid)
                    return false;

                saveStep2Data();
                let card = {};
                let sameAddress = $('input[name="sameAddress"]').is(':checked');

                if (sameAddress) {
                    // get from normal fields 
                    card.address_line1 = $('input[name="address"]').val() || '';
                    card.address_line2 = $('input[name="address_2"]').val() || '';
                    card.address_city = $('input[name="city"]').val() || '';
                    card.address_postcode = $('input[name="pincode"]').val() || '';

                } else {
                    // get from billing section
                    card.address_line1 = $('input[name="billing_address_line1"]').val() || '';
                    card.address_line2 = $('input[name="billing_address_line2"]').val() || '';
                    card.address_city = $('input[name="billing_city"]').val() || '';
                    card.address_postcode = $('input[name="billing_pincode"]').val() || '';

                }
                card.address_state = "{{ $state }}";
                card.address_country = "{{ $country }}";
                saveCardBilling(card);
                updateDeliveryAddress();

                updateOrderSummary();

                loadTransactionSummary();
                step = 3;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step2.classList.remove("is-active");
                bar2.style.width = "100%"; // fill progress bar
                step2.classList.add("is-active");


            } else if (step === 3) {
                updateDeliveryAddress();
                updateOrderSummary();
                loadTransactionSummary();



                $("#process-payment-modal").modal('show');
                // step = 3;
                // localStorage.setItem("checkout_step_" + loginUserId, step);

                // step2.classList.remove("is-active");
                // bar2.style.width = "100%";
                // step3.classList.add("is-active");
                // showStep();

            }

            showStep();
        }



        $(document).on("click", "#finish_payment", function() {
            processPaymentForm();
        })


        var pinApi = new Pin.Api("{{ config('app.payment.publish_key') }}", 'test');



        $(document).on('click', "#makeOrder", function() {
            let btn = $("#makeOrder");
            btn.prop("disabled", true);


            var card = {
                number: $('#cc-number').val(),
                name: $('#cc-name').val(),
                expiry_month: $('#cc-expiry-month').val(),
                expiry_year: $('#cc-expiry-year').val(),
                cvc: $('#cc-cvc').val(),
            };

            let billingDetails = getCardBilling();
            card = {
                ...card,
                ...billingDetails
            };

            pinApi.createCardToken(card).then(handleSuccess, handleError).done();


            function handleSuccess(card) {
                localStorage.setItem('card_token_' + loginUserId, JSON.stringify(card.token));

                $("#sendOtp_modal").modal('show');
                paymentForm.closest('.modal').modal('hide');

            }

            function handleError(response) {

                if (response.messages) {
                    $.each(response.messages, function(index, paramError) {
                        let fieldName = paramError.param;
                        let fieldError = $('.error-msg[data-field="' + fieldName + '"]');
                        if (fieldError.length)
                            fieldError.text(paramError.message); // show under field
                        else
                            $('<li>').text(fieldName + ": " + paramError.message).appendTo(errorList);

                    });
                }
                // Re-enable buttons
                btn.prop("disabled", false);
            }
        })


        var processPaymentForm = function() {

            let btn = $("#makeOrder");
            btn.prop("disabled", true);
            $(".error-msg").text(""); // clear all existing errors

            let orderData = {};
            // get details from local stoarge
            let cart = getCart();
            let finalCart = getFinalCart();

            // get final cart item 
            let itemDetails = Object.fromEntries(
                Object.entries(cart).filter(([key, value]) => finalCart.includes(parseInt(key)))
            );
            let formData = getDeliveryDetails();
            // delivery type
            formData.delivery_type = $('input[name="delivery_type"]:checked').val();
            let sameAddress = $('input[name="sameAddress"]').is(':checked');
            formData.isSameAddress = sameAddress;
            // get payment details like tax sub total toatal amount for corss check in backend before make payment
            let paymentDetails = getPaymentDetails();

            // set details to make order
            orderData.deliveryDetails = formData;
            orderData.itemDetails = itemDetails;
            orderData.paymentDetails = paymentDetails;
            let cardToken = JSON.parse(localStorage.getItem('card_token_' + loginUserId) || '[]');
            orderData.pin_token = cardToken;
            // console.log(orderData);


            $.ajax({
                url: "{{ route('escort.make.order.payment') }}",
                type: "POST",
                data: orderData,
                dataType: "json",
                beforeSend: function() {
                    Swal.fire({
                        title: "Processing your payment...",
                        html: "Please wait",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {

                    if (response.status == true) {
                        var modal = $("#process-payment-modal");

                        // fully force-close modal
                        modal.removeClass("show").css("display", "none");
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();

                        Swal.fire(response.message, '', 'success');
                        step = 4;
                        localStorage.setItem("checkout_step_" + loginUserId, step);

                        step3.classList.remove("is-active");
                        bar3.style.width = "100%";
                        step3.classList.add("is-active");
                        showStep();
                        flushLocalStorage();

                    } else {

                        if (response.errors && typeof response.errors === "object" && response
                            .errors && Object.keys(response.errors).length > 0) {
                            let html = '<div class="alert alert-danger"><ul>';
                            Object.values(response.errors).forEach(function(errArr) {
                                html += `<li>${errArr.message}</li>`;
                            });
                            html += '</ul></div>';
                            Swal.fire(response.message + html, '', 'error');
                        } else {
                            Swal.fire(response.message, '', 'error');
                        }


                    }
                },

                error: function(xhr) {
                    let res = xhr.responseJSON;
                    Swal.fire(res.message, '', 'error');
                },
                complete: function() {
                    btn.prop("disabled", false).text("Make Payment");
                }
            });
        }




        function saveStep2Data() {
            let data = $('#deliveryAddressForm').serializeArray();
            let result = {};

            data.forEach(item => {
                result[item.name] = item.value;
            });

            // localStorage.setItem("deliveryAddress", JSON.stringify(result));
            saveDeliveryDetails(result);
            return result; // return to use in AJAX
        }

        function validateStep2() {
            let form = $('#deliveryAddressForm').parsley();
            form.validate();
            return form.isValid();
        }


        var form = $('#deliveryAddressForm'); // your form ID

        $('#sameAddress').on('change', function() {

            if ($(this).is(':checked')) {

                $('#billingSection')
                    .find('input, textarea, select')
                    .attr('disabled', true)
                    .removeAttr('required');

                // ✅ Reset validation on FORM
                form.parsley().reset();

            } else {

                $('#billingSection')
                    .find('input, textarea, select')
                    .attr('disabled', false)
                    .each(function() {

                        if ($(this).data('required') === true || $(this).attr('name')?.includes('billing_')) {
                            $(this).attr('required', true);
                        }

                    });

                // optional re-validate
                form.parsley().validate();
            }
        });

        function toggleBilling() {
            if ($("#sameAddress").is(":checked")) {
                $("#billingSection").hide().find("input, textarea").attr("disabled", true);
            } else {
                $("#billingSection").show().find("input, textarea").attr("disabled", false);
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            let savedStep = localStorage.getItem("checkout_step_" + loginUserId);
            if (savedStep) {
                step = parseInt(savedStep);
            } else {
                step = 1; // default

                let getCart = getCartCount();

                if (getCart == 0) {
                    window.location.href = "{{ route('escort.products') }}";
                }
            }

            if (step == 2) {
                updateDeliveryAddress();
                updateOrderSummary();

            }
            if (savedStep == 3) {
                loadTransactionSummary();
            }

            applyStepUI(step);
        });

        function applyStepUI(step) {
            if (step >= 1) {
                step1.classList.add("is-active");
            }

            if (step >= 2) {
                step1.classList.remove("is-active");
                bar1.style.width = "100%";
                step2.classList.add("is-active");
            }

            if (step >= 3) {
                step2.classList.remove("is-active");
                bar2.style.width = "100%";
                step3.classList.add("is-active");
            }
            // if (step >= 4) {
            //     step3.classList.remove("is-active");
            //     bar3.style.width = "100%";
            //     step4.classList.add("is-active");
            // }
            showStep();
        }

        function updateDeliveryAddress() {
            let saved = getDeliveryDetails();

            if (saved) {
                // Fill text inputs & textarea
                for (let key in saved) {
                    let field = $(`[name="${key}"]`);

                    // Handle radio buttons
                    if (field.attr("type") === "radio") {
                        $(`input[name="${key}"][value="${saved[key]}"]`).prop("checked", true);
                    } else {
                        field.val(saved[key]);
                    }
                }
            }
        }

        function updateOrderSummary() {
            let cart = getCart()
            let finalCart = getFinalCart();
            // calculate subtotal according final cart
            let subtotal = 0;
            finalCart.forEach(id => {
                if (cart[id]) {
                    subtotal += cart[id].qty * parseFloat(cart[id].price);
                }
            });

            let deliveryCharge = 0.00;
            let tax = parseFloat("{{ config('escorts.product_tax') }}");
            let type = $('input[name="delivery_type"]:checked').val();

            if (type == 'post') {
                deliveryCharge = parseFloat("{{ config('escorts.delivery_charge_post') }}");
            } else if (type == 'door') {
                deliveryCharge = parseFloat("{{ config('escorts.delivery_charge_door') }}");
            }

            let total = subtotal + deliveryCharge;
            let gst = subtotal * tax / 100; //GST
            // set amount details after calculation in html format
            $(".paymentSubtotal").text("$" + subtotal.toFixed(2));
            $("#total_fee").text("$ " + subtotal.toFixed(2));
            $(".deliveryCharge").text("$" + deliveryCharge.toFixed(2));
            $(".taxAmount").text("$" + gst.toFixed(2));
            $(".totalDue").text("$" + total.toFixed(2));

            // set data to local storage for make order 
            let paymentData = {
                total_payble: total.toFixed(2),
                tax_payble: gst.toFixed(2),
                deliveryCharge: deliveryCharge.toFixed(2),
                subtotal_payble: subtotal.toFixed(2)
            };

            // localStorage.setItem("paymentDetails", JSON.stringify(paymentData));
            savePaymentDetails(paymentData)


            // fill billing details
            let billingDetails = getCardBilling();

            $("#address-line1").val(billingDetails.address_line1);
            $("#address-line2").val(billingDetails.address_line2);
            $("#address-city").val(billingDetails.address_city);
            $("#address-state").val(billingDetails.address_state);
            $("#address-postcode").val(billingDetails.address_postcode);
            $("#address-country").val(billingDetails.address_country);


        }


        $('input[name="delivery_type"]').on('change', function() {
            saveStep2Data();
            updateOrderSummary();
        });

        $(document).ready(function() {
            let deliveryDetails = getDeliveryDetails();
            $('input[name="delivery_type"]').prop('checked', false).removeAttr('checked');

            // STEP 2: Check the correct one
            $('input[name="delivery_type"][value="' + deliveryDetails.delivery_type + '"]')
                .prop('checked', true)
                .attr('checked', 'checked'); // only if you need HTML updated
        })

        function prev() {
            if (step === 2) {
                step = 1;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step2.classList.remove("is-active");
                step1.classList.add("is-active");
                bar1.style.width = "0%"; // reset bar
                loadProducts();
            } else if (step === 3) {
                // move to 1 step because if yopu are at 3 that's mean order is completed
                updateDeliveryAddress();
                // updateOrderSummary();
                step = 2;
                localStorage.setItem("checkout_step_" + loginUserId, step); // <<< save step

                step3.classList.remove("is-active");
                step2.classList.add("is-active");
                bar2.style.width = "0%"; // reset bar
            } else if (step === 4) {

                finish();

            }
            showStep();
        }

        function finish() {
            flushLocalStorage();
            Swal.fire('Process Completed!', '', 'success');
            window.location.href = "{{ route('escort.products') }}"; // reset();
        }

        // function reset() {
        //     step = 1;
        //     localStorage.setItem("checkout_step_"+ loginUserId, step); // <<< save step

        //     step1.classList.add("is-active");
        //     step2.classList.remove("is-active");
        //     step3.classList.remove("is-active");

        //     bar1.style.width = "0%";
        //     bar2.style.width = "0%";

        //     showStep();
        // }

        // $('#userProfile').parsley({

        // });

        $("#sendOtp_modal").on('show.bs.modal', function() {
            $.ajax({
                url: `{{ route('send.opt.notification', ['user' => Auth::user()->id]) }}`,
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    action: 'payment'
                },
                success: function(res, textStatus, xhr) {
                    console.log(res);
                },
                error: function(xhr) {
                    Swal.close();
                    let option = getStatusOption(xhr);
                    Swal.fire({
                        icon: option.icon,
                        title: option.title,
                        text: option.message
                    });
                }
            });
        });
        var finishPaymentForm = $('.finish-payment-form');


        $(document).ready(function() {

            $(document).on("click", "#applyWallet", function(e) {
                e.preventDefault(); // Stop normal form submit
                updateOrderSummary();

                let form = $("#adjustment-form");
                let formData = form.serialize();
                let walletAmount = Number(form.find('input[name="wallet_amount"]').val());
                // Get existing details (if any)
                let key = 'paymentDetails_' + loginUserId;

                let details = JSON.parse(localStorage.getItem(key)) || {};
                let dueAmount = Number(details.total_payble);

                let accountWalletAmount = parseFloat("{{ Auth::user()->wallet->balance }}");
                if (accountWalletAmount <= 0) {
                    Swal.fire("Insufficient wallet balance.", "You don't have enough amount to apply.",
                        "error");
                    return;
                } else if (walletAmount > accountWalletAmount) {
                    Swal.fire("The wallet amount you entered exceeds your wallet balance.", '', 'error');
                    return;
                }


                if (walletAmount == "" || walletAmount == null) {
                    Swal.fire("The wallet amount is required to apply the wallet.", '',
                        'error');
                    return;
                }

                if (walletAmount > dueAmount) {
                    Swal.fire("The wallet amount you entered exceeds the total due amount.", '',
                        'error');
                    return;
                }



                let remaining_wallet_balance = Number(accountWalletAmount - walletAmount);


                $("#walletAmount").text("$" + Number(remaining_wallet_balance)
                    .toFixed(2));
                $("#walletUsed").text("$" + Number(walletAmount).toFixed(2));

                // FORCE numeric values
                let oldSubtotal = Number(details.subtotal_payble) || 0;
                let oldTotalPayble = Number(details.total_payble) || 0;
                let walletUsed = Number(walletAmount) || 0;

                // Calculate new totals
                let subtotal = oldSubtotal - walletUsed;
                let total_payble = oldTotalPayble - walletUsed;


                // Update values in object
                details.total_payble = total_payble.toFixed(2);
                details.wallet_amount = walletUsed.toFixed(2);

                // Save back to local storage

                localStorage.setItem(key, JSON.stringify(details));
                let tax = parseFloat("{{ config('escorts.product_tax') }}");

                let gst_amount = oldSubtotal * tax / 100;
                details.tax_payble = gst_amount.toFixed(2);
                if (total_payble == 0) {
                    $(".card_details").find("input, select, textarea, button").prop("disabled", true);
                    subtotal = oldSubtotal;
                    $("#makeOrder").prop("disabled", true);
                    // $("#makeOrder").text("Process Order");
                    finishPaymentForm.removeClass('d-none');


                } else {
                    $(".card_details").find("input, select, textarea, button").prop("disabled", false);
                    $("#makeOrder").prop("disabled", false);
                    finishPaymentForm.addClass('d-none');



                }
                // Update UI
                $(".taxAmount").text("$" + gst_amount.toFixed(2));
                $("#total_fee").text("$ " + subtotal.toFixed(2));
                $(".totalDue").text("$" + total_payble.toFixed(2));
                // Save back to localStorage
                localStorage.setItem(key, JSON.stringify(details));
                localStorage.setItem('paymentDetails_' + loginUserId, JSON.stringify(
                    details));

                Swal.fire("Wallet amount applied successfully!", '', 'success');

            });

        });

        $("#resetWallet").on("click", function() {
            $("#adjustment-form")[0].reset();
            updateOrderSummary();

            let accountWalletAmount = "{{ Auth::user()->wallet->balance }}";
            $("#walletUsed").text("$0.00");
            $("#walletAmount").text("$" + accountWalletAmount);
            let key = 'paymentDetails_' + loginUserId;

            let details = JSON.parse(localStorage.getItem(key)) || {};
            let oldTotalPayble = Number(details.total_payble) || 0;
            if (oldTotalPayble > 0) {
                $(".card_details").show();

            }


        })
        getCheckedCheckBox();
    </script>
@endpush
