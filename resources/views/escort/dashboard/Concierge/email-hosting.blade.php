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
                <div class="custom-heading-wrapper col-lg-12">
                    <h1 class="h1">Email Account</h1>
                    <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true">Help?</span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                            <p class="mb-1" style="font-size: 20px;"><b>Notes:</b> </p>
                            <ol class=" pl-5">
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

            <div class="row">

                <div class="col-md-9 add-punterbox-report">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class="pb-2"><b>Partnership</b> </h2>
                                    <p>Escorts4U has partnered with a leading email services supplier to be able to provide
                                        email
                                        services under the domain <a href=""
                                            class="custom_links_design">MemberID@e4u.com.au</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="" id="simOrderForm" action="{{ route('mobile-read-sim') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="pb-2 pt-2"><b>Order Email service</b> </h2>
                                <div class="form-group">
                                    <div><label for="preference"><b>Your contact preference</b> </label></div>
                                    <div class="form-check form-check-inline">
                                        <input name="contact_pref_email" class="form-check-input" type="checkbox"
                                            id="pref_Email" checked>
                                        <label class="form-check-label m-0" for="pref_Email">Email</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="contact_pref_mobile" class="form-check-input" type="checkbox"
                                            id="pref_Mobile">
                                        <label class="form-check-label m-0" for="pref_Mobile">Mobile</label>
                                    </div>
                                </div>

                                <b>Your details:</b>
                                <div class="mt-2">
                                    <div class="form-group">
                                        <label for="email"><b>First Name</b><span class="text-danger">*</span> </label>
                                        <input id="name" value="{{ old('first_name') }}" placeholder="First Name"
                                            name="first_name" type="text" class="form-control" required>
                                        @error('first_name')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><b>Last Name</b> </label>
                                        <input id="name" placeholder="Last Name" name="last_name" type="text"
                                            class="form-control">
                                        @error('last_name')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><b>Email</b><span class="text-danger">*</span>
                                        </label>
                                        <input id="email" value="{{ old('email') }}" required
                                            placeholder="Email Address" name="email" type="text" class="form-control">
                                        @error('email')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><b>Mobile Number</b> <span class="text-danger">*</span>
                                        </label>
                                        <input id="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"
                                            name="mobile" type="number" class="form-control" required>
                                        @error('mobile')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="period_required"><b>Period required</b><span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" value="{{ old('period_required') }}" required
                                                class="form-control" name="period_required" id="period_required"
                                                placeholder="Enter months" min="1">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1" style="font-weight: 400;"><b>Comments</b> (<b><i>please provide any
                                            additional information to assist us</i></b>)
                                        </label>
                                        <textarea class="form-control common_textarea" name="comments" id="exampleFormControlTextarea1" rows="7"
                                            placeholder="Up to 300 characters">{{ old('comments') }}</textarea>
                                    </div>
                                    <div class="form-group w-50">
                                        <div class="form-check form-check-inline ml-0">
                                            <input name="auth" class="form-check-input" type="checkbox"
                                                id="auth">
                                            <label class="form-check-label m-0" for="auth"> I authorise E4U to debit
                                                my nominated Card.</label>
                                        </div>
                                        @error('auth')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline ml-0">
                                            <input name="terms" class="form-check-input" type="checkbox"
                                                id="pref_terms">
                                            <label class="form-check-label m-0" for="pref_terms"> I have read and agree to
                                                the
                                                <a href="{{ route('pages.terms-conditions') }}#mobile-sim"
                                                    target="_blank" class="custom_links_design">Terms.</a>
                                            </label>

                                        </div>
                                        @error('terms')
                                            <div class="text-danger text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn-common ml-0">
                                        Place Order
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--middle content end here-->
        </div>

        {{-- popup --}}

        <div class="modal fade upload-modal" id="new-ban" style="backdrop-filter: brightness(0.5);" tabindex="-1"
            role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
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

            $(document).click(function() {
                $()
            })
        </script>
    @endpush
