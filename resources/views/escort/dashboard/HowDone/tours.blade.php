@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">

    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Tours</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature if you Tour Australia.</li>
                            <li>The principle behind the Tour Creator is that you can have multiple Profiles Listed in
                                multiple Locations. Before you can create and complete a Tour, you must have
                                created all the Profiles you need for the Locations that will be included in your Tour.</li>
                            <li>You can also include Pin Up in any of the Locations that are included in the Tour.</li>
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
                                <div class="row">
                                    <div class="col-lg-7">
                                        <p>
                                            Use this feature to create a New Tour. You can create as many Locations within
                                            the Tour as you like, and also as many Profiles for each Location you will be
                                            visiting.
                                        </p>

                                        <p class="my-3">
                                            If you want to be a Pin Up in any of the Locations, if the Pin Up week is
                                            available during the days you are at that Location, then you can also add the
                                            Pin Up feature to the Location.
                                        </p>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/create-new-tour.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Tour name</li>
                                    <li>Location</li>
                                    <li>Start and End dates</li>
                                    <li>Add Profile</li>
                                    <li>Membership Type</li>
                                    <li>Locations</li>
                                    <li>
                                        Include the Pin Up if it is available
                                    </li>
                                </ul>

                                <h5><b>How is it done - New Tour</b></h5>

                                <h5 class="sec-head">Tour name</h5>
                                <p>
                                    To create a Tour you must first give the Tour a name. It is up to you how you label your
                                    Tour,
                                    but we recommend whatever you decide, you then maintain it. For example you could name
                                    a Tour: August2026 (no spaces).
                                </p>
                                <p>
                                    By adopting a protocol that you are comfortable with, it will be quick and easy for you
                                    to find
                                    a Tour when you need to.
                                </p>
                                <h5 class="sec-head">Location</h5>
                                <p>
                                    The next step is to select your first Location, where the Tour starts from. Click the
                                    Location
                                    button and by default your Home State will load. You can change the Location to any
                                    Location, provided you have created Profiles for the Location you select. For example,
                                    you
                                    might be in NSW but you want to start your Tour in Qld. So you would change the default
                                    Location from NSW to Qld.
                                </p>
                                <h5 class="sec-head">Start and End dates</h5>
                                <p>
                                    The next step is to select the start date and end date for that Location. You can insert
                                    the
                                    dates manually, or use the calendar pop up.
                                </p>
                                <div class="row">
                                    <div class="col-lg-7">

                                        <h5 class="sec-head">Add Profile</h5>

                                        <p>
                                            Next, add the Profile you have created for
                                            that Location. You can change the Stage
                                            Name if you want. If you change the Stage
                                            Name you will be asked if you want to save
                                            the change to the Profile. If you answer Yes
                                            the Profile will update, if you answer No, the
                                            Profile will remain unchanged but the new
                                            Stage Name will be applied to the Profile for the Tour.
                                        </p>
                                        <p>
                                            You can add as many Profiles as you want to the Location. If you change your
                                            mind, you
                                            can
                                            remove the Profile as well.
                                        </p>
                                    </div>
                                    <div class="col-lg-5 mt-2">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/tour-name.png') }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="sec-head">Membership Type</h5>
                                <p>
                                    Lastly, select the Membership Type you want for the Profile. Platinum Membership will
                                    load
                                    by default. If you have selected multiple Profiles for the Location, they can be
                                    different
                                    Membership Types.
                                </p>
                                <h5 class="sec-head">Locations</h5>
                                <p>
                                    You have now completed your first Location. For a Tour to be complete, you must have at
                                    least two Locations.
                                </p>
                                <p>
                                    If you want you can add additional Profiles to the Location by clicking the Add Profile
                                    button,
                                    and repeating the process. To save the setting, click Add Location, and the next
                                    Location will
                                    appear. Repeat the procedure until you have completed all the Locations and Profiles for
                                    those Locations. As you add a Location, the Tour Creator will auto-fill the start date
                                    for the
                                    next Location. That date is one day after the End Date for the previous Location.
                                </p>
                                <p>

                                    If you have enabled the ‘Post a Tour leg one day before the arrival date’ feature in
                                    your
                                    Account settings, the extra day will be calculated for payment, but it will not display
                                    in the Tour
                                    Creator.
                                </p>
                                <p>
                                    When you have completed the Tour, click Save, and proceed to payment.
                                </p>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <h5 class="sec-head">Pin Up</h5>
                                        <p>
                                            If you want to add the Pin Up feature to any
                                            of your Profiles across the Locations, go to
                                            <a href="{{ route('escort.list', 'current') }}"
                                                class="custom_links_design">Current
                                                Tours</a>. and click
                                            the List Pin Up button.
                                        </p>
                                        <p>
                                            A pop up will appear where you can select
                                            the Tour you want to ad Pin Up to. Once you
                                            have selected the Tour, you can then register as a Pin Up
                                            for the various Locations within the Tour. Remember,
                                            you must have a Platinum Listing within the Location to
                                            qualify for Pin Up in that Location.
                                        </p>
                                        <p>
                                            Once you have selected your Profile, select the week you
                                            want to be the Pin Up in that Location. Only the weeks
                                            with the start and end dates either side of the Pin Up
                                            week for the Profile Listing in that Location will be listed.
                                        </p>
                                        <p>
                                            Then proceed to Payment.
                                        </p>
                                        <p>Repeat the process for Pin Up listings in other Locations.</p>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/current-tour.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                        <div class="doc-img mt-2">
                                              <img src="{{ asset('assets/dashboard/img/how-is-done/list-pinup.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                </div>

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
                        <div id="collapseCurrent" class="collapse" aria-labelledby="headingCurrent"
                            data-parent="#accordion">
                            <div class="card-body">
                                <h5><b>Overview</b></h5>
                                <div class="row">
                                  <div class="col-lg-7">
                                    


                                    <p>
                                        A comprehensive report summarising your Current Tours. You can create short or long
                                        Tours. It is entirely up to you, but you must have a minimum of two Locations in the
                                        Tour.
                                        You can manage your Tours from the Dashboard <a
                                            href="{{ route('escort.dashboard.tour-schedule') }}" class="custom_links_design">My
                                            Tour Schedule</a> as well as from your <a
                                            href="{{ url('escort-dashboard/list-tour/current') }}"
                                            class="custom_links_design">Current Tours</a> report.
                                    </p>
                                     <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Manage your current Tour/s from the one location</li>
                                    <li>Comprehensive summary of your Tour schedule</li>
                                </ul>
                                  </div>
                                  <div class="col-lg-5">
                                        <div class="doc-img">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/my-tour-schedule.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                </div>

                               

                                   <h5><b>How is it done - Current</b></h5>

                                <div class="row">
                                    <div class="col-lg-7">
                                   
                                        <p>
                                            You can view in detail all the particulars associated with
                                            your current Tour. You can also view the Tour summary
                                            from the Action list, which also has the Pin Up feature
                                            available.
                                        </p>
                                        <p>
                                            All of the Profiles attached to the Tour are summarised in
                                             <a href="{{ route('escort.list', 'listed') }}"
                                                class="custom_links_design">Listed Profiles</a>. Any editing
                                            required to a Profile can be completed here, including
                                            Media updates, by selecting the required action from the
                                            Action list.
                                        </p>
                                        <p>
                                          Soon to be implemented, the edit feature is particularly helpful for changing any of your
                                          Profile's start or finish dates, Membership Type or to remove a Profile from the Tour. Any
                                          changes to the Tour will automatically adjust your Fee to reflect the changes, including any
                                          Credit, which will be added to your Account to be used for future Listings and Tours.
                                        </p>
                                        <p>
                                            The Tour Summary also displays the Fees paid for the Tour.
                                        </p>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="doc-img mt-2">
                                            <img src="{{ asset('assets/dashboard/img/how-is-done/current-tour-2.png') }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Past -->
                    <div class="card">
                        <div class="card-header" id="headingPast">
                            <h2 class="mb-0">
                                <a class="card-link collapsed" data-toggle="collapse" href="#collapsePast"
                                    aria-expanded="false">
                                   Past
                                </a>
                            </h2>
                        </div>
                        <div id="collapsePast" class="collapse" aria-labelledby="headingPast" data-parent="#accordion">
                            <div class="card-body">
                                <h5><b>Overview</b></h5>
                                <p>
                                    All of your completed Tours are retained and can be reactivated as a new Tour.
                                </p>

                                <h5><b>Features</b></h5>
                                <ul class="custom-ul">
                                    <li>Historical record of completed Tours</li>
                                    <li>Reactivate a Tour</li>
                                </ul>

                                <h5><b>How is it done - Past</b></h5>
                                <p>
                                    View any completed Tour to see a summary of the components to the Tour. If you have a
                                    past Tour that has the Locations and Profiles that you want to use in a New Tour, then
                                    select from the Action list ‘New Tour’ and the Tour will load for you. Change the start
                                    and end dates for Each Location and Save.
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
