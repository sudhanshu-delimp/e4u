@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">


<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.new.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   }
   .at-sec {
   position: relative;
   width: 450px;
   }
   .at-lable{
   display: flex;
   flex-direction: row;
   align-items: center;
   }
   .at-lable label {
   width: 70%;
   font-size: 16px;
   font-weight: 400;
   margin: 0;
   }
   .at-sec input {
   height: 36px;
   width: 100%;
   padding: 0px 10px 0px 30px;
   border-radius: 3px;
   border: 1.8px solid #d1d3e2;
   font-size: 13px;
   font-weight: 400;
   color: #d1d3e2;
   background: white url({{asset('avatars/Vector-24.svg')}}) 8px 8px no-repeat;
   }
   .at-sec input:focus {
   outline: none;
   border-color: #d1d3e2;
   }
    .at-sec li:focus + .results { display: block }
   .at-sec .results {
   display: none;
   position: absolute;
   top: 40px;
   left: 0;
   right: 0;
   z-index: 10;
   padding: 0;
   margin: 0;
   padding-left: 11.2rem;
   border-radius: 0.5px solid #C4C4C4;
   }
   .at-sec div.myacording-design .card .card-body ol li, div.myacording-design .card .card-body ul li, div.myacording-design .card .card-body p {
   margin-bottom: 0;
   background: #fff;
   box-shadow: 0px 4px 4px rgb(0 0 0 / 25%);
   }
   .at-sec .results li { display: block; width: 270px; }
   /*.at-sec .results li:first-child { margin-top: -1px }*/
   .at-sec .results li:first-child:before, .search .results li:first-child:after {
   display: block;
   content: '';
   width: 0;
   height: 0;
   position: absolute;
   left: 50%;
   margin-left: -5px;
   border: 5px outset transparent;
   }
   .at-sec .results li:first-child:after {
   border-bottom: 5px solid #fdfdfd;
   top: -10px;
   }
   .at-sec .results li:first-child:hover:before, .search .results li:first-child:hover:after { display: none }
   .at-sec .results li:last-child { margin-bottom: -1px }
   .at-sec .results a {
   display: block;
   position: relative;
   padding: 10px 40px 10px 10px;
   color: #000;
   font-weight: 500;
   font-size: 14px;
   }
   .at-sec .results a:hover {
   text-decoration: none;
   color: #fff;
   text-shadow: 0 -1px rgba(0, 0, 0, 0.3);
   border-color: #0C223D;
   background-color: #0C223D;
   }
   .active-play .at-lable {
   display: block;
   }
   .active-play ul {
   display: flex;
   padding: 0px;
   top: 0;
   position: relative;
   list-style: none;
   gap: 10px;
   }
   .active-play li {
   padding: 10px;
   border-radius: 3px;
   background: #0C223D;
   }
   .active-play a {
   color: #fff;
   }

.custom-x-link{        
    background: #0c223d;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    }
    .custom-x-link .twitter-x-logo{
        width:18px;
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3">
             My Information
             <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
         </div>
          <div class="col-md-12 mt-4">
              <div class="card collapse" id="notes">
                  <div class="card-body">
                      <h3 class="NotesHeader"><b>Notes:</b> </h3>
                      <ol>
                          <li>
                              Use this feature to create all the default information about yourself that will
                              appear in any Profile you create.
                          </li>
                          <li>
                              You can change any of these settings when creating a Profile.
                          </li>
                          <li>
                              There are some further tips contained inside each of the My Information
                              groups.
                          </li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-12 mt-4">
         <div id="accordion" class="myacording-design mb-5" style="max-width: 100%;">
            <div class="card custom-help-contain">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#additional_information">
                  My Additional Information 
                  </a>
               </div>
               <div id="additional_information" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                
                     @include('escort.dashboard.profile.information.partials.aboutme-dash-tab')
                  </div>
               </div>
            </div>
             <div class="card custom-help-contain">
                 <div class="card-header">
                     <a class="collapsed card-link" data-toggle="collapse" href="#my_available_times">
                         My Available Times
                        
                     </a>
                 </div>
                 <div id="my_available_times" class="collapse" data-parent="#accordion">
                     <div class="card-body pb-0">
                         @include('escort.dashboard.profile.information.partials.available-dash-tab')
                     </div>
                 </div>
             </div>
            <div class="card custom-help-contain">
               <div class="card-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#my_playmates">
                  My Playmates
                  
                  </a>
               </div>
               <div id="my_playmates" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                     @include('escort.dashboard.Playmates.partials.playmates')
                  </div>
               </div>
            </div><div class="card custom-help-contain">
               <div class="card-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#my_rates">
                  My Rates
                  
                  </a>
               </div>
               <div id="my_rates" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                    
                     @include('escort.dashboard.profile.information.partials.rate-dash-tab')
                  </div>
               </div>
            </div>
            <div class="card custom-help-contain">
               <div class="card-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#my_service_tags">
                  My Service (tags)
                  
                  </a>
               </div>
               <div id="my_service_tags" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                    
                     @include('escort.dashboard.profile.information.partials.services-dash-tab')
                  </div>
               </div>
            </div>
{{--      <div class="card custom-help-contain">
               <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#my_play_mates">
                  My playmates
                  <span class="custom--help"><b>Help?</b></span>
                  </a>
               </div>
               <div id="my_play_mates" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                    <div class="custom-note-section">
                        <div class="card" style="">
                        <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class=" mb-0">
                        <li>By completing these settings, the information set out under My playmates will by default appear in your Profile creator. You should check with the Escort they are still available as a playmate before creating a Profile. A Viewer will be able to view the playmate’s Profile from your Profile
                        </li>
                        <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account" class="custom_links_design">feature</a> (see My Account - Profile & Tour options).
                        </li>
                        </ol>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="card-body border-0 pt-0 pl-0 mt-2">
                     <form class="at-sec" method="post" action="">
                        <div class="at-lable">
                           <label for="Student">Search for playmate</label>
                           <input type="text" name="q" placeholder="Search by name / Member ID" autocomplete="off" class="clickInput">
                           <ul class="results showPlaymates">

                              <li> <a href="#"><img src="{{asset('avatars/imageuser.png')}}" class="img-profile rounded-circle">&nbsp;&nbsp;Lovely babe</a></li>
                              <li> <a href="#"><img src="{{asset('avatars/imageuser.png')}}" class="img-profile rounded-circle">&nbsp;&nbsp;Lovely babe</a></li>
                              <li> <a href="#"><img src="{{asset('avatars/imageuser.png')}}" class="img-profile rounded-circle">&nbsp;&nbsp;Lovely babe</a></li>

                              {{-- {{ dd(auth()->user()->playmates()->pluck('playmate_id'))}} --}}
                              {{-- @foreach($users_for_available_playmate as $allUser)
                              @if(!is_null($allUser->escorts))
                              @foreach($allUser->escorts as $escort)
                              @if(!in_array($escort->id,auth()->user()->playmates()->pluck('playmate_id')->toArray()))
                              @if($escort->membership != null && $escort->start_date != null) --}}
                              {{-- @if($escort->membership == 4 && Carbon\Carbon::parse($escort->start_date)->diffInDays(Carbon\Carbon::parse(now())) <= 14) --}}
                              {{--
                              <li id="list_{{$escort->id}}">
                                 <a href="#">
                                 <img src="{{ $escort->default_image }}" class="img-profile rounded-circle playmats-img " >
                                 {{ $escort->name }}
                                 <span class="playmates_id" value="{{$escort->id}}" data-path="{{$escort->default_image}}" data-name="{{$escort->name}}">Add</span>
                                 {{-- <span>{{Carbon\Carbon::parse($escort->start_date)->format('d/m/Y')}}</span>
                                 <span>{{Carbon\Carbon::now()->format('d/m/Y')}}</span> --}}
                                 {{-- </a>
                              </li> --}}

                              {{-- @endif  --}}
                              {{-- @endif
                              @endif
                              @endforeach
                              @endif
                              @endforeach --}}
                              {{-- @foreach($allEscorts as $escort)
                              <li>
                                 <a href="#">
                                 <img src="{{ $escort->default_image }}" class="img-profile rounded-circle playmats-img " >
                                 {{ $escort->name }} <span class="playmates_id" value="{{$escort->id}}">Add</span>
                                 </a>
                              </li>
                              @endforeach --}}
                           {{-- </ul>
                        </div>
                     </form>
                  </div>
                  <div class="card-body active-play border-0 pt-0 pl-0 mt-1">
                     <div class="at-lable  mt-0">
                        <label for="Student">My Active playmate</label>
                        <ul class="results  mt-2 activePlaymate">

                           @if(!is_null(auth()->user()->playmates))
                           @foreach(auth()->user()->playmates as $playmate)
                           <li id="rmlist_{{$playmate->id}}"> <a href="#"><img src="{{asset($playmate->default_image)}}" class="img-profile rounded-circle playmats-img">{{$playmate->name}}</a>
                              <span class="playmates_rmid" value="{{$playmate->id}}">×</span>
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div> --}}
            <div class="card custom-help-contain">
               <div class="card-header">
                  <a class="collapsed card-link" data-toggle="collapse" href="#my_social_media">
                  My Social Media
                  </a>
               </div>
               <div id="my_social_media" class="collapse" data-parent="#accordion">
                  <div class="card-body pb-0">
                  
                     @include('escort.dashboard.profile.information.partials.social-media-dash-tab')
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
@push('script')
<script>
    $("#modal-title").text('');
   $('#select2-dropdown').select2({
       createTag: function (params) {
           var term = $.trim(params.term);

           if (term === '') {
               return null;
           }
           return {
               id: term,
               text: term,
               newTag: true // add additional parameters
           }
       },
       tags: false,
       minimumInputLength: 2,
       tokenSeparators: [','],
       ajax: {
           url: "{{ route('country.list') }}",
           dataType: "json",
           type: "GET",
           data: function (params) {
               console.log(params);
               var queryParameters = {
                   query: params.term
               }
               return queryParameters;
           },
           processResults: function (data) {
               return {
                   results: $.map(data, function (item) {

                       return {
                           text: item.name,
                           id: item.id
                       }
                   })
               };
           }
       }
   });

   jQuery(document).ready(function(){
	jQuery('span.custom--help').click(function(){
	jQuery(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
	});
});

   $('#update_about_me').parsley({

   });
   $('#socials_link').parsley({

   });
   $('#update_about_me').on('submit', function(e) {
       e.preventDefault();
       var form = $(this);
      $("#modal-title").text('My Additional Information');
       if (form.parsley().isValid()) {

           var url = form.attr('action');
           var data = new FormData($('#update_about_me')[0]);
           $('#update-about-me').prop('disabled', true);
           $('#update-about-me').html('<div class="spinner-border"></div>');
           $.ajax({
               method: form.attr('method'),
               url:url,
               data:data,
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if(!data.error){
                       var msg = "Saved";
                       $('.comman_msg').text(msg);
                       //$("#my_account_modal").show();
                       $("#comman_modal").modal('show');
                       $('#update-about-me').prop('disabled', false);
                       $('#update-about-me').html('Update');
                   } else {
                       $('.comman_msg').text(data.message);
                       $("#comman_modal").modal('show');
                       $('#update-about-me').prop('disabled', false);
                       $('#update-about-me').html('Update');
                   }
               },
               'error': function(error){
                   data = error.responseJSON;
                   $.toast({
                       heading: 'Error',
                       text: data.message,
                       icon: 'error',
                       loader: true,
                       position: 'top-right',      // Change it to false to disable loader
                       loaderBg: '#FF3C5F'  // To change the background
                   });
                   $('#update-about-me').prop('disabled', false);
                   $('#update-about-me').html('Update');
               }
           });
       }
   });
   $('#socials_link').on('submit', function(e) {
       e.preventDefault();

       var form = $(this);
        $("#modal-title").text('My Social Media');
       if (form.parsley().isValid()) {

           var url = form.attr('action');
           var data = new FormData($('#socials_link')[0]);
           $('#update-about-me').prop('disabled', true);
           $('#update-about-me').html('<div class="spinner-border"></div>');
           $.ajax({
               method: form.attr('method'),
               url:url,
               data:data,
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if(!data.error){
                       var msg = "Saved";
                       $('.comman_msg').text(msg);
                       //$("#my_account_modal").show();
                       $("#comman_modal").modal('show');
                       $('#update-about-me').prop('disabled', false);
                       $('#update-about-me').html('Save Social');
                   } else {
                       $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                       $("#comman_modal").modal('show');
                       $('#update-about-me').prop('disabled', false);
                       $('#update-about-me').html('Save Social');
                   }
               },
               'error': function(error){
                   data = error.responseJSON;
                   $.toast({
                       heading: 'Error',
                       text: data.message,
                       icon: 'error',
                       loader: true,
                       position: 'top-right',      // Change it to false to disable loader
                       loaderBg: '#FF3C5F'  // To change the background
                   });
                   $('#update-about-me').prop('disabled', false);
                   $('#update-about-me').html('Save Social');
               }
           });
       }
   });

   $('#read_more').on('submit', function(e) {
       e.preventDefault();

       var form = $(this);
        $("#modal-title").text('My Social Media');
       if (form.parsley().isValid()) {

           var url = form.attr('action');
           var data = new FormData($('#read_more')[0]);

           $('#read-more').prop('disabled', true);
           $('#read-more').html('<div class="spinner-border"></div>');
           $.ajax({
               method: form.attr('method'),
               url:url,
               data:data,
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if(!data.error){

                       $('.Lname').html("Saved");
                       $("#my_account_modal").show();
                       $('#read-more').prop('disabled', false);
                       $('#read-more').html('Update');
                       //location.reload();
                   } else {

                       $('.Lname').html("Oops.. sumthing wrong Please try again");
                       $("#my_account_modal").show();
                       $('#read-more').prop('disabled', false);
                       $('#read-more').html('Update');
                   }
               }
           });
       }
   });



   $('#payment_type').change(function(){
       var payment_typeValue = $('#payment_type').val();
       $("#show_payment_type").show();
       $(".select_pay").hide();
       console.log(payment_typeValue);
       var selectedPayment = $(this).children("option:selected", this).data("name");
       $("#show_payment_type").append(" <div class='select_pay' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedPayment +" </span> </div> ");
    //    $("#container_payment").append("<input type='hidden' name='payment_type[]' value="+ payment_typeValue +">");
   });
   $('#language').change(function(){
       var languageValue = $('#language').val();
       $("#show_language").show();
       $(".select_lang").hide();
       var selectedLanguage = $(this).children("option:selected", this).data("name");
       $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" </span> </div> ");
       $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
       $("#language option[value='"+languageValue+"']").remove();
   });
   $(document).ready(function(){
      $('body').on('click', '.akh1', function() {
           var id = $(this).attr('id');
           var val = $(this).data('val');
           var name = $(this).data('sname');
           $('#hideenclassOne_'+val).remove();

           $("#service_id_one").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>");
           console.log("click "+name);
       });
   });

   $(document).ready(function(){
      $('body').on('click', '.akh2', function() {
           var id = $(this).attr('id');
           var val = $(this).data('val');
           var name = $(this).data('sname');
           $('#hideenclassTwo_'+val).remove();

           $("#service_id_two").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>");
           console.log("click "+name);
       });
   });
   $(document).ready(function(){
      $('body').on('click', '.akh3', function() {
           var id = $(this).attr('id');
           var val = $(this).data('val');
           var name = $(this).data('sname');
           $('#hideenclassThree_'+val).remove();

           $("#service_id_three").append("<option id='"+name+"' value='"+val+"'>"+name+"</option>");
           console.log("click "+name);
       });
   });
   ///////////////clear reset ////////////////////


   $('#service_id_one').on('change', function(){
       var selectedIdOne = $('#service_id_one').val();
       var getNameOne = $(this).children(":selected").attr("id");
       if(selectedIdOne){
           $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><span class='d_profile_name'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=9999><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span> <small class='mytool-tip'>Remove</small> <i class='fas fa-times akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
           $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
           $("#service_id_one option[value="+ selectedIdOne +"]").remove();
           console.log('change='+selectedIdOne);
       }
   });
//    $('body').on('change','#service_id_one', function(){
//        var selectedIdOne = $('#service_id_one').val();
//        var getNameOne = $(this).children(":selected").attr("id");
//        if(selectedIdOne){
//            $("#selected_service_one").append(" <li id='hideenclassOne_"+ selectedIdOne+"'><div class='my_service_anal' ><span class='dollar-sign'>"+getNameOne+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=9999><input type='hidden' name='service_id[]' value="+ selectedIdOne +" placeholder=''><span><i class='fas fa-times akh1' data-sname='"+getNameOne+"' data-val="+ selectedIdOne+"  id='id_"+ selectedIdOne+"' value="+selectedIdOne+"></i></span></div></li> ");
//            $("#service_id_one option[value="+ selectedIdOne +"]").attr('disabled','disabled');
//            $("#service_id_one option[value="+ selectedIdOne +"]").remove();
//            console.log('change='+selectedIdOne);
//        }
//    });

   $('#service_id_two').on('change', function(){
       var selectedIdTwo = $('#service_id_two').val();
       var getNameTwo = $(this).children(":selected").attr("id");
       if(selectedIdTwo){
           $("#selected_service_two").append(" <li id='hideenclassTwo_"+selectedIdTwo+"'><div class='my_service_anal hideenclassTwo"+selectedIdTwo+"'><span class='dollar-sign'>"+getNameTwo+"</span> <span class='d_profile_name'>"+getNameTwo+"</span><input type='number' class='dollar-before input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=9999><input type='hidden' name='service_id[]' value="+ selectedIdTwo +" placeholder=''><span> <small class='mytool-tip'>Remove</small> <i class='fas fa-times akh2'  data-sname='"+getNameTwo+"' data-val="+ selectedIdTwo+"  id='id_"+ selectedIdTwo+"' value="+selectedIdTwo+"></i></span></div></li> ");
           $("#service_id_two option[value="+ selectedIdTwo +"]").attr('disabled','disabled');
           $("#service_id_two option[value="+ selectedIdTwo +"]").remove();
           console.log('change='+selectedIdTwo);
       }
   });

   $('#service_id_three').on('change', function(){
       var selectedIdThree = $('#service_id_three').val();
       var getNameThree = $(this).children(":selected").attr("id");
       if(selectedIdThree){
           $("#selected_service_three").append(" <li id='hideenclassThree_"+ selectedIdThree+"'><div class='my_service_anal hideenclassThree"+selectedIdThree+"'><span class='dollar-sign'>"+getNameThree+"</span><span class='d_profile_name'>"+getNameThree+"</span><input type='number' class='dollar-before  input_border' name='price[]' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step=10 max=9999><input type='hidden' name='service_id[]' value="+ selectedIdThree +" placeholder=''><span> <small class='mytool-tip'>Remove</small> <i class='fas fa-times akh3'  data-sname='"+getNameThree+"' data-val="+ selectedIdThree+"  id='id_"+ selectedIdThree+"' value="+selectedIdThree+"></i></span></div></li> ");
           $("#service_id_three option[value="+ selectedIdThree +"]").attr('disabled','disabled');
           $("#service_id_three option[value="+ selectedIdThree +"]").remove();
           console.log('change='+selectedIdThree);
       }
   });
   //saveProfilename
   $('body').on('click','#saveProfilename', function(e){
       e.preventDefault();
       var profile_name = $('#profile_name').val();
       var start_date = $('#start_date').val();
       var end_date = $('#end_date').val();
       var membership = $('#membership').val();
       if($('#update_about_me').submit()) {
           console.log(" name = "+profile_name);
           window.location.href ="{{ route('escort.profile.basic.update', $escort->id) }}";
       }



   });

   //start available //
   $('.available_to').click( function() {
   var val = $(this).val();
   console.log($(this).val());
   $(this).is(':checked') ? $('#'+val).show() : $('#'+val).hide();
   });

   //end  to
   //start playType //
   $('.playType').click( function() {
   var val = $(this).val();
   var name = $(this).data('name');
   $(".show_playType").show();
   console.log(name);
   // $(this).is(':checked') ? $("#show_playType").append("<div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ name +" </span> </div> ") : '';

   // $(this).is(':checked') ? $('#show_playType').show() : $('#show_playType').hide();
   // });
   if($(this).is(':checked'))
   {
       $("#show_playType").append("<div class='selecated_languages playT' style='display: inline-block' id='"+val+"'><span class='languages_choosed_from_drop_down'>"+ name +" </span> </div> ")
   }
   else
   {
       $('#show_playType #'+val).remove();
   }
   });

   //end  to
   $(".membership_type").each(function( index){
       $('body').on('click','#type_'+index, function(e){
           e.preventDefault();
           var href = $("#membershipType").attr('action');
           var plan_type = $(this).data('value');
           //var data = new FormData($('#membershipType')[0]);
           var id = $('#hidden-escort-id').val();
           console.log()
           $.ajax({
               url : href,
               method : "POST",
               data : {'plan_type': plan_type},
               //contentType: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   console.log(data);
                   if(data.error == 1){
                       $.toast({
                           heading: 'Success',
                           text: 'Record successfully update',
                           icon: 'success',
                           loader: true,
                           position: 'top-right',      // Change it to false to disable loader
                           loaderBg: '#9EC600'  // To change the background
                       });
                   } else {
                       $.toast({
                           heading: 'Error',
                           text: 'Records Not update',
                           icon: 'error',
                           loader: true,
                           position: 'top-right',      // Change it to false to disable loader
                           loaderBg: '#9EC600'  // To change the background
                       });
                   }
               },

       });

   });
   });

   $('#myServices').on('submit', function(e) {
       e.preventDefault();

           var form = $(this);
           var url = form.attr('action');
           var data = new FormData($('#myServices')[0]);
           $("#modal-title").text('My Service (tags)');
           $('#my_services').prop('disabled', true);
           $('#my_services').html('<div class="spinner-border"></div>');

           $.ajax({
               method: form.attr('method'),
               url:url,
               data:data,
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if(!data.error){
                       var msg = "Saved";
                       $('.comman_msg').text(msg);
                       //$("#my_account_modal").show();
                       $("#comman_modal").modal('show');
                       $('#my_services').prop('disabled', false);
                       $('#my_services').html('Save');
                   } else {
                       $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                       $("#comman_modal").modal('show');
                       $('#my_services').prop('disabled', false);
                       $('#my_services').html('Save');
                   }
               },
               error: function (data) {
                   $.toast({
                       heading: 'Error!',
                       text: data.responseJSON.message,
                       icon: 'error',
                       loader: true,
                       position: 'top-right',      // Change it to false to disable loader
                       loaderBg: '#9EC600'  // To change the background
                   });
                   $('#my_services').prop('disabled', false);
                   $('#my_services').html('Update');
               }
           });
       //}
   });

   $('#storeRate').on('submit', function(e) {
       e.preventDefault();
       var form = $(this);
       var url = form.attr('action');
       var data = new FormData($('#storeRate')[0]);
       $("#modal-title").text('My Rates');
       $('#store_rate').prop('disabled', true);
       $('#store_rate').html('<div class="spinner-border"></div>');
       $.ajax({
           method: form.attr('method'),
           url:url,
           data:data,
           contentType: false,
           processData: false,
           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           success: function (data) {
               if(!data.error){
                   var msg = "Saved";
                       $('.comman_msg').text(msg);
                       //$("#my_account_modal").show();
                       $("#comman_modal").modal('show');
           //
                   $('#store_rate').prop('disabled', false);
                   $('#store_rate').html('Save');
               } else {

                   $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                   $("#comman_modal").modal('show');
                   $('#store_rate').prop('disabled', false);
                   $('#store_rate').html('Save');
               }
           }
       });
   });

   $('#myability').on('submit', function(e) {
       e.preventDefault();
       var form = $(this);
       $("#modal-title").text('My Available Times');
       if (form.parsley().isValid()) {

           $('#my_abilities').prop('disabled', true);
           $('#my_abilities').html('<div class="spinner-border"></div>');
           var url = form.attr('action');
           var data = new FormData($('#myability')[0]);
           console.log(data);

           $.ajax({
               method: form.attr('method'),
               url:url,
               data:data,
               contentType: false,
               processData: false,
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               success: function (data) {
                   if(!data.error){
                       var msg = "Saved";
                       $('.comman_msg').text(msg);
                       //$("#my_account_modal").show();
                       $("#comman_modal").modal('show');
                       $('#my_abilities').prop('disabled', false);
                       $('#my_abilities').html('Save');
                   } else {
                       $('.comman_msg').html("Oops.. sumthing wrong Please try again");
                       $("#comman_modal").modal('show');
                       $('#my_abilities').prop('disabled', false);
                       $('#my_abilities').html('Save');
                   }
               }
           });
       }
   });



   $('#read_more').parsley({

   });
   $('#myability').parsley({

   });
   $('#myPolicy').parsley({

   });


   // $('.resetdays').each(function( index ){
   //     var days = $(this).attr('id');
   //     console.log("day->"+days);
   //     $('#'+ days).click(function(){
   //         console.log($(this).data('day'));
   //         $("."+$(this).data('day')+" option:selected").removeAttr("selected");
   //     });
   // });

   $('#banner-image-upload').on('change', function(e) {
       $('#banner-image-preview').attr('src', URL.createObjectURL(e.target.files[0]));
   });

   $('#banner-video-upload').on('change', function(e) {
       $('#banner-video-preview').show();
       $('#banner-video-preview').attr('src', URL.createObjectURL(e.target.files[0]));
   });

   $("#start_date").on('click', function()
   {
       var today = new Date();
       var start_date = moment(today).format('YYYY-MM-DD');

           $("#start_date").attr({
           "min" : start_date,          // values (or variables) here
           });
   });

   $('#start_date').on('change', function()
   {
       $("#end_date").show();
       var val = $(this).val();
       var result = new Date(val);
       var ss = result.setDate(result.getDate() + 1);
       var first_date = moment(ss).format('YYYY-MM-DD');

           $("#end_date").attr({
           "min" : first_date,
           "value" : first_date,         // values (or variables) here
           });
           console.log(first_date);
           console.log(val);

   });

   $('#play-mates-modal').on('shown.bs.modal', function (e) {

       var name, city, source = e.relatedTarget;

       $('#hidden_escort_id').val($(source).data('id'));
       console.log("id is here" + $(source).data('id'));

       if(name = $(source).data('name')) {
           $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
       }

       if(city = $(source).data('city')) {
           $('#playmate-modal-location').html('<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' + $(source).data('city'));
       }

       $.ajax({
           url: $(source).data('url'),
           success: function (data) {
               $('#playmate-template').html(data);
           }
       });
   });

   $('#play-mates-modal').on('hidden.bs.modal', function () {
       $('#playmate-template').html('<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>');
       $('#playmate-modal-name').html('');
       $('#playmate-modal-location').html('');
   });

   $('#search-playmate-input').on('change', function(e) {

       if($(this).val()) {
           $('#playmate_submit_button').show();
       } else {
           $('#playmate_submit_button').hide();
       }
   });

   function formatEscortList (data) {
       console.log('ckjoiujk;',data);
       return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+data.text+'"> '+data.name+' || '+data.member_id+'</span>');

   }

   $('#add-playmate-form').on('submit', function(e) {
       e.preventDefault();
       $('#playmate_submit_button').attr('disabled', true);
       $('#playmate_submit_button').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
       var $this = $(this);
       var escort_id = $('#hidden_escort_id').val();
       var member_id = $('#search-playmate-input').val();
       var url = $this.attr('action');

       $.post({
           type: $this.attr('method'),
           url: url,
           data: {
               escort_id: escort_id,
               playmate_id: member_id
           },
           success: function (data) {
               $('#search-playmate-input').val('');
               $('#playmate_submit_button').hide();
               $('#playmate-template').html(data);
           },
           error: function (data) {
               console.log(data);
           },
       }).done(function (data) {
           $('#playmate_submit_button').attr('disabled', false);
           $('#playmate_submit_button').html('Add Playmate');

           //$("#search-playmate-input").select2("val", "");

           $("#search-playmate-input").empty().trigger('change')

       });
   });

   $(document).on('click', '.remove-playmate', function(e) {
       e.preventDefault();

       var $this = $(this);
       var escort_id = $this.data('escort_id');
       var playmate_id = $this.data('playmate_id');
       const swalWithBootstrapButtons = Swal.mixin({
           customClass: {
               confirmButton: 'btn btn-success',
               cancelButton: 'btn btn-danger'
           },
           buttonsStyling: false
       });

       swalWithBootstrapButtons.fire({
           title: 'Are you sure?',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Remove',
           cancelButtonText: 'Cancel!',
           reverseButtons: true
       }).then((result) => {
           if (result.isConfirmed) {
               $.post({
                   type: 'POST',
                   url: "{{ route('escort.playmates.remove') }}",
                   data: {
                       escort_id: escort_id,
                       playmate_id: playmate_id
                   },
               }).done(function (data) {
                   if(data.error == 0) {
                       Swal.fire({
                           icon: 'error',
                           title: 'Oops...',
                           text: data.message
                       });
                   } else {
                       swalWithBootstrapButtons.fire({
                           icon: 'success',
                           title: '',
                           text: data.message
                       });
                      // location.reload();
                       $('#playmate-template').html(data.template);
                   }
               });
           }
       });
   });

   $("body").on('click','.nex_sterp_btn',function(e){
       e.preventDefault();
       var id = $(this).attr('id');
       $(this).removeClass('active');
       $(".nav-link").removeClass('active');
       console.log("id=" +id)
   });

   $('.covidreport').on('change', function(e) {
       if($(this).val() == 1 || $(this).val() == 2) {
           $('#covid-file-block').show();
       } else {
           $('#covid-file-block').hide();
       }
   })
   // var numInput = document.querySelector('input');
   // $(document).on("paste","input[type='number']", function(e) {
   // if (e.originalEvent.clipboardData.getData('text').match(/[^\d(\.\d)*$]/))
   // e.preventDefault(); //prevent the default behaviour
   // })
   // .on("keypress", function(e) {
   // if (e.keyCode != 46 && e.keyCode > 31  && (e.keyCode < 48 || e.keyCode > 57))
   //  e.preventDefault();
   // });
   $(document).ready(function(){
       $.each($( "input[name^='availability_time']" ), function( index, value ) {
           if($(value).is(':checked')) {
               $(value).closest('.parent-row').find('select').attr('disabled', true);

           }
       });

       $(document).on('change', 'input.monday, input.tuesday, input.wednesday, input.thursday, input.friday, input.saturday, input.sunday', function() {
           var p_element = $(this).attr('id');
           if($('#'+p_element).is(":checked")) {
               $('#'+p_element).closest('.parent-row').find('select').attr('disabled', true).val(0);
           } else {
               $('#'+p_element).closest('.parent-row').find('select').attr('disabled', false);
           }
       });


       $('.resetdays').click(function(){
           var p_element = $(this);
           var id = $(this).attr('id');
           var element_class = p_element.attr('data-day');
           console.log("select."+element_class);
           $('select.'+element_class).prop('selectedIndex',0);
           $('select.'+element_class).attr('disabled', false);
           //$('input[name="covidreport"]').removeAttr('checked');
           //var ch = $(" input[name='mytime[]']:checked").val();
           var ch = $('input.'+element_class+":checked").val();
           $('input.'+element_class+":checked").prop('checked', false);
           console.log(ch);

       });

       // $('.sunday').click(function(){
       //     var p_element = $(this);
       //     $('select.sunday').prop('selectedIndex',0);
       //     $('select.sunday').off('click');

       //     console.log("select. ");
       // });

   });





   $("#close").click(function()
   {
       $("#my_account_modal").hide();
       //location.reload();
   });
   $(".js-example-tokenizer").select2({
       allowClear: true,
       tags: true,
       tokenSeparators: [',']

   });

   // $('.js-example-tokenizer').select2({
   //     createTag: function (params) {
   //         var term = $.trim(params.term);

   //         // if (term === '') {
   //         //     console.log("term");
   //         // return null;
   //         // }

   //         return {
   //         id: term,
   //         text: term,
   //         newTag: true // add additional parameters
   //         }

   //     }
   // });
   // $(document).ready(function(){
   //     f ($('.js-example-tokenizer').find("option[value='" + data.id + "']").length) {
   //         $('.js-example-tokenizer').val(data.id).trigger('change');
   //     } else {
   //         // Create a DOM Option and pre-select by default
   //         var newOption = new Option(data.text, data.id, true, true);
   //         // Append it to the select
   //         $('.js-example-tokenizer').append(newOption).trigger('change');
   //     }
   // })
   // $('body').on('change','#st_name',function(){
   //     $(".results").append($(<p>helllog</p>));
   // });




   $("body").on('click','.delete_stname',function(e){
       var id = $(this).attr('id');
       $(this).parents('li').remove();
   })

    $(document).ready(function(){

        $('#st_name').select2({
            tags: true
        });
        $('#st_name').on('select2:select', function (e) {
            // debugger;
            var data = e.params.data;

            // $("#st_name").val([]).trigger();
            //$("#st_name").val([]).trigger();
            // console.log(e.params);

            $(this).parent().find(".results").append($("<li style='font-size: 14px;'><a href='#'>"+data.text +"</a><button type='button' class=' close ml-2 text-white stage-close' aria-label='Close'> <span class='delete_stname' id='"+data.id+"' aria-hidden='true'>×</span> <small class='mytool-tip'>Remove</small></button></li><input type='hidden' name='name[]' value='"+data.id+"'>"))
        });

      $('body').on('click', '.clickInput', function() {
           $('.showPlaymates').show();
      });
      $('body').on('click', '.playmates_rmid', function(e) {
           var id = $(this).attr('value');
           var url = "{{route('escort.remove.playmate',':id')}}";
           url = url.replace(':id',id);
           $("#rmlist_"+id).remove();
           $.ajax({
                   method: "POST",
                   url: url,
                   headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                   success: function (data) {
                       console.log(data);


                   }
               });

      });
        /*$('body').on('click', '.playmates_id', function(e) {
           e.preventDefault();
           var id = $(this).attr('value');
           var name = $(this).data('name');
           var path = $(this).data('path');
           if(path == '') {
               path = "{{asset('avatars/imageuser.png')}}";
           }



           $(".activePlaymate").append("<li><a href='#'><img src='"+path+"' class='img-profile rounded-circle'>&nbsp;&nbsp;"+name+"</a></li>");
           console.log("list_"+id + "</br>path ="+path);

           $("#list_"+id).remove();
           var url = "{{route('escort.add.playmate',':id')}}";
           url = url.replace(':id',id);
               $.ajax({
                   method: "POST",
                   url: url,


                   headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                   success: function (data) {
                       console.log(data);
                       // if(data.error == 1)
                       // {
                       // //$('#Lname').text(name +' has been removed from your Shortlist');
                       // $('.class_msg').text(name +' has been remove from your Shortlist');
                       // $('#add_wishlist').modal('show');
                       // $('.myescort_'+Eid).html('<img class="listiconprofilelistview" src="{{ asset('assets/app/img/filter_btn.svg') }}"> Add to Shortlist')
                       // $('#session_count').text(data.count_session);
                       // //location.reload();
                       // }

                   }
               });
       });*/
   });



    $(".clickInput").click(function(e){
        $(".showPlaymates").show();
        e.stopPropagation();
    });

    $(".showPlaymates").click(function(e){
        e.stopPropagation();
    });

    $(document).click(function(){
        $(".showPlaymates").hide();
    });

</script>
@endpush
