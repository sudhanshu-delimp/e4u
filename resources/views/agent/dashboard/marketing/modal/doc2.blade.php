<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E4U Proposal | Document (2)</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        
        body {
            background: #fff;
            padding: 25px;
        }
        
        .header {
            width: 100%;
            margin: 0px auto;
            position: relative;
            overflow: hidden;
        }
        
        .logo {
            position: absolute;
            top: 60px;
            right: 10px;
            width: 195px;
            height: 63px;
        }
        
        .logo img {
            width: 100%;
            height: 63px;
            object-fit: cover;
        }
        
        .subtitle {
            position: absolute;
            top: 25%;
            left: 34%;
            width: 500px;
            font-size: 18px;
            color: #5c6e7d;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.4;
        }
        
        .info {
            position: absolute;
            bottom: 5%;
            left: 60px;
            color: white;
            font-size: 14px;
            font-family: "Segoe UI", Arial, sans-serif;
        }
        
        .info .info_details {
            margin-bottom: 50px;
        }
        
        .info h4 {
            margin-bottom: 5px;
            font-size: 13px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #fff;
        }
        
        .info p {
            font-size: 14px;
            font-weight: bold;
            color: #fff;
        }
        
        .page_1 {
            width: 100%;
            margin: 0 auto;
            background: #ffffff;
            color: #000;
            page-break-before: always;
        }
        
        .page_1 ul {
            padding-left: 15px;
            list-style-type: disc;
        }
        
        .page_1 ul li {
            line-height: 1.8;
        }
        
        .page_1 ul li ul {
            padding-left: 15px;
            list-style-type: disc;
        }
        /* Headings */
        
        .heading {
            color: #4a6a7c;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0 10px;
        }
        
        .subheading {
            font-weight: bold;
            margin-top: 20px;
        }
        
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
            text-align: justify;
        }
        
        .table-box {
            margin: 20px auto;
            width: 80%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: center;
        }
        
        .table-box th {
            background: #6f8593;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-weight: 700;
        }
        
        .table-box td {
            border: 1px solid #ccc;
            padding: 10px;
            font-family: DejaVu Sans, Arial, sans-serif;
        }
        
        .table-box td:first-child {
            font-weight: bold;
        }
        
        .footer {
            position: relative;
        }
        
        .footer .footer_info {
            position: absolute;
            bottom: 100px;
            right: 20px;
            text-align: right;
        }
        
        .footer .footer_info h3 {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-top: 35px;
            text-align: right;
        }
        
        .footer .footer_info p {
            font-weight: bold;
            color: #fff;
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="page_container">
        <div class="header">
            <div class="logo"><img src="{{ public_path('assets/app/pdf/png1.png') }}" alt=""></div>
            <img src="{{ public_path('assets/app/pdf/1.png') }}" alt="" style="width: 100%;">

            <div class="subtitle">
                INFORMATION PACKAGE FOR THE PROVISION OF ADVERTISING SOLUTIONS FOR A MASSAGE CENTRE <small>(MULTIPLE LOCATIONS)</small>
            </div>
            <div class="info">
                <div class="info_details">
                    <h4><b>Prepared For:</b></h4>
                    <h4>{{ $data['bussiness_name'] }}</h4>
                    <p>{{ $data['address'] }}</p>
                </div>

                <div class="info_details">
                    <h4> <b>Prepared By:</b></h4>
                    <p>{{ $data['name_of_agent'] }}</p>
                </div>


                <div class="info_details">
                    <h4>Agent for Escorts4U</h4>
                    <p>{{ $data['agent_email_address'] }}</p>
                </div>


            </div>
            <div style='position: absolute; bottom: 5%; right: 10px; color: white;'>
                <p>Document 2</p>
            </div>
        </div>

        <div class="page_1">
            <div style="text-align: right; margin: 10px 0px;">
                <img src="{{ public_path('assets/app/pdf/png1.png') }}" alt="" style="width: 195px; height:63px;">
            </div>

            <div>
                <p style="margin-bottom: 0px;">{{ $data['bussiness_name'] }}</p>
                <p style="width:60%">{{ $data['address'] }}</p>
                <p>Dear Sir / Madam,</p>
            </div>

            <div class="heading">
                A New Website Designed for Massage Centres
            </div>

            <p>
                Thank you for the opportunity to meet with you and to introduce the Escorts4U (<b>E4U</b>) website designed to assist Massage Parlours, or Centres as we refer to them (<b>Centre</b>), with advertising their services.
            </p>

            <div class="heading">What can E4U do for you?</div>

            <p>
                We set out to bring a convenient platform for a Centre to consolidate all of their advertising costs in the one place for all of their masseurs, as well as for multiple Centres should you have more than one Centre. We are well aware of the high cost to
                advertise, where you often have to post many advertisements for each of your masseurs, often across multiple platforms. An E4U Massage Profile <br>(<b>Profile</b>) enables you to post up to eight masseurs all within the
                one Profile for the one daily fee, at a fraction of your current costs.
            </p>

            <div class="heading">What are the advantages to using E4U?</div>

            <p>

                Your advantages are not only financial, but strategic as well. Unlike other platforms, E4U offers you a purpose designed Profile (see sample screen shot), which caters for your business information and up to eight detailed Masseur profiles.
            </p>

            <p><strong>Here is a simple analysis with other platforms:</strong></p>

            <div style="margin: 0 auto; text-align: center;">
                <table class="table-box">
                    <tr>
                        <th>Description</th>
                        <th>E4U</th>
                        <th>Other Platforms</th>
                    </tr>
                    <tr>
                        <td>Purpose designed Profile</td>
                        <td align="center" style="color: #5c6e7d;">&#10004;</td>
                        <td align="center" style="color: #5c6e7d;">&#10008;</td>
                    </tr>
                    <tr>
                        <td>Multiple Masseurs listings</td>
                        <td align="center" style="color: #5c6e7d;">✔</td>
                        <td align="center" style="color: #5c6e7d;">✖</td>
                    </tr>
                    <tr>
                        <td>Pay by the day</td>
                        <td align="center" style="color: #5c6e7d;">✔</td>
                        <td align="center" style="color: #5c6e7d;">✖</td>
                    </tr>
                    <tr>
                        <td>Comprehensive summary</td>
                        <td align="center" style="color: #5c6e7d;">✔</td>
                        <td align="center" style="color: #5c6e7d;">✖</td>
                    </tr>
                </table>
            </div>

            <div style="margin: 20px 0; border-top: 1px solid #ccc;  padding-top: 15px; text-align: center;">
                <p style="margin-bottom: 5px; font-size: 12px;  color: #5c6e7d; font-weight: 700; text-align: center;">
                    Business Terms Pty Ltd t/as E4U <br> GPO Box 11756 Perth, Western Australia 6845<br> E: admin@e4u.com.au | W: e4u.com.au | ABN: 88 664 919 757 | T: +61 1300 666 989
                </p>
            </div>



            <div class="heading" style="page-break-before: always;">
                What is in a Massage Profile?
            </div>
            <p><strong>The Profile is purpose designed enabling you to post a:</strong></p>

            <ul>
                <li>summary of the key points about your Centre including your address</li>
                <li>description of your Centre setting out why clients should visit you</li>
                <li>list of the services on offer, such as nuru, nude and prostate massage</li>
                <li>summary of your rates in a structured manner according to the service type</li>
                <li>summary of the Centre's open times, parking availability and access</li>
                <li>personal profile for each of your masseurs, up to eight, which includes:
                    <ul>
                        <li>their name and age</li>
                        <li>up to four photos</li>
                        <li>their available days and times</li>
                        <li>the services they offer</li>
                        <li>mobile number (if applicable)</li>
                        <li>and much more</li>
                    </ul>
                </li>
            </ul>
            <p>
                The Profile also displays a location map for the Centre, and when viewed through the mobile app, a simple click on the location map and Google maps will activate directions for the client to find your Centre.
            </p>

            <div class="heading">
                What are the costs to advertise on E4U?
            </div>
            <p>
                Unlike other platforms, E4U has a philosophy of keeping things simple. Irrespective of how many masseurs you list in your Profile, the cost is fixed at $30.00 per day.
            </p>
            <p>The Listing page rotates Profiles every 30 minutes ensuring your Profile will have time on the front page of the Listings. You can also Bump Up your listing as many times as you like. The website has a separate listing group just for Centres.

            </p>

            <div class="heading">
                How easy is it to use E4U?
            </div>
            <p>
                Very easy. You have a number of options available to manage your Profile. After you have registered,
                <span style="border-bottom: 1px solid #333;">for free</span> , you can:
            </p>
            <ul>
                <li>create and manage your Profile yourself; or</li>
                <li>have E4U create your Profile; or</li>
                <li>appoint an agent to create and manage your Profile, and your account (optional), for you.</li>
            </ul>
            <p>You can manage all of your data and Profiles, together with access to many other services, through your Dashboard. If you engage E4U or an agent to create and manage your Profile there is a fee.
            </p>

            <div class="heading" style="page-break-before: always;">
                How do we get started?
            </div>
            <p>
                Simply go to the E4U website at <a href="https://escorts4U.com.au" target="_blank" style="text-decoration:underline;">www.escorts4U.com.au</a> and click the Register button. After a few simple questions your registration is complete. Once
                your registration is confirmed by E4U, you can then create your Profile. Profiles are retained in your
                <i>Profile Management</i>, which you manage through your Dashboard, and where you will also find many other features to make your experience with us enjoyable.

            </p>


            <div class="heading">
                More than one shop?
            </div>
            <p>
                Consolidate all of your advertising through the one portal. Create multiple Profiles where Masseurs can be displayed across as many Profiles as you need to cover off all of your Centres. Let's be practical, a Masseur might work two days a week at one
                Centre, and two days a week at another Centre. When you create the Profiles for each of the Centres, the Masseur is attached to each of them according to the days the Masseur is working there (no different to creating a shift run sheet).
            </p>
            <p>
                If you need to, you can change the Profile to reflect which Masseurs are working where at any time. There are no costs to change your Profile. Simply log on to your Dashboard and edit the Profile/s. As soon as you save the changes, they are live.
            </p>


            <div class="heading">
                Questions?
            </div>
            <p>
                If you have any questions regarding our service please touch base with me. We look forward to helping you.
            </p>
            <p style="margin: 25px 0px;">
                Yours faithfully <br>
                <b>Escorts4U</b>
            </p>

            <span style="border-bottom:1px solid #333;">
                <img src="{{ $data['agent_signature'] }}" alt="" style="width: 150px;">
            </span>


            <p style="margin: 25px 0px;">
                <span><b>M: </b> {{ $data['agent_mobile_number'] }}</span>
                <br>
                <span><b>E: </b> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></span>
            </p>
            <div class="heading" style="page-break-before: always; text-align: center;">
                Sample Screen shots of a Massage Centre and Masseur Profiles
            </div>
            <ul>
                <li>Display your business logo or perhaps something more subtle</li>
                <li>A complete snapshot of your business and services on offer all set out under <i>About Us</i> </li>
                <li>Easy to see and read <i>Rates</i> and <i>Open Times</i> </li>
                <li>Contact preference for your Masseurs</li>
                <li>Location map</li>
                <li>Detailed Masseur information via their Profile</li>
            </ul>
            <div style="text-align: center;">
                <p class="subheading" style="text-align: center;">Media pop up. Select My Photos or My Videos</p>
                <img src="{{ public_path('assets/app/pdf/mc1.png') }}" alt="" style="width: 70%;border:2px solid #0c223d">
            </div>
            <div style="text-align: center;">
                <p class="subheading" style="text-align: center;">Masseur pop up. Selected from Centre Profile</p>
                <img src="{{ public_path('assets/app/pdf/mc2.png') }}" alt="" style="width: 70%;border:2px solid #0c223d">
            </div>
        </div>

        <div style="text-align: center; page-break-before: always;">
            <p class="subheading" style="text-align: center;">Massage Centre Profile</p>
            <img src="{{ public_path('assets/app/pdf/5.png') }}" alt="" style="width: 85%;">
        </div>

        <div class="footer">
            <img src="{{ public_path('assets/app/pdf/6.png') }}" alt="" style="width: 100%;">
            <div class="footer_info">
                <h3>For Enquiries</h3>
                <p>Phone: 1300 700 444</p>
                <p>Email: <a href="mailto:sales@e4u.com.au">sales@e4u.com.au</a></p>
                <p>Web: <a href="https://escorts4u.com.au" target="_blank">www.escorts4u.com.au</a></p>
                <h3>Postal</h3>
                <p>GPO Box T1756 <br> Perth WA 6001</p>/
                <p style="margin-top: 50px;">Copyright © 2026 Blackbox Tech Pty Ltd. All rights reserved.</p>
            </div>
        </div>

    </div>

</body>

</html>