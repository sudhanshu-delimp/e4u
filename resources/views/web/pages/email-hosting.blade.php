@extends('layouts.web')
@section('style')
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px">
   <div class="container text-justify">
        <h1 class="home_heading_first margin_btm_twenty_px page-title">Email Hosting
        </h1>

        <h2 class="primery_color normal_heading">Partnership</h2>
        <p>
            Escorts4U have partnered with a leading provider of email services (<strong>Services</strong>) so as to
            bring you the convenience of having access to your email, should you choose to, through
            your Dashboard. Services are only available to registered Advertisers.
        </p>
        <h2 class="primery_color normal_heading">Access to the Services</h2>
        <p>
            To access the Service, Advertisers need to <a href="{{ route('advertiser.login') }}" class="e4ulinks" style="color:#FF3C5F;font-size: 16px;">logon</a> and at their Dashboard:
        </p>
          <ol class="common_list_design">
            <li><p class="mb-0">Select Administration > Concierge from the menu and click "Email Hosting"</p></li>
            <li><p class="mb-0">Follow the instructions and complete the form</p></li>
            <li><p class="mb-0">Check your details are correct and proceed to payment</p></li>
        </ol>

       
        <!-- changes to this policy -->
    <div class="container mt-4 px-0 chagneto-policy">
        <hr class="custom_hr">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ route('pages.terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
         <p>Escorts4U archives all previous versions of this Policy.</p>
         <p><b>This policy was last updated 28-05-2025</b></p>
    </div>
   </div>
   </div>
</section>
@endsection
@push('scripts')

@endpush
