@extends('layouts.web')
@section('style')
<style>
    .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    }
    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }

.e4u-verify-list{
    padding-left: 15px;
}   
.e4u-verify-list li{
    padding-left: 20px;
}
.e4u-verify-list li i{
    color: #212529;    
    font-family: Poppins !important;
}
</style>
@endsection
@section('content')
<section class="padding_top_eight_px padding_bottom_eight_px">
   <div class="container reg_info text-justify">
    <h1 class="home_heading_first margin_btm_twenty_px page-title">E4U Verified</h1>

    <h2 class="primery_color normal_heading">Our commitment</h2>
    <p>
        Escorts4U, on behalf of all the Users who may frequent the Website, takes its role as a provider of an advertising platform very seriously. 
        We have developed a clear focus on providing
        a secure, transparent, and trustworthy platform for all Users. A part of this commitment
        includes our E4U Verified feature.
    </p>
    <p>
        A public E4U Verified image appears on all Media within the Website which has been verified
        by the E4U process. It is optional for Escorts to use, however, where Media has not been
        verified, an alternative image appears advising the User that the Advertiser's Media has not
        been verified.  Our Search filters for both Escorts and Massage Centres have a filter which you can select
        to narrow your criteria.
    </p>
    <h2 class="primery_color normal_heading">The benefits to you</h2>
    <p>By developing this policy, all Users are delivered a range of benefits, which include:</p>
    <ol class="e4u-verify-list">
        <li> <i>Enhanced Transparency and Trust.</i> E4U Verified lets you know that when you look at
            any Advertiser's Media that displays an E4U Verified icon, the Advertiser has submitted
            that Media and passed the verification process. You can reply on the Media's
            authenticity.</li>
        <li> <i>Improved Confidence with Your Bookings.</i> This added layer of verification helps eliminate
            any uncertainty about who you will be meeting, should you undertake a booking with the
            Advertiser.
            </li>
        <li> <i>Privacy Protection.</i> E4U Verified assists by eliminating the need for intrusive requests
            of the Advertiser for selfies. This goes a long way in supporting privacy for the
            Advertisers whilst maintaining high standards of authenticity.</li>
        <li> <i>Enhanced Experience for everyone.</i> E4U Verified helps to foster a safer, more
            professional environment for everyone involved. Viewers can feel assured they are
            undertaking a legitimate booking with the Advertiser. And the Advertisers benefit from
            an increased perception of credibility and trust in their Profiles.</li>
        </ol>

    <h2 class="primery_color normal_heading">How the E4U Verified service works</h2>
    <p>
        If you are a registered Viewer, you can set you preference settings to only view E4U Verified
        Profiles.
    <div class="row">
        <div class="col-lg-5">
            </p>
            You can also select the E4U Verified
            option located in the Search Filters. By
            default, the filter is not enabled and you
            will be presented with verified and
            unverified Profiles togther.
            </p>
        </div>   
        <div class="col-lg-7">
            <img src="{{ asset('assets/app/img/e4u_verified.png') }}" alt="e4u verified" class="w-100">
        </div>
    </div>
    <!-- changes to this policy -->
    <div class="container mt-4 px-0 chagneto-policy">
        <hr class="custom_hr">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p class="border-0">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                              review the most current version.</p>
         <p>Escorts4U archives all previous versions of this Policy.</p>
         <p><b>This policy was last updated 28-05-2025</b></p>
    </div>
   </div>        
</section>
@endsection
@push('scripts')
@endpush