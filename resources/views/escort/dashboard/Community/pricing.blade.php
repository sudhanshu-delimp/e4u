@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .select2-container .select2-choice, .select2-result-label {
    font-size: 1.5em;
    height: 52px !important;
    overflow: auto;
    }
    .select2-arrow, .select2-chosen {
    padding-top: 6px;
    }
    span.select2.select2-container.select2-container--default > span.selection > span {
    height: 52px !important;
    }
    .list-sec .table td, .table th{
    border: 1px solid #0c233d;
    }
</style>
@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5">
                <!--middle content-->
                <div class="row">
                    <div class="col-md-9">
                        <!-- Begin Page Content -->
                        <div class="container-fluid" style="padding: 0px 0px;">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                <div class="v-main-heading h3">
                                    Pricing summary
                                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                                </div>
                            </div>
                            <div class="card collapse  mb-4" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol>
                                        <li>These pricing information pages are a complete summary of all the discounts and
                                            Fees that are applied in the Website when posting a Profile or engaging us to do
                                            any Support Services.</li>
                                        <li>Information is also provided about our loyalty program.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid --><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="myacording-design">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2><a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                            Advertising Fees
                                            </a>
                                            </h2>
                                        </div>
                                        <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">

{{--                                                        <h5 class="price-sec">Profile &amp; Tour Fees</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                                <tr role="row" style="border-bottom: 2px solid white;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="4" style="width: 212px; border-right: 2px solid white;" aria-label="Fees">
                                                                        <p><b>Fees</b></p>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="2" style="width: 212px;" aria-label="Discounts">
                                                                        <p><b>Discounts</b><sup>(1)</sup></p>
                                                                    </th>
                                                                </tr>
                                                                <tr role="row">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                        Profile Name">Membership Type
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                        Profile Name
                                                                        ">Period
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">Frequency<sup>(2)</sup></th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px;" aria-label="Subscription Type">Rate</th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">%</th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Status">Rate</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr role="row">
                                                                    <td>Platinum</td>
                                                                    <td>Fixed</td>
                                                                    <td>per day</td>
                                                                    <td>$ 8.00 </td>
                                                                    <td>6.25</td>
                                                                    <td>$ 7.50 </td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Gold</td>
                                                                    <td>Fixed</td>
                                                                    <td>per day</td>
                                                                    <td>$ 6.00 </td>
                                                                    <td>5</td>
                                                                    <td>$ 5.70 </td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Silver</td>
                                                                    <td>Fixed</td>
                                                                    <td>per day</td>
                                                                    <td>$ 4.00 </td>
                                                                    <td>5</td>
                                                                    <td>$ 3.80 </td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Free<sup>(3)</sup></td>
                                                                    <td>21 days</td>
                                                                    <td>per day</td>
                                                                    <td>$ 0.00 </td>
                                                                    <td>N/A</td>
                                                                    <td>$ 0.00 </td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Pin-Up<sup>(4)</sup></td>
                                                                    <td>Fixed</td>
                                                                    <td>per week</td>
                                                                    <td>$ 475.00 </td>
                                                                    <td>0.00</td>
                                                                    <td>$ 475.00 </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <div class="card border-0 p-0 mb-0">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ol class="mb-0" type="1">
                                                                <li>
                                                                    Discount only applies:
                                                                </li>
                                                                <ol type="a" class="custom--substyle">
                                                                    <li>to a single transaction; and</li>
                                                                    <li>from day 22.</li>
                                                                </ol>
                                                                <li>Pay by the day available.</li>
                                                                <li>After 21 days for Free Membership, then Profile is suspended and Escort
                                                                    asked what Membership Type to go to, eg Platinum. If you have an Agent
                                                                    appointed, the Agent will also receive the notification.</li>
                                                                <li>Pin Up is a set weekly Fee.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive pl-2 pt-3 list-sec">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">

                                                        {{--                                                        <h5 class="price-sec">Profile &amp; Tour Fees</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="5" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Profile / Tour Ready Reckoner</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Start Date
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    End Date
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">
                                                                    Membership Type
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">Locations</th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Status">Fee</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr role="row">
                                                                <td><input name="start" id="start_date" type="date"></td>
                                                                <td><input name="end" id="end_date" type="date"></td>
                                                                <td><select><option></option></select></td>
                                                                <td><select><option></option></select></td>
                                                                <td></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <h3>Changes to this Guide</h3>
                                                    <span>
                                                        This Guide was last updated on 02-2024.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse"
                                               href="#other_fees_concierge_services" aria-expanded="false">
                                                Support Fees, Concierge Services & Support Services
                                            </a>
                                        </div>
                                        <div id="other_fees_concierge_services" class="collapse"
                                             data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
{{--                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Support Fees for setting up Concierge & Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Service Type
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Frequency
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">
                                                                    Fee
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr role="row">
                                                                <td>Travel</td>
                                                                <td>per Service</td>
                                                                <td>[$value]</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Accommodation</td>
                                                                <td>per Service</td>
                                                                <td>$ 75.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Mobile SIM</td>
                                                                <td>per Service</td>
                                                                <td>$ 75.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Email Account</td>
                                                                <td>per Service</td>
                                                                <td>$ 75.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Visa Migration & Education Placement</td>
                                                                <td>per Service</td>
                                                                <td>$ 75.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Support Services</td>
                                                                <td>per Service</td>
                                                                <td>$ 75.00</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <div class="card border-0 p-0 mb-0">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ol class="mb-0" type="1">
                                                                <li>
                                                                    These Support Fees apply where E4U provides Support Services to the
                                                                    Escort upon completing a request on your behalf to putting into place the
                                                                    particular requested Service, such as a Concierge Service. This is a
                                                                    separate Fee to the fixed Fee that may apply to the actual Service being
                                                                    applied.
                                                                </li>
                                                                <li>The Support Fee will be billed to the Escort’s nominated Card.</li>
                                                                <li>Where a Concierge Service has a recurring Fee, that Fee will be billed to
                                                                    the Escort's nominated Card by a single transaction for the term of the
                                                                    Concierge Service.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        {{--                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Concierge & Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Service Type
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">
                                                                    Fee
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Frequency
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr role="row">
                                                                <td>NUM Notification</td>
                                                                <td>[$value]</td>
                                                                <td>Per month</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Verified Media</td>
                                                                <td>$ 10.00</td>
                                                                <td>Per service, up to 7 photos</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Mobile SIM</td>
                                                                <td>$ 85.00</td>
                                                                <td>Per month</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Email account</td>
                                                                <td>$ 20.00</td>
                                                                <td>Per month</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <div class="card border-0 p-0 mb-0">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ol class="mb-0" type="1">
                                                                <li>
                                                                    An Escort can engage an <a style="color:#FF3C5F" href="#">Agent</a> to undertake any of the Services,
                                                                    otherwise Escorts4U will assist Escorts with support. A Fee applies.
                                                                </li>
                                                                <li>Platinum and Gold Membership includes Verified Media.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-5">
                                                    <h3>Changes to this Guide</h3>
                                                    <span>
                                                        This Guide was last updated on 02-2024.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                                Other Support Fees - Support Services
                                            </a>
                                        </div>
                                        <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        {{--                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Other Support Fees - Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Fee
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Frequency
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">
                                                                    Fee
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr role="row">
                                                                <td>Create Profile</td>
                                                                <td>per Service</td>
                                                                <td>$ 50.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Edit Profile</td>
                                                                <td>per Service</td>
                                                                <td>$ 20.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Create Tour</td>
                                                                <td>per Service</td>
                                                                <td>$ 50.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Edit Tour</td>
                                                                <td>per Service</td>
                                                                <td>$ 20.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Upload Media (for verification) post initial setup</td>
                                                                <td>per Service</td>
                                                                <td>$ 20.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Complete Media Verification (excluding Platinum)</td>
                                                                <td>per Service</td>
                                                                <td>$ 10.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Complete Profile Information</td>
                                                                <td>per Service</td>
                                                                <td>$ 30.00</td>
                                                            </tr>
                                                            <tr role="row">
                                                                <td>Organise Profiles and Media</td>
                                                                <td>per Service</td>
                                                                <td>$ 50.00</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <div class="card border-0 p-0 mb-0">
                                                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                            <ol class="mb-0" type="1">
                                                                <li>
                                                                    These Support Fees relate to E4U providing Support Services to the
                                                                    Escort for completing a request on behalf of the Escort to provide the
                                                                    Support Service.
                                                                </li>
                                                                <li>The Support Fee will be billed to the Escort’s nominated Card.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mt-5">
                                                    <h3>Changes to this Guide</h3>
                                                    <span>
                                                        This Guide was last updated on 02-2024.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram"
                                               aria-expanded="false">
                                                Loyalty Program
                                            </a>
                                        </div>
                                        <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <p>For every [$value (200.00)] spent by an Escort, Escorts4U will apply one day of free
                                                        advertising. When creating your Profile or Tour, the program is automatically applied.</p>
                                                    </div>
                                                </div>

                                                <div class="mt-5">
                                                    <h3>Changes to this Guide</h3>
                                                    <span>
                                                        This Guide was last updated on 02-2024.
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--middle content end here-->
                    <!--right side bar start from here-->
                </div>
            </div>
        </div>
    </div>
</div>
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush
