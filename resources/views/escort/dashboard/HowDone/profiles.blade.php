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
                                duplicating a Profile.</li>
                            <li>You can create as many Profiles as you want across any Location.</li>
                            <li>Before you can List a Profile, you must have created and saved a Profile for the
                                Location you wish to complete the Listing in.</li>
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

                                <h5><b>How is it done</b></h5>
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
                                
                                <p class="mt-4"><i>Location Information</i></p>
                                <p>Some of these fields are pre-loaded with your data. You will need to complete the
                                    following:</p>

                                <div class="row">
                                    <div class="col-lg-7">

                                        <ul class="custom-ul">
                                            <li>Profile Name.

                                                <p>It would be helpful if you are consistent
                                                    when naming your Profiles. We
                                                    recommend you adapt a protocol that
                                                    relates to the Location. For example, if
                                                    you are creating a Profile for the Location
                                                    NSW, then you could name the Profile
                                                    Sydney01 and the second Profile, if you
                                                    create a second for the Location NSW, Sydney02, and so on.
                                                </p>

                                            </li>

                                            <li>Stage Name.
                                                <p>This is your name you will use for your Profile. You can select a Stage
                                                    Name from your existing list or create a new Stage Name. Any new
                                                    Stage Name you create will be added to your list of Stage Names. Any
                                                    Stage Names that are currently in use, for the Location, will not appear
                                                    in the list.
                                                </p>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-5 my-3">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/profile-location.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>


                                <ul class="custom-ul">
                                    <li>Location.
                                        <p>The Location, by default, will be your Home State. If you are presently
                                            in another Location, and that is where you want to list your Profile, then
                                            change the Location to where you are, like Victoria for example. Always
                                            remember, to List a Profile, you must have a Profile/s saved for the
                                            Location you intent to create a Listing for.
                                        </p>
                                    </li>
                                    <li>City.
                                        <p>The city name will load by default according to the Location you have
                                            selected.
                                        </p>
                                    </li>
                                    <li>Street Address.
                                        <p>This is optional. We recommend you include the address you are
                                            staying at but without the street number. This is particularly helpful to
                                            your clients so that they have an idea about where in the city you are
                                            staying, which helps them with timing and importantly where to park.
                                        </p>
                                    </li>
                                    <li>Mobile.
                                        <p>Your mobile number will pre-load from your My Account settings.
                                        </p>
                                    </li>
                                </ul>

                                <p class="mt-4"><i>Media - Photos</i></p>
                                <p>
                                    There are two mandatory sets of photos required for your Profile, your Banner image,
                                    which
                                    appears across the top of your Profile, and your Thumbnail and supporting images. If you
                                    have set up your <a href="{{ route('escort.archive-view-photos') }}"
                                        class="custom_links_design">Media</a>, it will pre-load. If you have not set up your
                                    default
                                    Media, you can do so from the Creator, and you will be asked if you want to update your
                                    default Media. The Creator will also permit you to clip images.
                                </p>


                                <div class="row mb-3">
                                    <div class="col-lg-7">

                                        <ul class="custom-ul">
                                            <li>Thumbnail.
                                                <p>You can change any of your images from
                                                    your default images. The Creator will ask
                                                    you if you want to update your default
                                                    images if you have made any changes. If
                                                    you answer Yes, your default images will
                                                    update. If you answer NO, your default
                                                    images will remain unchanged, but the
                                                    new image/s you selected will be attached
                                                    to the Profile you are creating.
                                                </p>
                                                <p>
                                                    Your Thumbnail image is what will appear in the Listings and is the
                                                    default image on your Profile. Viewers can scroll through your images,
                                                    as well as click and view from a pop up.
                                                </p>
                                            </li>
                                            <li>Banner.
                                                <p>Your Banner image sits across the top of your Profile. We recommend
                                                    you select an image that is landscape in nature. If you do not have an
                                                    image, your can select from our template images. The images represent
                                                    a range of erotic lingerie.
                                                </p>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/media-photo.png') }}" alt=""
                                                class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>




                                <p class="mt-4"><i>Media - Video</i></p>
                                <p>

                                    You can load up to six videos into your Media. The default video, three in total, will
                                    pre-load
                                    in the Creator. You can change any of your videos within the Creator. Where you change
                                    a video the Creator will ask you if you want to update your default video. If you say
                                    Yes the
                                    data is updated, if you say No, your settings remain the same and the change/s you made
                                    are
                                    only applied to the Profile you are creating.

                                </p>
                                <p>Your video is displayed in the Media pop up on your profile. If you have video available
                                    to
                                    Viewers, your Profile will also display a camera indicating that video is available for
                                    viewing.</p>


                                <p class="mt-4"><i>About Me</i></p>
                                <p>
                                    If you have completed all of your data in<a
                                        href="{{ route('escort.profile.information') }}" class="custom_links_design"> My
                                        Information</a>,
                                    then there is no need to complete any settings here. You can make changes if you want.
                                </p>



                                <div class="row mb-3">
                                    <div class="col-lg-7">
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



                                        <p class="mt-4"><i>Read More</i></p>
                                        <p>Additional information about you that is more detailed. This data does not appear
                                            openly
                                            in
                                            your Profile. For a Viewer to see this data, they must click the ‘Read more’
                                            link to
                                            open the
                                            information up to see it.
                                        </p>


                                        <p class="mt-4"><i>Covid 19</i></p>

                                        <p>What is your current Covid status.</p>

                                        <p class="mt-4"><i>Who Am I</i></p>
                                <p>

                                    This is where you get to tell everyone about yourself. Two parts to complete:

                                </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-additional-info-scr.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                
                                <ul class="custom-ul">
                                    <li>Heading.
                                        <p>Insert a heading that you would like to appear on your Profile to catch
                                            everyone’s attention.</p>
                                    </li>
                                    <li>About me.
                                        <p>
                                            Talk about yourself and who you are. Remember, there is no need to
                                            insert any information about Rates, your Statistics, Availability or
                                            Playmates, as all of that information is already pre-loaded.

                                        </p>
                                    </li>
                                </ul>

                                <h5 class="sec-head">Step 2 - My Services & Rates</h5>
                                <p>All of the data for this section should be pre-loaded. There are two parts which can be
                                    edited.</p>

                                <p class="mt-4"><i>My Services</i></p>
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            Any Service Tags that you have selected from <a
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
                                        <p>If you add any more Service Tags, the Creator will ask you if you want to update
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
                                            <img src="{{ asset('assets/dashboard/img/my-services-scr.png') }}"
                                                alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>



                                <p class="mt-4"><i>Rates</i></p>
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            If you have set your Rates in <a
                                                href="{{ route('escort.profile.information') }}"
                                                class="custom_links_design">My
                                                Information</a> then all of your preferred Rates will pre-load. If you
                                            change or add a Rate, the Creator will ask you if you want to update
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
                                            <img src="{{ asset('assets/dashboard/img/rate-scr.png') }}" alt=""
                                                class="w-75">
                                        </div>
                                    </div>
                                </div>



                                <h5 class="sec-head">Step 3 - My Availability</h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Essentially there are two forms of Availability, the physical start and finish
                                            times
                                            according to
                                            the clock, and a specific method, such as ‘By Appointment’.</p>


                                        <p>
                                            If you have set your Availability up in <a
                                                href="{{ route('escort.profile.information') }}"
                                                class="custom_links_design">My
                                                Information</a> then all of your Availability settings
                                            will pre-load. If you change any of your Availability preferences,
                                            the Creator will ask you if you want to update your default
                                            Availability settings. If you answer Yes your default settings will
                                            update, if you answer No, your default settings for your
                                            preferred Availability will remain the same, but the change will apply to the
                                            Profile
                                            you are
                                            creating.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-availability-scr.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>


                                {{-- step-4 --}}

                                <h5 class="sec-head">Step 4 - My Playmates</h5>

                                <p class="mt-4"><i>Enable Feature</i></p>


                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>To have a Playmate included in a Profile, you
                                            first have to make sure you have enabled the
                                            feature in <a href="{{ route('escort.profile.information') }}"
                                                class="custom_links_design"> My
                                                Information</a> Once you have
                                            enabled the feature, you can then select as
                                            many Playmates as you want to be
                                            associated with any Listed Profile.</p>


                                        <p>Any Playmates that you include in a Listed Profile will be added to your My
                                            Active
                                            Playmates list.

                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-playmates-scr.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <p><i>Adding a Playmate</i></p>
                                <p>To add a Playmate to a Profile, go to <a href="{{ route('escort.list', 'current') }}"
                                        class="custom_links_design">Listed Profile</a> and select from the Action options,
                                    ‘Include Playmates’. From the Update Profile page, select the Playmates you want to be
                                    included in your Profile. Remember, you can only select other Escorts who have also
                                    enabled the feature. Only Playmates that are in the same Location will be available to
                                    be
                                    included in a Profile. If a Playmate you have added to a Listed Profile leaves your
                                    Location
                                    during the Listed period, that Playmate will be automatically removed from the Listed
                                    Profile.</p>

                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>When selecting a Playmate, there are two
                                            choices, Playmates you have already added
                                            to other Profiles, and new Playmates you
                                            want to add to your ‘My Active Playmates’ list.
                                            To add a new Playmate, search their
                                            Membership ID, remembering that they:</p>
                                        <ul class="custom-ul">
                                            <li>must have enabled the feature;</li>
                                            <li>be in your Location; and</li>
                                            <li>have a Listed Profile.</li>
                                        </ul>
                                        <p>If the search you undertake has all of the requirements included in the Escort’s
                                            settings
                                            that
                                            you are searching, then their card will appear and you simply tick the box to
                                            add them
                                            to your
                                            Profile. You can also tick any of the other Playmates that are listed here from
                                            your My
                                            Active
                                            Playmates list. That is to say, you can have more than one Playmate.</p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-playmates-scr-2.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>



                                <p class="mt-4"><i>Editing your Playmates</i></p>
                                <p>Lastly, you can edit your Listed Profile any time to update Playmates, including when you
                                    are
                                    in the Profile Creator. Don’t forget, if a Playmate leaves your Location, or their
                                    Listed Profile
                                    expires, then they will be automatically removed from your Listed Profile.</p>
                                <p>
                                    If the Playmate removes you from their Listed Profile, then they will be removed from
                                    your
                                    Listed Profile as well.

                                </p>


                                <p class="mt-4"><i>Profile View</i></p>



                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            When a Playmate has been added to a Listed
                                            Profile, their avatar will appear on your Listed
                                            Profile. Your avatar will also appear on their
                                            Listed Profile. When a User looks at your
                                            Profile, and they are interested in a Playmate
                                            that appears on your Profile, the User can
                                            click the Playmate and their Profile will open
                                            for the User to view. The Avatar will also
                                            disclose their name.
                                        </p>

                                        <p>
                                            If you do not have any Playmates, the Listed
                                            Profile will say so.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-playmates-scr-3.png') }}"
                                                alt="" class="w-100">
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
                                            All of your current Profiles that are Listed on the Website are
                                            summarised here. You can edit your Listed Profiles as well as
                                            apply other features such as BRB, Suspend and List Pin Up.The report also
                                            summarises salient information about your
                                            Profiles that are Listed.
                                        </p>
                                        <h5><b>Features</b></h5>
                                        <ul class="custom-ul">
                                            <li>Add BRB</li>
                                            <li>Suspend (Listing or part thereof)</li>
                                            <li>List Pin Up</li>
                                            <li>Current Profiles Listed</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-3">
                                            <img src="{{ asset('assets/dashboard/img/listed-profile.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>




                                <h5><b>How is it done</b></h5>
                                <p>
                                    After you list a Profile, the Listed Profile appears in this report. It is from this
                                    feature you
                                    manage your Profiles while they are currently Listed. Management includes:
                                </p>

                                <h5 class="sec-head">
                                    BRB
                                </h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>If you wish not to be disturbed for a period of time, because you may be out to
                                            dinner for
                                            example, you can use this feature to let Viewers know that you are not available
                                            until the time
                                            you set in the BRB.
                                            <br>
                                            Simply click the BRB button and enter the details to record your
                                            BRB and Save. Your BRB will be displayed on your Profile as
                                            well as the report updating to reflect the Profile has a BRB.</p>

                                            <p>
                                            The BRB will automatically be removed from your Profile when
                                            the time setting expires. Viewers will understand that you are
                                            still available except for the time the BRB is active.
                                        </p>
                                        <p>You can also cancel the BRB after it has been posted. This is helpful if you
                                            happen to return early and you want to return to work.
                                        </p>
                                        <p>
                                            If your Profile is also registered as the current Pin Up in your Location, and
                                            you apply a BRB, the BRB banner will also display on your Pin Up image on
                                            the Home Page.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img mb-2">
                                            <img src="{{ asset('assets/dashboard/img/add-brb-src.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                        <div class="d-flex justify-content-end align-items-end">
                                            <img src="{{ asset('assets/dashboard/img/profile-pic-scr.png') }}"
                                                alt="" class="w-50 doc-img">
                                        </div>
                                    </div>
                                </div>




                                <h5 class="sec-head">
                                    Suspend
                                </h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>Use this feature if you want to remove your Listed Profile for a
                                            short period of time (2 or more days). This feature is typically
                                            used where the Escort has to stop work due to an emergency,
                                            like having to return to their Home State to attend to something,
                                            and then return to the Location. Where this happens, the
                                            Listed Profile will be removed from the Website, and reinstated
                                            according to your settings.
                                        </p>

                                        <p>
                                            Click the Suspend button and enter the details for the
                                            suspension period. You will see the Credit being calculated live. Once the
                                            details are
                                            entered, Save. The affected Profile will display a ‘SUS’ indicator.
                                        </p>
                                        <p>
                                            You will receive a full Credit for the number of days the Listed Profile in not
                                            active. You can
                                            apply the Credit toward future Listings.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/susspend-profile-src.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>




                                <h5 class="sec-head">
                                    List Pin Up
                                </h5>
                                <div class="row mb-3">
                                    <div class="col-lg-7">
                                        <p>
                                            This feature is designed to give the Escort front end exposure on the Website.
                                            The Website
                                            does not, unlike others platforms, display Profiles for Viewers to look at from
                                            the Home page.
                                            Profile Listings are one click away. What does appear on the Home page is the
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
                                            <li>You must have a current Profile Listing wherein the start and end dates are
                                                either side of the Pin Up week.</li>
                                            
                                        </ul>

                                            <p>To apply to become a Pin Up, click the List Pin Up button. From the pop up,
                                                select the Profile
                                                you wish to use for the Pin Up and the week. Make sure you have uploaded
                                                your Pin Up
                                                image to <a href="{{ route('escort.archive-view-photos') }}"
                                                    class="custom_links_design">Media</a>, otherwise you will be
                                                rejected. Once you have completed the settings, proceed to
                                                Payment.
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
                                    Edit Profile
                                </h5>

                                <p>
                                    To edit a Profile, select Edit from the Action list. The Profile will open up in the
                                    Profile Creator
                                    where you can edit any part of the Profile. The editing is undertaken in sections, which
                                    you
                                    must save when completed.
                                </p>
                                <p>Any changes you make to a Listed Profile, once saved, are applied immediately.</p>


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
                                <p>
                                    All Listed Profiles which have expired are listed in this report. Archived Profiles can
                                    be used for New Listings as well as for creating New Profiles with the ‘Duplicate’
                                    feature.
                                </p>
                                <p>The report also sets out salient information about Profiles, such as the Location the
                                    Profile is attached to.</p>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Search</li>
                                    <li>Duplicate</li>
                                    <li>Edit</li>
                                    <li>View</li>
                                    <li>Delete</li>
                                    <li>Comprehensive data summary</li>
                                    <li>Historical records</li>
                                </ul>

                                <h5><b>How is it done</b></h5>
                                <p>
                                    Any expired Listed Profile, or new Profile you have created but are not Listed appear
                                    in this
                                    report. This feature enables you to manage your Profiles across all Locations. There are
                                    a
                                    number of Actions you can perform.
                                </p>


                                <h5 class="sec-head">
                                    Duplicate
                                </h5>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            A very useful tool, a selected Profile can be duplicated. Simply
                                            select the Profile you want to duplicate. In the pop up,
                                            complete the information required to establish the duplicate,
                                            Save. Remember to follow your naming protocol for Profiles if
                                            you have established one.
                                        </p>
                                        <p>
                                            You can duplicate as many Profiles as you like.
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
                                <p>Use this tool to make changes to any Profile that you want to List. When you make a
                                    change
                                    to any part of the Profile, you will be asked if you want to update your My Information
                                    for
                                    future Profiles. If you answer Yes, My Information is updated. If you answer No, My
                                    Information remains unchanged, but the change you made for the Profile is applied.</p>
                                <p>
                                    Once you have finished making your changes, click Update.
                                </p>
                                <h5 class="sec-head">
                                    View
                                </h5>
                                <p>If you want to see the Profile to remind yourself what the Profile looks like before you
                                    List it,
                                    click View Profile from the Action list.
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
