@extends('layouts.center')
@section('style')
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="custom-heading-wrapper col-lg-12">
            <h1 class="h1">Edit Our Account</h1>
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
                    <div class="card-header" id="AboutUs">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew"
                                aria-expanded="false">
                                About Us
                            </a>
                        </h2>
                    </div>
                    <div id="collapseNew" class="collapse" aria-labelledby="AboutUs" data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <p>
                                        This is the most important part of your
                                        Console and before you can undertake any
                                        activity in the Website, you must complete
                                        this section. It will only take you a moment to
                                        complete, and once it is done you won’t have
                                        to do it again.
                                    </p>
                                    <p>
                                        The data that you enter here determines how the features in the Website will operate. The
                                        most important item being your mobile number.
                                    </p>
                                    <p>
                                        Two aspects about how the Website operates are your Member ID and your Home State.
                                        The Member ID is your identity.
                                    </p>

                                    <h5><b>Features</b></h5>
                                    <ul class="custom-ul">
                                        <li>About Us</li>
                                        <li>Social Media Content</li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/our-account.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>



                            <h5><b>How is it done - About Us</b></h5>
                            <p>
                                The data that you entered during the Registration process has been entered into your
                                Account information. There are a few fields that remain empty, such as your business
                                address, that you need to complete. Enter the remaining data and Save.
                            </p>
                            <p>
                                All the fields are mandatory except for PayID.
                                If you accept PayID from your clients, then
                                you should complete the data for PayID. By
                                completing this data, you can, through
                                another location in the website, ‘Bank
                                Account’, display your PayID data to the
                                client if you need to. The PayID data is
                                displayed as a summary with no other
                                information visible to the client. This is a
                                convenient way to convey your information to
                                the client.
                            </p>
                            <p>
                                Method of Contact by default is set to ‘Text’.
                                You can change or add to Method of
                                Contact, but you must have at least one method of contact enabled.
                            </p>
                            <p>
                                If, during the Registration process, you were assisted by one of our Support Agents, their
                                details have loaded with their Agent ID. The Support Agent’s details will appear throughout
                                the Console in different sections. If you did not Register with the assistance of a Support
                                Agent and you would prefer to have a Support Agent, click here [link to Request Agent] and
                                a Support Agent, who is resident in your Home State, will be appointed and will contact you.
                            </p>

                            <h5><b>Social Media Consent</b></h5>
                            <p>
                                E4U maintains a number of social media accounts across a range of platforms. The main
                                purpose of those accounts is to promote the Website. Part of how we do that is by promoting
                                Advertisers and their Profiles. For us to do that we require your consent. If you would like to
                                be included in any promotion we undertake in a social media platform, then select ‘Yes’.
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
                    <div id="collapseProfile" class="collapse " aria-labelledby="headingProfile"
                        data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <p>
                                        The Console enables you to totally manage
                                        how your communications are undertaken
                                        with Viewers. You can also manage how
                                        your Profiles are created.
                                    </p>
                                    <p>
                                        There are default setting which can be
                                        altered anytime.
                                    </p>

                                    <h5><b>Features</b></h5>
                                    <ul class="custom-ul">
                                        <li>Profile Creator settings</li>
                                        <li>How can Viewers contact us</li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/mc-profile-and-contact.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>



                            <h5><b>How is it done - Profile Contact Options</b></h5>
                            <p>
                                Select the options you want for how your
                                Profiles are created. There are multiple
                                options. The default position is for your
                                Profile Information to be included in the
                                Profile Creator.
                            </p>
                            <p>
                                Select also how you want Viewers (your potential clients) to communicate with you. There
                                are multiple options include Messaging. The default position is for Viewers to call you.
                            </p>
                            <p>
                                After you have made your selections, click the save button.
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
@endpush