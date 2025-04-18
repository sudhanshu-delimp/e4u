@extends('layouts.tnc')
@section('style')
    <style>
        .cms-page-title {
            font-family: Poppins;
            font-style: normal;
            font-weight: bold;
            font-size: 48px;
            line-height: 48px;
            color: #0C223D;
            margin-bottom: 50px;
        }

        .cms-h2 {
            font-family: Poppins;
            font-weight: 500;
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
        .cms-paragraph, .cms-list-paragraph {
            font-size: 16px;
            line-height: 27.5px;
            font-weight: normal;
        }
    </style>
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
            <h1 class="cms-page-title">Terms & Conditions</h1>
            <div class="accordion-container">
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part A - Introduction
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class="cms-list-item"><span class="cms-list-span"><b>1.</b></span>
                                                    <b>Ownership</b>
                                                </li>
                                                <li class="cms-list-item"> <span class="pl-4">This Website is owned and operated by Blackbox Tech Pty Ltd ACN: 664 919 975,
                                who is referred to in these Terms and Conditions as E4U, Escorts4U, we, us, our and
                                similar grammatical forms.</span>
                                                </li>
                                                <li class="cms-list-item"><span class="cms-list-span"><b>2.</b></span>
                                                    <b>Agreement to these terms and conditions</b></li>
                                                <!-- level 2 list -->
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">2.1</span>Every
                                                        User of this Website, whether an Advertiser or Agent who submits
                                                        an
                                                        Advertising Request, and every Viewer who accesses this Website,
                                                        agrees to
                                                        these Terms and Conditions.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">2.2</span>By
                                                        accessing, using, printing, installing, or downloading any
                                                        material from the Website, or becoming a Member of the Website,
                                                        a User agrees to be bound by these Terms and Conditions. If a
                                                        User:
                                                    </li>
                                                    <!-- level 3 list -->
                                                    <ol type="1" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>uses
                                                            the Website, including where the Website has been amended
                                                            since
                                                            they were last logged onto the Website, constitutes their
                                                            acknowledgment
                                                            and acceptance of these Terms and Conditions and any
                                                            amendment
                                                            thereof; and
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>does
                                                            not agree to be bound by the Terms and Conditions, they may
                                                            not
                                                            enter the Website and must exit the Website immediately
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class="cms-list-item"><span class="cms-list-span"><b>3.</span>Geo-Location</b></li>
                                                <li class="cms-list-item"> <span class="pl-4"> Every User consents to E4U using Geolocation technology to identify
                                                    the User’s
                                                    Home State during Registration or when undertaking a Profile search.
                                                </li>
                                                <li class="cms-list-item"><span class="cms-list-span"><b>4.</span>The
                                                    Services</b></li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item"><span class="cms-list-span">4.1</span>E4U
                                                        provides the Services and the Advertiser, Viewer or Agent
                                                        accepts the
                                                        Services pursuant to the Terms and Conditions.
                                                    </li>
                                                    <li class="cms-list-item"><span class="cms-list-span">4.2</span>The
                                                        Website is available for you to:
                                                    </li>
                                                </ol>
                                                <ol type="1" class="cms-lvl1-list">
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span> access conditional on
                                                            your acceptance without alteration of the terms and
                                                            conditions set out below, including our policies and
                                                            guidelines. By continuing to access the Website you are
                                                            agreeing to these Terms and Conditions.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>upload material or
                                                            information conditional on your acceptance without
                                                            alteration of these Terms and Conditions set out below. By
                                                            continuing to
                                                            provide, upload material or information about your services
                                                            you are
                                                            agreeing to the Terms of Use related to uploading material
                                                            or information
                                                            to our Website.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class="cms-list-item"><span class="cms-list-span"><b>5.</span>Restricted
                                                    Use</b></li>
                                            </ol>
                                            <ol type="1" class="cms-list cms-lvl2">
                                                <li class="cms-list-item"><span class="cms-list-span">(a)</span>Except
                                                    for the limited use set out in clause 3 you may not use the Website,
                                                    or
                                                    the material contained on it, for any purpose. This involves:
                                                </li>
                                            </ol>
                                            <ol type="1" class="cms-lvl1-list">
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">(i)</span>the
                                                        reproduction of the material in any material form;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(ii)</span>the
                                                        distribution of the material in any material form;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(iii)</span>re-transmission
                                                        of the material by any medium of communication;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(iv)</span>uploading
                                                        or reposting the material to any other site on the Internet; and
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(v)</span>“framing”
                                                        the material on the Website with other material on any other
                                                        website.
                                                    </li>
                                                    <li class="cms-list-item ">The above are unlawful and are
                                                        specifically prohibited by these Terms and Conditions.
                                                    </li>
                                                </ol>
                                            </ol>
                                            <ol type="1" class="cms-list cms-lvl2">
                                                <li class="cms-list-item"><span class="cms-list-span">(b)</span>Despite
                                                    the above restrictions on the use of the material on the Website,
                                                    you
                                                    may download material from the Website for your personal
                                                    non-commercial use
                                                    provided you do not remove any copyright and trade mark notices
                                                    contained on
                                                    the material.
                                                </li>
                                            </ol>
                                            <ol type="1" class="cms-list cms-lvl2">
                                                <li class="cms-list-item"><span class="cms-list-span">(c)</span>You may
                                                    not modify or copy:
                                                </li>
                                            </ol>
                                            <ol type="1" class="cms-lvl1-list">
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">(i)</span>the
                                                        layout of the Website; or
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(ii)</span>any
                                                        computer software and code contained in the Website.
                                                    </li>
                                                </ol>
                                            </ol>
                                            <ol type="1" class="cms-list cms-lvl2">
                                                <li class="cms-list-item"><span class="cms-list-span">(d)</span>E4U
                                                        reserves all intellectual property rights, including, but not
                                                        limited to,
                                                        copyright in material or services provided by it. The material
                                                        provided on the
                                                        Website is provided for personal use only and may not be:
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">(i)</span>re-sold
                                                        or re-distributed in any material form;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(ii)</span>stored
                                                        in any storage media; or
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(ii)</span>re-transmitted
                                                        in any media,
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">without our prior written consent.
                                                    </li>
                                                </ol>
                                            </ol>
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
                                            <!-- level 1 list -->
                                            <ol start="3" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span
                                                        class="cms-list-span"><b>6.</b></span> Advertising Services
                                                </li>
                                                <!-- level 2 list -->
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.1</span>By submitting an Advertising
                                                        Request:
                                                    </li>
                                                    <!-- level 3 list -->
                                                    <ol type="a" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>The
                                                            Escort acknowledges that they are:
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl4">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>over 18 years of age
                                                                and will not imply or state that they are under
                                                                the age of 18 in any Profile; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>independent and not
                                                                working for or associated with any Massage
                                                                Centre or Escort Agency; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>the legal owner of
                                                                any information and material (including
                                                                photographs) submitted to and posted in a Profile on the
                                                                Website
                                                                and no other third party has a right to such information
                                                                and
                                                                material.
                                                            </li>
                                                        </ol>
                                                        <!-- level 3 list -->
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>The
                                                            Massage Centre acknowledges that any Masseur:
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl4">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>Masseur working at
                                                                the Massage Centre is over 18 years of age;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>Masseur Advertised
                                                                on a Massage Centre Profile is over 18 years of age
                                                                and Masseurs will not imply or state that they are under
                                                                the age of
                                                                18 in any Profile; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>Masseur who is
                                                                advertised in a Massage Centre Profile is engaged by the
                                                                Massage Centre; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iv)</span>Masseur engaged by
                                                                the Massage Centre is the legal owner of any
                                                                information and material (including photographs)
                                                                submitted to and
                                                                posted on the Website and no other third party has a
                                                                right to such information and material.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>the
                                                            Agent acknowledges that any Profile the Agent posts on
                                                            behalf of an
                                                            Escort or Massage Centre, complies with clauses 6.1(a) and
                                                            6.1(b).
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.2</span>The Advertiser agrees not to
                                                        impersonate or pose as any other person, and
                                                        that all information, material and photographs displayed on any
                                                        Profile and
                                                        posted on the Website relates to the Advertiser alone, including
                                                        any material
                                                        and photographs relating to a Masseur. The Advertiser will not
                                                        under any
                                                        circumstances send another person in their place for any
                                                        appointment. The
                                                        Advertiser will not use the Website to refer Viewers to any
                                                        other advertising
                                                        directory, dating website or any other website (except the
                                                        Advertiser's own
                                                        personal website).
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.3</span>Whilst the Advertiser,
                                                        advertises on the Website they, or any Related Entity or Related
                                                        Party or Associated Entity, will not have an interest, either
                                                        directly or indirectly, in another website, business or venture
                                                        that competes with the Website, the Services or E4U.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.4</span>The Advertiser, and any
                                                        Agent who has been appointed by an Advertiser,
                                                        agrees that if the Advertiser is found, in the opinion of E4U
                                                        acting reasonably,
                                                        to:
                                                    </li>
                                                    <!-- level 3 list -->
                                                    <ol type="a" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>be
                                                            using photographs or advertising material of another person
                                                            as their own; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>be
                                                            a:
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl4">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>Massage Centre
                                                                posing as an Escort; or
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>Escort Agency
                                                                posing as an Escort; or
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>be
                                                            sending another person in their place for any appointment;
                                                            or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>be
                                                            using the Website to refer Viewers to any other advertising
                                                            directory, dating website or any other website (except the
                                                            client's own personal website); or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(e)</span>be
                                                            using photographs, information or material not owned by them
                                                            or which, in the opinion of E4U, a third party has the
                                                            expressed right over such photographs, information or
                                                            material; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(f)</span>have
                                                            an interest in another website, business or venture that
                                                            competes with the Website, the Services or E4U; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(g)</span>have
                                                            breached any part of the Terms and Conditions, the
                                                            Membership may, in E4U's absolute and unfettered discretion
                                                            (in addition to all other rights and remedies open to it),
                                                            be cancelled without refund (except as required at law) and
                                                            any Profile at the time which is published on the Website
                                                            will be immediately removed.
                                                        </li>
                                                    </ol>
                                                    {{--<li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.5</span>The Advertiser authorises
                                                        and consents to E4U publishing the Advertiser's
                                                        supplied photographs and information on the Website, and any
                                                        other website
                                                        E4U manages in order to promote the Services, including on any
                                                        social media
                                                        platform.
                                                    </li>--}}
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.5</span> <span>By uploading on to the Website, or otherwise providing E4U with, any material
                              that is protected by <b>(intellectual property)</b> rights including, but not limited to,
                              copyrighted works and material other than works, trade marks and service
                              marks (Intellectual Property), the Advertiser grants E4U a perpetual,
                              non-exclusive and payment-free licence throughout the world to: </span>
                                                    </li>
                                                    <!-- level 3 list -->
                                                    <ol type="a" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>reproduce,
                                                            use and exploit the Intellectual Property, as part of the
                                                            Website and associated sites, to the full extent permitted
                                                            by Intellectual
                                                            Property law in any jurisdiction in which the Website is
                                                            available to users;
                                                            and
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>allow
                                                            E4U to sub-licence others the same rights granted to us in
                                                            sub-clause (a) above.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.6</span>E4U reserves the right to
                                                        crop the Advertiser's images if they do not fit with the
                                                        Profile layout, or to improve the Advertiser's listing and the
                                                        Advertiser
                                                        authorises such amendment.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.7</span>Subject to clause 6.6, E4U
                                                        will publish images online in the same form as they
                                                        are received from the Advertiser, unless notified by the
                                                        Advertiser in writing via
                                                        email, or other nominated form of communication, to do
                                                        otherwise. If the
                                                        Advertiser requires their images to be cropped or blurred the
                                                        Advertiser must
                                                        notify E4U at the time of providing those images.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.8</span>An Advertiser must comply,
                                                        at its own cost and expense, with all acts,
                                                        ordinances, rules, regulations, other delegated legislation,
                                                        codes and the
                                                        requirements of any Commonwealth, State and Local Government
                                                        departments, bodies, and public authorities or other authority.
                                                        An Advertiser
                                                        agrees it is their responsibility and not the responsibility of
                                                        E4U to ensure such
                                                        compliance, and the Escort or Massage Centre hereby represents
                                                        and
                                                        warrants that:
                                                    </li>
                                                    <ol type="a" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>
                                                            their advertisement is compliant with all relevant Local
                                                            Laws,
                                                            Classification Laws and laws of any other country in which
                                                            the Escort or
                                                            Massage Centre advertises, or provides, escort or sex work
                                                            services,
                                                            including States, Territories and countries that the
                                                            Advertiser is touring in,
                                                            including but not limited to the:
                                                        </li>
                                                        <ol type="i" class="cms-list cms-lvl4">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>Competition and
                                                                Consumer Act 2010 (Cth);
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>Fair Trading Acts
                                                                in all applicable States and Territories;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>Privacy Act 1988
                                                                (Cth) including the Australian Privacy Principles;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iv)</span>Human Rights and
                                                                Equal Opportunity Commission Act 1986 (Cth);
                                                                and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(v)</span>All
                                                                anti-discrimination and equal opportunity legislation
                                                                applicable in
                                                                the State or Territory in which the Advertiser does
                                                                business; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(vi)</span>All legislation
                                                                applicable to the advertising of escort or sex work
                                                                services.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>
                                                            they hold all consents, licences and approvals, necessary to
                                                            lawfully
                                                            advertise, and provide, escort or sex work services in any
                                                            place, whether
                                                            inside or outside Australia, where they so advertise or
                                                            provide such
                                                            services. The Advertiser hereby indemnifies E4U from and
                                                            against all
                                                            actions, costs, charges, claims and demands in respect of
                                                            such action,
                                                            cost, charge, claim and demand.
                                                        </li>
                                                    </ol>

                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.9</span>
                                                        <ol type="a" class="cms-list cms-lvl3" style="padding-left: 0 !important;">
                                                            <li class="cms-list-item"><span class="cms-list-span">(a)</span>
                                                                An Advertiser, and an Agent where they are acting on behalf of an Escort
                                                                or Massage Centre, understand that any Profile or Tour they create will
                                                                be reviewed and approved by E4U before it will be displayed on the
                                                                Website. If E4U finds there is any content that does not comply with the
                                                                Local Laws or any Policies, E4U will may ask the Advertiser or Agent (as
                                                                the case may be) from time to time to amend the content of the Profile
                                                                before the Profile is approved. Without limiting any other rights and
                                                                remedies available to E4U at law or equity or statute or under these
                                                                Terms and Conditions, if the Advertiser does not comply with any
                                                                reasonable request from E4U to amend the Profile (the determination of
                                                                which is solely at E4U’s discretion) E4U may, in its sole discretion, refuse
                                                                to accept any such Profile or, if any such Profile is already on the
                                                                Website, to remove that Profile forthwith; and
                                                            </li>
                                                            <li class="cms-list-item"><span class="cms-list-span">(b)</span>
                                                                E4U may remove any material or information, including but not limited to
                                                                links to other sites on the Internet, at any time without giving any
                                                                explanation or justification for removing the material or information.
                                                            </li>
                                                            <li class="cms-list-item"><span class="cms-list-span">(c)</span>
                                                                E4U bears no liability for any costs, losses or damages of any kind,
                                                                which you may incur, arising whether directly or indirectly. This applies:
                                                            </li>
                                                            <ol type="i" class="cms-list cms-lvl4">
                                                                <li class="cms-list-item"><span
                                                                        class="cms-list-span">(i)</span>in relation to or in connection with any material or information
                                                                    supplied in respect of advertising on the Website; and
                                                                </li>
                                                                <li class="cms-list-item"><span
                                                                        class="cms-list-span">(ii)</span>as a consequence of amending or removing any material or
                                                                    information from the Website.
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                    </li>

                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.10</span>
                                                        An Advertiser will not place a link to any other advertising portal or directory on
                                                        the Website or otherwise attempt to draw business away from E4U.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.11</span>
                                                        An Advertiser and Agent consent to receiving electronic communication from
                                                        E4U.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.12</span>
                                                        E4U may, in its absolute discretion, terminate any Profile or Tour and
                                                        Membership which breaches any of these Terms and Conditions (and subject
                                                        to any applicable laws), without refund.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.13</span>
                                                        E4U understands that there may be slight differences between an Escort's or
                                                        Masseur’s Profile images and the Escort or Masseurs in real life, due to
                                                        photographic techniques used as well as flattering lighting and angles. Image
                                                        verification is generally compulsory, however if a complaint is received about
                                                        image authenticity then the Advertiser's images must be verified as per the
                                                        E4U image verification process. More details for this process may be obtained
                                                        from E4U upon request. E4U may, at its absolute discretion, immediately
                                                        suspend any Profile or Tour unless and until it is satisfied that the image
                                                        verification has been, in E4U's sole opinion, satisfactorily completed.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.14</span>
                                                        If the Advertiser or Masseur is found to have images that are outdated and no
                                                        longer represent the way the Advertiser or Masseur looks, E4U, in its absolute
                                                        discretion, may ask for replacement images that are current and the Advertiser
                                                        or Masseur (as the case may be) must supply them within the nominated time
                                                        frame as advised by E4U; otherwise E4U may, at its sole discretion, suspend
                                                        or permanently remove the Profile or Tour.
                                                    </li>
                                                    <li class="cms-list-item cms-lvl"><span
                                                            class="cms-list-span">6.15</span>
                                                        An Advertiser is under no obligation or requirement to agree to these Terms
                                                        and Conditions however, in the event the Advertiser is unwilling or unable to
                                                        agree to the Terms and Conditions, then E4U will not provide the Services to
                                                        the Advertiser.
                                                    </li>
                                                </ol>


                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>7.</b></span>Profile Design Services
                                                        Services
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">7.1</span>
                                                            An Advertiser hereby gives authority for E4U to upload and publish the
                                                            Advertiser's supplied photographs for the purpose of a Profile or Tour.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">7.2</span>
                                                            An Advertiser agrees that the Advertiser's content in any Profile or Tour and
                                                            any changes to the content of a Profile or Tour is the Advertiser's sole
                                                            responsibility.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">7.3</span>
                                                            An Advertiser agrees and accepts that:

                                                        </li>
                                                        <ol type="a" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span class="cms-list-span">(a)</span>
                                                                E4U retains legal and intellectual property rights in all material or content
                                                                created by E4U; and the
                                                            </li>
                                                            <li class="cms-list-item"><span class="cms-list-span">(b)</span>
                                                                E4U’s registered and unregistered trade marks form part of the Profile
                                                                design and are not to be removed or altered in any form; and the
                                                            </li>
                                                            <li class="cms-list-item"><span class="cms-list-span">(c)</span>
                                                                standard Website design, look and functionality will be maintained as the
                                                                theme of the Profile or Tour (as the case may be) when placing an
                                                                Advertising Request; and
                                                            </li>
                                                            <li class="cms-list-item"><span class="cms-list-span">(d)</span>
                                                                it is not permitted to publish, manipulate, distribute or otherwise
                                                                reproduce, in any format, any of the content or copies of the content that
                                                                E4U creates in connection with any business or commercial enterprise.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">7.4</span>
                                                            Advertisers agree that E4U has the right to make changes to a Profile or Tour
                                                            if it is no longer compliant with these Terms and Conditions.
                                                        </li>
                                                    </ol>
                                                </ol>



                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>8.</b></span>Search for Information
                                                        Services
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">8.1</span>the Advertiser
                                                            advertises on the Website at their own risk.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">8.2</span>E4U
                                                            will provide a Profile search function for Viewers. Whilst
                                                            care is taken to
                                                            avoid errors and omissions, inaccuracies may occur and E4U
                                                            does not accept
                                                            responsibility for any errors and omissions which may occur
                                                            in the Profile or
                                                            Tour (as the case may be) search function. It is the
                                                            responsibility of the
                                                            Advertiser to inform E4U of any problems associated with the
                                                            Profile search
                                                            function.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">8.3</span>to
                                                            the maximum extent permitted by law, E4U is not responsible
                                                            for, and
                                                            expressly disclaims all and any guarantees and warranties,
                                                            expressed or
                                                            implied, regarding use of the Website and Services and in
                                                            relation to
                                                            transactions that are instigated because of the Advertiser
                                                            advertising on or
                                                            using the Website.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">8.4</span>E4U
                                                            will not be responsible or liable under any circumstances
                                                            for any loss or
                                                            damages whatsoever arising out of, or in connection with an
                                                            Advertisers use
                                                            of the Website or Services and in relation to transactions
                                                            that are instigated
                                                            because of the Advertiser advertising on or using the
                                                            Website.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">8.5</span>E4U
                                                            recommends Advertisers use only personal computers and
                                                            personal email addresses when accessing and using the
                                                            Website, E4U will send emails and advertising material to
                                                            the Advertiser which the Advertiser may find to be of a
                                                            sensitive or personal nature.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <!-- level 1 list -->
                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>9.</b></span>Obligations of the Advertiser
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        The Advertiser agrees, represents and warrants that:
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>
                                                            they will not reproduce, adapt, upload or link to any of the material on the
                                                            Website (or on any third party website) without the prior consent of E4U (or the
                                                            relevant third party website owner(s)), including saving the clips on the
                                                            Website to any type of media;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>
                                                            except for where a Masseur is attached to a Massage Centre, they are
                                                            independent and not working for or associated with any Escort Agency;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(c)</span>
                                                            they will not under any circumstances pose as any other person or send
                                                            another person in their place for any appointment;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(d)</span>they own all intellectual property in, or are legally authorised to use and
                                                            distribute, any photographs, videos, music and any other material submitted to
                                                            E4U;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(e)</span>they will not use the Website to refer Viewers to any other advertising
                                                            directory, dating website or any other website (except the client's own personal
                                                            website);
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(f)</span>they will uphold the good name and protect the goodwill of E4U at all times
                                                            (the determination of which is solely at E4U's discretion);
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(g)</span>they will conduct themselves in a professional manner at all times;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(h)</span>they will not make use of the Website for, or encourage, any criminal or illegal
                                                            activities or any activities which are likely to cause loss, cost, expense or
                                                            damage to E4U;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(i)</span>they will not interfere with or disrupt the access of other Users of the Website
                                                            in any way;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(j)</span>they will not place on the Website any material which is unlawful, defamatory,
                                                            harassing, abusive, threatening, a malicious falsehood, discriminatory or
                                                            otherwise objectionable in relation to a person, product, service or company;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(k)</span>all information provided by the Advertiser to E4U (including any images which
                                                            relates to the Advertiser in any way) is true and accurate in every detail and all
                                                            required consents for its disclosure have been obtained by the Advertiser;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(l)</span>that the material or information provided to the Website does not breach or
                                                            infringe:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>
                                                                the rights of any person or corporation under the Competition and Consumer Act 2010 (Cth) or equivalent State legislation;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>
                                                                any intellectual property right, including but not limited to, copyright, trade marks, business names, confidential information rights protected by ‘passing off’;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>
                                                                State or Commonwealth privacy legislation or anti-discrimination legislation; or
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iv)</span>
                                                                any other law or regulations of the Commonwealth of Australia, and its States and Territories, or any law in any country where the material or information is or will be available electronically to Users of this Website; and
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(m)</span>that they will not transmit or attempt to transmit any computer viruses, worms,
                                                            defects, Trojan horses or other material that is malicious, or of a destructive
                                                            nature, or affects the performance or functionality of the Website or Services.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(n)</span>they indemnify E4U for all liabilities or losses incurred in connection with any
                                                            and all use of the Website, whether direct or indirect, and whether as a result
                                                            of E4U’s own act or omission.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <!-- level 1 list -->
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>10.</b></span>Payment of Fees
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">10.1</span>the Advertiser agrees
                                                            to pay the Fees in the following manner for obtaining
                                                            the Services:
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>General
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i) </span> The advertising
                                                                period will commence at the time and on the date
                                                                the Advertiser stipulates in the Profile or Tour but
                                                                only if payment
                                                                has been received by E4U by one (1) business day before
                                                                the
                                                                stipulated commencement date.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>If payment has not
                                                                been received by E4U by one (1) business day
                                                                before the stipulated commencement date, then the
                                                                advertising
                                                                period will not commence on the stipulated date, and the
                                                                Profile or
                                                                Tour will not be published on the Website.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>E4U will not
                                                                publish a Profile or Tour on the Website, until the
                                                                Advertiser has paid the Fees. The Fees are shown in the
                                                                console
                                                                pages of the Website, once the Advertiser has registered
                                                                on the
                                                                Website as a Member and logged onto the Advertiser
                                                                Console of
                                                                the Website.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iv)</span>All Fees are due
                                                                and payable in accordance with the requirements
                                                                of the Services (as set out from time to time on the
                                                                Website).
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(v)</span>Pre-payments are
                                                                encouraged from Advertisers and attractive
                                                                discounts are available for such pre-payments (as set
                                                                out from time
                                                                to time on the Website).
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(vi)</span>Payments will not
                                                                be treated as received or paid until they have
                                                                been credited into E4U’s nominated bank account or the
                                                                nominated payment provider has confirmed payment by the
                                                                Advertiser in favour of E4U.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>Late payment
                                                        </li>
                                                        <li class="cms-list-item pl-5">If E4U has received late payment,
                                                            being a payment received after the
                                                            stipulated date of the commencement of the advertising
                                                            period, E4U will
                                                            take all reasonable steps to have the Profile or Tour (as
                                                            the case may
                                                            be) displayed on the Website as soon as practicable OR
                                                            within two (2)
                                                            business days of receiving the payment.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(c)</span>Payment Methods and
                                                            Notifications
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i) </span>Payment methods are
                                                                by credit/debit card to E4U's nominated
                                                                bank account.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>Email notifications
                                                                will be sent to the Advertiser within twenty four
                                                                (24) hours prior to the payment due date for the renewal
                                                                of any
                                                                current Profile or Tour. To ensure uninterrupted
                                                                advertising on the
                                                                E4U Website, the Advertiser must make payment by no
                                                                later than
                                                                four (4) hours before the due date. The commencement
                                                                time for
                                                                any Profile or Tour is 12:00 midnight notwithstanding
                                                                the Profile or
                                                                Tour will be published within 15 minutes of having been
                                                                created.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>if payment is not
                                                                made within the nominated time, within the
                                                                current advertising period, E4U reserves the right to
                                                                suspend the
                                                                Advertiser's Profile or Tour until payment is received.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(d)</span>Refunds
                                                        </li>
                                                        <ol type="i" class="cms-list cms-lvl3">
                                                        </ol>
                                                        <ol type="a" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>Subject to the
                                                                requirements of any applicable laws:
                                                            </li>
                                                            <!-- level 4 list -->
                                                            <ol type="i" class="cms-list cms-lvl4">
                                                                <li class="cms-list-item"><span class="cms-list-span">(A)</span>refunds
                                                                    are made at the absolute discretion of E4U; and
                                                                </li>
                                                                <li class="cms-list-item"><span class="cms-list-span">(B)</span>in
                                                                    the case of pre-payments, as the Advertiser will
                                                                    have already
                                                                    received a discount for making a pre-payment, no
                                                                    further
                                                                    refund will be available to the Advertiser if the
                                                                    Advertiser
                                                                    changes their mind about using the Services prior to
                                                                    the end of
                                                                    the period for which the Advertiser has made a
                                                                    pre-payment.
                                                                </li>
                                                            </ol>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>Refunds will be
                                                                processed promptly and payment made by direct
                                                                deposit to the Advertiser's nominated bank account.
                                                                Refund
                                                                payments may take up to ten (10) business days to be
                                                                received.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>Refunds will be
                                                                processed in accordance with the Refund Policy.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">10.2</span>If E4U decides, in its
                                                            absolute discretion, to give the Advertiser a free period of
                                                            advertising, the Advertiser will be notified of the
                                                            commencement and finish
                                                            dates of the free period, together with a copy of the E4U
                                                            policy in relation to
                                                            any Loyalty Program.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">10.3</span>E4U may decide, in its
                                                            absolute discretion, to allow an Advertiser to place on
                                                            hold a Profile or Tour. Any Fees which have been pre-paid
                                                            may be held as a
                                                            credit for use at a later date but these credits must be
                                                            used within ninety (90)
                                                            days of the placing on hold of a Profile or Tour being
                                                            initiated. Any advertising
                                                            credit not used within ninety (90) days will expire and
                                                            (subject to applicable
                                                            laws) no refund will be given.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>11.</b></span>GST
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">11.1</span>Unless stated otherwise
                                                            all of the Fees are inclusive of GST.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">11.2</span>Subject to clause 11.1,
                                                            if any payment made by one party to any other party under or
                                                            relating to these Terms and Conditions constitutes
                                                            consideration for a taxable supply for the purposes of GST
                                                            or any similar tax, the amount to be paid for the supply
                                                            will subject to the receipt by the payer of a tax invoice in
                                                            the prescribed form be increased so that the net amount
                                                            retained by the supplier after payment of that GST is the
                                                            same as if the supplier was not liable to pay GST in respect
                                                            of that supply.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>12.</b></span>Social Media
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">12.1</span>Subject to clause 12.2,
                                                            an Advertiser, when they initially register for the
                                                            Services, will be automatically promoted via social media
                                                            platforms (as selected by E4U, at its sole discretion, from
                                                            time to time). Such social media may include Twitter and
                                                            similar social media platforms.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">12.2</span>All new Advertisers
                                                            will receive a welcome email, which will provide them with
                                                            the ability to elect not to be promoted via social media.
                                                            This can be achieved by the Advertisers logging into the
                                                            Advertiser Console and selecting "No", in the applicable
                                                            section of the Account, to the various social media
                                                            platforms that may be used by E4U.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">12.3</span>If the Advertiser
                                                            selects "Yes" to being promoted via any social media
                                                            platforms, the Advertiser agrees and understands that due to
                                                            the nature of social media and the volume of posts, there
                                                            may be old Tweets and posts that remain in the time line,
                                                            and can be found in future by search engines.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">12.4</span>If the Advertiser
                                                            decides not to be promoted on social media in the future, or
                                                            if the Profiles are suspended or terminated, the Advertiser
                                                            agrees and understands that previous social media posts will
                                                            remain online, and may not necessarily be automatically
                                                            deleted by E4U.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">12.5</span>If the Advertiser
                                                            wishes to have previous social media posts deleted, the
                                                            Advertiser must provide the direct links of all of the posts
                                                            to E4U. E4U will not be responsible for any social media
                                                            posts that are not removed. The
                                                            Advertiser acknowledges that E4U will not use any tools such
                                                            as URL removal tools in this regard.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>13.</b></span>Third Party Search
                                                        Engines
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">13.1</span>If Membership is
                                                            cancelled or terminated, E4U will remove the Advertiser’s
                                                            Profile from the Website.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">13.2</span>The Advertiser
                                                            acknowledges that notwithstanding the cancellation or
                                                            termination of Membership, the Advertiser's content on the
                                                            Website may still be viewable on the Website, at the sole
                                                            discretion of E4U, and third party search engines
                                                            (notwithstanding its removal from the Website) and E4U is
                                                            not responsible for such content being visible and indexed
                                                            by third party search engines. The Advertiser acknowledges
                                                            that E4U will not use any tools such as URL removal tools in
                                                            this regard.
                                                        </li>
                                                    </ol>
                                                </ol>

                                                <!-- level 1 list -->
                                                {{--<ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>6</b></span>E4U:
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item cms-lvl"><span class="cms-list-span">(a)</span>may
                                                            ask the Advertiser or Agent (as the case may be) from time
                                                            to time
                                                            to amend the content of the Profile. Without limiting any
                                                            other rights and
                                                            remedies available to E4U at law or equity or statute or
                                                            under these
                                                            Terms and Conditions, if the Advertiser does not comply with
                                                            any
                                                            reasonable request from E4U to amend the Profile (the
                                                            determination of
                                                            which is solely at E4U’s discretion) E4U may, in its sole
                                                            discretion, refuse
                                                            to accept any such Profile or, if any such Profile is
                                                            already on the
                                                            Website, to remove that Profile forthwith.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>may
                                                            remove any material or information, including but not
                                                            limited to links
                                                            to other sites on the Internet, at any time without giving
                                                            any explanation
                                                            or justification for removing the material or information.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>bears
                                                            no liability for any costs, losses or damages of any kind,
                                                            which you
                                                            may incur, arising whether directly or indirectly. This
                                                            applies:
                                                        </li>
                                                        <!-- level 3 list -->
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>in relation to or in
                                                                connection with any material or information
                                                                supplied in respect of advertising on the Website; and
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>as a consequence of
                                                                amending or removing any material or
                                                                information from the Website.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.1</span>An
                                                            Advertiser will not place a link to any other advertising
                                                            portal or directory on
                                                            the Website or otherwise attempt to draw business away from
                                                            E4U.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.2</span>An
                                                            Advertiser and Agent consent to receiving electronic
                                                            communication from E4U.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.3</span>E4U
                                                            may, in its absolute discretion, terminate any Profile or
                                                            Tour and
                                                            Membership which breaches any of these Terms and Conditions
                                                            (and subject
                                                            to any applicable laws), without refund.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.4</span>E4U
                                                            understands that there may be slight differences between an
                                                            Escort's or
                                                            Masseur’s Profile images and the Escort or Masseurs in real
                                                            life, due to
                                                            photographic techniques used as well as flattering lighting
                                                            and angles. Image
                                                            verification is not compulsory, however if a complaint is
                                                            received about image
                                                            authenticity then the Advertiser's images must be verified
                                                            as per the E4U
                                                            image verification process. More details for this process
                                                            may be obtained from
                                                            E4U upon request. E4U may, at its absolute discretion,
                                                            immediately suspend
                                                            any Profile or Tour unless and until it is satisfied that
                                                            the image verification has
                                                            been, in E4U's sole opinion, satisfactorily completed.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.5</span>If
                                                            the Advertiser or Masseur is found to have images that are
                                                            outdated and no
                                                            longer represent the way the Advertiser or Masseur looks,
                                                            E4U, in its absolute
                                                            discretion, may ask for replacement images that are current
                                                            and the Advertiser
                                                            or Masseur (as the case may be) must supply them within the
                                                            nominated time
                                                            frame as advised by E4U; otherwise E4U may, at its sole
                                                            discretion, suspend
                                                            or permanently remove the Profile or Tour
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">6.6</span>An
                                                            Advertiser is under no obligation or requirement to agree to
                                                            these Terms
                                                            and Conditions however, in the event the Advertiser is
                                                            unwilling or unable to
                                                            agree to the Terms and Conditions, then E4U will not provide
                                                            the Services to
                                                            the Advertiser.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>7.</b></span>Profile Design
                                                        Services
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">7.1</span>An Advertiser hereby
                                                            gives authority for E4U to upload and publish the
                                                            Advertiser's supplied photographs for the purpose of a
                                                            Profile or Tour.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">7.2</span>An
                                                            Advertiser agrees that the Advertiser's content in any
                                                            Profile or Tour and
                                                            any changes to the content of a Profile or Tour is the
                                                            Advertiser's sole
                                                            responsibility.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">7.3</span>An
                                                            Advertiser agrees and accepts that:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(a)</span>E4U retains legal
                                                                and intellectual property rights in all material or
                                                                content
                                                                created by E4U; and that
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(b)</span>E4U’s registered and
                                                                unregistered trade marks form part of the Profile
                                                                design and are not to be removed or altered in any form;
                                                                and the
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(c)</span>standard Website
                                                                design and that look and functionality will be
                                                                maintained as the theme of the Profile or Tour (as the
                                                                case may be)
                                                                when placing an Advertising Request.
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(d)</span>it is not permitted
                                                                to publish, manipulate, distribute or otherwise
                                                                reproduce, in any format, any of the content or copies
                                                                of the content that
                                                                E4U creates in connection with any business or
                                                                commercial enterprise.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">7.4</span>An
                                                            Advertiser agrees that E4U has the right to make changes to
                                                            a Profile or
                                                            Tour if it is no longer compliant with these Terms and
                                                            Conditions.
                                                        </li>
                                                    </ol>
                                                </ol>

                                                <ol start="3" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>9.</b></span>Obligations of the
                                                        Advertiser
                                                    </li>
                                                    <li class="cms-list pl-4 ml-1">The Advertiser acknowledges,
                                                        covenants and warrants that:
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>they will not reproduce,
                                                            adapt, upload or link to any of the material on the Website
                                                            (or on any third party website) without the prior consent of
                                                            E4U (or the relevant third party website owner(s), including
                                                            saving the clips on the Website to any type of media;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>except
                                                            for where a Masseur is attached to a Massage Centre, they
                                                            are independent and not working for or associated with any
                                                            Escort Agency;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>they
                                                            will not under any circumstances pose as any other person or
                                                            send another person in their place for any appointment;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>they
                                                            own all intellectual property in, or are legally authorised
                                                            to use and
                                                            distribute, any photographs, videos, music and any other
                                                            advertising material of any description submitted to E4U.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(e)</span>they
                                                            will not use the Website to refer Viewers to any other
                                                            advertising directory, dating website or any other website
                                                            (except the client's own personal website);
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(f)</span>they
                                                            will uphold the good name and protect the goodwill of E4U at
                                                            all times
                                                            (the determination of which is solely at E4U's discretion);
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(g)</span>they
                                                            will conduct themselves in a professional manner at all
                                                            times;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(h)</span>they
                                                            will not make use of the Website for, or encourage, any
                                                            criminal or illegal
                                                            activities or any activities which are likely to cause loss,
                                                            cost, expense or
                                                            damage to E4U;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(i)</span>they
                                                            will not interfere with or disrupt the access of other Users
                                                            of the Website in any way;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(j)</span>they
                                                            will not place on the Website any material which is
                                                            unlawful, defamatory,
                                                            harassing, abusive, threatening, a malicious falsehood,
                                                            discriminatory or
                                                            otherwise objectionable in relation to a person, product,
                                                            service or company;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(k)</span>all
                                                            information provided by the Advertiser to E4U (including any
                                                            images which
                                                            relates to the Advertiser in any way) is true and accurate
                                                            in every detail and all
                                                            required consents for its disclosure have been obtained by
                                                            the Advertiser;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(l)</span>that
                                                            the material or information provided to the Website does not
                                                            breach or
                                                            infringe:
                                                        </li>
                                                        <!-- level 4 list -->
                                                        <ol type="i" class="cms-list cms-lvl4">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>the rights of any
                                                                person or corporation under the Competition and Consumer
                                                                Act 2010 (Cth) or equivalent State legislation;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>any intellectual
                                                                property right, including but not limited to, copyright,
                                                                trade
                                                                marks, business names, confidential information rights
                                                                protected by
                                                                ‘passing off’;
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iii)</span>State or
                                                                Commonwealth privacy legislation or anti-discrimination
                                                                legislation; or
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(iv)</span>any other law or
                                                                regulations of the Commonwealth of Australia, and its
                                                                States and Territories, or any law in any country where
                                                                the material or
                                                                information is or will be available electronically to
                                                                Users of this Website;
                                                                and
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">(m)</span>that
                                                            they will not transmit or attempt to transmit any computer
                                                            viruses, worms,
                                                            defects, Trojan horses or other material that is malicious,
                                                            or of a destructive
                                                            nature, or affects the performance or functionality of the
                                                            Website or Services.
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(n)</span>they
                                                            indemnify E4U for all liabilities or losses incurred in
                                                            connection with any
                                                            and all use of the Website, whether direct or indirect, and
                                                            whether as a result
                                                            of E4U’s own act or omission.
                                                        </li>
                                                    </ol>
                                                </ol>--}}

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
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>14.</b></span>Subscription
                                                    and Membership
                                                </li>
                                                <!-- level 2 list -->
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">14.1</span>To
                                                        access and use the Services, you must register as a Viewer.
                                                        Registration is
                                                        free. Upon the completion of Registration, the Viewer will be
                                                        provided a
                                                        notification email with the means to access the Website, such as
                                                        an activation
                                                        key and password. Registration may include 2FA verification in
                                                        the
                                                        Registration process.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.2</span>When
                                                        registering as a Viewer, you must provide E4U with accurate,
                                                        complete
                                                        and up-to-date registration information, including your Home
                                                        State, as
                                                        requested. It is your responsibility to inform E4U of any
                                                        changes to your
                                                        Account information. E4U will treat your information strictly in
                                                        accordance with the Privacy Policy.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.3</span>You
                                                        must not register as a Viewer more than once.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.4</span>You
                                                        must not impersonate or create an Account for any person other
                                                        than yourself.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.5</span>E4U
                                                        may, if we belief that your Account is false or misleading, at
                                                        any time
                                                        request a form of identification to verify your identity.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.6</span>You
                                                        must ensure the security and confidentiality of your Account
                                                        details,
                                                        including any username and/or password assigned to you. You are
                                                        wholly
                                                        responsible for all activities which occur under your
                                                        Membership. You must
                                                        notify us immediately if you become aware of any unauthorised
                                                        use of your
                                                        Membership. You must not permit your Membership to be used by or
                                                        transferred to any other person.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.7</span>E4U
                                                        may require a Viewer to change its username or password or use a
                                                        different method of accessing the Website from time to time.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">14.8</span>E4U
                                                        reserves the right to, in our sole discretion, suspend or
                                                        terminate your
                                                        Membership or access to all or any part of the Website,
                                                        including if we believe
                                                        you are abusing an Advertiser in any way, have breached these
                                                        Terms and
                                                        Conditions or are no longer an active Viewer.
                                                    </li>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>15.</b></span>
                                                    Search for Information Services
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">15.1</span>The
                                                        Viewer uses the Website at their own risk.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.2</span>E4U
                                                        provides a Profile and Tour search function for Viewers. Whilst
                                                        care is
                                                        taken to avoid errors and omissions, inaccuracies may occur and
                                                        E4U does
                                                        not accept responsibility for such errors and omissions.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.3</span>To
                                                        the maximum extent permitted by law, E4U is not responsible for,
                                                        and
                                                        expressly disclaims all and any guarantees and warranties,
                                                        expressed or
                                                        implied, regarding use of the Website including but not limited
                                                        to use,
                                                        reference to, or reliance on any Profiles contained on the
                                                        Website, or
                                                        transactions that are instigated because of such Profiles or use
                                                        of the
                                                        Website.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.4</span>Escorts4U
                                                        will not be liable under any circumstances for any loss or
                                                        damages
                                                        whatsoever arising out of, or in connection with use of the
                                                        Website including
                                                        but not limited to use or reliance on any Profiles contained on
                                                        the Website or
                                                        transactions that are instigated because of such Profiles, or
                                                        use of the
                                                        Website.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.5</span>Without
                                                        limiting clauses 12.3 and 12.4, E4U will not be responsible for
                                                        any
                                                        loss or damage of any kind incurred by Viewers in respect of
                                                        transactions that
                                                        are instigated as a result of or in connection to use of the
                                                        Website.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.6</span>The
                                                        Website is a directory only and Viewers should satisfy
                                                        themselves as to
                                                        the accuracy of the Profiles and the legitimacy, suitability and
                                                        qualification of
                                                        the Advertiser. E4U encourages all Advertisers to verify any
                                                        media published
                                                        in a Profile. E4U is not a party to any and all transactions
                                                        between Viewers
                                                        and Advertisers.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">15.7</span>Unless
                                                        the Account is set otherwise, the Viewer consents to receiving
                                                        electronic communication from E4U, in line with our Spam Policy
                                                        and Privacy
                                                        Policy.
                                                    </li>
                                                </ol>
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>16.</b></span>Obligations of the
                                                        Viewer
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item ">The Viewer agrees, represents and
                                                            warrants that:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(a)</span>they will not
                                                                reproduce, adapt, upload or link to any of the material
                                                                on the
                                                                Website (or on any E4U third party website) without the
                                                                prior consent of E4U
                                                                or other relevant Intellectual Property right holder ,
                                                                including saving the clips
                                                                on the Website to any type of media;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(b)</span>they will comply
                                                                with the Terms and Conditions;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(c)</span>they will not use
                                                                the Website for, or encourage, any criminal or illegal
                                                                activities
                                                                or any activities which are likely to cause loss, cost,
                                                                expense or damage to
                                                                E4U;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(d)</span>they will not
                                                                interfere with or disrupt the access of other Users of
                                                                the Website
                                                                in any way;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(e)</span>they will observe
                                                                and be bound by the Acceptable Usage Rules and other
                                                                Policies published on the Website;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(f)</span>they will not
                                                                publish any unlawful, defamatory, harassing, abusive,
                                                                threatening,
                                                                false, malicious, discriminatory or otherwise
                                                                objectionable statements or
                                                                materials in relation to a person, product, service or
                                                                company;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(g)</span> <span>it is their sole responsibility and not the responsibility of E4U to ensure that
                                       they comply with the <a href="{{ url('faqs')}}"
                                                               style="color:#FF3C5F">Local Laws</a> relevant to the engagement of escort or sex
                                       work services in the place where they engage such services, whether inside or
                                       outside Australia; and </span>
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(h)</span>they unconditionally
                                                                and irrevocably release and discharge E4U from all
                                                                liability for damages or loss of any kind arising out of
                                                                use of the Website or
                                                                Services or transactions that are instigated as a result
                                                                of use of the Website or
                                                                Services;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(i)</span>
                                                                <span>
                                                                    they will not
                                                                access, exhibit, display or demonstrate any of the
                                                                content of the
                                                                Website in a public place, or where there are persons
                                                                under the age of 18;
                                                                and must otherwise comply with the <a class="c-red" href="{{ url('')}}">Classification Laws</a>.
                                                                </span>
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                </ol>

                                            </ol>
                                            
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
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <!-- level 2 list -->
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>17.</b></span>Applying to be an
                                                        agent
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.1</span>
                                                            By submitting an application to become an Agent the
                                                            applicant agrees and
                                                            acknowledges that they:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(a)</span>are over 18 years of
                                                                age;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(b)</span>reside in the Home
                                                                State declared in the application;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(c)</span>have registered, or
                                                                will register if appointed an Agent, for the purposes of
                                                                GST;
                                                                and
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(d)</span>are independent and
                                                                not working for or associated with any Massage Centre or
                                                                Escort Agency and will not post a Profile or Tour in
                                                                their own name.
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.2</span>Applications to
                                                            become agents must be submitted to E4U through the Website’s
                                                            agent registration form.
                                                        </li>
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.3</span>When E4U receives an
                                                            application to become an Agent, E4U will send, to the
                                                            applicant’s provided email address, a confirmation email
                                                            with a reference number.
                                                        </li>
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.4</span>E4U will consider all
                                                            applications received. After E4U has made a decision as to
                                                            the
                                                            application, E4U will contact the applicant as to the
                                                            outcome of the application.
                                                        </li>
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.5</span>E4U’s decision as to
                                                            whether an application is successful or unsuccessful is
                                                            wholly
                                                            at its discretion. If an applicant is unsuccessful, then E4U
                                                            is not required to provide
                                                            any reasoning on the decision.
                                                        </li>
                                                        <li class="cms-list-item ">
                                                            <span class="cms-list-span">17.6</span>If an application is
                                                            successful, then the successful applicant will be provided
                                                            with a
                                                            copy of an agreement that will contain the terms and
                                                            conditions of the position of
                                                            Agent. If E4U and the successful applicant enter into an
                                                            agreement, then that
                                                            person is an Agent.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>18.</b></span>Obligations
                                                    of the Agent
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">18.1</span>The Agent agrees,
                                                        represents and warrants that:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>they will use the Agent
                                                            Console to manage the information, data and documents
                                                            of Advertisers;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>they will not use the
                                                            Website features intended for use by Advertisers, including
                                                            but not limited to the Advertisers Console;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(c)</span>when they act on behalf
                                                            of an Advertiser, they will take all practical steps to
                                                            ensure that the Advertiser understands and complies with its
                                                            obligations under
                                                            the Terms and Conditions;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(d)</span>they will not reproduce,
                                                            adapt, upload or link to any of the material on the
                                                            Website (or on any third party website) without the prior
                                                            consent of E4U (or the
                                                            relevant third party website owner(s)), including saving the
                                                            clips on the Website
                                                            to any type of Media;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(e)</span>all information,
                                                            material and photographs displayed on any Profile and posted
                                                            on the Website relates to the Advertiser alone;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(f)</span>while acting as an
                                                            Agent, they will remain independent and not work for or
                                                            become associated with any Escort Agency or Massage Centre
                                                            (outside of
                                                            providing the Support Services);
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(g)</span>they will not under any
                                                            circumstances impersonate or pose as any other person,
                                                            including they the Agent will not under any circumstances
                                                            attend the
                                                            appointment of another person in their place. When acting on
                                                            behalf of an
                                                            Advertiser, the Agent must make it clear that they are
                                                            supporting the relevant
                                                            Advertiser for the purpose agreed to;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(h)</span>they will not advertise
                                                            on the Website as an Escort, Masseur, or Massage
                                                            Centre;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(i)</span>they will not misuse or
                                                            misappropriate any Media or content of any person,
                                                            whether it is provided to the Agent by an Advertiser or any
                                                            other party, for use
                                                            on the Website or otherwise;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(j)</span>they own all
                                                            intellectual property in, or are legally authorised to use
                                                            and
                                                            distribute, any photographs, videos, music and any other
                                                            Media or content
                                                            submitted to E4U;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(k)</span>they will not try to
                                                            draw business away from E4U in any way, including misusing
                                                            the Website to refer Viewers to any other advertising
                                                            directory, dating website or
                                                            any other website, or placing a link to any other
                                                            advertising portal or directory on
                                                            the Website or otherwise;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(l)</span>they will uphold the
                                                            good name and protect the goodwill of E4U at all times (the
                                                            determination of which is solely at E4U's discretion);
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(m)</span>they will be honest and
                                                            transparent in its use of the Website;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(n)</span>they will conduct
                                                            themselves in a professional manner at all times;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(o)</span>they will not make use
                                                            of the Website for, or encourage, any criminal or illegal
                                                            activities or any activities which are likely to cause loss,
                                                            cost, expense or
                                                            damage to E4U or an Advertiser;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(p)</span>they will not interfere
                                                            with or disrupt the access of other Users to the Website in
                                                            any way;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(q)</span>they will not place on
                                                            the Website any material which is unlawful, defamatory,
                                                            harassing, abusive, threatening, a malicious falsehood,
                                                            discriminatory or
                                                            otherwise objectionable in relation to a person, product,
                                                            service or company;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(r)</span>all information provided
                                                            by the Agent to E4U (including any documents or
                                                            content such as images) which relates to the Agent or an
                                                            Advertiser is true and
                                                            accurate in every detail and any and all required consents
                                                            for its disclosure have
                                                            been obtained for the use of those documents and
                                                            information; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(s)</span>that the Media or
                                                            information provided to the Website does not breach or
                                                            infringe:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(i)</span><span>the rights of any person or corporation under the <i>Competition and
                  Consumer Act 2010</i> (Cth) or equivalent State legislation;</span>
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(ii)</span>any intellectual
                                                                property right, including but not limited to, copyright,
                                                                trade
                                                                marks, business names, confidential information rights
                                                                protected by
                                                                ‘passing off’;
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(iii)</span>State or
                                                                Commonwealth privacy legislation or anti-discrimination
                                                                legislation; or
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(iv)</span>any other law or
                                                                regulations of the Commonwealth of Australia, and its
                                                                States and Territories or any law in any country where
                                                                the material or
                                                                information is or will be available electronically to
                                                                users of this Website;
                                                                and
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(v)</span>that they will not
                                                                transmit or attempt to transmit any computer viruses,
                                                                worms, defects, Trojan horses or other material that is
                                                                malicious, or of a
                                                                destructive nature, or affects the performance or
                                                                functionality of the
                                                                Website or Services.
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>19.</b></span>Agent’s
                                                    access to the Website
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.1</span>The Agent agrees that E4U
                                                        has control over the Agent’s use of and access to the
                                                        Website, including but not limited to the Agent Console. E4U may
                                                        grant, limit or
                                                        cancel an Agent’s access to the Website in its absolute and
                                                        unfettered discretion, at
                                                        any time and without explanation or justification.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.2</span>The Agent agrees that E4U
                                                        may make record of, and monitor, its use of the
                                                        Website. E4U will comply with the Australian Privacy legislation
                                                        in respect to our
                                                        collection, storage and use of your personal information (refer
                                                        to our full privacy
                                                        policy in clause 3 for details of how we collect, store and use
                                                        your personal
                                                        information).
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.3</span>The Agent agrees that E4U
                                                        has the right to make changes to the Website, including
                                                        the Agent Console, at its sole discretion, at any time without
                                                        giving any explanation
                                                        or justification for removing the material or information.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.4</span>E4U reserves the right to
                                                        edit images, text and other content and documents
                                                        provided to it by the Agent if they do not fit with the Profile
                                                        layout, or to improve the
                                                        Advertiser's listing if the Agent or Advertiser authorises such
                                                        amendment.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.5</span>Subject to clause 19.4
                                                        E4U will publish images online in the same form as they are
                                                        received from the Agent, unless notified by the Agent or
                                                        Advertiser in writing via
                                                        email, or other nominated form of communication, to do
                                                        otherwise. If the Agent
                                                        requires that images be cropped or blurred the Agent must notify
                                                        E4U at the time of
                                                        providing those images
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.6</span>The Agent understands
                                                        that any Profile or Tour they create or manage for an
                                                        Advertiser will be reviewed and approved by E4U before it will
                                                        be displayed on the
                                                        Website. E4U may ask the Advertiser or Agent (as the case may
                                                        be) from time to
                                                        time to amend the content of the Profile.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.7</span>Without limiting any
                                                        other rights and remedies available to E4U at law or equity or
                                                        statute or under these Terms and Conditions, if the Agent does
                                                        not comply with any
                                                        reasonable request from E4U to amend an details on an
                                                        Advertiser’s Profile (the
                                                        determination of which is solely at E4U’s discretion) E4U may,
                                                        in its sole discretion,
                                                        refuse to accept any such Profile or, if any such Profile is
                                                        already on the Website, to
                                                        remove that Profile forthwith.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.8</span>E4U may remove any
                                                        material or information, including but not limited to links to
                                                        other sites on the Internet, at any time without giving any
                                                        explanation or justification
                                                        for removing the material or information.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">19.9</span>If an Agent’s agreement
                                                        with E4U is terminated, and that person is no longer an
                                                        Agent, then E4U will:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>deactivate that person’s
                                                            Agent Console; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>remove that Agent’s name
                                                            from the Website database.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>20.</b></span>Limitation
                                                    of liability and Indemnity
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">20.1</span>To the maximum extent
                                                        permitted by law, E4U is not responsible for, and expressly
                                                        disclaims all and any guarantees and warranties, expressed or
                                                        implied, regarding
                                                        use of the Website and provision of Support Services.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">20.2</span>To the maximum extent
                                                        permitted by law, E4U is not responsible or liable under any
                                                        circumstances for any loss or damages whatsoever arising out of,
                                                        or in connection
                                                        with an Agent’s use of the Website or provision of Support
                                                        Services.
                                                    </li>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">20.3</span>E4U is not responsible
                                                        for, or liable under any circumstances for, any costs, loss or
                                                        damages of any kind, arising out of, or in connection with,
                                                        whether directly or
                                                        indirectly:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>the Agent’s limited or
                                                            terminated access to the Website;
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>any consequence of
                                                            amending or removing any material or information from the
                                                            Website; or
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(c)</span>any material or
                                                            information on the Website.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">20.4</span>The Agent indemnifies E4U
                                                        and its officers, employees and agents from all liabilities
                                                        or losses incurred arising from any claim, demand, suit, action
                                                        or proceeding where
                                                        such loss or liability arose out of, in connection with, or in
                                                        respect of:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>any breach of the Terms
                                                            and Conditions by the Agent; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>Publication of or
                                                            distribution of material, content or information supplied by
                                                            the
                                                            Agent.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>21.</b></span>Intellectual
                                                    property
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">21.1</span>By uploading on to the
                                                        Website, or otherwise providing E4U with, any material that is
                                                        protected by the Agent’s Intellectual Property rights, the Agent
                                                        grants E4U a
                                                        perpetual, non-exclusive and payment-free licence throughout the
                                                        world to:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>reproduce, use and
                                                            exploit the Intellectual Property, as part of the Website
                                                            and associated sites, to the full extent permitted by
                                                            Intellectual Property law
                                                            in any jurisdiction in which the Website is available to
                                                            users; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>allow E4U to sub-licence
                                                            others the same rights granted to us in subclause
                                                            (a) above.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">21.2</span>By uploading on to the
                                                        Website, or otherwise providing E4U with, any material that is
                                                        protected by the Advertiser’s Intellectual Property rights, the
                                                        Agent represents that it
                                                        has the Advertiser’s authority to, and does, grant E4U a
                                                        perpetual, non-exclusive
                                                        and payment-free licence throughout the world to:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>reproduce, use and
                                                            exploit the Intellectual Property, as part of the Website
                                                            and associated sites, to the full extent permitted by
                                                            Intellectual Property law
                                                            in any jurisdiction in which the Website is available to
                                                            users; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>allow E4U to sub-licence
                                                            others the same rights granted to us in subclause
                                                            (a) above.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item ">
                                                        <span class="cms-list-span">21.3</span>An Agent agrees and
                                                        accepts that:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(a)</span>E4U retains legal and
                                                            Intellectual Property rights in all material or content
                                                            created by E4U; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(b)</span>E4U’s registered and
                                                            unregistered trade marks form part of the Profile
                                                            design and are not to be removed or altered in any form; and
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">(c)</span>the Agent is not
                                                            permitted to publish, manipulate, distribute or otherwise
                                                            reproduce, in any format, any of the content or copies of
                                                            the content that
                                                            E4U creates in connection with any business or commercial
                                                            enterprise.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>22.</b></span>Third
                                                    Party Search Engines
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">22.1</span>If
                                                        an Agent’s agreement with E4U is terminated, then E4U will
                                                        remove the Agent’s
                                                        information from the Website.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">22.2</span>The
                                                        Agent acknowledges that notwithstanding the cancellation or
                                                        termination of its
                                                        agent status, the Agent’s content on the Website may still be
                                                        viewable on the
                                                        Website, at the sole discretion of E4U, and third party search
                                                        engines
                                                        (notwithstanding its removal from the Website) and E4U is not
                                                        responsible for such
                                                        content being visible and indexed by third party search engines.
                                                        The Agent
                                                        acknowledges that E4U will not use any tools such as URL removal
                                                        tools in this
                                                        regard.
                                                    </li>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>23.</b></span>Miscellaneous
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">23.1</span>As
                                                        Agent you consent to receiving electronic communication from E4U
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">23.2</span>Agent’s
                                                        queries regarding the Agent Console, Website, Policies or
                                                        Guidelines
                                                        should be sent to E4U by the nominated medium.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">23.3</span>An
                                                        Agent is under no obligation or requirement to agree to these
                                                        Terms and
                                                        Conditions however, in the event the Agent is unwilling or
                                                        unable to agree to the
                                                        Terms and Conditions, then they will be unable to act as Agent
                                                        and E4U may
                                                        terminate the agreement between the Agent and E4U pursuant to
                                                        clause 2.5 of that
                                                        agreement.
                                                    </li>
                                                </ol>
                                            </ol>
                                            
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
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>24.</b></span>Media
                                                    Verification
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item ">The Advertisers and Viewers acknowledge
                                                        that:
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(a)</span>E4U
                                                        provides an optional image verification procedure. Advertisers
                                                        who opt to take part in image verification must supply a
                                                        verification photo. The verification photo must show identifying
                                                        features which match the Advertiser’s Profile photos. An
                                                        Advertiser must not under any circumstances provide false or
                                                        misleading information as part of the image verification
                                                        service;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(b)</span>some
                                                        of the identifying features E4U may use are any or all of the
                                                        following (without limitation):
                                                    </li>
                                                    <!-- level 3 list -->
                                                    <ol type="1" class="cms-list cms-lvl3">
                                                        <li class="cms-list-item"><span class="cms-list-span">(i)</span>a
                                                            photo showing matching clothing or lingerie from the
                                                            Advertiser's photo shoot;
                                                        </li>
                                                        <li class="cms-list-item"><span
                                                                class="cms-list-span">(ii)</span>a photograph showing
                                                            the Advertiser's facial features;
                                                        </li>
                                                        <li class="cms-list-item"><span
                                                                class="cms-list-span">(iii)</span>a photograph showing
                                                            the Advertiser's body which matches the style of the body in
                                                            the Profile images; and
                                                        </li>
                                                        <li class="cms-list-item"><span
                                                                class="cms-list-span">(iv)</span>a photograph showing
                                                            matching features such as tattoos; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(v)</span>at
                                                            the option of the Advertiser, a form of documentation which
                                                            includes a photograph identifying the Advertiser and which
                                                            shows matching features of the Advertiser to the Profile
                                                            media.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">(c)</span>E4U
                                                        will only mark a photo with the "E4U Verified" seal, if E4U is
                                                        satisfied (in its absolute and sole discretion) that the
                                                        verification image supplied by the Advertiser closely matches
                                                        the images submitted in the Profile or the Advertiser’s media
                                                        Archive;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(d)</span>although
                                                        E4U uses all reasonable means available to verify an
                                                        Advertiser's photos, E4U does not warrant or represent that the
                                                        image is true and correct;
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(e)</span>E4U
                                                        does not warrant or represent, and provides no guarantee, that
                                                        the Advertiser that a Viewer meets in person is the same person
                                                        as that shown in the Profile images, and all Viewers must make
                                                        their own judgment and undertake their own enquiries about
                                                        whether or not to proceed with any meeting with the Advertiser;
                                                        and
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">(f)</span>image
                                                        verification only reflects E4U's reasonable opinion (after
                                                        making all reasonable enquiries) that the images in a Profile
                                                        are that of the Advertiser, and E4U will not be responsible or
                                                        liable if the images are not those of the Advertiser.
                                                    </li>
                                                </ol>
                                            </ol>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Part F - Powers -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part F - Powers
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>25.</b></span>Powers
                                                    of Escorts4U
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">25.1</span>Users generally
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">

                                                        <li class="cms-list-item">The User agrees that:
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>E4U at its sole and absolute discretion may refuse, without requiring any
                                                            notice to them, to:
                                                        </li>
                                                        <!-- level 3 list -->
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(i)</span>accept or display any Profile or any other content provided by the
                                                                User for the Website or otherwise; or
                                                            </li>
                                                            <li class="cms-list-item"><span
                                                                    class="cms-list-span">(ii)</span>allow access to the Website;
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>E4U may modify the Website or any aspect of the Service or Support
                                                            Service (including, without limitation, the Fees payable from time to time)
                                                            in any way, without notice;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>E4U may modify these Terms and Conditions, including Policies and
                                                            Guidelines, without notice to the User and such modifications will apply
                                                            from the time that they are made;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>if a User has breached these Terms and Conditions, the Acceptable
                                                            Usage Policy or any other relevant Policy, then, in addition to all other
                                                            rights and remedies available to it at law or equity or under statute, E4U
                                                            may terminate, without notice, the User's Membership (where relevant)
                                                            and access to the Website.
                                                        </li>

                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">25.2</span>Advertisers acknowledge that, in addition to the rights afforded to E4U under
                                                        clause 3, E4U reserves the right to amend, terminate or cancel any Profile,
                                                        without notice to the Advertiser and at E4U's sole and unfettered discretion, if:
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>a
                                                            complaint about the Advertiser is received from any third
                                                            party;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>if
                                                            the Advertiser is asked to provide image verification and
                                                            fails to do so, or the image verification fails;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>a third party takes any action against E4U for any act, omission or
                                                            negligence on the part of the Advertiser or Agent (including but not
                                                            limited to sending another person in their place to any appointment or
                                                            providing deceptive or misleading images of the Advertiser to E4U);
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>in the reasonable view of E4U, the Advertiser or Agent has engaged in
                                                            deceptive or misleading advertising or conduct;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(e)</span>
                                                            in the reasonable view of E4U, the User is bringing E4U or the Website
                                                            into disrepute;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(f)</span>
                                                            in the reasonable view of E4U, the Advertiser is working for
                                                            or represents an Escort Agency, contrary to these Terms and
                                                            Conditions;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(g)</span>any
                                                            form of the Advertiser's media, which contains an E4U
                                                            Verification Certificate, is found on the website of an
                                                            Escort Agency; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(h)</span>the
                                                            Advertiser's images are found on any third party website
                                                            which contains the E4U Verification Certificate, or in the
                                                            reasonable view of E4U, the ownership of any image is in
                                                            doubt.
                                                        </li>
                                                    </ol>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>26.</b></span>Representations
                                                    and Warranties
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">26.1</span>The User acknowledges and agrees that E4U has not made any
                                                        representation or given any warranties:
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>in relation to the Website; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>in relation to any information on the Website; or
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>in relation to the Services or Support Services
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">26.2</span>The Advertiser and the Viewer acknowledge that E4U is not responsible in any
                                                        way for any actions, omissions or negligence on the part of any User of the
                                                        Website and that any agreement made between an Advertiser and Viewer as
                                                        a direct or indirect result of the provision of Services, is solely and wholly
                                                        between the Advertiser and Viewer and not, under any circumstances, with
                                                        E4U.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">26.3</span>E4U
                                                        will use its reasonable endeavours to protect all private
                                                        information of a Member, in accordance with the Privacy Policy.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">26.4</span>Users acknowledge and agree that data transmission over the internet cannot
                                                        be guaranteed as totally secure. Whilst E4U will use its reasonable
                                                        endeavours to protect such information, E4U does not warrant and cannot
                                                        ensure the security of any information which is transmitted to E4U.
                                                        Accordingly, any information which an User transmits to E4U is transmitted at
                                                        their own risk, including (without limitation) private email addresses, personal
                                                        information and images. E4U takes reasonable steps to preserve the security
                                                        of such information and images, but will not be held responsible if the
                                                        information or images become public, under any circumstances.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">26.5</span>E4U gives no warranty as to accuracy, suitability or functionality of the
                                                        Website or the Services. The User acknowledges that from time to time there
                                                        may be faults, defects and errors with the Website and they will not hold E4U
                                                        responsible in this regard.
                                                    </li>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>27.</b></span>Liability,
                                                    Indemnity and Release
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">27.1</span>To
                                                        the extent permitted by law, E4U (including its respective
                                                        officers, employees, sub-contractors and appointed Agents) is
                                                        not responsible or liable whatsoever for:
                                                    </li>
                                                    <!-- level 2 list -->
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>cancellation,
                                                            modification, suspension or delay of the Services;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>the
                                                            unavailability or inaccessibility of the Services and
                                                            Website for any reason;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>any loss suffered or sustained to a person or property, including but not
                                                            limited to consequential (including economic) loss, by reason of any act
                                                            or omission, deliberate or negligent by E4U or its servants or appointed
                                                            Agents in connection with the Services, the Website and any person
                                                            agreeing to these Terms and Conditions.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.2</span>The User will at all times indemnify and keep indemnified E4U, its officers,
                                                        employees, sub-contractors and agents (Indemnified People), at all times
                                                        from any claims, demands, losses (direct and indirect), costs (including legal
                                                        and other professional costs), outgoings and liabilities of any nature, where
                                                        such loss or liability arose out of or in connection with or in respect of:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>any
                                                            and all use of the Website and Services, whether direct or
                                                            indirect, and whether or not as a result of E4U’s own act or
                                                            omission;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>any negligent act or omission of the User, including (without limitation),
                                                            sharing their username and password with any other third parties;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>any act or omission of the User which is intended to cause damage in
                                                            any way to E4U knowingly or unknowingly;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>any breach of these Terms and Conditions including Policies or
                                                            Guidelines
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(e)</span>publication of or distribution of the material or information supplied by
                                                            you;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(f)</span>E4U doing anything which the User must do under these Terms and
                                                            Conditions but has not done or which E4U considers has not done
                                                            properly; and
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(g)</span>any content or material accessed on or through the Website, or removed
                                                            from the Website.
                                                        </li>
                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.3</span>The User releases and discharges E4U from, and agree that E4U is not liable
                                                        for any claims, demands, losses (direct and indirect), costs (including legal
                                                        and other professional costs), outgoings and liabilities of any nature, arising
                                                        from anything E4U is permitted or required to do under these Terms and
                                                        Conditions and in the provision of the Services.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.4</span>The Advertiser and Viewer acknowledge that certain risks might arise from any
                                                        contract, agreement or arrangement between an Advertiser and a Viewer for
                                                        the supply of escort or other services including, but not limited to:
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item"><span class="cms-list-span">(a)</span>injury;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(b)</span>death;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(c)</span>permanent
                                                            disability;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(d)</span>sexually
                                                            transmitted diseases;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(e)</span>defamation;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(f)</span>theft;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(g)</span>rape
                                                            or other indecent assault;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(h)</span>harassment;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(i)</span>stalking;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(j)</span>bullying;
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(k)</span>suicide; and
                                                        </li>
                                                        <li class="cms-list-item"><span class="cms-list-span">(l)</span>misconduct,
                                                        </li>
                                                        <p>(together,the <b>Risks</b>).</p><br>
                                                    </ol>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.5</span>Advertisers and Viewers acknowledge and accept that they assume all
                                                        responsibility and liability for the Risks, and release and discharge E4U from,
                                                        and indemnify E4U against, any and all claims, demands, losses (direct and
                                                        indirect), costs (including legal and other professional costs), outgoings and
                                                        liabilities of any nature, arising from the Risks.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.6</span>Subject to these Terms and Conditions and this clause 27, if E4U is found to
                                                        be liable its liability is limited as set out in clause 27.7.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">27.7</span>To the maximum extent permitted by law or statute, the aggregate liability of
                                                        E4U to the Advertiser or Viewer or any other party who may have a claim
                                                        against E4U in respect of the Website and/or the Services, whether in
                                                        contract, tort (including negligence) or otherwise, shall be limited to the price
                                                        paid by the Advertiser or Viewer (if any) for the Services or the cost of their
                                                        re-supply, whichever E4U elects in its absolute discretion and for a period of
                                                        thirty (30) days from the event which gave rise to such liability.
                                                    </li>
                                                </ol>
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>28.</b></span>Disclaimer
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">28.1</span>E4U gives no warranty or representation in relation to the supply of the
                                                        Services and the User acknowledge that they have not relied on any
                                                        representation or warranty made by or on behalf of E4U in relation to the
                                                        Services.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">28.2</span>Any warranties or conditions implied by law, either by statutory instrument or
                                                        otherwise in respect of E4U or the Services, are expressly excluded to the
                                                        extent that such warranties and conditions may be lawfully excluded.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">28.3</span>The Advertiser acknowledges that they have undertaken their own inspections
                                                        and made independent enquiries in reaching any decision to purchase the
                                                        Services and Support Services pursuant to these Terms and Conditions.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">28.4</span>The Competition and Consumer Act 2010 as well as other laws in Australia
                                                        may imply certain conditions, warranties and undertakings and give the
                                                        Advertisers and Viewers other legal rights. To the extent that the Competition
                                                        and Consumer Act 2010 may apply to the Services, the Advertiser and Viewer
                                                        acknowledge that the Competition and Consumer Act 2010 cannot be
                                                        modified or excluded by any contract that the Advertiser or Viewer may
                                                        contemplate. Nothing in these Terms and Conditions generally affects their
                                                        rights under the Competition and Consumer Act and Australian consumer law
                                                        generally and the equivalent State and Territory fair trading legislation
                                                        regarding consumer guarantees to the extent that such consumer guarantees
                                                        cannot be excluded by law.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">28.5</span>For the avoidance of doubt, the Disclaimer Statement forms part of these
                                                        Terms and Conditions.
                                                    </li>
                                                </ol>
                                            </ol>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Part G - Concierge Services -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part G - Concierge Services
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>29.</b></span>The Concierge Services</li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">29.1</span>Accommodation</li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.2</span>E4U
                                                        takes 
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.3</span>The </li>
                                                </ol>
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>30.</b></span>Accommodation</li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.1</span>In addition 
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.2</span>In addition 
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(a)</span>E4U will ; and
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(b)</span>where applicable,
                                                                the Advertiser 
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                        <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>31.</b></span>Email Hosting</li>
                                                    </ol>
                                                </ol>
                                                        <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>32.</b></span>Mobile SIM</li>
                                                    </ol>
                                                    </ol>
                                                        <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>33.</b></span>Products</li>
                                                    </ol>
                                                    </ol>
                                                        <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>34.</b></span>Travel</li>
                                                    </ol>
                                                    </ol>
                                                        <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>35.</b></span>Visa & Migration</li>
                                                    </ol>
                                                </ol>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Part H - My Playbox -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part H - My Playbox
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>29.</b></span>The Services</li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">29.1</span>E4U
                                                        may
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.2</span>E4U
                                                        takes 
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.3</span>The
                                                        Website 
                                                    </li>
                                                </ol>
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>30.</b></span>Termination of Service
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.1</span>In addition 
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.2</span>In addition 
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(a)</span>E4U will ; and
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(b)</span>where applicable,
                                                                the Advertiser 
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                </ol>
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                
                        <!-- Part I - General -->
                <div class="set cms-accordion">
                    <a class="cms-accordion-title">
                        Part I - General
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <ol type="1" class="cms-lvl1-list pl-0">
                                                <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>29.</b></span>Links
                                                    to Other Websites
                                                </li>
                                                <ol type="1" class="cms-list cms-lvl2">
                                                    <li class="cms-list-item "><span class="cms-list-span">29.1</span>E4U
                                                        may from time to time provide on the Website, links to other
                                                        websites and information on those websites for the Users
                                                        convenience. This does not imply sponsorship, endorsement, or
                                                        approval or any arrangement between E4U and the owners of those
                                                        other websites. E4U takes no responsibility for any of the
                                                        content found on any linked websites
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.2</span>E4U
                                                        takes no responsibility for any of the content or material on
                                                        any linked websites. Third party websites are not under E4U’s
                                                        control.
                                                    </li>
                                                    <li class="cms-list-item "><span class="cms-list-span">29.3</span>The
                                                        Website may contain information provided by third parties for
                                                        which E4U accepts no responsibility whatsoever including,
                                                        without limitation, for information or advice provided to the
                                                        Advertiser directly by third parties such as information
                                                        relating to Concierge Services. E4U is making a
                                                        'recommendation'only and is not providing any advice regarding
                                                        the third party and the services offered. E4U is not responsible
                                                        for any advice provided to the Advertiser in this regard.
                                                    </li>
                                                </ol>
                                                <ol type="1" class="cms-lvl1-list pl-0">
                                                    <li class=" cms-lvl1-list-title"><span
                                                            class="cms-list-span"><b>30.</b></span>Termination
                                                    </li>
                                                    <ol type="1" class="cms-list cms-lvl2">
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.1</span>In addition to all
                                                            other rights and remedies available to it at law or equity
                                                            or statute, E4U may terminate this agreement with a User as
                                                            set out in these Terms and Conditions, at any time and
                                                            without notice.
                                                        </li>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.2</span>In addition to all
                                                            other rights and remedies available to it at law or equity
                                                            or statute, upon termination:
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl3">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(a)</span>E4U will remove the
                                                                User's access to the Website; and
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">(b)</span>where applicable,
                                                                the Advertiser authorises E4U to debit their
                                                                Card immediately for any outstanding Fees, if any, that
                                                                the Advertiser may owe E4U.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span">30.3</span>The obligations of the
                                                            User under any clause of these Terms and Conditions, survive
                                                            the termination of this agreement.
                                                        </li>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>31.</b></span>
                                                            Assignment
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">31.1</span>E4U may at any time
                                                                assign all or any of its rights and liabilities arising
                                                                under these Terms and Conditions.
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">31.2</span>A User is not
                                                                entitled to assign or purport to assign any of its
                                                                rights or liabilities under these Terms and Conditions
                                                                without the prior written consent of E4U(which consent
                                                                may be given or withheld or given subject to conditions
                                                                in absolute discretion of E4U).
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>32.</b></span>Acceptable
                                                            Usage Policy, Legal Statements and Policies
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item ">Users agree that the Legal
                                                                Statements, Policies and Guidelines contained within the
                                                                Website form part of these Terms and Conditions and if
                                                                there is any conflict between these Terms and Conditions
                                                                and the Policies, then these Terms and Conditions will
                                                                prevail to the extent of any inconsistency.
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>33.</b></span>
                                                            Discrimination Policy
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">33.1</span>Application
                                                            </li>
                                                            <li class="cms-list-item pl-4 ml-3">This policy applies to
                                                                all users of the Website, Advertisers, Viewers, Services
                                                                and the Website.
                                                            </li>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">33.2</span>Discrimination
                                                            </li>
                                                            <ol type="1" class="cms-list cms-lvl3">
                                                                <li class="cms-list-item "><span class="cms-list-span">(a)</span>E4U
                                                                    takes seriously its responsibility to comply with
                                                                    all anti-discrimination laws.
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(b)</span>E4U
                                                                    has taken all reasonable steps to ensure it is at
                                                                    all times complying with all anti-discrimination
                                                                    laws, and that the Services do not portray people or
                                                                    depict material in a way which discriminates against
                                                                    or vilifies a person or section of the community on
                                                                    account of race, ethnicity, nationality, gender,
                                                                    age, sex, sexual orientation, transgender status,
                                                                    marital status,family responsibilities, religion,
                                                                    disability or impairment, mental illness,political
                                                                    belief or activity, religious belief or activity,
                                                                    breast feeding or any other attribute identified
                                                                    under State, Territory or Federal
                                                                    anti-discrimination or human rights legislation, or
                                                                    personal association with a person with the
                                                                    attributes identified.
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(c)</span>If
                                                                    an Advertiser or Viewer believes that any aspect of
                                                                    the Website or the Services contravenes any
                                                                    anti-discrimination laws, they should bring the
                                                                    alleged breach to the attention of E4U and request
                                                                    that E4U resolve the issue.
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">33.3</span>Compliance by
                                                                Advertisers
                                                            </li>
                                                            <ol type="1" class="cms-list cms-lvl3">
                                                                <li class="cms-list-item "><span class="cms-list-span">(a)</span>Advertisers
                                                                    must comply with all State, Territory and
                                                                    Federal anti-discrimination laws which may affect
                                                                    them.
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(b)</span>
                                                                    if an Advertiser is found to be in breach of any
                                                                    anti-discrimination law(including but not limited to
                                                                    an Advertiser's Profile or their conduct breaches any
                                                                    anti-discrimination law) E4U reserves the right to
                                                                    immediately cancel the Membership without refund
                                                                    (except as required at law) and any Profile or Tour
                                                                    will be immediately removed from the Website.
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>34.</b></span>Unforeseen
                                                            Circumstances
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item ">E4U will not be responsible for
                                                                any failure to perform due to unforeseen circumstances
                                                                or to causes beyond our reasonable control, including
                                                                but not limited to acts of God, war, riot, embargoes,
                                                                acts of civil or military authority, or terrorism, fire,
                                                                flood, earthquakes, hurricanes, tropical storms or other
                                                                natural disasters,pandemics, fibre cuts, strikes, or
                                                                shortages in transportation, facilities, fuel, energy,
                                                                labour or materials, failure of the telecommunications
                                                                or information services infrastructure, hacking, SPAM,
                                                                or any failure of a computer, server or software,
                                                                including errors or omissions, for so long as such event
                                                                continues to delay the Websites performance.
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>35.</b></span>General
                                                        </li>

                                                        <li class="cms-list-item "><span
                                                                class="cms-list-span ml-4 pl-3">35.1</span>Severability
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item pl-5">If a provision of these Terms
                                                                and Conditions is held to be invalid or unenforceable in
                                                                whole or in part, the provision is ineffective only to
                                                                the extent of the invalidity or unenforceability and the
                                                                validity or enforceability of all other provisions of
                                                                the Terms and Conditions.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item ml-4 pl-3"><span class="cms-list-span">35.2</span>Notices
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item pl-5">A party may validly give a
                                                                notice to another party only by:
                                                            </li>
                                                            <ol type="1" class="cms-list cms-lvl3">
                                                                <li class="cms-list-item "><span class="cms-list-span">(a)</span>
                                                                    personally serving the notice on the other party
                                                                    (the notice is treated as received at the time of
                                                                    service of the notice); or
                                                                </li>
                                                                <li class="cms-list-item"><span class="cms-list-span">(b)</span>
                                                                    <span>emailing the notice to the <a href="{{url('contact-us')}}">email address</a> of the other party and the email will be deemed to have been received within 24 hours of the time that the email is sent, as long as the sender has not received a notice that the email was unable to the sent, or delivered.</span>
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                        <li class="cms-list-item ml-4 pl-3"><span class="cms-list-span">35.3</span>Governing
                                                            law and jurisdiction
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item pl-5">The law of Western Australia
                                                                governs these Terms and Conditions and the Advertiser
                                                                and Viewer submit themselves to the jurisdiction of the
                                                                courts of that State to determine any dispute arising
                                                                out of the Website and these terms and Conditions.
                                                            </li>
                                                        </ol>
                                                        <li class="cms-list-item ml-4 pl-3"><span class="cms-list-span">35.4</span>Waiver
                                                        </li>

                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item pl-5">Waiver of a breach of, or
                                                                default under, these Terms and Conditions or of
                                                                any right, power, authority, discretion or remedy created
                                                                or arising upon a breach of, or default under, these
                                                                Terms and Conditions:
                                                            </li>
                                                            <ol type="1" class="cms-list cms-lvl3">
                                                                <li class="cms-list-item "><span class="cms-list-span">(a)</span>is
                                                                    not waived by any failure to exercise or delay in
                                                                    exercising or partial exercise of any right, power,
                                                                    authority, discretion or remedy under these Terms and
                                                                    Conditions; and
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(b)</span>must
                                                                    be in writing and signed by the party granting the
                                                                    waiver.
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                        <li class="cms-list-item ml-4 pl-3"><span class="cms-list-span">35.5</span>Amendments
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item pl-5">E4U reserves the right to
                                                                amend the Terms and Conditions at any time with
                                                                or without further notice to you and without giving you
                                                                any explanation or justification for such change; and the
                                                                User agrees to be bound by the Terms and Conditions as
                                                                amended.
                                                            </li>
                                                        </ol>
                                                    </ol>
                                                    <ol type="1" class="cms-lvl1-list pl-0">
                                                        <li class=" cms-lvl1-list-title"><span class="cms-list-span"><b>36.</b></span>Definitions
                                                            and Interpretation
                                                        </li>
                                                        <ol type="1" class="cms-list cms-lvl2">
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">36.1</span> Definitions
                                                            </li>
                                                            <li class="cms-list-item pl-5"> In these Terms and
                                                                Conditions unless the contrary intention appears or the
                                                                context otherwise requires:
                                                            </li>
                                                            <p class="d-block pl-5" id="B1"><b>Acceptable Usage Policy:</b> means
                                                                the Acceptable Usage Policy which governs the use of the
                                                                Website and which are set out in the footer of the
                                                                Website under the heading “Legal”;
                                                            </p>
                                                            <p class="d-block pl-5" id="B2"><b>Account:</b> means the collective
                                                                and personal information of a Member;</p>
                                                            <p class="d-block pl-5"><b>Advertiser:</b> means either of or
                                                                collectively an Escort or Massage Centre who advertises
                                                                on the Website and has requested the Services of E4U in
                                                                respect to the provision of a Profile or Concierge
                                                                Services or Support Services and in accordance with these
                                                                Terms and Conditions. Where the Advertiser appoints an
                                                                Agent to act for them on their behalf, a reference to
                                                                the Advertiser includes a reference to their agent;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Advertiser Console:</b> means the
                                                                Advertiser’s information management tool on the Website
                                                                that visually displays an Advertiser’s account details;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Advertising Request:</b> means a
                                                                request to post a Profile or Tour on the Website by an
                                                                Advertiser;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Agent Console:</b> means the Agent
                                                                information management tool on the Website that visually
                                                                displays an Agent’s account details and enables access
                                                                to the applications for the Agent to manage Advertisers;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Archive:</b> means the structure
                                                                of a set of personal data contained in the Account and
                                                                which is used to compile a Profile or Profiles or Tour,
                                                                and which is accessible by the Advertiser according to
                                                                specific criteria attached to the Profile or Tour, and
                                                                which is stored in folders according to the geographic
                                                                location;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Concierge Services:</b> means any
                                                                of or all of the concierge services provided by E4U to
                                                                an Advertiser on the Website and which are accessed
                                                                through the Advertiser Console;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Competition and Consumer Act:</b>
                                                                means the <i>Competition and Consumer Act 2010
                                                                    (Cth);</i>
                                                            </p>
                                                            <p class="d-block pl-5"><b>Corporations Act:</b> means the
                                                                <i>Corporations Act 2001 (Cth);</i>
                                                            </p>
                                                            <p class="d-block pl-5"><b>E4U:</b> is the trading entity of
                                                                Blackbox Tech ACN 606 776 096, the owner of the
                                                                Website;
                                                            </p>
                                                            <p class="d-block pl-5"><b>E4U Verification Certificate:</b>
                                                                means the seal placed on an Advertiser’s media
                                                                confirming the media has been verified by E4U as being
                                                                authentic;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Escort:</b> means a person who
                                                                works as a private escort, offers companionship and time
                                                                to other people and does not work in or for an Escort
                                                                Agency. Where the Escort appoints an agent to act for
                                                                them or on their behalf, a reference to the Escort
                                                                includes a reference to their agent;</p>
                                                            <p class="d-block pl-5"><b>Escort Agency:</b> means a
                                                                business which facilitates or arranges for the provision
                                                                of sexual services to persons at premises made available
                                                                by the said agency;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Escort Profile:</b> means the
                                                                collective information posted by an Escort setting out
                                                                in formation in relation to a Profile or Tour;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Fees:</b> means the fees, which
                                                                are set out on the Website (as amended from time to
                                                                time) and which are payable by the Advertiser for
                                                                posting a Profile or Tour on the Website or taking up
                                                                any of the Concierge Services or Support Services;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Geolocation:</b> means the
                                                                technology that is used by E4U to identify a
                                                                User’s computer or mobile device physical location;
                                                            </p>
                                                            <p class="d-block pl-5"><b>GST:</b> means any tax, levy,
                                                                charge, or impost implemented under the GST Act;</p>
                                                            <p class="d-block pl-5"><b>GST Act:</b> means the A New Tax
                                                                System <i>(Goods and Services Tax) Act 1999(Cth)</i> or an Act
                                                                of the Parliament of the Common wealth of
                                                                Australia substantially in the form of or which has a
                                                                similar effect to the GST Act;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Home State:</b> means the State
                                                                that the User has domiciled as where they reside;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Legal Statements:</b> means the
                                                                collective of any, either or all of the statements set
                                                                out in the Website footer under the heading Legal;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Massage Centre/s:</b> means a
                                                                registered business or incorporated body pursuant to the
                                                                Corporations Act and which operates as a massage centre
                                                                and has Membership with E4U and accesses the Website in
                                                                accordance with these Terms and Conditions. Where the
                                                                Massage Centre appoints an agent to act for them or on
                                                                their behalf, a reference to the Massage Centre includes
                                                                a reference to their agent;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Masseur/s:</b> means a person who
                                                                works in a Massage Centre and whose information is
                                                                incorporated into and forms a part of the Massage Centre
                                                                Profile;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Massage Centre Profile:</b> means
                                                                the collective information posted by a Massage Centre
                                                                setting out information in relation to a Profile;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Member</b> and <b>Membership:</b>
                                                                means an Escort or Massage Centre or Viewer who has or
                                                                which has applied for membership by completing and
                                                                submitting the online membership application, or has
                                                                proceeded to access the Services and whose membership
                                                                has not been determined, is suspended or cancelled;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Policies:</b> means either or both
                                                                of Community or Legal information referred to as a Policy
                                                                or that has the header ‘Policy’ contained in the footer
                                                                of the Website under the respective headings;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Profile:</b> means a web page
                                                                containing information advertising the services of
                                                                either of or both of an Escort Profile or Massage Centre
                                                                Profile and which is posted on the Website;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Prospective User:</b> means a
                                                                person within Australia who may register themselves on
                                                                the Website;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Registration:</b> means the
                                                                process undertaken on the Website by a Prospective User
                                                                requesting Membership and which includes the Prospective
                                                                User nominating the Home State;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Related Entity</b> or <b> Related
                                                                    Party</b> or <b> Associated Entity:</b> has the same
                                                                meaning as ascribed to each of those terms pursuant to the
                                                                <i>Corporations Act 2001
                                                                (Cth)</i>;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Risks:</b> has the collective
                                                                meaning ascribed under clause 27.4;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Services:</b> means all of the
                                                                services provided by E4U to an Advertiser, including the
                                                                Concierge Services, and Viewer pursuant to these Terms
                                                                and Conditions and include digital and online services to
                                                                advertise escort services (Profile),including websites,
                                                                applications (apps), email and social media and to
                                                                provide web design service through a Profile to
                                                                Advertisers;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Support Services:</b> means
                                                                services provided to an Advertiser by E4U or an Agent
                                                                and are undertaken in relation to the Services;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Terms and Conditions:</b> means
                                                                these terms and conditions as amended from time to time
                                                                by E4U, at its sole discretion, and without the
                                                                requirement of any notice to the Advertiser or Viewer,
                                                                and which also incorporates the Policies and Legal
                                                                Statements;
                                                            </p>
                                                            <p class="d-block pl-5"><b>Tour:</b> means the collective
                                                                posting of Profiles conjoined over a period of time;</p>
                                                            <p class="d-block pl-5"><b>User:</b> means either of or
                                                                collectively an Advertiser, Agent or Viewer;</p>
                                                            <p class="d-block pl-5"><b>Viewer/s:</b> means a person who
                                                                has completed Registration, is not an Advertiser or
                                                                Agent, and accesses the Website;</p>
                                                            <p class="d-block pl-5"><b>Website:</b> means the websites <a
                                                                    href="https://www.e4u.com.au/">www.e4u.com.au</a>
                                                                and <a
                                                                    href="www.escorts4u.com.au">www.escorts4u.com.au</a>
                                                                or
                                                                such other website or social media platforms operated by
                                                                E4U from time to
                                                                time from which the Services are provided.
                                                            </p>
                                                            <li class="cms-list-item "><span
                                                                    class="cms-list-span">36.2</span> Interpretation
                                                            </li>
                                                            <li class="cms-list-item pl-5"> In these Terms and
                                                                Conditions unless the contrary intention appears or the
                                                                context otherwise requires:
                                                            </li>
                                                            <ol type="1" class="cms-list cms-lvl3">
                                                                <li class="cms-list-item "><span class="cms-list-span">(a)</span>clause
                                                                    and sub-clause headings are for reference purposes
                                                                    only;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(b)</span>the
                                                                    singular includes the plural and vice versa;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(c)</span>words
                                                                    denoting any gender include all genders;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(d)</span>reference
                                                                    to a person includes any other entity recognised by
                                                                    law and vice versa;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(e)</span>
                                                                    where a word or phrase is defined its other
                                                                    grammatical forms have a corresponding meaning;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(f)</span>any
                                                                    reference to a party to these Terms and Conditions
                                                                    includes its successors and permitted assigns;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(g)</span>
                                                                    if a party consists of more than one person, these
                                                                    Terms and Conditions binds them jointly and each of
                                                                    them severally;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(h)</span>any
                                                                    reference to any agreement or document includes that
                                                                    agreement or document as amended at any time;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(i)</span>the
                                                                    use of the word includes or including is not to be
                                                                    taken as limiting the meaning of the words preceding
                                                                    it;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(j)</span>
                                                                    the expression at any time includes reference to
                                                                    past, present and future time and the performance of
                                                                    any action from time to time;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(k)</span>
                                                                    an agreement, representation or warranty on the part
                                                                    of two or more persons binds them jointly and
                                                                    severally;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(l)</span>
                                                                    an agreement, representation or warranty on the part
                                                                    of two or more persons is for the benefit of them
                                                                    jointly and severally;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(m)</span>reference
                                                                    to a provision described, prefaced or qualified by
                                                                    the name, heading or caption of a clause, subclause,
                                                                    paragraph, schedule, item, annexure, exhibit or
                                                                    attachment in these Terms and Conditions means a
                                                                    cross reference to that clause, subclause,
                                                                    paragraph, schedule, item, annexure, exhibit or
                                                                    attachment;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(n)</span>reference
                                                                    to a statute includes all regulations and amendments
                                                                    to that statute and any statute passed in
                                                                    substitution for that statute or incorporating any
                                                                    of its provisions to the extent that they are
                                                                    incorporated;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(o)</span>any
                                                                    definition set out in the "Abbreviations" contained
                                                                    in the footer of the Website are to be read with and
                                                                    form a part of these Terms and Conditions and may
                                                                    not be construed adversely to any part of this
                                                                    clause 26;
                                                                </li>
                                                                <li class="cms-list-item "><span class="cms-list-span">(p)</span>these
                                                                    Terms and Conditions may not be construed adversely
                                                                    to a party only because that party was responsible
                                                                    for preparing it.
                                                                </li>
                                                            </ol>
                                                        </ol>
                                                    </ol>
                                                </ol>
                                                
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
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions')}}">Terms
                                                    and Conditions</a> from time to time to review the most current
                                                version.
                                            </p>
                                            <p>
                                                Escorts4U archives all previous versions of the Terms and Conditions
                                            </p>
                                            <p><b>This policy was last updated 24-01-2024</b></p>
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
