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
            <h1 class="h1">Listings</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b> </h3>
                   <ol>
                    <li>Use these help pages for explanations and guidance on completing a Listing of a
                        Profile in the Website.
                    </li>
                    <li>You can List as many Profiles as you want within the Location.</li>
                    <li>Before you can List a Profile, you must have created and saved a Profile for the
                        Location you wish to complete the Listing in.
                    </li>
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
                        <div class="card-header" id="headingNew">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew"
                                    aria-expanded="false">
                                    New
                                </a>
                            </h2>
                        </div>
                        <div id="collapseNew" class="collapse" aria-labelledby="headingNew" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Use this feature to list a Profile in your Location. The Website
                                            operates geolocation and will know which Location you are in
                                            when you attempt a Listing.
                                        </p>
                                        <p>
                                            Only the Profiles you have created for the Location you are in
                                            will be made available for you to select for the Listing. You can
                                            have multiple Listings, incorporating multiple Profiles, within
                                            your Location.
                                        </p>
                                        <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Profile section</li>
                                    <li>Listing period</li>
                                    <li>Membership Type</li>
                                    <li>Payment</li>
                                </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/add-listing-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                                

                                <h5><b>How is it done</b></h5>
                                            <p>
                                                Only 4 steps to complete then Payment. Start by selecting the Profile you want to List from
                                                the drop down list. You will see all of your available Profiles in the list. Once you have
                                                selected the Profile to list, then set your Start and End dates. And finally, select the
                                                Membership Type you want for the Listing. There are three levels of Membership, Platinum,
                                                Gold and Silver. They represent:
                                            </p>
                                            <ul class="custom-ul">
                                                <li>Platinum. You appear at the top of the Listings.</li>
                                                <li>Gold. You appear in the middle of the Listings.</li>
                                                <li>Silver. You appear at the bottom of the Listings.</li>
                                            </ul>
                                            <p>
                                               The Listings, for each Membership Type, reshuffle every two hours so that all the Profiles are
                                                at some point in the cycle towards the top of each Membership Type.
                                            </p>
                                            <p>
                                                If you want to list a second Profile, click the ‘Add Listing’ button and repeat the process.
                                                When you have completed your Listing, proceed to Payment.
                                            </p>
                                        
                            </div>
                        </div>
                    </div>

                     <!-- Current -->
                    <div class="card">
                        <div class="card-header" id="headingCurrent">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseCurrent"
                                    aria-expanded="false">
                                    Current
                                </a>
                            </h2>
                        </div>
                        <div id="collapseCurrent" class="collapse" aria-labelledby="headingCurrent" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            All of you Current Listings are summarised here. Important
                                            information about your Listings can be gleamed from the report,
                                            like your start and finish dates, and the Fee you paid E4U for
                                            the Listing.
                                        </p>

                                         <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Search</li>
                                    <li>Comprehensive data summary</li>
                                    <li>Current Listings records</li>
                                </ul>

                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/current-listing-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                               
                                <h5><b>How is it done</b></h5>
                                <p>
                                    After you list a Profile, the key data associated with the Profile and Listing are summarised
                                    in the report. The report is a record only so that you can look back over your Listings
                                    historically while they are current.
                                </p>
                                <p>
                                    Once the Listing expires, the Listing is removed from the report and relocated to Past.
                                </p>
                                        
                            </div>
                        </div>
                    </div>

                    <!-- Past -->
                    <div class="card">
                        <div class="card-header" id="headingArchive">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseArchive"
                                    aria-expanded="false">
                                    Past
                                </a>
                            </h2>
                        </div>
                        <div id="collapseArchive" class="collapse" aria-labelledby="headingArchive" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            All of your completed Listings are summarised here.
                                        </p>

                                         <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Search</li>
                                    <li>Comprehensive data summary</li>
                                    <li>Historical records</li>
                                </ul>   
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/past-listing-scr.png') }}"
                                                  alt="" class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>

                               

                                <h5><b>How is it done</b></h5>
                                <p>
                                    Once your Listing has expired the Listing / Profile data summary appears in the report. You
                                    can order the report’s content according to your preference. For example, you may want to
                                    see previous Listings with a particular Stage Name. Simply click the sort function in the report
                                    header, and the report will re-organise the reports to list the expired Listings in alphabetical
                                    order according to Stage Names.
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
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    
@endpush
