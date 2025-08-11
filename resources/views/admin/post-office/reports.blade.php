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
                   <h1 class="h1">Reports</h1>
                  <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
               </div>
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                        <li>Select the Report for the required Communication.</li>
                        <li>Select Preview to view the Report, or Print to print out the Report.</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">    
               <div class="col-md-12 ">
                  <div class="panel with-nav-tabs panel-warning">
                     <div class="panel-body">
                        <div class="tab-content">
                           <div class="tab-pane fade in active show" id="tab1warning">
                              <div class="table-responsive-xl">
                                 <table class="table" id="postReportTable">
                                    <thead class="table-bg">
                                       <tr>
                                          <th scope="col">Ref
                                          </th>
                                          <th scope="col">Date & Time</th>
                                          <th scope="col">
                                             Subject
                                          </th>
                                          <th scope="col" class="text-center">
                                             Action
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody class="table-content">
                                       <tr class="row-color">
                                          <td class="theme-color">123</td>
                                          <td class="theme-color">2025-06-09 8:36:54</td>
                                          <td class="theme-color">National Ugly Mugs Feature [header tile in email]</td>
                                          <td class="theme-color text-center">
                                             <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   
                                                   
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#postOffivereport" > <i class="fa fa-eye"></i> View </a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-fw fa-print" ></i> Print </a>
                                                   
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
            </div>
         </div>
      </div>
   </div>
</div>


<!-- Popup Post Office Report: [date & time] -->


<div class="modal fade upload-modal bd-example-modal-lg" id="postOffivereport" tabindex="-1" role="dialog" aria-labelledby="postOffivereportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="postOffivereport"><img src="{{ asset('assets/dashboard/img/post-office-report.png') }}" class="custompopicon">Post Office Report</h5>
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
@include('escort.dashboard.partials.playmates-modal')
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#postReportTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Ref No..."
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
<script>
  function showRecipients() {
    const recipientDiv = document.querySelector('.recipient-container');
    recipientDiv.style.display = 'block';
  }
</script>

@endpush