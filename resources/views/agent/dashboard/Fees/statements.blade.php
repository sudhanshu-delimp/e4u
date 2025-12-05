@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">

@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->
  
   <div class="row">
       {{-- Page Heading   --}}
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">Monthly Report</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>
                     The following definitions are from the Agent Agreement and apply for the purpose of calculating the Fee:
                     <ol class="level-2">
                        <li><b>Fees</b> mean the fees calculated pursuant to Item 5 of Schedule 1 and payable pursuant to clause 9.1.</li>
                        <li><b>Monthly Report</b> means the online report summarising all the activities for that
                           month for Signed Up Advertisers which the calculation of the Fees for that month
                           will be based on.</li>
                     </ol>
                  </li>
                  <li>
                     The Fees will be paid to you, by the Operator, within seven Business Days of the
                        Monthly Report having been approved by you, provided:
                        <ol class="level-2">
                           <li>you have confirmed the correctness of the Monthly Report within three days;</li>
                           <li>where a query is raised in respect of the Monthly Report, the Fee corresponding
                        to the Query will be separated from the Report and remain in escrow until the query
                        is resolved (<b>Resolved Query</b>); and</li>
                        <li>a Resolved Query will be included in the following Monthly Report.</li>
                        </ol>
                  </li>
                  <li>All Fees paid to you under the Agent Agreement will be paid into your nominated Bank
                        Account, by the Operator. Fees are inclusive of GST.
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
  <div class="row">
      <div class="col-md-12">
         
         <div class="table-responsive-xl">
            <table class="table table_admin" id="commissionStatementTable">
               <thead class="table-bg">
                  <tr>
                     <th>Report Date</th>
                     <th>Billing Period</th>
                     <th>Agent ID</th>
                     <th>Territory</th>
                     <th>Spend</th>
                     <th>Fees</th>
                     <th>Status</th>
                     <th>Report Approved</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>01-11-2025</td>
                     <td>01-10-2025 to 31-10-2025 </td>
                     <td>A600025</td>
                     <td>WA</td>
                     <td class="text-left"><div class="num_value">$<span>4,749.00</span></div></td>
                     <td class="text-left"><div class="num_value">$<span>237.45</span></div></td>
                     <td>Approved</td>
                     <td>01-11-2025</td>
                     <td>
                        <div class="dropdown no-arrow text-center">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"><i class="fa fa-check-circle"></i> Approve</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#"><i class="fa fa-search-minus"></i>
 Query</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#commission-report"> <i class="fa fa-eye"></i> View Report</a>
                           </div>
                        </div>
                     </td>
                  </tr>
                
               </tbody>
            </table>
            
         </div>
      </div>
   </div>
  </div>
</div>



{{-- View Report --}}

<div class="modal fade upload-modal" id="commission-report" tabindex="-1" role="dialog"
    aria-labelledby="commission-reportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered custom_admin_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">


                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}"
                        class="custompopicon"> Fee Report (Period Ending: 31-10-25)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png') }}" class="opr-close-btn">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0 common_accordian_table">
                    <thead class="table-bg modal-thaed">
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Territory</th>
                            <th>Type</th>
                            <th>Days</th>
                            <th>Spend</th>
                            <th>Fee</th>
                        </tr>
                    </thead>

                    
                     <tbody id="accordionParent">

                        <!-- ========= MEMBER 1 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details1"
                            aria-expanded="false" aria-controls="details1">
                            <td class="text-left">E612344</td>
                            <td class="opr_expand_arrow">Oxe Daisy <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left"><div class="num_value">$<span>683.00</span></div></td>
                            <td class="text-left"><div class="num_value">$<span>34.15</span></div></td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left"><div class="num_value">$<span>176.00</span></div></td>
                            <td class="text-left"><div class="num_value">$<span>8.80</span></div></td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left"><div class="num_value">$<span>24.00</span></div></td>
                            <td class="text-left"><div class="num_value">$<span>1.20</span></div></td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left"><div class="num_value">$<span>8.00</span></div></td>
                            <td class="text-left"><div class="num_value">$<span>0.40</span></div></td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left"><div class="num_value">$<span>475.00</span></div></td>
                            <td class="text-left"><div class="num_value">$<span>23.75</span></div></td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">35
                            </td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                 <div class="num_value">$<span>34.15</div></td></td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <!-- ========= MEMBER 2 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2"
                            aria-expanded="false" aria-controls="details2">
                            <td class="text-left">E612351</td>
                            <td class="opr_expand_arrow">Rose Chaplin <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left"><div class="num_value">$<span>683.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>34.15</div></td>
                        </tr>

                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left"><div class="num_value">$<span>176.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>8.80</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left"><div class="num_value">$<span>24.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>1.20</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left"><div class="num_value">$<span>8.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>0.40</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left"><div class="num_value">$<span>475.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>23.75</div></td>
                        </tr>

                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">35
                            </td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                               <div class="num_value">$<span>34.15</div> </td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Escorts:</strong></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">70
                            </td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,366.00</div></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>68.30</div></td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <!-- ========= MEMBER 3 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details3"
                            aria-expanded="false" aria-controls="details3">
                            <td class="text-left">M612380</td>
                            <td class="opr_expand_arrow">Lin’s Massage <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left"><div class="num_value">$<span>683.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>34.15</div></td>
                        </tr>

                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left"><div class="num_value">$<span>176.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>8.80</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left"><div class="num_value">$<span>24.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>1.20</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left"><div class="num_value">$<span>8.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>0.40</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left"><div class="num_value">$<span>475.00</div></td>
                            <td class="text-left"><div class="num_value">$<span>23.75</div></td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">35
                            </td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                               <div class="num_value">$<span>34.15</div> </td>
                        </tr>

                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Massage Centres:</strong></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">35
                            </td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.15</div></td>
                        </tr>
                    </tbody>
                    <tfoot>
                         <!-- ========= total ========= -->

                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Advertisers:</strong></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">105
                            </td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>2,049.00</div></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>102.45</div></td>
                        </tr>

                    </tfoot>
                </table>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Print</button>
                <button type="button" class="btn-success-modal" data-dismiss="modal">Query</button>
                <button type="button" class="btn-success-modal" data-dismiss="modal">Approve</button>
            </div>
        </div>
    </div>
</div>

{{-- end --}}
@endsection
@push('script')
<!-- file upload plugin start here -->
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
    
    document.querySelectorAll('.accordion-toggle').forEach(toggle => {
        toggle.addEventListener('click', () => {
            const target = toggle.getAttribute('data-target').replace('#', '');
            const openGroup = document.querySelectorAll(`.detail-row[data-group="${target}"]`);
            const isOpen = openGroup[0]?.classList.contains('show');

            // Close all open groups
            document.querySelectorAll('.detail-row.show').forEach(r => {
                r.classList.remove('show');
            });

            // Open current group if not already open
            if (!isOpen) {
                openGroup.forEach(r => r.classList.add('show'));
            }

            // Rotate arrow
            document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
                'rotated'));
            if (!isOpen) toggle.querySelector('i').classList.add('rotated');
        });
    });
</script>
<script>
   $(document).ready(function() {
       $('#commissionStatementTable').DataTable({
           language: {
               search: "_INPUT_",
               searchPlaceholder: "Search By Agent ID",
               sSearch: 'Search:'
           },
           paging: true,
           pageLength: 10,
           lengthMenu: [10, 25, 50, 100],
           info: true,
           searching: true,
           order: [[1, 'asc']],
           columnDefs: [{
            targets: 8,
            orderable: false
        }]
       });
   });
   </script>
   



@endpush