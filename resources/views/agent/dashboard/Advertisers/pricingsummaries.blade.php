@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
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
.remove-row{
padding: 2px 8px 2px 8px !important;
}   

.input-error {
        border-color: #dc3545 !important;  /* Bootstrap danger red */
        background-color: #f8d7da !important;
    }

    .input-error::placeholder {
        color: #721c24 !important;
    }

</style>
@endsection
@section('content')
<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 custom--accordfee">
                <!--middle content-->
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1"> Pricing summary</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>

                    </div>
                    <div class="col-md-12">                                
                        <div class="card collapse  mb-4" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>There are a range of Fees that apply to Advertisers, namely:</li>
                                        <ol class="level-2">
                                            <li>Advertising Fees.</li>
                                            <li>Concierge Services.</li>
                                            <li>Support Services.</li>
                                        </ol>
                                    <li>There is a loyalty program which also applies to Advertisers.</li>
                                    <li>There are a range of variables that determine:</li>
                                    <ol class="level-2">
                                        <li>Discounts to Advertising Fees.</li>
                                        <li>Loyalty Program entitlements and discounts.</li>
                                    </ol>
                                    <li>All amounts are exclusive of GST.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
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

                                                            @foreach($advertings as $adverting)
                                                                <tr role="row">
                                                                    <td>{!! $adverting['memberships']['name'] !!}</td>
                                                                    <td>{{ $adverting['days'] }}</td>
                                                                    <td>{{ $adverting['frequency'] }}</td>
                                                                    <td>${{ number_format($adverting['price'], 2) }}</td>
                                                                    <td>
                                                                        @if(!empty($adverting['percentage']))
                                                                            {{ $adverting['percentage'] }}
                                                                        @else
                                                                            N/A
                                                                        @endif
                                                                    </td>
                                                                    <td>${{ number_format($adverting['discount_amount'], 2) }}</td>
                                                                </tr>
                                                            @endforeach 
                                                        
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

                                                {{--  <h5 class="price-sec">Profile &amp; Tour Fees</h5>--}}
                                                <table id="reckoner" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr role="row">
                                                            <th class="sorting_disabled" rowspan="1" colspan="7" style="width: 212px;" aria-label="Fees">
                                                                <p style="padding-left: 100px;"><b>Profile / Tour Ready Reckoner</b></p>
                                                            </th>
                                                            <th>
                                                                <button type="button" class="border-0 px-5 py-3 bg-second font-weight-bold" id="add-new-row">Add</button>
                                                            </th>
                                                        </tr>
                                                        <tr role="row" class="custom--row text-left">
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                            Location
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                Start Date
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                End Date
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Date Created">
                                                                Membership Type
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Subscription Status">Profiles</th>
                                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Status">Fee</th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Status">Days</th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Status"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        <!-- <tr class="custom-last-row">
                                                            <td class="border-0"></td>
                                                             <td class="border-0"></td>
                                                            <td class="border-0"></td>
                                                            <td class="border-0"></td>
                                                            <td class="border-0"></td>
                                                            <td  class="font-weight-bold text-right">Total Fees:</td>
                                                            <td class="font-weight-bold text-left"><span>$</span>146.00</td>
                                                        </tr> -->

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
                <!--middle content end here-->
                <!--right side bar start from here-->
                </div>
            </div>
        </div>
    </div>
</div>








@include('escort.dashboard.partials.playmates-modal')







