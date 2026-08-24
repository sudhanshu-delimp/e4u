@extends('layouts.web')
@section('style')
@endsection
@section('content')
    <section class="padding_top_eight_px padding_bottom_eight_px">
        <div class="container text-justify">
            <h1 class="home_heading_first margin_btm_twenty_px page-title">Accommodation</h1>

            <h2 class="primery_color normal_heading">Partnership</h2>
            <p>
                Escorts4U have partnered with a leading provider of online accommodation booking
                services (<strong>Booking Service</strong>) to bring the convenience of online accommodation bookings
                to you. The Booking Service is only available to registered Advertisers.
            </p>
            <h2 class="primery_color normal_heading">Access to the Booking Service</h2>
            <p>
                To access the Booking Service, Advertisers need to <a href="{{ route('advertiser.login') }}"
                    style="color:#FF3C5F;font-size: 16px;" class="e4ulinks">logon</a>
                and at their Dashboard:
            </p>
            <ol class="common_list_design">
                <li>
                    <p class="mb-0">Select Administration > Concierge from the menu and click "Accommodation"</p>
                </li>
                <li>
                    <p class="mb-0">Proceed to make your booking from the landing page</p>
                </li>
                <li>
                    <p class="mb-0">Check your details are correct and proceed to payment</p>
                </li>
            </ol>
            <div>

                <!-- changes to this policy -->
                <div class="container mt-4 px-0 chagneto-policy">
                    <hr class="custom_hr">
                    <h2 class="primery_color normal_heading">Changes to this Policy</h2>
                    <p class="border-0">We may change or modify this Policy in the future. We will note the date that
                        revisions were last made at the bottom of this page. Any revision will take effect upon its posting.
                        It is your responsibility to check the <a href="{{ route('pages.terms-conditions') }}"
                            style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                        review the most current version.</p>
                    <p>Escorts4U archives all previous versions of this Policy.</p>
                    <p><b>This policy was last updated 28-05-2025</b></p>
                </div>
            </div>
    </section>
@endsection
@push('scripts')
@endpush
