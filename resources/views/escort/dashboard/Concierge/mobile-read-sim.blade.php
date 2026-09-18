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
    </style>
@endsection
@section('content')
    <div id="wrapper">


        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content start here-->

            <div class="row">
                <div class="col-md-12 custom-heading-wrapper">
                    <h1 class="h1">Mobile SIM</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b></h3>
                            <ol>
                                <li>This form will be pre-populated with your details according to what you have entered
                                    in <a href="{{ route('escort.account.edit') }}" class="custom_links_design">My
                                        Account</a>.
                                    ou can alter any of the information.</li>
                                <li>Payment is based on the period you have selected for the Mobile SIM.</li>
                                <li>Complete the form to request the Mobile SIM. When completing the form please
                                    ensure all of the details are correct and you have selected the correct option for
                                    communications.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 common-card">
                <form class="common-form" id="simOrderForm" action="{{ route('mobile-read-sim') }}" method="POST">
                    <div class="row inner-row">
                        <div class="col-md-12 card-heading">
                            <div class="card-top border-0 p-0 mb-0">
                                <div class="card-icon">
                                    <svg width="40px" height="40px" viewBox="0 -8 72 72" id="Layer_1"
                                        data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
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

                                    <p class="mt-0"> Escorts4U has partnered with a leading supplier of telecommunication
                                        services to be able to
                                        supply a mobile SIM, delivered to your nominated address.</p>
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
                                        enable-background="new 0 0 512 512" id="Receiver" version="1.1"
                                        xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#ff3c5f" stroke-width="9.728">
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
                                    <h2>Order Mobile SIM</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <label for="email"><b>Your Name</b><span class="text-danger"> *</span> </label>
                                    <input id="name" value="{{ old('first_name') }}" placeholder="Birth Name"
                                        name="first_name" type="text" class="form-control" required>
                                    @error('first_name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email"><b>Email Address</b><span class="text-danger"> *</span>
                                    </label>
                                    <input id="email" value="{{ old('email') }}" required
                                        placeholder="Email Address" name="email" type="text" class="form-control">
                                    @error('email')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email"><b>Mobile Number</b> <span class="text-danger"> *</span>
                                    </label>
                                    <input id="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"
                                        name="mobile" type="number" class="form-control" required>
                                    @error('mobile')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email"><b> Delivery address
                                        </b> <span class="text-danger">*</span> </label>
                                    <input id="delivery_address" value="{{ old('delivery_address') }}"
                                        placeholder="Your address" name="delivery_address" type="text"
                                        class="form-control" required>
                                    @error('delivery_address')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="period_required"><b>Period required</b><span class="text-danger">
                                            *</span></label>
                                    <div class="input-group">
                                        <input type="number" value="{{ old('period_required') }}" required
                                            class="form-control" name="period_required" id="period_required"
                                            placeholder="Enter months" min="1">
                                        {{-- <div class="input-group-append">
                                            <span class="input-group-text">Months</span>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div><label for="preference"><b>Your contact preference</b> </label></div>
                                    <div class="radio-options mt-2 mb-1">

                                        <div class="form-check form-check-inline ml-0">
                                            <input name="contact_pref_email" class="form-check-input" type="checkbox"
                                                id="pref_Email" checked>
                                            <label class="form-check-label" for="pref_Email">Email</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input name="contact_pref_mobile" class="form-check-input" type="checkbox"
                                                id="pref_Mobile">
                                            <label class="form-check-label" for="pref_Mobile">Mobile</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Comments</label>
                                    <textarea class="form-control what_happened" name="comments" id="exampleFormControlTextarea1" rows="7"
                                        placeholder="Up to 300 character">{{ old('comments') }}</textarea>
                                    <p class="cp-hint mb-0">
                                        <small><i>Please provide any
                                                additional information to assist us</i> </small>
                                    </p>
                                </div>
                            </div>
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <div class="form-check form-check-inline ml-0">
                                        <input name="auth" class="form-check-input" type="checkbox" id="auth">
                                        <label class="form-check-label" for="auth"> I authorise E4U to debit my
                                            nominated Card.</label>
                                    </div>
                                    @error('auth')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="inner-field-row">
                                <div class="form-group">
                                    <div class="form-check form-check-inline ml-0">
                                        <input name="terms" class="form-check-input" type="checkbox" id="pref_terms">
                                        <label class="form-check-label" for="pref_terms"> I have read and agree to the
                                            <a href="{{ route('pages.terms-conditions') }}#mobile-sim" target="_blank"
                                                class="custom_links_design">Terms.</a></label>

                                    </div>
                                    @error('terms')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="common-footer">
                            <button type="submit" class="common-save-btn">
                                Place Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--middle content end here-->
        </div>

        {{-- popup --}}

        <div class="modal fade upload-modal" id="new-ban" style="backdrop-filter: brightness(0.5);" tabindex="-1"
            role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="border: 2px solid;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="new-ban"><b>Mobile SIM Order Confirmation </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <p>
                            Your Request for a
                            Mobile SIM has been received. You will also receive an A-Alert confirming your request with a
                            reference. If you have not received your Mobile SIM within 48 hours, please raise a Support
                            Ticket quoting the reference.
                        </p>
                        <p>Date Sent:<span class="ml-1 sent_date"
                                style="">{{ isset($simData) && $simData != null ? $simData->created_at->format('d-m-Y') : '' }}</span>
                        </p>
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
            // console.log('hello jiten');
            //$('#new-ban').hide();
            $(".close").click(function() {
                $('#new-ban').hide();
            })

            @if (isset($simData) && $simData != null)
                $('#new-ban').show();
            @endif
        </script>

        <script></script>
    @endpush
