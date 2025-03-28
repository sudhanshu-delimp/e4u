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
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3">Mobile SIM Services</div>
      </div>
      <div class="col-md-12 mt-4 mb-5">
         <div class="row">
            <div class="col-md-12 mb-4">
               <div class="card">
                  <div class="card-body">
                     <h3><b>Partnership</b> </h3>
                     <p class="mb-1">Escorts4U has partnered with Vox Australia <span class="theme-text-color"><b>(Vox)</b></span> to offer a mobile SIM service <span class="theme-text-color"><b>(Service)</b></span> to Escorts. Vox is a provider of telecommunications services and is well placed to provide the Services.</p>
                     <h3 class="mb-1 mt-3"><b>About the services</b> </h3>
                     <p class="mb-2">Vox offers the following Services:</p>
                     <ul>
                        <li>Unlimited calls within Australia</li>
                        <li>Unlimited texts within Australia</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <form class=" ">
            <div class="row">
               <div class="col-md-12">
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
                     <span>This is your home country number. Please include your internation code open</span>
                  </div>
                  <div class="form-group w-50">
                     <label for="email"><b>Passport Number</b> <span style="color:red">*</span></label>
                     <input id="name" placeholder="Passport Number" name="name" type="text" class="form-control" required="">
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
                  <a class="card-link" data-toggle="collapse" href="#Terms-of-Use" aria-expanded="true">
                  Terms of Use
                  </a>
               </div>
               <div id="Terms-of-Use" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body pb-0">
                     <p><b>Scope of PAYG Mobile service</b></p>
                     <p>The following terms and conditions govern the appropriate use of our PAYG Mobile Sim service <span class="theme-text-color"><b>(SIM Terms & Conditions).</b></span>
                     </p>
                     <p><b>Acknowledgement</b></p>
                     <p>Escorts4U's partner, Vox Australia <span class="theme-text-color"> (<strong>Vox</strong>)</span>, provides mobile SIM cards to Advertisers <span class="theme-text-color">(<strong>SIM Card</strong>)</span>. You acknowledge that you are responsible for all costs associated with the use of the SIM Card and that you will provide your own compatable mobile phone.</p>
                     <p><b>SIM Terms & Conditions</b></p>
                     <p>1.0  SIM Card Usage  <br>    1.0 SIM Card Usage      </p>
                     <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                     </div>
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
                     <p>You can contact Vox through either of the following methods:</p>
                     <p>Vox Australia<br>
                        GPO Box T1756<br>
                        Perth WA 6001<br>
                     </p>
                     <p>T: +61 1300 666 989 #1<br>
                        E: Please complete the Enquiry form<br>
                        W: <a target="_blank" href="http://www.voxcommunications.com.au"><span class="theme-text-color">www.voxcommunications.com.au</span></a>
                     </p>
                     <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                     </div>
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