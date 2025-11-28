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
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 custom--accordfee">
                <!--middle content-->
                <div class="row">
                    <!-- Page Heading -->
                    <div class="col-md-12 custom-heading-wrapper">
                        <h1 class="h1">
                            Fees & Variables</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                    </div>
                    <div class="col-lg-12">
                        <div class="card collapse  mb-4" id="notes">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>These pricing information pages are a complete summary of all the discounts and
                                        Fees that are applied in the Website when posting a Profile or engaging us to do
                                        any Support Services.</li>
                                    <li>Information is also provided about our loyalty program.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>    
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
                                                <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                        
                                                        <tr role="row" class="custom--row">
                                                            <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                Profile Name">Membership Type
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 212px;" aria-label="
                                                                Profile Name
                                                                ">Frequency
                                                            </th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 158px;" aria-label="Date Created">Rate</th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 206px;" aria-label="Subscription Type">Amount</th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 222px;" aria-label="Subscription Status">%</th>
                                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 113px;" aria-label="Status">Amount<sup>(1)</sup></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>


                                                            @foreach($advertings as $adverting)

                                                                    @if($adverting['id']!= 5)
                                                                        @continue
                                                                    @endif

                                                                <tr role="row">
                                                                    <td>{!! $adverting['memberships']['name'] !!}</td>
                                                                    <td>{{ period_days($adverting['days']) }} </td>
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
                                                <div class="card border-0 p-0 mb-0 notes_adv">
                                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                <!-- <ol class="mb-0" type="1">
                                                    <li>
                                                        Discount only applies:
                                                        <ol type="a" class="custom--substyle">
                                                            <li>to a single transaction; and</li>
                                                            <li>from day 22.</li>
                                                        </ol>
                                                    </li>
                                                    <li>Pay by the day available.</li>
                                                </ol> -->

                                                    <div class="notes" style="margin-left: 10px;">
                                                    
                                                        <p>1. Discount only applies:</p>
                                                        <p style="margin-left: 30px;">(a) to a single transaction; and</p>
                                                        <p style="margin-left: 30px;">(b) from day 22.</p>

                                                        <p>2. Pay by the day available.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!--- Calculater ---->

                                         <div class="table-responsive pl-2 pt-3 list-sec">
                                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">

                                                
                                                <table id="reckoner" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                        <tr role="row">
                                                            <th class="sorting_disabled" rowspan="1" colspan="4" style="width: 212px;" aria-label="Fees">
                                                                <p style="padding-left: 100px;"><b>Profile Ready Reckoner</b></p>
                                                            </th>
                                                            <th class="text-right" colspan="3">
                                                                <button type="button" class="border-0 px-5 py-3 bg-second font-weight-bold" id="add-new-row">Add</button>
                                                                <button type="button" class="border-0 px-5 py-3 bg-second font-weight-bold ml-2" id="reset-reckoner-mc">Reset</button>
                                                            </th>
                                                        </tr>
                                                        <tr role="row" class="custom--row text-center">
                                                            
                                                        
                                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                Start Date
                                                            </th>

                                                             <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                End Date
                                                            </th>

                                                             <th class="sorting_disabled text-center rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                Number of days
                                                            </th>

                                                            

                                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Date Created">
                                                                Membership Type
                                                            </th>

                                                            <!-- <th class="sorting_disabled" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                            Location
                                                            </th> -->

                                                             <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Profile Name">
                                                                    Number of Masseurs
                                                            </th>
                                                    
                                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Status">Fee</th>
                                                            
                                                            <th class="sorting_disabled text-center" rowspan="1" colspan="1"  aria-label="Status">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> </tbody>
                                                    <tfoot></tfoot>  
                                                </table>
                                            </div>
                                        </div>
                                         <!--- End Calculater ---->



                                        <!-- <div class="table-responsive pl-2 pt-3 list-sec">
                                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="5" style="width: 212px;" aria-label="Fees">
                                                            <p><b>Profile / Tour Ready Reckoner</b></p>
                                                        </th>
                                                    </tr>
                                                    <tr role="row" class="custom--row">
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
                                        </div> -->




                                        <div class="card border-0 mb-0 pb-0">
                                            <div class="card-body border-0 p-0 mt-2">
                                                <div class="card border-0 p-0 mb-0">
                                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                                    <ol class="mb-0" type="1">
                                                        <li>
                                                            Use the ready reckoner to calculate the Fee for a Profile.
                                                        </li>
                                                        
                                                        <li>The Fee is inclusive of any discounts that would apply to a single transaction in excess
                                                            of 21 days.</li>
                                                        
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5">
                                            <h3>Changes to this Guide</h3>
                                            <span>
                                                This Guide was last updated {{last_updated_price('pricing')}}.
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
                                                    
                                                                @foreach($fees_concierge_services as $service)
                                                                <tr role="row">
                                                                    <td>{{ $service->service_type }}</td>
                                                                    <td>{{ $service->frequency }}</td>
                                                                    <td>${{ $service->amount }}</td>
                                                                    
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
                                                            These Support Fees relate to E4U providing Support Services to the Massage Centre for completing a request on behalf of the Massage Centre to provide a Concierge Service.
                                                        </li>
                                                        <li>The Support Fee will be billed to the Massage Centre's nominated Card.</li>
                                                        <li>Where a Concierge Service has a recurring Fee, that Fee will be billed to the Massage
                                                            Centre's nominated Card by a single transaction for the term of the Concierge Service.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                            <p><b>Concierge & Support Services</b></p>
                                                        </th>
                                                    </tr>
                                                    <tr role="row" class="custom--row">
                                                        <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                            Service Type <sup>(1)</sup>
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
                                                            A Massage Centre can engage an Agent to undertake any of the Services, otherwise E4U will assist Massage Centres with support. A Fee applies.
                                                        </li>
                                                        <li>Platinum and Gold Membership includes Verified Media.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <h3>Changes to this Guide</h3>
                                            <span>
                                                This Guide was last updated 16-06-2025.
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
                                                <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
                                                    <thead class="text-center">
                                                    <tr role="row">
                                                        <th class="sorting_disabled" rowspan="1" colspan="3" style="width: 212px;" aria-label="Fees">
                                                            <p><b>Other Support Fees - Support Services</b></p>
                                                        </th>
                                                    </tr>
                                                    <tr role="row" class="custom--row">
                                                        <th class="sorting_disabled text-left" rowspan="1" colspan="1" style="width: 212px;" aria-label="Profile Name">
                                                            Fee
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
                                                                 @foreach($fees_support_services as $support_services)
                                                                   @if($support_services['id']== 3 || $support_services['id']==4)
                                                                        @continue
                                                                    @endif
                                                                <tr role="row">
                                                                    <td>{{ $support_services->fee }}</td>
                                                                    <td>{{ $support_services->frequency }}</td>
                                                                    <td>${{ $support_services->amount }}</td>
                                                                    
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
                                                            These Support Fees relate to E4U providing Support Services to the Massage Centre for completing a request on behalf of the Massage Centre to provide a Support Service.
                                                        </li>
                                                        <li>The Support Fee will be billed to the Massage Centre's nominated Card.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <h3>Changes to this Guide</h3>
                                            <span>
                                                This Guide was last updated {{last_updated_price('fees_support_services')}}.
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
                                        <div class="table-responsive pl-2 pt-3 list-sec" id="sailorTableArea">
                                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                                <table id="myTable price-sec" class="table table-striped dataTable no-footer custom--table-suport" width="100%" role="grid" aria-describedby="myTable_info" style="width: 100%;">
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

                                                             @foreach($variablLoyaltyProgram as $variablLoyalty)

                                                                @if($variablLoyalty['id']!= 2)
                                                                        @continue
                                                                    @endif

                                                                <tr role="row">
                                                                    <td>{{ $variablLoyalty->type }}</td>
                                                                    <td>{{ $variablLoyalty->level }}</td>
                                                                    <td>{{ $variablLoyalty->discription }}</td>
                                                                    <td>${{ $variablLoyalty->amount }}</td>
                                                                    <td>{{ $variablLoyalty->reward }}</td>
                                                                    
                                                                    
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
                                                            Level relates to which Membership Type qualifies for the Loyalty Program.
                                                        </li>
                                                        <li>To qualify for the reward, the Massage Centre must undertake a single transaction.</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5">
                                            <h3>Changes to this Guide</h3>
                                            <span>
                                                This Guide was last updated {{last_updated_price('variabl_loyalty_programs')}}.
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
        </div>
    </div>
</div>

<div class="modal upload-modal fade" id="membershipModal" tabindex="-1">
   <div class="modal-dialog modal-lg modal-dialog-centered">
     <div class="modal-content">
       
       <!-- Modal Header -->
       <div class="modal-header">
         <h5 class="modal-title text-white">
           <img src="{{ asset('assets/dashboard/img/add-profile.png') }}" class="custompopicon"> 
           Profile Ready Reckoner
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
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" name="cal_start_date" id="cal_start_date">
                    <div class="invalid-feedback d-none">Start date is required or invalid.</div>                              
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" name="cal_end_date" id="cal_end_date">
                <div class="invalid-feedback d-none">End date is required or invalid.</div>
                </div>

                <div class="col-md-4">
                <label for="end_date" class="form-label">Number of Masseurs</label>
                <select  class="form-control" name="cal_members" id="cal_members">
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                </div>


            </div>

           

           <!-- Start Date & End Date in one row -->
           <div class="row g-3 mb-3">
             
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



@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>



<script>

    
    $(document).ready(function(){
            $('#add-new-row').on('click', function() {
                var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
                modal.show();
            });

            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="6" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();

            $('#add-new-row').on('click', function () {
                setNextStartDate();
                var modal = new bootstrap.Modal(document.getElementById('membershipModal'));
                modal.show();
                
            });

            $('#start_date, #end_date').on('input change', function () {
                $(this).removeClass('input-error');
                $(this).siblings('.invalid-feedback').addClass('d-none');
            });

    });


    // ############ Calculater ###########

   $(document).ready(function() {

    
    function formatForInput(dateObj) {
        const y = dateObj.getFullYear();
        const m = String(dateObj.getMonth() + 1).padStart(2, '0');
        const d = String(dateObj.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    
    function parseDisplayDate(str) {
        if (!str) return null;
        str = String(str).trim();

        // ISO yyyy-mm-dd or yyyy-mm-ddTHH:MM:SS
        const isoMatch = str.match(/^(\d{4})-(\d{2})-(\d{2})/);
        if (isoMatch) {
            return new Date(Number(isoMatch[1]), Number(isoMatch[2]) - 1, Number(isoMatch[3]));
        }

        // dd-mm-yyyy
        const dmy = str.match(/^(\d{2})-(\d{2})-(\d{4})/);
        if (dmy) {
            return new Date(Number(dmy[3]), Number(dmy[2]) - 1, Number(dmy[1]));
        }

        // mm/dd/yyyy
        const mdy = str.match(/^(\d{2})\/(\d{2})\/(\d{4})/);
        if (mdy) {
            return new Date(Number(mdy[3]), Number(mdy[1]) - 1, Number(mdy[2]));
        }

        // fallback: try Date constructor
        const d = new Date(str);
        return isNaN(d.getTime()) ? null : d;
    }

   
    function getLastRowEndDate() {
        const lastRow = $('#reckoner tbody tr').not('.blank-row').last();
        if (!lastRow.length) return null;
        const endText = lastRow.find('td').eq(1).text().trim();
        return parseDisplayDate(endText);
    }

    
    $('#membershipModal').on('show.bs.modal', function () {
        const lastEnd = getLastRowEndDate();

       

    if (!lastEnd) {
        let today = new Date();
        let todayStr = formatForInput(today);

        $('#start_date')
            .attr('min', todayStr)
            .val(todayStr);

        $('#end_date')
            .attr('min', todayStr)
            .val(todayStr);

    } else {
        
        const nextDay = new Date(lastEnd);
        nextDay.setDate(nextDay.getDate() + 1);
        const nextStr = formatForInput(nextDay);

        $('#start_date')
            .attr('min', nextStr)
            .val(nextStr);

        $('#end_date')
            .attr('min', nextStr)
            .val(nextStr);
    }


        // Clear any validation UI if you have
        $('#start_date, #end_date').removeClass('input-error');
        $('#start_date, #end_date').siblings('.invalid-feedback').addClass('d-none');
    });


    // ======= SUBMIT (with client-side check against min) =======
    $('#membershipModal form').on('submit', function (e) {
        e.preventDefault();

        // client-side validation against min and start <= end
        const startVal = $('#start_date').val(); // yyyy-mm-dd
        const endVal = $('#end_date').val();     // yyyy-mm-dd
        const minVal = $('#start_date').attr('min'); // may be undefined

        let hasError = false;
        $('#start_date, #end_date').removeClass('input-error');
        $('#start_date, #end_date').siblings('.invalid-feedback').addClass('d-none');

        if (!startVal) {
            $('#start_date').addClass('input-error');
            $('#start_date').siblings('.invalid-feedback').removeClass('d-none').text('Start date is required.');
            hasError = true;
        } else if (minVal && startVal < minVal) {
            $('#start_date').addClass('input-error');
            $('#start_date').siblings('.invalid-feedback').removeClass('d-none').text('Start date must be after previous add-on end date.');
            hasError = true;
        }

        if (!endVal) {
            $('#end_date').addClass('input-error');
            $('#end_date').siblings('.invalid-feedback').removeClass('d-none').text('End date is required.');
            hasError = true;
        } else if (endVal < startVal) {
            $('#end_date').addClass('input-error');
            $('#end_date').siblings('.invalid-feedback').removeClass('d-none').text('End date cannot be earlier than start date.');
            hasError = true;
        }

        if (hasError) return;

       
        let formData = {
            location: 1,
            start_date: startVal,
            end_date: endVal,
            membership_id: 5,
            members: 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: "{{route('centre.reckoner-calculate')}}",
            type: "POST",
            data: formData,
            success: function (response) {

                const data = {
                    locationText: $('#state option:selected').text(),
                    startFormatted: response.start_formatted,
                    endFormatted: response.end_formatted,
                    membershipName: response.membership_name,
                    members: $('#cal_members').val(),
                    fee: response.fee,
                    days: response.days,
                    locationValue: $('#state').val()
                };

                // Remove blank row
                $('#reckoner tbody tr.blank-row').remove();

                // Add new row
                $('#reckoner tbody').append(buildDataRow(data));

                // Update total footer
                updateTotal();

                // Reset modal form
                $('#membershipModal form')[0].reset();

                // Close modal
                $('#membershipModal .close').trigger('click');
            },
            error: function (xhr) {
                console.log(xhr.responseJSON || xhr);
                alert("Validation Error");
            }
        });
    });



    // ============================
    // BUILD ROW HTML (unchanged)
    // ============================
    function buildDataRow({ locationText, startFormatted, endFormatted, membershipName, members, fee, days, locationValue }) {
        return `
            <tr data-location="${locationValue}">
               
                <td class="text-center">${startFormatted}</td>
                <td class="text-center">${endFormatted}</td>
                <td class="text-center">${days}</td>
                <td class="text-center">${membershipName}</td>
                <td class="text-center">${members}</td>
                <td class="text-center">
                    <input type="hidden" class="row-fee" value="${fee}">
                    $${fee}
                </td>

                <td class="text-center">
                    <button type="button" class=" btn-danger btn-sm remove-row">Remove</button>
                </td>
            </tr>
        `;
    }



    // ============================
    // UPDATE TOTAL FEES (unchanged)
    // ============================
    function updateTotal() {
        let total = 0;
        let rows = $('#reckoner tbody tr').not('.blank-row');

        if (rows.length === 0) {
            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="7" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();
            return;
        }

        rows.each(function () {
            let feeString = $(this).find('.row-fee').val();
            let cleanString = feeString.replace(/,/g, '');
            total += parseFloat(cleanString) || 0;
            console.log('total===',total);
        });

        $('#reckoner tfoot').html(`
            <tr class="custom-last-row">
                <td colspan="6" class="text-right font-weight-bold">Total Fees:</td>
                <td  class="font-weight-bold text-center">$${total.toFixed(2)}</td>
            </tr>
        `).show();
    }


    $('#reckoner').on('click', '.remove-row', function () {
        $(this).closest('tr').remove();
        updateTotal();
    });

   
    (function init() {
        // if there are no rows pre-existing, show blank
        if ($('#reckoner tbody tr').not('.blank-row').length === 0) {
            $('#reckoner tbody').html(`
                <tr class="blank-row">
                    <td colspan="7" class="text-center text-muted">No Profile Added.</td>
                </tr>
            `);
            $('#reckoner tfoot').hide();
        } else {
            updateTotal();
        }
    })();


    $('#reset-reckoner-mc').on('click', function () {
        resetReckoner();
    });

    function resetReckoner() {
    
    $('#reckoner tbody').html(`
        <tr class="blank-row">
            <td colspan="7" class="text-center text-muted">No Profile Added.</td>
        </tr>
    `);

    // Hide footer totals
    $('#reckoner tfoot').hide().empty();

    // Reset form fields
    $('#membershipModal form')[0].reset();
    $('#start_date, #end_date').removeAttr('min');

    // Reset date pickers → set today's date
    const today = new Date();
    const y = today.getFullYear();
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const d = String(today.getDate()).padStart(2, '0');
    const todayStr = `${y}-${m}-${d}`;

    $('#start_date').val(todayStr).attr('min', todayStr);
    $('#end_date').val(todayStr).attr('min', todayStr);

   
}
    

});   
</script>

@endpush