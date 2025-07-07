@extends('layouts.web')
@section('style')
    <style>
        .table2 {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table2 th {
            padding: 0.55rem;
        }
        .table2 tbody td {
            color: #192A3E;
            font-family: 'Poppins';
            font-weight: normal;
            font-size: 16px;
        }
        .table2 td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table2 thead {
            border-bottom: 2px solid #000000;
        }
        .table2 th {
            padding: 0.75rem;
            vertical-align: top;
            border-top: none;
        }
        .table2 td:first-child {
            font-weight: bold;
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


            <h1 class="home_heading_first margin_btm_twenty_px">Help for Escorts</h1>

            <div class="accordion-container">
                <div class="set">
                    <a>
                        Membership
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: Is Membership free?</b></p>
                            <p>Yes, there are no fees to pay for Membership. You only pay for the Services you use.
                                And your first two weeks advertising with us are free!</p>
                            <p>Create and refine your Profile over the two weeks and then decide if you want to
                                continue using us. There are no restrictions placed on how your Profile is published
                                except that you will not feature at the top of the Escort Home Page under the
                                Membership Type - Free.</p>
                            <p>All of our paying Advertisers are prioritised to the front of the Escort Home Page
                                according to the Membership Type they choose when publishing their Profile. You can
                                elect to become a paying Advertiser at any time. If you never advertise with us, your
                                Account will always remain and there are no Fees.
                            </p>
                            <p>Registered Viewers will have full access to your Profile including unrestricted
                                communication rights should you have the texting and email features enabled.</p>
                            <p><b>Q: Are there any great features available to me?</b></p>
                            <p>Yes. We have a number of great features to enhance your Profile and relationship
                                building with Viewers. You can:
                            </p>
                            <ul>
                                <li>Switch on and off the ‘Be Right Back’ feature. Let the Viewers know when you are
not available to meet, but they still can view your Profile</li>
                                <li>Send an "A-Alert" to registered Viewers, who have flagged you in their Legbox,
                                    when you are visiting their Location
                                </li>
                                <li>Suspend your Profile at any time</li>
                                <li>Exchange pictures within the chat facility (if the feature is enabled by the User)
                                </li>
                                <li>Create and archive Profiles, ready to activate at any time or to create a Tour;
                                    and
                                </li>
                                <li>Much more ...
                                </li>
                            </ul>
                            <p><b>Q: Are there any loyalty programs?</b></p>
                            <p>Absolutely. Escorts4U will reward you for your loyalty. A simple program, for every
                                $200.00 in advertising an Escort spends with us, we will reward you with 1 day of free
                                advertising (Platinum and Gold level). And for a Massage Centre, every $500.00 you
                                spend with us we will reward you with 1 day of free advertising. You can use your
                                rewards any time you like, or accumulate your rewards and use them all at once, it is
                                entirely up to you.</p>
                            <p>Discounts to advertising Fees also apply once you spend over a certain amount. The
                                discounts are very generous.
                            </p>
                            <p><b>Q: Can I get help to manage my Account?</b></p>
                            <p>Yes you can. Our support team will help you manage your Account or alternatively,
                                you can reach out to an Agent. An Agent will assist you with:
                            </p>
                            <ul>
                                <li>Managing your Account details and Profile Information</li>
                                <li>Managing your Media (photo images and video)</li>
                                <li>Creating your Profiles and Tours</li>
                                <li>Any of the Concierge Services; and</li>
                                <li>Generally, be there for you</li>
                            </ul>
                            <p>You can appoint an Agent at any time by either:</p>
                            <ul>
                                <li>Nominating the Agent as a part of the registration process; or by</li>
                                <li>Requesting an Agent to be appointed by lodging a request through your
                                    Dashboard.
                                </li>
                            </ul>
                            <p>When you appoint an Agent, you enter into an arrangement with the Agent directly for
                                the Agent to provide the Agent Services. The Agent will have full access to your
                                Account.</p>
                                 
                        </div>
                    </div>
                </div>
                
                <div class="set">
                    <a>
                        Membership Packages
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: What are the packages?</b></p>
                            <p>Packages are designed around the Membership Type you choose on the day you post your
                                Profile. You can change a Profile Package anytime during the advertised period.</p>
                            <div class="table-responsive-sm">
                                <table class="table" style="border: 1px;">
                                    <thead>
                                    <tr>
                                        <th>Features<sup style="font-size: smaller">(1)</sup></th>
                                        <th>Platinum</th>
                                        <th>Gold</th>
                                        <th>Silver</th>
                                        <th>Free</th>
                                        <th>Comments</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><p>Carousel Position</p></td>
                                        <td><p>Top of page</p></td>
                                        <td><p>After Platinum</p></td>
                                        <td><p>After Gold</p></td>
                                        <td><p>Bottom of page</p></td>
                                        <td><p>Profiles within each Membership Type rotate every 2 hours</p></td>
                                    </tr>
                                    <tr>
                                        <td><p>Priority Search</p></td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Search results displayed according to your Membership Type</td>
                                    </tr>
                                    <tr>
                                        <td>Short list me</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>&#x2717;</td>
                                        <td>Search results displayed according to your Membership Type</td>
                                    </tr>

                                    <tr>
                                        <td>Home page - Pin Up</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Display your Thumbnail exclusively on the home page</td>
                                    </tr>
                                    <tr>
                                        <td>Banner Image</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Landscape image across the top of your Profile</td>
                                    </tr>
                                    <tr>
                                        <td>Thumbnail - List View</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Larger thumbnail for Platinum reducing down to Silver</td>
                                    </tr>
                                    <tr>
                                        <td>Thumbnail - Grid View</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Larger thumbnail for Platinum reducing down to Silver</td>
                                    </tr>
                                    <tr>
                                        <td>Thumbnail - Profile View</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Same size for all Membership Types, including 6 smaller photos</td>
                                    </tr>
                                    <tr>
                                        <td>Video (640px x 360px)</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>&#x2717;</td>
                                        <td>Limited to 30 seconds play with up to 3 videos per Profile</td>
                                    </tr>
                                    <tr>
                                        <td>Touring Schedule</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Set your arrival and departure times for each Location</td>
                                    </tr>
                                    <tr>
                                        <td>Availability Summary</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Let your clients know when you are available for companionship</td>
                                    </tr>
                                    <tr>
                                        <td>Service Listing</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>A complete itemised display of the Services on offer</td>
                                    </tr>
                                    <tr>
                                        <td>Profile Summary</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>A structured summary of you, like "Age" and "Nationality"</td>
                                    </tr>
                                    <tr>
                                        <td>Rate Summary</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Summarise your rates according to the time spent with your client</td>
                                    </tr>
                                    <tr>
                                        <td>Photo Verification</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Have your photos display our E4U Verification Icon</td>
                                    </tr>
                                    <tr>
                                        <td>Social Media Summary</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>&#x2717;</td>
                                        <td>List all of your social media profiles</td>
                                    </tr>
                                    <tr>
                                        <td>Alert Notifications</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>&#x2717;</td>
                                        <td>Forward your followers A-Alert notifications ahead of your arrival</td>
                                    </tr>
                                    <tr>
                                        <td>Support Tickets</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>

                                        <td>Private foot printed communication with our support team</td>
                                    </tr>
                                    <tr>
                                        <td>Chat Service</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Have private chats with your followers, exchange images</td>
                                    </tr>
                                    <tr>
                                        <td>Home Location</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>You can set your Home State (where you are domiciled)</td>
                                    </tr>
                                    <tr>
                                        <td>Access to your Reviews</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>You can view any review posted about you</td>
                                    </tr>
                                    <tr>
                                        <td>National Ugly Mugs(NUM) List</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>&#x2717;</td>
                                        <td>Report difficult incidents with clients in real time</td>
                                    </tr>
                                    <tr>
                                        <td>NUM Alerts<sup style="font-size: smaller">(2)</sup></td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>Receive an Alert by text or email of a dangerous individual</td>
                                    </tr>
                                    <tr>
                                        <td>Archive your Profiles</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Archive all of your Profiles and Media, activating anytime</td>
                                    </tr>
                                    <tr>
                                        <td>Transfer Credits</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Transfer any credits you have when you up-rate your Profile</td>
                                    </tr>
                                    <tr>
                                        <td>Analytics</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>View all your statistics in your Dashboard</td>
                                    </tr>
                                    <tr>
                                        <td>Daily Rate<sup style="font-size: smaller">(3)</sup></td>
                                        <td>$8.00</td>
                                        <td>$6.00</td>
                                        <td>$4.00</td>
                                        <td>14 days</td>
                                        <td>You choose the number of days you want to advertise your Profile</td>
                                    </tr>
                                    <tr>
                                        <td>Bulk Discounts<sup style="font-size: smaller">(3)</sup></td>
                                        <td>$7.50</td>
                                        <td>$7.50</td>
                                        <td>$3.80</td>
                                        <td>&#x2717;</td>
                                        <td>A fixed weekly fee to be exclusively featured on the home page</td>
                                    </tr>
                                    <tr>
                                        <td>Home Page Pin Up</td>
                                        <td>$475.00</td>
                                        <td>$475.00</td>
                                        <td>$475.00</td>
                                        <td>None</td>
                                        <td>Discounts apply to advertisements for 22 days or more</td>
                                    </tr>
                                    <tr>
                                        <td>Loyalty Program</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Escort: Spend $200.00 in advertising, get 1 day free Massage Centre: Spend
                                            $500.00 in advertising, get 1 day free
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>My Playbox</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>✓</td>
                                        <td>&#x2717;</td>
                                        <td>Upload your content for Viewers to see by payment.  You retain 90% of the revenue collected.  A My Playbox icon appears on any Profile you post to let Viewers know you have a Playbox.
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p><b>Notes: </b> 1 Feature availability is subject to the <a
                                    href="{{ url('law-enforcement')}}"
                                    class="termsandconditions_text_color">Local Laws</a></p>
                            <ul style="list-style:none; padding-left: 46px;">
                                <li>2 Monthly fee of $5.00 (to cover SMS costs)</li>
                                <li>3 Payment by Card</li>
                            </ul>


                            <p><b>Some other great services</b></p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Service</th>
                                    <th scope="col">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><b>Products</b></td>
                                    <td>Order products to be delivered to your door or posted to your nominated address
                                        (dependant on your Location)
                                    </td>
                                </tr>
                                <tr>

                                    <td><b>Telecommunications</b></td>
                                    <td>Order a SIM for your mobile phone and an email account to meet Australian
                                        standards
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Travel & Accommodation</b></td>
                                    <td>Complete all of your travel and accommodation bookings online with us</td>
                                </tr>
                                <tr>
                                    <td><b>Visa & Migration services </b></td>
                                    <td>Let us help you with all of your visa, migration and education placement needs
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Membership Types
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: Who can register for Membership?</b></p>
                            <p>There are several types of Membership available:</p>
                            <ul>
                                <li>Independent Escorts</li>
                                <li>Massage Centres</li>
                                <li>Viewers (it is free); and</li>
                                <li>Agent, management services for Escorts and Massage Centres</li>
                            </ul>
                            <p><b>Q: What is the effect on me according to the Membership type I select?</b></p>
                            <p>We have a range of Membership options that are sure to fit in with your needs.</p>
                            <p>Depending on the Viewer's display preference, the Search Page will present in either a
                                "List View" or "Grid View" format. Viewers can then select to view your Profile. You
                                will
                                always rank within your Membership Type in all search results irrespective of which
                                format the Viewers choose to view the Escort Home Page. Each Membership Type
                                reshuffles every 2 hours enabling all Advertisers to appear first from time to time
                                within
                                their respective Membership Type on the Escort Home Page.</p>
                            <p>A viewer can ‘flag’ your Profile and then view the list of Profiles from within the
                                Escort
                                Home Page that they have selected. A registered Viewer can go one step further by
                                adding your Profile to their Legbox. That will entitle them to receive notifications
                                from
                                you as well as having communication capability with you should you have those
                                features enabled.</p>
                            <p>Each Membership Type enjoys certain benefits according to that Membership Type.
                                The following table summarises the distinctions between each Membership Type
                                according to the format:</p>

                            <table class="table2">
                                <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col" style="border-left: 2px solid #000000;">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>Platinum</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Platinum Membership always ranks at the top of the Escort Home Page.
                                        <p><b>List View:</b> Your Thumbnail photo is 142px x 200px. Rates, review
                                            rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 200px x 281px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.</p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video
                                            can pop up.
                                        </p>
                                    </td>
                                </tr>

                                <tr>

                                    <td>Gold</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Gold Membership ranks behind Platinum and before Silver.
                                        <p><b>List View:</b> Your Thumbnail photo is 112px x 157px. Rates, review
                                            rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 163px x 229px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video
                                            can pop up
                                        </p>
                                    </td>
                                </tr>


                                <tr>

                                    <td>Silver</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Silver Membership ranks behind Gold and before Free.
                                        <p><b>List View:</b> Your Thumbnail photo is 102px x 144px. Review rating,
                                            available to, verification and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b> Your Thumbnail photo is 136px x 191px. Hourly rate,
                                            services,
                                            gender, orientation and view rating are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            Thumbnail is 420px x 600px together with 6 additional photos
                                            and a video player 640px x 360px. All photos and the video can
                                            pop up.
                                        </p>
                                    </td>
                                </tr>


                                <tr>

                                    <td>Free</td>
                                    <td style="border-left: 2px solid #000000;">
                                        Free Membership ranks behind Silver
                                        <p>Escort Home Page: You will appear after paid listings in all Search Page
                                            results and Profile shortlist displays.</p>
                                        <p><b>List View:</b> Your Thumbnail is displayed as a silhouette 79px x 116px.
                                            Available to and your 'Who I am' are displayed.</p>
                                        <p><b>Grid View:</b>Your Thumbnail is displayed as a silhouette 100px x 145px.
                                            Hourly rate and services are included in the display.
                                        </p>
                                        <p><b>Profile Page:</b> A comprehensive and informative summary about you. Your
                                            thumbnail photo is 420px x 600px together with 6 additional
                                            photos 100px x 100px. No video is available. All photos can
                                            pop up.</p>
                                        <p>If you receive over a certain number of Profile views or telephone number
                                            clicks during the free 14 day period you will be informed and notified to
                                            upgrade to a paying Membership Type.</p>
                                        <p>We do this to provide for the fairest distribution of leads between our Free
                                            Members. If you do not elect to become a paying Member, your Profile will be
                                            suspended. You will still be able to log onto your Account at any time to
                                            upgrade your Membership Type.</p>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p>If you upgrade your Membership Type you will not lose any remaining days you have paid
                                for. They will be applied automatically if you do not continue at the higher Membership
                                Type</p>
                                
                        </div>
                    </div>
                </div>

                <div class="set">
                    <a>My Playbox
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: What is My Playbox?</b></p>
                            <p>My Playbox is a subscription service within the Website for Creators to earn additional
revenue based off their Profiles. Viewers can go to a Creator’s Playbox by simply clicking the My Playbox icon which appears on any Profile an Escort posts. The
Viewer selects the Content they wish to view, once on the Creators Playbox page, and pays the Viewer Payment set by the Creator.
                            </p>
                            <p>Viewers pay to view the Content either as a pay-per-view or by subscription.</p>
                            <p><b>Q: How does it work?</b></p>
                            <p>If a Creator has uploaded content to their Playbox, the My Playbox icon appears on any Profile they publish. The Viewer simply clicks the icon which will take them to the
Escorts Playbox page. This is particularly helpful for Viewers to get to see an Escort who they are considering meeting with.
                            </p>
                            <p><b>Q: How do I activate My Playbox?</b>
                            </p>
                            <p>Go to your Account and simply enable the service in your settings.
                            </p>
                            <p><b>Q: How are my earnings calculated?</b>
                            </p>
                            <p>As a Creator selling Content and subscriptions you will earn 90% of what Viewers pay you.</p>
                            <p><b>Q: How frequent are payouts?</b></p>
                            <p>Payouts are made on the 1st of the month by bank transfer.</p>
                            <p><b>Are there any terms and conditions?</b></p>
                            <p>Yes. There are terms & conditions (Playbox Terms) that you need to agree to before you can set up your Playbox. The Playbox Terms are specific to the My Playbox
service.
                            </p>
                             
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Payments
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: How do I pay for advertising?</b></p>
                            <p>Payment, by Card, is requested when you post a Profile or Tour or take up any of the
                                Concierge Services. If you renew your Profile, your Card will be debited automatically.
                            </p>
                            <p><b>Q: Does Escorts4U retain my Card details?</b></p>
                            <p>Our secure, third-party payments provider retains your details. Escorts4U does not
                                directly retain your Card details.
                            </p>
                            <p><b>Q: Can I transfer Credits I have earn't from my Loyalty program?</b>
                            </p>
                            <p>Yes, when you create a Profile or Tour, any Credits you have will be displayed and you
                                will have the option to utilise them.
                            </p>
                            <p><b>Q: What is the easiest way to pay?</b>
                            </p>
                            <p>There are effectively three payment options, all with your Card, namely:</p>
                            <ul>
                                <li>Pay as you go. If you post a Profile for 3 days, you only pay for 3 days.</li>
                                <li>Pay in advance. You can pay a lump sum into your Account and then draw down
                                    on those funds as you post and renew your Profiles or Tours.
                                </li>
                                <li>Pay and renew. You pay for the number of days you have selected for your Profile,
                                    and elect to automatically renew your Profile each nominated period thereafter (like
                                    every 5 days) and for the nominated occurrences (like for 3 renewals).
                                </li>

                            </ul>
                            <p>All transactions are completed using SMS 2FA and are confirmed by email notification
                                to you. You can also view all of your purchase history from your Dashboard.
                            </p>
                            <p><b>Q: How do you set prices?</b></p>
                            <p>Our main objective is to provide value-for-money in an effective way. Our pricing is
                                defined on a daily per Location basis with discounts applying for longer booking
                                periods (22 days or more). We only raise prices (and not often) when the number of
                                enquiries and Advertisers goes over a certain level. This is to maintain the number of
                                Platinum and Gold listings at a level where each paid advertisement will continue to
                                receive the number of enquiries the Member expects from us.</p>
                            <p>We introduced variable pricing (Membership Types) after talking to many Advertisers
                                who were asking how they could get more exposure and indicated they were willing to
                                pay more if they could stand out.
                            </p>
                            <p>You also have the option of appearing on the Home Page as the Pin Up for your
                                Home State or Location if you are touring. You can register to activate this feature
                                through your Dashboard. Your Profile is posted as the Pin Up for an exclusive seven
                                day period. This is a very popular feature and registration is required. You will be
                                notified when your turn becomes available and asked if you still wish to proceed with
                                the listing. If you confirm you wish to proceed, your Profile will appear in the Pin Up
                                position the following day. Your Card will be automatically debited.</p>
                                
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Profile Images and Video
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: Can I use fake images if they look very similar to me?</b></p>
                            <p>Absolutely not. We have a strict policy that all images must belong to the Escort, and
                                be of themselves. This is mandatory and there is no negotiation on this policy.

                            </p>
                            <p><b>Q: Is it a requirement to have my photos verified?</b></p>
                            <p>Image verification is not a requirement, it is optional. However, we highly recommend
                                you have your images verified by us so that you can better establish client trust. You
                                should remember that the biggest complaint from Viewers is fake Media and Profiles.
                                If a report is made our support staff will investigate and if the Profile is found to
                                have
                                fake Media then the Profile will be Suspended.
                            </p>
                            <p><b>Q: How do I get my photos verified?</b>
                            </p>
                            <p>We have our own image verification system incorporated into the Media upload process.
                            </p>
                            <p>If you pass our image verification criteria, we will mark your Media with the prestigious
                                E4U Verification Icon, which essentially verifies your Media as being genuine.
                            </p>
                            <p><b>Q: Will any images of me be blurred?</b></p>

                            <p>We offer a blurring service free of charge to Platinum Advertisers. The service is
                                available to Gold and Silver Members with the payment of a Fee. All Advertisers can
                                have up to a maximum of six photo images per month blurred.
                            </p>
                            <p>Facial blurring is always styled with a light blurring effect. The blurring service does
                                not include the removal of large tattoos or alterations to an Escort's appearance.</p>
                            <p>All images for blurring must be submitted at the same time and be verified.
                            </p>
                            <p><b>Q: What are the photograph image requirements to advertise?</b></p>
                            <p>We have a strict policy on what images you can publish. Your images must:</p>
                            <ul>
                                <li>Be good quality and high resolution</li>
                                <li>Be your own (of yourself). Other people in the image is acceptable provided you
                                    have their consent
                                </li>
                                <li>Have no large or distracting watermarks (we will watermark your photos for you)
                                </li>
                                <li>Have no photographer's watermarks (they will be removed, or we will request new
                                    images without the watermark)
                                </li>
                                <li>Be professional in quality. They do not need to be taken by a professional
                                    photographer, but must have a good quality finish
                                </li>

                            </ul>
                            <p>You can publish a montage photo image, like for example your Thumbnail image, provided that each of the images contained
                                in the montage are compliant with our policy.
                            </p>
                            <p>We will not publish any images which:
                            </p>
                            <ul>
                                <li>Are low quality (too small, dark, grainy or blurry)</li>
                                <li>We find on non escort websites, or any photo where we have doubt about the
                                    ownership of the image
                                </li>
                                <li>Overly explicit, and most likely do not comply with the <a
                                        href="{{ url('faqs')}}"
                                        class="termsandconditions_text_color">Local Laws</a> or Classification
                                        Laws</li>
                                <li>Have borders or frames that have been added with a photo program (please upload
                                    your original images without borders)
                                </li>
                                <li>Have watermarks that have been placed by the photographer to advertise their
                                    business
                                </li>
                                <li>Have watermarks of another advertising platform</li>
                                <li>Have your contact details on them, such as email, telephone or website address.
                                    (This information is set out in your Profile)
                                </li>
                                <li>Contain magazine covers, publications or video/DVD covers</li>
                            </ul>
                            <p><b>Q: What are the video requirements for inclusion in my Profile?</b></p>
                            <p>We have a strict policy on the content of your video you can publish. Your video must:
                            </p>
                            <ul>
                                <li>Be no longer than 30 seconds</li>
                                <li>Be in either mp4 or wav format. You can not provide a link to your video</li>
                                <li>Not contain any sexually explicit content or language, like for example,
                                    intercourse
                                </li>
                                <li>Not contain any of your contact details, such as email, telephone or website
                                    address. This information is set out in your Profile
                                </li>
                            </ul>
                            <p>We recommend your videos are brief and highlight your personality.</p>
                             
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Profile Reporting
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: Can I see how much business you are generating for me?</b></p>
                            <p>Yes you certainly can. Logon to your Account and in the Dashboard area you can see
                                statistics, graphs and results which detail:
                            </p>
                            <ul>
                                <li>Clicks on your Profile</li>
                                <li>Clicks on your phone number</li>
                                <li>Clicks on each of your photo images</li>
                                <li>Views of your video</li>
                                <li>How many times you have been short listed on the Search Page</li>
                                <li>How many Viewers have added you to their Legbox</li>
                                <li>Clicks from your Profile to your Playbox page</li>
                                <li>The number of messages sent to you</li>
                                <li>Clicks to your social media page/s (if you have provided a link)</li>
                                <li>And many other helpful analytics</li>
                            </ul>
                            <p>If you use Google Analytics you can also find the number of website visitors by looking
                                in Acquisition > Campaigns > All Campaigns. We know you will not always know about
                                all the customers we send, but we have tried our best to give you an idea</p>
                            <p>If you have questions about measurement, get in touch, as we greatly appreciate
                                hearing about your results and any suggestions about how we can improve the
                                information we present to you.
                            </p>
                            <p><b>Q: Can I request a report?</b></p>
                            <p>Yes you can. Simply go to your Dashboard and select the report type you want and
                                the frequency you want the report to be sent to you.</p>
                                 
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Profiles
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: How do I make a great Profile?</b></p>
                            <p>If you provide a complete Profile with accurate information, you will increase the
                                number and quality of results you get from it. We have a very comprehensive Profile
                                creator which will help you create a great Profile for yourself. Much of the creator is
                                simply tick the box or select from a drop down menu. The Profile creator also pre-loads
                                all of your Profile Information, which makes it very quick and easy to create a
                                Profile. Spend the time to complete your Profile Information, you will find the time is
                                well spent.</p>
                            <p>Here are some good tips for you:
                            </p>
                            <ul>
                                <li>Put real photos up, preferably more than one. You can upload up to 6 photos plus
                                    your Thumbnail. Make sure you have had them verified to save time when you post
                                    your Profile
                                </li>
                                <li>Take time to provide a good description of yourself and the services you offer. You
                                    can set your services in your Profile Information and Account settings
                                </li>
                                <li>List only the services you provide. The Profile creator has a comprehension
                                    selection of services where you can easily select from your drop down list
                                </li>
                                <li>Make sure your phone number and email address, if you are enabling email, is
                                    correct
                                </li>
                                <li>If you have a video to upload, make sure it is not too long and that the recording
                                    is of good quality. You can have up to 3 videos per Profile
                                </li>
                                <li>Include your Playbox content if you have enable this feature</li>
                                <li>Include your social media links if you have any</li>

                            </ul>
                            <p>Please do not:</p>
                            <ul>
                                <li>Post fake listings or fake photos, it will eventually come to our attention and the
                                    Profile will be either suspended or removed
                                </li>
                                <li>Use ALL CAPS, it looks CHEAP. Clients do not like you yelling at them</li>
                                <li>Use foul or unacceptable language
                                </li>
                                <li>Attempt to deceive Viewers. You will get caught out and that may have an effect on
                                    your reputation if a review is posted
                                </li>
                                <li>Enable Service Tags for services that you do not provide. Only select Service Tags
                                    for services that you actually provide. Viewers might form a negative view of you
                                    and reflect that view in a Review
                                </li>
                            </ul>
                            <p><b>Q: Can I have more than one Profile?</b></p>
                            <p>Yes, you absolutely can. If you create more than one Profile for a Location you might want to use a different Stage Name for each Profile, perhaps use different Media and set out a different summary about yourself. Our Profile creator is very detailed, you
will be very satisfied with how we present your Profile.
                            </p>
                            <p>You can archive your Profiles in the Profile Group folder so that you do not have to edit or
                                recreate the one Profile across a number of Locations, including more than one in the
                                same Location. Just switch on and switch off the Profile for the Location you are in. It
                                is really easy to manage your Profiles and post them.</p>
                            <p><b>How do I make My Playbox available?</b></p>
                            <p>When you enable the My Playbox feature, the My Playbox icon will appear on any Profile that you publish. Viewers will see the My Playbox icon, located at the top of the
Profile, indicating the service is available to Viewers.</p>
                            <p><b>Q: Can I make Profiles for different individuals?</b></p>
                            <p>Yes, as long as you have their permission for you to list them and they are real
                                people.</p>
                            <p>If you are a Massage Centre, you only need to create one Profile as a Massage
                                Centre Profile allows you to post up to 8 Masseur Profiles (see <a href="help-for-massage-centres"
                                                                                                   class="termsandconditions_text_color">Help
                                    for Massage Centres</a>).
                            </p>
                            <p><b>Q: How are Profiles ordered?</b></p>
                            <p>Profiles within each Membership Types are randomised every 2 hours and customised
                                to each individual Advertiser according to their Profile Information. The search bar in
                                the Website is very powerful and enables Viewers to search Advertisers by:</p>
                            <ul>
                                <li>State / Capital City</li>
                                <li>Gender</li>
                                <li>Age</li>
                                <li>Rate</li>
                                <li>Service type, such as Massage, Incall or Outcall; and</li>
                                <li>Verified Photos</li>
                                <li>Much more ...</li>
                            </ul>
                            <p>The search bar also has an advanced feature whereby Viewers can also search by
                                Service Tag for:
                            </p>
                            <ul>
                                <li>Fun stuff on the Viewer</li>
                                <li>Kinky stuff on the Viewer</li>
                                <li>Fun stuff on the Advertiser</li>
                            </ul>
                            <p>It is very important that you set your Profile Information for Service Tags accurately so
                                that a Viewer can undertake a search with confidence.
                            </p>
                            <p>By completing your Profile creator and answering all the questions, you enhance your
                                chances of being found with the search bar. We do this to provide the best possible
                                experience for Advertisers and Viewers ensuring that all Advertisers in a single
                                Membership Type receive a similar amount of exposure to Viewers.</p>
                            <p><b>Q: Is fake Media OK?</b></p>
                            <p>If you post any fake Media, your Account will be suspended. If we determine that you
                                have other Accounts, they will also be suspended regardless of whether they are
                                genuine or not. There are no excuses and we will not enter into any discussion with
                                you. Posting fake Media is fraud and a breach of intellectual property rights of the
                                owner of the fake media. If you have paid for Profiles and you are Suspended the
                                Credits are not refundable.
                            </p>
                            <p>You will have an opportunity to edit the suspended Profile to remove the fake Media.</p>
                            <p><b>Q: Why are my photos marked as fake?</b></p>
                            <p>This is the most common complaint from other Advertisers and Viewers about Profiles
                                - fake Media. Further, fake Media is not fair and does not provide for a level playing
                                field for all the Advertisers. Your Media may be marked as fake because of a report
                                from an Advertiser or Viewer. You will receive a warning email from us giving you 48
                                hours to have your Media verified before your Profile is returned to active.
                            </p>
                            <p><b>Q: What is not OK?</b></p>
                            <p>If you are an Advertiser and do not follow the Policies, your Account, including any
                                future accounts, will be blocked.</p>
                            <p>It is not acceptable for:</p>
                            <ul>
                                <li>Underage photos or photos of children to appear in any Profile
                                </li>
                                <li>Trafficking, enslavement or anything similar to be promoted</li>
                                <li>Abuse, violence or oppressive behaviour to be directed towards other Advertisers or
                                    Viewers
                                </li>
                                <li>Online trolling or other defamation to be directed towards other Advertisers or
                                    Viewers
                                </li>

                            </ul>
                             
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Telecommunications
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: What are these services?</b></p>
                            <p>Escorts4U offers for your convenience a:</p>
                            <ul>
                                <li>Mobile SIM service for your mobile phone while in Australia. Unlimited voice and
                                    text for a fixed monthly fee
                                </li>
                                <li>Managed Email account. Use your email account to register for all of your
                                    purchases while in Australia
                                </li>
                            </ul>
                            <p><b>Q: How do I pay for these services?</b></p>
                            <p>Payment, by Card, is requested when you request any of these services. You tell us
                                how long you are here for and payment is charged according to your stay. You can
                                extend any time, your Card will be debited automatically.</p>
                            <p><b>Q: How do I get my Mobile SIM?</b></p>
                            <p>You need to register with Escorts4U, then logon and from your Dashboard order your
                                Mobile SIM. We will post the SIM to you. The SIM will already be active, just place it
                                in your mobile phone and you are right to go.
                            </p>
                            <p><b>Q: How do I access my email account?</b></p>
                            <p>You can access your email account via your mobile phone email app (Microsoft
                                Outlook) or a web browser. It is very easy, simply follow the install instructions and
                                you will be up and running within minutes.</p>
                                 
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Travel and Accommodation
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: Who is the engine behind this service?</b></p>
                            <p>Escorts4U has partnered with a leading provider of travel, accommodation and related
                                services online bookings as a convenient one stop shop for you. It is no different to
                                booking your accommodation and flights directly through those providers.</p>
                            <p><b>Q: Will I receive the same amount of information?</b></p>
                            <p>Yes you will. All of the information you would receive by booking direct, you will also
                                receive through the Website. There is no difference.
                            </p>
                            <p><b>Q: Will I get the same discounts on offers as if I went direct?</b></p>
                            <p>Yes you will. Any promotions and discounts on offer directly will be available through
                                the Website as well</p>
                                 
                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Ugly Mugs Register
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: What is the Ugly Mugs Register?</b></p>
                            <p>The National Ugly Mugs register (NUM) is a pioneering, national concept delivered by
                                Escorts4U through this Website. It is designed to provide greater protection for
                                Advertisers who are often targeted or find themselves the victim of a dangerous
                                individual, but are reluctant to report the incident to the police. These offenders are
                                often serial sexual predators or criminals who pose a risk to Escorts and to the public
                                as a whole.</p>
                            <p><b>Q: How does the register help me?</b></p>
                            <p>As a registered Advertiser, you will have access to NUM through your Dashboard.
                                You simply complete an online report regarding your incident, and the NUM Report is
                                made available to other Escorts via their Dashboard. You remain anonymous.
                            </p>
                            <p><b>Q: Is NUM confidential?</b></p>
                            <p>Yes. NUM operates under a strict confidentiality policy which means we will not
                                disclose or share information outside the Escorts4U team without your permission.
                                Your information will be held electronically on a secure system. We follow strict
                                guidelines of confidentiality, and we can reassure you that we will always protect your
                                interests and respect to everything you say.</p>
                            <p>We follow the <a href="{{ url('faqs')}}"
                                                class="termsandconditions_text_color">Local
                                    Laws</a> and the principles set out in the Privacy Act and the Notifiable
                                    Data Breaches scheme.</p>
                            <p><b>Q: Is the NUM funded by the police?</b></p>
                            <p>No. Escorts4U has no connection with any of the police services throughout Australia.</p>
                            <p><b>Q: How do I make a report?</b></p>
                            <p>Simply log on and go to your Dashboard. Select "Make a Report" to submit your
                                incident. The NUM report will be reviewed by our support team and then published to
                                other Escorts via the NUM register. Only Advertisers have access to the NUM
                                register.
                            </p>
                            <p><b>Q: What is a NUM Alert?</b></p>
                            <p>An Alert is simply a warning meant to alert Escorts to people or situations that may be
                                dangerous to them.</p>
                            <p>When we receive a NUM Report it will be moderated and risk assessed by our support
                                staff and sanitised to form an Alert. This will then be posted onto the NUM register,
                                which registered Advertisers can access from their Dashboard. We also email or text
                                to other Escorts, who have enabled the service, alerting them of dangerous
                                individuals.
                            </p>
                            <p><b>Q: What can I do in the NUM register?</b></p>
                            <p>When you register as an Advertiser you automatically gain access to the NUM
                                register. You can:
                            </p>
                            <ul>
                                <li>View Alerts</li>
                                <li>Make a report</li>
                                <li>Do a number check</li>
                                <li>Do an email check</li>
                                <li>Do a name check (be mindful that the person you are checking may have provided you with a false name)</li>
                            </ul>
                            <p><b>Q: Can I do a Number check?</b></p>
                            <p>Yes. Simply log on and follow these simple steps:</p>
                            <ul>
                                <li>Go to your Dashboard.</li>
                                <li>Click "Lookup"</li>
                                <li>Type in the number you want to check in the search field</li>
                                <li>Select "Submit"</li>
                                <li>A message will appear letting you know if there has been a match or not (this
                                    service is subject to the Privacy Act).
                                </li>

                            </ul>
                            <p>As the number checker is new, there are not so many 'ugly numbers' in the database,
                                so if there is no match this is not to say that the number and person using the number
                                are safe to meet with.
                            </p>
                            <p>Every time an 'ugly number' is reported to NUM it will be immediately added to the
                                database.
                            </p>
                            <p><b>Q: What happens if I make a false report?</b></p>
                            <p>If we determine that you have mad a false report your Account will be cancelled.</p>

                        </div>
                    </div>
                </div>


                <div class="set">
                    <a>
                        Visa Applications and Banking
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                        <div class="accodien_manage_padding_content">
                            <p class="pt-4"><b>Q: How do I apply for a Visa?</b></p>
                            <p>You can apply for a Visa online or engage a migration agent to prepare your
                                application on your behalf.</p>
                            <p><b>Q: Can Escorts4U help me with my Visa?</b></p>
                            <p>Yes. We have partnered with a reputable provider of visa, migration and education
                                placement services who can assist you by providing all the advice you need to sort out
                                your needs. Just logon and from your Dashboard, select Concierge Services - Visa.
                                Complete the Visa request form and someone will be in touch.
                            </p>
                            <p><b>Q: How do I open a Bank account by myself?</b></p>
                            <p>If you choose to open a Bank account within six weeks of your arrival you will only
                                need your passport as identification. If you wait more than six weeks after your arrival
                                to open an account you will need extra identification like a birth certificate, driver's
                                licence or credit card.</p>
                            <p>When opening your Bank account, make sure you are very clear about your address.
                                Ask to view your address details entered up by the Bank officer on the monitor to be
                                absolutely sure the address is correct. This will avoid any problems with the delivery
                                of your debit card. Bank officers are human and make mistakes.
                            </p>
                            <p><b>Q: My card has not arrived, what should I do?</b></p>
                            <p>If your card has not arrived within the time the Bank advised you it would take for the
                                card to arrive, go back to the Bank and re-order the card. Some Banks, as an interim
                                solution, will issue you an international debit card while you are there. You will need
                                to transfer funds into the international account the Bank creates for you. You can do that
                                via your Bank app.
                            </p>
                            <p>If you have to go down this path, don’t be intimidated by the Bank. Insist they issue
                                the international card. Most Banks issue the card from the branch.
                            </p>
                            <p><b>Q: How do I move money Internationally?</b></p>
                            <p>Most Banks in Australia have International Money Transfer services as a part of their
                                online banking service. Once you have opened your Bank account and registered to
                                access your online banking, simply go to the "International Transfers" page of the
                                Bank website and follow the instructions. There are terms and conditions attached to
                                the Bank which you have to comply with in relation to international money transfers.</p>
                               
                        </div>
                    </div>
                </div>

                
               <div class="set">
                <a>Changes to this Policy

                <i class="fa fa-angle-down"></i>
                </a>
                
                <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div>
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
                                            <p><b>This policy was last updated 03-06-2025</b></p>
                                        </div>
                                    </div>
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
