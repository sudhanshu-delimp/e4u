@extends('layouts.operator')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5 opr-console">
    {{-- Page Heading --}}
    <div class="row">
        <div class="col-md-12 operator-heading-wrapper">
            <h1 class="h1">Monthly Report</h1>
            <span class="oprhelpNote" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="notes"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                        <li>The following definitions are from the Agent Agreement and apply for the purpose of
                            calculating the Fee:
                            <ol class="level-2">
                                <li>Fees mean the fees calculated pursuant to Item 5 of Schedule 1 and payable
                                    pursuant to clause 9.1.
                                </li>
                                <li>Monthly Report means the online report summarising all the activities for that
                                    month for Signed Up Advertisers which the calculation of the Fees for that month
                                    will be based on.
                                </li>
                            </ol>
                        </li>
                        <li>The Fees are paid to the Operator upon the Agent having approved them. Where there
                            is a query raised by an Agent in respect of the Monthly Report, the Fee corresponding
                            to the Query will be separated from the Report and remain in escrow until the query is
                            resolved.
                        </li>
                        <li>Fees are inclusive of GST.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-12 mt-2">
                    <div id="table-sec" class="table-responsive-xl">
                        <table class="table my_opr_table" id="AgentReportTable">
                            <thead class="table-bg">
                                <tr>
                                    <th>Date Issued</th>
                                    <th>Billing Period</th>
                                    <th>Agent ID</th>
                                    <th>Territory</th>
                                    <th>Fees</th>
                                    <th>Date Agent Approved</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01-11-2025</td>
                                    <td>01-10-25 to 31-10-25</td>
                                    <td>A600025</td>
                                    <td>WA</td>
                                    <td>$ 237.45</td>
                                    <td>Agent Approved</td>
                                    <td>04-11-2025</td>
                                    <td>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container"><a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification"
                                                       >
                                                    </a>
                                                    <a class="dropdown-item align-item-custom" data-toggle="modal" data-target="#payAgentreport" href=""> <i class="fa fa-star"
                                                            aria-hidden="true"></i>
                                                        Pay</a>
                                                    <div class="dropdown-divider"></div>
                                                </div>

                                                <div class="custom-tooltip-container">
                                                    <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#viewAgentreport"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View Report</a>
                                                </div>
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
</div>
{{-- Payment Authorisation --}}

<div class="modal fade upload-modal" id="payAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="payAgentreportLabel" aria-hidden="true" 
    data-backdrop="static" 
    data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <!-- Header -->


            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/change-security.png') }}" class="custompopicon">
                    Payment Authorisation
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 20px;">

                <table class="w-100 table opr_modal_table">
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Agent ID:</td>
                        <td>A600025</td>
                        <td style="font-weight: bold; color: #001f4d;">Date:</td>
                        <td>01-10-25</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Fee Total:</td>
                        <td>$237.45</td>
                        <td style="font-weight: bold; color: #001f4d;">Month:</td>
                        <td>Oct</td>
                    </tr>
                </table>

                <p>
                    The Fee for the month is authorised for payment into the
                    Operator’s nominated Bank Account for the Agent.
                </p>

                <p style="margin-top: 25px;">
                    Managing Director: <span style="display: inline-block; border-bottom: 1px solid #000; width: 200px;"></span>
                </p>

                <hr style="margin: 20px 0;">

                <div style="text-align: center;">
                   
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button> 
                    
                    <button type="button" class="btn-success-modal">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>  

{{-- end --}}

{{-- View Report --}}

<div class="modal fade upload-modal" id="viewAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="viewAgentreportLabel" aria-hidden="true" 
    data-backdrop="static" 
    data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="{{ asset('assets/dashboard/img/monthly-report.png') }}" class="custompopicon">
                    Fee Report - Member ID A600025 (Period Ending: 01-10-25 to 31-10-25)
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </span>
                </button>
            </div>

           <div class="modal-body">

                <table class="table table-bordered mb-0 opr_accordian_table">
                    <thead class="table-bg">
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
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details1" aria-expanded="false" aria-controls="details1">
                        <td>E612344</td>
                        <td class="opr_expand_arrow">Oxe Daisy <i class="fa fa-chevron-down"></i></td>
                        <td>WA</td>
                        <td></td>
                        <td>35</td>
                        <td class="text-left">$683.00</td>
                        <td class="text-left">$34.15</td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details1">
                        <td></td><td></td><td></td><td>P</td><td>22</td><td class="text-left">$176.00</td><td class="text-left">$8.80</td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                        <td></td><td></td><td></td><td>G</td><td>4</td><td class="text-left">$24.00</td><td class="text-left">$1.20</td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                        <td></td><td></td><td></td><td>S</td><td>2</td><td class="text-left">$8.00</td><td class="text-left">$0.40</td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                        <td></td><td></td><td></td><td>PU</td><td>7</td><td class="text-left">$475.00</td><td class="text-left">$23.75</td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                        <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">35</td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">$683.00</td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">$34.15</td>
                        </tr>

                        <!-- ========= MEMBER 2 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2" aria-expanded="false" aria-controls="details2">
                        <td>E612351</td>
                        <td class="opr_expand_arrow">Rose Chaplin <i class="fa fa-chevron-down"></i></td>
                        <td>WA</td>
                        <td></td>
                        <td>35</td>
                        <td class="text-left">$683.00</td>
                        <td class="text-left">$34.15</td>
                        </tr>

                        <tr class="detail-row" data-group="details2">
                        <td></td><td></td><td></td><td>P</td><td>22</td><td class="text-left">$176.00</td><td class="text-left">$8.80</td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                        <td></td><td></td><td></td><td>G</td><td>4</td><td class="text-left">$24.00</td><td class="text-left">$1.20</td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                        <td></td><td></td><td></td><td>S</td><td>2</td><td class="text-left">$8.00</td><td class="text-left">$0.40</td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                        <td></td><td></td><td></td><td>PU</td><td>7</td><td class="text-left">$475.00</td><td class="text-left">$23.75</td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                        <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">35</td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">$683.00</td>
                        <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">$34.15</td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Print</button>
            </div>
        </div>
    </div>
</div>

{{-- end --}}
@endsection
@section('script')
<!-- opr_accordian_table JS -->
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
      document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove('rotated'));
      if (!isOpen) toggle.querySelector('i').classList.add('rotated');
    });
  });
</script>

<script>
    var table = $("#AgentReportTable").DataTable({
        language: {
            search: "Search: _INPUT_",
            searchPlaceholder: "Search by Agent ID"
        },
        info: true,
        paging: true,
        lengthChange: true,
        searching: true,
        bStateSave: true,
        order: [
            [1, 'desc']
        ],
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        pageLength: 10,

        columnDefs: [{
            targets: 7,
            orderable: false
        }]
    });
</script>
@endsection
