@extends('layouts.admin')
@section('style')
    <style type="text/css"></style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Communications</h1>
                    <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b>
                    </h6>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>To view the Communication in full, click the View option from Action.</li>
                            <li>To print the Communication click the Print option from Action.</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 ">
                <div class="table-responsive">
                    <table class="table" id="communicationsReportTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Ref</th>
                                <th>Date & Time</th>
                                <th>Recipient</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123</td>
                                <td>2025-06-09 8:36:54</td>
                                <td></td>
                                <td>New Registration</td>
                                <td>
                                    <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <div class="custom-tooltip-container">
                                                    <a
                                                        class="dropdown-item align-item-custom toggle-massage-notification"
                                                        href="#" title="Click to disable notification">
                                                    </a> 
                                                    
                                                    <a class="dropdown-item align-item-custom" href="#"
                                                        data-toggle="modal" data-target="#communicationReport"> <i
                                                            class="fa fa-eye" aria-hidden="true"></i>
                                                        View</a>
                                                    
                                                         <div class="dropdown-divider"></div>

                                                        <a class="dropdown-item align-item-custom" data-toggle="modal"
                                                        data-target="#confirm-popup" href=""> <i
                                                            class="fa fa-print" aria-hidden="true"></i>Print</a>
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

        <!--middle content end here-->
        <!--right side bar start from here-->
    </div>
    <!--right side bar end-->
    </div>

    <div class="modal fade upload-modal" id="confirm-popup" tabindex="-1" role="dialog"
        aria-labelledby="confirmPopupLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header border-0">
                    <input type="hidden" id="status_data_id">
                    <input type="hidden" id="status_data_value">
                    <h5 class="modal-title d-flex align-items-center" id="confirmPopupLabel">
                        <img src="{{ asset('assets/dashboard/img/question-mark.png') }}" alt="resolved"
                            class="custompopicon">
                        <span>Confirmation</span>
                    </h5>
                    <input type="hidden" id="status_data_id" name="status_data_id" value="">
                    <input type="hidden" id="status_data_value" name="status_data_value" value="">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>

                <div class="modal-body pb-0 teop-text text-center">
                    <h5 class="popu_heading_style mt-2">
                        Are you sure you want to perform this action.
                    </h5>

                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">

                    <button type="button" class="btn-success-modal saveStatus" data-dismiss="modal"
                        aria-label="Close">Yes</button> <button type="button" class="btn-cancel-modal"
                        data-dismiss="modal" aria-label="Close">No</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal bd-example-modal-lg" id="communicationReport" tabindex="-1" role="dialog" aria-labelledby="communicationReportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="communicationReport"><img src="{{ asset('assets/dashboard/img/post-office-report.png') }}" class="custompopicon">Post Office Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <table width="100%" cellpadding="0" cellspacing="0" style="border: none">
                <tr>
                <td align="center" style="border:none;">
                    <!-- Main container -->
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#2b3d50;">

                    <!-- Header with background and logo -->
                    <tr>
                        <td style="background-color:#0c223d; padding: 20px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                            <td style="text-align: left; border:none;">
                                <img src="{{ asset('assets/app/img/logo.png') }}" alt="E4U Logo" style="height: 63px; width:195px">
                            </td>
                            <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold;border:none;">
                            Communications
                            </td>
                            </tr>
                        </table>
                        </td>
                    </tr>

                    <!-- Content Padding -->
                    <tr>
                        <td style="padding: 30px;">
                        
                        <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Attention Operations</b></p>
                            <p style="font-size: 16px; margin: 20px 0 15px 0;">The following Agent Registration was made on the 2025-06-09 8:36:54. Details of the
                            registration are:</p>
                            <!-- Details Table -->
                            <table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-size: 15px; color: #2b3d50;">
                            
                            
                            <tr>
                                <td style="font-weight: bold; padding: 10px 0px; border:none;">Date & Time:</td>
                                <td style="padding: 10px 0px 10px 10px; border:none;">2025-06-09 8:36:54</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; padding: 10px 0px; border:none;">Recipient:</td>
                                <td style="padding: 10px 0px 10px 10px; border:none;">Haka Goswami</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold; padding: 10px 0px; border:none;">Subject:</td>
                                <td style="padding: 10px 0px 10px 10px; border:none;">New Registration</td>
                            </tr>
                            </table>

                            <!-- Closing -->
                        <p style="font-size: 15px; margin-top: 20px;">
                            Regards,<br>
                            <b>E4U - Operations</b>
                        </p>
                        </td>
                    </tr>

                    </table>

                    <!-- Footer -->
                    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#0c223d; padding: 15px 30px; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
                    <tr>
                        <td style="text-align: center;">
                        <em>This is an automatically generated email by the Escorts4u Operations Centre.<br>
                            &copy; Copyright 2024 Blackbox Tech Pty Ltd. All rights reserved.</em>
                        </td>
                    </tr>
                    </table>

                </td>
                </tr>
            </table>
         </div>
      </div>
   </div>
</div>
    {{-- end notes --}}
@endsection


@push('script')
 <script>
        var table = $("#communicationsReportTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref",
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
            columns: [{
                    data: 'Ref',
                    name: 'Ref',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'date_time',
                    name: 'date_time',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },

                {
                    data: 'recipient',
                    name: 'recipient',
                    searchable: true,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'subject',
                    name: 'subject',
                    searchable: false,
                    orderable: true,
                    defaultContent: 'NA'
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false,
                    defaultContent: 'NA',
                    class: 'text-center'
                },
            ]
        });


      
    </script>
@endpush
