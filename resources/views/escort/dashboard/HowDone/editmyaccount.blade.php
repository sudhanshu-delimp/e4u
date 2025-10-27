@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
 <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        .how--work {
            margin: 40px auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 270px 1fr;
            gap: 24px;
            width: 100%;
            position: relative;
        }

       

        p i {
            color: #000000;
        }

        .steps p {
            margin-block-start: 1em;
            margin-block-end: 1em;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            padding: 0;
        }

        .callout {
            padding: 12px 14px;
            border: 1px dashed #e5e7eb;
            border-radius: 14px;
            background: rgba(94, 161, 255, .08);
        }

        .summary-title:hover {
            color: #FF3C5F;
        }

        .summary-title ul {
            padding: 8px 0 8px 24px;
        }

        .steps ul {
            margin: 8px 0 8px 8px;
        }

        .how-it-done p {
            margin-bottom: 0.8rem !important;
        }

        .how-it-done h5 {
            font-weight: 500;
        }

        .custom-ul {
            padding-left: 20px;
        }

        .custom-ul li {
            padding-left: 25px;
        }

        .sec-head {
            border-bottom: 2px solid;
            width: max-content;
            margin: 25px 0px 15px 0px;
        }

        p {
            text-align: justify;
        }
    </style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Edit My Account</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b> </h3>
                   <ol>
                    <li>
                      <div class="d-flex">
                        <p>Use these help pages for explanations and guidance on
