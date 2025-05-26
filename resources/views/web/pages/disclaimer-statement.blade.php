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
    </style>
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="home_heading_first">Disclaimer Statement</h1>
            <h2 class="primery_color normal_heading">Content warning</h2>
            <p><span class="termsandconditions_text_color"><b>WARNING:</b></span> This Website contains nudity and other
                sexually orientated content. It is
                intended for adults only and must not be accessed by anyone under the age of 18 (or the
                age of consent in the jurisdiction from which the Website is being accessed).</p>

            <h2 class="primery_color normal_heading">Entry to this Website</h2>
            <p class="text_decoration_for_a">Blackbox Tech Pty Ltd (<b>Blackbox</b> or <b>Escorts4U</b>) ACN: 664 919
                975 provides the Services
                on its Website through which Users can advertise, search and engage the services of
                Advertisers.
            </p>
            <p>Subject to the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and
                    Conditions</a>, by using the Services, you accept the following
                conditions:</p>


            <ul>
                <li><p class="mb-0">Disclaimer</p></li>
                <p>Escorts4U provides this Website on which Advertisers may publish material and
                    information. Escorts4U does not assume a duty of care to Users and make no
                    warranty, guarantee or representation about the accuracy, reliability or timeliness or
                    otherwise of the information or content contained on the Website or liked sites on the
                    Internet.</p>
                <p>
                    To the full extent permitted by law, Escorts4U disclaims all and any guarantees,
                    undertakings and warranties, expressed or implied, regarding any use of, or reliance
                    on, the information and content on, or accessed through, or services engaged in
                    through use of, the Website.
                </p>
                <p>
                    The User must accept sole responsibility associated with the use of the material on the
                    Website and any actions taken as a result of the information and material on the
                    Websites.
                </p>


                <li><p class="mb-0">Liability</p></li>
                <p>
                    Blackbox accepts no responsibility for the completeness or accuracy of any of the
                    information contained on or accessed through the Websites and makes no
                    representations about its suitability for any particular purpose. Escorts4U had not
                    taken into account User’s personal objectives, financial situation or needs.
                </p>
                <p>
                    The User must accept sole responsibility associated with the use of the contents and
                    material on the Website and any actions taken as a result of the information and
                    material on the Websites.
                </p>
                <p>Escorts4U is not liable under any circumstances for any loss or damage whatsoever or
                    howsoever caused (including human or computer error, negligent or otherwise, or
                    incidental or consequential loss or damage) arising directly or indirectly in connection
                    with use of this Website, except to the extent that such liability may not lawfully be
                    limited or excluded. For the avoidance of doubt, this extends to any employees,
                    contractors, agents, representatives, licensees or permitted assigns of Escorts4U.
                    Advertisers are users of the Website and not employees, contractors, agents,
                    representatives, licensees or permitted assigns of Escorts4U.</p>
                <p>Where Escorts4U cannot by law exclude such liability, its liability to the User will be
                    limited to, if the breach relates to the Services, the supply of those Services or the
                    payment of the cost of those Services supplied again. This clause applies despite
                    anything else contained in or incidental to the Terms and Conditions and to the fullest
                    extent permitted by law.</p>
                <p>The Advertisers services as advertised on the Websites are the Advertisers own
                    services and are not provided by Blackbox.</p>


                <li><p class="mb-0">Representations</p></li>
                <p>Any information or materials which are offensive, pornographic, unsuitable for minors
                    or otherwise of a criminal or violent nature may be accessible through any Websites
                    either as a result of hacking or material placed on linked websites. Escorts4U makes
                    no representations as to the suitability of the information accessible through the
                    Websites for viewing by minors or any other person.</p>


                <li><p class="mb-0">Risk</p></li>
                <p>To the maximum extent permitted by law you assume all risks associated with the use
                    of any Websites including, without limitation the risk:

                    <ul style="list-style: disc;">
                        <li>
                            <p class="mb-0">of your computer, software or data being damaged by any virus which might be
                        transmitted or activated via any Websites or your access to it; or</p></li>
                        <li><p class="mb-0">that the content of any Websites and linked websites complies with the laws of any
                                country outside Australia.</p></li>
                    </ul>
                </p>

           {{-- <li><p class="mb-0">Data Collection</p></li>
            <p>Your use of any Websites may be logged for the purpose of Geolocation, security,
                usage, monitoring and compliance with the <a href="{{ url('law-enforcement')}}"
                                                             class="termsandconditions_text_color">Local Laws</a> (as
                they may apply).</p>
            <li><p class="mb-0">Usage</p></li>
            <p>Unauthorised use of any Websites could result in a criminal prosecution.</p>
            <li><p class="mb-0">Jurisdiction</p></li>
            <p>Irrespective of whether the Websites are hosted on web servers in Australia or outside
                Australia. These <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and
                    Conditions</a> are governed by the laws in force in the State
                of Western Australia and the Commonwealth of Australia. Any dispute about these
                Terms and Conditions or the content of any Websites are subject to the exclusive
                jurisdiction of the courts of the State of Western Australia. By your accessing the
                Websites you agree to submit to those Courts.
            </p>--}}

            </ul>
        <!-- <h2 class="primery_color normal_heading">Changes to this Policy</h2>
       <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
          revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
          review the most current version.
       </p>
       <p>Escorts4U archives all previous versions of this Policy.</p>
       <p><b>This policy was last updated 01-12-18</b></p> -->

            <div class="container mt-4 px-0 chagneto-policy">
            <hr class="custom_hr">
                <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                <p>We may change or modify this Policy in the future. We will note the date that revisions were last
                    made at the bottom of this page. Any revision will take effect upon its posting. It is your
                    responsibility to check the <a href="{{ url('terms-conditions')}}"
                                                   class="termsandconditions_text_color">Terms and Conditions</a> and
                    this Policy from time to time to
                    review the most current version.</p>
                <p>Escorts4U archives all previous versions of this Policy.</p>
                <p><b>This policy was last updated 23-05-2025</b></p>
            </div>

        </div>
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

@endpush
