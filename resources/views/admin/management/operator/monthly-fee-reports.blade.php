@extends('layouts.admin')
@section('content')
@section('style')
@endsection


<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    {{-- Page Heading --}}
    <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Monthly Fee Reports</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                    <p class="notes"><b>Notes:</b> </p>
                    <p></p>
                    <ol>
                     <li>This report is a summary of the Operator’s Fee.</li>
                     <li>Agent summary can be viewed here.</li>
                        <li>Payment authorisation procedure must be followed, for Operator to be paid:
                            <ol class="level-2">
                                <li>if report is correct, change status to Paid.
                                </li>
                                <li>produce Payment Authorisation summary. Managing Director to sign off.
                                </li>
                                <li>Payment Authorisation summary processed (by accounts staff).</li>
                            </ol>
                        </li>
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
                        <table class="table table_admin" id="AgentReportTable">
                            <thead class="table-bg">
                                <tr>
                                    <th>Date Issued</th>
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
                                    <td>WA</td>
                                    <td><div class="num_value">$ <span>1,250,900.00</span></div></td>
                                    <td><div class="num_value">$ <span>25,018.00</span></div></td>
                                    <td>Pending</td>
                                    <td>04-11-2025</td>
                                    <td class="text-center">
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
                                                    <a class="dropdown-item align-item-custom" data-toggle="modal"
                                                        data-target="#payAgentreport" href=""> <i
                                                            class="fa fa-check-circle" aria-hidden="true"></i>
                                                        Approve</a>
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
    aria-labelledby="payAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">

            <!-- Header -->


            <div class="modal-header">
                
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/auth.png') }}" class="custompopicon"> Payment Authorisation</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/app/img/newcross.png')}}">
                </a>
            </div>
            <!-- Body -->
            <div class="modal-body" style="padding: 20px;">

                <table class="w-100 table opr_modal_table">
                    <tr>
                        <td style="font-weight: bold; color: #001f4d;">Operator ID: </td>
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
                    Operator’s nominated Bank Account.
                </p>

                <p style="margin-top: 25px;">
                    Managing Director: <span
                        style="display: inline-block; border-bottom: 1px solid #000; width: 200px;"></span>
                </p>

                <hr style="margin: 20px 0;">

                <div style="text-align: center;">

                   

                    <button type="button" class="btn-success-modal">Print</button>
                     <button type="button" class="btn-cancel-modal" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- end --}}

{{-- View Report --}}

<div class="modal fade upload-modal" id="viewAgentreport" tabindex="-1" role="dialog"
    aria-labelledby="viewAgentreportLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered custom_admin_modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                 
                <h5 class="modal-title text-white"><img src="{{ asset('assets/dashboard/img/admin-report.png') }}" class="custompopicon">  Fee Report by Agent (Period Ending: 31-10-25)</h5>
                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                   <img src="{{ asset('assets/app/img/newcross.png')}}">
                </a>
            </div>

            <div class="modal-body">

                <table class="table table-bordered mb-0 common_accordian_table">
                    <thead class="table-bg modal-thaed">
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
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">35
                            </td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                                 <div class="num_value">$<span>34.15</div></td></td>
                        </tr>

                        <!-- ========= MEMBER 2 ========= -->
                        <tr class="accordion-toggle" data-toggle="collapse" data-target="#details2"
                            aria-expanded="false" aria-controls="details2">
                            <td>A20056</td>
                            <td class="opr_expand_arrow">Rose Chaplin <i class="fa fa-chevron-down"></i></td>
                            <td>WA</td>
                            <td></td>
                            <td>35</td> <td class="text-left"><div class="num_value">$<span>683.00</div></td>
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
                        <tr class="detail-row" data-group="details1">
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">35
                            </td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>683.00</div></td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                               <div class="num_value">$<span>34.15</div> </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <!-- ========= MEMBER 2 ========= -->
                        
                        <tr>
                            <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold">70
                            </td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>1,366.00</div></td>
                            <td style="border-top: 1px solid #ccc; border-bottom:1px solid #ccc; font-weight:bold; text-align:left;">
                                <div class="num_value">$<span>68.30</div></td>
                        </tr>

                    </tfoot>
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
        <script src="{{ asset('assets/dashboard/vendor/jquery/jquery.min.js') }}"></script>
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
