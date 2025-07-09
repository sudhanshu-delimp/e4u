@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
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
            <div class="container-fluid pl-3 pl-lg-5 custom--accordfee">
                <!--middle content-->
                <div class="row">
                    <div class="col-md-9 p-0">
                        <!-- Begin Page Content -->
                        <div class="container-fluid" style="padding: 0px 0px;">
                            <!-- Page Heading -->
                            <div class="custom-heading-wrapper">
                                <h1 class="h1"> Pricing summary</h1>
                                 <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                            </div>
                            <div class="card collapse  mb-4" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol>
                                        <li>There are a range of Fees that apply to Advertisers, namely:</li>
                                            <ol class="level-2">
                                                <li>Advertising Fees</li>
                                                <li>Concierge Services</li>
                                                <li>Support Services</li>
                                            </ol>
                                        <li>There is a loyalty program which also applies to Advertisers.</li>
                                        <li>There are a range of variables that determine:</li>
                                        <ol class="level-2">
                                            <li>Discounts to Advertising Fees</li>
                                            <li>Loyalty Program entitlements and discounts</li>
                                        </ol>
                                        <li>All amounts are exclusive of GST.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                        <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="myacording-design">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2><a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                                Advertising
                                            </a>
                                            </h2>
                                        </div>
                                        <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">

                                            {{-- <h5 class="price-sec">Profile &amp; Tour Fees</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                                <tr role="row" style="border-bottom: 2px solid white;">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="4" style="width: 212px; border-right: 2px solid white;" aria-label="Fees">
                                                                        <p><b>Fees</b></p>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="2" style="width: 212px;" aria-label="Discounts">
                                                                        <p><b>Discounts</b><sup>(1)</sup></p>
                                                                    </th>
                                                                </tr>
                                                                <tr role="row" class="custom--row">
                                                                    <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="
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
                                                                <ol class="level-2">
                                                                    <li>to a single transaction; and</li>
                                                                    <li>from day 22 to all Advertisers.</li>
                                                                </ol>
                                                                <li>Pin Up is a set weekly Fee.</li>
                                                                <li>Pay by the day available.</li>
                                                                <li>After 21 days for Free Membership, then Profile is suspended and Escort asked what
                                                                    Membership Type to go to, eg Platinum.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive pl-2 pt-3 list-sec">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">

                                                        {{--                                                        <h5 class="price-sec">Profile &amp; Tour Fees</h5>--}}
                                                        <table id="reckoner" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                                <tr role="row">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="5" style="width: 212px;" aria-label="Fees">
                                                                        <p><b>Profile / Tour Ready Reckoner</b></p>
                                                                    </th>
                                                                    <th>
                                                                        <button type="button" class="border-0 px-5 py-3 bg-second font-weight-bold" id="add-new-row">Add</button>
                                                                    </th>
                                                                </tr>
                                                                <tr role="row" class="custom--row text-left">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Location
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                        Start Date
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                        End Date
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">
                                                                        Membership Type
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">Number of
                                                                        Profiles</th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Status">Fee</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr role="row">
                                                                    <td><select style="border: 0;width:100%">
                                                                            <option value="WA">WA</option>
                                                                            <option value="SA">SA</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input name="start" id="start_date" type="date" style="border: 0;width:100%"></td>
                                                                    <td><input name="end" id="end_date" type="date" style="border: 0;width:100%"></td>
                                                                    <td><select style="border: 0;width:100%">
                                                                            <option value="Platinum">Platinum</option>
                                                                            <option value="Gold">Gold</option>
                                                                            <option value="Silver">Silver</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><select style="border: 0;width:100%">
                                                                            <option value="1">1</option>
                                                                            <option value="2" selected>2</option>
                                                                            <option value="3">3</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="d-flex align-items-center">
                                                                        <label class="mb-0">$</label><input name="fee" id="fee" type="text" style="border: 0;width:100%" value="80.00">
                                                                    </td>
                                                                </tr>
                                                                <tr class="custom-last-row">
                                                                    <td class="border-0"></td>
                                                                    <td class="border-0"></td>
                                                                    <td class="border-0"></td>
                                                                    <td class="border-0"></td>
                                                                    <td  class="font-weight-bold text-right">Total Fees:</td>
                                                                    <td class="font-weight-bold text-left"><span>$</span>146.00</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="mt-5">
                                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                    <ol class="mb-0" type="1">
                                                        <li>
                                                            Use the ready reckoner to calculate the Fee for a Profile or Tour.
                                                        </li>
                                                        <li>When calculating the Fees, use a single line per Membership Type.</li>
                                                        <li>You can add as many additional Membership Types, and Profiles per Location, as
                                                            you like.</li>
                                                        <li>The Fee is inclusive of any discounts that would apply to a single transaction in
                                                            excess of 21 days.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse"
                                               href="#other_fees_concierge_services" aria-expanded="false">
                                               Recommended Support Fees - Concierge Services
                                            </a>
                                        </div>
                                        <div id="other_fees_concierge_services" class="collapse"
                                             data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        {{--  <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Support Fees for setting up Concierge & Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row" class="custom--row">
                                                                <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                    Service Type
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Profile Name">
                                                                    Frequency
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Date Created">
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
                                                                    These recommended Support Fees relate to E4U or an Agent completing a request
                                                                    on behalf of the Advertiser to E4U to provide a Concierge Service.
                                                                </li>
                                                                <li>The Support Fee must be collected by the Agent from the Advertiser.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        {{--                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Concierge & Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row" class="custom--row">
                                                                <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
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
                                                                    An Escort can engage an Agent to undertake any of the Services, otherwise
                                                                    Escorts4U will assist Escorts with support. A Fee applies.
                                                                    
                                                                </li>
                                                                <li>Platinum and Gold Membership includes Verified Media.</li>
                                                            </ol>
                                                        </div>
                                                    </div>
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
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">
                                                            <tr role="row">
                                                                <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                                    <p><b>Other Support Fees - Support Services</b></p>
                                                                </th>
                                                            </tr>
                                                            <tr role="row" class="custom--row">
                                                                <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 150px;" aria-label="Profile Name">
                                                                    Fee
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 200px;" aria-label="Profile Name">
                                                                    Frequency
                                                                </th>
                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 10px;" aria-label="Date Created">
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
                                                                <tr role="row">
                                                                    <td>Organise a Concierge service</td>
                                                                    <td>Complete a Concierge Services request, assist with the delivery
                                                                        if applicable.</td>
                                                                    <td>$ 75.00</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Establishing an
                                                                        Escort's Playbox</td>
                                                                    <td>Upload Content <sup>(3)</sup> to the Escort's Playbox, ensuring compliance,
                                                                        create the Playbox profile, including setting the pricing
                                                                        schedule.</td>
                                                                    <td>$ 100.00</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Updating Escort's
                                                                        Playbox</td>
                                                                    <td>Remove Content and / or upload new Content and post to the
                                                                        Escort's Playbox. Undertake any maintenance issues.</td>
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
                                                                    These recommended Support Fees relate to an Agent completing a Support Service
                                                                    for an Advertiser. Recommended Fees are not fixed. An Agent can charge a fee set
                                                                    by the Agent for any services provided by that Agent to an Advertiser.
                                                                </li>
                                                                <li>The support fee is paid directly to the Agent (which is arranged between the
                                                                    Advertiser and the Agent).</li>
                                                            </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram"
                                               aria-expanded="false">
                                               Loyalty Program Advertisers
                                            </a>
                                        </div>
                                        <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        {{--                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>--}}
                                                        <table id="myTable price-sec" class="table table-bordered table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead class="text-center">                                                           
                                                                
                                                                <tr role="row" class="custom--row">
                                                                    <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                                        Type
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Profile Name">
                                                                        Level
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Date Created">
                                                                        Description
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Date Created">
                                                                        Value
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;" aria-label="Date Created">
                                                                        Reward (Days)
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr role="row">
                                                                    <td>Escort</td>
                                                                    <td>P, G, S</td>
                                                                    <td>Spend</td>
                                                                    <td>$ 200.00 </td>
                                                                    <td>1</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Massage Centre</td>
                                                                    <td>MC</td>
                                                                    <td>Spend</td>
                                                                    <td>$ 500.00 </td>
                                                                    <td>1</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                {{-- <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <p>For every $200.00 spent by an Escort, Escorts4U will apply one day of free
                                                        advertising. When creating your Profile or Tour, the program is automatically applied.</p>
                                                    </div>
                                                </div> --}}

                                                <div class="mt-5">
                                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                    <ol class="mb-0" type="1">
                                                        <li>
                                                            Level relates to which Membership Type qualifies for the Loyalty Program.
                                                        </li>
                                                        <p>
                                                            <span>P = Platinum</span>
                                                            <span class="px-3">G = Gold</span>
                                                            <span>S = Silver</span>
                                                        </p>
                                                        <li>Value relates to the single transaction by an Advertiser.</li>
                                                    </ol>
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
<script>
    $(document).ready(function(){
        $('#add-new-row').on('click', function(){
            var newRow = `
             <tr role="row">
                <td><select style="border: 0;width:100%">
                        <option value="WA">WA</option>
                        <option value="SA" selected>SA</option>
                    </select>
                </td>
                <td><input name="start" id="start_date" type="date" style="border: 0;width:100%"></td>
                <td><input name="end" id="end_date" type="date" style="border: 0;width:100%"></td>
                <td><select style="border: 0;width:100%">
                        <option value="Platinum">Platinum</option>
                        <option value="Gold" selected>Gold</option>
                        <option value="Silver">Silver</option>
                    </select>
                </td>
                <td><select style="border: 0;width:100%">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
                <td class="d-flex align-items-center">
                    <label class="mb-0">$</label><input name="fee" id="fee" type="text" style="border: 0;width:100%" value="80.00">
                </td>
            </tr>
            `;
            $('#reckoner tbody tr.custom-last-row').before(newRow);
        });
    });
</script>
@endpush
