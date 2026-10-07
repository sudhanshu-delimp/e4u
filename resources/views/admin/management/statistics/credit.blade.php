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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content-->
   <div class="row">
      <div class="custom-heading-wrapper col-md-12"><h1 class="h1"> Credits</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
     <div class="col-md-12 ">
         <div class="card collapse  mb-4" id="notes">
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
        <div class="row my-3">
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 d-flex justify-content-end" style="gap: 50px;">
              
                <div class="total_listing">
                    <div><span>Total Credit (CFY) : </span></div>
                    <div><span>{{formatCurrency(stateWalletCredit($currentStart, $currentTodayEnd))}}</span></div>
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
                     <th colspan="7" style="border: 1px solid white;">Year to Year Variation <br>(Days: 158)</th>
                     <th colspan="4" style="border: 1px solid white;">Total Credits<br> (Last FY)</th>
                     <th colspan="4" style="border: 1px solid white;">Actual Credits<br> (Overall)</th>
                  </tr>
                  <tr style="border: 1px solid white;">
                     <th colspan="3" style="border: 1px solid white;">Current</th>
                     <th colspan="2" style="border: 1px solid white;" rowspan="2">Total <br> Last FY</th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th colspan="2" style="border: 1px solid white;" rowspan="2">Total <br> Units </th>
                     <th colspan="2" style="border: 1px solid white;">Variation</th>
                     <th colspan="2" style="border: 1px solid white;" rowspan="2">Total <br> Units </th>
                     <th colspan="2" style="border: 1px solid white;">Overall Growth</th>
                  </tr>
                  <tr style="border: 1px solid white;">
                     <th colspan="" style="border: 1px solid white;">Location</th>
                     <th style="border: 1px solid white;">Member</th>
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
                     <td colspan="15" style="text-align: left; font-weight: bold;">
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>Total Summary</span> <i class="fa fa-chevron-down"></i></div>
                     </td>
                  </tr>
                  @foreach($states as $key=>$state)
                  <!-- GROUP start -->
                   @php 

                     $CFY_Till_Date_Credit = stateWalletCredit($currentStart, $currentTodayEnd, $key);
                     $LFY_Till_Date_Credit = stateWalletCredit($lastStart, $lastTodayEnd, $key);

                     $variation = $CFY_Till_Date_Credit-$LFY_Till_Date_Credit;
                     $variation_percentage = $LFY_Till_Date_Credit != 0 ? (($CFY_Till_Date_Credit - $LFY_Till_Date_Credit) / $LFY_Till_Date_Credit) * 100 : 0;

                     $LFY_Credit = stateWalletCredit($lastStart, $lastEnd, $key);
                     $PFY_Credit = stateWalletCredit($previousStart, $previousEnd, $key);

                     $LFY_variation = $LFY_Credit-$PFY_Credit;
                     $LFY_variation_percentage = $PFY_Credit != 0 ? (($LFY_Credit - $PFY_Credit) / $PFY_Credit) * 100 : 0;

                     $actual_variation = $CFY_Till_Date_Credit-$LFY_Credit;
                     $actual_variation_percentage = $LFY_Credit != 0 ? (($CFY_Till_Date_Credit - $LFY_Credit) / $LFY_Credit) * 100 : 0;
                   @endphp
                  <tr data-toggle="toggle-row" data-target=".group-{{$key}}" data-parent="#collapse-accordion" style="cursor: pointer;">
                     <td>
                           <div class="d-flex align-items-center justify-content-between font-weight-bold"><span>{{$state['stateAbbr']}}</span>
                           <i class="fa fa-chevron-down"></i></div>
                     </td>
                     <td>All</td>
                     <td>{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
                     <td colspan="2">{{formatCurrency($LFY_Till_Date_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($variation, '' , false)}}</td>
                     <td>{{$variation_percentage}}</td>
                     <td colspan="2">{{formatCurrency($LFY_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($LFY_variation, '' , false)}}</td>
                     <td>{{$LFY_variation_percentage}}</td>
                     <td colspan="2">{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($actual_variation, '' , false)}}</td>
                     <td>{{$actual_variation_percentage}}</td>
                  </tr>
                  <!-- middle Content -->
                  @foreach(['3','4'] as $advertiser)
                     @include('admin.management.statistics.include.credit-listing-detail', compact('key', 'states', 'currentStart', 'currentEnd', 'lastStart', 'lastEnd', 'previousStart', 'previousEnd', 'currentTodayEnd','lastTodayEnd'))
                  @endforeach
                  <!-- total -->
                  <tr class="collapse-row group-{{$key}} table-primary font-weight-bold">
                     <td></td>
                     <td>Total</td>
                     <td>{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
                     <td colspan="2">{{formatCurrency($LFY_Till_Date_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($variation, '' , false)}}</td>
                     <td>{{$variation_percentage}}</td>
                     <td colspan="2">{{formatCurrency($LFY_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($LFY_variation, '' , false)}}</td>
                     <td>{{$LFY_variation_percentage}}</td>
                     <td colspan="2">{{formatCurrency($CFY_Till_Date_Credit, '' , false)}}</td>
                     <td >{{formatCurrency($actual_variation, '' , false)}}</td>
                     <td>{{$actual_variation_percentage}}</td>
                  </tr>
                  <!-- end  -->
                   @endforeach
                  <!-- Total Summary -->
                  <tr class="font-weight-bold">
                     <td>

                     </td>
                     <td>Total</td>
                     <td>1,258</td>
                     <td colspan="2">[total]</td>
                     <td>[total]</td>
                     <td>[total]</td>
                     <td colspan="2">[sum]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     <td colspan="2">[sum]</td>
                     <td>[sum]</td>
                     <td>[total]</td>
                     
                  </tr>
               </tbody>

         </table>
         </div>
     </div>

     <div class="col-md-12">
        <div class="timer_section">
               <p>Server time: <span class="serverTime">10:23:51 am</span></p>
               <p>Refresh time:<span class="refreshSeconds"> 15</span></p>
               <p>Up time: <span class="uptimeClass">{{getAppUptime()}}</span></p>
            </div>
       </div>
   </div>
   
   
   <!--right side bar end-->
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

            let countdown = 15;
            setInterval(() => {
                countdown--;
                $(".refreshSeconds").text(' '+countdown);

                if (countdown <= 0) {
                    //$('#escort_listings').DataTable().ajax.reload(null, false);
                    countdown = 15;
                    
                }

            }, 1000);
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

@endpush
