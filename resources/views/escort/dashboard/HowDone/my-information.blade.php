@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">My Information</h1>
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
                         Use these help pages for explanations and
                        guidance on completing data and activating
                        features.
                       </li>
                        <li>Where a feature has default data, we recommend
                            you complete the default data before commencing
                            any activity with the feature.
                        </li>
                    </div>
                        <div class="doc-img">
                            <img src="{{ asset('assets/dashboard/img/my-info-scr.png') }}" alt=""
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

                    <!-- My Additional Information-->
                    <div class="card">
                        <div class="card-header" id="headingAdditional">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseAdditional"
                                    aria-expanded="false">
                                    My Additional Information
                                </a>
                            </h2>
                        </div>
                        <div id="collapseAdditional" class="collapse" aria-labelledby="headingAdditional" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            This is very important part of your Console and should be
                                            completed before you do anything else. It will only take you a
                                            few minutes to complete, and once it is done you won’t have to
                                            do it again.
                                        </p>
                                        <p>
                                            All of the data that you create will be retained here, and where
                                            it is applicable, will be automatically loaded into a form related
                                            feature, like for example the Profile Creator.
                                        </p>
                                        <p>
                                            You can edit the data any time, including when you are working
                                            on a feature. You will even have the option to update your
                                            default data at the time you make a change to data within a
                                            feature.
                                        </p>

                                         <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>About Me</li>
                                    <li>Statistics</li>
                                    <li>Covid 19</li>
                                    <li>Stage Names</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-additional-info-scr-2.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                               

                                <h5><b>How is it done</b></h5>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                Some of the data settings are mandatory, and designated with a ‘<span style="color:#ff3c5f;">*</span>’. If you do not complete
                                                the mandatory sections, you will not be able to save your data.
                                            </p>
                                            <p>
                                                Complete the fields for those you wish to be displayed on your Profile. Any fields not
                                                completed will simply appear blank on your Profile. Remember, the more information you
                                                provide, the more complete your Profile will appear and the better informed the Viewer will be
                                                when they look at your Profile.
                                            </p>
                                            <p>
                                                Be as accurate as you can with the information. Try not to leave out critical information like
                                                your height, hair colour and Body type. Viewers are looking for honesty and integrity when
                                                searching for a companion.
                                            </p>
                                            
                                            <p>
                                               Whatever your selections, they become your default settings. You can edit them any time
                                                including when you are in the Profile Creator. If you do not save any changes in the Profile
                                                Creator, your default settings will remain unchanged, but the setting you have made in the
                                                Profile Creator will be applied to that Profile.


                                            </p>
                                        </div>
                                    </div>
                                        
                            </div>
                        </div>
                    </div>

                    <!-- My Available Times -->
                    <div class="card">
                        <div class="card-header" id="headingAvailable">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseAvailable"
                                    aria-expanded="false">
                                    My Available Times
                                </a>
                            </h2>
                        </div>
                        <div id="collapseAvailable" class="collapse" aria-labelledby="headingAvailable" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Set the times you will be available to your clients here. You can
                                            edit them any time, including when you are creating a Profile.
                                        </p>
                                        <p>
                                            You have total flexibility across each day as to how you express
                                            your availability.
                                        </p>
                                         <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Calendar week</li>
                                    <li>Flexible options</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-availability-scr-2.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                               

                                <h5><b>How is it done</b></h5>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                You can select a start and finish time, or, if you prefer, an open statement about your
                                                availability, like for example ‘Available 24 hours’. Each day has all the options available,
                                                including ‘Unavailable’.
                                            </p>
                                            <p>
                                                Once you have set up your times and availability, they will become your default for any Profile
                                                you create. You can edit them any time including when you are in the Profile Creator. If you
                                                do not save any changes in the Profile Creator, your default settings will remain unchanged,
                                                but the setting you have made in the Profile Creator will be applied to that Profile.


                                            </p>
                                        </div>
                                    </div>
                                        
                            </div>
                        </div>
                    </div>
                   
                     <!-- My Playmates-->
                    <div class="card">
                        <div class="card-header" id="headingPlaymates">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapsePlaymates"
                                    aria-expanded="false">
                                    My Playmates
                                </a>
                            </h2>
                        </div>
                        <div id="collapsePlaymates" class="collapse" aria-labelledby="headingPlaymates" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            List your Playmates across Australia and allocate them to
                                            Locations. Have as many as you want. When you include a
                                            Playmate or Playmates in a Profile, the Viewer understands
                                            that you and the Playmate are available together.
                                        </p>
                                        <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Enable and disable the feature</li>
                                    <li>Allocate Playmates according to the Location</li>
                                    <li>Attach as many as you like to a Profile</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-playmates-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                

                                <h5><b>How is it done</b></h5>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                You must enable ‘I am available as a Playmate’ for this feature to be available. Inform the
                                                Escort who has agreed to be the Playmate to also enable the feature. Once that is done,
                                                inform the Escort of your Membership ID, and ask the Escort for their Membership ID. Once
                                                you have the Escort’s Membership ID, search it and the Escort’s details will appear. Save as
                                                a Playmate. Repeat the process for as many Escorts you want as Playmates, across as
                                                many Locations as you want.
                                            </p>
                                            <p>
                                                The Website will automatically allocate the Location to the Escort (geolocation in the
                                                background). As the Escort travels, the Location will update.
                                            </p>
                                            <p>
                                                When you create a Profile and you go to attach a Playmate, only Playmates in the same
                                                Location will be available from your list to attach to the Profile. If the Escort leaves the
                                                Location, while the Profile is Listed, the Playmate will automatically be removed from the
                                                Profile, and you will be notified of the change. You can edit the Profile to attach another
                                                Playmate if you have one available in the Location.
                                            </p>
                                            
                                            <p>
                                               When you create the Profile, you can select more than one Playmate for that Profile. Only
                                                Playmates nominated in the same Location can be added to a Profile nominated for the
                                                Location.


                                            </p>
                                            <p>
                                                You can edit your Listed Profile any time including when you are in the Profile Creator.
                                            </p>
                                        </div>
                                    </div>
                                        
                            </div>
                        </div>
                    </div>


                    <!-- My Rates-->
                    <div class="card">
                        <div class="card-header" id="headingRates">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseRates"
                                    aria-expanded="false">
                                    My Rates
                                </a>
                            </h2>
                        </div>
                        <div id="collapseRates" class="collapse" aria-labelledby="headingRates" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Set up your default Rates by service type and time allotment.
                                            You can edit them any time, including when you are creating a
                                            Profile.
                                        </p>
                                        <p>
                                            Any time slot you leave blank will appear as ‘<span style="color:#ff3c5f;"> NA </span>’ on your
                                            Profile, meaning Not Available.
                                        </p>

                                        <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Massage</li>
                                    <li>Incall</li>
                                    <li>Outcall</li>
                                </ul>

                                
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/rate-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                <h5><b>How is it done</b></h5>
                                            <p>
                                                Perhaps one of the easiest sections to do, simply insert your rate into the appropriate time slot
                                                and Save. You can also use the up and down buttons within each field to adjust the rate by
                                                increments of $10.00.

                                            </p>
                                            <p>Whatever your selections, they become your default settings. You can edit them any time
                                                including when you are in the Profile Creator.
                                            </p>
                                        
                            </div>
                        </div>
                    </div>

                    <!-- My Services (Tags) -->
                    <div class="card">
                        <div class="card-header" id="headingServices">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseServices"
                                    aria-expanded="false">
                                    My Services (Tags)
                                </a>
                            </h2>
                        </div>
                        <div id="collapseServices" class="collapse" aria-labelledby="headingServices" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Use Service Tags to express any additional services you might
                                            offer, including any additional fee.
                                        </p>
                                        <p>
                                            Service tags help Viewers when searching for a specific
                                            service. You can edit them any time, including when you are
                                            creating a Profile.
                                        </p>


                                         <h5><b>Features</b></h5>
                                        <ul class="custom-ul">
                                            <li>Fun stuff - On Viewer</li>
                                            <li>Kinky stuff - On Viewer</li>
                                            <li>Fun stuff - On Me</li>
                                        </ul>
                                        
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-service-tag-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                    
                                </div>
                                       <h5><b>How is it done</b></h5>
                                        <p>
                                                Click the drop down ‘Select’ and select the service you want to add. You can select as many
                                                as you want from any group. Before you save, add any additional charges you might want
                                                for that service. You can enter the amount directly into the field or use the up and down
                                                buttons. The value will increase or decrease, as the case may be, by increments of $10.00.
                                            </p>
                                            <p>
                                                When you have completed your selections, Save the data. Whatever your selections, they
                                                become your default settings. You can edit them any time including when you are in the
                                                Profile Creator.
                                            </p> 
                            </div>
                        </div>
                    </div>

                    <!-- My Social Media -->
                    <div class="card">
                        <div class="card-header" id="headingSocial">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseSocial"
                                    aria-expanded="false">
                                    My Social Media
                                </a>
                            </h2>
                        </div>
                        <div id="collapseSocial" class="collapse" aria-labelledby="headingSocial" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                           Set out your social media tags for Viewers to visit. Always bear
                                            in mind, if a Viewer does look at your social media, they will
                                            leave the Website.
                                        </p>
                                        <p>
                                            The feature ‘Playbox’ is managed under Media.
                                        </p>
                                        

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>X</li>
                                    <li>Facebook</li>
                                    <li>Instagram</li>
                                </ul>

                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/my-social-profile-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>
                                <h5><b>How is it done</b></h5>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                Enter your social media platform address in the field and Save. When you have an active
                                                social media address, the social media icon will appear on your Listed profile/s with the
                                                address embedded into it. If a Viewer clicks the icon, your social media platform will open in
                                                a separate tab.
                                            </p>
                                            <p>
                                                What ever your selections, they become your default settings. You can edit them any time
                                                including when you are in the Profile Creator.
                                            </p>
                                        </div>
                                    </div>
                                        
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
