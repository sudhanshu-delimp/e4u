@extends('layouts.admin')
@section('style')
<style>
   td,
   th {
       vertical-align: middle !important;
       text-align: center;
   }
</style>
@endsection
@section('content')
<div class="container-fluid">
   <!--middle content-->
   <div class="row">
      
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block;"><h1> Tours</h1></div>
            <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
     </div>
     <div class="col-md-12 ">
         <div class="card collapse  mb-4" id="notes">
             <div class="card-body">
                 <h3 class="NotesHeader"><b>Notes:</b> </h3>
                 <ol>
                     <li>Values are determined by the number of days into the financial year.</li>
                     <li>Total Last Year compared to Current Year.</li>
                     <li>Total Tours includes Current Year expressed as a percentage deviation.</li>
                     <li>Base equals the total Tours as at the 30th June, for the given period.</li>
                 </ol>
             </div>
         </div>
     </div>
    <div class="col-md-12">
 
        <div class="row my-3">
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
              
                <div class="total_listing">
                    <div><span>Current Tours: : </span></div>
                    <div><span>4,456</span></div>
                </div>
            </div>
        </div>
        <div class="table-responsive membership--inner">
         <table class="table table-bordered text-center mb-0">
             <colgroup>
                 <col style="width: 7%;">
                 <col style="width: 7%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
                 <col style="width: 6%;">
             </colgroup>
 
             <thead style="background-color: #0c223d; color: white; text-align: center;">
                 <tr style="border: 1px solid white;">
                     <th colspan="8" style="border: 1px solid white;">Year to Year Growth <br>(Days: 158)</th>
                     <th colspan="3" style="border: 1px solid white;">Total Tours <br> (Last FY)</th>
                     <th colspan="3" style="border: 1px solid white;">Historical Tours <br> (End of last FY)</th>
                 </tr>
                 <tr style="border: 1px solid white;">
                     <th colspan="5" style="border: 1px solid white;">Current</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Last FY</th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Units </th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Units </th>
                     <th colspan="2" style="border: 1px solid white;">Overall Growth</th>
                 </tr>
                 <tr style="border: 1px solid white;">
                     <th colspan="" style="border: 1px solid white;">Location</th>
                     <th style="border: 1px solid white;">Member</th>
                     <th style="border: 1px solid white;">Current</th>
                     <th style="border: 1px solid white;">Past</th>
                     <th style="border: 1px solid white;">Total</th>
                     <th style="border: 1px solid white;">Units</th>
                     <th style="border: 1px solid white;">%</th>
                     <th style="border: 1px solid white;">Units</th>
                     <th style="border: 1px solid white;">%</th>
                     <th style="border: 1px solid white;">Units</th>
                     <th style="border: 1px solid white;">%</th>
                 </tr>
             </thead>
             <tbody id="collapse-accordion">
               <tr id="hideAlltr">
                  <td colspan="14" style="text-align: left; font-weight: bold; cursor:pointer;" >
                     <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Total Summary</span> <i class="fa fa-chevron-down"></i></div>
                  </td>
               </tr>
                 <!-- GROUP 1: ACT -->
                 <tr data-toggle="collapse" data-target=".group-1" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>ACT</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-1">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-1">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-1">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-1">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- total -->
                 <tr class="collapse group-1 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 1 -->
                 <!-- GROUP 2: NSW -->
                 <tr data-toggle="collapse" data-target=".group-2" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>NSW</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-2">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-2">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-2">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-2">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-2 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 2 -->
 
                 <!-- GROUP 3: Vic -->
                 <tr data-toggle="collapse" data-target=".group-3" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Vic</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-3">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-3">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-3">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-3">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-3 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 3 -->
 
                 <!-- GROUP 4: Qld -->
                 <tr data-toggle="collapse" data-target=".group-4" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Qld</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-4">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-4">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-4">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-4">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-4 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 4 -->
 
                 <!-- GROUP 5: SA -->
                 <tr data-toggle="collapse" data-target=".group-5" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>SA</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-5">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-5">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-5">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-5">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-5 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 5 -->
 
                 <!-- GROUP 6: WA -->
                 <tr data-toggle="collapse" data-target=".group-6" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>WA</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-6">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-6">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-6">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-6">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-6 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 6 -->
 
 
                 <!-- GROUP 7: Tas -->
                 <tr data-toggle="collapse" data-target=".group-7" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Tas</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-7">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-7">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-7">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-7">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-7 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 7 -->
 
 
                 <!-- GROUP 8: NT -->
                 <tr data-toggle="collapse" data-target=".group-8" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                         <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>NT</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <!-- middle Content -->
                 <tr class="collapse group-8">
                     <td></td>
                     <td>Female</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-8">
                     <td></td>
                     <td>Male</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-8">
                     <td></td>
                     <td>Trans</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-8">
                     <td></td>
                     <td>Couple</td>
                     <td>152</td>
                     <td>1,762</td>
                     <td>1,914</td>
                     <td>1,787</td>
                     <td><span class="text-success">↑ 127</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>4,428</td>
                     <td><span class="text-danger">↓ 2,514</span></td>
                     <td><span class="text-danger">↓ 56.8%</span></td>
                     <td>9,410</td>
                     <td><span class="text-success">↑ 1,914</span></td>
                     <td><span class="text-success">↑ 20.3%</span></td>
                 </tr>
                 <tr class="collapse group-8 table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>340</td>
                     <td>1,258</td>
                     <td>3,524</td>
                     <td>3,701</td>
                     <td>3,574</td>
                     <td><span class="text-success">↑ 254</span></td>
                     <td><span class="text-success">↑ 7.1%</span></td>
                     <td>8,856</td>
                     <td><span class="text-danger">↓ 5,028</span></td>
                     <td>18,820</td>
                     <td><span class="text-success">↑ 3,828</span></td>
                     <td><span class="text-success">↑ 40.6</span></td>
                 </tr>
                 <!-- end 8 -->
 
                 <!-- GROUP 9: Total Summary -->
                 <tr class="font-weight-bold">
                     <td>
 
                     </td>
                     <td>Total</td>
                     <td>1,258</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td>[sum]</td>
                     <td>[sum]</td>
                 </tr>
             </tbody>
 
         </table>
 
     </div>
 
        <div class="table-responsive membership--inner">
           
        </div>
     </div>

     <div class="col-md-12">
        <div class="timer_section">
                <p>Server time: <span>[10:23:51 am]</span></p>
                <p>Refresh time:<span> [seconds]</span></p>
                <p>Up time: <span>[214 days & 09 hours 12 minutes]</span></p>
            </div>
       </div>
   </div>
   
   
   <!--right side bar end-->
</div>
@endsection


<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
@section('script')
<script>
  $(document).ready(function () {
    let isHidden = false;

    $('#hideAlltr').on('click', function () {
      const $chevron = $(this).find('i');

      if (!isHidden) {
        // Hide only visible rows, and mark them
        $('#hideAlltr').nextAll('tr:visible').addClass('user-hidden').hide();
        $chevron.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        isHidden = true;
      } else {
        // Show only those rows that were hidden by this action
        $('tr.user-hidden').removeClass('user-hidden').show();
        $chevron.removeClass('fa-chevron-up').addClass('fa-chevron-down');
        isHidden = false;
      }
    });
  });
</script>

@endsection
