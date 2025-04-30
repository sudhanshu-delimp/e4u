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
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5">
            <!--middle content-->
               <div class="row">
                     <div class="col-md-12">
                           <div class="v-main-heading h3">
                           Mobile SIM
                              <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
                           </div>
                     </div>
               </div>
               <div class="col-md-12 ">
                  <div class="card collapse  mb-4" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                        <li>This form will be pre-populated with your details according to what you have
                        entered in <a href="#">My Account</a>. You can alter any of the information.</li>
                        <li>Payment is based on the period you have selected for the Mobile SIM.</li>
                        <li>Complete the form to request the Mobile SIM. When completing the form please
                        Place Order Up to 300 characters ensure all of the details are correct and you have selected the correct option for communications.</li>
                        </ol>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 mt-4 mb-5">
               <div class="row">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12">
                              <h3 class="pb-2 pt-2"><b>Partnership</b> </h3>
                              <p>Escorts4U has partnered with a leading supplier of telecommunication services to be ableto supply a mobile SIM, delivered to your nominated address.</p>
                           </div>
                         </div>
                     </div>
                  </div>

               <form class=" ">
                  <div class="row">
                     <div class="col-md-12">
                        <h3 class="pb-2 pt-2"><b>Order Mobile SIM</b> </h3>
                           <div class="form-group w-50">
                              <div><label for="preference"><b>Your contact preference</b> </label></div>
                              <div class="form-check form-check-inline">
                                 <input name="contact_pref"  class="form-check-input" type="checkbox" id="pref_Email" value="1">
                                 <label class="form-check-label" for="pref_Email">Email</label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input name="contact_pref"  class="form-check-input" type="checkbox" id="pref_Mobile" value="1">
                                 <label class="form-check-label" for="pref_Mobile">Mobile</label>
                              </div>
                           </div>

                           <b>Your details:</b>
                           <div class="ml-4 mt-2">
                              <div class="form-group w-50">
                                 <label for="email"><b>First Name</b> </label>
                                 <input id="name" placeholder="First Name" name="name" type="text" class="form-control" required="">
                              </div>
                              <div class="form-group w-50">
                                 <label for="email"><b>Last Name</b> </label>
                                 <input id="name" placeholder="Last Name" name="name" type="text" class="form-control" required="">
                              </div>
                              <div class="form-group w-50">
                                 <label for="email"><b>Email Address</b></label>
                                 <input id="name" placeholder="Email" name="name" type="text" class="form-control" required="">
                              </div>
                              <div class="form-group w-50">
                                 <label for="email"><b>Mobile Number</b> </label>
                                 <input id="name" placeholder="Mobile" name="name" type="text" class="form-control" required="">
                              </div>
                              <div class="form-group w-50">
                              <label for="exampleFormControlTextarea1"><b>Comments</b> (<i>Please provide any additional information that may assist</i>)
                           </label>
                           <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                           </div>
                        
                        
                     </div>
                  </div>
                  <input type="submit" value="Send request" class="new-btn-sec btn btn-primary shadow-none" name="submit">
               </form>


               </div>
               <div>qqqq</div>
               <!--middle content end here-->
               <!--right side bar start from here-->
            </div>
         </div>
      </div>
   </div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush
