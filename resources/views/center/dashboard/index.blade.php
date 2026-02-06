@extends('layouts.center')
@section('content')
<style>
    #WelcomeMassagePopup li {
        padding-left: 20px;
    }

    #WelcomeMassagePopup .modal-dialog {
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
        <x-global.notification-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" type="success" />
        @endif

        <div class="col-lg-12">
            <div class="alert text-center text-white bg-second" role="alert" id="notification-bar" style="display: none;">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Dashboard</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                        <li>Click the card to view information.</li>
                        <li>
                            Some features can be changed here as well as from the relevant subject page. Where
                            you make a change, the relevant subject page will be updated.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm mt-0">
                <a href="{{ route('center.dashboard.centre-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/centre-statistics.png') }}"
                            class="my-svg-icons" alt="Centre Statistics">
                    </div>
                    <h2>
                        Centre Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm mt-0">
                <a href="{{ route('center.dashboard.legbox-viewer') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/legbox-viewers.png') }}"
                            class="my-svg-icons" alt=" Legbox Viewers">
                    </div>
                    <h2>
                        Legbox Viewers
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm mt-0">
                <a href="{{ route('center.dashboard.our-spend') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/our-spend.png') }}" class="my-svg-icons"
                            alt="My Spend">
                    </div>
                    <h2>
                        Our Spend
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('center.dashboard.our-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/our-statistics.png') }}"
                            class="my-svg-icons" alt="Our Statistics">
                    </div>
                    <h2>
                        Our Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('center.dashboard.task-list') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/task-list.png') }}" class="my-svg-icons"
                            alt="Task List">
                    </div>
                    <h2>
                        Task List
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('center.dashboard.manage-masseurs') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/manage-masseurs.png') }}"
                            class="my-svg-icons" alt="Tour Schedule">
                    </div>
                    <h2>
                        Manage Masseurs
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('cen.archive-view-photos') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/manage-media.png') }}"
                            alt="Manage Media">
                    </div>
                    <h2>
                        Manage Media
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('center.dashboard.masseurs-statistics') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/masseurs-statistics.png') }}"
                            alt="Masseurs Statistics">
                    </div>
                    <h2>
                        Masseurs Statistics
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}

        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('center.logs-and-status') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/center/logs-and-status.png') }}"
                            alt="Logs & Status">
                    </div>
                    <h2>
                        Logs & Status
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}


        <!-- ########## Customise Dashboard ################ -->
        <?php
        $viewers = config('constants.dashboard_viewer.center');
        if (!empty($viewers)) {
            $my_view = isset($viewer_array->my_view) ? $viewer_array->my_view : [];
            foreach ($viewers as $view) :
                $checked = (isset($my_view[$view['key']]) && $my_view[$view['key']]) ? true : false;
                if (!$checked)
                    continue;
        ?>
                <div class="col-lg-4 box-wrapper">
                    <div class="my-custom-box shadow-sm">
                        <a href="{{ url($view['link']) }}">
                            <div class="box-icon">
                                <img src="{{ asset('assets/dashboard/img/' . $view['icon'] . '') }}" class="my-svg-icons"
                                    alt="{{ $view['name'] }}">
                            </div>
                            <h2>
                                {{ $view['name'] }}
                            </h2>
                        </a>

                    </div>
                </div>

        <?php
            endforeach;
        }
        ?>
        <!-- ########## End Customise Dashboard ################ -->





    </div>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="d-flex align-items-center justify-content-end custom-dash-btn">
                <a href="{{ route('center.dashboard.customise-dashboard') }}">Customise Dashboard <i
                        class="fas fa-cog "></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row agent-dash d-none">
        <div class="col-lg-8 pr-2">
            <div class="sec-one">
                <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card static-sec">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Profile Views Today</div>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                                    </div>
                                    <div class="col-auto mt-3">
                                        <img src="{{ asset('assets/app/img/account-multiple-0.png') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                    <div class="col-md-3 pl-0">
                        <div class="card static-sec-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Media Views Today</div>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                    </div>
                                    <div class="col-auto mt-3">
                                        <img src="{{ asset('assets/app/img/account-multiple-00.png') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                    <div class="col-md-3 pl-0">
                        <div class="card static-sec">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Recommendations This Week
                                        </div>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                                    </div>
                                    <div class="col-auto mt-3">
                                        <img src="{{ asset('assets/app/img/account-multiple-000.png') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                    <div class="col-md-3 pl-0">
                        <div class="card static-sec-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Reviews Posted This Week
                                        </div>
                                        <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                    </div>
                                    <div class="col-auto mt-3">
                                        <img src="{{ asset('assets/app/img/account-multiple-0000.png') }}">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 pl-2">
            <div class="sec-one pb-4">
                <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Income</h2>
                <div class="row pb-1">
                    <div class="col-md-6 pr-0">
                        <div class="card">
                            <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Week to Date</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                                    </div>
                                    <div class="col-6">
                                        <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold mb-1 text-muted">Month to Date</div>
                                        <div class="h6 mb-0 font-weight-bold text-gray-800">$ 3588.00</div>
                                    </div>
                                    <div class="col-6">
                                        <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modal.console-expiry-password')

@endsection
<div class="modal fade upload-modal" id="WelcomeMassagePopup" tabindex="-1" role="dialog"
    aria-labelledby="RegisterMassageLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->


            <div class="modal-header gap-20">
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
                                <a href="#" class="accordion-title">
                                    Notes
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <ol>
                                        <li>You can update your business information any time by either going to My Account and
                                            making your changes, or by updating your information, where it applies, in the Profile
                                            Creator. When you update your business information in the Profile Creator, you will
                                            have the option to update your Account Information or not.</li>
                                        <li>Where you alter business information in the Profile Creator and you opt not to update
                                            your Account, the information you inserted into the Profile Creator, and which is different
                                            to your Account, will be saved to that Profile only.</li>
                                        <li>Before you can add a new Masseur to your Profile, you must first add them to your
                                            Masseur list together with the personal information and photos.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table>

                            <tr>
                                <td style="padding: 30px; text-align: justify;">
                                    <h4>Hello {{auth()->user()->name}},</h4>
                                    <p>
                                        Thank you for selecting E4U to advertise your business. The team at E4U is here to help
                                        you. Here is some important information you need to know:
                                    </p>
                                    <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Before you can advertise on our website you need to complete some more of your
                                            details, as a once off, which will help you create and manage your Profile and Masseur
                                            Profiles.</br> These include :
                                            <ul
                                                style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                <li>Completing your business information, such as About Us.</li>
                                                <li>Setting your Notifications & Features.</li>
                                                <li>Uploading and verifying your Media, such as photos and video, and selecting
                                                    which uploads will act as your default Media.</li>
                                                <li>Uploading the Masseur’s media.</li>
                                            </ul>
                                            If you forget to complete any of the above, you can edit your account anytime, or in
                                            some instances, you will be asked if you want to update your Account when you make
                                            a change (Profile Creator).
                                        </li>


                                        <li>Our support staff are available to help you between 8:00am and 6:00pm WST Monday
                                            to Friday. You can email us, text us, call us, or log a Support Ticket (our preference).</li>
                                        <li>Support Agents are available to assist you with any queries you may have about the
                                            website and services. You can request to have a Support Agent assigned to you any
                                            time by following the link.</li>
                                        <li>Your Member ID is: {{auth()->user()->member_id}}, which you will need when
                                            communicating with us or your Support Agent (if you have appointed one). We use your
                                            Member ID for all communications across the website (hashtags are not used in this
                                            website).</li>
                                        <li>From time to time we will come back to you and remind you of any important
                                            information you have not completed.</li>
                                    </ol>

                                    <form action="">

                                        <input type="checkbox" name="registration" id="goToAboutMe">
                                        <label for="goToAboutMe">Do you want to complete your Registration now? (Recommended, only takes a few
                                            minutes)</label>
                                    </form>

                                    <h4 style="margin-top: 25px;">Heads Up!</h4>
                                    <p>
                                        We have designed a unique Profile creator that enables you to complete many functions to
                                        make your experience a pleasant and enjoyable one. Some of those features include:
                                    </p>
                                    <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Pre-loaded data when creating a Profile</li>
                                        <li>BRB</li>
                                        <li>Suspend Listed Profile</li>
                                        <li>Extend Listing</li>
                                        <li>Bump Up your Listing</li>

                                    </ul>
                                    <p>You can create as many Profiles as you want, especially if you have more than one Massage
                                        Centre. You can do that by duplicating Profiles. Create the first one, and then duplicate it
                                        for as many times as you want.</p>


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
<script type="text/javascript" src="{{asset('assets/plugins/ajax/libs/jquery/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
        @if(session('show_welcome_popup'))
        $('#WelcomeMassagePopup').modal('show');
        $('#content-wrapper').addClass('blurred');
        @endif

        $('.accordion-container .set > .accordion-title').on('click', function(e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next('.content').slideUp(200);
                $(this).find('i')
                    .removeClass('fa-angle-up')
                    .addClass('fa-angle-down');
            } else {
                $('.accordion-container .set > a').removeClass('active');
                $('.accordion-container .content').slideUp(200);
                $('.accordion-container .set > a i')
                    .removeClass('fa-angle-up')
                    .addClass('fa-angle-down');

                $(this).addClass('active');
                $(this).next('.content').slideDown(200);
                $(this).find('i')
                    .removeClass('fa-angle-down')
                    .addClass('fa-angle-up');
            }
        });

        $('#WelcomeMassagePopup').on('hidden.bs.modal', function() {
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
                        window.location.href = '{{route("center.account.edit")}}';
                    }
                }
            });

        });
    });
</script>