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
      <div class="col-md-12 custom-heading-wrapper">
         <h1 class="h1">Screening Tips - NUM</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>Use these tips to assist you when you are screening a potential client to meet with.</li>
                  <li>Always remember that your safety should always take precedence over income.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <!-- Page Heading -->
   <div class="row">
      <div class="col-md-12">
         <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#pre_book" aria-expanded="false">
                  Pre-booking Screening
                  </a>
               </div>
               <div id="pre_book" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Use mobile number/email to do a number check.</li>
                        <li>Talk to the client before booking, avoid just texts.</li>
                        <li>Do not accept bookings from blocked/withheld numbers.</li>
                        <li>Use virtual assistant services like <a href="http://www.agencymanagement.com.au" target="_blank" class="custom_links_design">Agency Management</a>.</li>
                        <li>Google and social media search can be helpful.</li>
                        <li>Deposits can help avoid timewasters.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#number_email" aria-expanded="false">
                  Number and Email Checking
                  </a>
               </div>
               <div id="number_email" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Use Google, phone ID apps.</li>
                        <li>Check on <a href="http://www.nationaluglymugs.com.au" target="_blank" class="custom_links_design">NUM</a>.</li>
                        <li>Maintain a personal list of bad clients.</li>
                        <li>Use WhatsApp to see client’s picture.</li>
                        <li>Cross-check from at least 2 sources.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#warning_schemes" aria-expanded="false">
                  Warning Schemes, Alerts, and Ugly Mugs
                  </a>
               </div>
               <div id="warning_schemes" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Use forums and public NUM for safety alerts.</li>
                        <li>Read client reviews to understand behavior.</li>
                        <li>NUM provides SMS/email alerts and a number checker.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#on_phone" aria-expanded="false">
                  On the Phone
                  </a>
               </div>
               <div id="on_phone" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Trust your instincts. Don’t confirm if unsure.</li>
                        <li>Make sure the client has read your profile.</li>
                        <li>Avoid withheld/pay phone numbers.</li>
                        <li>Be cautious of detailed roleplay requests.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#payments_safety" aria-expanded="false">
                  Payments, Safety, and Spotting a Scam
                  </a>
               </div>
               <div id="payments_safety" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Always take payment before service begins.</li>
                        <li>Keep money hidden during the session.</li>
                        <li>Consider deposits, PayID, or crypto with caution.</li>
                        <li>Beware of unrealistic offers and scams.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#gut_feeling" aria-expanded="false">
                  Instinct and Gut Feeling
                  </a>
               </div>
               <div id="gut_feeling" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <ol class="mb-0">
                        <li>Try to visually identify the client beforehand.</li>
                        <li>Install peepholes or CCTV.</li>
                        <li>Watch for extra people or signs of intoxication.</li>
                        <li>Get payment upfront. Stay alert.</li>
                     </ol>
                  </div>
               </div>
            </div>
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