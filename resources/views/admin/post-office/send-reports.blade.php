@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style type="text/css">
    .select2-container .select2-choice, .select2-result-label {
    font-size: 1.5em;
    height: 52px !important; 
    overflow: auto;
    }
    .select2-arrow, .select2-chosen {
    padding-top: 6px;
    }
    span.select2.select2-container.select2-container--default > span.selection > span {
    height: 52px !important; 
    }
    .list-sec .table td, .table th{
    border: 1px solid #0c233d;
    }
</style>
@endsection
@section('content')
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">New Communication</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes">
                        <div class="card-body">
                            <h3 class="NotesHeader"><b>Notes:</b> </h3>
                            <ol>
                            <li>The Post Office is a repository of all template emails deployed in the Website, be it
                            auto-generated or manual generated.</li>
                            <li>Select the template you wish to use and then click the Preview button to view the
                            template in full before you deploy it, ensuring you have selected the correct template.</li>
                            <li>You can preview the recipients to check you have the correct Members before emailing
                            the recipients.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                    
                    <div class="email-content">
                        <h2>Email Content</h2>
                        <div class="section-one">
                            <div class="form-group">
                                <label for="template">Use Template</label>
                                <select id="template">
                                    <option>--- Select Template ---</option>
                                    <option>Mobile SIM</option>
                                    <option>Offer Alert</option>
                                    <option>Reminder</option>
                                </select>
                            </div>

                            <button onclick="previewTemplate()" type="button" data-toggle="modal" data-target="#previewTemplate">Preview</button>
                        </div>
                        <div class="common-section">
                            <div class="form-group">
                                <label for="additionalText">Additional Text</label>
                                <textarea id="additionalText" rows="3" placeholder="Add extra info here..."></textarea>
                            </div>
                        </div>

                        <h3>Filter Member Types</h3>
                        <div class="filter-row">
                            <label>Member Type</label>
                            <div class="radio-group">
                                <label><input type="radio" name="memberType" checked> All</label>
                                <label><input type="radio" name="memberType"> Female</label>
                                <label><input type="radio" name="memberType"> Male</label>
                                <label><input type="radio" name="memberType"> Trans</label>
                                <label><input type="radio" name="memberType"> Center</label>
                                <label><input type="radio" name="memberType"> Viewer</label>
                                <label><input type="radio" name="memberType"> Agent</label>
                            </div>
                        </div>

                        <div class="common-section">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select id="location">
                                    <option>All</option>
                                    <option>New South Wales</option>
                                    <option>Western Australia</option>
                                </select>
                            </div>
                        </div>

                        <h3>Filter Users</h3>
                        <div class="filter-row">
                            <label>User Status</label>
                            <div class="radio-group">
                                <label><input type="radio" name="userStatus" checked> Enabled</label>
                                <label><input type="radio" name="userStatus"> Suspended</label>
                                <label><input type="radio" name="userStatus"> Inactive</label>
                                <label><input type="radio" name="userStatus"> All</label>
                            </div>
                        </div>

                        <div class="filter-row">
                            <label>User Emails</label>
                            <div class="radio-group">
                                <label><input type="radio" name="emailType" checked> All</label>
                                <label><input type="radio" name="emailType"> Australian</label>
                                <label><input type="radio" name="emailType"> Generic</label>
                                <label><input type="radio" name="emailType"> E4U</label>
                            </div>
                        </div>
                        <div class="common-section">

                            <div class="form-group">
                                <label for="user">Select User</label>
                                <select id="user">
                                    <option>All</option>
                                    <option>E60123 - Joy</option>
                                    <option>E20158 - Mary</option>
                                </select>
                            </div>
                        </div>
                        <h3>Options</h3>
                        <div class="common-section">
                            <div class="form-group">
                                <label for="copy">Copy To</label>
                                <select id="copy" name="copy[]" multiple size="3">
                                    <option value="wayne@blackboxtech.com.au" selected>wayne@blackboxtech.com.au</option>
                                    <option value="xyz@blackboxtech.com.au">xyz@blackboxtech.com.au</option>
                                    <option value="abs@blackboxtech.com.au">abs@blackboxtech.com.au</option>
                                </select>
                            </div>
                        </div>

                        <div class="common-section">
                            <div class="form-group">
                                <label>Trial Run Only</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="trialRun" checked> On</label>
                                    <label><input type="radio" name="trialRun"> Off</label>
                                </div>
                            </div>
                        </div>

                        <div class="buttons">
                            <button onclick="showRecipients()">Show Recipients</button>
                            <button class="primary">Email Recipients</button>
                        </div>

                        <!-- stat recipient-container -->
                        <div class="recipient-container table-responsive">
                            <!-- when Email Recipients selected, Trial Run must be On -->

                            <table>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total Recipients:</td>
                                        <td>2</td>

                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total Valid Recipients:</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total Invalid Recipients:</td>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member ID</th>
                                        <th>Name</th>
                                        <th>Email address</th>
                                        <th>Location</th>
                                        <th>Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>E60123</td>
                                        <td>Joy</td>
                                        <td><a href="mailto:Joy@gmail.com">Joy@gmail.com</a></td>
                                        <td>Western Australia</td>
                                        <td class="verified">OK</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>E20158</td>
                                        <td>Mary</td>
                                        <td><a href="mailto:Mary@e4u.com.au">Mary@e4u.com.au</a></td>
                                        <td>New South Wales</td>
                                        <td class="verified">OK</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- when Email Recipients selected, Trial Run must be Off -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total attempted emails:</td>
                                        <td>2</td>
                                        <td rowspan="6" class="button-cell" style="vertical-align: center; text-align: center;">
                                            <button class="email-report" type="button" data-toggle="modal" data-target="#emailReport">See Email Report</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total successful emails:</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total invalid emails:</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total failed emails:</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold; width:220px;">Total time taken:</td>
                                        <td>0.068 seconds</td>
                                    </tr>
                                    <tr style="font-weight: bold; width:220px;">
                                        <td>Email run finished at:</td>
                                        <td>08:36 am.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Member ID</th>
                                        <th>Name</th>
                                        <th>Email address</th>
                                        <th>Location</th>
                                        <th>Verified</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>1.</td>
                                        <td>E60123</td>
                                        <td>Joy</td>
                                        <td><a href="mailto:Joy@gmail.com">Joy@gmail.com</a></td>
                                        <td>Western Australia</td>
                                        <td class="verified">OK</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>E20158</td>
                                        <td>Mary</td>
                                        <td><a href="mailto:Mary@e4u.com.au">Mary@e4u.com.au</a></td>
                                        <td>New South Wales</td>
                                        <td class="verified">OK</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end -->
                    </div>  
                </div>
            </div>
        </div>
      </div>
   </div>
