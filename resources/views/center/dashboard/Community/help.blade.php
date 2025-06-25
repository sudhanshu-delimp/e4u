@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <style type="text/css">
        .select2-container .select2-choice,
        .select2-result-label {
            font-size: 1.5em;
            height: 52px !important;
            overflow: auto;
        }

        .select2-arrow,
        .select2-chosen {
            padding-top: 6px;
        }

        span.select2.select2-container.select2-container--default>span.selection>span {
            height: 52px !important;
        }

        .list-sec .table td,
        .table th {
            border: 1px solid #0c233d;
        }
    </style>
@endsection
@section('content')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pl-3 pl-lg-5">
                    <!--middle content-->
                    <div class="row">
                        <div class="col-md-9">
                            <!-- Begin Page Content -->
                            <div class="container-fluid" style="padding: 0px 0px;">
                                <!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div class="v-main-heading h3">Help & Tips
                                        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes">
                                            <b>Help?</b>
                                        </h6>
                                    </div>
                                </div>
                                <div class="card collapse  mb-4" id="notes">
                                    <div class="card-body">
                                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                                        <ol>
                                            <li>Use these information pages for any questions you may have about the
                                                Services.
                                            </li>
                                            <li>If you can't find the answer, raise a <a href='/submit_ticket'
                                                    class="custom_links_design">Support Ticket</a> and we will get
                                                back to you.
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <!-- /.container-fluid --><br>
                            <div class="row pb-5">
                                <div class="col-md-12">
                                    <div id="accordion" class="myacording-design">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#about_me"
                                                    aria-expanded="false">
                                                    Massage Centre Profiles
                                                </a>
                                            </div>
                                            <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                                <div class="card-body p-0">
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: What is a Massage Centre Profile?</b></p>
                                                        <p class="pbot">A uniquely designed Profile designed entirely for
                                                            Massage Centres (a world first)
                                                            where they can capture all of their Masseurs in the one Massage
                                                            Centre Profile. Up to
                                                            eight Masseur Profiles within the Massage Centre Profile, you
                                                            only pay the one set
                                                            Fee.</p>
                                                        <p>
                                                            The Profile focuses on two factors:
                                                        </p>
                                                        <ol>
                                                            <li> Important information about the Massage Centre, like the
                                                                business address
                                                                (including a Google map), whether showers are available and
                                                                front and rear entry
                                                                and much more.</li>
                                                            <li> A summary, including up to three photos, of the Masseur.
                                                                The summary of the
                                                                Masseur includes name, age, nationality, available days and
                                                                service type and much
                                                                more.
                                                            </li>
                                                        </ol>
                                                        <p>The Massage Centre Profile is the perfect solution for Massage
                                                            Centres. No need to
                                                            create many profiles across the one platform, its all correlated
                                                            within the one Profile
                                                            and for the one small Fee, delivering substantial savings to the
                                                            Massage Centre.</p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: How do I make a great Profile?</b></p>
                                                        <p class="pbot">If you provide a complete Profile with accurate
                                                            information, you will increase the
                                                            number and quality of results you get from it. We have a very
                                                            comprehensive Profile
                                                            creator which will help you create a great Profile, including
                                                            the masseur profiles. Much
                                                            of the creator is simply tick the box or select from a drop down
                                                            menu. The Profile
                                                            creator also pre-loads all of your Profile Information,
                                                            including Masseurs, which makes
                                                            it very quick and easy to create a Profile. Spend the time to
                                                            complete your Profile
                                                            Information for the Massage centre as well as for each of your
                                                            Masseurs, you will find
                                                            the time is well spent. Here are some good tips for you:
                                                        </p>
                                                        <ul>
                                                            <li>Put a lovely landscape photo up of your Massage Centre for
                                                                your Banner Image,
                                                                like a photo of the premises from the front, or the
                                                                reception inside</li>
                                                            <li>Put real photos up of the Masseurs, up to three for each
                                                                Masseur. You can also
                                                                pload up to 6 photos plus your Thumbnail of your premises.
                                                                They could be of the
                                                                massage rooms, shower facilities and your reception. Make
                                                                sure you have had
                                                                your Masseur photos verified to save time when you post your
                                                                Profile
                                                            </li>
                                                            <li>
                                                                Take time to provide a good description of your business and
                                                                the services you offer You can set your services in your
                                                                Profile Information and Account settings
                                                            </li>
                                                            <li>
                                                                List only the services you provide. The Profile creator has
                                                                a comprehension
                                                                selection of services where you can easily select from your
                                                                drop down list
                                                            </li>
                                                            <li>
                                                                Make sure your phone number and email address, if you are
                                                                enabling email, is correct
                                                            </li>
                                                            <li>
                                                                If you have a video to upload, make sure it is not too long
                                                                and that the recording is of good quality.
                                                            </li>
                                                            <li>
                                                                Include your social media links if you have any
                                                            </li>
                                                        </ul>
                                                        <p>
                                                            Please do not:
                                                        </p>
                                                        <ul>
                                                            <li>Post fake listings or fake photos, it will eventually come
                                                                to our attention and the
                                                                Profile will be either suspended or removed</li>
                                                            <li>Use ALL CAPS, it looks CHEAP. Clients do not like you
                                                                yelling at them</li>
                                                            <li>Use foul or unacceptable language</li>
                                                            <li>Attempt to deceive Viewers. You will get caught out and that
                                                                may have an effect on
                                                                your reputation if a review is posted
                                                            </li>
                                                            <li>Enable Service Tags for services that you do not provide.
                                                                Only select Service Tags
                                                                for services that you actually provide. Viewers might form a
                                                                negative view of you
                                                                and reflect that view in a Review</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Can I have more than one Profile?</b></p>
                                                        <p class="pbot">No. As a Massage Centre, which has a Profile which
                                                            enables up to eight Masseur
                                                            Profiles, there is no need to have multiple Profiles across the
                                                            Website.
                                                        </p>
                                                        <p> Our Profile creator is very detailed, you will be very satisfied
                                                            with how we present your
                                                            Profile.</p>

                                                        <p>You can archive your Profile in the Archive Folder so that you do
                                                            not have to edit or
                                                            recreate the one Profile across a number of publications. Just
                                                            switch on and switch off
                                                            the Profile on a needs basis, or enable auto renew. It is really
                                                            easy to manage your
                                                            Profile and post it, especially for the Masseur Profiles.
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Can I make Profiles for different
                                                                Masseurs?</b></p>
                                                        <p class="pbot">
                                                            No need to. The Massage Profile has up the eight Masseur
                                                            Profiles within a Massage
                                                            Centre Profile. Each Masseur Profile is very detailed and will
                                                            solve all of your
                                                            advertising problems experienced with other platforms.
                                                        </p>
                                                        <p>
                                                            As a Massage Centre, you only need to create one Profile, which
                                                            allows you to post up
                                                            to 8 Masseur Profiles.
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: How are Profiles ordered?</b></p>
                                                        <p class="pbot">Profiles within the Massage Centre Home Page are
                                                            randomised every 2 hours. The
                                                            search bar in the Website is very powerful and enables Viewers
                                                            to search Advertisers
                                                            by: </p>
                                                        <ul>
                                                            <li> State / Capital City</li>
                                                            <li>Gender</li>
                                                            <li> Rate</li>
                                                            <li>Service type, such as Massage, Incall or Outcall; and</li>
                                                            <li> Verified Photos</li>
                                                        </ul>
                                                        <p>
                                                            The search bar also has an advanced feature whereby Viewers can
                                                            also search by
                                                            Service Tag for:
                                                        </p>
                                                        <ul>
                                                            <li> Suburb location</li>
                                                            <li>Massage services available</li>
                                                            <li>Other service types</li>
                                                        </ul>
                                                        <p>It is very important that you set your Profile Information for
                                                            Service Tags accurately so
                                                            that a Viewer can undertake a search with confidence.</p>
                                                        <p>
                                                            By completing your Profile creator and answering all the
                                                            questions, you enhance your
                                                            chances of being found with the search bar. We do this to
                                                            provide the best possible
                                                            experience for Advertisers and Viewers ensuring that all
                                                            Advertisers can be found
                                                            when the Viewer uses the search bar.
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Is fake Media OK?</b></p>
                                                        <p class="pbot">
                                                            If you post any fake Media, your Account will be suspended. If
                                                            we determine that you
                                                            have other Accounts, they will also be suspended regardless of
                                                            whether they are
                                                            genuine or not. There are no excuses and we will not enter into
                                                            any discussion with
                                                            you. Posting fake Media is fraud and a breach of intellectual
                                                            property rights of the
                                                            owner of the fake media. If you have paid for Profiles and you
                                                            are Suspended the
                                                            Credits are not refundable.
                                                        </p>
                                                        <p>
                                                            You will have an opportunity to edit the suspended Profile to
                                                            remove the fake Media
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Why are my photos marked as fake?</b></p>
                                                        <p class="pbot">
                                                            This is the most common complaint from other Advertisers and
                                                            Viewers about Profiles
                                                            - fake Media. Further, fake Media is not fair and does not
                                                            provide for a level playing
                                                            field for all the Advertisers. Your Media may be marked as fake
                                                            because of a report
                                                            from an Advertiser or Viewer. You will receive a warning email
                                                            from us giving you 48
                                                            hours to have your Media verified before your Profile is
                                                            returned to active.
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: What is not OK? </b></p>
                                                        <p class="pbot">
                                                            If you are an Advertiser and do not follow the Policies, your
                                                            Account, including any
                                                            future accounts, will be blocked.
                                                        </p>
                                                        <p>
                                                            It is not acceptable for:
                                                        </p>
                                                        <ul>
                                                            <li>Underage photos or photos of children to appear in any
                                                                Profile</li>
                                                            <li>Trafficking, enslavement or anything similar to be promoted
                                                            </li>
                                                            <li>Abuse, violence or oppressive behaviour to be directed
                                                                towards other Advertisers orViewers</li>
                                                            <li> Online trolling or other defamation to be directed towards
                                                                other Advertisers or Viewers</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse"
                                                    href="#profile_and_tour_options" aria-expanded="false">
                                                    Memberships
                                                </a>
                                            </div>
                                            <div id="profile_and_tour_options" class="collapse" data-parent="#accordion"
                                                style="">
                                                <div class="card-body p-0">
                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: What is Membership?</b></p>
                                                        <p class="pbot">
                                                            To advertise on Escorts4U we require you to sign up for
                                                            Membership. It is free, you
                                                            only pay for Massage Centre Profiles that you post on the
                                                            Website. Create and refine
                                                            your Massage Centre Profile and once you are ready to publish,
                                                            simply go to the
                                                            Profile creator and in a matter of minutes your Massage Centre
                                                            Profile is published.
                                                        </p>
                                                        <p>
                                                            Viewers will have full access to your Massage Centre Profile
                                                            including unrestricted
                                                            communication rights should you have texting and email services
                                                            enabled.
                                                        </p>
                                                        <p>
                                                            Your membership includes the posting of up to eight Masseur
                                                            Profiles within your
                                                            Massage Centre Profile. The Masseur Profiles are very detailed.
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Are there any great features available to us
                                                                as Massage Centre?</b></p>
                                                        <p class="pbot">
                                                            Yes. We have a number of great features to enhance your Profile
                                                            and relationship
                                                            building with Viewers. You can:
                                                        </p>

                                                        <ul>
                                                            <li>Post your Massage Centre logo in the Thumbnail of your
                                                                Profile</li>
                                                            <li>Create up to 8 Masseur Profiles within your Profile</li>
                                                            <li>At your option, each Massage Centre Profile has:
                                                                <ul>
                                                                    <li>A Banner Image</li>
                                                                    <li>Up to 6 photos plus your Thumbnail</li>
                                                                    <li>A comprehensive summary of the Masseur, including
                                                                        their name, age, mobile number and much more</li>
                                                                    <li>The ability to be flagged as a favourite by a Viewer
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>Archive your Massage Centre Profile and Media, ready to be
                                                                activated at any time.
                                                                You can also archive all of your Masseurs Profile
                                                                Information ready to be added to
                                                                your Massage Centre Profile when the Masseur commences
                                                                employment at your
                                                                business.</li>
                                                            <li> Much more ...</li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Are there any loyalty programs?</b></p>
                                                        <p class="pbot">
                                                            Absolutely. Escorts4U will reward you for your loyalty. A simple
                                                            program, for every
                                                            $500.00 in advertising a Massage Centre spends with us, we will
                                                            reward you with 1
                                                            day of free advertising. You can use your rewards any time you
                                                            like, or accumulate
                                                            your rewards and use them all at once, it is entirely up to you.
                                                        </p>
                                                        <p>
                                                            Discounts to advertising Fees also apply once you spend over a
                                                            certain amount. The
                                                            discounts are very generous.
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <p class="pt-2"><b>Q: Can I get help to manage my Account?</b></p>
                                                        <p class="pbot">
                                                            Yes you can. Our support team will help you manage your Account
                                                            or alternatively,
                                                            you can reach out to an <a href="#"
                                                                style="color:#FF3C5F">Agent</a>. An Agent will assist you
                                                            with:
                                                        </p>
                                                        <ul>
                                                            <li>Managing your Account details and Profile Information</li>
                                                            <li>Managing your Media (photo images and video)</li>
                                                            <li>Creating your Profile and Masseur Profiles</li>
                                                            <li>Any of the Concierge Services; and</li>
                                                            <li>Generally, be there for you</li>
                                                        </ul>
                                                        <p>You can appoint an Agent at any time by either:</p>
                                                        <ul>
                                                            <li>Nominating the Agent as a part of the registration process;
                                                                or by</li>
                                                            <li>Requesting an Agent to be appointed by lodging a request
                                                                through your Dashboard.</li>
                                                        </ul>
                                                        <p>
                                                            When you appoint an Agent, you enter into an arrangement with
                                                            the Agent directly for
                                                            the Agent to provide the Agent Services. The Agent will have
                                                            full access to your
                                                            Account.
                                                        </p>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>



                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram"
                                                    aria-expanded="false">
                                                    Payments
                                                </a>
                                            </div>
                                            <div id="LoyaltyProgram" class="collapse" data-parent="#accordion"
                                                style="">
                                                <div class="card-body p-0">
                                                    <p class="mt-2"><b> Q: How do I pay for advertising? </b></p>
                                                    <p>Payment, by credit card, is requested when you post a Profile. If
                                                        you renew the Profile, your credit card will be debited
                                                        automatically.</p>
                                                    <p class="mt-2"><b>Q: Does Escorts4U retain my credit card
                                                            details?</b></p>
                                                    <p>Yes, we do. Our third party payments provider retains your
                                                        details. Escorts4U does not directly retain your credit card
                                                        details.</p>
                                                    <p class="mt-2"><b>Q: Can I transfer credits I have earnt from my
                                                            Loyalty program?</b></p>
                                                    <p>Yes, whenyou create a Profile, any credits you have will be
                                                        displayed and you will have the option to utilise them.</p>
                                                    <p class="mt-2"><b>Q: What is the easiest way to pay?</b></p>
                                                    <p>You can pay for your advertising by 2 methods, namely:</p>
                                                    <ul>
                                                        <li>Pay as you go. Simply create your Profile/s, select the
                                                            number of days for advertising and payment is calculated
                                                            accordingly; or
                                                        </li>
                                                        <li>Pay a sum as a credit towards future advertising. When you
                                                            upload a Profile and set the number of days your charges are
                                                            automaticly calculated and deducted from your credit total.
                                                        </li>
                                                    </ul>
                                                    <p>All transactions are confirmed by email notifcation to you. You
                                                        can also view all of your purchase history from your
                                                        Dashboard.</p>
                                                    <p class="mt-2"><b>Q: How do you set prices?</b></p>
                                                    <p>Our main objective is to provide value-for-money in an effective
                                                        way. Our pricing is defined on a daily per city basis with
                                                        discounts for booking longer periods. We only raise prices (and
                                                        not often) when the number of enquiries and Advertisers goes
                                                        over a certain level. This is to maintain the number of Platinum
                                                        and Gold listings at a level where each paid listing will
                                                        continue to receive the number of enquiries they expect from
                                                        us.</p>
                                                    <p>We introduced variable pricing after talking to many Advertisers
                                                        who were asking how they could get more exposure and indicated
                                                        they were willing to pay more if they could stand out.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse"
                                                    href="#Profile-images" aria-expanded="false">
                                                    Profile images and video
                                                </a>
                                            </div>
                                            <div id="Profile-images" class="collapse" data-parent="#accordion"
                                                style="">
                                                <div class="card-body p-0">
                                                    <p class="mt-2"><b> Q: Can I use fake images if they look very
                                                            similar to me?</b></p>
                                                    <p>Absolutely not. We have a strict policy that all images must
                                                        belong to the Escort, and be of themselves. This is mandatory
                                                        and there is no negotiation on this policy.</p>
                                                    <p class="mt-2"><b>Q: Is it a requirement to have my photos
                                                            verified?</b></p>
                                                    <p>Image verification is not a requirement, it is optional. However,
                                                        we highly recommend you have your images verified by us so that
                                                        you can better establish client trust. Verifying images also
                                                        enables your Profile to be posted immediately.</p>
                                                    <p class="mt-2"><b>Q: How do I get my photos verified?</b></p>
                                                    <p>We have our own image verification process. Please email us for
                                                        more information.</p>
                                                    <p>If you pass our image verification criteria, we will mark your
                                                        profile with the prestigious Photos Verified seal.</p>
                                                    <p class="mt-2"><b>Q: Will any of my images be blurred?</b></p>
                                                    <p>We offer a blurring service free of charge to Platinum
                                                        Advertisers. It is not available for any of the other
                                                        packages.</p>
                                                    <p>The service is free of charge to each Advertiser under the
                                                        Platinum package to a maximum of six per month. All images for
                                                        blurring must be submitted at the same time.</p>
                                                    <p class="mt-2"><b>Q: What are the photograph image requirements to
                                                            advertise?</b></p>
                                                    <p>We have a strict policy on what images you can publish. Your
                                                        images must:</p>
                                                    <ul>
                                                        <li>be good quality and high resolution</li>
                                                        <li>be your own (of yourself). Other people in the image is
                                                            acceptable provided you have their consent
                                                        </li>
                                                        <li>have no large or distracting watermarks (we will watermark
                                                            your photos for you)
                                                        </li>
                                                        <li>have no photographer's watermarks (they will be removed, or
                                                            we will request new images without the watermark)
                                                        </li>
                                                        <li>be professional in quality. They do not need to be taken by
                                                            a professional photographer, but must have a good quality
                                                            finish
                                                        </li>
                                                    </ul>
                                                    <p>We will not publish any images which:</p>
                                                    <ul>
                                                        <li>are low quality (too small, dark, grainy or blurry)</li>
                                                        <li>that we find on non escort websites, or any photo where we
                                                            have doubt about the ownership of the image
                                                        </li>
                                                        <li>overly explicit</li>
                                                        <li>have borders or frames that have been added with a photo
                                                            program (please upload your original images without borders)
                                                        </li>
                                                        <li>have watermarks that have been placed by the photographer to
                                                            advertise their business
                                                        </li>
                                                        <li>have your contact details on them, such as email, telephone
                                                            or website address. This information is set out in your
                                                            Profile
                                                        </li>
                                                        <li>contain magazine covers, publications or video/DVD covers
                                                        </li>
                                                    </ul>
                                                    <p class="mt-2"><b>Q: What are the video requirements for inclusion
                                                            in my advertisement?</b></p>
                                                    <p>We have a strict policy on the content of your video you can
                                                        publish. Your video must:</p>
                                                    <ul>
                                                        <li>be no longer than 30 seconds</li>
                                                        <li>be in either mp4 or wav format, or you provide a link to
                                                            your video, such as Vimeo
                                                        </li>
                                                        <li>not contain any sexually explicit content or language, for
                                                            example, intercourse
                                                        </li>
                                                        <li>not contain any of your contact details, such as email,
                                                            telephone or website address. This information is set out in
                                                            your Profile
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link collapsed" data-toggle="collapse"
                                                    href="#Profile-reporting" aria-expanded="false">
                                                    Profile reporting
                                                </a>
                                            </div>
                                            <div id="Profile-reporting" class="collapse" data-parent="#accordion"
                                                style="">
                                                <div class="card-body p-0">
                                                    <p class="mt-2"><b>Q: Can I see how much business you are generating
                                                            for me?</b></p>
                                                    <p>Yes you certainly can. Logon to your Account and in the Dashboard
                                                        area you can see statistics, graphs and results which
                                                        detail:</p>
                                                    <ul>
                                                        <li>Clicks on your profile</li>
                                                        <li>Clicks on your phone number</li>
                                                        <li>Clicks on each of your photos</li>
                                                        <li>Views of your video</li>
                                                        <li>The number of messages sent to you</li>
                                                        <li>Clicks through to your website (if you have provided a
                                                            link)
                                                        </li>
                                                        <li>Clicks to your social media page/s (if you have provided a
                                                            link)
                                                        </li>
                                                        <li>And many other helpful analytics</li>
                                                    </ul>
                                                    <p>If you use Google Analytics you can also find the number of
                                                        website visitors by looking in Acquisition > Campaigns > All
                                                        Campaigns. We know you will not always know about all the
                                                        customers we send, but we have tried our best to give you an
                                                        idea.</p>
                                                    <p>If you have questions about measurement, get in touch, as we
                                                        greatly appreciate hearing about your results and any
                                                        suggestions about how we can improve the information we present
                                                        to you.</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--middle content end here-->
                        <!--right side bar start from here-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script>
        if (location.hash !== null && location.hash !== "") {
            $(document).ready(function(e) {
                $('html, body').animate({
                    scrollTop: ($(location.hash).offset().top) - 50
                }, 0);
                $(location.hash + ".collapse").collapse("show");
            });
        }
    </script>
@endpush
