@extends('layouts.tnc')
@section('style')
    <style>
        .cms-h2 {
            font-family: Poppins;
            /* font-weight: 500; */
            font-size: 24px;
            line-height: 36px;
            margin-top: 30px;
        }

        .cms-accordion {
            border: solid 1px #5D6D7E;
            margin: 15px 0;
            border-radius: 4px;
            padding: 0;
        }

        .cms-accordion-title {
            cursor: pointer;
            display: block;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            transition: all 0.2s linear;
            font-weight: 700;
            font-size: 24px;
            line-height: 32px;
            color: #0c223d !important;
        }

        .divider {
            height: 1px;
            width: 100%;
            background-color: #90A0B7;
            margin: 15px 0px;
        }

        .cms-accordion-content-area {
            width: 100%;
            padding: 20px 10px;
        }

        .cms-list {
            list-style: none;
        }

        .cms-lvl1-list-title {
            font-weight: 700 !important;
            color: #0c223d;
            margin-bottom: 10px;
            list-style: none;
        }

        .cms-list-span {
            margin-right: 15px;
        }

        .cms-list-item {
            font-weight: normal;
            margin-bottom: 15px;
            display: flex;
            box-sizing: border-box;
        }

        .cms-lvl1-list .cms-lvl1-list-title .cms-list-span {
            margin-right: 15px;
        }

        .cms-lvl {
            margin-left: 5px;
        }

        /*.cms-lvl2{
                                                                                                            margin-left: 30px;
                                                                                                            }*/
        /*.cms-lvl3{
                                                                                                            margin-left:50px ;
                                                                                                            }*/
        /*.cms-lvl4{
                                                                                                            margin-left:50px ;
                                                                                                            }*/
        .cms-paragraph,
        .cms-list-paragraph {
            font-size: 16px;
            line-height: 27.5px;
            font-weight: normal;
        }

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
    </style>
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
        <div class="container">
            <h1 class="cms-page-title">Terms & Conditions</h1>
            <div class="accordion-container">
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part A - Introduction
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
                                                    <h3>Our Disclosures</h3>
                                                    <p>
                                                        Please read these Terms and Conditions carefully before you accept.
                                                        We draw your attention
                                                        to the following important provisions:
                                                    </p>

                                                    <ul class="my-2">
                                                        <li>our Privacy Policy (available on our Website) which sets out how
                                                            we will handle your
                                                            personal information;</li>
                                                        <li>clause 24 (Consumer Law Rights) which sets out your rights under
                                                            the Australian
                                                            Consumer Law;</li>
                                                        <li>clause 26 (Liability) which sets out exclusions and limitations
                                                            to our liability under these
                                                            Terms and Conditions; and</li>
                                                        <li>clause 2.2 (Updates to Terms and Conditions) which sets out how
                                                            we may amend
                                                            these Terms and Conditions.</li>
                                                    </ul>
                                                    <p>
                                                        We may receive a benefit (which may include a referral fee or a
                                                        commission) should you visit
                                                        certain third party websites through a link on our Website, or for
                                                        featuring certain goods or
                                                        services on our Website.
                                                    </p>
                                                    
                                                    <p class="mt-2">
                                                        Nothing in these Terms and Conditions limits your rights and
                                                        remedies at law, including any
                                                        of your Consumer Law Rights.
                                                    </p>
                                                </div>
                                                {{-- 1 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>1.</span> Ownership</h3>

                                                    <div class="content_align">
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            This Website is owned and operated by Blackbox Tech Pty Ltd ACN:
                                                            664 919 975, who
                                                            is referred to in these Terms and Conditions as E4U, Escorts4U,
                                                            we, us, our and similar
                                                            grammatical forms.

                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 2 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>2.</span>Agreement to these terms
                                                        and conditions</h3>

                                                    <div class="content_align">
                                                        <span>2.1</span>
                                                        <p>

                                                            Every User of this Website, whether an Advertiser or Agent who
                                                            submits an Advertising
                                                            Request, and every Viewer who accesses this Website, agrees to
                                                            these Terms and
                                                            Conditions.

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>2.2</span>
                                                        <p>

                                                            We may update these Terms and Conditions at any time by
                                                            publishing revised Terms
                                                            and Conditions on the Website. The Terms and Conditions that
                                                            apply to your Listing or
                                                            purchase are those in effect at the time you place your order or
                                                            create a Listing. We
                                                            recommend reviewing the current Terms and Conditions before each
                                                            purchase or
                                                            listing.

                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}



                                                {{-- 3 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>3.</span>Geo-Location</h3>



                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>

                                                            Every User consents to E4U using Geolocation technology to
                                                            identify the User's Home
                                                            State during Registration or when undertaking a Profile search.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}



                                                {{-- 4 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>4.</span>The Services</h3>

                                                    <div class="content_align">
                                                        <span>4.1</span>
                                                        <p>
                                                            We only provide our Services and are not a party to any
                                                            transaction between
                                                            Advertisers and Viewers.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>4.2</span>
                                                        <p>
                                                            E4U will treat all personal information provided by Users
                                                            strictly in accordance with the
                                                            Privacy Policy available on the Website and applicable privacy
                                                            laws.
                                                        </p>
                                                    </div>



                                                </div>
                                                {{-- end --}}



                                                {{-- 5 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>5.</span>Account and membership
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>5.1</span>
                                                        <p>

                                                            To access and use the Services, you must register for an
                                                            Account. Registration is free
                                                            and upon completing registration you will become a Member. By
                                                            creating an Account
                                                            you agree to:

                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>provide accurate, complete and up-to-date information and
                                                                ensure it remains so;</li>
                                                            <li>keep your username and password secure and confidential and
                                                                protect them
                                                                from misuse or being stolen;</li>
                                                            <li>notify E4U immediately if you become aware of any
                                                                unauthorised access to your
                                                                Account; and</li>
                                                            <li>not permit your Account to be used by or transferred to any
                                                                other person.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>5.2</span>
                                                        <p>

                                                            If you close your Account, your Membership will cease and you
                                                            will lose access to the
                                                            Services.

                                                        </p>
                                                    </div>



                                                </div>
                                                {{-- end --}}


                                                {{-- 6 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>6.</span>Licence and Restricted Use
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>6.1</span>
                                                        <p>
                                                            We grant you a right to use our Website and basic Services in
                                                            accordance with these
                                                            Terms and Conditions from the date you sign up to an Account,
                                                            until the date these
                                                            Terms and Conditions are terminated in accordance with their
                                                            terms. This right cannot
                                                            be passed on or transferred to any other person.

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>6.2</span>
                                                        <p>

                                                            You agree not to:

                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5 mb-0">
                                                            <li>the reproduction of the material in any material form;</li>
                                                            <li>the distribution of the material in any material form;</li>
                                                            <li>re-transmission of the material by any medium of
                                                                communication;</li>
                                                            <li>uploading or reposting the material to any other site on the
                                                                Internet; and</li>
                                                            <li>"framing" the material on the Website with other material on
                                                                any other website.</li>
                                                        </ol>

                                                        </p>

                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>
                                                            The above are prohibited by these Terms and Conditions.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>6.3</span>
                                                        <p>
                                                            Despite the above restrictions on the use of the material on the
                                                            Website, you may
                                                            download material from the Website for your personal
                                                            non-commercial use provided
                                                            you do not remove any copyright and trade mark notices contained
                                                            on the material.
                                                            You may not modify or copy:
                                                        </p>
                                                    </div>


                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5 mb-0">
                                                            <li>the layout of the Website; or</li>
                                                            <li>any computer software and code contained in the Website.
                                                            </li>
                                                        </ol>

                                                        </p>

                                                    </div>

                                                    <div class="content_align">
                                                        <span>6.4</span>
                                                        <p>
                                                            E4U reserves all intellectual property rights, including, but
                                                            not limited to, copyright in
                                                            material or services provided by it. The material provided on
                                                            the Website is provided
                                                            for personal use only and may not be:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5 mb-0">
                                                            <li>re-sold or re-distributed in any material form;</li>
                                                            <li>stored in any storage media; or</li>
                                                            <li>
                                                                re-transmitted in any media,
                                                            </li>
                                                        </ol>

                                                        </p>

                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>
                                                            without our prior written consent.
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
                <!-- Part B - Advertisers -->
                <div class="set">
                    <a class="cms-accordion-title">
                        Part B - Advertisers
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 7 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>7.</span>Advertising Services</h3>
                                                    <div class="content_align">
                                                        <span>7.1</span>
                                                        <p>By submitting an Advertising Request:</p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5">
                                                            <li>The Escort acknowledges that they:
                                                                <ol class="level-3">
                                                                    <li>are over 18 years of age and will not imply or state
                                                                        that they are under the
                                                                        age of 18 in any Profile; and</li>
                                                                    <li>are independent and not working for or associated
                                                                        with any Massage
                                                                        Centre or Escort Agency; and</li>
                                                                    <li>have the legal rights to provide all information and
                                                                        material (including
                                                                        photographs) it submits to and posts in a Profile on
                                                                        the Website and such
                                                                        information and material does not infringe the
                                                                        rights of any other third party.</li>
                                                                </ol>
                                                            </li>
                                                            <li>The Massage Centre acknowledges that any:
                                                                <ol class="level-3">
                                                                    <li>Masseur working at the Massage Centre is over 18
                                                                        years of age;</li>
                                                                    <li>Masseur Advertised on a Massage Centre Profile is
                                                                        over 18 years of age
                                                                        and Masseurs will not imply or state that they are
                                                                        under the age of 18 in
                                                                        any Profile; and</li>
                                                                    <li>Masseur who is advertised in a Massage Centre
                                                                        Profile is engaged by the
                                                                        Massage Centre; and</li>
                                                                    <li>Masseur engaged by the Massage Centre has the legal
                                                                        rights to provide all
                                                                        information and material (including photographs) it
                                                                        submits and posts on
                                                                        the Website and such information and material does
                                                                        not infringe the rights
                                                                        of any third party.</li>
                                                                </ol>
                                                            </li>
                                                            <li>The Agent acknowledges that any Profile the Agent posts on
                                                                behalf of an
                                                                Advertiser, complies with clauses 7.1(a) and 7.1(b).


                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.2</span>
                                                        <p>The Advertiser agrees not to impersonate or pose as any other
                                                            person, and that all
                                                            information, material and photographs displayed on any Profile
                                                            and posted on the
                                                            Website relates to the Advertiser alone, including any material
                                                            and photographs relating
                                                            to a Masseur. The Advertiser will not under any circumstances
                                                            send another person in
                                                            their place for any appointment. The Advertiser will not use the
                                                            Website to refer
                                                            Viewers to any other advertising directory, dating website or
                                                            any other website (except
                                                            the Advertiser's own personal website and social media, if
                                                            published).
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.2</span>
                                                        <p>Whilst the Advertiser advertises on the Website they, or any
                                                            Related Entity or Related
                                                            Party or Associated Entity, agrees not to have an interest,
                                                            either directly or indirectly,
                                                            in another website, business or venture that competes with the
                                                            Website, the Services
                                                            or E4U.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>7.4</span>
                                                        <p>The Advertiser, and any Agent who has been appointed by an
                                                            Advertiser, agrees that
                                                            if the Advertiser is found, in the opinion of E4U acting
                                                            reasonably, to:</p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5">
                                                            <li>be using photographs or advertising material of another
                                                                person as their own; or</li>
                                                            <li>be a:
                                                                <ol class="level-3">
                                                                    <li>Massage Centre posing as an Escort; or</li>
                                                                    <li>Escort Agency posing as an Escort; or</li>
                                                                </ol>
                                                            </li>
                                                            <li>be sending another person in their place for any
                                                                appointment; or</li>
                                                            <li>be using the Website to refer Viewers to any other
                                                                advertising directory, dating
                                                                website or any other website (except the client's own
                                                                personal website, as stated
                                                                in clause 7.2); or</li>
                                                            <li>be using photographs, information or material not owned by
                                                                them or which, in the
                                                                opinion of E4U, a third party has the expressed right over
                                                                such photographs,
                                                                information or material; or</li>
                                                            <li>have an interest in another website, business or venture
                                                                that competes with the
                                                                Website, the Services or E4U; or</li>
                                                            <li>have breached any part of the Terms and Conditions, the
                                                                Membership and
                                                                Advertiser’s access to the Website, may, in E4U's absolute
                                                                and unfettered
                                                                discretion (in addition to all other rights and remedies
                                                                open to it), be cancelled
                                                                without refund (except as required at law) and any Profile
                                                                at the time which is
                                                                published on the Website will be immediately removed.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.5</span>
                                                        <p>By uploading on to the Website, or otherwise providing E4U with,
                                                            any material that is
                                                            protected by (intellectual property) rights including, but not
                                                            limited to, copyrighted works
                                                            and material other than works, trade marks and service marks
                                                            (<b>Intellectual Property</b>),
                                                            the Advertiser grants E4U a perpetual, non-exclusive and
                                                            payment-free licence
                                                            throughout the world to:</p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5">
                                                            <li>reproduce, use and exploit the Intellectual Property, as
                                                                part of the Website and
                                                                associated sites, to the full extent permitted by
                                                                Intellectual Property law in any
                                                                jurisdiction in which the Website is available to users; and
                                                            </li>
                                                            <li>allow E4U to sub-licence its service providers the same
                                                                rights granted to us in
                                                                sub-clause (a) above for the purposes set out in sub-clause
                                                                (c) below;</li>
                                                            <li>supply our Services to the Advertiser, diagnose problems
                                                                with our Services and
                                                                perform analytics and improve, develop and protect our
                                                                Website.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.6</span>
                                                        <p>E4U reserves the right to crop the Advertiser's images if they do
                                                            not fit with the Profile
                                                            layout, or to improve the Advertiser's Listing and the
                                                            Advertiser authorises such
                                                            amendment.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.7</span>
                                                        <p>Subject to clause 6.6, E4U will publish images online in the same
                                                            form as they are
                                                            received from the Advertiser, unless notified by the Advertiser
                                                            in writing via email, or
                                                            other nominated form of communication, to do otherwise. If the
                                                            Advertiser requires their images to be cropped or blurred the
                                                            Advertiser must notify E4U at the time of providing
                                                            those images.</p>
                                                    </div>



                                                    <div class="content_align">
                                                        <span>7.8</span>
                                                        <p>An Advertiser must comply, at its own cost and expense, with all
                                                            acts, ordinances,
                                                            rules, regulations, other delegated legislation, codes and the
                                                            requirements of any
                                                            Commonwealth, State and Local Government departments, bodies,
                                                            and public
                                                            authorities or other authority. An Advertiser agrees it is their
                                                            responsibility and not the
                                                            responsibility of E4U to ensure such compliance, and the Escort
                                                            or Massage Centre
                                                            hereby represents and warrants that:</p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>

                                                        <ol class="level-2 pl-5">
                                                            <li>their Profile is compliant with all relevant Local Laws,
                                                                Classification Laws and
                                                                laws of any other country in which the Escort or Massage
                                                                Centre advertises, or
                                                                provides, escort or sex work services, including States,
                                                                Territories and countries
                                                                that the Advertiser is touring in, including but not limited
                                                                to the:

                                                                <ol class="level-3">
                                                                    <li> <i>Competition and Consumer Act 2010</i> (Cth),
                                                                        including the Australian
                                                                        Consumer Law; </li>
                                                                    <li>Fair Trading Acts in all applicable States and
                                                                        Territories;</li>
                                                                    <li><i>Privacy Act 1988</i> (Cth) including the
                                                                        Australian Privacy Principles as if they
                                                                        were an APP entity as that term is defined in the
                                                                        <i>Privacy Act 1988</i> (Cth);
                                                                    </li>
                                                                    <li>Human Rights and <i>Equal Opportunity Commission Act
                                                                            1986</i> (Cth); and</li>
                                                                    <li>All anti-discrimination and equal opportunity
                                                                        legislation applicable in the
                                                                        State or Territory in which the Advertiser does
                                                                        business; and</li>
                                                                    <li>All legislation applicable to the advertising of
                                                                        escort or sex work services.</li>
                                                                </ol>
                                                            </li>
                                                            <li>they hold all consents, licences and approvals, necessary to
                                                                lawfully advertise,
                                                                and provide, escort or sex work services or massage services
                                                                (as applicable) in
                                                                any place, whether inside or outside Australia, where they
                                                                so advertise or provide
                                                                such services. The Advertiser hereby indemnifies E4U from
                                                                and against all
                                                                actions, costs, charges, claims and demands arising directly
                                                                from the Advertiser’s
                                                                breach of this clause 7.8.</li>
                                                        </ol>
                                                        </p>
                                                    </div>





                                                    <div class="content_align">
                                                        <span>7.9</span>
                                                        {{-- <p> --}}
                                                        <ol class="level-2">
                                                            <li>An Advertiser, and an Agent where they are acting on behalf
                                                                of an Advertiser,
                                                                understand that any Profile or Tour they create will be
                                                                reviewed and approved by
                                                                E4U at E4U’s absolute discretion before it will be displayed
                                                                on the Website. If
                                                                E4U finds there is any content that does not comply with the
                                                                Local Laws or any
                                                                Policies, E4U will may ask the Advertiser or Agent (as the
                                                                case may be) from time
                                                                to time to amend the content of the Profile before the
                                                                Profile is approved. Without
                                                                limiting any other rights and remedies available to E4U at
                                                                law or equity or statute
                                                                or under these Terms and Conditions, if the Advertiser does
                                                                not comply with any
                                                                reasonable request from E4U to amend the Profile (the
                                                                determination of which
                                                                is solely at E4U's discretion) E4U may, in its sole
                                                                discretion, refuse to accept any
                                                                such Profile, or component that forms a part of the profile
                                                                or, if any such Profile
                                                                is already on the Website, to remove that Profile forthwith;
                                                                and</li>
                                                            <li>E4U may remove any material or information, including but
                                                                not limited to links to
                                                                other sites on the Internet, at any time without giving any
                                                                explanation or
                                                                justification for removing the material or information.</li>
                                                            <li>To the maximum extent permitted by law, E4U bears no
                                                                liability for any costs,
                                                                losses or damages of any kind, which you may incur, arising
                                                                whether directly or
                                                                indirectly from:
                                                                <ol class="level-3">
                                                                    <li>any material or information supplied in respect of
                                                                        advertising on the
                                                                        Website; and</li>
                                                                    <li>E4U amending or removing any material or information
                                                                        from the Website
                                                                        in accordance with these Terms and Conditions.</li>
                                                                </ol>
                                                            </li>
                                                        </ol>
                                                        {{-- </p> --}}
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.10</span>
                                                        <p>An Advertiser must not place a link to any other advertising
                                                            portal or directory on the
                                                            Website or otherwise attempt to draw business away from E4U,
                                                            without the written
                                                            permission of E4U.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.11</span>
                                                        <p>An Advertiser and Agent consent to receiving electronic
                                                            communication from E4U.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.12</span>
                                                        <p>E4U may, in its absolute discretion, terminate any Profile or
                                                            Tour and Membership
                                                            which breaches any of these Terms and Conditions (and subject to
                                                            any applicable
                                                            laws), without refund.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.13</span>
                                                        <p>E4U understands that there may be slight differences between an
                                                            Escort's or Masseur's
                                                            Profile images and the Escort or Masseurs in real life, due to
                                                            photographic techniques
                                                            used as well as flattering lighting and angles. Image
                                                            verification is generally
                                                            compulsory, however if a complaint is received about image
                                                            authenticity then the
                                                            Advertiser's images must be verified as per the E4U image
                                                            verification process. More
                                                            details for this process may be obtained from E4U upon request.
                                                            E4U may, at its
                                                            absolute discretion, immediately suspend any Profile or Tour
                                                            unless and until it is
                                                            satisfied that the image verification has been, in E4U's sole
                                                            opinion, satisfactorily
                                                            completed.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.14</span>
                                                        <p>If the Advertiser or Masseur is found to have images that are
                                                            outdated and no longer
                                                            represent the way the Advertiser or Masseur looks, E4U, in its
                                                            absolute discretion, may
                                                            ask for replacement images that are current and the Advertiser
                                                            or Masseur (as the case
                                                            may be) must supply them within the nominated time frame as
                                                            advised by E4U;
                                                            otherwise E4U may, at its sole discretion, suspend or
                                                            permanently remove the Profile
                                                            or Tour.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>7.15</span>
                                                        <p>An Advertiser is under no obligation or requirement to agree to
                                                            these Terms and
                                                            Conditions however, in the event the Advertiser is unwilling or
                                                            unable to agree to the
                                                            Terms and Conditions, then E4U will not provide the Services to
                                                            the Advertiser.</p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 8 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>8.</span>Profile and Design</h3>

                                                    <div class="content_align">
                                                        <span>8.1</span>
                                                        <p>
                                                            An Advertiser hereby gives authority for E4U to upload and
                                                            publish the Advertiser's
                                                            supplied photographs for the purpose of a Profile or Tour.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>8.2</span>
                                                        <p>
                                                            An Advertiser agrees that the Advertiser's content in any
                                                            Profile or Tour and any
                                                            changes to the content of a Profile or Tour is the Advertiser's
                                                            sole responsibility.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>8.3</span>
                                                        <p>
                                                            An Advertiser agrees and accepts that:
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>E4U retains legal and intellectual property rights in all
                                                                material or content created
                                                                by E4U; and the</li>
                                                            <li>E4U's registered and unregistered trade marks form part of
                                                                the Profile design and
                                                                are not to be removed or altered in any form; and the</li>
                                                            <li>standard Website design, look and functionality will be
                                                                maintained as the theme
                                                                of the Profile or Tour (as the case may be) when placing an
                                                                Advertising Request;
                                                                and</li>
                                                            <li>it is not permitted to publish, manipulate, distribute or
                                                                otherwise reproduce, in any
                                                                format, any of the content or copies of the content that E4U
                                                                creates in connection
                                                                with any business or commercial enterprise.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>8.4</span>
                                                        <p>
                                                            Advertisers agree that E4U has the right to make changes to a
                                                            Profile or Tour if it is no
                                                            longer compliant with these Terms and Conditions.
                                                        </p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 9 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>9.</span>Search for Information
                                                        Services

                                                    </h3>

                                                    <div class="content_align">
                                                        <span>9.1</span>
                                                        <p>The Advertiser advertises on the Website at their own risk.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>9.2</span>
                                                        <p>E4U will provide a Profile search function for Viewers. Whilst
                                                            care is taken to avoid
                                                            errors and omissions, inaccuracies may occur and E4U does not
                                                            accept responsibility
                                                            for any errors and omissions which may occur in the Profile or
                                                            Tour (as the case may
                                                            be) search function. It is the responsibility of the Advertiser
                                                            to inform E4U of any
                                                            problems associated with the Profile search function.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>9.3</span>
                                                        <p>To the maximum extent permitted by law, E4U is not liable for any
                                                            loss or damages
                                                            arising out of or in connection with any transaction instigated
                                                            as a result of an
                                                            Advertiser advertising on the Website. All transactions between
                                                            Advertisers and
                                                            Viewers are solely a matter between those parties and E4U is not
                                                            a party to any such
                                                            transaction.</p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>9.4</span>
                                                        <p>E4U recommends Advertisers use only personal computers and
                                                            personal email
                                                            addresses when accessing and using the Website, E4U will send
                                                            emails and
                                                            advertising material to the Advertiser which the Advertiser may
                                                            find to be of a sensitive
                                                            or personal nature.</p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 10 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>10.</span>Obligations of the
                                                        Advertiser
                                                    </h3>
                                                    <p>The Advertiser agrees, represents and warrants that:</p>
                                                    <div class="content_align">
                                                        <ol class="level-2">

                                                            <li>they will not reproduce, adapt, upload or link to any of the
                                                                material on the Website (or
                                                                on any third party website) without the prior consent of E4U
                                                                (or the relevant third party
                                                                website owner(s)), including saving the clips on the Website
                                                                to any type of media;</li>
                                                            <li>except for where a Masseur is attached to a Massage Centre,
                                                                they are independent
                                                                and not working for or associated with any Escort Agency;
                                                            </li>
                                                            <li>they will not under any circumstances pose as any other
                                                                person or send another person
                                                                in their place for any appointment;</li>
                                                            <li>they own all intellectual property in, or are legally
                                                                authorised to use and distribute, any
                                                                photographs, videos, music and any other material submitted
                                                                to E4U;</li>
                                                            <li>they will not use the Website to refer Viewers to any other
                                                                advertising directory, dating
                                                                website or any other website (except the client's own
                                                                personal website or social media
                                                                platforms);</li>
                                                            <li>they will uphold the good name and protect the goodwill of
                                                                E4U at all times (the
                                                                determination of which is solely at E4U's discretion);</li>

                                                            <li>they will conduct themselves in a professional manner at all
                                                                times;</li>
                                                            <li>they will not make use of the Website for, or encourage, any
                                                                criminal or illegal activities
                                                                or any activities which are likely to cause loss, cost,
                                                                expense or damage to E4U;</li>
                                                            <li>they will not interfere with or disrupt the access of other
                                                                Users of the Website in any
                                                                way;</li>
                                                            <li>they will not place on the Website any material which is
                                                                unlawful, defamatory,
                                                                harassing, abusive, threatening, a malicious falsehood,
                                                                discriminatory or otherwise
                                                                objectionable in relation to a person, product, service or
                                                                company;</li>
                                                            <li>all information provided by the Advertiser to E4U (including
                                                                any images which relates
                                                                to the Advertiser in any way) is true and accurate in every
                                                                detail and all required
                                                                consents for its disclosure have been obtained by the
                                                                Advertiser;</li>
                                                            <li>that the material or information provided to the Website
                                                                does not breach or infringe:


                                                                <ol class="level-3">
                                                                    <li>the rights of any person or corporation under the
                                                                        <i>Competition and Consumer Act
                                                                        2010</i> (Cth) or equivalent State legislation;</li>
                                                                    <li>any intellectual property right, including but not
                                                                        limited to, copyright, trade marks,
                                                                        business names, confidential information rights
                                                                        protected by 'passing off';</li>
                                                                    <li>State or Commonwealth privacy legislation or
                                                                        anti-discrimination legislation; or</li>
                                                                    <li>any other law or regulations of the Commonwealth of
                                                                        Australia, and its States and
                                                                        Territories, or any law in any country where the
                                                                        material or information is or will
                                                                        be available electronically to Users of this
                                                                        Website; and</li>
                                                                </ol>
                                                            </li>
                                                            <li>that they will not transmit or attempt to transmit any
                                                                computer viruses, worms, defects,
                                                                Trojan horses or other material that is malicious, or of a
                                                                destructive nature, or affects
                                                                the performance or functionality of the Website or Services.
                                                            </li>
                                                            <li>they indemnify E4U for all liabilities or losses incurred
                                                                arising from their breach of
                                                                clause 9(k).</li>
                                                        </ol>

                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 11 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>11.</span>Payment of Fees
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>11.1</span>
                                                        <p>The Advertiser agrees to pay the Fees in the following manner for
                                                            obtaining the Services:</p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>General
                                                                <ol class="level-3">
                                                                    <li>The Advertiser must pay the applicable Fee to create
                                                                        a Listing on the
                                                                        Website for a nominated period of time, as selected
                                                                        by the Advertiser
                                                                        through the Advertiser Console.</li>
                                                                    <li>The advertising period will commence at the time and
                                                                        on the date the
                                                                        Advertiser stipulates in the Profile or Tour creator
                                                                        but only if payment has
                                                                        been received by E4U by one (1) business day before
                                                                        the stipulated
                                                                        commencement date.</li>
                                                                    <li>If payment has not been received by E4U by one (1)
                                                                        business day before
                                                                        the stipulated commencement date, then the
                                                                        advertising period will not
                                                                        commence on the stipulated date, and the Profile or
                                                                        Tour will not be
                                                                        published on the Website.</li>
                                                                    <li>E4U will not publish a Profile or Tour on the
                                                                        Website, until the Advertiser
                                                                        has paid the Fees. The Fees are shown in the console
                                                                        pages of the
                                                                        Website, once the Advertiser has registered on the
                                                                        Website as a Member
                                                                        and logged onto the Advertiser Console of the
                                                                        Website.</li>
                                                                    <li>All Fees are due and payable in accordance with the
                                                                        requirements of the
                                                                        Services (as set out from time to time on the
                                                                        Website).</li>
                                                                    <li>Discounts may apply to the Fee based on the
                                                                        Advertiser's value of spend
                                                                        or loyalty program status, as displayed on the
                                                                        Website at the time of
                                                                        creating the Listing for the Profile or Tour.</li>
                                                                    <li>Payments will not be treated as received or paid
                                                                        until they have been
                                                                        credited into E4U's nominated bank account or the
                                                                        nominated payment
                                                                        provider has confirmed payment by the Advertiser in
                                                                        favour of E4U.</li>
                                                                </ol>
                                                            </li>
                                                            <li>Late payment
                                                                <p>
                                                                    If E4U has received late payment, being a payment
                                                                    received after the stipulated
                                                                    date of the commencement of the advertising period, E4U
                                                                    will take all reasonable
                                                                    steps to have the Profile or Tour (as the case may be)
                                                                    displayed on the Website
                                                                    as soon as practicable OR within two (2) business days
                                                                    of receiving the payment.</p>
                                                            </li>
                                                            <li>Payment Methods and Notifications
                                                                <ol class="level-3">
                                                                    <li>Payment methods are by credit/debit card to E4U's
                                                                        nominated bank
                                                                        account.</li>
                                                                    <li>When submitting an Advertising Request, the
                                                                        Advertiser must select a
                                                                        commencement date and end date for the listing
                                                                        period. The applicable
                                                                        Fee will be calculated based on the selected listing
                                                                        period and any
                                                                        applicable discounts, as displayed on the Website at
                                                                        the time of creating
                                                                        the Listing. Payment will be automatically charged
                                                                        to the Advertiser's
                                                                        nominated payment method at the time of Listing. To
                                                                        extend a listing, the
                                                                        Advertiser must submit new dates through the
                                                                        Advertiser Console and the
                                                                        applicable Fee for the extended period will be
                                                                        automatically charged to the
                                                                        Advertiser's nominated payment method. The
                                                                        commencement time for any
                                                                        Profile or Tour is 12:00 midnight notwithstanding
                                                                        the Profile or Tour will be
                                                                        published within 15 minutes of having been created.
                                                                    </li>
                                                                    <li>if payment is not made within the nominated time,
                                                                        within the current
                                                                        advertising period, E4U reserves the right to
                                                                        suspend the Advertiser's
                                                                        Profile or Tour until payment is received.</li>
                                                                </ol>
                                                            </li>
                                                            <li>Refunds
                                                                <ol class="level-3">
                                                                    <li>Subject to the requirements of any applicable laws:
                                                                        <ol class="level-4">
                                                                            <li>refunds are made at the absolute discretion
                                                                                of E4U; and</li>
                                                                            <li>no refund will be available to the
                                                                                Advertiser if the Advertiser
                                                                                changes their mind about using the Services
                                                                                during an active Listing
                                                                                period, subject to any rights the Advertiser
                                                                                may have under
                                                                                applicable laws.</li>
                                                                        </ol>
                                                                    </li>
                                                                    <li>Any agreed refunds will be processed promptly and
                                                                        payment made by
                                                                        direct deposit to the Advertiser's nominated bank
                                                                        account. Refund
                                                                        payments may take up to ten (10) business days to be
                                                                        received.</li>
                                                                    <li>Refunds will be processed in accordance with the
                                                                        Refund Policy.</li>
                                                                </ol>
                                                            </li>
                                                        </ol>
                                                        </p>

                                                    </div>
                                                    <div class="content_align">
                                                        <span>11.2</span>
                                                        <p>If E4U decides, in its absolute discretion, to give the
                                                            Advertiser a free period of
                                                            advertising, the Advertiser will be notified of the commencement
                                                            and finish dates of the
                                                            free period, together with a copy of the E4U policy in relation
                                                            to any Loyalty Program.</p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>11.3</span>
                                                        <p>E4U may decide, in its absolute discretion, to allow an
                                                            Advertiser to place on hold a
                                                            Profile or Tour. Any Fees which have been pre-paid may be held
                                                            as a credit for use at
                                                            a later date.</p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 12 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>12.</span>GST
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>12.1</span>
                                                        <p>Unless stated otherwise all of the Fees are exclusive of GST.</p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>12.2</span>
                                                        <p>Subject to clause 12.1, if any payment made by one party to any
                                                            other party under or
                                                            relating to these Terms and Conditions constitutes consideration
                                                            for a taxable supply
                                                            for the purposes of GST or any similar tax, the amount to be
                                                            paid for the supply will
                                                            subject to the receipt by the payer of a tax invoice in the
                                                            prescribed form be increased
                                                            so that the net amount retained by the supplier after payment of
                                                            that GST is the same
                                                            as if the supplier was not liable to pay GST in respect of that
                                                            supply.</p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 13 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>13.</span>Social Media</h3>
                                                    <div class="content_align">
                                                        <span>13.1</span>
                                                        <p>Subject to clause 13.2, an Advertiser, when they initially
                                                            register for the Services, will
                                                            be automatically promoted via social media platforms (as
                                                            selected by E4U, at its sole
                                                            discretion, from time to time). Such social media may include X
                                                            (previously known as
                                                            Twitter) and similar social media platforms.</p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>13.2</span>
                                                        <p>All new Advertisers will receive a welcome email, which will
                                                            provide them with the
                                                            ability to elect not to be promoted via social media. This can
                                                            be achieved by the
                                                            Advertisers logging into the Advertiser Console and selecting
                                                            "No", in the applicable
                                                            section of the Account, to the various social media platforms
                                                            that may be used by E4U.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>13.3</span>
                                                        <p>If the Advertiser selects "Yes" to being promoted via any social
                                                            media platforms, the
                                                            Advertiser agrees and understands that due to the nature of
                                                            social media and the
                                                            volume of posts, there may be old Tweets and posts that remain
                                                            in the time line, and
                                                            can be found in future by search engines.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>13.4</span>
                                                        <p>If the Advertiser decides not to be promoted on social media in
                                                            the future, or if the
                                                            Profiles are suspended or terminated, the Advertiser agrees and
                                                            understands that
                                                            previous social media posts will remain online, and may not
                                                            necessarily be
                                                            automatically deleted by E4U.</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>13.5</span>
                                                        <p>If the Advertiser wishes to have previous social media posts
                                                            deleted, the Advertiser
                                                            must provide the direct links of all of the posts to E4U. E4U
                                                            will not be responsible for
                                                            any social media posts that are not removed. The Advertiser
                                                            acknowledges that E4U
                                                            will not use any tools such as URL removal tools in this regard.
                                                        </p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 14 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>14.</span>Third Party Search
                                                        Engines</h3>
                                                    <div class="content_align">
                                                        <span>14.1</span>
                                                        <p>If Membership is cancelled or terminated, E4U will remove the
                                                            Advertiser's Profile from
                                                            the Website.</p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>14.2</span>
                                                        <p>The Advertiser acknowledges that notwithstanding the cancellation
                                                            or termination of
                                                            Membership, the Advertiser's content on the Website may still be
                                                            viewable on the
                                                            Website, at the sole discretion of E4U, and third party search
                                                            engines (notwithstanding
                                                            its removal from the Website) and E4U is not responsible for
                                                            such content being visible
                                                            and indexed by third party search engines. The Advertiser
                                                            acknowledges that E4U will
                                                            not use any tools such as URL removal tools in this regard.</p>
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
                <!-- Part C - Advertisers -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part C - Viewers
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 15 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>15.</span>Subscription and
                                                        Membership</h3>
                                                    <div class="content_align">
                                                        <span>15.1</span>
                                                        <p>To access and use the Services, you must register as a Viewer.
                                                            Registration is free.
                                                            Upon the completion of Registration, the Viewer will be provided
                                                            a notification email
                                                            with the means to access the Website, such as an activation key
                                                            and password.
                                                            Registration may include 2FA verification in the Registration
                                                            and logon process.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>15.2</span>
                                                        <p>
                                                            When registering as a Viewer, you must provide E4U with
                                                            accurate, complete and
                                                            up-to-date registration information, including your Home State,
                                                            as requested. It is your
                                                            responsibility to inform E4U of any changes to your Account
                                                            information. E4U will treat
                                                            your information strictly in accordance with the Privacy Policy.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>15.3</span>
                                                        <p>You must not register as a Viewer more than once.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>15.4</span>
                                                        <p>You must not impersonate or create an Account for any person
                                                            other than yourself.</p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>15.5</span>
                                                        <p>
                                                            E4U may, if we believe that your Account is false or misleading,
                                                            at any time request a
                                                            form of identification to verify your identity.
                                                        </p>

                                                    </div>

                                                    <div class="content_align">
                                                        <span>15.6</span>
                                                        <p>
                                                            You must ensure the security and confidentiality of your Account
                                                            details, including any
                                                            username and/or password assigned to you. You are wholly
                                                            responsible for all activities
                                                            which occur under your Membership. You must notify us
                                                            immediately if you become
                                                            aware of any unauthorised use of your Membership. You must not
                                                            permit your
                                                            Membership to be used by or transferred to any other person.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>15.7</span>
                                                        <p>
                                                            E4U may require a Viewer to change its username or password or
                                                            use a different
                                                            method of accessing the Website from time to time.
                                                        </p>

                                                    </div>


                                                    <div class="content_align">
                                                        <span>15.8</span>
                                                        <p>
                                                            E4U reserves the right to, in our sole discretion, suspend or
                                                            terminate your Membership
                                                            or access to all or any part of the Website, including if we
                                                            believe you are abusing an
                                                            Advertiser in any way, have breached these Terms and Conditions
                                                            or are no longer an
                                                            active Viewer.
                                                        </p>

                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 16 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>16.</span>Search for Information
                                                        Services</h3>

                                                    <div class="content_align">
                                                        <span>16.1</span>
                                                        <p>
                                                            The Viewer uses the Website at their own risk.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>16.2</span>
                                                        <p>
                                                            E4U provides a Profile and Tour search function for Viewers.
                                                            Whilst care is taken to
                                                            avoid errors and omissions, inaccuracies may occur and E4U does
                                                            not accept
                                                            responsibility for such errors and omissions.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>16.3</span>
                                                        <p>
                                                            The Website is a directory only and Viewers should satisfy
                                                            themselves as to the
                                                            accuracy of the Profiles and the legitimacy, suitability and
                                                            qualification of the Advertiser.
                                                            E4U encourages all Advertisers to verify any media published in
                                                            a Profile. E4U is not
                                                            a party to any and all transactions between Viewers and
                                                            Advertisers.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>16.4</span>
                                                        <p>
                                                            Unless the Account is set otherwise, the Viewer consents to
                                                            receiving electronic
                                                            communication from E4U, in line with our Spam Policy and Privacy
                                                            Policy.
                                                        </p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 17 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>17.</span>Obligations of the
                                                        Viewer</h3>
                                                    <p>The Viewer agrees, represents and warrants that:</p>



                                                    <div class="content_align">

                                                        <ol class="level-2">
                                                            <li>they will not reproduce, adapt, upload or link to any of the
                                                                material on the Website (or
                                                                on any E4U third party website) without the prior consent of
                                                                E4U or other relevant
                                                                Intellectual Property right holder, including saving any
                                                                Media on the Website to any type
                                                                of media;
                                                            </li>
                                                            <li>
                                                                they will comply with the Terms and Conditions;
                                                            </li>
                                                            <li>
                                                                they will not use the Website for, or encourage, any
                                                                criminal or illegal activities or any
                                                                activities which are likely to cause loss, cost, expense or
                                                                damage to E4U;
                                                            </li>
                                                            <li>
                                                                they will not interfere with or disrupt the access of other
                                                                Users of the Website in any way;
                                                            </li>
                                                            <li>they will observe and be bound by the Acceptable Usage Rules
                                                                and other Policies
                                                                published on the Website;</li>
                                                            <li>they will not publish any unlawful, defamatory, harassing,
                                                                abusive, threatening, false,
                                                                malicious, discriminatory or otherwise objectionable
                                                                statements or materials in relation
                                                                to a person, product, service or company;</li>
                                                            <li>it is their sole responsibility and not the responsibility
                                                                of E4U to ensure that they comply
                                                                with the Local Laws relevant to the engagement of escort or
                                                                sex work services in the
                                                                place where they engage such services, whether inside or
                                                                outside Australia; and</li>
                                                            <li>they unconditionally and irrevocably release and discharge
                                                                E4U from all liability for
                                                                damages or loss of any kind arising out from transactions
                                                                that are instigated as a result
                                                                of use of the Website or Services;</li>
                                                            <li>they will not access, exhibit, display or demonstrate any of
                                                                the content of the Website
                                                                in a public place, or where there are persons under the age
                                                                of 18; and must otherwise
                                                                comply with the Classification Laws to extent that those
                                                                laws apply to the Viewer.</li>
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
                <!-- Part D - Advertisers -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part D - Support Agents
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 18 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>18.</span>Applying to be an Agent
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>18.1</span>
                                                        <p>
                                                            Agents are appointed and managed by, and contracted with, Agency
                                                            Management Pty
                                                            Ltd (<b>AMA</b>), an independent third party. E4U does not
                                                            appoint
                                                            Agents directly. Where
                                                            an Advertiser engages an Agent, the Agent will be granted access
                                                            to the Website to act
                                                            on the Advertiser's behalf in accordance with these Terms and
                                                            Conditions.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>18.2</span>
                                                        <p>
                                                            Applications to AMA may be made through the Website’s agent
                                                            registration form. By
                                                            submitting an application to become an Agent the applicant
                                                            agrees and acknowledges
                                                            that they:

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>are over 18 years of age;</li>
                                                            <li>reside in the Home State declared in the application;</li>
                                                            <li>have registered, or will register if appointed an Agent, for
                                                                the purposes of GST; and</li>
                                                            <li>
                                                                are independent and not working for or associated with any
                                                                Massage Centre or
                                                                Escort Agency and will not post a Profile or Tour in their
                                                                own name.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>18.3</span>
                                                        <p>
                                                            AMA will consider all applications received. After AMA has made
                                                            a decision as to the
                                                            application, AMA will contact the applicant as to the outcome of
                                                            the application.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>18.4</span>
                                                        <p>
                                                            AMA’s decision as to whether an application is successful or
                                                            unsuccessful is wholly at
                                                            its discretion. If an applicant is unsuccessful, then AMA is not
                                                            required to provide any
                                                            reasoning on the decision.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>18.5</span>
                                                        <p>
                                                            If an application is successful, then the successful applicant
                                                            will be provided with a copy
                                                            of an agreement that will contain the terms and conditions of
                                                            the position of Agent
                                                            between the Agent and AMA. If AMA and the successful applicant
                                                            enter into an
                                                            agreement, then that person is an Agent. Upon becoming an Agent,
                                                            that person will be
                                                            granted access to the Website and will be bound by these Terms
                                                            and Conditions in that
                                                            capacity.
                                                        </p>

                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 19 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>19.</span>Obligations of the Agent
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>19.1</span>
                                                        <p>
                                                            The Agent agrees, represents and warrants that:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>they will use the Agent Console to manage the information,
                                                                data and documents of Advertisers;</li>
                                                            <li>they will not use the Website features intended for use by
                                                                Advertisers, including
                                                                but not limited to the Advertisers Console;
                                                            </li>
                                                            <li>
                                                                when they act on behalf of an Advertiser, they will take all
                                                                practical steps to
                                                                ensure that the Advertiser understands and complies with its
                                                                obligations under
                                                                the Terms and Conditions;
                                                            </li>
                                                            <li>
                                                                they will not reproduce, adapt, upload or link to any of the
                                                                material on the Website
                                                                (or on any third party website) without the prior consent of
                                                                E4U (or the relevant
                                                                third party website owner(s)), including saving the Media on
                                                                the Website to any
                                                                type of external media device or application;
                                                            </li>
                                                            <li>all information, material and photographs displayed on any
                                                                Profile and Listed on
                                                                the Website relates to the Advertiser alone;</li>
                                                            <li>they will not advertise on the Website as an Escort, Massage
                                                                Centre, or Masseur;</li>
                                                            <li>they will not try to draw business away from E4U in any way,
                                                                including misusing
                                                                the Website to refer Viewers to any other advertising
                                                                directory, dating website or
                                                                any other website, or placing a link to any other
                                                                advertising portal or directory on
                                                                the Website or otherwise;</li>

                                                            <li>they will not make use of the Website for, or encourage, any
                                                                criminal or illegal
                                                                activities or any activities which are likely to cause loss,
                                                                cost, expense or damage
                                                                to E4U or an Advertiser;</li>
                                                            <li>they will not interfere with or disrupt the access of other
                                                                Users to the Website in
                                                                any way;</li>
                                                            <li>they will not place on the Website any material which is
                                                                unlawful, defamatory,
                                                                harassing, abusive, threatening, a malicious falsehood,
                                                                discriminatory or
                                                                otherwise objectionable in relation to a person, product,
                                                                service or company;</li>
                                                            <li>all information provided by the Agent to E4U (including any
                                                                documents or content
                                                                such as images) which relates to the Agent or an Advertiser
                                                                is true and accurate
                                                                in every detail and any and all required consents for its
                                                                disclosure have been
                                                                obtained for the use of those documents and information; and
                                                            </li>
                                                            <li>that the Media or information provided to the Website does
                                                                not breach or infringe:
                                                                <ol class="level-3">
                                                                    <li>the rights of any person or corporation under the
                                                                        <i>Competition</i> and
                                                                        <i>Consumer Act 2010</i> (Cth) or equivalent State
                                                                        legislation;
                                                                    </li>
                                                                    <li>any intellectual property right, including but not
                                                                        limited to, copyright, trade
                                                                        marks, business names, confidential information
                                                                        rights protected by
                                                                        'passing off';</li>
                                                                    <li>State or Commonwealth privacy legislation or
                                                                        anti-discrimination legislation;
                                                                        or</li>
                                                                    <li>any other law or regulations of the Commonwealth of
                                                                        Australia, and its
                                                                        States and Territories or any law in any country
                                                                        where the material or
                                                                        information is or will be available electronically
                                                                        to users of this Website; and</li>
                                                                </ol>
                                                            </li>
                                                            <li>that they will not transmit or attempt to transmit any
                                                                computer viruses, worms,
                                                                defects, Trojan horses or other material that is malicious,
                                                                or of a destructive
                                                                nature, or affects the performance or functionality of the
                                                                Website or Services.</li>
                                                        </ol>
                                                        </p>
                                                    </div>



                                                </div>
                                                {{-- end --}}

                                                {{-- 20 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>20.</span>Agent's access to the
                                                        Website</h3>


                                                    <div class="content_align">
                                                        <span>20.1</span>
                                                        <p>
                                                            The Agent agrees that E4U has control over the Agent's use of
                                                            and access to the
                                                            Website, including but not limited to the Agent Console. E4U may
                                                            grant, limit or cancel
                                                            an Agent's access to the Website in its absolute and unfettered
                                                            discretion, at any time
                                                            and without explanation or justification.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>20.2</span>
                                                        <p>
                                                            The Agent agrees that E4U may make record of, and monitor, its
                                                            use of the Website.
                                                            E4U will comply with the Australian Privacy legislation in
                                                            respect to our collection,
                                                            storage and use of your personal information (refer to our full
                                                            privacy policy for details
                                                            of how we collect, store and use your personal information).
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>20.3</span>
                                                        <p>
                                                            The Agent agrees that E4U has the right to make changes to the
                                                            Website, including the
                                                            Agent Console, at its sole discretion, at any time without
                                                            giving any explanation or
                                                            justification for removing the material or information.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>20.4</span>
                                                        <p>
                                                            E4U reserves the right to edit images, text and other content
                                                            and documents provided
                                                            to it by the Agent if they do not fit with the Profile layout,
                                                            or to improve the Advertiser's
                                                            Listing if the Agent or Advertiser authorises such amendment.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>20.5</span>
                                                        <p>
                                                            Subject to clause 20.4 E4U will publish images online in the
                                                            same form as they are
                                                            received from the Agent, unless notified by the Agent or
                                                            Advertiser in writing via email,
                                                            or other nominated form of communication, to do otherwise. If
                                                            the Agent requires that
                                                            images be cropped or blurred the Agent must notify E4U at the
                                                            time of providing those
                                                            images.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>20.6</span>
                                                        <p>
                                                            The Agent understands that any Profile or Tour they create or
                                                            manage for an Advertiser
                                                            will be reviewed and approved by E4U before it will be Listed on
                                                            the Website. E4U may
                                                            ask the Advertiser or Agent (as the case may be) from time to
                                                            time to amend the
                                                            content of the Profile.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>20.7</span>
                                                        <p>
                                                            Without limiting any other rights and remedies available to E4U
                                                            at law or equity or
                                                            statute or under these Terms and Conditions, if the Agent does
                                                            not comply with any
                                                            reasonable request from E4U to amend any details on an
                                                            Advertiser's Profile (the
                                                            determination of which is solely at E4U's discretion) E4U may,
                                                            in its sole discretion,
                                                            refuse to accept any such Profile or, if any such Profile is
                                                            already on the Website, to
                                                            remove that Profile forthwith.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>20.8</span>
                                                        <p>
                                                            E4U may remove any material or information, including but not
                                                            limited to links to other
                                                            sites, or social media platforms, on the Internet, at any time
                                                            without giving any
                                                            explanation or justification for removing the material or
                                                            information.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>20.9</span>
                                                        <p>
                                                            If an Agent's access to the Website is terminated, E4U will
                                                            deactivate that person's
                                                            Agent Console and suspend their name in the Website database.
                                                        </p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 21 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>21.</span>Intellectual property
                                                    </h3>


                                                    <div class="content_align">
                                                        <span>21.1</span>
                                                        <p>
                                                            By uploading on to the Website, or otherwise providing E4U with,
                                                            any material that is
                                                            protected by the Agent's Intellectual Property rights, the Agent
                                                            grants E4U a perpetual,
                                                            non-exclusive and payment-free licence throughout the world to:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>reproduce, use and exploit the Intellectual Property, as
                                                                part of the Website and associated sites, to the full extent
                                                                permitted by Intellectual Property law in any
                                                                jurisdiction in which the Website is available to users; and
                                                            </li>
                                                            <li>allow E4U to sub-licence its service providers the same
                                                                rights granted to us in
                                                                subclause (a) above for the purposes of supplying our
                                                                Services, diagnosing
                                                                problems and improving and protecting the Website.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>21.2</span>
                                                        <p>
                                                            By uploading on to the Website, or otherwise providing E4U with,
                                                            any material that is
                                                            protected by the Advertiser's Intellectual Property rights, the
                                                            Agent represents that it
                                                            has the Advertiser's authority to, and does, grant E4U a
                                                            perpetual, non-exclusive and
                                                            payment-free licence throughout the world to:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>reproduce, use and exploit the Intellectual Property, as
                                                                part of the Website and
                                                                associated sites, to the full extent permitted by
                                                                Intellectual Property law in any
                                                                jurisdiction in which the Website is available to users; and
                                                            </li>
                                                            <li>allow E4U to sub-licence others the same rights granted to
                                                                us in subclause (a)
                                                                above.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>21.3</span>
                                                        <p>
                                                            An Agent agrees and accepts that:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>E4U retains legal and Intellectual Property rights in all
                                                                material or content created
                                                                by E4U; and
                                                            </li>
                                                            <li>E4U's registered and unregistered trade marks form part of
                                                                the Profile design and
                                                                are not to be removed or altered in any form; and
                                                            </li>
                                                            <li>the Agent is not permitted to publish, manipulate,
                                                                distribute or otherwise
                                                                reproduce, in any format, any of the content or copies of
                                                                the content that E4U
                                                                creates in connection with any business or commercial
                                                                enterprise.</li>
                                                        </ol>
                                                        </p>
                                                    </div>



                                                </div>
                                                {{-- end --}}


                                                {{-- 22 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>22.</span>Miscellaneous</h3>


                                                    <div class="content_align">
                                                        <span>22.1</span>
                                                        <p>
                                                            As Agent you consent to receiving electronic communication from
                                                            E4U.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>22.2</span>
                                                        <p>
                                                            Agent's queries regarding the Agent Console, Website, Policies
                                                            or Guidelines should
                                                            be sent to E4U by the nominated medium.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>22.3</span>
                                                        <p>
                                                            An Agent is under no obligation or requirement to agree to these
                                                            Terms and Conditions
                                                            however, in the event the Agent is unwilling or unable to agree
                                                            to the Terms and
                                                            Conditions, then they will be unable to act as Agent and use
                                                            this Website.
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
                <!-- Part E - Media verification -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part E - Media Verification
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 23 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>23.</span>Image Verification
                                                    </h3>
                                                    <p>The Advertisers and Agents acknowledge that:</p>

                                                    <div class="content_align">
                                                        <ol class="level-2">
                                                            <li>E4U provides an optional image verification procedure.
                                                                Advertisers who opt to take part
                                                                in image verification must supply a verification photo
                                                                (<b>Verification Image</b>). The
                                                                Verification Image must show identifying features which
                                                                match the Advertiser's Profile
                                                                photos. An Advertiser must not under any circumstances
                                                                provide false or misleading
                                                                information as part of the image verification service;</li>


                                                            <li>
                                                                some of the identifying features E4U may use are any or all
                                                                of the following (without limitation):
                                                                <ol class="level-3">
                                                                    <li>a photograph showing matching clothing or lingerie
                                                                        from the Advertiser's photo
                                                                        shoot;</li>
                                                                    <li>a photograph showing the Advertiser's facial
                                                                        features;</li>
                                                                    <li>a photograph showing the Advertiser's body which
                                                                        matches the style of the body
                                                                        in the Profile images;</li>
                                                                    <li>a photograph showing matching features such as
                                                                        tattoos;</li>
                                                                    <li>at the option of the Advertiser, a form of
                                                                        documentation which includes a
                                                                        photograph identifying the Advertiser and which
                                                                        shows matching features of the
                                                                        Advertiser to the Profile media, or</li>
                                                                    <li>a passport or drivers licence; and</li>

                                                                </ol>
                                                            </li>
                                                            <p class="mb-3">the Verification Image must also include the
                                                                Advertiser’s name, Membership ID and
                                                                mobile number provided at Registration.</p>
                                                            <li>E4U will only mark a photo with the "E4U Verified" seal, if
                                                                E4U is satisfied (in its
                                                                absolute and sole discretion) that the Verification Image
                                                                supplied by the Advertiser
                                                                closely matches the images submitted in the Profile or the
                                                                Advertiser's Media;</li>
                                                            <li>although E4U uses all reasonable means available to verify
                                                                an Advertiser's photos, E4U
                                                                does not warrant or represent that the Media is true and
                                                                correct;</li>
                                                            <li>E4U does not warrant or represent, and provides no
                                                                guarantee, that the Advertiser that
                                                                a Viewer meets in person is the same person as that shown in
                                                                the Profile images, and
                                                                all Viewers must make their own judgment and undertake their
                                                                own enquiries about
                                                                whether or not to proceed with any meeting with the
                                                                Advertiser; and
                                                            </li>
                                                            <li>image verification only reflects E4U's reasonable opinion
                                                                (after making all reasonable
                                                                enquiries) that the images in a Profile are that of the
                                                                Advertiser, and E4U will not be
                                                                responsible or liable if the images are not those of the
                                                                Advertiser, including Masseurs.
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
                <!-- Part F - Powers and Liability -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part F - Powers and Liability
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 24 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>24.</span>Powers of Escorts4U
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>24.1</span>
                                                        <p>
                                                            Users generally
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>The User agrees that:</p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>E4U at its sole and absolute discretion may refuse, without
                                                                requiring any notice to them, to:
                                                                <ol class="level-3">
                                                                    <li>
                                                                        accept or display any Profile or any other content
                                                                        provided by the User for the Website or otherwise;
                                                                        or
                                                                    </li>
                                                                    <li>allow access to the Website; and</li>
                                                                </ol>
                                                            </li>
                                                            <li>E4U may modify the Website or any aspect of the Service or
                                                                Support Service
                                                                (including, without limitation, the Fees payable from time
                                                                to time) in any way,
                                                                without notice, provided that any such modifications will
                                                                not affect any Listing that
                                                                has already been paid for and is currently active.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 25 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>25.</span>Consumer Law Rights
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>25.1</span>
                                                        <p>
                                                            Certain legislation, including the Australian Consumer Law, and
                                                            similar consumer
                                                            protection laws and regulations, may confer you with rights,
                                                            warranties, guarantees and
                                                            remedies relating to the supply of the Services by E4U which
                                                            cannot be excluded,
                                                            restricted or modified (<b>Consumer Law Rights</b>). To the
                                                            extent that you maintain
                                                            Consumer Law Rights at law, nothing in these Terms and
                                                            Conditions excludes those
                                                            Consumer Law Rights.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>25.2</span>
                                                        <p>
                                                            Subject to your Consumer Law Rights, E4U provides all material,
                                                            work and services
                                                            (including the Services) to you without conditions or warranties
                                                            of any kind, implied or
                                                            otherwise, whether in statute, at law or on any other basis,
                                                            except where expressly set
                                                            out in these Terms and Conditions.
                                                        </p>
                                                    </div>



                                                    <div class="content_align">
                                                        <span>25.3</span>
                                                        <p>
                                                            This clause 25 will survive the termination or expiry of these
                                                            Terms and Conditions.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 26 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>26.</span>Representations and
                                                        Warranties</h3>


                                                    <div class="content_align">
                                                        <span>26.1</span>
                                                        <p>
                                                            The Advertiser and the Viewer acknowledge that E4U is not
                                                            responsible in any way for
                                                            any actions, omissions or negligence on the part of any User of
                                                            the Website and that
                                                            any agreement made between an Advertiser and Viewer as a direct
                                                            or indirect result
                                                            of the provision of Services, is solely and wholly between the
                                                            Advertiser and Viewer and
                                                            not, under any circumstances, with E4U.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>26.2</span>
                                                        <p>
                                                            Users acknowledge and agree that data transmission over the
                                                            internet cannot be
                                                            guaranteed as totally secure. Whilst E4U will use its reasonable
                                                            endeavours to protect
                                                            such information, E4U does not warrant and cannot ensure the
                                                            security of any
                                                            information which is transmitted to E4U. Accordingly, any
                                                            information which a User
                                                            transmits to E4U is transmitted at their own risk, including
                                                            (without limitation) private
                                                            email addresses, personal information and images. E4U takes
                                                            reasonable steps to
                                                            preserve the security of such information and images, but will
                                                            not be held responsible
                                                            if the information or images become public, under any
                                                            circumstances, except to the
                                                            extent caused by E4U’s own negligence.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>26.3</span>
                                                        <p>
                                                            To the maximum extent permitted by law, E4U gives no warranty as
                                                            to accuracy,
                                                            suitability or functionality of the Website or the Services. The
                                                            User acknowledges that
                                                            from time to time there may be faults, defects and errors with
                                                            the Website and they will
                                                            not hold E4U responsible in this regard.
                                                        </p>
                                                    </div>




                                                </div>
                                                {{-- end --}}

                                                {{-- 27 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>27.</span>Liability
                                                    </h3>


                                                    <div class="content_align">
                                                        <span>27.1</span>
                                                        <p>
                                                            To the maximum extent permitted by law, E4U is not liable for
                                                            any Consequential Loss
                                                            arising out of or in connection with the Services or the
                                                            Website.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>27.2</span>
                                                        <p>
                                                            Each party's liability will be reduced proportionately where the
                                                            loss was caused or
                                                            contributed to by the other party's acts, omissions or failure
                                                            to mitigate their losses.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>27.3</span>
                                                        <p>
                                                            The Advertiser and Viewer acknowledge that certain risks might
                                                            arise from any contract,
                                                            agreement or arrangement between an Advertiser and a Viewer for
                                                            the supply of escort
                                                            or other services including, but not limited to:
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>injury;
                                                            </li>
                                                            <li>death;
                                                            </li>
                                                            <li>permanent disability;</li>
                                                            <li>sexually transmitted diseases;</li>
                                                            <li>defamation;</li>
                                                            <li>theft;</li>
                                                            <li>rape or other indecent assault;</li>
                                                            <li>harassment;</li>
                                                            <li>stalking;</li>
                                                            <li>bullying;</li>
                                                            <li>suicide; and</li>
                                                            <li>misconduct,</li>
                                                        </ol>
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <p class="pl-5">
                                                            (together, the <b>Risks</b>)
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>27.4</span>
                                                        <p>
                                                            Advertisers and Viewers acknowledge and accept that they assume
                                                            all responsibility
                                                            and liability for the Risks and release and discharge E4U from
                                                            any and all claims,
                                                            demands, losses, costs, outgoings and liabilities of any nature
                                                            arising from the Risks.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>27.5</span>
                                                        <p>
                                                            To the maximum extent permitted by law, the aggregate liability
                                                            of E4U to the Advertiser
                                                            or Viewer or any other party who may have a claim against E4U in
                                                            respect of the
                                                            Website and/or the Services, whether in contract, tort
                                                            (including negligence) or
                                                            otherwise, shall be limited to the price paid by the Advertiser
                                                            or Viewer (if any) for the
                                                            specific Service or Product to which the claim relates, or where
                                                            no amount was paid,
                                                            then $100.00.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>27.6</span>
                                                        <p>
                                                            This clause 27 will survive the termination or expiry of these
                                                            Terms and Conditions
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}


                                                {{-- 28 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>28.</span>Termination</h3>


                                                    <div class="content_align">
                                                        <span>28.1</span>
                                                        <p>
                                                            E4U may terminate a User's access to the Website and these Terms
                                                            and Conditions
                                                            by providing written notice to the User if:
                                                        </p>
                                                    </div>


                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>the User has breached these Terms and Conditions, the
                                                                Acceptable Usage Policy
                                                                or any other relevant Policy and has not remedied that
                                                                breach within 14 days of
                                                                written notice from E4U requiring the breach to be remedied;
                                                            </li>
                                                            <li>the User has breached these Terms and Conditions and that
                                                                breach cannot be
                                                                remedied; or</li>
                                                            <li>E4U is required to do so by law.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>28.2</span>
                                                        <p>
                                                            E4U may immediately terminate a User's access to the Website
                                                            without notice if:
                                                        </p>
                                                    </div>
                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>the User has engaged in fraudulent, illegal or criminal
                                                                conduct in connection with
                                                                the Website or Services;</li>
                                                            <li>the User has engaged in conduct that in E4U's reasonable
                                                                opinion brings E4U or
                                                                the Website into disrepute; or</li>
                                                            <li>the User poses a risk to the safety or well being of any
                                                                other User.</li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>28.3</span>
                                                        <p>
                                                            E4U reserves the right to amend, terminate or cancel any Profile
                                                            if:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>a complaint about the Advertiser is received from any Viewer
                                                                or third party and
                                                                E4U, acting reasonably, considers the complaint to have
                                                                merit, in which case
                                                                E4U will provide written notice to the Advertiser;</li>
                                                            <li>the Advertiser is asked to provide Image Verification and
                                                                fails to do so, or the
                                                                Image Verification fails, in which case E4U will provide
                                                                written notice to the
                                                                Advertiser;</li>
                                                            <li>a third party takes any action against E4U for any act,
                                                                omission or negligence on
                                                                the part of the Advertiser or Agent;</li>
                                                            <li>in the reasonable view of E4U, the Advertiser or Agent has
                                                                engaged in deceptive
                                                                or misleading advertising or conduct;</li>
                                                            <li>in the reasonable view of E4U, the Advertiser or the
                                                                Advertiser’s appointed Agent,
                                                                is bringing E4U or the Website into disrepute;</li>
                                                            <li>in the reasonable view of E4U, the Advertiser is working for
                                                                or represents an
                                                                Escort Agency, contrary to these Terms and Conditions;</li>
                                                            <li>any form of the Advertiser's media containing an E4U
                                                                Verification Certificate is
                                                                found on the website of an Escort Agency; or</li>
                                                            <li>the Advertiser's images are found on any third party website
                                                                containing the E4U
                                                                Verification Certificate, or in the reasonable view of E4U,
                                                                the ownership of any
                                                                image is in doubt.</li>
                                                        </ol>
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>28.4</span>
                                                        <p>
                                                            Upon termination:
                                                        </p>
                                                    </div>
                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>E4U will remove the User's access to the Website; and</li>
                                                            <li>where applicable, the Advertiser authorises E4U to debit
                                                                their nominated payment
                                                                method for any outstanding Fees owed to E4U at the time of
                                                                termination.</li>
                                                        </ol>
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>28.5</span>
                                                        <p>
                                                            The obligations of the User under any clause of these Terms and
                                                            Conditions survive
                                                            the termination of this agreement.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>28.6</span>
                                                        <p>
                                                            Termination of these Terms and Conditions will not affect any
                                                            other rights or liabilities
                                                            that E4U or the User may have at the time of termination.
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

                <!-- Part G - Concierge Services -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title" id="mobile-sim">
                        Part G - Concierge Services
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 29 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>29.</span>Concierge Services
                                                        Generally
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>29.1</span>
                                                        <p>
                                                            E4U may offer Advertisers access to a range of concierge
                                                            services through the
                                                            Advertiser Console as set out in this Part G (<b>Concierge
                                                                Services</b>). Concierge Services
                                                            are optional and are in addition to the advertising Services
                                                            provided under these Terms
                                                            and Conditions.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>29.2</span>
                                                        <p>
                                                            Fees for Concierge Services and Products are as displayed on the
                                                            Website at the time
                                                            of purchase and must be paid in full at the time of ordering
                                                            through the Advertiser
                                                            Console.

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>29.3</span>
                                                        <p>
                                                            Payment methods for Concierge Services are as set out on the
                                                            Website. Where
                                                            payment is processed through a third party payment provider,
                                                            that provider's terms and
                                                            conditions will also apply.

                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>29.4</span>
                                                        <p>
                                                            Unless otherwise required by the Australian Consumer Law, no
                                                            refunds or exchanges
                                                            are available for any Concierge Services or Products purchased
                                                            through the Website.

                                                        </p>
                                                    </div>


                                                </div>
                                                {{-- end --}}

                                                {{-- 30 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>30.</span>Mobile SIM Cards
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>30.1</span>
                                                        <p>
                                                            E4U resells prepaid mobile SIM cards through the Advertiser
                                                            Console. E4U is a reseller
                                                            only and is not the network provider or supplier of the SIM card
                                                            or associated mobile
                                                            services.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>30.2</span>
                                                        <p>
                                                            By purchasing a SIM card through the Advertiser Console, the
                                                            Advertiser acknowledges that:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>the SIM card and associated mobile services are provided by
                                                                a third party
                                                                network provider whose terms and conditions will apply to
                                                                the use of those
                                                                services;</li>
                                                            <li>E4U is not responsible for the quality, availability or
                                                                performance of the mobile
                                                                network or services; and
                                                            </li>
                                                            <li>
                                                                no refunds or exchanges are available for SIM card purchases
                                                                except as required
                                                                by the Australian Consumer Law.
                                                            </li>

                                                        </ol>
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>30.3</span>
                                                        <p>
                                                            SIM cards will be dispatched to your nominated delivery address.
                                                            Delivery time frames
                                                            are estimates only and we are not liable for delays outside our
                                                            reasonable control.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>30.4</span>
                                                        <p>
                                                            Risk in the SIM card passes to you upon delivery to your
                                                            nominated delivery address.
                                                        </p>
                                                    </div>


                                                </div>
                                                {{-- end --}}

                                                {{-- 31 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>31.</span>Email Hosting</h3>


                                                    <div class="content_align">
                                                        <span>31.1</span>
                                                        <p>
                                                            E4U may provide Advertisers with access to a dedicated email
                                                            address in the format
                                                            <a href="mailto:yourname@e4u.com.au">(MemberID)@e4u.com.au</a>
                                                            for a fee as displayed on the Website.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>31.2</span>
                                                        <p>
                                                            Access to the E4U Email is provided for the duration of the
                                                            Advertiser's active
                                                            Membership. If the Advertiser's Membership is cancelled or
                                                            terminated for any reason,
                                                            access to the E4U Email will cease and E4U is not responsible
                                                            for any loss of data or
                                                            communications.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>31.3</span>
                                                        <p>
                                                            The Advertiser must not use the E4U Email for any unlawful
                                                            purpose or in breach of
                                                            these Terms and Conditions.
                                                        </p>
                                                    </div>




                                                </div>
                                                {{-- end --}}

                                                {{-- 32 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>32.</span>Products
                                                    </h3>


                                                    <div class="content_align">
                                                        <span>32.1</span>
                                                        <p>
                                                            E4U sells adult products to Advertisers through the Website
                                                            (<b>Products</b>).
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>32.2</span>
                                                        <p>
                                                            All orders are subject to availability.
                                                        </p>
                                                    </div>




                                                    <div class="content_align">
                                                        <span>32.3</span>
                                                        <p>
                                                            We will deliver Products in accordance with the delivery terms
                                                            displayed on the Website
                                                            at the time of ordering. Delivery time frames are estimates only
                                                            and we are not liable
                                                            for delays outside our reasonable control.
                                                        </p>
                                                    </div>



                                                    <div class="content_align">
                                                        <span>32.4</span>
                                                        <p>
                                                            Risk in the Products passes to you upon delivery to your
                                                            nominated delivery address.
                                                            We retain title to the Products until payment is received in
                                                            full.
                                                        </p>
                                                    </div>



                                                </div>
                                                {{-- end --}}


                                                {{-- 33 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>33.</span>Visa and Migration
                                                        Services</h3>


                                                    <div class="content_align">
                                                        <span>33.1</span>
                                                        <p>
                                                            E4U may refer Advertisers to PEAMS for visa and migration
                                                            services. E4U does not
                                                            provide visa or migration services and any engagement with PEAMS
                                                            is solely between
                                                            the Advertiser and PEAMS.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>33.2</span>
                                                        <p>
                                                            E4U is not a party to any such arrangement and is not
                                                            responsible for any advice,
                                                            services or outcomes provided by PEAMS.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}


                                                {{-- 34 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>34.</span>Accommodation and Travel
                                                        Booking Services</h3>


                                                    <div class="content_align">
                                                        <span>34.1</span>
                                                        <p>
                                                            E4U intends to offer accommodation and travel booking services
                                                            to Advertisers through the
                                                            Advertiser Console in the future. Details of these services,
                                                            including applicable fees and
                                                            terms, will be published on the Website when available.
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

                <!-- Part H - Influencer -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part H - Influencer
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">
                                                {{-- 35 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>35.</span>Terms and Conditions
                                                    </h3>
                                                    <p>E4U may offer an Influencer Program to eligible Users. If you wish to
                                                        participate in the
                                                        Influencer Program, you must agree to the separate Influencer Terms
                                                        and Conditions, which
                                                        will be provided to you at the time of application.
                                                    </p>
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

                <!-- Part I - My Playbox -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part I - My Playbox
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">
                                                {{-- 36 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>36.</span>The Service</h3>
                                                    <p>
                                                        We are excited to announce that My Playbox, an adult content
                                                        streaming service for
                                                        Advertisers, is coming soon. We will update these Terms and
                                                        Conditions when this service
                                                        becomes available. See ‘About’ for more information about how the My
                                                        Playbox service will
                                                        be delivered.
                                                    </p>
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

                <!-- Part J - General -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part J - General
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <div class="content_wrapper influencer-modal p-4">


                                                {{-- 37 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>37.</span>Links to Other Websites
                                                    </h3>
                                                    <div class="content_align">
                                                        <span>37.1</span>
                                                        <p>
                                                            E4U may from time to time provide on the Website links to other
                                                            websites for the User's
                                                            convenience. This does not imply sponsorship, endorsement,
                                                            approval or any arrangement
                                                            between E4U and the owners of those other websites. Third party
                                                            websites are not under
                                                            E4U's control and E4U takes no responsibility for any content or
                                                            material found on any linked
                                                            websites.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 38 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>38.</span>Assignment
                                                    </h3>

                                                    <div class="content_align">
                                                        <span>38.1</span>
                                                        <p>
                                                            E4U may at any time assign all or any of its rights and
                                                            liabilities arising under these
                                                            Terms and Conditions.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>38.2</span>
                                                        <p>
                                                            A User is not entitled to assign or purport to assign any of its
                                                            rights or liabilities under
                                                            these Terms and Conditions without the prior written consent of
                                                            E4U (which consent
                                                            may be given or withheld or given subject to conditions in
                                                            absolute discretion of E4U).
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 39 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>39.</span>Acceptable Usage Policy,
                                                        Legal Statements and Policies</h3>


                                                    <div class="content_align">

                                                        <p>
                                                            Users agree that the Legal Statements, Policies and Guidelines
                                                            contained within the Website
                                                            form part of these Terms and Conditions and if there is any
                                                            conflict between these Terms and
                                                            Conditions and the Policies, then these Terms and Conditions
                                                            will prevail to the extent of any
                                                            inconsistency.
                                                        </p>
                                                    </div>

                                                </div>
                                                {{-- end --}}

                                                {{-- 40 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>40.</span>Discrimination Policy
                                                    </h3>


                                                    <div class="content_align">
                                                        <span>40.1</span>
                                                        <p>
                                                            Application
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span></span>
                                                        <p>
                                                            This policy applies to all users of the Website, Advertisers,
                                                            Viewers, Services and the
                                                            Website.
                                                        </p>
                                                    </div>




                                                    <div class="content_align">
                                                        <span>40.2</span>
                                                        <p>
                                                            Discrimination
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>E4U takes seriously its responsibility to comply with all
                                                                anti-discrimination laws.</li>
                                                            <li>E4U has taken all reasonable steps to ensure it is at all
                                                                times complying with all
                                                                anti-discrimination laws, and that the Services do not
                                                                portray people or depict
                                                                material in a way which discriminates against or vilifies a
                                                                person or section of the
                                                                community on account of race, ethnicity, nationality,
                                                                gender, age, sex, sexual
                                                                orientation, transgender status, marital status, family
                                                                responsibilities, religion,
                                                                disability or impairment, mental illness, political belief
                                                                or activity, religious belief
                                                                or activity, breast feeding or any other attribute
                                                                identified under State, Territory
                                                                or Federal anti-discrimination or human rights legislation,
                                                                or personal association
                                                                with a person with the attributes identified.
                                                            </li>
                                                            <li>
                                                                If an Advertiser or Viewer believes that any aspect of the
                                                                Website or the Services
                                                                contravenes any anti-discrimination laws, they should bring
                                                                the alleged breach
                                                                to the attention of E4U and request that E4U resolve the
                                                                issue.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>40.3</span>
                                                        <p>
                                                            Compliance by Advertisers
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>
                                                                Advertisers must comply with all State, Territory and
                                                                Federal anti-discrimination
                                                                laws which may affect them.
                                                            </li>
                                                            <li>
                                                                if an Advertiser is found to be in breach of any
                                                                anti-discrimination law(including
                                                                but not limited to an Advertiser's Profile or their conduct
                                                                breaches any
                                                                anti-discrimination law) E4U reserves the right to
                                                                immediately cancel the
                                                                Membership without refund (except as required at law) and
                                                                any Profile or Tour will
                                                                be immediately removed from the Website.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>


                                                </div>
                                                {{-- end --}}


                                                {{-- 41 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>41.</span>Unforeseen Circumstances
                                                    </h3>


                                                    <div class="content_align">

                                                        <p>
                                                            E4U will not be responsible for any failure to perform due to
                                                            unforeseen circumstances or to
                                                            causes beyond our reasonable control, including but not limited
                                                            to acts of God, war, riot,
                                                            embargoes, acts of civil or military authority, or terrorism,
                                                            fire, flood, earthquakes, hurricanes,
                                                            tropical storms or other natural disasters, pandemics, fibre
                                                            cuts, strikes, or shortages in
                                                            transportation, facilities, fuel, energy, labour or materials,
                                                            failure of the telecommunications
                                                            or information services infrastructure, hacking, SPAM, or any
                                                            failure of a computer, server
                                                            or software, including errors or omissions, for so long as such
                                                            event continues to delay the
                                                            Websites performance.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 42 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>42.</span>General</h3>


                                                    <div class="content_align">
                                                        <span>42.1</span>
                                                        <p>
                                                            Disputes with E4U
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <p class="pl-5">
                                                            Neither party may commence court proceedings relating to any
                                                            dispute arising from or
                                                            in connection with these Terms and Conditions (<b>Dispute</b>)
                                                            without first meeting a
                                                            representative of the other party within 14 days of notifying
                                                            that other party of the
                                                            Dispute in writing. Nothing in this clause prevents either party
                                                            from seeking urgent
                                                            injunctive or equitable relief from a court of appropriate
                                                            jurisdiction. If the Dispute is not
                                                            resolved at that initial meeting, the parties must refer the
                                                            matter to mediation
                                                            administered by Resolution Institute Australia in accordance
                                                            with the Resolution
                                                            Institute Mediation Rules before commencing court proceedings.
                                                        </p>
                                                    </div>


                                                    <div class="content_align">
                                                        <span>42.2</span>
                                                        <p>
                                                            Disputes between Advertisers and Viewers
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            E4U encourages Advertisers and Viewers to attempt to resolve any
                                                            disputes directly
                                                            and in good faith. E4U is not a party to any dispute between an
                                                            Advertiser and a
                                                            Viewer, is not responsible for mediating or resolving any such
                                                            dispute and has no
                                                            obligation to participate in or contribute to its resolution. In
                                                            the event that a dispute
                                                            between an Advertiser and a Viewer cannot be resolved directly,
                                                            the parties may
                                                            choose to resolve the dispute through mediation or other means
                                                            at their own cost.
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>42.3</span>
                                                        <p>
                                                            Clauses 42.1 and 42.2 will survive termination or expiry of
                                                            these Terms and Conditions.
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}

                                                {{-- 43 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>43.</span>Severability</h3>


                                                    <div class="content_align">
                                                        <span>43.1</span>
                                                        <p>
                                                            If a provision of these Terms and Conditions is held to be
                                                            invalid or unenforceable in
                                                            whole or in part, the provision is ineffective only to the
                                                            extent of the invalidity or
                                                            unenforceability and the validity or enforceability of all other
                                                            provisions of the Terms and
                                                            Conditions.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>43.2</span>
                                                        <p>
                                                            Notices
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            A party may validly give a notice to another party only by:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>personally serving the notice on the other party (the notice
                                                                is treated as received
                                                                at the time of service of the notice); or
                                                            </li>
                                                            <li>emailing the notice to the email address of the other party
                                                                and the email will be
                                                                deemed to have been received within 24 hours of the time
                                                                that the email is sent,
                                                                as long as the sender has not received a notice that the
                                                                email was unable to the
                                                                sent, or delivered.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>
                                                    <div class="content_align">
                                                        <span>43.3</span>
                                                        <p>
                                                            Governing law and jurisdiction
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            The law of Western Australia governs these Terms and Conditions
                                                            and Users submit
                                                            themselves to the jurisdiction of the courts of that State to
                                                            determine any dispute arising
                                                            out of the Website and these Terms and Conditions.
                                                        </p>
                                                    </div>

                                                    <div class="content_align">
                                                        <span>43.4</span>
                                                        <p>
                                                            Waiver
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            Waiver of a breach of, or default under, these Terms and
                                                            Conditions or of any right,
                                                            power, authority, discretion or remedy created or arising upon a
                                                            breach of, or default
                                                            under, these Terms and Conditions:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="level-2 pl-5">
                                                            <li>is not waived by any failure to exercise or delay in
                                                                exercising or partial exercise
                                                                of any right, power, authority, discretion or remedy under
                                                                these Terms and
                                                                Conditions; and
                                                            </li>
                                                            <li>must be in writing and signed by the party granting the
                                                                waiver.
                                                            </li>
                                                        </ol>
                                                        </p>
                                                    </div>
                                                </div>
                                                {{-- end --}}


                                                {{-- 44 --}}
                                                <div class="content_details">
                                                    <h3 class="mb-3 content_align"><span>44.</span>Definitions and
                                                        Interpretation</h3>


                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            Definitions
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p class="pl-5">
                                                            In these Terms and Conditions unless the contrary intention
                                                            appears or the context
                                                            otherwise requires:
                                                        </p>
                                                    </div>

                                                    <div class="content_align">

                                                        <p>
                                                        <ol class="pl-1" style="list-style-type: none">
                                                            <li>
                                                                <b>Acceptable Usage Policy</b> means the Acceptable Usage
                                                                Policy which governs the use
                                                                of the Website and which is set out in the footer of the
                                                                Website under the heading
                                                                "Legal";
                                                            </li>
                                                            <li>
                                                                <b>Account</b> means the account created by a User upon
                                                                registration on the Website;
                                                            </li>
                                                            <li>
                                                                <b>Advertiser</b> means either of or collectively an Escort
                                                                or Massage Centre who advertise
                                                                on the Website and has requested the Services of E4U in
                                                                respect to the provision of
                                                                a Profile or Concierge Services or Support Services and in
                                                                accordance with these
                                                                Terms and Conditions. Where the Advertiser appoints an Agent
                                                                to act for them on their
                                                                behalf, a reference to the Advertiser includes a reference
                                                                to their Agent;
                                                            </li>
                                                            <li>
                                                                <b>Advertiser Console</b> means the Advertiser's information
                                                                management tool on the
                                                                Website that visually displays an Advertiser's Account
                                                                details;
                                                            </li>
                                                            <li>
                                                                <b>Advertising Request</b> means a request to List a Profile
                                                                or Tour on the Website by an
                                                                Advertiser;
                                                            </li>
                                                            <li>
                                                                <b>Agent</b> means a person or entity provided by E4U to
                                                                support an Advertiser in their use
                                                                of the Website, who has been granted access to the Website
                                                                in accordance with these
                                                                Terms and Conditions;
                                                            </li>
                                                            <li>
                                                                <b>Agent Console</b> means the Agent information management
                                                                tool on the Website that
                                                                visually displays an Agent's account details and enables
                                                                access to the applications for
                                                                the Agent to manage Advertisers;
                                                            </li>
                                                            <li>
                                                                <b>Classification Laws</b> means all laws and regulations
                                                                applicable to the classification of
                                                                content in the relevant State or Territory in which the
                                                                Website is accessed;
                                                            </li>
                                                            <li>
                                                                <b>Concierge Services</b> means any of or all of the
                                                                concierge services provided by E4U to
                                                                an Advertiser on the Website as set out in Part G of these
                                                                Terms and Conditions;
                                                            </li>
                                                            <li>
                                                                <b>Consequential Loss</b> means any consequential loss,
                                                                special or indirect loss, real or
                                                                anticipated loss of profit, loss of benefit, loss of
                                                                revenue, loss of business, loss of
                                                                goodwill, loss of opportunity, loss of savings, loss of
                                                                reputation, loss of use and/or loss
                                                                or corruption of data, whether under statute, contract,
                                                                equity, tort (including negligence),
                                                                indemnity or otherwise. However, your obligation to pay us
                                                                any amounts for access to
                                                                or use of our Services (including our Website) will not
                                                                constitute Consequential Loss;
                                                            </li>
                                                            <li>
                                                                <b>Consumer Law Rights</b> has the meaning given in clause
                                                                24.1;
                                                            </li>
                                                            <li>
                                                                <b>E4U</b> and <b>Escorts4U</b> refers to the trading entity
                                                                of Blackbox Tech Pty Ltd ACN 664 919
                                                                975, the owner of the Website;
                                                            </li>
                                                            <li>
                                                                <b>E4U Email</b> means the dedicated email address in the
                                                                format [Member ID]@e4u.com.au
                                                                provided to an Advertiser as part of the Email Hosting
                                                                service under clause 30;
                                                            </li>
                                                            <li>
                                                                <b>E4U Verification Certificate</b> means the seal placed on
                                                                an Advertiser's Media
                                                                confirming the Media has been verified by E4U as being
                                                                authentic;
                                                            </li>
                                                            <li>
                                                                <b>Escort</b> means a person who works as a private escort,
                                                                offers companionship and time
                                                                to other people and does not work in or for an Escort
                                                                Agency. Where the Escort
                                                                appoints an Agent to act for them or on their behalf, a
                                                                reference to the Escort includes
                                                                a reference to their Agent;
                                                            </li>
                                                            <li>
                                                                <b>Escort Agency</b> means a business which facilitates or
                                                                arranges for the provision of
                                                                sexual services to persons at premises made available by the
                                                                said agency;
                                                            </li>
                                                            <li>
                                                                <b>Fees</b> means the fees which are set out on the Website
                                                                (as amended from time to time)
                                                                and which are payable by the Advertiser for posting a
                                                                Profile or Tour on the Website
                                                                or taking up any of the Concierge Services or Support
                                                                Services;
                                                            </li>
                                                            <li>
                                                                <b>GST</b> means any tax, levy, charge, or impost
                                                                implemented under the GST Act;
                                                            </li>
                                                            <li>
                                                                <b>GST Act</b> means the <i>A New Tax System (Goods and
                                                                    Services Tax) Act 1999</i> (Cth) or
                                                                an Act of the Parliament of the Commonwealth of Australia
                                                                substantially in the form of
                                                                or which has a similar effect to the GST Act;
                                                            </li>
                                                            <li>
                                                                <b>Home State</b> means the State in which the User resides;
                                                            </li>
                                                            <li>
                                                                <b>Legal Statements</b> means the collective of any, either
                                                                or all of the statements set out
                                                                in the Website footer under the heading Legal;
                                                            </li>
                                                            <li>
                                                                <b>Local Laws</b> means all laws, regulations and codes
                                                                applicable to the advertising and
                                                                provision of escort, sex work or massage services in the
                                                                relevant State, Territory or
                                                                country;
                                                            </li>
                                                            <li>
                                                                <b>Location</b> means a State, other than the Home State,
                                                                that an Escort is, at the time,
                                                                located in;
                                                            </li>
                                                            <li>
                                                                <b>Loyalty Program</b> means the loyalty program offered by
                                                                E4U to Advertisers from time
                                                                to time, details of which are set out on the Website;
                                                            </li>
                                                            <li>
                                                                <b>Massage Centre</b> means a registered business or
                                                                incorporated body pursuant to the
                                                                <i>Corporations Act 2001</i> (Cth) which operates as a
                                                                Massage Centre and has Membership
                                                                with E4U and accesses the Website in accordance with these
                                                                Terms and Conditions.
                                                                Where the Massage Centre appoints an Agent to act for them
                                                                or on their behalf, a
                                                                reference to the Massage Centre includes a reference to
                                                                their Agent;
                                                            </li>
                                                            <li>
                                                                <b>Masseur</b> means a person who works in a Massage Centre
                                                                and whose information is
                                                                incorporated into and forms a part of the Massage Centre's
                                                                Profile;
                                                            </li>
                                                            <li>
                                                                <b>Media</b> means any photographs, videos, images or other
                                                                visual or audio content
                                                                uploaded to the Website by a User;
                                                            </li>
                                                            <li>
                                                                <b>Member</b> and <b>Membership</b> means a User who has
                                                                completed Registration on the
                                                                Website and whose Membership has not been suspended or
                                                                cancelled;
                                                            </li>
                                                            <li>
                                                                <b>Policies</b> means either or both of Community or Legal
                                                                information referred to as a Policy
                                                                or that has the header 'Policy' contained in the footer of
                                                                the Website under the
                                                                respective headings;
                                                            </li>
                                                            <li>
                                                                <b>Privacy Policy</b> means E4U's privacy policy as
                                                                published on the Website from time to
                                                                time;
                                                            </li>
                                                            <li>
                                                                <b>Products</b> means products sold by E4U through the
                                                                Website as set out in clause 31;
                                                            </li>
                                                            <li>
                                                                <b>Profile</b> means a web page containing information
                                                                advertising the services of an Escort
                                                                or a Massage Centre which is Listed on the Website;
                                                            </li>
                                                            <li>
                                                                <b>Refund Policy</b> means E4U's refund policy as published
                                                                on the Website from time to
                                                                time;
                                                            </li>
                                                            <li>
                                                                <b>Registration</b> means the process undertaken on the
                                                                Website by a User requesting
                                                                Membership;
                                                            </li>
                                                            <li>
                                                                <b>Related Entity, Related Party</b> or <b>Associated
                                                                    Entity</b> has the same meaning as
                                                                ascribed to each of those terms pursuant to the
                                                                <i>Corporations Act 2001</i> (Cth);
                                                            </li>
                                                            <li>
                                                                <b>Risks</b> has the collective meaning ascribed under
                                                                clause 26.3;
                                                            </li>
                                                            <li>
                                                                <b>Services</b> means all of the services provided by E4U to
                                                                an Advertiser and Viewer
                                                                pursuant to these Terms and Conditions, including the
                                                                Concierge Services and Support
                                                                Services, and includes digital and online services to
                                                                advertise escort services through
                                                                a Profile, including websites, applications, email and
                                                                social media;
                                                            </li>
                                                            <li>
                                                                <b>Spam Policy</b> means E4U's spam policy as published on
                                                                the Website from time to time;
                                                            </li>
                                                            <li>
                                                                <b>Support Services</b> means services provided to an
                                                                Advertiser by E4U or an Agent in
                                                                relation to the Services;
                                                            </li>
                                                            <li>
                                                                <b>Terms and Conditions</b> means these terms and conditions
                                                                as amended from time to
                                                                time in accordance with clause 2.2, and which also
                                                                incorporates the Policies and Legal
                                                                Statements;
                                                            </li>
                                                            <li>
                                                                <b>Tour</b> means a series of linked Profiles posted by an
                                                                Escort across multiple Locations
                                                                over a nominated period of time, representing the Escort's
                                                                touring schedule;
                                                            </li>
                                                            <li><b>User</b> means either of or collectively an Advertiser,
                                                                Agent or Viewer;</li>
                                                            <li><b>Viewer</b> means a person who has completed Registration,
                                                                is not an Advertiser or Agent,
                                                                and accesses the Website;</li>
                                                            <li>
                                                                <b>Website</b> means the websites <a
                                                                    href="https://www.e4u.com.au/">www.e4u.com.au</a> and
                                                                <a
                                                                    href="https://www.escorts4u.com.au/">www.escorts4u.com.au</a>
                                                                or such
                                                                other website or social media platforms operated by E4U from
                                                                time to time from which
                                                                the Services are provided.
                                                            </li>
                                                        </ol>
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



                <!-- Changes to these Terms and Conditions -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Changes to these Terms and Conditions
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions') }}">Terms
                                                    and Conditions</a> from time to time to review the most current
                                                version.
                                            </p>
                                            <p>
                                                Escorts4U archives all previous versions of the Terms and Conditions
                                            </p>
                                            <p><b>This policy was last updated 03-06-2025</b></p>
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
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash;

            if (hash === '#mobile-sim') {
                const trigger = document.querySelector(hash); // #mobile-sim

                if (trigger) {
                    // Find the accordion wrapper
                    const accordionWrapper = trigger.closest('.cms-accordion');

                    if (accordionWrapper) {
                        const content = accordionWrapper.querySelector('.content');

                        if (content) {
                            // Show the content (accordion open)
                            content.style.display = 'block';

                            // Optionally, add an 'active' class
                            trigger.classList.add('active');

                            // Scroll to it smoothly
                            trigger.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }
                }
            }
        });
    </script>
@endpush
