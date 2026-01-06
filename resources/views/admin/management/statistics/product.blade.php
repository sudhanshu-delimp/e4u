@extends('layouts.admin')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">      
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Reports - Product</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
               <div class="card-body">
                  <h3 class="NotesHeader"><b>Notes:</b> </h3>
                  <ol>
                     <li>Year to year values are determined by the number of days into the financial year.</li>                     
                     <li>Total Last Year compared to Current Year.</li>
                     <li>Collective sales on the books.</li>
                  </ol>
               </div>
         </div>
      </div>
      
    <div class="col-md-12">
         <div class="row mb-3">
            <div class="col-lg-4 col-md-12 col-sm-12">
                  
            </div>
            <div class="col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
               
                  <div class="total_listing">
                     <div><span>Total sales (CFY): </span></div>
                     <div><span>$ 500</span></div>
                  </div>
            </div>
         </div>
        <div class="table-responsive membership--inner">
            <table class="table table-bordered text-center mb-0" id="tourStatisticTable">
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
               </colgroup>

               <thead style="background-color: #0c223d; color: white; text-align: center;">
                  <tr style="border: 1px solid white;">
                     <th colspan="6" style="border: 1px solid white;">Year to Year Comparison <br>(Days: 158)</th>
                     <th colspan="3" style="border: 1px solid white;">Total Sales <br> (Last FY)</th>
                     <th colspan="3" style="border: 1px solid white;">Actual Sales <br> (Overall)</th>
                  </tr>
                  <tr style="border: 1px solid white;">
                     <th colspan="3" style="border: 1px solid white;">Current FY</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Last FY</th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Sales </th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Sales </th>
                     <th colspan="2" style="border: 1px solid white;">Distribution</th>
                  </tr>
                  <tr style="border: 1px solid white;">
                     <th colspan="" style="border: 1px solid white;">Location</th>
                     <th style="border: 1px solid white;">Product</th>
                     <th style="border: 1px solid white;">Total</th>
                     <th style="border: 1px solid white;">$</th>
                     <th style="border: 1px solid white;">%</th>
                     <th style="border: 1px solid white;">Units</th>
                     <th style="border: 1px solid white;">%</th>
                     <th style="border: 1px solid white;">Units</th>
                     <th style="border: 1px solid white;">Avg $</th>
                  </tr>
               </thead>
               <tbody id="collapse-accordion">

                  <tr id="hideAlltr">
                     <td colspan="12" style="text-align: left; font-weight: bold;">
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Total Summary</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                  </tr>
                  <!-- GROUP 1: ACT -->
                  <tr data-toggle="toggle-row" data-target=".group-1" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>ACT</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  <!-- middle Content -->
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-1">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-1 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>                  
                  <!-- end 1 -->

                  <!-- GROUP 2: NSW -->
                  <tr data-toggle="toggle-row" data-target=".group-2" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>NSW</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-2">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-2 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>        
                  <!-- end 2 -->

                  <!-- GROUP 3: Vic -->
                  <tr data-toggle="toggle-row" data-target=".group-3" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Vic</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                 
                  <!-- middle Content -->
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-3">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-3 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 3 -->

                  <!-- GROUP 4: Qld -->
                  <tr data-toggle="toggle-row" data-target=".group-4" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Qld</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-4">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-4 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 4 -->

                  <!-- GROUP 5: SA -->
                  <tr data-toggle="toggle-row" data-target=".group-5" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>SA</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-5">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-5 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 5 -->

                  <!-- GROUP 6: WA -->
                  <tr data-toggle="toggle-row" data-target=".group-6" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>WA</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-6">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-6 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 6 -->


                  <!-- GROUP 7: Tas -->
                  <tr data-toggle="toggle-row" data-target=".group-7" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Tas</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-7">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-7 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 7 -->


                  <!-- GROUP 8: NT -->
                  <tr data-toggle="toggle-row" data-target=".group-8" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>NT</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                    <td>All</td>
                     <td><div class="num_value">$ <span>500</span></div> </td>
                     <td><div class="num_value">$ <span>250</span></td>
                     <td><span class="text-success"><div class="num_value">↑ $ <span>250</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 100.0</span></div></span></td>
                     <td class="text-right">4,500</td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td><div class="num_value">$ <span>5,500</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 258</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 21.32</span></div></span></td>
                  </tr>
                  
                  <!-- middle Content -->
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM01</td>
                     <td class="text-right">250</td>
                     <td class="text-right">250</td>
                     <td><span class="text-danger"><div class="num_value">- <span>0</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">- <span>0.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">3,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 3,250</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 7.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 235</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 9.4</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM02</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM03</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM04</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM05</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM06</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM07</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM08</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM09</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  <tr class="collapse-row group-8">
                     <td></td>
                     <td>CM10</td>
                     <td class="text-right">250</td>
                     <td class="text-right">0</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">1,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 750</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 25.0</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 95</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 7.6</span></div></span></td>

                  </tr>
                  
                  <!-- total -->
                  <tr class="collapse-row group-8 font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td class="text-right">5,000</td>
                     <td class="text-right">250</td>
                     <td><span class="text-success"><div class="num_value">↑ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">4,500</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 4,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 11.1</span></div></span></td>
                     <td></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 387</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 10.1</span></div></span></td>

                  </tr>  
                  <!-- end 8 -->

                  <!-- GROUP 9: Total Summary -->
                  

                  <tr class="font-weight-bold">
                     <td></td>
                      <td class="text-right">Total</td>
                     <td><div class="num_value">$ <span>4,000</span></div></td>
                     <td><div class="num_value">$ <span>2,000</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑$ <span>250</span></div></span></span></td>
                     <td><span class="text-success"><div class="num_value">↑ <span>100.0</span></div></span></span></td>
                     <td class="text-right"><span class="text-danger">36,000</span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 32,000</span></div></span></td>
                     <td><span class="text-danger"><div class="num_value">↓<span> 88.8</span></div></span></td>
                     <td><div class="num_value">$ <span>44,000</span></div></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 2,064</span></div></span></td>
                     <td><span class="text-success"><div class="num_value">↑<span> 170.56</span></div></span></td>

                  </tr> 
               </tbody>

            </table>
         </div>
     </div>

     <div class="col-md-12">
        <div class="timer_section">
                <p>Server time: <span>10:23:51 am</span></p>
                <p>Refresh time:<span> seconds</span></p>
                <p>Up time: <span>214 days & 09 hours 12 minutes</span></p>
            </div>
       </div>
   </div>
</div>
@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
  $(document).ready(function() {
            let isHidden = false;

            $('#hideAlltr').on('click', function() {
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

        $(document).ready(function() {
            $('.collapse-row').hide(); // 🔒 Hide all groups initially

            $('[data-toggle="toggle-row"]').on('click', function() {
                const targetClass = $(this).data('target');
                const $icon = $(this).find('i.fa');
                const isVisible = $(targetClass).is(':visible');

                $('.collapse-row').not(targetClass).hide();
                $('[data-toggle="toggle-row"] i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');

                if (!isVisible) {
                    $(targetClass).show();
                    $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                } else {
                    $(targetClass).hide();
                }
            });
        });
</script>
<script>
   var table = $("#profileStatisticTable").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Name..."
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']],
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10
});

 </script>

@endsection