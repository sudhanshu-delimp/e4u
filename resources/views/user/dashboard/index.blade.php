@extends('layouts.userDashboard')
@section('content')
<style>
    #WelcomeViewerPopup li {
        padding-left: 20px;
        font-size: clamp(14px, 4vw, 16px);
    }

    #WelcomeViewerPopup .modal-dialog {
        max-width: 1000px;
    }

    .blurred {
        filter: blur(3px) !important;
        pointer-events: none;
    }
    @media (max-width:425px){
         #WelcomeViewerPopup li {
             padding: 20px;
        }
    }
</style>
<div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
    <!--middle content start here-->

    <div class="row">
        @if ($notifications)
        @foreach ($notifications as $notification)
        <x-global.notification-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']"  type="success"
        :member="null"
         />
        @endforeach
        @endif
        {{-- Legbox Notification create by Massage center --}}
        @if($getLegBoxNotifications)
        @foreach ($getLegBoxNotifications as $getLegBoxNotification)
             <x-global.notification-alert
                :heading="$getLegBoxNotification['heading']"
                :content="$getLegBoxNotification['content'] ?? $getLegBoxNotification['template_name']"
                type="success"
                :member="$getLegBoxNotification['create_by_member_id'] ??  null"
            />
        @endforeach
        @endif
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Dashboard</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="mb-0" style="font-size: 20px;"><b>Notes:</b></p>
                    <p></p>
                    <ol>
                        <li>Use this feature to enable and disable your feature preferences.</li> 
                        <li>Please note that for an Advertiser to participate in any of these features, they must 
                            have enabled the corresponding feature in their preference settings.</li>
                        <li>Note also the default setting for 2FA authentification.</li> 
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.favorites-online') }}">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_favorites.png') }}"
                            alt="Favorites Online">
                    </div>
                    <h2>
                        Favorites Online
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.my-legbox', ['escort']) }}?from=dashboard">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_mylegbox.png') }}" alt=" My Legbox">
                    </div>
                    <h2>
                        My Legbox
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        <div class="col-lg-4 box-wrapper">
            <div class="my-custom-box shadow-sm">
                <a href="{{ route('user.punterbox.dashboard') }}?from=dashboard">
                    <div class="box-icon">
                        <img src="{{ asset('assets/dashboard/img/boxicon/icon_punterbox.png') }}" alt="Punterbox">
                    </div>
                    <h2>
                        Punterbox
                    </h2>
                </a>

            </div>
        </div>
        {{-- end --}}
        {{-- box start --}}
        {{-- <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('user.viewer-statistics') }}">
        <div class="box-icon">
            <img src="{{ asset('assets/dashboard/img/boxicon/viewer-statistics.png') }}"
                alt="Viewer Statistics">
        </div>
        <h2>
            Viewer Statistics
        </h2>
        </a>

    </div>
</div> --}}
{{-- end --}}
{{-- box start --}}
<div class="col-lg-4 box-wrapper">
    <div class="my-custom-box shadow-sm">
        <a href="{{route('user.my-statistics')}}">
            <div class="box-icon">
                <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-statistics.png') }}"
                    alt="Viewer Statistics">
            </div>
            <h2>
                My Statistics
            </h2>
        </a>

    </div>
</div>
{{-- end --}}
{{-- box start --}}
<div class="col-lg-4 box-wrapper">
    <div class="my-custom-box shadow-sm">
        <a href="{{ route('viewer.task-list') }}">
            <div class="box-icon">
                <img src="{{ asset('assets/dashboard/img/boxicon/icon_tasklist.png') }}" alt="Task List">
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
        <a href="{{ route('user.logs-and-statistics') }}">
            <div class="box-icon">
                <img src="{{ asset('assets/dashboard/img/boxicon/icon_logs-stats.png') }}" alt="Logs & Status">
            </div>
            <h2>
                Logs & Status
            </h2>
        </a>

    </div>
</div>
{{-- end --}}
{{-- box start --}}
<div class="col-lg-4 box-wrapper">
    <div class="my-custom-box shadow-sm">
        <a href="{{ route('user.list') }}?from=dashboard" class="disabled-link">
            <div class="box-icon">
                <img src="{{ asset('assets/dashboard/img/MyNotebox.png') }}" alt="Logs & Status">
            </div>
            <h2>
                My Notebox
            </h2>
        </a>

    </div>
</div>
{{-- end --}}
{{-- box start --}}
<div class="col-lg-4 box-wrapper">
    <div class="my-custom-box shadow-sm">
        <a href="{{ url('user-dashboard/submitticket') }}?from=dashboard">
            <div class="box-icon">
                <img src="{{ asset('assets/dashboard/img/boxicon/icon_support-tickets.png') }}" alt="Support Tickets">
            </div>
            <h2>
                Support Tickets
            </h2>
        </a>

    </div>
</div>
{{-- end --}}   
</div>





<!--middle content end here-->
</div>
@include('modal.console-expiry-password')
@endsection

