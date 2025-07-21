@extends('layouts.agent')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   #Agent_Agreement .modal-dialog {
    max-width: 1000px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content start here-->
   <!-- Page Heading -->
   <div class="row">
      <div class="custom-heading-wrapper col-lg-12">
         <h1 class="h1">Edit My Account</h1>
         <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes" aria-expanded="true">Help?</span>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
               </ol>
            </div>
         </div>
      </div>
   </div>
   {{-- end --}}
   <div class="row">
      <div class="col-md-12 mb-5">
         <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#Abbreviations" aria-expanded="true">
                  About Me
                  </a>
               </div>
               <div id="Abbreviations" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                     {{-- 
                     <form id="userProfile" class="v-form-design"> --}}
                     <form id="userProfile" class="v-form-design" action="{{ route('agent.account.update',[$user->id])}}" method="POST">
                        <input type="hidden" name="_token">                        
                        <div class="row">
                           <div class="col-md-10 px-0">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Membership Number</label>
                                       <span class="form-control form-back">{{ $user->member_id }}</span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Date Joined</label>
                                       <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">{{Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}</label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="my_name">Business Name</label>
                                       <input type="text" class="form-control text-capitalize" name="business_name" placeholder=" Business Name" aria-describedby="emailHelp" value="{{ $user->business_name}} ">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="my_name" class="my-agent">ABN</label>
                                       <input type="txt" class="form-control" id="mobileno" aria-describedby="emailHelp" name="abn" data-parsley-maxlength="12" required  placeholder="ABN" data-parsley-required-message="Your ABN is required" value="{{ $user->abn }}" data-parsley-type="integer" data-parsley-type-message="Enter only numbers" >
                                       <span id="abn-errors"></span> 
                                       <div class="termsandconditions_text_color">
                                          @error('abn')
                                          <strong>{{ $message }}</strong>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile">Business Address</label>
                                       <input type="text" class="form-control" name="business_address" placeholder="Business Address " aria-describedby="emailHelp" value=" {{ $user->business_address}}">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile">Business Number</label>
                                       <input type="txt" class="form-control" id="mobileno" aria-describedby="emailHelp" name="business_number" data-parsley-maxlength="10" required  placeholder="Business Number" data-parsley-required-message="Your Business Number is required" value="{{ $user->business_number}}" data-parsley-type="digits" data-parsley-type-message="Enter only numbers" >
                                       <span id="business_number-errors"></span> 
                                       <div class="termsandconditions_text_color">
                                          @error('business_number')
                                          <strong>{{ $message }}</strong>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile">Contact</label>
                                       <input type="text" class="form-control" name="contact_person" placeholder=" Contact " aria-describedby="emailHelp" value="{{ $user->contact_person}} ">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobileno">Mobile</label>
                                       <input type="txt" class="form-control" id="mobileno" aria-describedby="emailHelp" name="phone" data-parsley-maxlength="10" required  placeholder="Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ $user->phone }}" data-parsley-type="digits" data-parsley-type-message="Enter only mobile numbers" >
                                       <span id="phone-errors"></span> 
                                       <div class="termsandconditions_text_color">
                                          @error('phone')
                                          <strong>{{ $message }}</strong>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">{{ __('Email') }}</label>
                                       <input  type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email2" value="{{ $user->email2}}" required autocomplete="email" placeholder="Email Address" data-parsley-required-message="@lang('errors/validation/required.email')" data-parsley-type-message="@lang('errors/validation/valid.email')" >
                                       <span id="email2-errors"></span> 
                                       <div class="termsandconditions_text_color">
                                          @error('email2')
                                          <strong>{{ $message }}</strong>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile">Territory</label>
                                       <label class="form-control form-back" aria-describedby="emailHelp" >{{$user->state->name}} </label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile">E4U Email</label>
                                       <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">{{$user->email}} </label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       
                                       
                                    </div>
                                 </div>
                                 <div class="col-md-10">
                                    <div class="form-group">
                                       <label for="mobile">Method of contact - how we communicate with you</label><br>
                                       <div class="form-check-inline">
                                          <label class="customradio mr-4"><input type="checkbox"  name="contact_type[]" value="1"  @if(!empty($user->contact_type)) {{(in_array(1 , $user->contact_type)) ? 'checked' : null }} @endif>
                                          <span class="radiotextsty">Message (via Console)</span>
                                          </label>
                                          <label class="customradio mr-4"><input type="checkbox"  name="contact_type[]" value="2"  @if(!empty($user->contact_type)) {{(in_array(2 , $user->contact_type)) ? 'checked' : null }} @endif>
                                          <span class="radiotextsty">Text</span>
                                          </label><label class="customradio mr-4"><input type="checkbox"  name="contact_type[]" value="3"  @if(!empty($user->contact_type)) {{(in_array(3 , $user->contact_type)) ? 'checked' : null }} @endif>
                                          <span class="radiotextsty">Email</span>
                                          </label><label class="customradio mr-4"><input type="checkbox"  name="contact_type[]" value="4"  @if(!empty($user->contact_type)) {{(in_array(4 , $user->contact_type)) ? 'checked' : null }} @endif>
                                          <span class="radiotextsty">Call me</span>
                                          </label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                     </form>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#lingo" aria-expanded="false">Agreement</a>
               </div>
               <div id="lingo" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                     <form id="userProfile2" class="v-form-design" novalidate="">
                        <input type="hidden" name="_token">                        
                        <div class="row">
                           <div class="col-md-10 px-0">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Agreement Date</label>
                                       <span class="form-control form-back">{{ $user->member_id }}</span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Term</label>
                                       <span class="form-control form-back">3 Years</span>
                                       </label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="my_name">Option Period</label>
                                       <span class="form-control form-back">3 Years+ 3 Years</span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="my_name" class="my-agent">Option Exercised</label>
                                       <span class="form-control form-back">Not Applicable</span>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="mobile">Territory</label>
                                       <label class="form-control form-back" aria-describedby="emailHelp">{{$user->state->name}}</label>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <h5 for="mobile">Your Agreement</h5>
                                       <label>You can retrieve your Agent Agreement by <a href="#" data-toggle="modal" data-target="#Agent_Agreement" class="custom_links_design"><span style="color: #FF3C5F;">clicking here.</span></a></label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit"> -->
                     </form>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#abbrieviations" aria-expanded="false">Commission</a>
               </div>
               <div id="abbrieviations" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                     <form id="userProfile3" class="v-form-design" novalidate="">
                        <input type="hidden" name="_token">                        
                        <div class="row">
                           <div class="col-md-10 px-0">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Advertising
                                       </label>
                                       <span class="form-control form-back">5%</span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Massage Centre (Registrations)</label>
                                       <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">$20.00</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--  <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit"> -->
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="Agent_Agreement" tabindex="-1" role="dialog" aria-labelledby="Edit_CompetitorLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="Agent_Agreement">Agent Agreement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
         <iframe src="{{asset('assets/app/img/Agent%20Agreement%20-%20Victoria%20(10-2021).pdf') }}" width="100%" height="800" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                        $('.comman_msg').html("Saved");
                        //$("#my_account_modal").modal('show');
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');
               
                   } else {
                     $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                     $("#comman_modal").show();
   
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