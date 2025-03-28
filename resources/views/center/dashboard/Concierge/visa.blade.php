@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3">Visa, Migration & Education Services Advice</div>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <h3><b>Partnership</b> </h3>
                     <p class="mb-1">Escorts4U has partnered with LWS Migration Advisory <span class="theme-text-color"><b>(LWSMA)</b></span> to offer Visa, Migration and Education services <span class="theme-text-color"><b>(Services)</b></span> to Escorts. LWSMA is a licensed migration agent (MARN:1171426) and is well placed to provide the Services. LWSMA is also a mumber of the Migration Alliance (MA:****)</p>
                  </div>
               </div>
            </div>
         </div>
         <form class=" ">
            <div class="row">
               <div class="col-md-12">
                  <h3 class="pb-2 pt-2"><b>Available services</b> </h3>
                  <p>LWSMA offers the following Visa Services:</p>
                  <ul>
                     <li>Visa and Migration advice including renewals and ongoing assistance</li>
                     <li>Education course selection advice including ongoing assistance</li>
                  </ul>
                  <h3 class="pb-2 pt-2"><b>Enquire</b> </h3>
                  <div class="form-group w-50">
                     <label for="email"><b>First Name</b> </label>
                     <input id="name" placeholder="First Name" name="name" type="text" class="form-control" required="">
                  </div>
                  <div class="form-group w-50">
                     <label for="email"><b>Last Name</b> </label>
                     <input id="name" placeholder="Last Name" name="name" type="text" class="form-control" required="">
                  </div>
                  <div class="form-group w-50">
                     <label for="email"><b>Email</b></label>
                     <input id="name" placeholder="Email" name="name" type="text" class="form-control" required="">
                     <span>You can use your Escorts4U email account if you have order one</span>
                  </div>
                  <div class="form-group w-50">
                     <label for="email"><b>Mobile</b> </label>
                     <input id="name" placeholder="Mobile" name="name" type="text" class="form-control" required="">
                     <span>This is your home country number. Please include your internation code open</span>
                  </div>
                  <div class="form-group w-50">
                     <label for="email"><b>Passport country of issue</b> <span style="color:red">*</span></label>
                     <input id="name" placeholder="Country of issue" name="name" type="text" class="form-control" required="">
                     <span>You can disclose this information further during your discussion if you want</span>
                  </div>
                  <div class="form-group w-50">
                     <label for="home_state"><b>Home State</b></label>
                     <select class="form-control" placeholder="Western Australia" aria-describedby="emailHelp" required="">
                        <option selected="">--- Select ----------</option>
                        <option>600 Visitor Visa</option>
                        <option>601 Electronic Travel Authority</option>
                        <option>651 eVisitor Visa</option>
                        <option>500 Student Visa</option>
                        <option>485 Temporary Graduate Visa</option>
                        <option>417 Working Holiday Visa</option>
                        <option>462 Work and Holiday Visa</option>
                     </select>
                     <span id="state-errors"></span>
                  </div>
                  <div class="form-group custom-radio mb-0">
                     <label for="email"><b>Indicate which area of advice you are enquiring about</b> </label><br>
                     <input type="radio" id="html" name="fav_language" value="HTML">
                     &nbsp; <label class="m-0" for="html">Visa &/or Migration</label><br><input type="radio" id="css" name="fav_language" value="CSS">
                     &nbsp; <label for="css">Education Course</label><br>
                  </div>
                  <div class="form-group w-50">
                     <label for="exampleFormControlTextarea1"><b>Comments (Please provide any additional information that we need to know)
                     </b></label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                  </div>
               </div>
            </div>
            <input type="submit" value="Send request" class="new-btn-sec btn btn-primary shadow-none" name="submit">
         </form>
         <div id="accordion" class="myacording-design mb-5 mt-5">
            <div class="card w-75">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#Other-important-information" aria-expanded="true">
                  Other important information
                  </a>
               </div>
               <div id="Other-important-information" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p><b>Q? What languages does LWSMA speak?</b></p>
                     <p>We speak English, Cantonese and Mandarin.</p>
                     <p><b>Q? What can you tell me about Education courses?</b></p>
                     <p>Are you interested in education? LWSMA can also assist you with educatuion services. Let us help you with selecting the course that best suits you and your circumstances.</p>
                     <p><b>Q? Can LWSMA help me with any initial questions?</b></p>
                     <p>Yes. There are many circumstances were LWSMA will answer basic questions for no charge. Complete the enquiry form and we will let you know.</p>
                     <p><b>Q? Does Escorts4U communicate with the Australian Government?</b></p>
                     <p>No. Escorts4U does not undertake any communication with, or report to, the the Australian Governemnt. LWSMA may undertake enquiries on your behalf should you engage them. You shoul direct any questions regarding the Australian Governemnt to LWSMA.</p>
                  </div>
               </div>
            </div>
            <div class="card w-75">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#Confidentiality" aria-expanded="true">
                  Confidentiality
                  </a>
               </div>
               <div id="Confidentiality" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p><b>Q? Who will see my request?</b></p>
                     <p>When you lodge a request, an email is sent directly to Vox and a copy to the Escorts4U team.</p>
                     <p><b>Q? Who will I be discussing my enquiry with?</b></p>
                     <p>You will be contacted directly by a member of the Vox team. All conversations will remain confidential between you and Vox. Escorts4U does not have any communications with Vox regarding your ongoing request or any outcome.</p>
                     <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                     </div>
                  </div>
               </div>
            </div>
            <div class="card w-75">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#Contact-details" aria-expanded="true">
                  Contact details
                  </a>
               </div>
               <div id="Contact-details" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p>You can contact LWSMA through either of the following methods:</p>
                     <p>LWS Migration Advisory<br>
                        50-52 Kishorn Road<br>
                        Applecross WA 6153<br>
                     </p>
                     <p>T: +61 401 443 354<br>
                        E: Please complete the Enquiry form<br>
                        W: <a target="_blank" href="https://www.lwsma.com.au"><span class="theme-text-color">www.lwsma.com.au</span></a>
                     </p>
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
<script type="text/javascript">
   $('#userProfile').parsley({
   
   });
   
   
   
   $('#userProfile').on('submit', function(e) {
       e.preventDefault();
   
       var form = $(this);
   
       if (form.parsley().isValid()) {
   
           var url = form.attr('action');
           var data = new FormData(form[0]);
           $.ajax({
               method: form.attr('method'),
               url: url,
               data: data,
               contentType: false,
               processData: false,
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(data) {
                   if (!data.error) {
                       $.toast({
                           heading: 'Success',
                           text: 'Details successfully saved',
                           icon: 'success',
                           loader: true,
                           position: 'top-right', // Change it to false to disable loader
                           loaderBg: '#9EC600' // To change the background
                       });
   
                   } else {
                       $.toast({
                           heading: 'Error',
                           text: 'Records Not update',
                           icon: 'error',
                           loader: true,
                           position: 'top-right', // Change it to false to disable loader
                           loaderBg: '#9EC600' // To change the background
                       });
   
                   }
               },
   
           });
       }
   });
   $('#city').select2({
       allowClear: true,
       placeholder :'Select City',
       createTag: function(params) {
           var term = $.trim(params.term);
   
           if (term === '') {
               return null;
           }
           return {
               id: term,
               text: term,
               newTag: false // add additional parameters
           }
       },
       tags: false,
       minimumInputLength: 2,
       tokenSeparators: [','],
       ajax: {
           url: "{{ route('city.list') }}",
           dataType: "json",
           type: "GET",
           data: function(params) {
               console.log(params);
               var queryParameters = {
                   query: params.term,
                   state_id: $('#state').val()
               }
               return queryParameters;
           },
           processResults: function(data) {
               return {
                   results: $.map(data, function(item) {
   
                       return {
                           text: item.name,
                           id: item.id
                       }
                   })
               };
           }
       }
   });
   
   $('#state').select2({
       allowClear: true,
       placeholder :'Select State',
       createTag: function(params) {
           var term = $.trim(params.term);
   
           if (term === '') {
               return null;
           }
           return {
               id: term,
               text: term,
               newTag: false // add additional parameters
           }
       },
       tags: false,
       minimumInputLength: 2,
       tokenSeparators: [','],
       ajax: {
           url: "{{ route('state.list') }}",
           dataType: "json",
           type: "GET",
           data: function(params) {
               console.log(params);
               var queryParameters = {
                   query: params.term,
                   country_id: $('#country').val()
               }
               return queryParameters;
           },
           processResults: function(data) {
               return {
                   results: $.map(data, function(item) {
   
                       return {
                           text: item.name,
                           id: item.id
                       }
                   })
               };
           }
       }
   });
   
   
   $('#country').on('change', function(e) {
       if($(this).val()) {
           $('#state').prop('disabled', false);
           $('#state').select2('open');
       } else {
           $('#state').prop('disabled', true);
       }
   });
   
   $('#state').on('change', function(e) {
       if($(this).val()) {
           $('#city').prop('disabled', false);
           $('#city').select2('open');
       } else {
           $('#city').prop('disabled', true);
       }
   });
   
   
</script>
@endpush