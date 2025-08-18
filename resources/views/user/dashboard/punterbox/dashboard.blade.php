@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   .details-row {
        background-color: #f9f9f9;
    }
    .details-row th {
        color: var(--blue--text);
        font-weight: bold;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
      <div class="custom-heading-wrapper col-md-12">
          <h1 class="h1">Dashboard</h1>
          <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>The Punterbox register <b>(Punterbox)</b> is a free service to all Viewers. You can use
                     the Punterbox service at any time. Your details, when you undertake a search, are
                     kept confidential.</li>
                  <li>You can only search for an Escort by their mobile number. Search your next
                     booking by their mobile number itself, e.g. 0400123456. Do not include any
                     prefixes, e.g. +61 or spaces.
                     </li>
                     <li>E4U makes no claims:</li>
                     <ol class="level-2">
                        <li>as to the accuracy or legitimacy of the allegations contained in a Report; and</li>
                        <li>nor do we investigate the authenticity of the Reports (provided in confidence
                           by Viewers).</li>
                     </ol>
                </ol>
            </div>
          </div>
      </div>
  </div>
  <!-- Page Heading -->
   
  <div class="row">
   <div class="col-lg-6 col-sm-12">
      <div class="add-punterbox-report">
         <form action="">
            <label class="search-label">Search by mobile number (no spaces)</label>
            <div class="input-group mb-3">
               <input type="text" class="form-control" placeholder="Search..." aria-label="Search by mobile" aria-describedby="button-search">
               <div class="input-group-append">
                  <button class="btn btn-search" type="button" id="button-search">Search</button>
               </div>
            </div>
         </form>
       </div>
   </div>
   <div class="col-md-12">
      
      <div class="table-responsive">
         <table id="myReportTable" class="table display" width="100%">
           <thead class="bg-first">
             <tr>
               <th>REF</th>
               <th>Status</th>
               <th>Mobile</th>
               <th>Incident Type</th>
               <th>Incident Date</th>
               <th>Location</th>
               <th class="text-center">Action</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td>#30</td>
               <td>Active</td>
               <td>0450954036</td>
               <td>Fake</td>
               <td>14-05-2025</td>
               <td>WA - Perth</td>
               <td class="text-center">
                 <a href="javascript:void(0);" class="toggle-details">
                   <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View"></i>
                 </a>
               </td>
             </tr>
       
             <!-- Hidden expandable row -->
             <tr class="details-row d-none">
               <td colspan="7">
                 <div>
                   <table class="table mb-0">
                     <tbody>
                       <tr>
                         <th>Our Ref:</th>
                         <td class="border-0">#30</td>
                         <th>Report Date:</th>
                         <td class="border-0">14-05-2025</td>
                       </tr>
                       <tr>
                         <th>Incident date:</th>
                         <td class="border-0">14-05-2025</td>
                         <th>Location:</th>
                         <td class="border-0">WA - Perth</td>
                       </tr>
                       <tr>
                         <th>Escort's name:</th>
                         <td class="border-0">Unknown</td>
                         <th>Escort's email:</th>
                         <td class="border-0">N/A</td>
                       </tr>
                       <tr>
                         <th>Incident Type:</th>
                         <td class="border-0">Fake</td>
                         <th>Rating:</th>
                         <td class="border-0">Do not book</td>
                       </tr>
                       <tr>
                         <th>Platform:</th>
                         <td class="border-0">Locanto</td>
                         <th>Profile Link:</th>
                         <td class="border-0">N/A</td>
                       </tr>
                       <tr>
                         <th>Summary of Incident:</th>
                         <td colspan="3" class="border-0">Suspicious activity, fake pics, aggressive behavior.</td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </td>
             </tr>
             
       
           </tbody>
         </table>
       </div>
   </div>
</div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<!-- jQuery Toggle Script -->
<script>
   $(document).ready(function () {
     $('.toggle-details').on('click', function () {
       const $this = $(this);
       const $row = $this.closest('tr');
       const $nextRow = $row.next('.details-row');
       
       // Close all others
       $('.details-row').not($nextRow).addClass('d-none');
 
       // Toggle current
       $nextRow.toggleClass('d-none');
     });
   });
 </script>
<script>
   $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush