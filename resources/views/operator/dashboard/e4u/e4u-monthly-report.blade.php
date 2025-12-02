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
                           <li>This report is a summary of the Monthly Operator’s Fee.</li>
                           <li>Agent summary can be viewed from here.</li> 
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
                                    <th>Dated Issued</th>
                                    <th>Billing Period</th>
                                    <th>Territory</th>
                                    <th>Spend</th>
                                    <th>Fees</th>
                                    <th>Status</th>
                                    <th>Date Approved</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01-11-2025</td>
                                    <td>01-10-25 to 31-10-25</td>
                                    <td>Australia</td>
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

{{-- View Report --}}

<div class="modal fade opr-modal" id="viewAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="viewAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered opr_custom_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">


                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/operator/report.png') }}"
                        class="custompopicon"> Fee Report by Agent (Period Ending: 31-10-25)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/dashboard/img/operator/close.png') }}" class="opr-close-btn">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0 opr_accordian_table">
                    <thead class="opr-table-bg modal-thaed">
                        <tr>
                            <th>Agent ID</th>
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
                            <td>A10044</td>
                            <td class="opr_expand_arrow">Business 01 <i class="fa fa-chevron-down"></i></td>
                            <td>ACT</td>
                            <td></td>
                            <td>65</td>
                            <td class="text-left">
                                <div class="num_value">$<span>1,583.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>79.15</span></div>
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
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                            <td style="border-top: 1px solid #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.00</div>
                            </td>
                            </td>
                        </tr>
                       
                         <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right">MC</td>
                            <td>30
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>900.00</div>
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>45.00</div>
                            </td>
                            </td>
                        </tr>
                         <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">65
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,583.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>79.15</div>
                            </td>
                            </td>
                        </tr>
                        {{-- end Member 1 --}}
                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>





                        <!-- ========= MEMBER 2 ========= -->
                        
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2"
                            aria-expanded="false" aria-controls="details2">
                            <td>A10056</td>
                            <td class="opr_expand_arrow">Business 02 <i class="fa fa-chevron-down"></i></td>
                            <td>NSW</td>
                            <td></td>
                            <td>65</td>
                            <td class="text-left">
                                <div class="num_value">$<span>1,583.00</span></div>
                            </td>
                            <td class="text-left">
                                <div class="num_value">$<span>79.15</span></div>
                            </td>
                        </tr>

                        <!-- Detail rows -->
                        <tr class="detail-row" data-group="details2">
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
                        <tr class="detail-row" data-group="details2">
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
                        <tr class="detail-row" data-group="details2">
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
                        <tr class="detail-row" data-group="details2">
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
                        <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right"><strong>Subtotal:</strong></td>
                            <td style="border-top: 1px solid #444; font-weight:bold">35
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>34.00</div>
                            </td>
                            </td>
                        </tr>
                       
                         <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right">MC</td>
                            <td>30
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>900.00</div>
                            </td>
                            <td
                                style="text-align:left;">
                                <div class="num_value">$<span>45.00</div>
                            </td>
                            </td>
                        </tr>
                         <tr class="detail-row" data-group="details2">
                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                            <td style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold">65
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,583.00</div>
                            </td>
                            <td
                                style="border-top: 1px solid #444; border-bottom:3px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>79.15</div>
                            </td>
                            </td>
                        </tr>
                        {{-- end Member 2 --}}

                         {{-- space --}}
                        <tr>
                            <td colspan="7" style="padding:10px"></td>
                        </tr>
                        {{-- end --}}
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Agents:</strong></td>
                            <td style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold">135
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>3,166.00</div>
                            </td>
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>158.30</div>
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
                            <td colspan="6" class="text-right"><strong>Operator Fee:</strong></td>
                            
                            <td
                                style="border-top: 2px solid #444; border-bottom:6px double #444; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>158.30</div>
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