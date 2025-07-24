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
   .slider-switch {
   width: 40px;
   height: 20px;
   position: relative;
   display: inline-block;
   }
   .slider-switch input {
   opacity: 0;
   width: 0;
   height: 0;
   }
   .slider-slider {
   position: absolute;
   cursor: pointer;
   background-color: #ccc;
   border-radius: 20px;
   top: 0;
   left: 0;
   right: 0;
   bottom: 0;
   transition: 0.4s;
   }
   .slider-slider:before {
   position: absolute;
   content: "";
   height: 14px;
   width: 14px;
   left: 3px;
   bottom: 3px;
   background-color: white;
   transition: .4s;
   border-radius: 50%;
   }
   .slider-switch input:checked + .slider-slider {
   background-color: #28a745;
   }
   .slider-switch input:checked + .slider-slider:before {
   transform: translateX(20px);
   }
   .total_listing{
    font-size: 14px;
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5">
   <!--middle content start here-->
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block;">
            <h1 class="p-0 m-0">My Legbox Viewers</h1>
         </div>
         <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
      </div>
      <div class="col-md-12 my-2">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                  <li>Registered Viewers who have flagged you in their Legbox are listed here.</li>
                  <li>Status includes Contact, Method, and Viewer Communication.</li>
                  <li>You can override contact preferences.</li>
                  <li>Blocking a viewer hides your profile from them.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div class="row my-2">
      <!-- My Legbox -->
      <div class="col-md-12 mb-4">
         <div class="mb-3 d-flex align-items-center justify-content-end flex-wrap gap-10">
            <div class="total_listing">
               <div><span>Total Viewers Legbox : </span></div>
               <div><span>01</span></div>
            </div>
         </div>
         <div class="table-responsive list-sec">
            <table class="table table-bordered table-hover mb-0">
               <thead>
                  <tr>
                     <th>Viewer ID</th>
                     <th>Home State</th>
                     <th>Contact Enabled</th>
                     <th>Contact Method</th>
                     <th>Viewer Communication</th>
                     <th>Block Viewer</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>V60587</td>
                     <td>Western Australia</td>
                     <td>Yes</td>
                     <td>Text</td>
                     <td>0438 028 728</td>
                     <td>
                        <label class="slider-switch">
                        <input type="checkbox" checked="">
                        <span class="slider-slider"></span>
                        </label>
                     </td>
                     <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-phone-slash"></i> Disable Contact</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-bell-slash"></i> Disable Notifications</a>
                           </div>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>V60485</td>
                     <td>Western Australia</td>
                     <td>No</td>
                     <td>Disabled</td>
                     <td>-</td>
                     <td>
                        <label class="slider-switch">
                        <input type="checkbox">
                        <span class="slider-slider"></span>
                        </label>
                     </td>
                     <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-phone-slash"></i> Disable Contact</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-bell-slash"></i> Disable Notifications</a>
                         </div>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>V60789</td>
                     <td>Western Australia</td>
                     <td>Yes</td>
                     <td>Email</td>
                     <td>viewer@gmail.com</td>
                     <td>
                        <label class="slider-switch">
                        <input type="checkbox">
                        <span class="slider-slider"></span>
                        </label>
                     </td>
                     <td>
                        <div class="dropdown no-arrow">
                           <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                           </a>
                           <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-phone-slash"></i> Disable Contact</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#"> <i class="fa fa-bell-slash"></i> Disable Notifications</a>
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