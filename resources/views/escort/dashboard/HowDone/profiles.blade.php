@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">

    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Profiles</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use these help pages for explanations and guidance on creating, editing and
                                duplicating a Profile or Tour.</li>
                            <li>You can create as many Profiles as you want across any Location.</li>
                            <li>Before you can List a Profile, or create a Tour, you must have created and saved a
                                Profile/s for the Location you wish to complete the Listings in.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row how-it-done">
            <div class="col-md-12 mt-2 mb-5">
                <div id="accordion" class="myacording-design">

                    <!-- New -->
                    <div class="card">
                        <div class="card-header" id="headingNew">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew"
                                    aria-expanded="false">
                                    New
                                </a>
                            </h2>
                        </div>
                        <div id="collapseNew" class="collapse" aria-labelledby="headingNew" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="">
                                    <p>
                                        Use this feature to create your Profiles for all of your Locations (particularly if
                                        you Tour). You
                                        can edit any of the pre-loaded data along the way. The Profile Creator will ask you
                                        if you want
                                        to update your My Information or not. If you choose No, your default settings will
                                        stay the
                                        same, and the data setting you have changed will only apply to the Profile you are
                                        creating.
                                    </p>

                                </div>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>About Me</li>
                                    <li>My Services & Rates</li>
                                    <li>My Availability</li>
                                    <li>Playmates</li>
                                </ul>

                                <h5><b>How is it done - New</b></h5>
                                <p>
                                    The Profile Creator completes your information in four steps. You can change any
                                    pre-loaded
                                    data along the way and the Creator will ask you if you want to update your settings. If
                                    you say
                                    Yes the data is updated, if you say No, your settings remain the same and the change/s
                                    you
                                    made are only applied to the Profile you are creating.
                                </p>

                                <h5 class="sec-head">Step 1 - About Me</h5>
                                <p>This step requires the most input. If you have already completed your data under <a
                                        href="{{ route('escort.profile.information') }}" class="custom_links_design">My
                                        Information</a>, then the data will have pre-loaded. Check that
                                    every field, or at the very least the fields that you want to be published in your
                                    Profile, are
                                    complete.</p>

                                <p>About Me is divided into four parts:</p>

                                <p class="mt-4"><i>Part A - Location Information</i></p>
                               

                                <div class="row">
                                    <div class="col-lg-7">
                                         <p>
                                    If you have completed your data in My
                                    Information, then those fields will be pre-
                                    loaded with your data.
                                </p>
                                <p>They can be edited while you are creating
                                    Profiles. You will need to complete the
                                    following:</p>
                                        <ul class="custom-ul">
                                            <li>Profile Name.

                                                <p>It would be helpful if you are consistent when naming your Profiles. We
                                                    recommend you adopt a protocol that relates to the Location. For
                                                    example, if you are creating a Profile for the Location NSW, then you
                                                    could name the Profile NSW01 and the second Profile, if you create a
                                                    second for the Location NSW, NSW02, and so on.
                                                </p>

                                            </li>

                                            <li>Stage Name.
                                                <p>This is your name you will use for your Profile. You can select a Stage
                                                    Name from your existing list, if your default Stage Name has not loaded,
                                                    or create a new Stage Name. Any new Stage Name you create will be
                                                    added to your list of Stage Names. Any Stage Names that are currently
                                                    in use, for the Location, will not appear in the list. If you have
                                                    nominated
                                                    one of your Stage Names as the Default, that will automatically load.
                                                </p>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-5 mb-2">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/location-information.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>


                                <ul class="custom-ul">
                                    <li>Location.
                                        <p>The Location, by default, will be your Home State. If you are presently
                                            in another Location, and that is where you want to list your Profile, then
                                            change the Location to where you are, like Victoria for example. Always
                                            remember, to List a Profile, you must have a Profile/s saved for the
                                            Location you intend to create a Listing for.
                                        </p>
                                    </li>
                                    <li>City.
                                        <p>The city name will load by default according to the Location you have
                                            selected, and will update if you change the Location.
                                        </p>
                                    </li>
                                    <li>Street Address.
                                        <p>This is optional. We recommend you include the address you are
                                            staying at but without the street number. This is particularly helpful to
                                            your clients so that they have an idea about where in the city you are
                                            staying, which helps them with timing and importantly where to park. If
                                            you have nominated one of your Street Addresses as the Default, that
                                            will automatically load.
                                        </p>
                                    </li>
                                    <li>Mobile.
                                        <p>Your mobile number will pre-load from your My Account settings.
                                        </p>
                                    </li>
                                </ul>

                                <p class="mt-4"><i>Part B - Media Photos</i></p>
                                
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                    There are two mandatory sets of photos
                                    required for your Profile, your Banner image,
                                    which appears across the top of your Profile,
                                    and your Thumbnail and supporting images.
                                    If you have set up your <a href="{{ route('escort.archive-view-photos') }}"
                                        class="custom_links_design">Media</a>, it will pre-load. If you have not set up
                                    your default Media, you can do so from the
                                    Profile Creator, and you will be asked if you
                                    want to update your default Media.
                                </p>


                                        <ul class="custom-ul">
                                            <li>Thumbnail.
                                                <p>You can change any of your images from your default images. The
                                                    Profile Creator will ask you if you want to update your default images
                                                    if
                                                    you have made any changes. If you answer Yes, your default images
                                                    will update. If you answer NO, your default images will remain
                                                    unchanged, but the new image/s you have selected will be attached to
                                                    the Profile you are creating.
                                                </p>
                                                <p>
                                                    Your Thumbnail image is what will appear in the Listings and is the
                                                    default image on your Profile page. Viewers can scroll through your
                                                    images, as well as click and view from a pop up.
                                                </p>
                                            </li>
                                            <li>Banner.
                                                <p>Your Banner image sits across the top of your Profile page. We
                                                    recommend you select an image that is landscape in nature. If you do
                                                    not have an image, your can select from our template images. The
                                                    images include: BDSM, Lingerie, Passive, Sheets and Subtle.
                                                </p>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/media.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                </div>
                                 <p class="mt-4"><i>Part B - Media Video</i></p>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            You can load up to six videos into your Media.
                                            The default video, three in total, will pre-load in
                                            the Profile Creator. You can change any of
                                            your videos within the Profile Creator. Where
                                            you change a video the Profile Creator will ask
                                            you if you want to update your default video.
                                            If you say Yes the data is updated, if you say
                                            No, your settings remain the same and the
                                            change/s you made are only applied to the
                                            Profile you are creating.

                                        </p>
                                        <p>Your video is displayed in the Media pop up on
                                            your profile. If you have video available to
                                            Viewers, your Profile will also display a camera indicating that video is available for
                                            viewing.</p>

                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/media-video.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                </div>

                               
                                
                                <p class="mt-4"><i>Part C - About Me</i></p>


                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        
                                        <p>
                                            If you have completed all of your data in<a
                                                href="{{ route('escort.profile.information') }}" class="custom_links_design"> My
                                                Information</a>,
                                            then there is no need to complete any settings here. You can make changes if you want.
                                        </p>

                                        <ul class="custom-ul">
                                            <li>About Me.
                                                <p>Here, you can describe your background
                                                    and where you are from. Your age is
                                                    mandatory.
                                                </p>

                                            </li>


                                            <li>Statistics.
                                                <p>Describe all of your features here and your statistics.
                                                </p>
                                            </li>
                                        </ul>
                                        <p>Although not all of this information is mandatory, we encourage you to include it
                                            in your Profile
                                            as it goes a long way to assisting Viewers to better understand who you are.</p>


                                        
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/about-me.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>
                                 <p class="mt-4"><i>Part C - Read More</i></p>
                                <div class="row">
                                    <div class="col-lg-7">
                                       
                                        <p>Additional information about you that is more
                                            detailed. If you have completed this
                                            information then there is no need to complete
                                            any settings here. This data does not appear
                                            openly on your Profile page. For a Viewer to
                                            see this data, they must click the ‘Read more’
                                            link to open the information up to see it. You can change the data and the
                                            Profile Creator will
                                            ask you if you want to update your settings.
                                        </p>
                                        <p>We encourage you to include this information in your Profile as it goes a long
                                            way to assisting
                                            Viewers to better understand who you are.</p>

                                        <p class="mt-4"><i>Part C - Covid 19</i></p>

                                        <p>What is your current Covid status.</p>

                                       
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/read-more.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>
                                 <p class="mt-4"><i>Part D - Who Am I</i></p>
                                <p>

                                    This is where you get to tell everyone about yourself. There are two parts to
                                    complete:

                                </p>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <ul class="custom-ul">
                                            <li>Tittle
                                                <p>Insert a tittle that you would
                                                    like to appear on your
                                                    Profile page to catch
                                                    everyone’s attention. If you
                                                    have a default Tittle, it will
                                                    automatically load, which
                                                    you can change.</p>
                                            </li>
                                            <li>Narration.
                                                <p>
                                                    Talk about yourself and who you are. Remember, there is no need to insert
                                                    any information about Rates, your Statistics, Availability or Playmates, as
                                                    all of that information is already pre-loaded elsewhere in the Profile. If you
                                                    have a default narration, it will automatically load, which you can change.

                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/who.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="sec-head">Step 2 - My Services & Rates</h5>
                                <p>All of the data for this section should be pre-loaded. There are two parts which can be
                                    edited.</p>

                                <p class="mt-4"><i>Part A - My Services</i></p>
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            Your default Service Tags that you have selected in <a
                                                href="{{ route('escort.profile.information') }}"
                                                class="custom_links_design">My
                                                Information</a>, will have pre-loaded here.
                                            You will notice the tags indicate ‘Status: Default’. This means
                                            the tag is a default Service Tag. You can change the status of
                                            the tag by clicking the Status which will display ‘Remove from
                                            Default’. If you remove the tag from default, the tag will remain
                                            in the Profile, but your default Service Tags will update. You
                                            can change the tag back to default by clicking the status again.
                                        </p>
                                        <p>If you add any more Service Tags, the Profile Creator will ask you if you want to
                                            update
                                            your default
                                            Service Tags. If you click Yes, the Service Tag will be added to your default
                                            Service Tags,
                                            as well as being added to the Profile you are creating. Any Service Tags that
                                            form your
                                            default Service Tags will appear Red and any that you add to the Creator but not
                                            to your
                                            default Service Tags will appear Blue with the status indicating the Profile
                                            name.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/services.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>



                                <p class="mt-4"><i>Part B - Rates</i></p>
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            If you have set your Rates in <a
                                                href="{{ route('escort.profile.information') }}"
                                                class="custom_links_design">My
                                                Information</a> then all of your preferred Rates will pre-load. If you
                                            change or add a Rate, the Profile Creator will ask you if you want to update
                                            your default Rate settings. If you answer Yes your default settings will
                                            update, if you answer No, your default settings for Rates will remain
                                            the same, but the change will attach to the Profile you are creating.
                                        </p>
                                        <p>Rates can be entered by either typing in the amount or by using the up and down
                                            toggle.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/rate.png') }}" alt=""
                                                class="w-75">
                                        </div>
                                    </div>

                                    <p class="mt-4"><i>Part C - Deposit</i></p>
                                    <div class="row mb-3">
                                        <div class="col-lg-7">
                                            <p>
                                                If you have set your conditions for Deposit in <a
                                                    href="{{ route('escort.profile.information') }}"
                                                    class="custom_links_design">My
                                                    Information</a> then they will pre-load. You can
                                                change the settings and a pop up will ask you
                                                if you want to update your default settings. If
                                                you say No, then the settings you have in the
                                                Profile Creator will be attached to that Profile.
                                                If you say Yes, the default settings will
                                                update.
                                            </p>
                                            <p>The field to enter the Deposit value will appear when you select ‘Yes’.
                                            </p>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="doc-img">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/deposit.png') }}"
                                                    alt="" class="w-75">
                                            </div>
                                        </div>
                                    </div>



                                    <h5 class="sec-head">Step 3 - My Availability</h5>
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <p>Essentially there are two forms of Availability, the physical start and
                                                finish
                                                times
                                                according to
                                                the clock, and a specific method, such as ‘By Appointment’.</p>


                                            <p>
                                                If you have set your Availability up in <a
                                                    href="{{ route('escort.profile.information') }}"
                                                    class="custom_links_design">My
                                                    Information</a> then all of your Availability settings
                                                will pre-load. If you change any of your Availability preferences,
                                                the Profile Creator will ask you if you want to update your default
                                                Availability settings. If you answer Yes your default settings will
                                                update, if you answer No, your default settings for your
                                                preferred Availability will remain the same, but the change will apply to
                                                the
                                                Profile
                                                you are
                                                creating.
                                            </p>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="doc-img">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/my-time.png') }}"
                                                    alt="" class="w-100">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- step-4 --}}

                                    <h5 class="sec-head">Step 4 - My Playmates</h5>



                                    <div class="row mb-3">
                                        <div class="col-lg-7">
                                            <p>To have a Playmate included in a Profile, you
                                                first have to make sure you have enabled the
                                                feature in <a href="{{ route('escort.profile.information') }}"
                                                    class="custom_links_design"> My
                                                    Information</a>. Once you have
                                                enabled the feature, you can then select as
                                                many Playmates as you want to be
                                                associated with any Listed Profile.</p>


                                            <p>If you have Playmates set up, they will appear
                                                in your Profile Creator (last tab). Select the
                                                Playmate/s you want attached to your Profile.

                                            </p>
                                            <p>
                                                The Website will automatically list the
                                                Playmate/s available to you according to the
                                                Location you have assigned to the Profile.
                                                When you create a Profile and you go to
                                                attach a Playmate, only Playmates in the
                                                same Location will be available from your list
                                                to attach to that Profile.
                                            </p>
                                            <p>
                                                If your nominated Playmate leaves the Location, while the Profile is Listed,
                                                the Playmate will
                                                automatically be removed from your Profile, and you will be notified of the
                                                change. You can
                                                edit the Profile to attach another Playmate if you have one available in the
                                                Location.
                                            </p>

                                            <p>
                                                When you create the Profile, you can select more than one Playmate for that
                                                Profile. Only
                                                Playmates nominated in the same Location can be added to a Profile nominated
                                                for the
                                                Location.
                                            </p>
                                            <p>
                                                You can edit your Listed Profile any time to update Playmates, including
                                                when you are in the
                                                Profile Creator.
                                            </p>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="doc-img">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/my-playmates-new.png') }}"
                                                    alt="" class="w-100">
                                            </div>
                                            <div class="doc-img">
                                                <img src="{{ asset('assets/dashboard/img/how-is-done/playmates.png') }}"
                                                    alt="" class="w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Listed -->
                    <div class="card">
                        <div class="card-header" id="headingCurrent">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseCurrent"
                                    aria-expanded="false">
                                    Listed
                                </a>
                            </h2>
                        </div>
                        <div id="collapseCurrent" class="collapse" aria-labelledby="headingCurrent"
                            data-parent="#accordion">
                            <div class="card-body">
                                <h5><b>Overview</b></h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            All of your current Profiles that are Listed on
                                            the Website are summarised here. You can
                                            edit your Listed Profiles as well as apply
                                            other features such as List Pin Up, Upgrade,
                                            Extend Profile, Bump Up, Suspend Profile
                                            and Add BRB.
                                        </p>
                                        <p>The report also summarises salient information about your Profiles that are
                                            Listed.</p>
                                        <h5><b>Features</b></h5>
                                        <ul class="custom-ul">
                                            <li>List Pin Up</li>
                                            <li>Upgrade</li>
                                            <li>Extend Profile</li>
                                            <li>Bump Up</li>
                                            <li>Suspend Profile (Listing or part thereof)</li>
                                            <li>Add BRB</li>
                                            <li>Listed Profiles (Current)</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/listed-profile.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>




                                <h5><b>How is it done - Listed Profiles</b></h5>
                                <p>
                                    After you list a Profile, the Listed Profile appears in this report. It is from this
                                    feature you
                                    manage your Profiles while they are currently Listed. Management includes:
                                </p>
                                <p>Listed Profiles is divided into two parts:</p>


                                <p class="mt-4">
                                    <i> Part A - Badges</i>
                                </p>

                                <h5 class="sec-head">
                                    List Pin Up
                                </h5>

                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            This feature is designed to give the Escort front end exposure on the
                                            Website.
                                            The Website
                                            does not, unlike others platforms, display Profiles for Viewers to look at
                                            from
                                            the Home page.
                                            Profile Listings are one click away. What does appear on the Home page is
                                            the
                                            Pin Up
                                            feature.
                                        </p>
                                        <p>This feature has a few rules:</p>
                                        <ul class="custom-ul">
                                            <li>The Pin Up Listing is for a set period of 7 days, commencing from Monday
                                                through to Sunday.</li>
                                            <li>The Fee is fixed at $475.00 per week (excl GST)</li>
                                            <li>You can only list for one week at a time, but re-apply for the Pin Up
                                                Listing any time.</li>
                                            <li>You must have a current Profile Listing where the start and end dates are
                                                either side of
                                                the Pin Up week.</li>

                                        </ul>

                                        <p>To apply to become a Pin Up, click the List Pin Up button. From the pop up,
                                            select the Profile
                                            you wish to use for the Pin Up and the week. Make sure you have uploaded
                                            your Pin Up
                                            image to <a href="{{ route('escort.archive-view-photos') }}"
                                                class="custom_links_design">Media</a>, otherwise you will be
                                            rejected. Once you have completed the settings, proceed to
                                            Payment.The affected Profile will display a ‘Pin Up’ tag in the
                                            table once the process has been completed.
                                        </p>
                                        <p>
                                            If the week you wish to be displayed as the Pin Up is not
                                            available that is because another Escort has already reserved
                                            the dates. If another week is available within the start and end
                                            dates for the Listed Profile, they will be displayed for you to
                                            select. If there are no available weeks within the Start and End
                                            dates, the pop up will indicate that to you.
                                        </p>
                                        <p>
                                            Once the process is completed, and payment has been made
                                            the receipt details will appear in the <a
                                                href="{{ url('escort-dashboard/transaction-summary') }}"
                                                class="custom_links_design">Transaction Summary</a> which you will find
                                            in the
                                            Bookkeeping menu group.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">

                                        <div class="doc-img mb-2">
                                            <img src="{{ asset('assets/dashboard/img/reg-pinup-src.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/pinup-media-error-scr.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>

                                </div>

                                <h5 class="sec-head">
                                    Upgrade
                                </h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Use this feature to Upgrade a Listing to a higher
                                            Membership Type. This feature only applies to current
                                            Listings that are either Silver or Gold.
                                        </p>

                                        <p>
                                            To Upgrade a Listing, simply click the button and a pop
                                            up will appear. Select the Profile you want to Upgrade,
                                            then select the Membership Type you want to upgrade to.
                                        </p>
                                        <p>Once you have selected your Upgrade options, click the
                                            Proceed to Payment button for payment. Once payment
                                            is completed, your Profile will be immediately upgraded
                                            to the Membership Type you selected, appearing at the
                                            beginning of the Membership Type. The affected Profile
                                            will display an ‘Upgraded’ tag in the table once the process has been completed.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/upgrade.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="sec-head">
                                    Extend Profile
                                </h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Use this feature to Extend a Listing for a set period of
                                            time, like another 10 days for example. This feature only
                                            applies to current Listings and for any Membership Type.
                                        </p>

                                        <p>
                                            To Extend a Listing, simply click the button and a pop up
                                            will appear. Select the Profile you want to Extend, then
                                            select the period you want to apply the extension to.
                                        </p>
                                        <p>Once you have selected your Extension options, click the
                                            Proceed to Payment button for payment. Once payment
                                            is completed, your Profile will be immediately extended to
                                            the new date. The affected Profile will display an
                                            ‘Extended’ tag in the table once the process has been completed.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/extend.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>


                                <h5 class="sec-head">
                                    Bump Up
                                </h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Use this feature to Bump Up your Listing to the top of the
                                            Membership Type. This feature applies to any current
                                            Listing you have.
                                        </p>

                                        <p>
                                            To Bump Up a Listing, simply click the button and a pop
                                            up will appear. Select the Profile you want to Bump Up.
                                        </p>
                                        <p>Once you have selected the Profile you want to Bump
                                            Up, click the Proceed to Payment button for payment.
                                            Once payment is completed, your Profile will be
                                            immediately Bumped Up to the beginning of the
                                            Membership Type. The affected Profile will display a
                                            ‘Bumped Up’ tag in the table once the process has been
                                            completed.
                                        </p>
                                        <p>Your Profile will remain in the Bump Up position for 24 hours, after which it
                                            will rejoin the
                                            mainstream listings for the Membership Type.</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/bump-up.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>


                                <h5 class="sec-head">
                                    Suspend
                                </h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Use this feature if you want to remove your Listed Profile
                                            for a short period of time (2 or more days). This feature
                                            is typically used where the Escort has to stop work due to
                                            an emergency, like having to return to their Home State
                                            to attend to something, and then return to the Location.
                                            Where this happens, the Listed Profile will be removed
                                            from the Website, and reinstated according to your
                                            settings
                                        </p>

                                        <p>
                                            Click the Suspend button and enter the details for the
                                            suspension period. You will see the Credit being
                                            calculated live. Once the details are entered click the
                                            Suspend button. The affected Profile will display a
                                            ‘Suspended’ tag in the table once the process has been completed.
                                        </p>
                                        <p>
                                            You will receive a full Credit for the number of days the Listed Profile is not
                                            active. You can
                                            apply the Credit toward future Listings.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/suspend-listing.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>











                                <h5 class="sec-head">
                                    Add BRB
                                </h5>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            If you wish not to be disturbed for a period of
                                            time, because you may be out to dinner for
                                            example, you can use this feature to let
                                            Viewers know that you are not available until
                                            the time you set in the BRB notification.
                                        </p>
                                        <p>
                                            Simply click the BRB button and enter the
                                            details to for your BRB. Once the details are
                                            entered click the Do you want to Post button.
                                            Your BRB will be displayed on the Listing
                                            page, your Profile and Pin Up (is applicable).
                                            The affected Profile will display a ‘BRB’ tag in the table once the process has
                                            been
                                            completed.
                                        </p>
                                        <p>
                                            The BRB notice will automatically be removed from your Profile when the
                                            time setting expires. Viewers will understand that you are still available
                                            except for the time the BRB notice is active.
                                        </p>
                                        <p>
                                            You can also cancel the BRB after it has been posted. This is helpful if you
                                            happen to return early and you want to return to work. Simply go the Action
                                            options for the affected Profile and select ‘Cancel BRB’.
                                        </p>
                                        <p>
                                            If your Profile is also registered as the current Pin Up in your Location, and
                                            you apply a BRB, the BRB banner will also display on your Pin Up image
                                            on the Home Page.
                                        </p>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/add-brb.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="doc-img mt-2 mb-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/profile-notice.png') }}"
                                                alt="" class="w-50">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <p><i>Part B - Profile Management (Action)</i></p>
                                <h5 class="sec-head">
                                    Cancel BRB
                                </h5>
                                <p>Use this Action item to cancel you BRB notification. Once the BRB is cancelled, the BRB
                                    tag
                                    will automatically be removed from the Listing and the report page.</p>
                            </div>


                            <div>
                                <h5 class="sec-head">
                                    Edit
                                </h5>
                                <p>To edit a Profile, select Edit from the Action list. The Profile will open up in the
                                    Profile Creator
                                    where you can edit any part of the Profile. The editing is undertaken in parts, just
                                    like the
                                    Profile was first created, which you must save when completed.</p>

                                <p>Any changes you make to a Listed Profile, once saved, are applied immediately. You will
                                    be
                                    asked with any changes you make if you want the change to be applied to your default
                                    settings.</p>
                            </div>

                            <div>
                                <h5 class="sec-head">
                                    Delete
                                </h5>
                                <p>Use this Action item to delete a Listed Profile. Using the Delete Action will permanently
                                    delete
                                    the Listing and the Profile from your Account. If you want to cancel the Listing, but
                                    retain the
                                    Profile, use the Cancel Listing option.</p>
                            </div>

                            <div>
                                <h5 class="sec-head">
                                    Add Playmates
                                </h5>
                                <p>If you haven’t already included your Playmate/s in a Profile when you created the
                                    Profile, you
                                    can add a Playmate/s using this Action Item. After clicking the Action item, the Profile
                                    will
                                    open in Edit mode. You will be taken the My Playmates tab. Any Playmates that you have
                                    listed in My Information will appear here.</p>

                                <p>Simply select the Playmate/s you want to add to the Profile. Or alternatively, you can
                                    enter
                                    the Escort’s Member ID in the search field to locate the Escort and then add the Escort
                                    to
                                    your My Playmates list and the Profile. Remember, you can only search for Escorts that
                                    have
                                    enabled this feature to be a Playmate (like yourself).</p>
                            </div>

                            <div>
                                <h5 class="sec-head">
                                    Pin Up Summary
                                </h5>
                                <p>The Pin Up summary pop up is a snap shot of the salient elements to the Pin In listing.
                                    Importantly, it summarises the start and end dates, and the Prof ile name.</p>
                            </div>

                            <div>
                                <h5 class="sec-head">
                                    View Profile
                                </h5>
                                <p>If you want to see how a Profile looks in the Listings, click View Profile for a pop up
                                    of the
                                    Profile. You can view all the components to the Profile.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Archived -->
                    <div class="card">
                        <div class="card-header" id="headingPast">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapsePast"
                                    aria-expanded="false">
                                    Archived
                                </a>
                            </h2>
                        </div>
                        <div id="collapsePast" class="collapse" aria-labelledby="headingPast" data-parent="#accordion">
                            <div class="card-body">
                                <h5><b>Overview</b></h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                          <p>
                                    All Listed Profiles which have expired are listed in this report. Archived Profiles
                                    can
                                    be used for New Listings as well as for creating New Profiles with the ‘Duplicate’
                                    feature.
                                </p>
                                <p>The report also sets out salient information about Profiles, such as the Location the
                                    Profile is attached to.</p>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Duplicate</li>
                                    <li>Edit</li>
                                    <li>View Profile</li>
                                    <li>Delete</li>
                                </ul>
                                    </div>
                                    
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/archive-list.png') }}"
                                                alt="profile-duplicate" class=" w-100">
                                        </div>
                                    </div>
                                </div>
                              

                                <h5><b>How is it done - Archives</b></h5>
                                <p>
                                    Any expired Listed Profiles, or new Profiles you have created but are not Listed appear
                                    in this
                                    report. This feature enables you to manage your Profiles across all Locations. There are
                                    a
                                    number of Actions you can perform. When creating a Tour, you should build all of your
                                    Profiles you intend to use in the Tour here.
                                </p>


                                <h5 class="sec-head">
                                    Duplicate
                                </h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            A very useful tool, a selected Profile can be
                                            duplicated by simply selecting the Profile you
                                            want to duplicate. In the pop up, complete
                                            the information required to establish the
                                            duplicate Profile, and then Save.
                                        </p>
                                        <p>
                                            Remember to follow your naming protocol for
                                            Profiles if you have established one, like
                                            WA01 for Profiles created for Western
                                            Australia, and NSW01 for Profiles created for
                                            NSW. You can duplicate as many Profiles
                                            as you like.
                                        </p>
                                        <p>
                                            When duplicating your Profiles, especially for when you are building your
                                            Profiles to attach
                                            to a Tour, remember the change the Stage Name and Street Address to match the
                                            Location
                                            you are creating the Profile for.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/profile-duplicate-scr.png') }}"
                                                alt="profile-duplicate" class=" w-100">
                                        </div>
                                    </div>

                                </div>

                                <h5 class="sec-head">
                                    Edit
                                </h5>
                                <p>Use this tool to make changes to any Profile before you List. When you make a change to
                                    any part of the Profile, you will be asked if you want to update your My Information for
                                    future Profiles. If you answer Yes, My Information is updated. If you answer No, My
                                    Information
                                    remains unchanged, but the change you made for the Profile is applied.
                                </p>
                                <p>
                                    Once you have finished making your changes, click Update.
                                </p>
                                <h5 class="sec-head">
                                    View Profile
                                </h5>
                                <p>If you want to see the Profile to remind yourself what the Profile looks like before
                                    you
                                    List it,
                                    click View Profile from the Action list.
                                </p>
                                <p>
                                    This is particularly helpful for Profiles you have created and intend to use in a Tour.
                                    Always
                                    best to check the information in each Profile is correct before you create the Tour,
                                    especially
                                    if there are subtle differences in the Profiles, like the Stage Name, Rates and the
                                    Street
                                    Address.
                                </p>

                                <h5 class="sec-head">
                                    Delete
                                </h5>
                                <p>If you want to delete a Profile, click Delete from the Action list. Any Profile you
                                    delete will be
                                    deleted permanently and can not be recovered.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
@push('script')
    <!-- file upload plugin start here -->
    <!-- file upload plugin end here -->
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush
