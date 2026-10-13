    @extends('layouts.center')
    @section('style')
    @endsection
    @section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="custom-heading-wrapper col-lg-12">
                <h1 class="h1">Listings</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 ">
                <div class="card collapse  mb-4" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>Use these help pages for explanations and guidance on completing a Listing of your
                                Profile in the Website.</li>
                            <li>You can only List one Profile at a time.</li>
                            <li>Before you can List a Profile, you must have created and saved your Profile including
                                the profiles for your Masseurs who will appear in the Profile.</li>
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
                        <div class="card-header" id="New">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew"
                                    aria-expanded="false">
                                    New
                                </a>
                            </h2>
                        </div>
                        <div id="collapseNew" class="collapse" aria-labelledby="New" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <div class="row my-4">
                                    <div class="col-lg-7">
                                        <p>
                                            Use this feature to list your Profile. Should
                                            you have an existing Profile already Listed, the
                                            website will reject the additional Listing as
                                            you can only list one Profile per Member ID.
                                        </p>
                                        <p>
                                            Any Profile you have created will be made
                                            available for you to select for the Listing,
                                            provided you have cancelled any current
                                            Listing.
                                        </p>

                                        <h5><b>Features</b></h5>
                                        <ul class="custom-ul">
                                            <li>Choose Profile</li>
                                            <li>Social Media Content</li>
                                            <li>Payment</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/add-new-listing.png') }}" alt="about-us"
                                                class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>



                                <h5><b>How is it done - New Listing</b></h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            Only 4 steps to complete including
                                            Payment. Start by selecting the Profile you
                                            want to List from the drop down list. You
                                            will see all of your available Profiles in the
                                            list. Once you have selected the Profile to
                                            list, then set your Start and End dates.
                                        </p>
                                        <p>
                                            Remember, you can only List one Profile at
                                            a time in your Location.
                                        </p>
                                        <p>
                                            Once Listed, your Listing will reshuffle every thirty minutes so that all Profiles are at some
                                            point in the cycle towards the top of the Listing page. You can Bump Up your List any time
                                            (Profiles Centre).
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/how-new-listing.png') }}" alt=""
                                                class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Current -->
                    <div class="card common-card">
                        <div class="card-header" id="Current">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapseCurrent"
                                    aria-expanded="false">
                                    Current
                                </a>
                            </h2>
                        </div>
                        <div id="collapseCurrent" class="collapse" aria-labelledby="Current" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <p>
                                    All of your completed Listings are summarised here. Important information about your Listing
                                    can be gleamed from the report, like your start and finish dates, and the Fee you paid E4U
                                    for the Listing.
                                </p>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Search</li>
                                    <li>Comprehensive data summary</li>
                                    <li>Current Listing records</li>
                                </ul>

                                <h5><b>How is it done - Current Listing</b></h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            After you list a Profile, the key data
                                            associated with the Profile and Listing are
                                            summarised in the report. The report is a
                                            record only so that you can look back over
                                            your Listing while it is current.
                                        </p>
                                        <p>
                                            Once the Listing expires, the Listing is
                                            removed from the report and relocated to Past. You will be notified of the impending
                                            expiration of the Listing.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/current-listing-mc.png') }}" alt=""
                                                class="w-100 rounded-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Past -->
                    <div class="card common-card">
                        <div class="card-header" id="Past">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapsePast"
                                    aria-expanded="false">
                                    Past
                                </a>
                            </h2>
                        </div>
                        <div id="collapsePast" class="collapse" aria-labelledby="Past" data-parent="#accordion">
                            <div class="card-body">

                                <h5><b>Overview</b></h5>
                                <p>
                                    All of your completed Listings are summarised here.
                                </p>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Search</li>
                                    <li>Comprehensive data summary</li>
                                    <li>Historical records</li>
                                </ul>

                                <h5><b>How is it done - Past Listings</b></h5>

                                <p>
                                    Once your Listing has expired the Listing / Profile data summary appears in the report. You
                                    can order the report’s content according to your preference. For example, you may want to
                                    see a particular previous Listing. Simply click the sort function in the report header, and the
                                    report will re-organise the reports to list the expired Listings in your selected order.
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