</div>


<!-- See Email Report popup -->


<div class="modal fade upload-modal bd-example-modal-lg" id="emailReport" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="emailReport"> <img src="{{ asset('assets/dashboard/img/email-details.png') }}" class="custompopicon"> Email Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                <!-- Header Row -->
                <tr style="background-color: #0c223d; color: white;">
                    <td colspan="5" style="font-weight: bold; text-align: center;">Post Office Report: [date & time]</td>
                </tr>

                <!-- Table Headings -->
                <tr style="background-color: #0c223d; color: white; font-weight: bold; text-align:center">
                    <td style="text-align:center;">Date & Time</td>
                    <td style="text-align:center;" >Member ID</td>
                    <td style="text-align:center;" >Member</td>
                    <td style="text-align:center;" >Subject</td>
                    <td style="text-align:center;" >Result</td>
                </tr>

                <!-- Row 1 -->
                <tr>
                    <td style="text-align:center;">2025-06-09 8:36:54</td>
                    <td style="text-align:center;">E60123</td>
                    <td style="text-align:center;">Joy</td>
                    <td style="text-align:center;">National Ugly Mugs Feature</td>
                    <td style="color: green; font-weight: bold; text-align:center;">Sent</td>
                </tr>

                <!-- Row 2 -->
                <tr>
                    <td style="text-align:center;">2025-06-09 8:36:54</td>
                    <td style="text-align:center;">E20158</td>
                    <td style="text-align:center;">Mary</td>
                    <td style="text-align:center;">National Ugly Mugs Feature</td>
                    <td style="color: green; font-weight: bold;text-align:center;">Sent</td>
                </tr>

                <!-- Footer Row -->
                <tr>
                    <td colspan="4" style="background-color: #0c2340; color: white; font-weight: bold;">Sent: 156</td>
                    <td style="background-color: #ff3c5f; text-align: center;">
                        <a href="#" style="color: white; text-decoration: none; font-weight: bold;">Print Report</a>
                    </td>
                </tr>
            </table>

         </div>
      </div>
   </div>
