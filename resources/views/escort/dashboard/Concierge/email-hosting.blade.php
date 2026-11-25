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

        .cardImage img {
            height: 40px !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Email Account</h1>
                <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                    aria-expanded="true">Help?</span>
            </div>
            <div class="col-md-12 ">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>This form will be pre-populated with your details according to what you have entered
                                in <a href="{{ route('escort.account.edit') }}" class="custom_links_design">My
                                    Account</a>. You can alter any of the information.</li>

                            <li>Payment is based on the monthly Fee for the Email service.</li>
                            <li>Complete the form to request the Email service. When completing the form please
                                ensure all of the details are correct and you have selected the correct option for
                                communications.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-lg-12">

                {{-- Step 1: Order Form --}}
                <div class="common-card" id="orderFormSection">
                    <form id="emailServiceOrderForm" class="common-form">
                        <div class="row inner-row">
                            <div class="col-md-12 card-heading">
                                <div class="card-top border-0 p-0 mb-0">
                                    <div class="card-icon">
                                        <svg width="40px" height="40px" viewBox="0 -8 72 72" id="Layer_1" data-name="Layer 1"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill: #ff3c5f;
                                                        }
                                                    </style>
                                                </defs>
                                                <title>handshake</title>
                                                <path class="cls-1"
                                                    d="M64,12.78v17s-3.63.71-4.38.81-3.08.85-4.78-.78C52.22,27.25,42.93,18,42.93,18a3.54,3.54,0,0,0-4.18-.21c-2.36,1.24-5.87,3.07-7.33,3.78a3.37,3.37,0,0,1-5.06-2.64,3.44,3.44,0,0,1,2.1-3c3.33-2,10.36-6,13.29-7.52,1.78-1,3.06-1,5.51,1C50.27,12,53,14.27,53,14.27a2.75,2.75,0,0,0,2.26.43C58.63,14,64,12.78,64,12.78ZM27,41.5a3,3,0,0,0-3.55-4.09,3.07,3.07,0,0,0-.64-3,3.13,3.13,0,0,0-3-.75,3.07,3.07,0,0,0-.65-3,3.38,3.38,0,0,0-4.72.13c-1.38,1.32-2.27,3.72-1,5.14s2.64.55,3.72.3c-.3,1.07-1.2,2.07-.09,3.47s2.64.55,3.72.3c-.3,1.07-1.16,2.16-.1,3.46s2.84.61,4,.25c-.45,1.15-1.41,2.39-.18,3.79s4.08.75,5.47-.58a3.32,3.32,0,0,0,.3-4.68A3.18,3.18,0,0,0,27,41.5Zm25.35-8.82L41.62,22a3.53,3.53,0,0,0-3.77-.68c-1.5.66-3.43,1.56-4.89,2.24a8.15,8.15,0,0,1-3.29,1.1,5.59,5.59,0,0,1-3-10.34C29,12.73,34.09,10,34.09,10a6.46,6.46,0,0,0-5-2C25.67,8,18.51,12.7,18.51,12.7a5.61,5.61,0,0,1-4.93.13L8,10.89v19.4s1.59.46,3,1a6.33,6.33,0,0,1,1.56-2.47,6.17,6.17,0,0,1,8.48-.06,5.4,5.4,0,0,1,1.34,2.37,5.49,5.49,0,0,1,2.29,1.4A5.4,5.4,0,0,1,26,34.94a5.47,5.47,0,0,1,3.71,4,5.38,5.38,0,0,1,2.39,1.43,5.65,5.65,0,0,1,1.48,4.89,0,0,0,0,1,0,0s.8.9,1.29,1.39a2.46,2.46,0,0,0,3.48-3.48s2,2.48,4.28,1c2-1.4,1.69-3.06.74-4a3.19,3.19,0,0,0,4.77.13,2.45,2.45,0,0,0,.13-3.3s1.33,1.81,4,.12c1.89-1.6,1-3.43,0-4.39Z">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Partnership</h2>

                                        <p class="mt-0">Escorts4U has partnered with a leading email services supplier to be
                                            able to
                                            provide
                                            email
                                            services under the domain <a href=""
                                                class="custom_links_design">MemberID@e4u.com.au</a> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="row inner-row">
                            <div class="col-lg-12">
                                <div class="card-top">
                                    <div class="card-icon">
                                        <svg fill="#ff3c5f" width="40px" height="40px" viewBox="0 0 512 512"
                                            enable-background="new 0 0 512 512" id="Receiver" version="1.1" xml:space="preserve"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                            stroke="#ff3c5f" stroke-width="9.728">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <g>
                                                    <rect height="11.49"
                                                        transform="matrix(0.583 0.8125 -0.8125 0.583 226.947 -238.2861)"
                                                        width="10" x="340.606" y="96.198"></rect>
                                                    <path
                                                        d="M471.972,321.252c-8.603-5.896-19.543-7.17-29.269-3.412l-0.216,0.084l-4.209,2.013 c-7.125-8.887-18.328-13.822-29.897-12.813c-4.169,0.346-8.234,1.455-12.113,3.311l-2.087,1.012 c-3.405-5.924-8.759-10.378-15.272-12.643c-7.165-2.491-14.869-2.041-21.687,1.266l-46.594,22.544 c-3.611-1.446-7.547-2.249-11.669-2.249h-97.376l-5.925,0.051c-36.098,0.317-70.114,16-93.778,43.129H81.922v-14.181H26.293v10 h45.629v92.139H26.293v10h55.629v-14.665h26.631l176.719,10.619c0.782,0.047,1.564,0.07,2.347,0.07 c5.896,0,11.755-1.328,17.066-3.882l161.044-76.927c4.047-1.602,7.651-3.967,10.718-7.033c5.972-5.971,9.26-13.912,9.26-22.361 C485.707,336.895,480.572,327.148,471.972,321.252z M394.086,324.83l7.391-3.586c2.529-1.21,5.187-1.938,7.921-2.164 c6.6-0.578,13.002,1.789,17.612,6.245l-96.291,46.043h-7.043c3.485-4.407,5.816-9.763,6.54-15.613L394.086,324.83z M362.453,310.867c3.936-1.908,8.379-2.168,12.514-0.73c3.485,1.212,6.387,3.516,8.359,6.564l-54.161,26.229 c-1.399-4.722-3.876-8.983-7.146-12.499L362.453,310.867z M467.963,361.198c-1.935,1.935-4.22,3.421-6.79,4.415l-0.214,0.083 L299.5,442.822c-4.193,2.016-8.865,2.934-13.509,2.654l-176.897-10.63l-27.171-0.011v-59.293h25.536l1.799-2.158 c21.462-25.742,52.992-40.676,86.506-40.971l5.872-0.051h97.324c10.755,0,19.505,8.749,19.505,19.504 c0,10.732-8.714,19.464-19.438,19.501h-73.859l-29.087,9.538l3.739,11.402l27.265-8.94h4.151v0.003h67.724 c0.045,0,0.09-0.003,0.135-0.003h34.346l113.793-54.413c6.067-2.271,12.6-1.477,17.953,2.195c5.416,3.713,8.521,9.607,8.521,16.172 C473.707,352.566,471.667,357.494,467.963,361.198z">
                                                    </path>
                                                    <rect height="10.887" width="10" x="55.701" y="367.885"></rect>
                                                    <rect height="56.831" width="10" x="55.701" y="386.607"></rect>
                                                    <polygon
                                                        points="266.134,237.522 266.134,289.451 255.578,278.895 248.507,285.966 271.134,308.594 293.879,285.848 286.809,278.776 276.134,289.451 276.134,237.522 ">
                                                    </polygon>
                                                    <path
                                                        d="M223.865,253.561l-10.615-10.615l-7.071,7.071l22.627,22.627l22.745-22.746l-7.071-7.071l-10.615,10.615v-24.42h74.537 v24.539l-10.615-10.615l-7.07,7.071l22.627,22.627l22.745-22.746l-7.07-7.071l-10.616,10.616v-24.421h96.925V50.499H126.94v178.523 h96.925V253.561z M146.479,219.022l88.992-69.4l-6.149-7.886l-92.381,72.043V65.241l119.692,85.89 c4.338,3.112,9.42,4.668,14.502,4.668c5.083,0,10.166-1.556,14.503-4.668l49.217-35.318l-5.83-8.125l-49.217,35.318 c-5.187,3.723-12.156,3.723-17.345,0L147.484,60.499h247.299l-38.875,27.896l5.83,8.125l43.589-31.279v148.535l-92.384-72.04 l-6.148,7.886l88.998,69.4h-77.391v-14.25h-10v14.25h-74.537v-14.25h-10v14.25H146.479z">
                                                    </path>
                                                    <rect height="14.5" width="10" x="266.134" y="199.772"></rect>
                                                    <rect height="14.5" width="10" x="223.865" y="181.348"></rect>
                                                    <rect height="14.5" width="10" x="308.402" y="181.348"></rect>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>

                                    <div class="card-heading">
                                        <h2>Order Email service</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="inner-field-row">
                                    @php
                                        $nameParts = preg_split('/\s+/', trim(Auth::user()->name));
                                        $firstName = $nameParts[0] ?? '';
                                        $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';
                                    @endphp
                                    <div class="form-group">
                                        <label for="email"><b>First Name</b><span class="text-danger">*</span> </label>
                                        <input id="name" value="{{ $firstName }}" placeholder="First Name" name="first_name"
                                            type="text" class="form-control">

                                        <span class="text-danger error-text first_name_error"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="email"><b>Last Name</b> </label>
                                        <input id="name" placeholder="Last Name" name="last_name" type="text"
                                            value="{{ $lastName }}" class="form-control">
                                        <span class="text-danger error-text last_name_error"></span>

                                    </div>

                                    <div class="form-group">
                                        <label for="email"><b>Email</b><span class="text-danger">*</span>
                                        </label>
                                        <input id="email" value="{{ Auth::user()->email }}" required
                                            placeholder="Email Address" name="email" type="text" class="form-control">
                                        <span class="text-danger error-text email_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><b>Mobile Number</b> <span class="text-danger">*</span>
                                        </label>
                                        <input id="mobile" value="{{ Auth::user()->phone }}" placeholder="Mobile Number"
                                            name="mobile" type="text" class="form-control">
                                        <span class="text-danger error-text mobile_error"></span>

                                    </div>
                                    <div class="form-group">
                                        <label for="period_required"><b>Period required</b><span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="period_required"
                                                id="period_required" placeholder="Enter months" min="1">

                                        </div>
                                        <span class="text-danger error-text period_required_error"></span>
                                    </div>
                                    {{-- <div class="form-group">
                                        <div><label for="preference"><b>Your contact preference</b> </label></div>
                                        <div class="option-list mt-2">
                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Email" value="email">
                                                <label class="form-check-label" for="pref_Email">Email</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Mobile" value="mobile">
                                                <label class="form-check-label" for="pref_Mobile">Mobile</label>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text contact_pref_error"></span>
                                    </div> --}}
                                    <div class="form-group">
                                        <div>
                                            <label for="preference"><b>Your contact preference</b></label>
                                        </div>

                                        <div class="radio-options mt-2 mb-0">
                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Email" value="email">
                                                <label class="form-check-label m-0" for="pref_Email">Email</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input name="contact_pref[]" class="form-check-input" type="checkbox"
                                                    id="pref_Mobile" value="mobile">
                                                <label class="form-check-label m-0" for="pref_Mobile">Mobile</label>
                                            </div>
                                        </div>

                                        <span class="text-danger error-text contact_pref_error"></span>
                                    </div>
                                </div>
                                <div class="inner-field-row">

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Comments</label>
                                        <textarea class="form-control what_happened" name="comments" id="exampleFormControlTextarea1" rows="7"
                                            placeholder="Up to 300 characters"></textarea>
                                        <p class="cp-hint mb-0">
                                            <small><i>Please provide any additional information to assist us</i> </small>
                                        </p>
                                        <span class="text-danger error-text comments_error"></span>

                                    </div>


                                </div>
                                <div class="inner-field-row">

                                    <div class="form-group w-50">
                                        <div class="form-check form-check-inline ml-0">
                                            <input name="auth" class="form-check-input" type="checkbox" id="auth">
                                            <label class="form-check-label m-0" for="auth"> I authorise E4U to debit
                                                my nominated Card.</label>
                                        </div><br>
                                        <span class="text-danger error-text auth_error"></span>


                                    </div>
                                </div>
                                <div class="inner-field-row">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline ml-0">
                                            <input name="term_condition" class="form-check-input" type="checkbox"
                                                id="pref_terms">
                                            <label class="form-check-label m-0" for="pref_terms"> I have read and agree to
                                                the
                                                <a href="{{ route('pages.terms-conditions') }}#mobile-sim" target="_blank"
                                                    class="custom_links_design">Terms.</a>
                                            </label>

                                        </div><br>
                                        <span class="text-danger error-text term_condition_error"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="common-footer">
                                <button type="button" class="common-save-btn" id="submitAssistanceRequest">
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Step 2: Order Summary --}}
                <div class="common-card" id="orderSummarySection" style="display: none;">
                    <div class="row inner-row">
                        <div class="col-lg-12">
                            <div class="card-top">
                                <div class="card-icon">
                                    <img src="{{ asset('assets/dashboard/img/secure-payment.png') }}"
                                        class="custompopicon" alt="Order Summary" style="width: 30px; height: 30px; margin:0 auto;">
                                </div>
                                <div class="card-heading">
                                    <h2>Order Summary</h2>
                                    <p class="mt-0 mb-0" id="subscription-description"></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <div id="payment-error" class="alert alert-danger" style="display: none;"></div>
                            <div class="card p-3">
                                <div class="order_summary_adjustment" id="emailRequestPaymentSummery">
                                </div>
                            </div>
                        </div>

                        <div class="common-footer d-flex justify-content-between align-items-center w-100 mt-4">
                            <button type="button" class="btn-cancel-modal" id="backToOrderForm">
                                Back
                            </button>
                            <button type="button" class="common-save-btn" id="makePayment">
                                Proceed to Payment
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!--middle content end here-->
    </div>

    {{-- popup --}}

    <div class="modal fade upload-modal" id="visa_migration_request" style="backdrop-filter: brightness(0.5);"
        tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border: 2px solid;">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban"><b>Email service Order Confirmation </b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <p>
                        Your Request for an Email account has been received. You will also receive an A-Alert
                        confirming your request with a reference. If you have not received notification of the
                        Email account activation within 24 hours, please raise a Support Ticket quoting the
                        reference.
                    </p>
                    <p>Date Sent:<span class="ml-1 sent_date"
                            style="">{{ isset($simData) && $simData != null ? $simData->created_at->format('d-m-Y') : '' }}</span>
                    </p>
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
                                <div class="order_summary_adjustment">
                                </div>
                                <hr>
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
                                            <input id="address-line1" class="form-control address_line1"
                                                placeholder="Address 1">
                                            <small class="text-danger error-msg" data-field="address_line1"></small>

                                        </div>
                                        <div class="form-group col-12">
                                            {{-- <label class="mb-0" for="add2">Address 2</label> --}}
                                            <input id="address-line2" class="form-control address_line2"
                                                placeholder="Address 2">
                                            <small class="text-danger error-msg" data-field="address_line2"></small>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="City">City</label> --}}
                                            <input id="address-city" class="form-control address_city"
                                                placeholder="City">
                                            <small class="text-danger error-msg" data-field="address_city"></small>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="State">State</label> --}}
                                            <input id="address-state" class="form-control address_state"
                                                placeholder="State">
                                            <small class="text-danger error-msg" data-field="address_state"></small>
                                        </div>
                                        <div class="form-group col-md-4">
                                            {{-- <label class="mb-0" for="Postcode">Postcode</label> --}}
                                            <input id="address-postcode" class="form-control address-postcode"
                                                placeholder="Postcode">
                                            <small class="text-danger error-msg" data-field="address_postcode"></small>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {{-- <label class="mb-0" for="Country">Country</label> --}}
                                        <input id="address-country" class="form-control address_country"
                                            placeholder="Country">
                                        <small class="text-danger error-msg" data-field="address_country"></small>
                                    </div>

                                    <!-- Card -->


                                    <div class="card_details">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="font-weight-bold mb-0">Card Details</h6>

                                            <div class="d-flex align-items-center cardImage">
                                                <img src="https://e4u.local/assets/dashboard/img/visa.png" alt="Visa"
                                                    class="me-2">
                                                <img src="https://e4u.local/assets/dashboard/img/master-card.png"
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

    <div class="modal fade upload-modal" id="payment-summery-modal" tabindex="-1" aria-labelledby="renew_discountLabel"
        data-backdrop="static" data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/secure-payment.png') }}" class="custompopicon"
                            alt="View Centre">
                        Order Summary
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card p-3">
                        <div class="order_summary_adjustment" id="emailRequestPaymentSummery">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="my-3 text-right">

                        <button type="button" class="btn-success-modal" id="makePayment">Pay
                            Now</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modal.two-step-verification', ['action' => true, 'inPaymentMode' => true])
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    <script src='https://cdn.pinpayments.com/pin.v2.js'></script>

    <script>
        let paymentForm = $('form.pin');
        $(document).on("click", "#backToOrderForm", function(e) {
            e.preventDefault();
            $("#orderSummarySection").hide();
            $("#orderFormSection").fadeIn(200);
            $('html, body').animate({ scrollTop: 0 }, 300);
        });

        $(document).on("click", "#makePayment", function(e) {
            e.preventDefault();

            let button = $(this);
            if (button.prop("disabled")) {
                return;
            }

            let duration = $("#period_required").val();
            if (!duration || !Number.isInteger(Number(duration)) || Number(duration) <= 0) {
                $("#payment-error").text("Please enter a valid subscription duration.").show();
                return;
            }

            let originalText = button.html();
            button.prop("disabled", true).html(`
                <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                Loading...
            `);

            $.ajax({
                url: "{{ route('email.hosting.payment.summary') }}",
                type: "POST",
                data: {
                    duration: duration,
                    type: "payment_details",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response, textStatus, xhr) {
                    if (response.success) {
                        $("#process-payment-modal .order_summary_adjustment").html(response.html);
                        $("#process-payment-modal").modal("show");
                    } else {
                        displaySwal(xhr);
                    }
                },
                error: function(xhr) {
                    displaySwal(xhr);
                },
                complete: function() {
                    button.prop("disabled", false).html(originalText);
                }
            });
        });

        $(document).on("click", "#submitAssistanceRequest", function(e) {
            e.preventDefault();

            $(".error-text").text("");
            $(".is-invalid").removeClass("is-invalid");

            let isValid = true;

            function showError(field, message) {
                $(field).addClass("is-invalid");
                $(field).closest(".form-group").find(".error-text").first().text(message);
                isValid = false;
            }

            let firstName = $.trim($('[name="first_name"]').val() || "");
            if (!firstName) {
                showError('[name="first_name"]', "Please enter your first name.");
            }

            let email = $.trim($('[name="email"]').val() || "");
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                showError('[name="email"]', "Please enter your email address.");
            } else if (!emailPattern.test(email)) {
                showError('[name="email"]', "Please enter a valid email address.");
            }

            let mobile = $.trim($('[name="mobile"]').val() || "");
            if (!mobile) {
                showError('[name="mobile"]', "Please enter your mobile number.");
            } else if (!/^[0-9+\-\s()]{7,20}$/.test(mobile)) {
                showError('[name="mobile"]', "Please enter a valid mobile number.");
            }

            let duration = $("#period_required").val();
            if (!duration) {
                showError("#period_required", "Please enter the subscription duration.");
            } else if (!Number.isInteger(Number(duration)) || Number(duration) <= 0) {
                showError("#period_required", "Subscription duration must be a whole number greater than zero.");
            }

            if (!$("#auth").is(":checked")) {
                $("#auth").closest(".form-group").find(".error-text").text("Please authorize E4U to debit your nominated card.");
                isValid = false;
            }

            if (!$("#pref_terms").is(":checked")) {
                $("#pref_terms").closest(".form-group").find(".error-text").text("Please accept the Terms and Conditions to continue.");
                isValid = false;
            }

            let comments = $.trim($("#exampleFormControlTextarea1").val() || "");
            if (comments.length > 500) {
                showError("#exampleFormControlTextarea1", "Comments cannot exceed 500 characters.");
            }

            let contactPreferences = $('input[name="contact_pref[]"]:checked').length;
            if (contactPreferences === 0) {
                $(".contact_pref_error").text("Please select at least one contact preference.");
                $('input[name="contact_pref[]"]').addClass("is-invalid");
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            let button = $(this);
            let originalText = button.html();

            button.prop("disabled", true).addClass("disabled").html(`
                <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                Processing...
            `);

            $("#payment-error").hide().text("");

            $.ajax({
                url: "{{ route('email.hosting.payment.summary') }}",
                type: "POST",
                data: {
                    duration: duration,
                    type: "order_details",
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (!res.success) {
                        $("#payment-error").text(res.message || "Unable to load payment details.").show();
                        $("#makePayment").prop("disabled", true);
                    } else {
                        $("#emailRequestPaymentSummery").html(res.html);
                        $("#subscription-description").text(
                            `Your subscription will be charged monthly for the selected period of ${duration} ${Number(duration) === 1 ? "month" : "months"}.`
                        );
                        $("#makePayment").prop("disabled", false);
                    }

                    $("#orderFormSection").hide();
                    $("#orderSummarySection").fadeIn(200);
                    $('html, body').animate({ scrollTop: 0 }, 300);
                },
                error: function(xhr) {
                    let message = xhr.responseJSON?.message || "Something went wrong while fetching payment details.";
                    $("#payment-error").text(message).show();
                    $("#makePayment").prop("disabled", true);
                    $("#orderFormSection").hide();
                    $("#orderSummarySection").fadeIn(200);
                },
                complete: function() {
                    button.prop("disabled", false).removeClass("disabled").html(originalText);
                }
            });
        });



        var pinApi = new Pin.Api("{{ config('app.payment.publish_key') }}", 'test');
        $(document).on('click', "#makeOrder", function() {
            let btn = $("#makeOrder");
            btn.prop("disabled", true);
            $(".error-msg").text("");

            var card = {
                number: $('#cc-number').val(),
                name: $('#cc-name').val(),
                expiry_month: $('#cc-expiry-month').val(),
                expiry_year: $('#cc-expiry-year').val(),
                cvc: $('#cc-cvc').val(),

                address_line1: $('#address-line1').val(),
                address_line2: $('#address-line2').val(),
                address_city: $('#address-city').val(),
                address_state: $('#address-state').val(),
                address_postcode: $('#address-postcode').val(),
                address_country: $('#address-country').val(),
            };

            pinApi.createCardToken(card).then(handleSuccess, handleError).done();


            function handleSuccess(card) {
                // localStorage.setItem('card_token_' + loginUserId, JSON.stringify(card.token));
                console.log(JSON.stringify(card.token));
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
            let form = document.getElementById("emailServiceOrderForm");

            let requestData = new FormData(form);
            console.log(requestData);
            $.ajax({
                url: "{{ auth()->user()->type == 4 ? route('center.make.order.payment') : route('escort.email.hosting.request') }}",
                type: "POST",
                data: requestData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    Swal.fire({
                        title: "Processing your payment...",
                        html: "<p>Please do not refresh page</p>",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response, textStatus, xhr) {
                    if (response.status == true) {
                        var modal = $("#process-payment-modal");

                        // fully force-close modal
                        modal.removeClass("show").css("display", "none");
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                        displaySwal(xhr);
                    } else {
                        displaySwal(xhr);
                    }
                },
                error: function(xhr) {
                    displaySwal(xhr);
                },
                complete: function() {
                    btn.prop("disabled", false).text("Make Payment");
                }
            });
        }
    </script>
@endpush
