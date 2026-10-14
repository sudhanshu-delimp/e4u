@extends('layouts.center')
@section('style')
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">Profile Information</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 ">
            <div class="card collapse  mb-4" id="notes">
                <div class="card-body">
                    <h3 class="NotesHeader"><b>Notes:</b></h3>
                    <ol>
                        <li>Use these help pages for explanations and guidance on completing data and activating
                            features.</li>
                        <li>Where a feature has default data, we recommend you complete the default data
                            before commencing any activity with the feature.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="row how-it-done">
        <div class="col-md-12 mt-2 mb-5">
            <div id="accordion" class="myacording-design">

                <!-- About us -->
                <div class="card common-card">
                    <div class="card-header" id="AboutUs">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew"
                                aria-expanded="false">
                                Additional Information About Us
                            </a>
                        </h2>
                    </div>
                    <div id="collapseNew" class="collapse" aria-labelledby="AboutUs" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <p>
                                        This is very important part of your Console
                                        and should be completed before you do
                                        anything else. It will only take you a few
                                        minutes to complete, and once it is done you
                                        won’t have to do it again.
                                    </p>
                                    <p>
                                        All of the data that you create will be retained
                                        here, and where it is applicable, will be automatically loaded into a form related feature, like
                                        for example the Profile Creator.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/additional-info.png') }}" alt="about-us"
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>


                            <p>
                                When you create a Profile, you can publish the name of your business along with other
                                mandatory information, like the address, entry type etc. By having completed this information
                                Users, when they view your Profile, will not only see an accurate summary regarding your
                                business and the premises, Google Maps will pinpoint your location for the User to get
                                directions directly from the Profile.
                            </p>
                            <p>
                                You can edit the data any time, including when you are working on a feature. You will even
                                have the option to update your default data at the time you make a change to data within a
                                feature.
                            </p>

                            <p>
                                So, by completing the details about your business, you will gain a clear advantage over other
                                platforms.
                            </p>
                        </div>
                    </div>
                </div>

                <!--   Our Open Times -->
                <div class="card common-card">
                    <div class="card-header" id="headingOpentimes">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#ourOpentimes"
                                aria-expanded="false">
                                Our Open Times
                            </a>
                        </h2>
                    </div>
                    <div id="ourOpentimes" class="collapse" aria-labelledby="headingOpentimes" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <p>
                                Set the times your business will be open and closed to your clients here. You can edit them
                                any time, including when you are creating a Profile.
                            </p>
                            <p>
                                You have total flexibility across each day as to how you express your business hours.
                            </p>
                            <h5><b>Features</b></h5>
                            <ul class="custom-ul">
                                <li>Calendar week</li>
                                <li>Flexible options</li>
                            </ul>

                            <h5><b>How is it done - Open Times</b></h5>

                            <div class="row">
                                <div class="col-lg-7">
                                    <p>
                                        You can select an open and close time, or, if
                                        you prefer, an open statement about your
                                        trading hours, like for example ‘Till late’. Each
                                        day has all the options available, including
                                        ‘Closed’ (for those public holidays).
                                    </p>
                                    <p>
                                        Once you have set up your trading hours,
                                        they will become your default for any Profile
                                        you create. You can edit them any time
                                        including when you are in the Profile Creator. If you do not save any changes in the Profile
                                        Creator, your default settings will remain unchanged, but the setting you have made in the
                                        Profile Creator will be applied to that Profile.
                                    </p>
                                    <p>
                                        A special note, when you set your open and close times, any Masseur Profile you create,
                                        when selecting the Masseurs availability, you can only select times equal to or inside of the
                                        open and close time in your settings.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/our-open-times.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--    Our Rates -->
                <div class="card common-card">
                    <div class="card-header" id="headingRates">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#ourRates"
                                aria-expanded="false">
                                Our Rates
                            </a>
                        </h2>
                    </div>
                    <div id="ourRates" class="collapse" aria-labelledby="headingRates" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <p>
                                Set up your default Rates by service type and time allotment. You can edit them any time,
                                including when you are creating a Profile.
                            </p>
                            <p>
                                Any time slot you leave blank will appear as <span style="color: #ff3c5f;">‘N/A’</span> on your Profile, meaning Not Available.
                            </p>
                            <h5><b>Features</b></h5>
                            <ul class="custom-ul">
                                <li>Massage</li>
                                <li>Massage with 2 hands</li>
                                <li>Massage with 4 hands</li>
                            </ul>

                            <h5><b>How is it done - Rates</b></h5>

                            <div class="row">
                                <div class="col-lg-7">
                                    <p>
                                        Perhaps one of the easiest sections to do,
                                        simply insert your rate into the appropriate
                                        service slot and Save. You can also use the
                                        up and down buttons within each field to
                                        adjust the Rate by increments of $10.00.
                                    </p>
                                    <p>
                                        A service slot is the level of service provided
                                        and by the number of Masseurs. Your
                                        settings will override the Masseurs settings
                                        that a Masseur will display in their Profile.
                                        Icons representing these service slots are
                                        also displayed on your Profile as well as on the Masseur’s Profile. The options include:
                                    </p>
                                    <ul class="custom-ul">
                                        <li><u>Massage.</u>
                                            <p>Massage only by the Masseur.</p>
                                        </li>
                                        <li><u>Massage + 2 hands.</u>
                                            <p>Massage together with Other Service types.</p>
                                        </li>
                                        <li><u>Massage + 4 hands.</u>
                                            <p>Massage together with Other Service types conducted by 2
                                                Masseurs.</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/our-rates.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>

                            <p>
                                Whatever your selections, they become your default settings. You can edit them any time
                                including when you are in the Profile Creator.
                            </p>
                            <p>These Rates will override any Masseur Rates where you attempt to create a rate for the
                                Masseur which is higher.</p>
                        </div>
                    </div>
                </div>


                <!--   Our Service (Tags) -->
                <div class="card common-card">
                    <div class="card-header" id="headingService">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#ourService"
                                aria-expanded="false">
                                Our Service (Tags)
                            </a>
                        </h2>
                    </div>
                    <div id="ourService" class="collapse" aria-labelledby="headingService" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <p>
                                Use Service Tags to summarise the services you might offer, including any additional fee.
                            </p>
                            <p>
                                Service tags help Viewers when searching for a specific service. You can edit them any time,
                                including when you are creating a Profile.
                            </p>
                            <h5><b>Features</b></h5>
                            <ul class="custom-ul">
                                <li>Massage services</li>
                                <li>Other services</li>
                            </ul>

                            <h5><b>How is it done - Service (Tags)</b></h5>

                            <div class="row">
                                <div class="col-lg-7">
                                    <p>
                                        We have separated your service types into
                                        you offer into two groups.
                                    </p>
                                    <p>
                                        Within each group, click the drop down
                                        ‘Select’ and select the service you want to
                                        add. You can select as many as you want for
                                        the group. Before you save, add any
                                        additional charges you might want for that
                                        service type. You can enter the amount directly into the field or use the up and down buttons.
                                        The value will increase or decrease, as the case may be, by increments of $10.00.
                                    </p>
                                    <p>
                                        You can also edit these Service Tags in the Profile Creator, and save those changes to your
                                        default settings if you want to.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/service-tags.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>

                            
                            <p>When you have completed your selections, Save the data. Whatever your selections, they
                                become your default settings. You can edit them any time including when you are in the
                                Profile Creator.</p>
                        </div>
                    </div>
                </div>



                <!--   Our Social Media-->
                <div class="card common-card">
                    <div class="card-header" id="headingSocialmedia">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#ourSocialmedia"
                                aria-expanded="false">
                                Our Social Media
                            </a>
                        </h2>
                    </div>
                    <div id="ourSocialmedia" class="collapse" aria-labelledby="headingSocialmedia" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <div class="row">
                                <div class="col-lg-7">
                                    <p>
                                        Set out your social media tags for Viewers to
                                        visit. Always bear in mind, if a Viewer does
                                        look at your social media, they will leave the
                                        Website.
                                    </p>
                                    <p>
                                        You have total flexibility across each day as to how you express your business hours.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/social-media.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>

                            <h5><b>Features</b></h5>
                            <ul class="custom-ul">
                                <li>X</li>
                                <li>Facebook</li>
                                <li>Instagram</li>
                            </ul>

                            <h5><b>How is it done - Social Media</b></h5>


                            <p>
                                Enter your social media platform address in the field and Save. When you have an active
                                social media address, the social media icon will appear on your Listed Profile with the address
                                embedded into it. If a Viewer clicks the icon, your social media platform will open in a separate
                                tab.
                            </p>
                            <p>
                                Whatever your selections, they become your default settings. You can edit them any time
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
@endsection
@push('script')
@endpush