</div>
<!-- end -->

<!-- custome modal design previeo template -->

<div class="modal fade upload-modal bd-example-modal-lg" id="previewTemplate" tabindex="-1" role="dialog" aria-labelledby="previewTemplateLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="previewTemplate"> <img src="{{ asset('assets/dashboard/img/email-template.png') }}" class="custompopicon"> Template</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body">
            
         <table width="100%" cellpadding="0" cellspacing="0" style=" padding: 20px 0;">
                    <tr>
                        <td align="center" style="border:none !important">
                            <!-- Main container -->
                            <table cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #dddddd; font-family:Arial, sans-serif; color:#0c223d;">

                                <!-- Header with background and logo -->
                                <tr>
                                    <td style="background-color:#0c223d; padding: 20px;border:none !important">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="text-align: left; border:none !important">
                                                    <img src="http://127.0.0.1:8000/assets/app/img/logo.png" alt="E4U Logo" style="height: 50px;">
                                                </td>
                                                <td style="text-align: right; color: #ffffff; font-size: 16px; font-weight: bold; border:none !important">
                                                    Mobile SIM - Available<br>
                                                    <span style="font-size: 13px; color: #cccccc;">Member ID: [Member ID]</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Content Padding -->
                                <tr>
                                    <td style="padding: 30px;border:none !important">

                                        <!-- Greeting -->
                                        <p style="font-size: 16px; margin: 0 0 15px 0;"><b>Dear [salutation (> My Account > Edit My Account > About Me > My Name)],</b></p>

                                        <!-- Main Message -->
                                        <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                            Are you aware of our Mobile SIM service? Simply order your SIM from E4U, and save yourself all the fuss of having to go to a Telco shop.
                                        </p>

                                        <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                            It is really easy, just logon and go to your Dashboard and click Concierge Services > Mobile and complete the order request. Your SIM will be sent directly to you.</p>
                                        <p style="font-size: 15px; line-height: 1.6; margin-bottom: 15px;">
                                            [additional text appears here]
                                        </p>

                                        <!-- Closing -->
                                        <p style="font-size: 15px; margin-top: 20px;">
                                            Regards,<br>
                                            <b>E4U - Operations</b>
                                        </p>

                                    </td>
                                </tr>

                            </table>

                            <!-- Footer -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#2b3d50; padding: 15px 30px; line-height: 20px; font-family:Arial, sans-serif; color:#ffffff; font-size:14px; text-align:center;">
                                <tr>
                                    <td style="text-align:center;">
                                        <em>This is an automatically generated email by the Escorts4U Operations Centre.<br>
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
 <!-- end -->
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
  function showRecipients() {
    const recipientDiv = document.querySelector('.recipient-container');
    recipientDiv.style.display = 'block';
  }
</script>

@endpush