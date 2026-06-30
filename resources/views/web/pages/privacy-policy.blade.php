@extends('layouts.web')
@section('style')
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
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

        .accordion-container .set ul {
            text-align: justify;
            list-style-type: disc;
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
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">

                                                <div class="content_details">
                                                    <h3>Statement</h3>
                                                    <p>
                                                        Blackbox Tech Pty Ltd trading as Escorts4U (ABN 88 664 919 975) (<b>we</b>,
                                                        <b>us</b> or <b>our</b>) is
                                                        committed to protecting your privacy. This policy explains how we
                                                        collect, use and protect
                                                        your personal information. It applies to all personal information we
                                                        handle, whether we collect
                                                        it through the Website, in person, or through other means.
                                                    </p>
                                                </div>


                                                <div class="content_details">
                                                    <h3>Quick overview</h3>

                                                    <ul class="my-3">
                                                        <li>We collect information you provide to us and information we
                                                            gather when we interact with you</li>
                                                        <li>We use this information to provide our Services and improve your
                                                            experience</li>
                                                        <li>We protect your information using secure systems and processes
                                                        </li>
                                                        <li>You have rights regarding your personal information, including
                                                            access and correction rights</li>
                                                    </ul>
                                                </div>
                                                {{-- 1 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>1.</span> Information we collect
                                                    </h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>We collect a range of information from Users when you visit our
                                                            Website. These include:</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Identity and contact details
                                                                <ul class="my-3">
                                                                    <li>Name, email address and phone number</li>
                                                                    <li>Other details according to your Membership Type,
                                                                        such as your address</li>
                                                                </ul>
                                                            </li>
                                                            <li>Service related information
                                                                <ul class="my-3">
                                                                    <li>Payment and transaction details for Services you've
                                                                        purchased from us or
                                                                        enquiries about our Services</li>
                                                                    <li>Your preferences for our Services and your marketing
                                                                        preferences</li>
                                                                    <li>Feedback and survey responses</li>
                                                                </ul>
                                                            </li>
                                                            <li>Digital information
                                                                <ul class="my-3">
                                                                    <li>IP address and general location information derived
                                                                        from your IP address</li>
                                                                    <li>Search and browsing behaviour</li>
                                                                    <li>Website usage patterns</li>
                                                                    <li>Cookie preferences</li>
                                                                </ul>
                                                            </li>
                                                            <li>Customer Support Recordings
                                                                <ul class="my-3">
                                                                    <li>Call recordings for customer suppor</li>
                                                                    <li>Records of meetings and decisions for customer
                                                                        support</li>
                                                                </ul>
                                                            </li>
                                                            <li>Sensitive Information
                                                                <p>We handle sensitive information with extra care and
                                                                    protection, and we only collect
                                                                    this information with your consent or when legally
                                                                    permitted. In using the Website
                                                                    you may choose to share sensitive information, including
                                                                    your sexual orientation
                                                                    and gender identity, your racial or ethnic origin and
                                                                    photographs and videos
                                                                    uploaded by you as content that forms a part of your
                                                                    Profile/s.</p>
                                                            </li>
                                                            <li>Age and Identity Verification
                                                                <p>Our Website and Platform is strictly for individuals 18
                                                                    years of age or older. If you
                                                                    are under 18 years of age, you are not permitted to use
                                                                    our Services. By using our
                                                                    Services, you represent that you are 18 years of age or
                                                                    older. In some situations,
                                                                    we may ask you to provide details to verify your age.
                                                                </p>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 2 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>2.</span>How we collect personal
                                                        information</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            We collect personal information about you either:

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ul>
                                                            <li>Directly from you when you:
                                                                <ul>
                                                                    <li>interact with us</li>
                                                                    <li>contact us</li>
                                                                    <li>fill out forms</li>
                                                                    <li>disclosure to an Agent; and</li>
                                                                </ul>
                                                            </li>
                                                            <li>Automatically when you:
                                                                <ul>
                                                                    <li>visit the Website</li>
                                                                    <li>use our technologies</li>
                                                                    <li>interact with the Services or social media</li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Data Collection
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">

                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">

                                                {{-- 3 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>3.</span> Why we collect, hold, use
                                                        and disclose personal information
                                                    </h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>We collect and use your personal information to run our business
                                                            and provide our Services as set out below.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Business operations
                                                                <ul class="my-3">
                                                                    <li>To manage our relationship with you as a User of our
                                                                        services or supplier</li>
                                                                    <li>To help Users find each other</li>
                                                                    <li>To process and deliver our Services</li>
                                                                    <li>To handle your inquiries, support requests, and
                                                                        communications</li>
                                                                    <li>To maintain accurate records for billing and
                                                                        administration</li>
                                                                    <li>To verify your identity and age when required or
                                                                        permitted by law</li>
                                                                </ul>
                                                            </li>
                                                            <li>Communication and support
                                                                <ul class="my-3">
                                                                    <li>To respond to your questions and support requests
                                                                    </li>
                                                                    <li>To communicate important updates about our Services
                                                                    </li>
                                                                    <li>To handle inquiries made through the Website, or
                                                                        Platforms, or Agent</li>
                                                                    <li>To manage your participation in surveys, feedback
                                                                        sessions, or events</li>
                                                                    <li>To handle complaints</li>
                                                                </ul>
                                                            </li>
                                                            <li>Service improvement
                                                                <ul class="my-3">
                                                                    <li>To conduct analytics and market research</li>
                                                                    <li>To improve our business operations and Services
                                                                        generally</li>
                                                                    <li>To develop and enhance our Applications and
                                                                        Platforms</li>
                                                                    <li>To understand how our Services are used by you</li>
                                                                </ul>
                                                            </li>
                                                            <li>Marketing and promotions
                                                                <ul class="my-3">
                                                                    <li>To send you promotional information about our
                                                                        Services and events</li>
                                                                    <li>To inform you about our Services that may interest
                                                                        you</li>
                                                                    <li>To manage your marketing preferences</li>
                                                                    <li>To run competitions, promotions, and special offers
                                                                    </li>
                                                                    <li>To provide additional benefits to the Users</li>
                                                                </ul>
                                                                <p>All marketing communications will be sent in line with
                                                                    our <a href ="{{ url('spam-policy') }}">Spam Policy</a>.
                                                                </p>
                                                            </li>
                                                            <li>Legal and compliance
                                                                <ul class="my-3">
                                                                    <li>To respond to court orders or legal processes</li>
                                                                    <li>To maintain required business records</li>
                                                                    <li>To fulfil regulatory requirements or reporting
                                                                        obligations and ensure compliance with applicable
                                                                        laws and regulations</li>
                                                                    <li>To protect our legal rights and interests or as
                                                                        authorised by law</li>
                                                                    <li>To identify and prevent fraudulent or suspicious
                                                                        transactions</li>
                                                                </ul>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Disclosures
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">

                                                {{-- 4 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>4.</span> Our disclosures of
                                                        personal information to third parties
                                                    </h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>We may disclose personal information to:</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Service providers
                                                                <ul class="my-3">
                                                                    <li>IT service providers</li>
                                                                    <li>Data storage providers</li>
                                                                    <li>Web hosting and server providers</li>
                                                                    <li>Payment processors</li>
                                                                    <li>Marketing and advertising providers</li>
                                                                    <li>Analytics providers</li>
                                                                </ul>
                                                            </li>
                                                            <li>Professional advisers
                                                                <ul class="my-3">
                                                                    <li>Bankers, bookkeepers and accountants</li>
                                                                    <li>Auditors</li>
                                                                    <li>Insurers and insurance brokers</li>
                                                                    <li>Legal advisers</li>
                                                                    <li>Social Media advisers</li>
                                                                </ul>
                                                            </li>
                                                            <li>Business partners
                                                                <ul class="my-3">
                                                                    <li>Our existing or potential Agents</li>
                                                                    <li>Our business partners or contractors</li>
                                                                </ul>
                                                            </li>
                                                            <li>Related entities
                                                                <p>Where permitted by law, we may share your personal
                                                                    information with our related entities including:</p>

                                                                <ul class="my-3">
                                                                    <li>PEAMS Australia Pty Ltd - for migration and related
                                                                        services</li>
                                                                    <li>Agency Management (Australia) Pty Ltd - for Agent
                                                                        services where Advertisers require assistance in the
                                                                        management of their Account</li>
                                                                </ul>
                                                            </li>
                                                            <li>Corporate transactions
                                                                <p>If we merge with or are acquired by another company, or
                                                                    sell our business assets:</p>
                                                                <ul class="my-3">
                                                                    <li>Your information may be disclosed to our advisers
                                                                    </li>
                                                                    <li>Your information may be disclosed to the potential
                                                                        purchaser's advisers</li>
                                                                    <li>Your information may be included in the transferred
                                                                        assets</li>
                                                                </ul>
                                                            </li>
                                                            <li>Legal and regulatory bodies
                                                                <ul class="my-3">
                                                                    <li>Courts and tribunals</li>
                                                                    <li>Regulatory authorities including as required for
                                                                        reporting obligations</li>
                                                                    <li>Law enforcement officers</li>
                                                                </ul>
                                                            </li>
                                                            <li>Other parties
                                                                <ul class="my-3">
                                                                    <li>Third parties you have authorised</li>
                                                                    <li>Any other parties as required or permitted by law
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 5 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>5.</span>Overseas disclosure</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            We may disclose personal information to overseas third party
                                                            service providers in relation to:

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Storage and access
                                                                <p>
                                                                    We store your personal information in Australia.
                                                                    However, your information may be
                                                                    accessed from or transferred to locations outside
                                                                    Australia, including Europe, Asia
                                                                    and the United States of America, in these
                                                                    circumstances:
                                                                </p>
                                                                <ul>
                                                                    <li>When our service providers are located overseas</li>
                                                                    <li>When we work with overseas business partners</li>
                                                                    <li>When using cloud-based services or data storage
                                                                        solutions</li>
                                                                </ul>
                                                            </li>
                                                            <li>Our approach to overseas disclosure
                                                                <p>Before disclosing your personal information overseas, we
                                                                    take reasonable steps to
                                                                    ensure that the recipient treats your information in
                                                                    accordance with the applicable
                                                                    law by only sending what is necessary, requiring
                                                                    recipients to protect your
                                                                    information through contractual agreements which require
                                                                    the recipient to comply
                                                                    with the privacy standards in applicable law or through
                                                                    other mechanisms that
                                                                    provide comparable safeguards and by monitoring how
                                                                    recipients handle your
                                                                    information.</p>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="set">
                    <a>
                        Your Rights
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">

                                                {{-- 6 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>6.</span> Your privacy rights and
                                                        choices
                                                    </h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>How we manage your privacy rights and choices is completely
                                                            determined by you.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Providing information
                                                                <p>You can choose whether to provide personal information to
                                                                    us, however, if you don't
                                                                    provide certain information, we may not be able to
                                                                    provide some of the Services.
                                                                    If you have any concerns about the personal information
                                                                    we requested, please let
                                                                    us know if you don’t want to provide this information
                                                                    and we can discuss your
                                                                    options, and will let you know when information is
                                                                    required versus optional.</p>
                                                            </li>
                                                            <li>Access to your information
                                                                <p>
                                                                    You can request access to the personal information we
                                                                    hold about you and we will
                                                                    respond to your request within a reasonable time. We may
                                                                    charge a reasonable
                                                                    administrative fee for providing access and if we cannot
                                                                    provide access, we will
                                                                    explain why and explore alternative ways to share
                                                                    relevant information.
                                                                </p>
                                                            </li>
                                                            <li>Correction rights
                                                                <p>
                                                                    You can ask us to correct any information that is
                                                                    inaccurate, out of date,
                                                                    incomplete, irrelevant or misleading and we will take
                                                                    reasonable steps to correct
                                                                    your information promptly. If we cannot make the
                                                                    correction, we will explain why
                                                                    and discuss alternatives. You can ask us to add a
                                                                    statement to your information
                                                                    noting your requested correction.
                                                                </p>
                                                            </li>
                                                            <li>Marketing communications
                                                                <p>You can opt-out of receiving marketing communications at
                                                                    any time. Each
                                                                    marketing communication will include an unsubscribe
                                                                    option. You can change your
                                                                    marketing preferences in your account or by contacting
                                                                    us. We will process your
                                                                    request as soon as practicable.</p>

                                                            </li>
                                                            <li>How to contact us about your rights or to make a complaint
                                                                and what happens next
                                                                <p>Step 1: Contact our privacy officer</p>
                                                                <ul class="my-3">
                                                                    <li>Email: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="mailto:privacy@escorts4u.com.au" style="word-break: break-all;">privacy@escorts4u.com.au</a></li>
                                                                    <li>Phone: &nbsp;&nbsp;&nbsp;&nbsp; 1300 700 444</li>
                                                                    <li>Post: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GPO Box T1756 Perth WA 6845</li>
                                                                </ul>
                                                                <p>
                                                                    What to include:
                                                                </p>
                                                                <p>
                                                                    Your full name, contact details, clear details about
                                                                    your request or complaint, and
                                                                    any relevant dates or reference numbers.
                                                                </p>
                                                                <p>
                                                                    Step 2: Our response
                                                                </p>
                                                                <p>
                                                                    We will:
                                                                </p>
                                                                <ul class="my-3">
                                                                    <li>Verify your identity before processing your request
                                                                    </li>
                                                                    <li>Investigate thoroughly (for complaints) or process
                                                                        your request (for rights)</li>
                                                                    <li>Respond to you in writing within reasonable time
                                                                        frames and as required by law</li>
                                                                    <li>Explain what actions we will take and keep you
                                                                        updated on the progress</li>
                                                                    <li>Not charge you for making a request (except for
                                                                        reasonable access fees if applicable)</li>
                                                                    <li>Help you understand and exercise your rights</li>
                                                                </ul>
                                                                <p>
                                                                    Step 3: If you're not satisfied (complaints only)
                                                                </p>
                                                                <p>
                                                                    If you're not satisfied with our response to your
                                                                    complaint, you can:
                                                                </p>
                                                                <ul class="my-3">
                                                                    <li>Ask for a review by our senior management, or</li>
                                                                    <li>Contact external bodies such as the Office of the
                                                                        Australian Information Commissioner (Phone: 1300 363
                                                                        992, W ebsite: www.oaic.gov.au)</li>
                                                                </ul>
                                                                <p>This is the same process whether you want to access your
                                                                    information, correct
                                                                    mistakes, change marketing preferences, or make a
                                                                    complaint about our privacy
                                                                    practices.</p>
                                                            </li>

                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 7 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>7.</span>Protecting your
                                                        information</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            We use multiple layers of security to protect your information.
                                                            These include:

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>Technical safeguards

                                                                <ul class="my-3">
                                                                    <li>Enterprise-grade encryption for data storage and
                                                                        transmission </li>
                                                                    <li>Regular security testing and monitoring</li>
                                                                    <li>Automated threat detection systems</li>
                                                                </ul>
                                                            </li>
                                                            <li>Operational security

                                                                <ul class="my-3">
                                                                    <li>Staff training on security and privacy</li>
                                                                    <li>Strict access controls based on job requirements
                                                                    </li>
                                                                    <li>Regular security audits and incident response
                                                                        procedures testing</li>
                                                                </ul>

                                                            </li>
                                                            <li>Physical security

                                                                <ul class="my-3">
                                                                    <li>Secure premises with controlled access</li>
                                                                    <li>Secure disposal of physical documents</li>
                                                                    <li>Equipment security protocols</li>
                                                                </ul>

                                                            </li>
                                                            <li>Public information

                                                                <p>
                                                                    Please note that any information you choose to share
                                                                    publicly on your profile can
                                                                    be accessed and used by others. We cannot control or
                                                                    protect information that you
                                                                    make publicly available, including Reviews.
                                                                </p>

                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}


                                                {{-- 8 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>8.</span>How long we keep your
                                                        information</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            We keep your personal information only as long as we need it for
                                                            the purposes we
                                                            collected it, or as required by law. When we no longer need it,
                                                            we securely destroy or
                                                            de-identify it.

                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Cookies and Analytics
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">

                                                {{-- 9 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>9.</span> Cookies</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>We use a number of technologies to manage the Website and your
                                                            account. These include:</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <ol class="level-2">
                                                            <li>What We Use
                                                                <p>We use cookies, tracking pixels, and similar technologies
                                                                    on the Website and in our emails to improve your
                                                                    experience and our Services.</p>
                                                            </li>
                                                            <li>Cookies
                                                                <ul class="my-3">
                                                                    <li>Small text files stored on your device</li>
                                                                    <li>Help remember your preferences</li>
                                                                    <li>Enable certain Website functions</li>
                                                                    <li>Make your interactions with the Website more
                                                                        efficient</li>
                                                                </ul>
                                                            </li>
                                                            <li>Tracking Pixels
                                                                <ul class="my-2">
                                                                    <li>Tiny, invisible images in web pages and emails</li>
                                                                    <li>Help us understand how you interact with our content
                                                                    </li>
                                                                    <li>Allow us to measure email engagement</li>
                                                                    <li>Enable more relevant content delivery</li>
                                                                </ul>
                                                            </li>
                                                            <li>How we use these technologies:
                                                                <p>
                                                                    Essential Functions
                                                                </p>
                                                                <ul class="my-2">
                                                                    <li>Remember your login status</li>
                                                                    <li>Maintain your session security</li>
                                                                    <li>Store your preferences</li>
                                                                    <li>Enable core Website features</li>
                                                                </ul>
                                                                <p>Analytics and Performance</p>
                                                                <ul class="my-2">
                                                                    <li>Understand how the Website is used</li>
                                                                    <li>Measure page views and traffic</li>
                                                                    <li>Analyse User navigation patterns</li>
                                                                    <li>Identify areas for improvement</li>
                                                                </ul>
                                                                <p>Personalisation</p>
                                                                <ul class="my-2">
                                                                    <li>Remember your preferences</li>
                                                                    <li>Tailor content to your interests</li>
                                                                    <li>Improve your browsing experience</li>
                                                                    <li>Provide relevant recommendations</li>
                                                                </ul>
                                                            </li>
                                                            <li>Your control
                                                                <p>You can manage these technologies by:</p>
                                                                <ul class="my-3">
                                                                    <li>Adjusting your browser settings to block or delete
                                                                        cookies</li>
                                                                    <li>Using privacy-focused browser extensions</li>
                                                                    <li>Configuring your email client to block images</li>
                                                                    <li>CUsing our cookie preference settings</li>
                                                                </ul>
                                                                <p>
                                                                    <b>Note: &nbsp;&nbsp;&nbsp;&nbsp;</b> Blocking all
                                                                    cookies may affect Website functionality and your User
                                                                    experience.
                                                                </p>

                                                            </li>

                                                        </ol>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 10 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>10.</span>Google Analytics</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p class="pl-2">We use Google Analytics to understand how people
                                                            use the
                                                            Website. This involves
                                                            cookies that collect information about your browsing activity.
                                                            You can opt out of Google's
                                                            advertising features through your Google account settings,
                                                            browser add-ons, or your
                                                            device's privacy settings. Google provides various tools and
                                                            options to control how your
                                                            data is used for advertising purposes. You can learn more about
                                                            how Google uses your
                                                            data and your available options on Google's privacy pages.</p>
                                                    </div>

                                                     <div class="content_align">
                                                        <span></span>
                                                        <p>You can control Google Analytics tracking by:</p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span></span>
                                                            <ul class="my-3">

                                                                <li>Adjusting your browser settings to refuse cookies
                                                                </li>
                                                                <li>Downloading and installing the Google Analytics
                                                                    Opt-out Browser Add-on for your
                                                                    web browser:
                                                                    <a href="http://tools.google.com/dlpage/gaoptout?hl=en" style="word-break: break-all;">http://tools.google.com/dlpage/gaoptout?hl=en</a>
                                                                </li>
                                                                <li>Configuring your Google account settings to control
                                                                    how your data is used for
                                                                    advertising</li>
                                                                <li>Using your device's privacy settings to manage ad
                                                                    tracking</li>
                                                            </ul>
                                                           


                                                    </div>
                                                     <div class="content_align">
                                                        <span></span>
                                                         <p>Please note that if you refuse all cookies by adjusting your
                                                                browser settings, you may not be able to use the full
                                                                functionality of the Website.</p>
                                                    </div>

                                                </div>
                                                {{-- end --}}


                                                {{-- 11 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>11.</span>Use of location services
                                                        data</h3>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <div class="pl-2">
                                                            <p>We collect your approximate Location via the Website for the
                                                                following purposes:</p>
                                                            <ul class="my-3">

                                                                <li>For security and safety</li>
                                                                <li>To prevent and detect fraud</li>
                                                                <li>As permitted by law</li>
                                                                <li>To identify where you are to display Profiles</li>
                                                                <li>To monitor Location and ensure compliance with
                                                                    applicable laws and regulations in your location</li>
                                                                <li>To identify your Home State for regulatory purposes and
                                                                    Tour creation</li>
                                                                <li>To match Advertisers with Agents and Viewers in your
                                                                    Home State</li>
                                                            </ul>
                                                            <p>
                                                                We collect this information when you access the Website
                                                                (whether on-screen or not). If
                                                                you do not want us to use your Location for the purposes
                                                                above, you should turn off the
                                                                Location services in your mobile phone settings. If you do
                                                                not provide geolocation data
                                                                to us, it may affect our ability to work with you as a User
                                                                of our business.
                                                            </p>
                                                        </div>


                                                    </div>
                                                </div>
                                                {{-- end --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            We may change or modify this Policy in the future. We will note the date that
                                            revisions were
                                            last made at the bottom of this page. Any revision will take effect upon its
                                            posting. It is your
                                            responsibility to check the <a href="{{ url('terms-conditions') }}"><span
                                                    style="color:#FF3C5F">Terms and Conditions</span></a> and this Policy
                                            from time to time to review
                                            the most current version.

                                        </p>
                                        <p>
                                            Escorts4U archives all previous versions of this Policy.
                                        </p>
                                        <p><b>This policy was last updated 25-05-2026</b></p>

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
                from: function(value) {
                    return parseInt(value);
                },
                to: function(value) {
                    return parseInt(value);
                }
            }
        });

        skipSliderage.noUiSlider.on("update", function(values, handle) {
            skipValuesage[handle].innerHTML = values[handle];
        });
    </script>
@endpush
