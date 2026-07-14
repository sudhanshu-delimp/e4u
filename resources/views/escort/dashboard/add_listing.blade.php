@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Add New Listing</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        <div class="col-md-12 mb-4" id="profile_and_tour_options">
            <div class="collapse" id="notes">
                <div class="card">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>Use this feature to create a new Profile listing. The Profile, with verified Media, will be published immediately upon payment having been processed.</li>
                            <li>The Membership Type will default to Platinum. You can change the Membership Type by selecting the preferred Membership Type from the drop down list.</li>
                            <li>Make sure you have <a href="https://e4udev.perth-cake1.powerwebhosting.com.au/escort-dashboard/create-profile" class="custom_links_design">created</a> your Profile before you commence a new listing. All your Profiles will appear in the drop down list for the Location you are presently in. You can create as many listings as you like. Go to <a href="https://e4udev.perth-cake1.powerwebhosting.com.au/escort-dashboard/create-tour" class="custom_links_design">New Tour</a> if you want to create a Tour.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Bar -->
    <div class="row">
        <div class="col-lg-12">
            <div class="custom_progress_wrapper">
                <div class="custom_pro_container">
                    <div class="progress_line" id="custom_progress"></div>

                    <div class="custom_step">
                        <div class="circle active current">1</div>
                        <div class="label active">Listings</div>
                    </div>

                    <div class="custom_step">
                        <div class="circle">2</div>
                        <div class="label">Payment</div>
                    </div>

                    <div class="custom_step">
                        <div class="circle">3</div>
                        <div class="label">Completion</div>
                    </div>
                </div>

                {{-- <button id="prev" disabled>Prev</button>
            <button id="next">Next</button> --}}
            </div>
        </div>
    </div>
    {{-- end --}}


    <div class="row">
        <div class="col-md-12">
            <div class="listing-container">
                <form id="socials_link" action="{{ route('escort.account.listing_checkout',['type'=>'listing'])}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <!-- Header -->
                    <div class="listing-header d-flex justify-content-between gap-20 align-items-center flex-wrap mb-3 ">
                        <h6 class="mb-0" style="font-weight: 600; color:#0c223d;">Please wait while geolocation completes before you create a New Listing.</h6>
                        <button type="button" class="nex_sterp_btn mr-0" id="add_listing" disabled>Add Listing</button>
                    </div>

                    <!-- Listings Area -->
                    <div class="listing_area">
                        <div class="eachListing">
                            <span class="removeCross" title="Click to remove">
                                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}">
                            </span>

                            <div class="listing-row js_geo_location_profiles">
                                <!-- Choose Profile -->
                                <div class="listing-field">
                                    <label>Choose Profile:</label>
                                    <select name="escort_id[]" required disabled>
                                        <option value="">--Select--</option>
                                    </select>
                                </div>

                                <!-- Start Date -->
                                <div class="listing-field">
                                    <label>Start Date:</label>
                                    <input type="text" name="start_date[]" class="profile_start js_datepicker min_today" onkeydown="return false" required>
                                </div>

                                <!-- End Date -->
                                <div class="listing-field">
                                    <label>End Date:</label>
                                    <input type="text" name="end_date[]" class="profile_end js_datepicker" onkeydown="return false" required>
                                </div>

                                <!-- Membership Type -->
                                <div class="listing-field">
                                    <label>Membership Type:</label>
                                    <select name="membership[]" required>
                                        <option value="">-Not Set-</option>
                                        <option value="1">Platinum</option>
                                        <option value="2">Gold</option>
                                        <option value="3">Silver</option>
                                        <option value="4">Free</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="listing-footer" style="text-align:right; margin-top:20px;">
                        <button type="submit" class="save_profile_btn mr-0" id="escort-form-submit-btn">Proceed to Payment</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
@prepend('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('js/escort/add_listing.js') }}"></script>
<script src="{{ asset('js/escort/progress_bar.js') }}"></script>
<script>
    getGeoLocationEscortAccountProfiles(`{{Auth::user()->current_state_id}}`);
</script>
@endprepend