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
    </style>
@endsection
@section('content')
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
                    method of contact, but you need to <a class="c-red" href="{{ url('advertiser-login')}}">log on</a> )
                    otherwise contact us <a class="c-red" href="#" onClick="openSolution();">here</a>.
                </li>
                <li>A Viewer with a question, first look at our help for <a class="c-red" href="{{url('help-for-viewers')}}">Viewers</a> and if
                    you don't find the
                    answer, then contact us by logging a "Support Ticket" (see below), if you are a
                    registered Viewer, (the preferred method of contact, but you need to <a class="c-red" href="viewer-login">log
                        on</a>) otherwise
                    contact us <a class="c-red" href="#" onClick="openSolution();">here</a>.
                </li>
                <li>A law enforcement agency, Court or an attorney, go to our <a class="c-red" href="{{'law-enforcement'}}">Law Enforcement
                        Policy</a> for
                    information regarding legal process.
                </li>
            </ul>

            <p>For anything else, contact us <a class="c-red" href="#" onClick="openSolution();">here</a>, or by any of
                the alternative means below. Whichever
                method of communication you use we will get back to you within the next few days. </p>

            <form id="contect" style="display: none">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">First Name</label>
                        <input type="text" class="form-control border_for_form" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Last Name</label>
                        <input type="text" class="form-control border_for_form" placeholder="Last name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Email</label>
                    <input type="email" class="form-control border_for_form" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comment</label>
                    <textarea class="form-control border_for_form" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                </div>
                <button type="submit" id="" class="btn btn-primary mb-3">Send message</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </section>
@endsection
@push('scripts')
    <script>
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
            $("#contect").show();
        }

    </script>
@endpush
