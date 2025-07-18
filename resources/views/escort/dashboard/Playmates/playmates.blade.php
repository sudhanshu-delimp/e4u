@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
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
   background: white url({{asset('avatars/Vector-24.svg')}}) 8px 8px no-repeat;
   border-radius: 3px;
   border: 1.8px solid #d1d3e2;
   font-size: 13px;
   font-weight: 400;
   color: #d1d3e2;
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
   border-color: #192A3E;
   background-color: #192A3E;
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
   background: #192A3E !important;
   }
   .active-play a {
   color: #fff;
   display: flex;
   gap: 10px;
   }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
      <div class="col-md-12">
         <div class="v-main-heading h3" style="display: inline-block">My Playmates</div>
          <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </h6>
      </div>
      <div class="col-md-12 mt-4">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h2 class="primery_color normal_heading"><b>Notes:</b></h2>
               <ol class="mb-0">
                  <li>By completing these settings, the information set out under My playmates will by default appear in your Profile creator. You should check with the Escort they are still available as a playmate before creating a Profile. A Viewer will be able to view the playmate’s Profile from your Profile.
                  </li>
                  <li>You can over ride these settings when creating a Profile, provided you have enabled the <a href="/escort-dashboard/update-account">feature</a> (see My Account - Profile & Tour options).
                  </li>
               </ol>
            </div>
         </div>
            <div class="card-body border-0 pt-0 mt-2">
                <div class="mb-5">
                    @php
                        $playmate = auth()->user()->available_playmate;
                    @endphp
                    <input type="checkbox" class="form-controll" value="Y" id="playmate" name="available_playmate" {{(($playmate) ? "checked" : '' )}}/> <label for="playmate" style="display: inline;">I am available as a playmate</label>
                </div>
               <form class="at-sec" method="post" action="" id="playmate_search" style="display: none;" {{(($playmate) ? "" : 'hidden' )}}>
                  <div class="at-lable">
                     <label for="Student">Search for playmate</label>
                     <input  name="q" placeholder="Search by name / Member ID" autocomplete="off" class="" id="search-playmate-input">
                     <input type="hidden" name="h_escort_id" id="h_escort_id" value="{{auth()->user()->id}}">
                     <ul class="results showPlaymates">
                        {{-- {{ dd(auth()->user()->playmates()->pluck('playmate_id'))}} --}}
                        @foreach($users_for_available_playmate as $allUser)
                            @if(!is_null($allUser->escorts))
                                @foreach($allUser->escorts as $escort)
                                    @if(!in_array($escort->id,auth()->user()->playmates()->pluck('playmate_id')->toArray()))
                                        @if($escort->membership != null && $escort->start_date != null)
                                            {{-- @if($escort->membership == 4 && Carbon\Carbon::parse($escort->start_date)->diffInDays(Carbon\Carbon::parse(now())) <= 14) --}}
                                            {{-- {{ dd($escort->DefaultImage )}} --}}
                                            <li  id="list_{{$escort->id}}">

                                                    <img src="{{ $escort->DefaultImage }}" class="img-profile rounded-circle playmats-img " >
                                                    {{ $escort->name }}
                                                    <span class="playmates_id" value="{{$escort->id}}" data-path="{{$escort->DefaultImage}}" data-name="{{$escort->name}}">Add</span>
                                                    {{-- <span>{{Carbon\Carbon::parse($escort->start_date)->format('d/m/Y')}}</span>
                                                    <span>{{Carbon\Carbon::now()->format('d/m/Y')}}</span> --}}

                                            </li>
                                            {{-- @endif  --}}
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        {{-- @foreach($allEscorts as $escort)
                        <li>

                           <img src="{{ $escort->default_image }}" class="img-profile rounded-circle playmats-img" >
                           {{ $escort->name }} <span class="playmates_id2" value="{{$escort->id}}">Add</span>

                        </li>
                        @endforeach --}}
                     </ul>
                  </div>
               </form>
            </div>
            <div class="card-body active-play border-0 pt-0 mt-1" id="active_playmates" style="display: none;"  {{(($playmate) ? "" : 'hidden' )}}>
               <div class="at-lable  mt-0">
                  <h2 class="primery_color normal_heading">My Active Playmates</h2>
                  <ul class="results  mt-2 activePlaymate">
                     @if(!is_null(auth()->user()->playmates))
                     @foreach(auth()->user()->playmates as $playmate)
                     <li id="rmlist_{{$playmate->id}}"> <a href="{{ route('profile.description',$playmate->id)}}" target="_blank" class="d_my_tooltip">
                        <img src="{{ $playmate->DefaultImage ? asset($playmate->DefaultImage) : asset('assets/app/img/icons-profile.png') }}" class="img-profile rounded-circle playmats-img">{{$playmate->user->member_id . ' - ' .$playmate->name}}</a>
                        <span class="playmates_rmid" value="{{$playmate->id}}">×</span>
                        <small class="mytool-tip">Remove</small>
                     </li>
                     @endforeach
                     @endif
                  </ul>
               </div>
            </div>
         </div>
         <!--   <div class="myacording-design mb-5">
            <div class="card">
                <div class="card-header">
                   <a class="card-link">
                   My playmates
                   </a>
                </div>
                <div id="my_play_mates">
                   <div class="card-body pb-0">
                      <ol class="pl-0 mb-0">
                         <li>By completing these settings, the information set out under My playmates will by
                            default appear in your Profile creator. You should check with the Escort they are still
                            available as a playmate before creating a Profile. A Viewer will be able to view the
                            playmate’s Profile from your Profile.
                         </li>
                         <li>You can over ride these settings when creating a Profile, provided you have enabled
                            the <span class="theme-text-color">feature</span>  (see My Account - Profile &amp; Tour options).
                         </li>
                      </ol>
                   </div>


                </div>
             </div>
            </div> -->
      </div>
   </div>
   <!--middle content end here-->
@endsection
@push('script')
<!-- file upload plugin start here -->
@push('script')
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
    $("#playmate").on('click', function(e) {
        var available_playmate = 1;
       if($(this).is(':checked')) {
           $("#playmate_search").attr("hidden",false);
           $("#active_playmates").attr("hidden",false);
        } else {
            $("#playmate_search").attr("hidden",true);
           $("#active_playmates").attr("hidden",true);
           available_playmate = 0;
        }

        var url = "{{route('user.update.playmate')}}";
        $.ajax({
            method: "GET",
            url: url,
            data:{'available_playmate': available_playmate},
            success: function (data) {
            }
        });
    });
    if("{{auth()->user()->available_playmate}}") {
        $("#playmate_search").show();
        $("#active_playmates").show();
    }


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
       if(data.name != undefined) {
           var path = data.text;
           if(path == null) {
                path = "{{asset('assets/app/img/icons-profile.png')}}";
            }
           return $('<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="'+path+'"> '+data.name+' </span><span class="playmates_id" value="'+data.id+'" data-path="'+data.text+'" data-name="'+data.name+'">Add</span>');
       }
   }
   function selectEscortList (data) {

       {{--$(".activePlaymate").append("<li><a href='#'><img src='"+data.text+"' class='img-profile rounded-circle playmats-img'>&nbsp;&nbsp;'"+data.name+"'</a><span class='playmates_rmid' value='"+data.id+"'>×</span></li>");--}}

        return $('<span><i class="fas fa-search fa-sm" style="color: #999;"></i>  Search by name OR Member ID </span>');

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
   /////////////////
   $(document).ready(function(){

    $('body').on('click', '.clickInput', function() {
            $('.showPlaymates').show();
    });
    $('body').on('click', '.playmates_rmid', function(e) {
        var id = $(this).attr('value');
        var url = "{{route('escort.remove.playmate',':id')}}";
        url = url.replace(':id',id);
        $(document).find("#rmlist_"+id).remove();
        $.ajax({
                method: "POST",
                url: url,
                headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                success: function (data) {
                    console.log(data);


                }
            });

   });
   //    $("body").on('click','.playmates_id',function(e){
   //        var id = $(this).attr('value');

   //        console.log(e);
   //        console.log("hello id");
   //    })
    $(document).on("click", ".playmates_id", function(e) {
        e.preventDefault();
        var id = $(this).attr('value');
        var name = $(this).data('name');
        var path = $(this).data('path');

        if(path == null) {
            path = "{{asset('assets/app/img/icons-profile.png')}}";

        }

         console.log("list_"+id + "</br>path ="+path);
        var url = "{{ route('profile.description',':id')}}";
        url = url.replace(':id', id);
        $(".activePlaymate").append("<li id='rmlist_"+id+"'><a href='"+url+"' target='_blank'><img src='"+path+"' class='img-profile rounded-circle playmats-img'>&nbsp;&nbsp;"+name+"</a><span class='playmates_rmid' value="+id+">×</span></li>");



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
    });
   });



   $(".clickInput").click(function(e){
     $(".showPlaymates").show();
     e.stopPropagation();
   });

   //  $(".showPlaymates").click(function(e){
   //      e.stopPropagation();
   //  });

   $(document).click(function(){
     $(".showPlaymates").hide();
   });

   $('#search-playmate-input').select2({
        //dropdownParent: $("#play-mates-modal"),
        width: '100%',
        dropdownCssClass: "bigdrop",
        placeholder: {
            id: 0, // the value of the option
            text: "{{ asset('assets/app/img/service-provider/Frame-408.png') }}",
            name: 'Search by name',
           member_id: 'Member ID',
        },
        allowClear: true,
        language: {
            inputTooShort: function() {
                return 'Enter the Name OR Member ID';
            }
        },
        createTag: function(params) {
            var term = $.trim(params.term);
            console.log(term);
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
            url: "{{ route('escort.playmatesId.find') }}",
            dataType: "json",
            type: "POST",
            data: function(params) {

                var queryParameters = {
                    query: params.term,
                    escort_id: $('#h_escort_id').val()
                }

                return queryParameters;
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {

                        return {
                            text: item.default_image,
                            name: item.name,
                            member_id: item.member_id,
                            id: item.id
                        }
                    })
                };
            }
        },
        templateResult: formatEscortList,
        templateSelection: selectEscortList

    });

</script>


@endpush
