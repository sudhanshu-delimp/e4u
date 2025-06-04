@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        #contect .form-group label {
        font-size:16px;
        line-height:unset;
        padding-bottom:0px;
        text-transform:capitalize;
    }
    .btn-primary {
      background-color: #0C223D;
      border-color: #0C223D;
    }
    .btn-primary:hover {
      background-color: #0C223D;
      border-color: #0C223D;
    }
    .input-error {
    color: #e5365a;
    font-size: small;
}
.parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0);
    padding: 0;
    }
    .parsley-errors-list li{
    font-size: 14px;
    line-height: 18px;
    margin-top: 6px;
    }
    input.parsley-error {
        border: 1px solid !important;
    border-radius: 0.25rem;
    }
    </style>
@endsection
@section('content')

@php
$errorSuccess = 0;
$contactMsg = "";
if (session('error')) {
    $errorSuccess = 2;
    $contactMsg = session('error');
} else if (session('success')) {
    $errorSuccess = 2;
    $contactMsg = session('success');
}

@endphp

@if(session('success'))
   
@endif
    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">

        <div class="container">
            <h1 class="home_heading_first margin_btm_twenty_px">Contact Us</h1>

            <h2 class="primery_color normal_heading">Some general information</h2>
            <p>Our offices are attended between 8:00 am and 6:00 pm WST (Australia). If you are:</p>
            <ul>
                <li>Looking to make an appointment with an Advertiser, we are not an agency and do not
                    arrange bookings. Please contact <a class="c-red" href="{{ url('help-for-advertisers')}}">Advertisers</a> directly
                </li>
                <li>An Advertiser with a question, first look at our help for <a class="c-red"
                                                                                 href="{{ url('help-for-advertisers')}}">Advertisers</a>,
                    or <a class="c-red" href="{{ url('faqs')}}">FAQs</a> and if you
                    don't find the answer, then contact us by logging a "Support Ticket" (the preferred
                    method of contact @if(!auth()->user()), but you need to <a class="c-red" href="{{ url('advertiser-login')}}">log on</a> @endif)
                    otherwise contact us <a class="c-red" href="javascript:void(0)" onClick="openSolution();">here</a>.
                </li>
                <li>A Viewer with a question, first look at our help for <a class="c-red" href="{{url('help-for-viewers')}}">Viewers</a> and if
                    you don't find the
                    answer, then contact us by logging a "Support Ticket" (see below), if you are a
                    registered Viewer, (the preferred method of contact @if(!auth()->user()), but you need to <a class="c-red" href="viewer-login">log
                        on</a> @endif) otherwise
                    contact us <a class="c-red" href="javascript:void(0)" onClick="openSolution();" id="scrollForm">here</a>.
                </li>
                <li>A law enforcement agency, Court or an attorney, go to our <a class="c-red" href="{{'law-enforcement'}}">Law Enforcement
                        Policy</a> for
                    information regarding legal process.
                </li>
            </ul>

            <p>For anything else, contact us <a class="c-red" href="javascript:void(0)" onClick="openSolution();">here</a>, or by any of
                the alternative means below. Whichever
                method of communication you use we will get back to you within the next few days. </p>

            <form id="contactus" name="contactus" style="display: @if ($errors->any()) block; @else none; @endif" action="{{ route('contactus.send')}}" method="post">
                 @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control border_for_form" placeholder="First name" required>
                        @error('first_name')
                            <div class="input-error-box input-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                        <input type="text"  name="last_name" id="last_name"  value="{{ old('last_name') }}" class="form-control border_for_form" placeholder="Last name" required>
                         @error('last_name')
                            <div class="input-error-box input-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control border_for_form"  placeholder="Email" required>
                     @error('email')
                            <div class="input-error-box input-error">{{ $message }}</div>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="message">Comment</label>
                    <textarea name="message" id="message" class="form-control border_for_form" rows="3" placeholder="Message" required>{{ old('message') }}</textarea>
                     @error('message')
                            <div class="input-error-box input-error">{{ $message }}</div>
                        @enderror
                </div>
                <button type="submit" id="btn-submit" class="btn btn-primary mb-3">Send Message</button>
            </form>


            <div class="accordion-container">
                <!-- <div class="set">
                   <a>
                   Introduction

                   <i class="fa fa-angle-down"></i>
                   </a>
                   <div class="content">
                      <div class="accodien_manage_padding_content">
                         <h3>Some general information</h3>
                         <p>Our offices are attended between 8:00 am and 6:00 pm WST (Australia). If you are</p>
                         <ul>
                            <li>Looking to make an appointment with an Advertiser, we are not an agency and do not
                            arrange bookings. Please contact <a class="c-red" href="#">Advertisers</a> directly</li>
                            <li>An Advertiser with a question, first look at our help for <a class="c-red" href="#">Advertisers</a>, or <a class="c-red" href="#">FAQs</a> and if you
                            don't find the answer, then contact us by logging a "Support Ticket" (the preferred
                            method of contact, but you need to <a class="c-red" href="#">log on</a> ) otherwise contact us <a class="c-red" href="#">here</a>.
                            </li>
                            <li>A Viewer with a question, first look at our help for <a class="c-red" href="#">Viewers</a> and if you don't find the
                            answer, then contact us by logging a "Support Ticket" (see below), if you are a
                            registered Viewer, (the preferred method of contact, but you need to <a class="c-red" href="#">log on</a>) otherwise
                            contact us <a class="c-red" href="#">here</a>.
                            </li>
                            <li>A law enforcement agency, Court or an attorney, go to our <a class="c-red" href="#">Law Enforcement Policy</a> for
                            information regarding legal process</li>
                            <p>For anything else, contact us here, or by any of the alternative means below. Whichever
                            method of communication you use we will get back to you within the next few days. </p>
                         </ul>

                         <form>
                            <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">First Name</label>
          <input type="text" class="form-control" placeholder="First name">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Last Name</label>
           <input type="text" class="form-control" placeholder="Last name">
        </div>
      </div>
       <div class="form-group">
        <label for="inputAddress">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Comment</label>
        <textarea class="form-control border_for_form" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      <button type="submit" id="" class="btn site_btn_primary">Send message</button>
                         </form>

                      </div>
                   </div>
                </div> -->
                <div class="set">
                    <a>
                        After hours contact
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>We offer an after hours contact by email. Any assistance requested via our after hours
                                email will be attended to as soon as possible</p>
                                <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="https://e4udev2.perth-cake1.powerwebhosting.com.au/terms-conditions" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Our business details
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>You can contact us through either of the following methods:</p>
                            <p>Blackbox Tech<br>
                                GPO Box T1756<br>
                                Perth WA 6845</p>
                            <p>T: +61 418 812 228</p>
                            <p><a href="mailto:info@escorts4u.com.au">info@escorts4u.com.au</a></p>
                            <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="https://e4udev2.perth-cake1.powerwebhosting.com.au/terms-conditions" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a>
                        Support tickets
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p>For the best method of communication, Users should log a "Support Ticket" with us. A
                                Support Ticket is:
                            </p>
                            <ul>
                                <li>Secure</li>
                                <li>Pre-populated with your details</li>
                                <li>Offers "Title" drop down list</li>
                                <li>Foot-printed
                                </li>
                            </ul>
                            <p>You will need to <a class="c-red" href="{{route('viewer.login')}}">log on</a> as a User to log a Support Ticket.
                                If you haven't registered as a
                                Viewer, and would like to log a Support Ticket, register <a class="c-red"
                                                                                            href="{{url('/register')}}">here</a></p>
                                                                                            <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="https://e4udev2.perth-cake1.powerwebhosting.com.au/terms-conditions" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content custome_modal_max_width">
                    <div class="modal-header main_bg_color border-0">
                        <h5 class="modal-title" id="exampleModalLabel" style="color:white">Contact Us</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                        </span>
                        </button>
                    </div>
                    <div class="modal-body bodytext">{{$contactMsg}}</div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        
    $(document).ready(function () {
        var $msgStatus = {{$errorSuccess}}
        $msgStatus = parseInt($msgStatus)
        $('#contactus').parsley({});
        $('#contactus').parsley().on('form:validate', function (formInstance) {
            if (formInstance.isValid()) {
                // Form is valid, submit natively
                return true; // allow normal form submission
            } else {
                // Form is invalid, prevent submission
                return false;
            }
        });
        if($msgStatus > 0) {
            $('#messageModal').modal('show');
        }
    });
        var skipSliderage = document.getElementById("skipstepage");
        var skipValuesage = [
            document.getElementById("skip-value-lower-age"),
            document.getElementById("skip-value-upper-age")
        ];

        noUiSlider.create(skipSliderage, {
            start: [0, 30],
            connect: true,
            behaviour: "drag",
            step: 1,
            range: {
                min: 18,
                max: 60
            },
            format: {
                from: function (value) {
                    return parseInt(value);
                },
                to: function (value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function (values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });

    </script>
    <script>
        function openSolution() {
            $("#contactus").show();
            $('html, body').animate({
        scrollTop: $('#scrollForm').offset().top
    }, 200); // 800ms animation
        }

    </script>
@endpush
