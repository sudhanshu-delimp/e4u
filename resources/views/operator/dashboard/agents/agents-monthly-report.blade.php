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
                                <li><b>Fees</b> mean the fees calculated pursuant to Item 5 of Schedule 1 and payable
                                    pursuant to clause 9.1.
                                </li>
                                <li> <b>Monthly Report</b> means the online report summarising all the activities for that
                                    month for Signed Up Advertisers which the calculation of the Fees for that month
                                    will be based on.
                                </li>
                            </ol>
                        </li>
                        <li>The Fees will be paid to the Agent within seven Business Days of the Agent Monthly
                            Report having been approved, provided the Agent:
                            <ol class="level-2">
                                <li>has confirmed the correctness of the Monthly Report within three days; and
                                </li>
                                <li>where a query is raised in respect of the Monthly Report, the Fee corresponding
                                    to the Query will be separated from the Report and remain in escrow until the query
                                    is resolved (<b>Resolved Query</b>); and
                                </li>
                                <li>a Resolved Query will be included in the following Monthly Report.</li>
                            </ol>
                        </li>
                        <li>All Fees paid to the Agent under the Agent Agreement will be paid into your nominated
                            Bank Account, as the Operator. Fees are inclusive of GST.</li>
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
                            <thead class="opr-table-bg">
                                <tr>
                                    <th>Date</th>
                                    <th>Billing Period</th>
                                    <th>Agent ID</th>
                                    <th>Territory</th>
                                    <th>Spend</th>
                                    <th>Fees</th>
                                    <th>Status</th>
                                    <th>Report Approved</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01-11-2025</td>
                                    <td>01-10-25 to 31-10-25</td>
                                    <td>A600025</td>
                                    <td>WA</td>
                                    <td>
                                        <div class="num_value">$<span>4,749.00</span></div>
                                    </td>
                                    <td>
                                        <div class="num_value">$<span>237.45</span></div>
                                    </td>
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
                                                        href="#" title="Click to disable notification">
                                                    </a>
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

{{-- end --}}

{{-- View Report --}}

<div class="modal fade opr-modal" id="viewAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="viewAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered opr_custom_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">


                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/report.png') }}"
                        class="custompopicon"> Fee Report (Period Ending: 31-10-25)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/dashboard/img/operator/close.png') }}" class="opr-close-btn">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0 opr_accordian_table">
                    <thead class="opr-table-bg modal-thaed">
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
                            <td>E612344</td>
                            <td class="opr_expand_arrow">Oxe Daisy <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left">
                                <div class="num_value">$<span>683.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>34.15</span></div>
                            </td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left">
                                <div class="num_value">$<span>176.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.80</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left">
                                <div class="num_value">$<span>24.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>1.20</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>0.40</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left">
                                <div class="num_value">$<span>475.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>23.75</span></div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.15</div>
                            </td>
                            </td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <!-- ========= MEMBER 2 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2"
                            aria-expanded="false" aria-controls="details2">
                            <td>E612351</td>
                            <td class="opr_expand_arrow">Rose Chaplin <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>34.15</div>
                            </td>
                        </tr>

                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left">
                                <div class="num_value">$<span>176.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.80</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left">
                                <div class="num_value">$<span>24.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>1.20</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>0.40</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details2">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left">
                                <div class="num_value">$<span>475.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>23.75</div>
                            </td>
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
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.15</div>
                            </td>
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
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,366.00</div>
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>68.30</div>
                            </td>
                        </tr>
                        {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <!-- ========= MEMBER 3 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details3"
                            aria-expanded="false" aria-controls="details3">
                            <td>M612380</td>
                            <td class="opr_expand_arrow">Lin’s Massage <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td>
                            <td class="text-left">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>34.15</div>
                            </td>
                        </tr>

                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>P</td>
                            <td>22</td>
                            <td class="text-left">
                                <div class="num_value">$<span>176.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.80</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>G</td>
                            <td>4</td>
                            <td class="text-left">
                                <div class="num_value">$<span>24.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>1.20</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>S</td>
                            <td>2</td>
                            <td class="text-left">
                                <div class="num_value">$<span>8.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>0.40</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>PU</td>
                            <td>7</td>
                            <td class="text-left">
                                <div class="num_value">$<span>475.00</div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>23.75</div>
                            </td>
                        </tr>
                        <tr class="detail-row" data-group="details3">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.15</div>
                            </td>
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
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.15</div>
                            </td>
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
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>2,049.00</div>
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>102.45</div>
                            </td>
                        </tr>

                    </tfoot>
                </table>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn-success-modal">Print</button>
                <button type="button" class="btn-success-modal" data-dismiss="modal">Close</button>
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
            document.querySelectorAll('.accordion-toggle i').forEach(i => i.classList.remove(
                'rotated'));
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
