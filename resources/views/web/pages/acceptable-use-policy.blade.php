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
            <h1 class="home_heading_first margin_btm_twenty_px">Acceptable Usage Policy</h1>
            <div class="accordion-container">
                <div class="set">
                    <a>
                        Overview
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            These acceptable usage policy guidelines <strong>(Guidelines)</strong> describe the
                                            proper kinds of conduct and prohibited uses of Escorts4U services <strong>(Services)</strong>.
                                            These Guidelines are not
                                            exhaustive and Escorts4U reserves the right to modify them at any time,
                                            effective upon posting of the modified Guidelines to the Escorts4U website
                                            at: <a href="https://www.e4u.com.au/">www.e4u.com.au</a>
                                            <strong>(Website)</strong>.
                                        </p>
                                        <p>
                                            By registering for and using the Services, and thereby accepting the Terms
                                            and Conditions, you also agree to abide by the Guidelines as modified from
                                            time to time. Any
                                            violation of the Guidelines may result in the termination or suspension of
                                            your Account in
                                            the manner described in the Escorts4U Terms and Conditions
                                            <strong>(Terms)</strong>. These Guidelines
                                            are to be read in conjunction with the <a
                                                href="{{ url('terms-conditions')}}">Terms</a>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guidelines -->
                <div class="set">
                    <a>
                        Guidelines
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ol>
                                            <li>
                                                <h5 class="policy_sub_headings"><u>Your general responsibilities</u>
                                                </h5>
                                                <p class="padding_left_five_px">The Services enable you to advertise
                                                    escort and massage centre services, in the form of a Profile and to
                                                    undertake a search for information. Generally, Escorts4U will not
                                                    actively monitor, censor, or directly control any use that is made
                                                    of the Website.</p>
                                                <p class="padding_left_five_px">Escorts4U expects you to use the
                                                    Services with respect toward others and in a responsible manner.</p>
                                                <p class="padding_left_five_px">You remain solely liable and responsible
                                                    for:</p>
                                                <ul>
                                                    <li>
                                                        <p class="mb-0">your use of the Services (see also <a href="{{ url('covid-19-statement')}}">Covid-19
                                                                Statement</a>)</p>
                                                    </li>
                                                    <li>
                                                        <p class="mb-0">any and all content that you display, upload,
                                                            download or transmit through the use of the Services (see
                                                            also <a href="{{ url('terms-conditions')}}">Terms</a>)</p>
                                                    </li>
                                                    <li>
                                                        <p class="mb-0">all dealings you have with other Users of the
                                                            Services</p>
                                                    </li>
                                                </ul>
                                                <p class="padding_left_five_px">Indirect or attempted breaches of the
                                                    Guidelines, and actual or attempted breaches by a third party on
                                                    your behalf, including by any appointed Agent, are deemed to be a
                                                    breach of the Guidelines by you and may result in the immediate
                                                    termination of the Services.</p>
                                            </li>
                                            <li>
                                                <h5 class="policy_sub_headings"><u>Illegal or harmful use</u></h5>
                                                <p class="padding_left_five_px">You may use the Services for lawful
                                                    purposes only. The transmission, distribution, sale, or storage of
                                                    any material in violation of any Local Law, Classification Laws,
                                                    regulation, the <a href="{{ url('terms-conditions')}}">Terms</a>, or
                                                    the Guidelines is strictly prohibited.</p>
                                                <p class="padding_left_five_px">Escorts4U reserves the right, at its
                                                    sole discretion, to restrict or prohibit any and all Uses of the
                                                    Services or content in a Profile and to remove any materials from
                                                    its servers it considers appropriate for removal at its sole
                                                    discretion where it is considered to be harmful to its servers,
                                                    systems, network, reputation, good will, other Users, or any third
                                                    party. Examples of such material include, without limitation, any
                                                    material that falls within the following circumstances:</p>

                                                <ul class="list_style_disc">
                                                    <li>
                                                        <h5 class="policy_sub_headings">Infringement</h5>
                                                        <p>Material which infringes another persons intellectual
                                                            property rights or other proprietary rights including,
                                                            without limitation, material protected by copyright,
                                                            trademark, patent, trade secret and confidential
                                                            information. Infringement may result from, among other
                                                            activities, the unauthorised copying and posting of
                                                            pictures, logos, software, articles, musical works and
                                                            videos.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <h5 class="policy_sub_headings">Offensive Materials</h5>
                                                        <p>Material which constitutes the transmission, dissemination,
                                                            sale, storage or hosting of any material that is unlawful,
                                                            defamatory, harassing, threatening, harmful, invasive of
                                                            privacy rights, abusive, inflammatory or otherwise
                                                            objectionable.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <h5 class="policy_sub_headings">Harmful Content</h5>
                                                        <p>Material which constitutes the dissemination or hosting of
                                                            harmful content including, without limitation, viruses,
                                                            Trojan horses, worms, time bombs, cancel-bots or any other
                                                            computer programming routines that may damage, interfere
                                                            with, surreptitiously intercept or expropriate any system,
                                                            program, data or personal information.
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <h5 class="policy_sub_headings">Fraudulent Conduct</h5>
                                                        <p>Material which offers or disseminates fraudulent goods,
                                                            services, schemes, or promotions (for example and without
                                                            limitation, make money fast schemes, chain letters, pyramid
                                                            schemes), or the furnishing of false data on any sign-up
                                                            forms, contracts or online applications or registrations, or
                                                            the fraudulent use of any information obtained through the
                                                            use of the Services, including, without limitation, the use
                                                            of Card numbers.
                                                        </p>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h5 class="policy_sub_headings"><u>System and network security and
                                                        integrity</u></h5>
                                                <ul class="padding_zero_px">
                                                    <li>
                                                        <p class="padding_left_five_px">Breaches of Escorts4U or any
                                                            third party server, system or network security through the
                                                            use of the Website or Services are prohibited, and may
                                                            result in a criminal referral or the commencement of civil
                                                            proceedings. Escorts4U may, at its sole discretion,
                                                            investigate incidents involving such violations which may
                                                            include the co operation with any law enforcement agency if
                                                            a criminal act is suspected. Examples of server, system or
                                                            network security violations include, without limitation, the
                                                            following:
                                                        </p>
                                                        <ul class="list_style_disc">
                                                            <li>
                                                                <h5 class="policy_sub_headings">Hacking</h5>
                                                                <p>Unauthorised access to or use of data, systems,
                                                                    server or networks, including any attempt to probe,
                                                                    scan or test the vulnerability of a system, server
                                                                    or network or to breach security or authentication
                                                                    measures without express authorisation of Escorts4U,
                                                                    the owner of the system, server or network.
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <h5 class="policy_sub_headings">Interception</h5>
                                                                <p>Unauthorised monitoring of data or traffic on any
                                                                    network, server, or system without express written
                                                                    authorisation of Escorts4U, the owner of the system,
                                                                    server, or network.</p>
                                                            </li>
                                                            <li>
                                                                <h5 class="policy_sub_headings">Intentional
                                                                    Interference</h5>
                                                                <p>Interference with the Service by any user, host or
                                                                    network including, without limitation, mail bombing,
                                                                    news bombing, other flooding techniques, deliberate
                                                                    attempts to overload a system, broadcast attacks and
                                                                    any activity resulting in the crash of a host.
                                                                    Intentional interference also includes, without
                                                                    limitation, the use of any kind of
                                                                    program/script/command, or send messages of any
                                                                    kind, designed to interfere with a User terminal
                                                                    session, via any means, locally or by the
                                                                    Internet.</p>
                                                            </li>
                                                            <li>
                                                                <h5 class="policy_sub_headings">Falsification of
                                                                    Origin</h5>
                                                                <p>Forging of any TCP-IP packet header, e-mail header or
                                                                    any part of a message header. This prohibition
                                                                    includes the use of aliases or anonymous
                                                                    re-mailers.</p>
                                                            </li>
                                                            <li>
                                                                <h5 class="policy_sub_headings">Avoiding System
                                                                    Restrictions</h5>
                                                                <p>Using manual or electronic means to avoid any use
                                                                    limitations placed on the Services such as timing
                                                                    out.</p>
                                                            </li>
                                                            <li>
                                                                <h5 class="policy_sub_headings">Failure to Safeguard
                                                                    Accounts</h5>
                                                                <p>Failing to prevent unauthorised access to your
                                                                    Account, including any account password.</p>
                                                            </li>
                                                        </ul>
                                                        <p></p>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <h5 class="policy_sub_headings"><u>E-Mail</u></h5>
                                                <ul class="padding_zero_px">
                                                    <li>
                                                        <p class="padding_left_five_px">You may not distribute, publish,
                                                            or send any of the following types of e-mail to a User, or
                                                            other person connected with, or known through the Services:
                                                        </p>
                                                        <ul class="list_style_disc">
                                                            <li>
                                                                <p>unsolicited promotions, advertising or solicitations
                                                                    (commonly referred to as "spam"), including, without
                                                                    limitation, commercial advertising and informational
                                                                    announcements, except to those who have explicitly
                                                                    requested such e-mails</p>
                                                            </li>
                                                            <li>
                                                                <p>commercial promotions, advertising, solicitations, or
                                                                    informational announcements that contain false or
                                                                    misleading information in any form</p>
                                                            </li>
                                                            <li>
                                                                <p>harassing e-mail, whether through language,
                                                                    frequency, or size of messages</p>
                                                            </li>
                                                            <li>
                                                                <p>Chain letters</p>
                                                            </li>
                                                            <li>
                                                                <p>malicious e-mail, including without limitation "mail
                                                                    bombing" (flooding a user or web site with very
                                                                    large or numerous pieces of e-mail) or "trolling"
                                                                    (posting outrageous messages to generate numerous
                                                                    responses)</p>
                                                            </li>
                                                            <li>
                                                                <p>e-mails containing forged or falsified information in
                                                                    the header (including sender name and routing
                                                                    information), or any other forged or falsified
                                                                    information</p>
                                                            </li>
                                                        </ul>
                                                        <p></p>
                                                        <p class="padding_left_five_px">In addition, you may not use the
                                                            Escorts4U mail server or another website mail server to
                                                            relay mail without the express written permission of the
                                                            account holder of the website. Posting the same or similar
                                                            message to one or more newsgroups (excessive cross-posting
                                                            or multiple-posting) is also explicitly prohibited.</p>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <h5 class="policy_sub_headings"><u>Protection of Minors</u></h5>
                                                <ul class="padding_zero_px">
                                                    <li>
                                                        <p class="padding_left_five_px text_decoration_for_a">Escorts4U
                                                            takes seriously the protection of minors. We are serious in
                                                            applying youth protection law and will exclude any
                                                            Advertiser who violates our <a
                                                                href="{{ url('terms-conditions')}}"><span
                                                                    style="color: #FF3C5F;">Terms</span></a>,
                                                            incorporating this policy, by publishing prohibited content
                                                            or images (see also <a
                                                                href="{{ url('law-enforcement')}}"><span
                                                                    style="color: #FF3C5F;">Law Enforcement &amp; Trafficking Policy</span></a>).
                                                        </p>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li>
                                                <h5 class="policy_sub_headings"><u>Breach of the Guidelines</u></h5>
                                                <ul class="padding_zero_px">
                                                    <li>
                                                        <p class="padding_left_five_px text_decoration_for_a">A breach
                                                            of the Guidelines is strictly prohibited and may result in
                                                            the immediate termination of the Services.</p>
                                                        <p class="padding_left_five_px text_decoration_for_a">
                                                            Unauthorised use of any Websites could result in a criminal
                                                            prosecution.</p>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{  dd(Cookie::get($value)) }} --}}


                <div class="set akh">
                    <a>
                        Changes to this Policy
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            We may change or modify this Policy in the future. We will note the date
                                            that revisions were last made at the bottom of this page. Any revision will
                                            take effect upon its posting. It is your responsibility to check the <a
                                                href="{{ url('terms-conditions')}}">Terms and Conditions</a>and this
                                            Policy from time to time to review the most current version.
                                        </p>
                                        <p>
                                            Escorts4U archives all previous versions of this Policy
                                        </p>
                                        <p><b>This policy was last updated 24-01-2024</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
@push('scripts')
    <script>

        $(document).ready(function () {

            // if($.cookie('user-agreement') != 'true') {
            //     $('.akh').hide();
            //     console.log( $.cookie('user-agreement'));
            // }
        });
    </script>
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
