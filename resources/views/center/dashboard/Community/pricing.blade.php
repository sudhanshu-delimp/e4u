@extends('layouts.center')
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
            <div class="container-fluid">
                <!--middle content-->
                <div class="row">
                                   
                    <div class="col-md-12">
                        <div class="v-main-heading h3" style="display: inline-block;"><h1 class="p-0 m-0">Pricing summary</h1></div>
                        <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
                    </div>
                    <div class="col-md-12 my-4">
                        <div class="card collapse" id="notes" style="">
                        <div class="card-body">
                            <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                            <p></p>
                            <ol>
                                    
                            </ol>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="accordion" class="myacording-design">
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                                            Advertising guide
                                            </a>
                                        </div>
                                        <div id="about_me" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        
                                                        <h5 class="price-sec">Profile &amp; Tour Fees</h5>
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead>

                                                                <tr role="row">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                        Profile Name">Days <sup>(1)</sup>
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                        Profile Name
                                                                        ">1
                                                                    </th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">21</th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px;" aria-label="Subscription Type">22<sup>(2)</sup></th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">30</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr role="row">
                                                                    <td>Fee</sup></td>
                                                                    <td>$ 30.00</td>
                                                                    <td>$ 630.00</td>
                                                                    <td>$ 658.50</td>
                                                                    <td>$ 801.00</td>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <div class="card border-0 p-0 mb-0">

                                                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                        <ul class="mb-0">
                                                            <li>Pay by the day available. Pin Up is not available to Massage Centres.</li>
<li>A discount of 5% is applied from day 22 on single transactions only. Daily rate after discount is
applied is $28.50 per day.</li>
                                                        </ul>
</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                                            Other Fees & Concierge Services
                                            </a>
                                        </div>
                                        <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                                    <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                        
                                                        <h5 class="price-sec">Concierge Services & Support Services</h5>
                                                        <table id="myTable price-sec" class="table table-striped dataTable no-footer" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px;" aria-label="Subscription Type">Service Type<sup>(1)</sup></th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">Fee</th>
                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Status">Frequency</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr role="row">
                                                                <tr role="row">
                                                                    <td>NUM Notification </td>
                                                                    <td>$ 5.00 </td>
                                                                    <td>Per month</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Support Services(2) </td>
                                                                    <td>$ 50.00 </td>
                                                                    <td>Per service</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Verified Media(3) </td>
                                                                    <td>$ 10.00 </td>
                                                                    <td>Per service, up to 7 photos</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Mobile SIM </td>
                                                                    <td>$ 85.00 </td>
                                                                    <td>Per month</td>
                                                                </tr>
                                                                <tr role="row">
                                                                    <td>Email account </td>
                                                                    <td>$ 20.00 </td>
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
                                                        <ul class="mb-0">
                                                            <li>An Massage Centre can engage an Agent to undertake any of the Services, otherwise Escorts4U will assist a Massage Centre with support. A Fee applies.
</li>
                                                            <li>Includes any services that Escorts4U undertakes for the Massage Centre, that the Massage Centre could have completed itself online.</li>
                                                            <li>Fee applies to each Masseur. Membership includes Verified Media for the Massage Centre.</li>
                                                        </ul>
</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="card">
                                        <div class="card-header">
                                            <a class="card-link collapsed" data-toggle="collapse" href="#LoyaltyProgram" aria-expanded="false">
                                            Loyalty Program
                                            </a> 
                                        </div>
                                    <div id="LoyaltyProgram" class="collapse" data-parent="#accordion" style="">
                                            <div class="card-body p-0">
                                                <div class="card border-0 mb-0 pb-0">
                                                    <div class="card-body border-0 p-0 mt-2">
                                                        <p>For every $500.00 spent by a Massage Centre, Escorts4U will apply one day of free advertising. When creating your Profile, the program is automatically applied.</p>
                                                    </div>
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
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@endpush