@extends('layouts.admin')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Reports - Credit</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol>
                  <li>Year to year values are determined by the number of days into the financial year.</li>
                  <li>Total Last Year compared to Current Year.</li>
                  <li>Collective Credits on the books.</li>
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
                  <div><span>{{formatCurrency(stateWalletCredit($currentStart, $currentEndDate))}}</span></div>
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
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Credits </th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th style="border: 1px solid white;" rowspan="2">Total <br> Credits </th>
                     <th colspan="2" style="border: 1px solid white;">Distribution</th>
                  </tr>
                  <tr style="border: 1px solid white;">
                     <th colspan="" style="border: 1px solid white;">Location</th>
                     <th style="border: 1px solid white;">Member</th>
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
                  @foreach($states as $key=>$state)
                  @php
                  $currentYearCreditAmountNow = stateWalletCredit($currentStart, $currentEndDate, $key);
                  $previousYearCreditAmountNow = stateWalletCredit($previousStart, $previousEndDate, $key);

                  $variation = $currentYearCreditAmountNow-$previousYearCreditAmountNow;
                  $variation_percentage = $previousYearCreditAmountNow != 0
                  ? (($currentYearCreditAmountNow - $previousYearCreditAmountNow) / $previousYearCreditAmountNow) * 100
                  : null;

                  $previousYearCreditAmount = stateWalletCredit($previousStart, $previousEnd, $key);

                  $previous_year_variation = $previousYearCreditAmount-$currentYearCreditAmountNow;
                  $previous_year_variation_percentage = $previousYearCreditAmount != 0
                  ? ((previousYearCreditAmount - $currentYearCreditAmountNow) / $currentYearCreditAmountNow) * 100
                  : null;
                  @endphp
                  <tr data-toggle="toggle-row" data-target=".group-{{$key}}" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                        <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>{{$state['stateAbbr']}}</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>
                        <div class="num_value">$ <span>{{formatCurrency($currentYearCreditAmountNow, '' , false)}}</span></div>
                     </td>
                     <td>
                        <div class="num_value">$ <span>{{formatCurrency($previousYearCreditAmountNow, '' , false)}}</span>
                     </td>
                     <td><span class="text-success">
                           <div class="num_value">↑ $ <span>{{formatCurrency($variation, '' , false)}}</span></div>
                        </span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> {{ $variation_percentage !== null ? number_format($variation_percentage, 2) . '%' : 'N/A' }}</span></div>
                        </span></td>
                     <td class="text-right">{{formatCurrency($previousYearCreditAmount, '' , false)}}</td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> {{formatCurrency($previous_year_variation, '' , false)}}</span></div>
                        </span></td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> {{$previous_year_variation_percentage}}</span></div>
                        </span></td>
                     <td>
                        <div class="num_value">$ <span>5,500</span></div>
                     </td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 258</span></div>
                        </span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 21.32</span></div>
                        </span></td>
                  </tr>
                  <!-- middle Content -->
                  
                  @foreach(['3','4'] as $advertiser)
                     @include('admin.management.statistics.include.credit-listing-detail', compact('key', 'advertiser','state','currentStart','currentEndDate','previousStart','previousEndDate','previousEnd'))
                  @endforeach
                  <!-- total -->
                  <tr class="collapse-row group-{{$key}} font-weight-bold">
                     <td></td>
                     <td class="text-right">Total</td>
                     <td class="text-right">{{formatCurrency($currentYearCreditAmountNow, '' , false)}}</td>
                     <td class="text-right">{{formatCurrency($previousYearCreditAmountNow, '' , false)}}</td>
                     <td><span class="text-success">
                           <div class="num_value">↑ <span>{{formatCurrency($variation, '' , false)}}</span></div>
                        </span></span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑ <span>{{ $variation_percentage !== null ? number_format($variation_percentage, 2) . '%' : 'N/A' }}</span></div>
                        </span></span></td>
                     <td class="text-right"><span class="text-danger">{{formatCurrency($previousYearCreditAmount, '' , false)}}</span></td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> {{formatCurrency($previous_year_variation, '' , false)}}</span></div>
                        </span></td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> {{$previous_year_variation_percentage}}</span></div>
                        </span></td>
                     <td></td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 387</span></div>
                        </span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 10.1</span></div>
                        </span></td>

                  </tr>
                  @endforeach
                  <!-- end 1 -->

                  <!-- GROUP 9: Total Summary -->


                  <tr class="font-weight-bold">
                     <td></td>
                     <td class="text-right">Total</td>
                     <td>
                        <div class="num_value">$ <span>4,000</span></div>
                     </td>
                     <td>
                        <div class="num_value">$ <span>2,000</span></div>
                     </td>
                     <td><span class="text-success">
                           <div class="num_value">↑$ <span>250</span></div>
                        </span></span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑ <span>100.0</span></div>
                        </span></span></td>
                     <td class="text-right"><span class="text-danger">36,000</span></td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> 32,000</span></div>
                        </span></td>
                     <td><span class="text-danger">
                           <div class="num_value">↓<span> 88.8</span></div>
                        </span></td>
                     <td>
                        <div class="num_value">$ <span>44,000</span></div>
                     </td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 2,064</span></div>
                        </span></td>
                     <td><span class="text-success">
                           <div class="num_value">↑<span> 170.56</span></div>
                        </span></td>

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
@push('script')

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
      order: [
         [1, 'desc']
      ],
      pageLength: `{{$datatable_entries}}`,
      lengthMenu: `{{config('app.paginate_range')}}`.split(','),
   });
</script>

@endpush