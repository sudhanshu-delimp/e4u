@extends('layouts.escort')
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
    /* Icon default style */
.toggle-details i {
  color: #333;
  transition: color 0.3s ease, transform 0.2s ease;
}

/* Optional: Improve tooltip look slightly */
.tooltip-inner {
  background-color: #000 !important;
  color: #fff;
  font-weight: bold;
  padding: 6px 12px;
  border-radius: 4px;
  border: 0px !important;
  font-weight: 500 !important;
  font-size: 14px;
}

.tooltip.bs-tooltip-top .arrow::before {
  border-top-color: #000 !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
    <!-- Page Heading -->

    <div class="row">
      <div class="d-flex align-items-center justify-content-start mt-5 flex-wrap col-lg-12">
          <h1 class="h1">Dashboard</h1>
          <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 my-4">
          <div class="card collapse" id="notes" style="">
          <div class="card-body">
              <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
              <ol>
                <li>The National Ugly Mugs register (NUM) is a free service to all Escorts. You can use
                   the NUM service at any time. Your details, when you undertake a search, are kept
                   confidential.</li>
                <li>You can only search for an offender by their mobile number. Search your next booking
                   by their mobile number itself, e.g. 0400123456. Do not include any prefixes, e.g. +61
                   or spaces.</li>
                <li>E4U makes no claims:</li>
                <ol class="level-2"><li>as to the accuracy or legitimacy of the allegations contained in a Report; and</li>
                <li>nor do we investigate the authenticity of the Reports (provided in confidence
                   by Escorts)</li>
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
            <label class="search-label mt-0">Search by mobile number (no spaces)</label>
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
               <td>0450954036</td>
               <td>Dangerous</td>
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
                         <th>Offender's name:</th>
                         <td class="border-0">Adrian Weinstein</td>
                         <th>Offender's email:</th>
                         <td class="border-0"></td>
                       </tr>
                       <tr>
                         <th>Incident Type:</th>
                         <td class="border-0">Dangerous</td>
                         <th>Rating:</th>
                         <td class="border-0">Do not book</td>
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
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endpush