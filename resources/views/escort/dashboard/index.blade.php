@extends('layouts.escort')
@section('content')
<style>
    #WelcomeEscortPopup li {
        padding-left: 20px;
        
    }

    #WelcomeEscortPopup .modal-dialog {
        max-width: 1000px;
    }

    .blurred {
        filter: blur(3px) !important;
        pointer-events: none;
    }
</style>
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!-- Page Heading -->
    <div class="row">
        @if($notification)
        <x-global.notification-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" type="success"
        :member="null"
         />
        @endif
        @if($expiringListings->count() > 0)
        @foreach ($expiringListings as $profile)
        <div class="col-sm-12 ">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Profile Listing #{{$profile->id}} is about to expire. <strong> <a href="{{route('escort.list','current')}}">Click here</a></strong> to extend the Listing.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Dashboard</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b></h3>
                    
                    <ol>
                        <li>Click the card to view information.</li>
                        <li>
                            Some features can be changed here as well as from the relevant subject page. Where you make a change, the relevant subject page will be updated.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- new row --}}

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.list', 'current') }}?from=dashboard">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/listed-profiles.png') }}" class="my-svg-icons" alt=" Listed Profiles">
                    </div>
                    <h2>
                        Listed Profiles
                    </h2>
                </a>

            </div>
        </div>

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.profile', ['from' => 'dashboard']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/new-profile.png') }}" class="my-svg-icons" alt="New Profile">
                    </div>
                    <h2>
                        New Profile
                    </h2>
                </a>

            </div>
        </div>

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ url('escort-dashboard/create-tour') }}?from=dashboard">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/new-tour.png') }}" class="my-svg-icons" alt="New Tour">
                    </div>
                    <h2>
                        New Tour
                    </h2>
                </a>

            </div>
        </div>

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.archive-view-photos', ['from'=>'dashbaord']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_manage-media.png') }}" class="my-svg-icons" alt="Manage Media">
                    </div>
                    <h2>
                        Manage Media
                    </h2>
                </a>

            </div>
        </div>

        {{-- end --}}





        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.task-list') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_tasklist.png') }}" class="my-svg-icons" alt="Task List">
                    </div>
                    <h2>
                        Task List
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.tour-schedule') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_tour-schedule.png') }}" class="my-svg-icons" alt="Tour Schedule">
                    </div>
                    <h2>
                        My Tour Schedule
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.my-spend') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-spend.png') }}" class="my-svg-icons" alt="My Spend">
                    </div>
                    <h2>
                        My Spend
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.my-playmates') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-playmates01.png') }}" class="my-svg-icons" alt=" My Playmates">
                    </div>
                    <h2>
                        My Playmates
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.archive-myplaybox', ['from'=>'dashboard']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_myplaybox.png') }}" class="my-svg-icons" alt="My Playbox Summary">
                    </div>
                    <h2>
                        My Playbox Summary
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.my-legbox-viewers', ['from'=>'dashboard']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_mylegbox.png') }}" class="my-svg-icons" alt="My Legbox Summary">
                    </div>
                    <h2>
                        My Legbox Summary
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <!-- <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="route('escort.dashboard.escorts-statistics')">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_escort-statistics.png') }}" class="my-svg-icons" alt="Escorts Statistics">
                    </div>
                    <h2>
                        Escort's Statistics
                    </h2>
                </a>

            </div>
        </div> -->
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.dashboard.my-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-statistics.png') }}" class="my-svg-icons" alt="My Statistics">
                    </div>
                    <h2>
                        My Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('escort.my_wallet', ['from'=>'dashboard']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/wallet.png') }}" alt="My Wallet">
                    </div>
                    <h2>
                        My Wallet
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('logs.and.status') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/agent/logs-and-statistics.png') }}" alt="Logs & Status">
                    </div>
                    <h2>
                        Activity Summary
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-3 col-sm-6 col-md-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('support-ticket.list', ['from'=>'dashboard']) }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_support-tickets.png') }}" alt=" Support Tickets">
                    </div>
                    <h2>
                        Support Tickets
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}


    </div>
</div>
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-ban">View Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="Date" class="form-control" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" class="form-control" placeholder="Date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder=" ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" placeholder=" ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder=" ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" placeholder=" " rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="new-ban-2" tabindex="-1" role="dialog" aria-labelledby="new-ban-2"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-ban-2">Reschedule Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" action="#">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="Date" class="form-control" placeholder="Date" value="19-08-2022">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" class="form-control" placeholder="Time" value="05:12">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder=" " value="Carla Brasil">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" placeholder=" " value="0987654321">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder=" "
                                    value="910 Albany Highway East Victoria Park WA 610
                           ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Comments</label>
                                <textarea class="form-control" placeholder=" " rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary shadow-none float-right">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="new-ban-3" tabindex="-1" role="dialog" aria-labelledby="new-ban-3"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-ban-3">Cancel Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" action="#">
                    <h4>Are you sure you want to cancel this Appointment?</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                                <button type="button"
                                    class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                    data-dismiss="modal" aria-label="Close">No</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade upload-modal" id="new-ban-4" tabindex="-1" role="dialog" aria-labelledby="new-ban-4"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new-ban-4">Completed Appointment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" action="#">
                    <h4>Are you sure you want to mark this Appointment as completed?</h4>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                                <button type="button"
                                    class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                    data-dismiss="modal" aria-label="Close">No</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- open tour section button -->
<div class="modal fade upload-modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="new-ban-4"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task_title">New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="task_form" action="#">
                    {{ csrf_field() }}
                    <div class="row" id="task_form_html">
                        <h4 id="task_desc">Are you sure you want to mark this Appointment as completed?</h4>
                    </div>

                    <div class="row" id="task_form_button">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1" class="ml-2 showDateLabel"
                                    style="display: none;">Date Created: {{ \Carbon\Carbon::now()->format('d-m-Y') }}.
                                </label>
                                <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0"
                                    id="save_button">Yes</button>
                                <button type="button"
                                    class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                    data-dismiss="modal" aria-label="Close" id="cancel_button">No</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@include('modal.console-expiry-password')

@endsection
@section('style')
<style>
    .toggle-task-form {
        font-size: 16px;
        /* color: #007bff; */
        display: inline-block;
        margin: 20px 0px;
    }

    .agent-tour .card {
        padding: 5px 12px !important;
    }

    .upload-modal .btn {
        padding: 7px 20px 7px 20px !important;
        background: #087132;
    }

    .page-item:hover .fa {
        color: white !important;
    }

    .page-item:hover .page-link {
        color: white;
    }
</style>
@endsection


<!-- escort welcome popup page -->
<div class="modal fade upload-modal" id="WelcomeEscortPopup"  style="display: none;" tabindex="-1" role="dialog"aria-labelledby="RegisterEscortLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->


           <div class="modal-header gap-20 modal_custom_header">
                 <h5 class="modal-title text-white"><img src="{{ asset('assets/app/img/welcome.png') }}"
                        class="custompopicon">
                    Welcome to Escorts4U!! </h5> <span>Member ID: {{auth()->user()->member_id}}</span>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 20px;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="accordion-container">
                            <div class="set">
                                <a class="">
                                    Notes
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <ol>
                                        <li>You can update your personal information any time by either going to My
                                            Account and
                                            making your changes, or by updating your information, where it applies, in
                                            the Profile
                                            Creator. When you update your personal information in the Profile Creator,
                                            you will
                                            have the option to update your Account Information or not.</li>
                                        <li>Where you alter your information in the Profile Creator and you opt not to
                                            update your
                                            Account, the information you inserted into the Profile Creator, and which is
                                            different to
                                            your Account, will be saved to that Profile only.</li>
                                        <li>Your Notifications and Features can also be changed in My Account. Please
                                            take a look
                                            as these affect the way your Console operates and how you access a number of
                                            services.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table>

                            <tr>
                                <td class="welcome_common_para">
                                    <p>Hello {{auth()->user()->name}},</p>
                                    <p>
                                        Thank you for selecting E4U to advertise your companionship. The team at E4U is
                                        here to
                                        help you. Here is some important information you need to know:
                                    </p>
                                    <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Before you can advertise on our website you need to complete some more of
                                            your
                                            details, as a once off, which will help you create and manage your Profiles
                                            and
                                            Tours. <br>These include :
                                            <ul
                                                style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                <li>Completing your personal information, such as About Me and Profile
                                                    and Tour
                                                    Options.</li>
                                                <li>Setting your Notifications & Features.</li>
                                                <li>Uploading and verifying your Media, such as photos and video, and
                                                    selecting
                                                    which uploads will act as your default Media, Banner image and Pin
                                                    Up.</li>
                                                <li>Uploading your My Playbox content, if you intend to use that
                                                    service.</li>
                                            </ul>
                                            If you forget to complete any of the above, you can edit your account
                                            anytime, or in
                                            some instances, you will be asked if you want to update your Account when
                                            you make
                                            a change (Profile Creator).
                                        </li>


                                        <li>Our support staff are available to help you between 8:00am and 6:00pm WST
                                            Monday
                                            to Friday. You can email us, text us, call us, or log a Support Ticket (our
                                            preference).</li>
                                        <li>Support Agents are available to assist you with any queries you may have
                                            about the
                                            website and services. You can request to have a Support Agent assigned to
                                            you any
                                            time by following the link.</li>
                                        <li>Please remember your Member ID: {{auth()->user()->member_id}},
                                            which you
                                            will need when communicating with us or your Support Agent, and especially
                                            when you
                                            are using the Playmates feature. We use your Member ID for all
                                            communications
                                            across the website (hashtags are not used in this website).</li>
                                        <li>From time to time we will come back to you and remind you of any important
                                            information
                                            you have not completed.</li>
                                    </ol>

                                    <h4 style="margin-top: 25px;">Heads Up!</h4>
                                    <p>
                                        We have designed a unique Profile creator that enables you to complete many
                                        functions to
                                        make your experience a pleasant and enjoyable one. Some of those features
                                        include:
                                    </p>
                                    <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Pre-loaded data when creating a Profile</li>
                                        <li>BRB</li>
                                        <li>Suspend Listed Profile</li>
                                        <li>Extend Listing</li>
                                        <li>Bump Up your Listing</li>
                                        <li>Upgrade your Profile Membership Type</li>
                                        <li>Pin Up</li>
                                    </ul>
                                    <p>You can create as many Profiles as you want. We recommend you create at least one
                                        Profile for each State in Australia you would visit. You can do that by
                                        duplicating
                                        Profiles.
                                        Create the first one, and then duplicate it for as many times as you want. By
                                        creating
                                        at least
                                        one Profile for each State, or Location as we call them, you can then create a
                                        Tour
                                        across
                                        Australia for a minimum of two Locations, but with as many Profiles in each
                                        Location as
                                        you
                                        want.</p>

                                    <form action="">

                                        <input type="checkbox" name="registration" id="goToAboutMe">
                                        <label for="goToAboutMe">Do you want to complete your Registration now?
                                            (Recommended,
                                            only takes a few minutes)</label>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer pt-0" style="justify-content: center;">
                <button type="submit" class="btn-success-modal" data-dismiss="modal">Got it</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up here  -->
<script type="text/javascript" src="{{asset('assets/plugins/ajax/libs/jquery/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
        @if(session('show_welcome_popup'))
            $('#WelcomeEscortPopup').modal('show');
            $('#content-wrapper').addClass('blurred');
        @endif
        $('.accordion-container .set > a').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next('.content').slideUp(200);
                $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
            } else {
                $('.accordion-container .set > a').removeClass('active');
                $('.accordion-container .content').slideUp(200);
                $('.accordion-container .set > a i')
                    .removeClass('fa-angle-up')
                    .addClass('fa-angle-down');

                $(this).addClass('active');
                $(this).next('.content').slideDown(200);
                $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
            }
        });

        $('#WelcomeEscortPopup').on('hidden.bs.modal', function() {
            $('#content-wrapper').removeClass('blurred');
            $.ajax({
                url: '{{route("welcome-popup-closed")}}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    let isChecked = $('#goToAboutMe').is(':checked');
                    if (isChecked) {
                        window.location.href = '{{route("escort.account.edit")}}';
                    }
                }
            });

        });
    });
</script>