completing data and activating features.</p>
                                <div class="doc-img w-50">
                                    <img src="{{ asset('assets/dashboard/img/edit-my-account-scr.png') }}" alt=""
                                        class="w-100">
                                </div>
                      </div>
                    </li>
                    <li>Where a feature has default data, we recommend you
                        complete the default data before commencing any
                        activity with the feature.
                    </li>
                    <li>Some features are already set as default which can be edited. It is important that you
                        complete your information about yourself before you use the Website.</li>
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
                                    About Me
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
                                <p><i>Location Information</i></p>
                                <p>Some of these fields are pre-loaded with your data. You will need to complete the
                                    following:</p>

                                <ul class="custom-ul">
                                    <li>Profile Name.
                                      <div class="row">
                                        <div class="col-lg-12">
                                          
                                        <p>It would be helpful if you are consistent
                                            when naming your Profiles. We
                                            recommend you adapt a protocol that
                                            relates to the Location. For example, if
                                            you are creating a Profile for the Location
                                            NSW, then you could name the Profile
                                            Sydney01 and the second Profile, if you
                                            create a second for the Location NSW, Sydney02, and so on.
                                        </p>
                                        </div>
                                        <div class="col-lg-12 my-3">
                                          <div class="doc-img">
                                              <img src="{{ asset('assets/dashboard/img/profile-location.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                          </div>
                                        </div>
                                      </div>
                                        
                                    </li>


                                    <li>Stage Name.
                                        <p>This is your name you will use for your Profile. You can select a Stage
                                            Name from your existing list or create a new Stage Name. Any new
                                            Stage Name you create will be added to your list of Stage Names. Any
                                            Stage Names that are currently in use, for the Location, will not appear
                                            in the list.
                                        </p>
                                    </li>
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

                                <p><i>Media - Photos</i></p>
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

                                <ul class="custom-ul">
                                    <li>Thumbnail.
                                        <div class="row mb-3">
                                            <div class="col-lg-7">
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
                                            </div>
                                           <div class="col-lg-5">
                                              <div class="doc-img">
                                                  <img src="{{ asset('assets/dashboard/img/media-photo.png') }}"
                                                      alt="" class="w-100 rounded-sm">
                                              </div>
                                           </div>
                                        </div>
                                    </li>


                                    <li>Banner.
                                        <p>Your Banner image sits across the top of your Profile. We recommend
                                            you select an image that is landscape in nature. If you do not have an
                                            image, your can select from our template images. The images represent
                                            a range of erotic lingerie.
                                        </p>
                                    </li>
                                </ul>

                                <p><i>Media - Video</i></p>
                                <p>

                                    You can load up to six videos into your Media. The default video, three in total, will
                                    pre-load
                                    in the Creator. You cab change any of your videos within the Creator. Where you change
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


                                <p><i>About Me</i></p>
                                <p>
                                    If you have completed all of your data in<a
                                        href="{{ route('escort.profile.information') }}" class="custom_links_design"> My
                                        Information</a>,
                                    then there is no need to complete any settings here. You can make changes if you want.
                                </p>

                                <ul class="custom-ul">
                                    <li>About Me.
                                        
                                        <div class="row mb-3">
                                          <div class="col-lg-12">
                                            <p>Here, you can describe your background
                                            and where you are from. Your age is
                                            mandatory.
                                        </p>
                                          </div>
                                          <div class="col-lg-12">
                                              <div class="doc-img">
                                              <img src="{{ asset('assets/dashboard/img/profile-location.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                          </div>
                                          </div>
                                        </div>
                                    </li>


                                    <li>Statistics.
                                        <p>Describe all of your features here and your statistics.
                                        </p>
                                    </li>
                                </ul>


                                <p><i>Read More</i></p>
                                <p>Additional information about you that is more detailed. This data does not appear openly
                                    in
                                    your Profile. For a Viewer to see this data, they must click the ‘Read more’ link to
                                    open the
                                    information up to see it.
                                </p>


                                <p><i>Covid 19</i></p>

                                <p>What is your current Covid status.</p>

                                <p><i>Who Am I</i></p>
                                <p>

                                    This is where you get to tell everyone about yourself. Two parts to complete:

                                </p>
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

                                <p><i>My Services</i></p>
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
                                          <img src="{{ asset('assets/dashboard/img/my-services-scr.png') }}" alt=""
                                              class="w-100 rounded-sm">
                                      </div>
                                    </div>
                                </div>



                                <p><i>Rates</i></p>
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
                                <p>Essentially there are two forms of Availability, the physical start and finish times
                                    according to
                                    the clock, and a specific method, such as ‘By Appointment’.</p>


                                <p>
                                    If you have set your Availability up in <a
                                        href="{{ route('escort.profile.information') }}" class="custom_links_design">My
                                        Information</a> then all of your Availability settings
                                    will pre-load. If you change any of your Availability preferences,
                                    the Creator will ask you if you want to update your default
                                    Availability settings. If you answer Yes your default settings will
                                    update, if you answer No, your default settings for your
                                    preferred Availability will remain the same, but the change will apply to the Profile
                                    you are
                                    creating.
                                </p>
                                <div class="col-lg-12">
                                  <div class="doc-img">
                                    <img src="{{ asset('assets/dashboard/img/my-availability-scr.png') }}" alt=""
                                        class="w-100">
                                </div>
                                </div>



                                <h5 class="sec-head">Step 4 - My Playmates</h5>
                                <p>Essentially there are two forms of Availability, the physical start and finish times
                                    according to
                                    the clock, and a specific method, such as ‘By Appointment’.</p>


                                <p>
                                    To have a Playmate included in your Profile, you first have to make sure you have set up
                                    your
                                    Playmates in<a href="{{ route('escort.profile.information') }}"
                                        class="custom_links_design"> My
                                        Information</a>, and assigned the Playmate to a Location.
                                </p>

                                <p>Select the Playmate/s you want attached to your Profile. The Website will automatically
                                    list
                                    the Playmate/s available to you according to the Location you have assigned to the
                                    Profile.
                                    When you create a Profile and you go to attach a Playmate, only Playmates in the same
                                    Location will be available from your list to attach to the Profile. If your nominated
                                    Playmate
                                    leaves the Location, while the Profile is Listed, the Playmate will automatically be
                                    removed
                                    from your Profile, and you will be notified of the change. You can edit the Profile to
                                    attach
                                    another Playmate if you have one available in the Location.</p>
                                <p>When you create the Profile, you can select more than one Playmate for that Profile. Only
                                    Playmates nominated in the same Location can be added to a Profile nominated for the
                                    Location.</p>
                                <p>You can edit your Listed Profile any time to update Playmates, including when you are in
                                    the Profile Creator.</p>
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
