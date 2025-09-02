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
         <h1 class="h1">Screening Tips</h1>
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
                     <p>Escorts have lots of preferred methods to screen clients before they take a booking, here are some that you may consider helpful:</p>
                     <ol class="mb-0">
                        <li>Using the client’s mobile number and / or email (if you know it), to undertake a number check.</li>
                        <li>Avoid making a booking without having spoken to the client over the phone. Otherwise make sure you are satisfied with your text messaging.</li>
                        <li>Not making a booking if a withheld number is used.</li>
                        <li>Not accepting bookings from people you have blocked.</li>
                        <li>For those people who choose to have just email or text contact it is always still useful to run a number check (see below) for both in calls and out calls. Some Escorts, who are okay booking via email or text only, still make sure they explain their boundaries before meeting with the client and many Escorts do not give their full address until the client is on their street. Whilst it’s important to respect how different Escorts screen and keep themselves safe, some Escorts who assisted with their advice to us, would think twice before making an out call booking just by text or email.</li>
                        <li>Consider engaging the services of a virtual assistant, like <a href="http://www.agencymanagement.com.au" target="_blank" class="custom_links_design">Agency Management</a>, which removes all the hassle.</li>
                        <li>Googling clients to find out more about them including using professional networking sites and searching social media can be helpful. You will often see a photo of the client through these social media websites.</li>
                        <li>Some Escorts require a client to pay a deposit before meeting with them. This is helpful in reducing the risk of time wasting or potentially difficult bookings. Whilst clients are reluctant to provide a deposit, due to the risk of fraud, for out call clients it is entirely appropriate to request a deposit from the client before meeting with them.</li>
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
                     <p>Number and email checking are the most popular forms of checking, number in particular.</p>
                     <ol class="mb-0">
                        <li>When you have the client’s mobile number, run it through google. This can bring up all sorts of helpful info on who your client might be.</li>
                        <li>Use number check websites, such as this one, and generic online and phone number ID and blocking applications, although there are limitations to the success of these types of websites.</li>
                        <li>Check mobile number and email address (if applicable), against the <a href="http://www.nationaluglymugs.com.au" target="_blank" class="custom_links_design">NUM</a> database.</li>
                        <li>Create and check your own personal ugly mugs/bad clients list here. Once you have identified a potentially problem client, save this number in your phone. Some Escorts find it useful to categorise clients who they are not keen on by saving them under warnings in their address list, e.g. ‘Timewaster or TW’, ‘Do Not See’, ‘See only if very quiet’, ‘See only when desperate’. Quiet times do exist, so being able to differentiate between callers who you would happily see again, you would never see again and who you might see at a stretch, can be very helpful.</li>
                        <li>For clients you definitely don’t want to see it is more appropriate to simply ignore them by perhaps blocking their number. Don’t engage with them by telling them you have already sussed them out. This may alert them, and they may change their number.</li>
                        <li>You can also check WhatsApp, where you can sometimes see their picture.</li>
                        <li>We know it is time consuming and sometimes you are in a rush but checking with at least two of the above examples improves your safety.</li>
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
                     
                     <p>Ugly Mug is a term used by many Escorts to describe a ‘bad’ or dangerous (or potentially
                        dangerous) client or another problem individual. It is also used for clients and others who are
                        committing fraud such as paying with counterfeit money. There are warning schemes and
                        forums you can use to warn others and arm yourself with information, such as this website.</p>
                     <ol class="mb-0">
                        <li>Checking sex work forums and similar platforms to see if the client has any warnings or negative feedback is an important part of screening.</li>
                        <li>Sign up to and use free safety warning schemes and forums, like this one, and the public <a href="http://www.nationaluglymugs.com.au" target="_blank" class="custom_links_design">NUM</a> where warnings are shared. Through these you can keep up to date with local and national warnings about ‘ugly mugs’ and in some cases also timewasters.</li>
                        <li>NUM offers free SMS alerts to your phone or email as well as providing a number checker.</li>
                        <li>Although the NUM is an independent community service, some Escorts use more than one scheme, although time consuming. This platform has a number checker, albeit it is limited to this platform. By using this platform as well as NUM, you are broadening your chances of protecting your safety as users of NUM are making reports available to the broader community.</li>
                        <li>Reading reviews left by clients is also a safety precaution some Escorts use as it can provide you with an indication of the client’s expectations of a meeting, their attitude toward Escorts, and the time you spent with each other.</li>
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
                     <p>While you have the client on the phone, this is the best time to ask questions and to make an informed judgment about the client.</p>
                     <ol class="mb-0">
                        <li>Always trust your gut instinct. Don’t confirm the booking if something doesn’t sound right.</li>
                        <li>Check clients have read your profile to avoid any misunderstanding and importantly, timewasters. For example, do they know your name, are they asking for information that is available on your profile such as prices, services available?</li>
                        <li> Most Escorts will not answer withheld or pay phone numbers.</li>
                        <li> Be particularly wary of detailed outfit/role play requests. Some of these callers may be entertaining themselves while on the phone and have no intention of taking it further.</li>
                     </ol>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#payments_safety" aria-expanded="false">
                  Payments, safety and spotting a scam
                  </a>
               </div>
               <div id="payments_safety" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p>It is important that you make it very clear to any client as to what your payment terms are. Your E4U Profile sets out very clearly what your payment terms are.</p>
                     <ol class="mb-0">
                        <li>Many Escorts insist on a cash payment, or in more recent times, PayID. Always get the money up front with clients before ‘anything’ happens. Some clients may say they ‘don’t usually’ pay until the end, be clear it’s your professional practice to receive payment for your companionship upon the client’s arrival.</li>
                        <li>During a booking it can be helpful to keep the money out of sight to avoid any attempted robberies or wandering hands. If you tour, look for a place with a safe or frequently deposit the money into a bank to decrease any chances of a robbery.</li>
                        <li>Some Escorts take credit card details or a deposit into an account so there is a ‘digital footprint’ related to bank details.</li>
                        <li>Some card processing companies do not accept accounts or close accounts if they discover the person is an Escort. Consider this when choosing your payment options.</li>
                        <li>Some Escorts and clients use peer to peer money transfer apps for anonymous, fast money transfers, however many of these apps do not encourage payments for adult services so it is always worth checking the terms and conditions before using these services.</li>
                        <li>Some Escorts will accept the use of ‘crypto currencies’. There are many out there including for adult services. Some people like these because they can see if the payment has gone through. But they are usually anonymous. To be prudent, you may want to also run extra screening and identity checks when booking your client’s appointment.</li>
                        <li>Some Escorts accept Amazon or other gift voucher as deposits. Some clients also prefer this option as well because it remains anonymous to both the client and the Escort. Similarly some Escorts will have items on their wish lists of the same value as their deposit and request these in place of a monetary deposit.</li>
                        <li>Be wary of ‘too good to be true’ offers. Some people target new Escorts hoping to exploit their lack of experience. A valuable mantra to hold on to, despite the temptation of large amounts of money, ‘if it sounds too good to be true, it usually is.’ Even experienced Escorts have been scammed or taken advantage of when lured in by offers of huge amounts of money, being lavished with luxury gifts, holidays, etc.</li>
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
                     <p>Trust your instincts at pre-booking as well as at all the stages. If you think someone sounds dodgy, like they are making the call to get kicks, or if you feel your boundaries are being pushed or you feel in any way uncomfortable, end the call, and don’t take the booking. Instincts can be invaluable in this line of work and are often undervalued. Consider making a report of the incident <a href="/escort-dashboard/add-report" class="custom_links_design">here.</a></p>
                    
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#call_screening" aria-expanded="false">
                  In call screening 
                  </a>
               </div>
               <div id="call_screening" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p> It is important that you always undertake some screening before you meet with your client. At the very least, you might consider following these suggestions.</p>
                     <ol class="mb-0">
                        <li>Have a sneaky peak – try to make arrangements so you are able to see the client arrive. This may be at a landmark you can see which you have asked the client to go to.</li>
                        <li>If doing in calls at home or a work apartment install a peep hole and CCTV system. Many cameras can now be connected to your mobile phone and purchased at a reasonable price. They are able to be deployed on a mobile basis, that is you can take them with you wherever you go.</li>
                        <li>Check there is not more than one person. Some people can hide out of view of CCTV.</li>
                        <li>Check the client is not drunk or high.</li>
                        <li>Stay vigilant, be aware of theft, look out for traveling hands, clients who seemingly
                           appear to be ‘scoping out’ the property on arrival, e.g. looking around at the room/flat
                           (sometimes followed by leaving, ‘look and walk’).</li>
                           <li>Always get the money up front.</li>
                     </ol>
                  </div>
               </div>
            </div>
         </d>
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