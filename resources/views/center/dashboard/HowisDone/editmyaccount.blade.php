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
                <div class="card common-card">
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
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/about-us.png') }}" alt="about-us"
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
                            <div class="row">
                                <div class="col-lg-7">
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
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/our-account.png') }}" alt=""
                                            class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>
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
                <div class="card common-card">
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
                            <div class="row">
                                <div class="col-lg-7">
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
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/mc-profile-and-contact.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Other Centres -->
                <div class="card common-card">
                    <div class="card-header" id="Others">
                        <h2 class="mb-0">
                            <a class="card-link collapsed" data-toggle="collapse" href="#collapseOthers"
                                aria-expanded="false">
                                Other Centres
                            </a>
                        </h2>
                    </div>
                    <div id="collapseOthers" class="collapse " aria-labelledby="Others"
                        data-parent="#accordion">
                        <div class="card-body">

                            <h5><b>Overview</b></h5>
                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <p>
                                        The Massage Centre Console is design to
                                        accommodate those Members who have
                                        multiple Centres throughout their Location (in
                                        interstate should that be the case). The
                                        primary Massage Centre is identified and the
                                        Account is established. From there, the
                                        primary Account holder can add other
                                        Centres to the Membership.
                                    </p>
                                    <p>
                                        The primary Account holder can then manage all of the Centres in their group through the one
                                        log on. This enables the owner of the Centres to optimise their resources for their advertising
                                        needs by having an administration employee, or someone in the primary Centre, manage all
                                        the Centres.
                                    </p>

                                    <h5><b>Features</b></h5>
                                    <ul class="custom-ul">
                                        <li>Adding a Centre</li>
                                        <li>Editing a Centre</li>
                                        <li>Suspending a Centre</li>
                                        <li>Granting view only access to the Associated Centre</li>
                                        <li>Switching to an Associated Centre</li>
                                        <li>Granting view only access to the Associated Centre</li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/others-centre.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>



                            <h5><b>How is it done - Other Centres</b></h5>
                            <p>To create and manage your Centres, you will need to follow these steps.</p>
                            <p class="sec-head">Adding a Centre</p>
                            <p>To add an Associated Centre click the Add Centre button. A pop up will appear. The
                                information being sort is similar to what you would have completed for the primary Account.
                                That information includes:</p>
                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <ul class="custom-ul">
                                        <li>
                                            <u>Display Name.</u>
                                            <p> The name of the business that the Centre trades as. This is what
                                                will be displayed in any Profile created for this Centre.</p>
                                        </li>
                                        <li>
                                            <u>Entity name.</u>
                                            <p> The legal entity that owns the business.</p>
                                        </li>
                                        <li>
                                            <u>Email.</u>
                                            <p> The email address attached to the business, if one exists. If it
                                                does not exist, we recommend you put one in place. (E4U can
                                                assist you in organising an email account).</p>
                                        </li>
                                        <li>
                                            <u>Address.</u>
                                            <p> The address of the
                                                business.</p>
                                        </li>
                                        <li>
                                            <u>Business No.</u>
                                            <p> The land line number for the
                                                business, if there is one.</p>
                                        </li>
                                        <li>
                                            <u>Mobile No.</u>
                                            <p> The mobile number for the
                                                business, if there is one (our
                                                preference).</p>
                                        </li>
                                        <li>
                                            <u>Point of Contact.</u>
                                            <p> The name of the person
                                                who would ordinarily be
                                                managing the Centre.</p>
                                        </li>
                                        <li>
                                            <u>Method of Contact.</u>
                                            <p> Select from the options.
                                                You can have multiple methods.</p>
                                        </li>
                                        <li>
                                            <u>Password.</u>
                                            <p> Create a password for the Associated Centre to logon to their
                                                Console, if access has been granted. The User name
                                                for logon will be the Mobile No for the Centre.</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/add-centre.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>
                                        When you have completed all of the fields, click the Add
                                        button. The Associated Centre will be created and
                                        listed in the table.
                                    </p>
                                    <p>
                                        From within the report list, you can apply a number of actions to your Associated Centres.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/others-centre.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>
                            <p class="sec-head">Editing a Centre</p>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>
                                        To edit a Centre, from Action, select Edit Centre. All of
                                        the Associate Centre's details will appear in a pop up.
                                        You can edit any field that is not restricted. Once you
                                        have made your changes, click the Update button.
                                    </p>
                                    <p>
                                        If you grant access to the Associated Centre, make sure
                                        you complete the Point of Contact details, together with
                                        a password.
                                    </p>
                                    <p>
                                        Any Point of Contact that is granted access to the
                                        Associated Centre is restricted to view only access and
                                        can not perform any activity in the Console, such as
                                        Profile and Masseur management. That can only be
                                        undertaken by the primary Centre.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/edit-centre.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>

                            <p class="sec-head">Suspend Centre</p>
                            <p>
                                to suspend all aspects of the Associated Centre, click Action and select Suspend Centre.
                                Once competed, any Listed Profile will be suspended and any access granted to the Console
                                will also be suspended.
                            </p>
                            <p>
                                The Associated Centre will remain in your list of Associated Centred, in a Suspended status.
                                You can Activate the suspended Associated Centre any tine by going to Action and clicking
                                Activate.
                            </p>
                            <p class="sec-head">Switch to</p>
                            <p>Use this Action to switch to the Console for the Associated Centre. From there, you can
                                perform any action, such as Profile creation, Media management, and management of your
                                Masseurs. Undertake all of these activities in the same manner as set out here.</p>

                            <p class="sec-head">View Summary</p>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>
                                        Use this Action to view a summary of the Associated
                                        Centre.
                                    </p>
                                    <p>
                                        You can not perform any activity from this page, it is
                                        only a summary of the Associated centre.
                                    </p>
                                    <p>
                                        You can print the summary by clicking the Print button.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/view-summary.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>
                            </div>


                            <p class="sec-head">Creating Profiles</p>
                            <p>Profiles are created in the same manner as you create them as the primary Centre. To
                                achieve that you have to Switch to the Associated Centre first. Select from the Action options
                                for the Associated Centre you wish to create a Profile for the Switch to option.</p>
                            <p>The Console will load as the Associated Centre. Proceed to create your Profile. (See <a href="{{ route('center.profile') }}" class="custom_links_design">New
                                Profile</a>). Before you can create a Profile, you must have completed:</p>
                            <ul class="custom-ul">
                                <li>My Account information</li>
                                <li>Profile Information (same process as for the primary Centre)</li>
                                <li>Media upload (same process as for the primary Centre); and</li>
                                <li>Created at least one Masseur profile including the Masseurs media</li>
                            </ul>
                            <p>
                                If any of these functions are not completed, you will be reminded with a pop up.
                            </p>
                            <p class="sec-head">Creating Masseurs</p>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>
                                        You create Masseur Profiles in the same manner as you
                                        create them as the primary Centre. To achieve that you
                                        have to Switch to the Associated Centre first. Select
                                        from the Action options for the Associated Centre you
                                        wish to create a Masseur Profile for the Switch to
                                        option.
                                    </p>
                                    <p>
                                        The Console will load as the Associated Centre.
                                        Proceed to create your Masseur Profile. (See <a  href="{{ route('center.create-new-masseur') }}" class="custom_links_design">New</a>).
                                        Before you can create a Profile, you must have
                                        completed:
                                    </p>
                                    <ul class="custom-ul">
                                        <li>My Account information</li>
                                        <li>Profile Information (in particular the Open Times and Rates)</li>
                                    </ul>
                                    <p>
                                        If any of these functions are not completed, you will be
                                        reminded with a pop up.
                                    </p>
                                    <p>Complete all of the information about the Masseur in the
                                        following sections of the create page:</p>
                                    <ul class="custom-ul">
                                        <li>About the Masseur</li>
                                        <li>Media</li>
                                        <li>My Availability</li>
                                        <li>My Services</li>
                                    </ul>
                                     <p>Once yo have completed the information, click the Create Masseur button and the Masseur
                                will be saved. You can view and manage the Massage under Manage. Remember, to create
                                a Profile for the Centre, you must have created at least one Masseur Profile.
                            </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/create-masseurs.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>

                            </div>
                           
                            <p class="sec-head">Managing Masseurs</p>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>
                                        Once you have created a Masseur Profile,
                                        and you can create as many as you want to,
                                        their Profile is listed under Manage.
                                    </p>
                                    <p>

                                        To edit any Masseur Profile, go to the Action
                                        list and select Edit Profile. The Masseurs full
                                        Profile will appear for you to edit any part of
                                        the Profile.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/manage-masseurs.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>

                            </div>
                            <p>
                                Important elements of the Masseur Profile to remember include:
                            </p>

                            <div class="row my-4">
                                <div class="col-lg-7">
                                    <ul class="custom-ul">
                                        <li>Services options are limited to what the Massage
                                            Centre sets in its Profile Information.</li>
                                        <li>Media Verification rules are the same as for the
                                            Massage Centre, but operate independently of the
                                            Massage Centre. For example, if the Massage
                                            Centre has Verified Media and the Masseur does
                                            not, then the Massage Centre Profile will display
                                            Verified Media for the Massage Centre, and
                                            Unverified Media for the Masseur. Each Masseurs
                                            Media verification operates independently from
                                            each other.</li>
                                        <li>My Availability is subject to the Massage Centres
                                            opening times.</li>
                                        <li>My Services is subject to the Massage Centres
                                            listed Services. The Masseur can only select from
                                            those services which are listed in the Massage
                                            Centre’s list of services.</li>
                                    </ul>
                                    <p>
                                        You can create as many Masseur Profiles as you want.
                                        Typically, Masseurs come and go or rotate between
                                        Massage centres. Any Masseur Profile that you select
                                        as a default listing on your Massage Centre Profile will
                                        remain there until you remove or replace the it.</p>
                                    <p>
                                        If you are operating Other Centres, you can create the same Masseur Profile across your
                                        Other Centres, however, you can not list a Masseur Profile on two or more Massage Centre
                                        Profiles (across your Other Centres that is), at the same time. You must deactivate the
                                        Masseur for the Massage Centres the Masseur is not working in. Go the Action list and select
                                        Deactivate, or Remove Default Listing. Deactivate usually applies when the Masseur no
                                        longer works for the Massage centre. When a Masseur is Deactivated, to reactivate the
                                        Masseur go to Action list and select Activate. </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/update-masseurs.png') }}"
                                            alt="" class="w-100 rounded-sm">
                                    </div>
                                </div>

                            </div>
                            <p class="sec-head">
                                Managing Media
                            </p>
                            <p>
                                Like your primary Account, any Associated Account has Media for both the Centre and
                                Masseurs. Switch to the Secondary Account, and manage your Media in the manner as your
                                primary Account.</p>
                            <p class="sec-head">Granting Access</p>
                            <div class="row my-4">
                                <div class="col-lg-7">

                                    <p>

                                        You can grant access to any of your Secondary
                                        Accounts. Granting access enables a member of the
                                        staff located at the Secondary Centre to log onto the
                                        Console for that Secondary Centre.
                                    </p>
                                    <p>
                                        To grant the access, you must have completed the
                                        Secondary Centre’s details, including the Point of
                                        Contact, the Centre’s email address and a password. If
                                        that information is complete, then select Yes for Access
                                        Granted.</p>
                                    <p>
                                        When your staff member at the Secondary centre logs
                                        on, they will have full access to the Console, but limited
                                        to View only. They will not be able to edit any settings or
                                        Profiles, or create any new Profiles or Masseurs.
                                    </p>
                                </div>
                                <div class="col-lg-5">
                                    <div class="doc-img">
                                        <img src="{{ asset('assets/dashboard/img/how-is-done/edit-centre.png') }}"
                                            alt="" class="w-100 rounded-sm">
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
@endsection
@push('script')
@endpush