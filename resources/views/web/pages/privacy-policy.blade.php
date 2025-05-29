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

        .content p {
            padding-bottom: 10px;
        }
    </style>
@endsection
@section('content')

    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="home_heading_first">Privacy Policy</h1>


            <div class="accordion-container">

                <div class="set">
                    <a>
                        Overview
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p></p>
                            <h2 class="primery_color normal_heading">Introduction</h2>
                            <p>Escorts4U is committed to protecting the privacy and confidentiality of personal
                                information (<b>Personal Information</b>) of Users. Escorts4U maintains robust physical,
                                electronic and procedural processes and safeguards to protect the Personal Information
                                in
                                our care.
                                {{--                     including personal information that an Agent may have access to.--}}
                            </p>
                            <p>Escorts4U is bound by the Australian Privacy Principles (<b>APP</b>) in the Privacy Act
                                1988 (Cth) (<b>Act</b>), as well as
                                other applicable laws.
                                {{--regulations and codes which apply to the nature of the services provided to
                           you by Escorts4U. By using the Website, you are consenting to Escorts4U collecting,
                           using and disclosing the Personal Information, including geolocation information, to lawful
                           entities and for lawful purposes. The Personal Information is collected from you for the
                         purposes of:--}}
                            </p>

                            <p>
                                When you enquire about E4U’s services, or become a User of the Websites, a record is
                                made that includes your Personal Information. By using the Website, you consent to
                                Escorts4U collecting and using your Personal Information in order to provide the
                                Services.
                                By using this Website you consent to Escorts4U disclosing your Personal Information in
                                accordance with the Australian Privacy Principles and its Policies.
                            </p>

                            <p>Escorts4U collects Personal Information that is considered reasonably necessary for
                                Escorts4U to carry out its business, manage our User’s needs, and provide its Services.
                                We may also collect information to fulfil administrative functions associated with these
                                services, for example billing, entering into contracts with you and/or third parties and
                                managing client relationships.
                            </p>

                            <p>
                                The Personal Information is collected, held, used and disclosed for various purposes,
                                depending on the nature of your transaction with Escorts4U, but may include:
                            </p>
                            <ul>
                                <li>Providing you with the Escorts4U services <b>(Services)</b></li>
                                <li>Identifying you, including your Home State; and</li>
                                <li>Managing and administering the Services</li>
                                <li>Developing and expanding the Services</li>
                                <li>Monitoring and compliance with the Local Laws</li>
                                <li>Responding to enquiries and complaints; and</li>
                                <li>Protecting against fraud (or suspected fraud)</li>
                            </ul>

                            <p>
                                The type of Personal Information that we collect and hold will typically include:
                            </p>
                            <ul>
                                <li>Your name (if provided)</li>
                                <li>Your contact details, e.g. email address and Home State location</li>
                                <li>Financial information (where you post a Profile)</li>
                                <li>Computer sign in data, statistics on page views, traffic to and from the Website
                                </li>
                                <li>Other information including your IP address (geo-location) and standard web log
                                    information
                                </li>
                                <li>Any additional Personal Information you provide to us, or authorise us to collect as
                                    part of your interaction with Escorts4U
                                </li>
                            </ul>

                            <p>
                                Where possible, Escorts4U will collect the Personal Information directly from you. We
                                may
                                collect and update your Personal Information over the phone, by email, over the internet
                                or
                                social media, or in person.
                            </p>
                            <p>
                                In some circumstances, Escorts4U may need to collect the Personal Information from a
                                third party. For example, Escorts4U may collect, from the provider of a payments
                                platform
                                where your transactions are stored (Payments System), information about the
                                transactions you undertake with us. Escorts4U may also collect information from other
                                participants in the Payments System and other financial institutions in order to resolve
                                disputes or errors which are brought to our attention. If you do not provide some or all
                                of
                                the Personal Information requested, Escorts4U may not be unable to provide you with the
                                Services.
                            </p>

                            <h2 class="primery_color normal_heading">Anonymity</h2>
                            <p>You may visit and use our Websites without identifying yourself. You have the ability to
                                remain anonymous or use a pseudonym in your dealings with us.</p>
                            <p>If you identify yourself (for example, by providing your contact details), any Personal
                                Information you provide to Escorts4U will be managed in accordance with this Privacy
                                Policy, and Escort4U’s other Policies and <a class="c-red" href="{{ url('terms-conditions')}}">Terms and Conditions</a>.</p>

                            <h2 class="primery_color normal_heading">Non-provision of information</h2>
                            <p>You can always decline to give Escorts4U any Personal Information we request, but that
                                may mean we cannot provide you with some or all of the Services you have requested. If
                                you have any concerns about Personal Information we have requested, please let us
                                know.</p>

                            <h2 class="primery_color normal_heading">Right to access, correct and delete Personal Information</h2>
                            <p>You may request that your Personal Information held by Escorts4U be deleted at any time,
                                and provided that the information is not required by Escorts4U or the Payments System for
                                completing a financial transaction or is not lawfully required pursuant to any Local Laws,
                                the information will be deleted promptly.</p>
                            <p>You are entitled to access your Personal Information held by Escort4U on request. To
                                request access to your Personal Information please contact us using the contact details
                                set out below. The Personal Information saved by Escorts4U will be provided on request
                                at no cost.</p>
                            <p>If you consider any Personal Information we hold about you is inaccurate, out-of-date,
                                incomplete, irrelevant or misleading you are entitled to request correction of the
                                information. After receiving a request from you, we will take reasonable steps to correct
                                your information.</p>
                            <p>Escorts4U may decline your request to access or correct your Personal Information in
                                certain circumstances in accordance with the APPs. If Escorts4U refuses your request,
                                we will provide you with a reason for our decision and, in the case of a request for
                                correction, we will include a statement with your Personal Information about the requested
                                correction.</p>

                            <h2 class="primery_color normal_heading">Complaints process</h2>
                            <p>You may make a complaint about privacy to Escorts4U at the contact details set out
                                below.</p>
                            <p>Escorts4U will first consider your complaint to determine whether there are simple or
                                immediate steps which can be taken to resolve the complaint. We will generally respond to
                                your complaint within seven (7) days.</p>
                            <p>If your complaint requires more detailed consideration or investigation, we will
                                acknowledge receipt of your complaint within three (3) days and endeavour to complete
                                our investigation into your complaint promptly. We may ask you to provide further
                                information about your complaint and the outcome you are seeking. We will then typically
                                gather relevant facts, locate and review relevant documents and speak with individuals
                                involved.</p>
                            <p>In most cases, we will investigate and respond to a complaint within [30 days] of receipt of
                                the complaint. If the matter is more complex or our investigation may take longer, we will
                                let you know.</p>
                            <p>If you are not satisfied with our response to your complaint, or you consider that Escorts4U
                                may have breached the APPs or the Privacy Act, a complaint may be made to the Office
                                of the Australian Information Commissioner (OAIC). The OAIC can be contacted by
                                telephone on 1300 363 992 or by using the contact details on the OAIC website.</p>

                            <h2 class="primery_color normal_heading">Responsible authority</h2>
                            <p class="">Any requests, questions or complaints regarding data privacy and protection should be
                                addressed to the Privacy Officer: <a href="email:privacy@escorts4u.com.au">privacy@escorts4u.com.au</a></p>

 <!-- changes to policy -->
 <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Data collection
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p></p>
                            <h2 class="primery_color normal_heading">Cookies</h2>
                            <p>Escorts4U uses Cookies:</p>
                            <ul>
                                <li>In connection with the Users web browser, to optimise usage of the Website</li>
                                <li>To remember the last activity of the User on the Website</li>
                                <li>To maintain a realtime experience</li>
                            </ul>
                            <p>The use of the Cookies is applied in terms of saving the User's details (username,
                                password and geolocation as applicable) and any settings the User may have applied.
                                Cookies are used to identify the computer the User has accessed the Website. Through
                                cookies, we collect certain information such as your device type, browser type, IP address,
                                pages you have accessed on our websites and on third-party websites. You are not
                                identifiable from such information. No personal data, except the Users IP address for
                                geolocation purposes, is saved. Escorts4U does not use any technology that may combine
                                information obtained by Cookies with personal User data, so as to detect the identity or
                                email address of the User.</p>
                            <p>
                                Your use of any Websites may be logged for the purpose of Geolocation, security, usage,
                                monitoring and compliance with the <a class="c-red" href="{{ url('faqs')}}">Local Laws</a> (as they may apply).
                            </p>

                            <h2 class="primery_color normal_heading">Collection and processing of personal data</h2>
                            <p>Escorts4U stores information on servers located in Australia. If you choose to provide us
                                with the Personal Information, you are consenting to the transfer and storage of that
                                information to and on our servers in Australia.
                            </p>
                            <p>Escorts4U takes reasonable steps to protect your Personal Information from misuse,
                                interference and loss and from unauthorised access, modification or disclosure.</p>
                            <p>Please note, data transmission over the Internet, such as the communication via e-mail
                                between Advertisers and Escorts4U, can lead to security issues. Escorts4U can not
                                guarantee complete protection of data against access by third parties where information is
                                transmitted via the internet.</p>
                            <p>Escorts4U may use or disclose your Personal Information for the purpose of informing you
                                about our Services, upcoming promotions and events, or other opportunities that may
                                interest you, in line with our <a class="c-red" href="{{ url('spam-policy')}}">Spam Policy</a>.</p>

                            <h2 class="primery_color normal_heading">Provision of personal data to other parties</h2>
                            <p>Transfer or provision of personal data to a third party only occurs if Escorts4U:</p>
                            <ul>
                                <li>Is lawfully obligated to provide information to the requesting authority, for example
                                    inline with our <a class="c-red" href="{{ url('law-enforcement')}}">Law Enforcement Policy</a>
                                </li>
                                <li>Is given prior consent from the Advertiser to the release personal data, which consent
                                    must be provided in writing to Escorts4U before any release of the said personal data
                                </li>
                                <li>Must provide it to participants in the Payments System and other financial institutions
                                    for the purpose of resolving disputes, errors or other matters arising out of your use of
                                    your credit or debit card (<b>Card</b>) or third parties using the Card or information stored on or about the Card
                                </li>
                                <li>
                                    Is required by any third party service provider engaged by Escorts4U for the purpose
                                    of enabling Escorts4U to deliver the Services
                                </li>
                            </ul>

                            <p>Third parties to whom we have disclosed your Personal Information may contact you
                                directly to let you know they have collected your Personal Information and to give you
                                information about their privacy policies.</p>
                            <p>Unless we have your consent, or an exception under the APPs applies, we will only
                                disclose your Personal Information to overseas recipients where we have taken
                                reasonable steps to ensure that the overseas recipient does not breach the APPs in
                                relation to your Personal Information.</p>
                            <p>To facilitate transaction investigation and to assist with the identification of suspicious or
                                fraudulent transactions, the Personal Information and transaction details may be sent to
                                countries other than Australia which participate in the Payments System. By using the
                                Services, you agree that the Personal Information and transaction details may be sent
                                overseas. In that regard, Escorts4U is likely to disclose Personal Information to overseas
                                recipients. Those overseas recipients are likely to be located in Europe or the United
                                States of America.</p>
                            <p>Otherwise, personal data will not be released, shared or sold to third parties for marketing
                                or advertising purposes without the prior permission from the Advertiser or Viewer.</p>
                                 <!-- changes to policy -->
                  <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Marketing & Social Media
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p></p>
                            <h2 class="primery_color normal_heading">The Use of Social Plugins and AdSense</h2>
                            <p>The Website does not use any form of plugin which are commonly deployed by the social
                                networks known as facebook.com, operated by Facebook Inc., 1601 S. California Avenue,
                                Palo Alto, CA 94304, USA (<b>Facebook</b>), Twitter Inc., 795 Folsom St., Suite 600, San
                                Francisco, CA 94107, USA (<b>Twitter</b>), or Google AdSense, 1600 Amphitheatre Parkway,
                                Mountain View, CA 94043, USA (<b>Google</b>).</p>
                            <p>When you visit a page on the Website, your browser will not be able to establish a direct
                                connection to the Facebook, Twitter or Google servers, thus enabling Facebook, Twitter
                                or
                                Google to receive information about you having accessed any of the pages of the Website
                                with your IP address. Whilst Escorts4U attempts to maintain the Users anonymity, it is
                                not
                                guaranteed.</p>
                            <p>As a precaution, if you are a Facebook or Twitter member and do not want Facebook or
                                Twitter to connect the data concerning your visit to the Website with your Facebook or
                                Twitter member data, you should log off from Facebook or Twitter before entering the
                                Website.</p>
                            <h2 class="primery_color normal_heading">Google Analytics</h2>
                            <p>The Website uses Google Analytics, a web analytics service provided by Google, Inc.
                                (<b>Google Analytics</b>). Google Analytics uses Cookies to help analyze the usage of
                                the
                                Website. The information generated by the Cookie about your use of the Website will be
                                transmitted to and stored by Google Analytics on servers in the United States in most
                                cases. Google will use this information on behalf of Escorts4U for the purpose of
                                evaluating the Advertiser's use of the Website, compiling reports on Website activity
                                for
                                Escorts4U and as well as providing other services relating to Website activity and
                                internet
                                usage. The IP address, that your browser conveys within the scope of Google Analytics,
                                will not be associated with any other data held by Google Analytics.</p>
                            <p>You may refuse the use of Cookies by selecting the
                                appropriate settings on your browser,
                                however, please note that if you do this you may not be able to use the full
                                functionality of
                                this Website. You can also opt-out from being tracked by Google Analytics with effect
                                for
                                the future by downloading and installing Google Analytics Opt-out Browser Add-on for
                                your
                                current web browser: <a href="#">http://tools.google.com/dlpage/gaoptout?hl=en</a></p>

                            <h2 class="primery_color normal_heading">Google +1</h2>
                            <p>With the Google +1 interface (<b>Google +1</b>), you can publish information worldwide.
                                This
                                Website does not support Google +1, unless you have created a world-wide public Google
                                profile, which must contain at least the chosen name for the Google +1 profile (<b>Google
                                    Profile</b>). Your Google Profile is used in all Google services. In some instances,
                                your
                                Google Profile can also be substituted for a different name that you used when sharing
                                content with your Google account. The identity of your Google Profile may be shown to
                                users who know your e-mail address, or have any other identifying information from you.
                                Further to the preceding, the information you provide will be used in accordance with
                                the
                                applicable Google privacy policies. Google may release aggregated statistics about Users
                                Google +1 activities or provide those findings to Google partners (Escorts4U utilises
                                the
                                services of digital media providers), such as publishers, advertisers or connected
                                sites.</p>

                            <h2 class="primery_color normal_heading">Third party/External websites</h2>
                            <p>It is your responsibility to make yourself aware that other websites and other internet
                                users
                                may collect information, such as your e-mail address, that is published on the Website.
                                This is due to the natural interconnectedness of the internet. Our data protection
                                policies
                                only apply to this Website and do not apply to external websites nor do they apply to
                                the
                                external activities of Users and the consequences arising from their internet
                                activities. Escorts4U is not responsible for the content or privacy practices of websites that are linked
                                to our Website.</p>
                            <p>Escorts4U offers Users the possibility to interact with each other and to post a Profile
                                under a cipher as an added security measure. This considerably hinders third parties from
                                collecting Users personal data. Escorts4U also uses JavaScript to encode your email
                                address (where submitted as a contact email pursuant to any registration on the Website)
                                to prevent the scanning of the Users email address through external software. However,
                                email addresses that are published openly in a Profile are not covered by this security
                                feature.</p>

 <!-- changes to policy -->
 <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
                        </div>
                    </div>
                </div>
                <div class="set">
                    <a class="">
                        Changes to this Policy
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content" style="display: none;">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p>
                                            We may change or modify this Policy in the future. We will note the date
                                            that revisions were last made at the bottom of this page. Any
                                            revision will take effect upon its posting. It is your responsibility to
                                            check the <a href="{{ url('terms-conditions')}}"><span
                                                    style="color:#FF3C5F">Terms and Conditions</span> </a> and this
                                            Policy from time to time to
                                            review the most current version.

                                        </p>
                                        <p>
                                            Escorts4U archives all previous versions of this Policy.
                                        </p>
                                        <p><b>This policy was last updated 24-01-2024</b></p>
                                         <!-- changes to policy -->
                  <div class="container mt-4 px-0 chagneto-policy">
                     <hr class="custom_hr">
                     <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                     <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
                     <p>Escorts4U archives all previous versions of this Policy.</p>
                     <p><b>This policy was last updated 28-05-2025</b></p>
                  </div>
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
