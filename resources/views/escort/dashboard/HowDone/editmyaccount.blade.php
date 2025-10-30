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
            <h1 class="h1">Edit My Account</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b> </h3>
                   <ol>
                    <div class="d-flex gap-20 justify-content-between">
                       <div class="text-justify">
                        <li>
                         Use these help pages for explanations and guidance on
                                completing data and activating features.
                       </li>
                        <li>Where a feature has default data, we recommend you
                            complete the default data before commencing any
                            activity with the feature.
                        </li>
                         <li>Some features are already set as default which can be edited. It is important that you
                        complete your information about yourself before you use the Website.</li>
                    </div>
                        <div class="doc-img">
                            <img src="{{ asset('assets/dashboard/img/edit-my-account-scr.png') }}" alt=""
                                class="w-100">
                        </div>
                      </div>
                      
                    
                   
                   
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
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            This is the most important part of your Console and before
                                            you can undertake any activity in the Website, you must
                                            complete this section. It will only take you a moment to
                                            complete, and once it is done you won’t have to do it again.
                                        </p>
                                        <p>
                                            The data that you enter here determines how the features in
                                            the Website will operate. The most important item being
                                            your mobile number.
                                        </p>
                                        <p>
                                            Two aspects about how the Website operates are your
                                            Member ID and Home State. The Member ID is your
                                            identity.
                                        </p>

                                        <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>About Me</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-account-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                

                                <h5><b>How is it done</b></h5>
                                <p>
                                    The data that you entered during the Registration process has been entered into your
                                    Account information. There are a few fields that remain empty, such as Gender, that you
                                    need to complete. Enter the remaining data and Save.
                                </p>
                                    <p>
                                         All the fields are mandatory except for PayID. If you accept PayID from your clients, then you
                                    should complete the data for PayID. By completing this data, you can, through another
                                    location in the website, ‘Bank Account’, display your PayID data to the client. The PayID data
                                    is displayed as a summary with no other information visible to the client.
                                    </p>
                                   <p>
                                     Method of Contact by default is set to ‘Message (via Console)’. You can change or add to
                                    Method of Contact, but you must have at least one method of contact enabled.
                                   </p>
                                    
                                    <p>
                                        If, during the Registration process, you were assisted by one of our Support Agents, their
                                    details have loaded with their Agent ID. The Support Agent’s details will appear throughout
                                    the Console in different sections. If you did not Register with the assistance of a Support
                                    Agent and you would prefer to have a Support Agent,
                                    <a href="{{url('escort-dashboard/escort-agency-request')}}" class="custom_links_design"> click here</a> and
                                    a Support Agent, who is resident in your Home State, will be appointed.
                                    </p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile and Tour Options -->
                    <div class="card">
                        <div class="card-header" id="headingProfile">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseProfile"
                                    aria-expanded="false">
                                    Profile and Tour Options
                                </a>
                            </h2>
                        </div>
                        <div id="collapseProfile" class="collapse " aria-labelledby="headingProfile" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Set your preferences for how you would like certain features to
                                            operate within the Website. You can edit them any time.
                                        </p>
                                        <p>
                                            You have total flexibility across a range of features with
                                            preferences.
                                        </p>

                                        <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Profile Creator settings</li>
                                    <li>How can Viewers Contact Me</li>
                                    <li>Tour Options</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/profile-and-tour-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                

                                <h5><b>How is it done</b></h5>
                                <p>
                                    By default, many of these settings are enabled. You can change the settings or add to them.
                                    All of these settings relate to the Profile and Tour Creators.
                                </p>
                                <p class="sec-head">Profile Creator Settings</p>
                                    <p>
                                        This feature creates your Profiles for you to List (which are then displayed on the Website).
                                        The Profile Creator settings are by default enabled. If you disable these settings, you will
                                        have to enter all the data fields in the Profile Creator. We recommend you leave this setting
                                        enabled. By doing so, when you initiate the Profile Creator, all of your data from My
                                        Information and Media is automatically included in the Profile Creator leaving you only a small
                                        amount of information to complete.
                                    </p>
                                    <p class="sec-head">How can Viewers Contact Me</p>
                                   <p>
                                        These setting express on your Profile, how the Viewer can contact you and subject to your
                                        selection, the Profile is presented accordingly.
                                   </p>
                                        
                                    <p class="sec-head">Tour Options</p>
                                    <p>
                                       One of the features in the Console is the Tour Creator. The Tour Creator enables you to
                                        creator multiple Listings in multiple Locations. All of the options are by default enabled to help
                                        you create a Tour with the minimum of fuss. An important option is ‘Post a Tour Leg one day
                                        before the Arrival Date’.
                                    </p>
                                    <p>
                                        A Tour is the collective of Profiles, more than one if you want, attached to each of the
                                        Locations. There is a start date and an end date for each Location. The Profiles attached
                                        to each Location are Listed on the Website at midnight of the arrival date. So if the arrival
                                        date is the 1st December, the Profile for that Location is Listed at midnight leading into the
                                        30th November, 24 hours before you arrive at the designated Location.

                                    </p>
                                    <p>
                                        If you have this option enabled, your Profile/s for each Location will be Listed one day before
                                        your arrival date.
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
