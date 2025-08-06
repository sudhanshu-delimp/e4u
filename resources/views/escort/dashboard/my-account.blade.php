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
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!--middle content end here-->

   <div class="row">
    <div class="col-md-12">
        <div class="v-main-heading h3" style="display: inline-block;"><h1 class="p-0 m-0">Edit My Account</h1></div>
        <h6 class="helpNoteLink collapsed" data-toggle="collapse" data-target="#notes" aria-expanded="false"><b>Help?</b></h6>
  </div>
  <div class="col-md-12 my-4">
    <div class="card collapse" id="notes">
        <div class="card-body">
           <h3 class="NotesHeader"><b>Notes:</b> </h3>
           <ol>
              <li>Use this feature to complete all of your personal details - who you are,
                 information about 'PayID', Profiles and Tours, and how Users communicate with
                 you.
              </li>
              <li>
                 Make sure you take the time to complete everything, it will help you
                 manage your Account much better, especially with communication. If you
                 are not sure about any of the settings, get in touch with our
                 <a href="{{ url('contact-us')}}" class="custom_links_design">Help Centre</a>
                 or your <a href="{{ url('escort-dashboard/escort-agency-request')}}" class="custom_links_design">Agent</a> if you have appointed one.
              </li>
              <li>There is some general information also available to you inside each of the
                 My Account groups.
              </li>
           </ol>
        </div>
     </div>
  </div>
</div>

   <div class="row">
 
      <div class="col-md-12">
         <div id="commanAlert" class="alert d-none rounded" role="alert"></div>
      </div>
      <div class="col-md-12">
         <div id="accordion" class="myacording-design">
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#about_me" aria-expanded="false">
                  About me
                  </a>
               </div>
               <div id="about_me" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                     <form id="userProfile" class="v-form-design" action="{{ route('escort.account.update',[$escort->id])}}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-md-10 px-0">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num">Membership Number</label>
                                       <span class="form-control form-back" >{{ $escort->member_id }}</span>
                                       {{-- <input type="number" class="form-control" id="membership_num" placeholder="E123456" aria-describedby="emailHelp"> --}}
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="membership_num form-back">Date Joined</label>
                                       {{-- <input type="date" class="form-control" placeholder=" " aria-describedby="emailHelp"> --}}
                                       <label class="form-control form-back" placeholder=" " aria-describedby="emailHelp">{{Carbon\Carbon::parse($escort->created_at)->format('d/m/Y')}}</label>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="my_name common-tooltip" for="my_name">
                                        My Name
                                      
                                       <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}">
                                       <span class="tooltip-text">
                                          You can also create <a target="_blank" href="{{route('escort.profile.information')}}">Stage Names</a> to use in any Profile.
                                      </span>
                                       </label>
                                       <input type="text" class="form-control" name="name" placeholder="Enter name..." value="{{ $escort->name }}">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="Gender">Gender</label>
                                       <select class="form-control" name="gender" required>
                                          <option value="">Select</option>
                                          @foreach(config('escorts.profile.genders') as $key => $gender)
                                          <option value="{{$key}}" {{ ($escort->gender == $key)? 'selected' : ''}}>{{$gender}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="mobile" class="common_help_icon common-tooltip">Mobile
                                          <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}">
                                       <span class="tooltip-text">This is the number which will be displayed in your Profiles.</span>
                                          
                                       </label>
                                       <span class="form-control form-back">{{ $escort->phone }}</span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="my-agent common-tooltip" for="home_state">Home State
                                          <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}">
                                       <span class="tooltip-text">This is the State you reside in. If you created your Account while you were in another State, log a <a target='_blank' href='{{url('escort-dashboard/submitticket')}}'>Support Ticket</a> and we will correct your setting.</span>
                                       </label>
                                       <label  class="form-control form-back" placeholder="Western Australia" aria-describedby="emailHelp" id="stateNew" name="state_id" value="{{$escort->state_id}}">
                                       {{ $escort->state_id ? config('escorts.profile.states')[$escort->state_id]['stateName'] : ''}}
                                       </label>
                                       <span id="state-errors"></span>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                       <input type="email" class="form-control" name="email" placeholder="JaneDoe@domain.com.au" aria-describedby="emailHelp" value="{{ $escort->email }}">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="my-agent common-tooltip" for="my_agent">
                                       <span>My Agent
                                          <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}">
                                       <span class="tooltip-text">You can appoint an Agent to assist you by completing the Agency Request form.  If you want to appoint an Agent, <a href='{{url('escort-dashboard/escort-agency-request')}}'>click here.</a></span>
                                       </label>
                                       </span>
                                       <span class="form-control form-back">                                                         

                                          @if(auth()->user()->my_agent)
                                                {{ auth()->user()->my_agent->member_id }}
                                             @else
                                                <a href="{{ url('/escort-dashboard/escort-agency-request') }}"> Request one</a>
                                             @endif
                                       
                                       </span>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="email">Method of contact:</label>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" checked type="checkbox" name="contact_type[]" id="Method_Message" value="1"  @if(!empty($escort->contact_type)) {{(in_array(1 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                          <label class="form-check-label" for="Method_Message">Message (via Console)</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Text" value="2"  @if(!empty($escort->contact_type)) {{(in_array(2 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                          <label class="form-check-label" for="Method_Text">Text</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_Email" value="3"  @if(!empty($escort->contact_type)) {{(in_array(3 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                          <label class="form-check-label" for="Method_Email">Email</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                          <input class="form-check-input" type="checkbox" name="contact_type[]" id="Method_call_me" value="4" @if(!empty($escort->contact_type)) {{(in_array(4 , $escort->contact_type)) ? 'checked' : null }} @endif>
                                          <label class="form-check-label" for="Method_call_me">Call me</label>
                                       </div>
                                    </div>
                                 </div>
                                 {{-- new field added --}}
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="email" class="common_help_icon common-tooltip">PayID Name
                                          <img class="delay_tooltip tooltip-icon" src="{{ asset('assets/app/img/home/quationmarkblue.svg')}}">
                                       <span class="tooltip-text">Complete this information if you use PayID with your clients.</span>
                                          
                                       </label>
                                       <input type="email" class="form-control" name="email" placeholder="Insert your Bank Account name" aria-describedby="emailHelp">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="email">PayID Number</label>
                                       <input type="email" class="form-control" name="email" placeholder="Insert your PayID Number" aria-describedby="emailHelp">
                                    </div>
                                 </div>
                                 {{-- end --}}
                              </div>
                           </div>
                        </div>
                        <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                     </form>
                  </div>
                  <div class="card-body">
                     <div id="accordion-2">
                        <div class="card">
                           <div class="card-header" id="heading-1-2">
                              <h5 class="mb-0">
                                 <a class="card-link collapsed" data-toggle="collapse" href="#collapse-1-2" aria-expanded="false">
                                 Important information
                                 </a>
                              </h5>
                           </div>
                           <div id="collapse-1-2" class="collapse" data-parent="#accordion-2" aria-labelledby="heading-1-2" style="">
                              <div class="card-body">
                                 <h5 class="d_sub_heading">General information</h5>
                                 <ol class="pl-3">
                                    <li>The information set out on this page is mandatory.</li>
                                    <li>
                                       When you create a Profile
                                       <ul class="list-new">
                                          <li class="d-flex">your name will appear in the Profile by default. You can change your name in the Profile to a Stage Name at anytime by selecting it from the drop down menu in the Profile creator, or by editing a saved Profile from your Archive Folder.</li>
                                          <li class="d-flex">it will always default to your Home State unless you change the Location while creating the Profile by selecting the Location you want the Profile to appear in from the drop down menu in the Profile creator.</li>
                                       </ul>
                                    </li>
                                    <li>If you select ‘Message’ as your preferred method of contact with us, you will receive a text message from us advising that you have a Message waiting for you. Log on to retrieve the message.</li>
                                    <li>If you have any queries regarding your appointed Agent, contact the Escorts4U help centre by raising a Support Ticket. Please include the Agent ID number. </li>
                                 </ol>
                                 <h5 class="d_sub_heading">Home State</h5>
                                 <p>If you want to change your Home State, contact the Escorts4U help centre by raising a <a class=" " href="{{ url('escort-dashboard/submitticket') }}" style="font-size: 16px;"><span class="custom_links_design">Support Ticket.</span></a> You can not change your Home State, only Escorts4U support staff can change your Home State. You will have to provide proof that you have relocated to a new Home State.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <a class="card-link collapsed" data-toggle="collapse" href="#profile_and_tour_options" aria-expanded="false">
                  Profile and Tour options
                  </a>
               </div>
               <div id="profile_and_tour_options" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body d_sub_heading">
                     <form class="v-form-design" id="profile_tour_options" action="{{ route('escort.account.profile.tour.update',[$escort->id])}}" method="POST">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="email">Profile creator settings</label><br>
                                 <div class="form-check form-check-inline">
                                    <input name="profile_creator[]"  class="form-check-input" type="checkbox" id="Method_Message" value="1" @if(!empty($escort->profile_creator)) {{(in_array(1 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Message">Include Profile Information (Stage Name optional)</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input name="profile_creator[]"  class="form-check-input" type="checkbox" id="Method_Text" value="2" @if(!empty($escort->profile_creator)) {{(in_array(2 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Text">Include Profile Information and allow to over ride</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input name="profile_creator[]" class="form-check-input" type="checkbox" id="Method_Email" value="3" @if(!empty($escort->profile_creator)) {{(in_array(3 , $escort->profile_creator)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Email">Include social media information</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="email">How can Viewers contact me</label><br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="viewer_contact_type[]" id="Method_Message" value="1"  @if(!empty($escort->viewer_contact_type)) {{(in_array(1 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Message">Call me</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="viewer_contact_type[]" type="checkbox" id="Method_Email" value="3"  @if(!empty($escort->viewer_contact_type)) {{(in_array(3 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Email">Email me (only for private communications with a Viewer)</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="viewer_contact_type[]" type="checkbox" id="Method_Text" value="2"  @if(!empty($escort->viewer_contact_type)) {{(in_array(2 , $escort->viewer_contact_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Text">Text me</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="email">Tour options</label><br>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Message" value="1" @if(!empty($escort->tour_permissition_type)) {{(in_array(1 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Message">Allow Tours to be created</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Text" value="2" @if(!empty($escort->tour_permissition_type)) {{(in_array(2 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Text">Allow Tours to be edited</label>
                                 </div>
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="tour_permissition_type[]" type="checkbox" id="Method_Email" value="3" @if(!empty($escort->tour_permissition_type)) {{(in_array(3 , $escort->tour_permissition_type)) ? 'checked' : null }} @endif>
                                    <label class="form-check-label" for="Method_Email">Post a Tour leg one day before the arrival date</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <input type="submit" value="save" class="btn btn-primary shadow-none float-right" name="submit">
                     </form>
                  </div>
                  <div class="card-body">
                     <div id="accordion-1">
                        <div class="card">
                           <div class="card-header" id="heading-1-1">
                              <h5 class="mb-0">
                                 <a class="card-link" data-toggle="collapse" href="#collapse-1-1" aria-expanded="true">
                                 General information
                                 </a>
                              </h5>
                           </div>
                           <div id="collapse-1-1" class="collapse" data-parent="#accordion-1" aria-labelledby="heading-1-1" style="">
                              <div class="card-body">
                                 <ol>
                                    <li>By selecting a contact option, the option will appear in your Profile.</li>
                                    <li>If you disable ‘Allow Tours to be edited’ you will not be able to edit a Tour should the need arise.</li>
                                    <li>If you enable ‘Post a Tour leg ...’ you will be charged for that day.</li>
                                 </ol>
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
@endsection
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript">
   $('#userProfile').parsley({
   
   });
   
   function showAlert(message, type = 'success') {
       const alertBox = $('#commanAlert');
       alertBox
           .removeClass('d-none alert-success alert-danger')
           .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
           .html(message);
   
       setTimeout(() => {
           alertBox.addClass('d-none');
       }, 10000);
   }
   
       $('#userProfile').on('submit', function(e) {
           e.preventDefault();
           var form = $(this);
           $("#modal-title").text('About Me');
   
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
                   showAlert("Your details have been updated successfully.", "success");
                   } else {
                   showAlert("Oops... something went wrong. Please try again.", "danger");
                   }
               }
               });
           }
       });
   
       $('#profile_tour_options').on('submit', function(e) {
           e.preventDefault();
           var form = $(this);
           var url = form.attr('action');
           var data = new FormData(form[0]);
           $("#modal-title").text('Profile and Tour options');
   
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
                   showAlert("The profile and tour options have been updated successfully.", "success");
               } else {
                   showAlert("Oops... something went wrong. Please try again.", "danger");
               }
               }
           });
       });
   
   $("#close").click(function()
     {
         $("#my_account_modal").hide();
         location.reload();
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