<div class="modal upload-modal fade" id="membershipModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       
       <!-- Modal Header -->
       <div class="modal-header">
         <h5 class="modal-title text-white">
           <img src="{{ asset('assets/dashboard/img/add-profile.png') }}" class="custompopicon"> 
           Profile / Tour Ready Reckoner
         </h5>
         <button type="button" class="close" data-dismiss="modal">
           <span aria-hidden="true">
             <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
           </span>
         </button>
       </div>

       <!-- Modal Body -->
       <div class="modal-body">
         <form>
           
           <!-- State -->
           <div class="row g-3 mb-3">

                <div class="col-md-4">
                    <label>Location</label>
                    <select id="state" name="state" class="form-control">
                    @foreach($states as $stateCode => $stateData)
                        <option value="{{ $stateCode }}">{{ $stateData['stateAbbr'] }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" name="cal_start_date" id="cal_start_date">
                    <div class="invalid-feedback d-none">Start date is required or invalid.</div>                              
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" name="cal_end_date" id="cal_end_date">
                <div class="invalid-feedback d-none">End date is required or invalid.</div>
                </div>


            </div>

           

           <!-- Start Date & End Date in one row -->
           <div class="row g-3 mb-3">
             
           </div>


           <!-- Start Date & End Date in one row -->
           <div class="row g-3 mb-3">
             <div class="col-md-6">
               <label for="start_date" class="form-label">Membership Type </label>
              <select  class="form-control" name="cal_memship_type" id="cal_memship_type">
                 @foreach($membership_types as $membership)
                 <option value="{{ $membership['id'] }}">{{ $membership['name'] }}</option>
                @endforeach  
            </select>
             </div>
             <div class="col-md-6">
               <label for="end_date" class="form-label">Profile</label>
               <select  class="form-control" name="cal_members" id="cal_members">
                  @foreach($no_of_members as $key => $members)
                  <option value="{{ $members }}">{{ $members }}</option>
                    @endforeach  
                </select>
             </div>
           </div>

        
           <!-- Save Button -->
           <div class="text-right">
             <button type="submit" class="btn btn-primary create-tour-sec dctour m-0">Add</button>
           </div>

         </form>
       </div>

     </div>
   </div>
</div>







 @endsection


 @push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function(){
    
        // $('#add-new-row').on('click', function(){
        //     var newRow = `
        //      <tr role="row">
        //         <td><select style="border: 0;width:100%">
        //                 <option value="WA">WA</option>
        //                 <option value="SA" selected>SA</option>
        //             </select>
        //         </td>
        //         <td><input name="start" id="start_date" type="date" style="border: 0;width:100%"></td>
        //         <td><input name="end" id="end_date" type="date" style="border: 0;width:100%"></td>
        //         <td><select style="border: 0;width:100%">
        //                 <option value="Platinum">Platinum</option>
        //                 <option value="Gold" selected>Gold</option>
        //                 <option value="Silver">Silver</option>
        //             </select>
        //         </td>
        //         <td><select style="border: 0;width:100%">
        //                 <option value="1">1</option>
        //                 <option value="2">2</option>
        //                 <option value="3">3</option>
        //             </select>
        //         </td>
        //         <td class="d-flex align-items-center">
        //             <label class="mb-0">$</label><input name="fee" id="fee" type="text" style="border: 0;width:100%" value="80.00">
        //         </td>
        //     </tr>
        //     `;
        //     $('#reckoner tbody tr.custom-last-row').before(newRow);
        // });


    $('#add-new-row').on('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
        modal.show();
    });

});




 // ############ Calculater ###########

   $(document).ready(function() {

    

    var usedDates = [];
    var usedLocations = [];
    var lastEndDate = null; // Track the last end date

    function addBlankRow() {
        $('#reckoner tbody tr.blank-row').remove();
        var blankRow = `
            <tr class="blank-row">
                <td colspan="8" class="text-center text-muted">No Profile Added.</td>
            </tr>
        `;
        $('#reckoner tbody').prepend(blankRow);
    }

    // Set next available start date after last added end date
    function setNextStartDate() {
        var nextStart;

        if (lastEndDate) {
            nextStart = new Date(lastEndDate);
            nextStart.setDate(nextStart.getDate() + 1); // +1 day after last end date
        } else {
            nextStart = new Date();
        }

        nextStart.setHours(0, 0, 0, 0);

        var yyyy = nextStart.getFullYear();
        var mm = String(nextStart.getMonth() + 1).padStart(2, '0');
        var dd = String(nextStart.getDate()).padStart(2, '0');
        var nextStartStr = `${yyyy}-${mm}-${dd}`;

        // Set min and value for start_date and end_date
        $('#start_date').attr('min', nextStartStr).val(nextStartStr);
        $('#end_date').attr('min', nextStartStr).val(nextStartStr);
    }

    addBlankRow();
    updateTotal();
    setNextStartDate();

    $('#start_date, #end_date').on('input change', function () {
        $(this).removeClass('input-error');
        $(this).siblings('.invalid-feedback').addClass('d-none');
    });

    // Open modal event - always set correct next start date
    $('#add-new-row').on('click', function () {
        setNextStartDate();
        var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
        modal.show();
    });

    $('#membershipModal form').on('submit', function (e) {
        e.preventDefault();

        var startDateInput = $('#start_date');
        var endDateInput = $('#end_date');
        var stateSelect = $('#state');

        var stateText = stateSelect.find('option:selected').text();
        var stateValue = stateSelect.val();
        var startDate = startDateInput.val();
        var endDate = endDateInput.val();
        var membershipType = $('#cal_memship_type').val();
        var members = parseInt($('#cal_members').val()) || 1;

        var advertings = @json($advertings);
        var hasError = false;

        startDateInput.removeClass('input-error');
        endDateInput.removeClass('input-error');
        startDateInput.siblings('.invalid-feedback').addClass('d-none');
        endDateInput.siblings('.invalid-feedback').addClass('d-none');

        if (!startDate) {
            startDateInput.addClass('input-error');
            startDateInput.siblings('.invalid-feedback').removeClass('d-none').text('Start date is required.');
            hasError = true;
        }
        if (!endDate) {
            endDateInput.addClass('input-error');
            endDateInput.siblings('.invalid-feedback').removeClass('d-none').text('End date is required.');
            hasError = true;
        }
        if (!hasError && new Date(endDate) < new Date(startDate)) {
            startDateInput.addClass('input-error');
            endDateInput.addClass('input-error');
            endDateInput.siblings('.invalid-feedback').removeClass('d-none').text('End date cannot be earlier than start date.');
            hasError = true;
        }
        if (!hasError && usedLocations.includes(stateValue)) {
            hasError = true;
            stateSelect.addClass('input-error');
        }

        if (hasError) return;



        var start = new Date(startDate);
        var end = new Date(endDate);
        var days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;

       

        var selectedAd = advertings.find(ad => ad.membership_id === membershipType);

         console.log('membershipType',membershipType);
         console.log('selectedAd',selectedAd.price);
         let membershipTypeName = selectedAd.memberships?.name;

        var rate = selectedAd.discount_amount  ?? selectedAd.price;
        var fee = 0;
        if (selectedAd.frequency.toLowerCase().includes('1')) {
            fee = rate * days * members;
        } else if (selectedAd.frequency.toLowerCase().includes('2')) {
            var weeks = Math.ceil(days / 7);
            fee = rate * weeks * members;
        } else {
            fee = rate * days * members;
        }
        fee = fee.toFixed(2);

        // Track used locations and dates
        usedLocations.push(stateValue);
        stateSelect.find(`option[value="${stateValue}"]`).remove();
        usedDates.push(startDate, endDate);

        // Save this as the last end date
        lastEndDate = endDate;

        // Add new row
        var newRow = `
            <tr data-location="${stateValue}">
                <td>${stateText}</td>
                <td>${getFirstDayOfYear(startDate) }</td>
                <td>${getFirstDayOfYear(endDate) }</td>
                <td>${membershipTypeName}</td>
                <td>${members}</td>
                
                <td style="width:20%">
                   
                    <input type="hidden" class="border-0" value="${fee}"  >
                    ${fee}
                </td>
                <td>${days}</td>
                <td>

                        <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>

                       

                   
                </td>
            </tr>
        `;

        // $('#reckoner tbody tr.blank-row').remove();
        // $('#reckoner tbody').prepend(newRow);

        $('#reckoner tbody tr.blank-row').remove();
        if ($('#reckoner tbody tr.custom-last-row').length > 0) {
            $(newRow).insertBefore('#reckoner tbody tr.custom-last-row');
        } else {
            $('#reckoner tbody').append(newRow);
        }

        updateTotal();
        $(this)[0].reset();

        // Hide modal (Bootstrap 4)
        //$('#membershipModal').modal('hide');
        $('#membershipModal .close').trigger('click');
    });

    // Remove row and restore location
    $('#reckoner').on('click', '.remove-row', function () {
        var row = $(this).closest('tr');
        var locationValue = row.data('location');
        var locationText = row.find('td:first').text();
        var endDate = row.find('td:nth-child(3)').text();

        usedLocations = usedLocations.filter(l => l !== locationValue);
        usedDates = usedDates.filter(d => d !== endDate);

        // Restore the location option
        $('#state').append(`<option value="${locationValue}">${locationText}</option>`);

        // If this was the last row, clear lastEndDate
        if ($('#reckoner tbody tr').not('.blank-row, .custom-last-row').length === 1) {
            lastEndDate = null;
        }

        row.remove();
        updateTotal();
        setNextStartDate();
    });

    function updateTotal() {
        var total = 0;
        var rowCount = 0;

        $('#reckoner tbody tr').not('.custom-last-row, .blank-row').each(function () {
            var feeVal = parseFloat($(this).find('input').val()) || 0;
            total += feeVal;
            rowCount++;
        });

        if (rowCount === 0) {
            $('#reckoner tbody tr.custom-last-row').remove();
            addBlankRow();
        } else {
            if ($('#reckoner tbody tr.custom-last-row').length === 0) {
                var totalRow = `
                    <tr class="custom-last-row">
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="border-0"></td>
                        <td class="font-weight-bold">Total Fees:</td>
                        <td class="font-weight-bold text-center"><span>$</span>${total.toFixed(2)}</td>
                    </tr>
                `;
                $('#reckoner tbody').append(totalRow);
            } else {
                $('#reckoner tbody tr.custom-last-row td:last').html('<span>$</span>' + total.toFixed(2));
            }
        }
    }


    function getFirstDayOfYear(inputDate) 
    {
        var dateObj;

        if (typeof inputDate === "string" || inputDate instanceof String) {
            dateObj = new Date(inputDate);
        } else if (inputDate instanceof Date) {
            dateObj = inputDate;
        } else {
            throw new Error("Invalid input. Provide a date string or Date object.");
        }

        if (isNaN(dateObj.getTime())) {
            throw new Error("Invalid date format.");
        }
        var day = String(dateObj.getDate()).padStart(2, '0');
        var month = String(dateObj.getMonth() + 1).padStart(2, '0'); 
        var year = dateObj.getFullYear();
        return day + "-" + month + "-" + year;
    }


});






    // ############# End Calculater ###########

   
</script>
@endpush