<div class="modal fade upload-modal" style="display: none;" id="WelcomeViewerPopup" tabindex="-1" role="dialog"
    aria-labelledby="RegisterMassageLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
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
                                <a href="#" class="accordion-title">
                                    Notes
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <div class="content">
                                    <ol>
                                        <li>You can update your personal information any time by going to My Account and making
                                            your changes.</li>
                                        <li>Your features and Notifications can be accessed in My Account. Please take a look as
                                            these affect the way your Console operates and how you access a number of services.
                                            These settings also determined how you can view the Listings. Many of the services are
                                            enabled by default.</li>
                                        <li>If you do not log in when you visit the Website, then none of your preference settings
                                            will be applied and you will not have access to any of the services afforded to a Viewer.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table>

                            <tr>
                                <td class="welcome_common_para">
                                    <p>Hello {{auth()->user()->name ?? auth()->user()->email}},</p>
                                    <p>
                                        Thank you for selecting E4U as your preferred Website for locating companionship. The
                                        team at E4U is here to help you. Here is some important information you need to know:
                                    </p>
                                    <ol style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Before you can access any of the services on our Website you need to complete some
                                            more of your details, as a once off, these include :
                                            <ul
                                                style="padding-left: 20px; font-size: 15px; line-height: 1.6;list-style-type: disc;">
                                                <li>Completing your personal information, such as About me.</li>
                                                <li>Setting your Notifications & Features.</li>
                                                <li>Uploading your avatar (optional, not made public).</li>

                                            </ul>
                                            If you do not complete your settings, that may have an effect on how the Website
                                            delivers the services to you.
                                        </li>


                                        <li>Our support staff are available to help you between 8:00am and 6:00pm WST Monday
                                            to Friday. You can email us, text us, call us, or log a Support Ticket (our preference).</li>

                                        <li>Please remember your Member ID: {{auth()->user()->member_id}}, which you
                                            will need when communicating with us, especially when you raise a reportable incident
                                            via text or email. We use your Member ID for all communications across the Website
                                            (hashtags are not used in this Website).</li>

                                        <li>From time to time we will come back to you and remind you of any important information
                                            you have not completed.</li>

                                    </ol>

                                    <h4 style="margin-top: 25px;">Heads Up!</h4>
                                    <p>
                                        We have designed a unique Search filter for Users that enables you to undertake a wide
                                        range of searching options to make your experience a pleasant and enjoyable one. There
                                        are also some new world first services available to you as well. Some of those features
                                        include:
                                    </p>
                                    <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li>Add to Shortlist. A session based favorites list.</li>
                                        <li>Service Tags. Select from a wide range of services offered by Advertisers.</li>
                                        <li>Playmates. Escorts can list their Playmates for you to check out.</li>
                                        <li>Media Verification. At last a system that delivers a genuine listing of verified Media for
                                            Advertisers.</li>
                                        <li>My Legbox. When logged in, add your favorite Advertiser to your Legbox list as a
                                            permanent record. Enjoy many services with this feature.</li>
                                        <li>Tour notifications. Get a notification from your Legbox Escorts when they are coming
                                            to your city.</li>
                                        <li>My Notebox. Keep a diary of your favorite Advertisers.</li>
                                    </ul>
                                    <p>And a Profile system that delivers relevant information for you. Our Website has two Profile
                                        types, one for the Escorts and one for Massage Centres (a world first). Some great features
                                        in the Profiles include:</p>
                                    <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                        <li> Escort Profile:
                                            <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                                <li>Availability dates. When the Escort arrives and departs from your city.</li>
                                                <li>Tour departure. When visiting your city, how many days left before they depart.</li>
                                                <li>Playmates. Details of other Escorts who will join you.</li>
                                                <li>A sophisticated Media display for photos and video.</li>
                                                <li>My Playbox. A pay-per-play or subscription service for content.</li>
                                                <li>Total service rate. If there are any extra costs for extra services, they are
                                                    displayed.</li>
                                                <li>A user friendly display of all of the Escort’s details.</li>
                                            </ul>
                                        </li>
                                        <li>Massage Centre:
                                            <ul style="padding-left: 20px; font-size: 15px; line-height: 1.6;">
                                                <li>Detailed information about the business, opening times, the address, access,
                                                    services available, and Google maps to help you get there.</li>
                                                <li>Separate and individual Masseur Profiles for each of the Masseurs working at the
                                                    Centre.
                                                </li>
                                                <li>Detailed information about each Masseur, including when they are available,
                                                    photos, age, charges and services offered.</li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <form action="">

                                        <input type="checkbox" name="registration" id="goToAboutMe">
                                        <label for="goToAboutMe">Do you want to complete your Registration now? (Recommended, only takes a couple
                                            of minutes)</label>
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

<script type="text/javascript" src="{{asset('assets/plugins/ajax/libs/jquery/jquery.min.js')}}"></script>

<script>
    $(document).ready(function() {
        @if(session('show_welcome_popup'))
            $('#WelcomeViewerPopup').modal('show');
            $('#content-wrapper').addClass('blurred');
        @endif
        $('.accordion-container .set > .accordion-title').on('click', function(e) {
            e.preventDefault();

            const $this = $(this);
            const $content = $this.next('.content');

            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $content.stop(true, true).slideUp(200);
                $this.find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
            } else {
                $('.accordion-container .set > a').removeClass('active');
                $('.accordion-container .content').stop(true, true).slideUp(200);
                $('.accordion-container .set > a i').removeClass('fa-angle-up').addClass('fa-angle-down');

                $this.addClass('active');
                $content.stop(true, true).slideDown(200);
                $this.find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
            }
        });


        $('#WelcomeViewerPopup').on('hidden.bs.modal', function() {
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
                        window.location.href = '{{route("user.account.edit")}}';
                    }
                }
            });

        });
    });
</script>

@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endpush