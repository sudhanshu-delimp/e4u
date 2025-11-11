@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js?v1.1') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0);
   padding: 0;
   }
   .parsley-errors-list li {
   font-size: 14px;
   line-height: 18px;
   margin-top: 6px;
   }
</style>
<script>
   function _displayGenderDependentFields(genderVal) {
       if (['1', '3'].indexOf(genderVal) <= -1) {
           $(".femaleFields").show();
           $(".maleFields").hide();
       } else if (['6', '3'].indexOf(genderVal) <= -1) {
           $(".maleFields").show();
           $(".femaleFields").hide();
       } else {
           $(".maleFields").show();
           $(".femaleFields").show();
       }
   }
   
   function formatEscortList(data) {
       return $(
           '<span><img class="profile-user-img img-responsive img-circle img-profile rounded-circle small-round-fixed" src="' +
           data.text + '"> ' + data.name + ' || ' + data.member_id + '</span>');
   }
   
   function selectEscortList(data) {
       return $('<span><i class="fas fa-search fa-sm" style="color: #999;"></i>  Search by name OR Member ID </span>');
   }
</script>
@endsection
@section('content')
@php  
$existDefaultService = $escort->services()->exists();
$existAvailability = $escort->availability()->exists();
$editMode = request()->segment(2) == 'profile' ? true:false;
$loginAccount = auth()->user();
@endphp
<div class="d-flex flex-column container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
      <div class="col-md-12 custom-heading-wrapper">
         @if (request()->getPathInfo() == '/escort-dashboard/create-profile')
         <h1 class="h1">New Profile</h1>
         @else
         <h1 class="h1">Update Profile</h1>
         @endif
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
      </div>
      <div class="col-md-12 mb-4" id="profile_and_tour_options">
         <div class="card collapse" id="notes">
            <div class="card-body">
               <h3 class="NotesHeader"><b>Notes:</b> </h3>
               <ol>
                  <li>Use this feature to create your Profiles. You can create as many Profiles as you
                     like for as many Locations as you like.
                  </li>
                  <li>The Profiles you create will be used to create Tours.</li>
                  <li>Each time you create a Profile, it will be pre-populated with your <a
                     href="/escort-dashboard/profile-informations"
                     class="custom_links_design">Profile Information</a> you have set. Take the time
                     to set up your <a href="/escort-dashboard/profile-informations"
                        class="custom_links_design">Profile Information</a> and <a
                        href="/escort-dashboard/archive-medias" class="custom_links_design">Media</a>.
                     Any changes you make in the Profile Creator will only apply to that Profile unless
                     you click the ‘Update’ button for the section you have changed. Otherwise your
                     Profile Information settings will not change.
                  </li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <div id="content">
      <div class="container-fluid p-0">
         <!--middle content-->
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-lg-3">
                     <div class="form_process">
                        <div class="steps_to_filled_from">Step 1</div>
                        <p>About me</p>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form_process">
                        <div class="steps_to_filled_from">Step 2</div>
                        <p>My Services & Rates</p>
                     </div>
                  </div>
                  <div class="col-lg-3">
                     <div class="form_process">
                        <div class="steps_to_filled_from">Step 3</div>
                        <p>My Availability</p>
                     </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form_process">
                       <div class="steps_to_filled_from">Step 4</div>
                       <p>My Playmates</p>
                    </div>
                 </div>
                  <div class="col-lg-1">
                     <div id="percent" style="font-size: 48px;font-weight: 700;">25%</div>
                  </div>
               </div>
               <div class="manage_process_bar_padding">
                  <div class="progress define_process_bar_width">
                     <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 25%"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <!-- Begin Page Content -->
               @php
                    $activeTab = request()->get('tab', 'about-me');
               @endphp
               <div class="row">
                  <div class="col-md-12 remove_padding_in_ph">
                     <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link {{$activeTab=='about-me'?'active':''}}" id="home-tab" data-toggle="tab" href="#aboutme"
                              role="tab" aria-controls="home" aria-selected="true">About me</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services"
                              role="tab" aria-controls="profile" aria-selected="false">My Services &
                           Rates</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available"
                              role="tab" aria-controls="contact" aria-selected="false">My Availability</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$activeTab=='my-playmates'?'active':''}}" id="playmates-tab" data-toggle="tab" href="#playmates" role="tab" aria-controls="my-playmates" aria-selected="false">
                                My Playmates</a>
                        </li>
                     </ul>
                     
                    @if(!$editMode)
                     <form id="my_escort_profile"
                        action="{{ route('escort.setting.profile', request()->segment(3)) }}" method="post"
                        enctype="multipart/form-data" data-parsley-validate>
                        @csrf   
                        <input type="hidden" name="user_startDate" id="user_startDate"
                           value="{{ date('Y-m-d', strtotime($loginAccount->created_at)) }}">
                    @endif        
                        <div class="tab-content tab-content-bg" id="myTabContent">
                           @include('escort.dashboard.profile.partials.aboutme-dash-tab', [
                           'profile_type' => 'updated',
                           ])
                           @include('escort.dashboard.profile.partials.services-dash-tab')
                           @include('escort.dashboard.profile.partials.available-dash-tab')
                           @include('escort.dashboard.profile.partials.playmates-dash-tab')
                        </div>
                    @if(!$editMode)
                     </form>
                    @endif 
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- End of Content Wrapper -->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
   <div class="toast-header">
      <!--<img src="..." class="rounded mr-2" alt="...">-->
      <strong class="mr-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   <div class="toast-body">Hello, world! This is a toast message.</div>
</div>
<!-- <div class="modal show" id="add_wishlist" style="display: block;"> -->
<div class="modal programmatic" id="change_all" style="display: none">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content custome_modal_max_width">
         <div class="modal-header main_bg_color border-0">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white"> <img src="{{ asset('assets/dashboard/img/save-info.png') }}" class="custompopicon"> Update My Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">
            <img src="{{ asset('assets/app/img/newcross.png') }}"
               class="img-fluid img_resize_in_smscreen">
            </span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="current" name="current">
            <input type="hidden" id="previous" name="previous">
            <input type="hidden" id="label" name="label">
            <input type="hidden" id="trigger-element">
            <input type="hidden" id="trigger-element2">
            <h3 class="my-2"><span id="Lname"></span> </h3>
            <h3 class="my-2"><span id="log"></span> </h3>
            <div class="modal-footer">
               <button type="button" class="btn-cancel-modal gender_alert" data-dismiss="modal"
                  value="close" id="close_change">No</button>
               <button type="button" class="btn-success-modal" id="save_change">Yes</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal bd-example-modal-lg" id="view-listing" tabindex="-1" role="dialog" aria-labelledby="emailReportLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-custom" role="document">
      <div class="modal-content basic-modal modal-lg">
         <div class="modal-header">
            <h5 class="modal-title" id="emailReport"><img src="{{ asset('assets/dashboard/img/view-listing.png') }}" class="custompopicon"> Listing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body" id="escortPopupModalBody">
            <iframe src="{{ route('profile.description',$escort->id ? $escort->id : '' )}}" id="escortPopupModalBodyIframe" frameborder="0" style="width:100%; height:80vh;" allowfullscreen></iframe>
         </div>
      </div>
   </div>
</div>
@include('escort.dashboard.modal.upload_gallery_image')
@include('escort.dashboard.modal.remove_gallary_image')
@include('escort.dashboard.modal.upload_gallery_video')
@include('escort.dashboard.modal.set_default_video')
@include('escort.dashboard.modal.remove_gallary_video')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@endsection
@push('script')
<script src="{{ asset('js/escort/profile_and_media_gallery.js') }}"></script>
<script src="{{ asset('js/escort/profile_playmate.js') }}"></script>
    <script>
        window.App = window.App || {};
        window.App.escortId = '{{$escort->id}}';

        var trans_gender = 0;    
        
        $(document).on('change', '#Gender', function(e) {
        trans_gender = $.trim(this.value); 
        });

        $(document).on('click', '.gender_alert', function(e) {
             call_gender_alert();
        });

        function call_gender_alert()
        {
             if($.trim(trans_gender)==3) 
              {

                //let stageName = $('#stageName').val();
                //let message = `This stage name will be displayed as TS - (stage name).`;
                Swal.fire({
                    title: '',
                    html: `
                        <div style="text-align: center;">
                            This stage name will be displayed as <br>
                            <strong>TS - Stage Name </strong>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });

               
              } 
        }



        $(document).on('keypress', 'form input', function(event) {
            return event.keyCode !== 13;
        });

        $('.preview-profile').on('click', function() {
            $('#escortPopupModalBodyIframe').attr('src', function(i, old) {
                return old;
            });
        });
        
        $('#select2-dropdown').select2({
            createTag: function(params) {
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
                data: function(params) {
                    var queryParameters = {
                        query: params.term
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
        $('#select2_country').select2();
    
        @if (request()->segment(2) == 'profile' && request()->segment(3))
            $('#LocationInformation').parsley({});
        @endif
        $('#myability').parsley({});
        $('#update_about_me').parsley({});

        jQuery(document).ready(function() {
            $('#state_id').change(function() {
                var stateId = $(this).val();
                var url = "{{ route('escort.stateByCity', ':id') }}";
                url = url.replace(':id', stateId);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        stateId: stateId
                    },
                    contentType: "application/json",
                    success: function(data) {
                        optionString = '';
                        $.each(data.data, function(index, elem) {
                            optionString += '<option value=' + index + '>' + elem +
                                '</option>';
                        });
                        $('#city_id').html(optionString);
                    },
                });
            });

            var url = $(location).attr('pathname');

            
            $('#language').change(function() {
                var languageValue = $('#language').val();
                $("#show_language").show();
                $(".select_lang").hide();
                $(".select_lang").remove();
                $(".lang").val('');
                var selectedLanguage = $(this).children("option:selected", this).data("name");
                $("#show_language").append(
                    "  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>" +
                    selectedLanguage + " </span> </div> ");
                $("#container_language").append(
                    "<input class='languageInput' type='hidden' name='language[]' value=" +
                    languageValue + ">");
                $("#language option[value='" + languageValue + "']").remove();
            });

            /** Save My service form data when open in edit mode */
            jQuery('#myServicesForm').on('submit', function(e) {
                e.preventDefault();
                //let existService = checkServicePrice();
                // if(!existService){
                //     if (!existService) {
                //         Swal.fire('My Services',
                //             'You must complete all selected service value to proceed.',
                //             'warning');
                //         return false;
                //     }
                // }
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData($('#myServicesForm')[0]);

                $('#my_services').prop('disabled', true);
                $('#my_services').html('<div class="spinner-border"></div>');

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
                            Swal.fire('Updated', '', 'success');
                            $('#my_services').prop('disabled', false);
                            $('#my_services').html('Updated');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops.. sumthing wrong Please try again',
                                text: data.message
                            });
                            $('#my_services').prop('disabled', false);
                            $('#my_services').html('Updated');
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops.. sumthing wrong Please try again',
                            text: data.message
                        });
                        $('#my_services').prop('disabled', false);
                        $('#my_services').html('Updated');
                    }
                });
            });

            $('#storeRate').on('submit', function(e) {
                e.preventDefault();
                let existRates = checkRates();
                if (!existRates) {
                    Swal.fire('Rates',
                    'You must complete at least one rate value to proceed.',
                    'warning');
                    return false;
                }
                var form = $(this);
                var url = form.attr('action');
                var data = new FormData($('#storeRate')[0]);

                $('#store_rate').prop('disabled', true);
                $('#store_rate').html('<div class="spinner-border"></div>');
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
                            Swal.fire('Updated', '', 'success');
                            $('#store_rate').prop('disabled', false);
                            $('#store_rate').html('Updated');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops.. sumthing wrong Please try again',
                                text: data.message
                            });
                            $('#store_rate').prop('disabled', false);
                            $('#store_rate').html('Updated');
                        }
                    }
                });
            });

            $('#read_more').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                //if (form.parsley().isValid()) {
                var url = form.attr('action');
                var data = new FormData($('#read_more')[0]);
                $('#read-more').prop('disabled', true);
                $('#read-more').html('<div class="spinner-border"></div>');
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
                            Swal.fire('Updated', '', 'success');
                            $('#read-more').prop('disabled', false);
                            $('#read-more').html('Updated');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops.. sumthing wrong Please try again',
                                text: data.message
                            });
                            $('#read-more').prop('disabled', false);
                            $('#read-more').html('Updated');
                        }
                    }
                });
                //}
            });

            $('#update_about_me').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                if (form.parsley().isValid()) {

                    $('#aboutMeBtn').prop('disabled', true);
                    $('#aboutMeBtn').html('<div class="spinner-border"></div>');
                    var url = form.attr('action');
                    var data = new FormData($('#update_about_me')[0]);
                    data.append('_token', $('input[name="_token"]').val());

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
                                Swal.fire('Updated', '', 'success');
                                $('#aboutMeBtn').prop('disabled', false);
                                $('#aboutMeBtn').html('Updated');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                                $('#aboutMeBtn').prop('disabled', false);
                                $('#aboutMeBtn').html('Updated');
                            }
                        }
                    });
                }
            });

            $('#update_abut_who_am_i').on('submit', function(e) {
                e.preventDefault();
                if(!validateWhoAmIContent()){
                    return false;
                }
                var form = $(this);
                $('#update_who_am_i').prop('disabled', true);
                $('#update_who_am_i').html('<div class="spinner-border"></div>');
                var url = form.attr('action');
                var data = new FormData($('#update_abut_who_am_i')[0]);
                //data.append('_token', $('input[name="_token"]').val());
                // let about = editor.getData();
                //data.append('about',about);
                //let about_title = $("[name=about_title]").val();
                //data.append('about_title',about_title);

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
                            Swal.fire('Updated', '', 'success');
                            $('#update_who_am_i').prop('disabled', false);
                            $('#update_who_am_i').html('Updated');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops.. sumthing wrong Please try again',
                                text: data.message
                            });
                            $('#update_who_am_i').prop('disabled', false);
                            $('#update_who_am_i').html('Updated');
                        }
                    }
                });
            });


            $('#myability').on('submit', function(e) {
                e.preventDefault();
                let checkAvailability = validateAvailability();
                if(checkAvailability){
                    return false;
                }
                var form = $(this);

                if (form.parsley().isValid()) {

                    $('#my_abilities').prop('disabled', true);
                    $('#my_abilities').html('<div class="spinner-border"></div>');
                    var url = form.attr('action');
                    var data = new FormData($('#myability')[0]);
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
                                Swal.fire('Updated', '', 'success');
                                $('#my_abilities').prop('disabled', false);
                                $('#my_abilities').html('Save');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                                $('#my_abilities').prop('disabled', false);
                                $('#my_abilities').html('Save');
                            }
                        }
                    });
                }
            });

            $('#LocationInformation').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const parsleyForm = form.parsley();

                parsleyForm.whenValidate().then(function() {
                    $('#location-info').prop('disabled', true);
                    $('#location-info').html('<div class="spinner-border"></div>');

                    const url = form.attr('action');
                    const data = new FormData(form[0]);

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
                            $('#location-info').prop('disabled', false);
                            $('#location-info').html('Save');

                            if (!data.error) {
                                Swal.fire('Updated', '', 'success');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. something went wrong. Please try again.',
                                    text: data.message
                                });
                            }
                        }
                    });

                }, function() {
                    console.log('Form validation failed');
                });
            });

            /** Media upload */
            $('#myProfileMediaForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);

                let dynamic_image = checkProfileDynamicMedia();
                    if (dynamic_image < 8) {
                        Swal.fire('Media',
                            'Please attach media to this profile from the Media Repository or upload a new file (All are mendatory)',
                            'warning');
                        return false;
                    }

                if (form.parsley().isValid()) {
                    $('#mediaProfileBtn').prop('disabled', true);
                    $('#mediaProfileBtn').html('<div class="spinner-border"></div>');
                    var url = form.attr('action');
                    var data = new FormData($('#myProfileMediaForm')[0]);
                    

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
                                Swal.fire('Updated', '', 'success');
                                $('#mediaProfileBtn').prop('disabled', false);
                                $('#mediaProfileBtn').html('Save');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                                $('#mediaProfileBtn').prop('disabled', false);
                                $('#mediaProfileBtn').html('Save');
                            }
                        }
                    });
                }
            });

            $('#myProfileMediaVideoForm').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);

                if(!checkProfileDynamicMediaVideo()){
                    Swal.fire('Media',
                        'Please attach video to this profile from the Media Repository or upload a new file',
                        'warning');
                    return false;  
                }

                if (form.parsley().isValid()) {
                    $('#mediaProfileVideoBtn').prop('disabled', true);
                    $('#mediaProfileVideoBtn').html('<div class="spinner-border"></div>');
                    var url = form.attr('action');
                    var data = new FormData($('#myProfileMediaVideoForm')[0]);
                    

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
                                Swal.fire('Updated', '', 'success');
                                $('#mediaProfileVideoBtn').prop('disabled', false);
                                $('#mediaProfileVideoBtn').html('Save');
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops.. sumthing wrong Please try again',
                                    text: data.message
                                });
                                $('#mediaProfileVideoBtn').prop('disabled', false);
                                $('#mediaProfileVideoBtn').html('Save');
                            }
                        }
                    });
                }
            });

        }); // end (document).ready

        if($('.js_profile_services input[name="service_id[]"]').length > 0){
            $('.js_profile_services input[name="service_id[]"]').each((index, element)=>{
                let value = $(element).val();
                let tagContainer = $(element).parents('li');
                let selectElement = tagContainer.parents('.row').slice(0, 1).prev().find('select');
                selectElement.find(`option[value=${value}]`).hide();
            });
        }

        $(document).on('change','.js_profile_service_tags', function(){
            let obj = $(this);
            let index = $('.js_profile_service_tags').index(this);
            let tagContainer =  obj.parents('.row').slice(0, 2).next().find('ul');
            let selectedValue = $(this).val();
            let selectedText = $(this).find('option:selected').text();
            let changeClass = "{{$existDefaultService?'change_default2':''}}";
            let profileName = $('input[name="profile_name"]').val();
            if(selectedValue){
                $(this).find('option:selected').hide();
                let string = `<li id='hideenclass${index}_${selectedValue}'><div class="my_service_anal"><span class='dollar-sign'>${selectedText}</span> <span class="d_profile_name">Status: ${profileName} <div class="make-ittool js_default_action">Add to Default</div></span>`;
                string += `<input type='number' class='dollar-before input_border ${changeClass}' name='price[]' value='0' placeholder='0' min='0' oninput='this.value = Math.abs(this.value)' step='10' max=200 service_id="${selectedValue}"><input type='hidden' name='service_id[]' value="${selectedValue}" placeholder=''><span> <small class="mytool-tip">Remove</small><i class='fas fa-times akh1' data-sname='${selectedText}' data-val="${selectedValue}"  id='id_${selectedValue}' value="${selectedValue}" >`;
                string += `</i></span></div></li>`;
                tagContainer.append(` ${string} `);
                if (changeClass === 'change_default2') {
                    $(`#hideenclass${index}_${selectedValue} .change_default2`).trigger('change');
                }
            }
            obj.val('');
        });
        /**
         * Remove the service tag
         */
        $(document).on('click','.js_profile_services i', function(){
            let obj = $(this);
            let tagContainer = obj.parents('li');
            let removeTagValue = tagContainer.find('input[name="service_id[]"]').val();
            let selectElement = tagContainer.parents('.row').slice(0, 1).prev().find('select');
            tagContainer.remove();
            selectElement.find(`option[value=${removeTagValue}]`).show();
            /**
             * Remove the service tag from the default profile as well
             */
            if(obj.hasClass('js_defaultProfileService')){
                Swal.fire({
                title: 'My Services ',
                text: "Do want to remove service from 'My information' page for future Profiles?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('escort.update_escort_default') }}",
                            dataType: 'json',
                            data: {'remove_service':removeTagValue},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                            
                            }
                        });
                    }
                });
            }
        })

        /**
         * Change to Default and Normal Service Tag from already selected
         */

         $(document).on('click','.js_default_action', function(){
            let obj = $(this)
            let profileName = $('input[name="profile_name"]').val();
            let priceValue = obj.parent().next('input[name="price[]"]').val();
            let serviceValue = obj.parent().next().next('input[name="service_id[]"]').val();
            let isDefault = obj.parents('li').hasClass('js_defaultProfileService');
            let data = {};
            if(isDefault){
                data['remove_service'] = serviceValue;
            }
            else{
                data['price[]'] = priceValue;
                data['custom_id'] = serviceValue;
            }
            $.ajax({
                type: 'POST',
                url: "{{ route('escort.update_escort_default') }}",
                dataType: 'json',
                data: data,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(!response.error){
                        isDefault?obj.parents('li').removeClass('js_defaultProfileService'):obj.parents('li').addClass('js_defaultProfileService');
                        isDefault?obj.text('Add to Default'):obj.text('Remove from Default');
                        let span = obj.closest('.d_profile_name');
                        if (span.length) {
                            span.get(0).firstChild.nodeValue = `Status: ${isDefault?profileName:'Default'}`;
                        }
                    }
                }
            });
         });

        //start available //
        $('.available_to').click(function() {
            var val = $(this).val();
            $(this).is(':checked') ? $('#' + val).show() : $('#' + val).hide();
        });
        $('.draft').click(function() {
            var val = $(this).val();
            $("#total_rate").html('');
            $(this).is(':checked') ? $(this).val(1) : $(this).val(2);

            if ($(this).is(':checked')) {
                $("#start_date").attr({
                    'disabled': true,
                    'required': false
                });
                $("#end_date").attr({
                    'disabled': true,
                    'required': false
                });
                $("#membership").attr({
                    'disabled': true,
                    'required': false
                });

                $('#pricing-tab').attr('id', 'pricing-tab-1')
                $('#pricing-tab-1').hide()
                $("#show_draft").show();
            } else {
                $("#start_date").attr({
                    'disabled': false,
                    'required': true
                });
                $("#end_date").attr({
                    'disabled': false,
                    'required': true
                });
                $("#membership").attr({
                    'disabled': false,
                    'required': true
                });
                $('#pricing-tab-1').attr('id', 'pricing-tab')
                $("#pricing-tab").show();
                $("#show_draft").hide();
            }
        });
        $('.playType').click(function() {
            var val = $(this).val();
            var name = $(this).data('name');
            $(".show_playType").show();
            if ($(this).is(':checked')) {
                $("#show_playType").append(
                    "<div class='selecated_languages playT' style='display: inline-block' id='" + val +
                    "'><span class='languages_choosed_from_drop_down'>" + name + " </span> </div> ")
            } else {
                $('#show_playType #' + val).remove();
            }
        });


        $('#banner-image-upload').on('change', function(e) {
            $('#banner-image-preview').attr('src', URL.createObjectURL(e.target.files[0]));
        });

        $('#banner-video-upload').on('change', function(e) {
            $('#banner-video-preview').show();
            $('#banner-video-preview').attr('src', URL.createObjectURL(e.target.files[0]));
        });



        $('#play-mates-modal').on('shown.bs.modal', function(e) {

            var name, city, source = e.relatedTarget;

            $('#hidden_escort_id').val($(source).data('id'));

            if (name = $(source).data('name')) {
                $('#playmate-modal-name').html('Playmates for ' + $(source).data('name'));
            }

            if (city = $(source).data('city')) {
                $('#playmate-modal-location').html(
                    '<svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path></svg>' +
                    $(source).data('city'));
            }

            $.ajax({
                url: $(source).data('url'),
                success: function(data) {
                    $('#playmate-template').html(data);
                }
            });
        });

        $('#play-mates-modal').on('hidden.bs.modal', function() {
            $('#playmate-template').html(
                '<div class="spinner-border text-secondary" style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading...</span></div>'
            );
            $('#playmate-modal-name').html('');
            $('#playmate-modal-location').html('');
        });


        $('#add-playmate-form').on('submit', function(e) {
            e.preventDefault();
            $('#playmate_submit_button').attr('disabled', true);
            $('#playmate_submit_button').html(
                '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>')
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
                success: function(data) {
                    $('#search-playmate-input').val('');
                    $('#playmate_submit_button').hide();
                    $('#playmate-template').html(data);
                },
                error: function(data) {},
            }).done(function(data) {
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
                    }).done(function(data) {
                        if (data.error == 0) {
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
                            $('#playmate-template').html(data.template);
                        }
                    });
                }
            });
        });

        function checkProfileDynamicMedia() {
            let dynamic_image = 0;
            document.querySelectorAll('.profile-gallery').forEach(img => {
                let src = img.getAttribute('src');
                let basename = src.substring(src.lastIndexOf('/') + 1);
                if (!['img-12.png', 'img-11.png', 'img-13.png', 'upload-thum-1.png', 'frame_final.png','upload-3.png'].includes(basename)) {
                    dynamic_image++
                }
            });
            return dynamic_image;
        }

        function checkProfileDynamicMediaVideo() {
            let dynamic_video = 0;
            $("input[name^='video_position']").each(function () {
                if ($(this).val().trim() != "") {
                    dynamic_video++;
                }
            });

            return dynamic_video;
        }

        function checkRates(){
            const selectors = [
            'input[name="massage_price[]"]',
            'input[name="incall_price[]"]',
            'input[name="outcall_price[]"]'
            ];

            let isValid = false;
            const allInputs = selectors.flatMap(selector => 
            Array.from(document.querySelectorAll(selector))
            );

            for (const input of allInputs) {
            const val = parseFloat(input.value);
            
            if (!isNaN(val) && val > 0) {
                isValid = true;
                break;
            }
            }
            return isValid;
        }

        function checkServicePrice(){
            const selectors = [
            'input[name="price[]"]'
            ];

            let isValid = true;
            const allInputs = selectors.flatMap(selector => 
                Array.from(document.querySelectorAll(selector))
            );

            for (const input of allInputs) {
                const val = parseFloat(input.value);
                if (isNaN(val) || val <= 0) {
                    isValid = false;
                    break;
                }
            }

            return isValid;
        }

        function validateAvailability() {
            const dayMap = {
            monday: 'mon',
            tuesday: 'tue',
            wednesday: 'wed',
            thursday: 'thur',
            friday: 'fri',
            saturday: 'sat',
            sunday: 'sun'
            };

            let hasError = false;
            let errorDays = [];

            Object.entries(dayMap).forEach(([fullDay, shortKey]) => {
            const fromTime = document.querySelector(`[name="${shortKey}_from"]`)?.value || '';
            const fromAMPM = document.querySelector(`[name="${shortKey}_time_from"]`)?.value || '';
            const radioSelected = document.querySelector(`input[name="availability_time[${fullDay}]"]:checked`);

            if ((fromTime === '' || fromAMPM === '') && !radioSelected) {
                hasError = true;
                errorDays.push(fullDay.charAt(0).toUpperCase() + fullDay.slice(1));
            }
            });

            if (hasError) {
                Swal.fire('My Availability',
                            `Please fill time or select an availability option for the following days:\n ${errorDays.join(', ')}`,
                            'warning');
            }

            return hasError;
        }

        function validateWhoAmIContent() {
            const editorId = 'editor1';
            // Check if CKEditor instance exists
            if (CKEDITOR.instances[editorId]) {
                
                CKEDITOR.instances[editorId].updateElement(); // Push content to textarea
            } else {
                console.warn("CKEditor instance NOT found for #editor1");
            }

            // Debug: Show the updated textarea value
            const content = document.getElementById(editorId).value.trim();
            
            showManualRequiredError(editorId);
            return (!content) ? false : true;
        }

        function showManualRequiredError(editorId) {
            const textarea = document.getElementById(editorId);
            const message = textarea.getAttribute('data-parsley-required-message') || 'This field is required.';
            const errorContainerSelector = textarea.getAttribute('data-parsley-errors-container');
            const errorContainer = document.querySelector(errorContainerSelector);

            const value = textarea.value.trim();

            if (!value && errorContainer) {
                errorContainer.innerHTML = `<ul class="parsley-errors-list filled"><li class="parsley-required">${message}</li></ul>`;
            } else {
                errorContainer.innerHTML = ''; // clear any previous error
            }
        }

        $('.covidreport').on('change', function(e) {
            if ($(this).val() == 1 || $(this).val() == 2) {
                $('#covid-file-block').show();
            } else {
                $('#covid-file-block').hide();
            }
        })




        //TODO::WIP we need to enable this for both create and edit and clicking ok will update data in the users table
        @if (request()->segment(2) == 'profile' || request()->segment(2) == 'create-profile')
            $(function() {
                var previous;
                let days = ["mon", "tue", "wed", "thur", "fri", "sat", "sun"];
                $(".change_default").focus(function() {
                    previous = this.value;

                }).on('change paste', function() {
                    // Do soomething with the previous value after the change
                    var Current = $(this).val();
                    var original = $(this).parent().prev().text();
                    let label = original.substring(0, original.lastIndexOf(":"));
                    $('#trigger-element').val($(this).attr('name'));
                    $('#trigger-element2').val("");
                    $('#label').val(label);
                    $('#current').val(Current);
                    $('#previous').val(previous);

                    if (label == 'stageName' && Current === 'new') {

                        return true;
                    }

                    if (this.id == 'language') {
                        $('#trigger-element').val('language');
                        let values = $(".languageInput").map(function() {
                            return $(this).val();
                        }).get();
                        $('#current').val(values);
                    }

                    if ($(this).attr('name') == 'available_to[]' || $(this).attr('name') ==
                        'available_to') {
                        $('#trigger-element').val('available_to');
                        let checkedValues = $(".available_to:checked").map(function() {
                            return $(this).val();
                        }).get();
                        $('#current').val(checkedValues);
                    }

                    if ($(this).attr('name') == 'massage_price[]' || $(this).attr('name') ==
                        'incall_price[]' || $(this).attr('name') == 'outcall_price[]') {
                        $('#trigger-element2').val($(this).attr('duration_id'));
                    }
                    if ($(this).attr('name') == 'price[]') {
                        $('#trigger-element2').val($(this).attr('service_id'));
                    }
                    /** update from date time **/
                    if (days.includes($(this).attr('day_key_from'))) {
                        var day_key = $(this).attr('day_key_from');
                        var dayFrom = $("#" + day_key + "from").val();
                        var dayFromTime = $("#" + day_key + "fromtime").val();
                        
                        if (dayFrom != "" && dayFromTime != "") {
                            Current = dayFrom + " " + dayFromTime;
                            $('#current').val(Current);
                            $('#trigger-element').val('day_key_from');
                            $('#trigger-element2').val(day_key);
                        } else {
                            return true;
                        }
                    }
                    if (days.includes($(this).attr('day_key_to'))) {
                        /** update from to time **/

                        var day_key = $(this).attr('day_key_to');
                        var dayFrom = $("#" + day_key + "_to").val();
                        var dayFromTime = $("#" + day_key + "_time_to").val();
                        if (dayFrom != "" && dayFromTime != "") {
                            Current = dayFrom + " " + dayFromTime;
                            $('#current').val(Current);
                            $('#trigger-element').val('day_key_to');
                            $('#trigger-element2').val(day_key);
                        } else {
                            return true;
                        }
                    }


                    if ($(this).attr('name') == 'play_type[]' || $(this).attr('name') == 'play_type') {
                        $('#trigger-element').val('play_type');
                        let checkedValues = $(".playType:checked").map(function() {
                            return $(this).val();
                        }).get();
                        $('#current').val(checkedValues);
                    }
                    
                    let popupMessage = `<p>Would you like to update ${label ? `<b>${label}</b> in your` : 'your'} 'My Information' page for future Profiles?</p>`;

                    $("#Lname").html(popupMessage);

                    if ($(this).attr('name') != 'license' || ($(this).attr('name') == 'license' &&
                            Current != '')) {
                        $('#change_all').modal('show');
                    }
                    previous = this.value;
                });
            });

            $(document).on('change', '.change_default2', function() {
                var previous;
                var Current = $(this).val();
                var original = $(this).parent().prev().text();
                let label = original.substring(0, original.lastIndexOf(":"));
                $('#trigger-element').val($(this).attr('name'));
                $('#trigger-element2').val("");
                $('#label').val(label);
                $('#current').val(Current);
                $('#previous').val(previous);
                if ($(this).attr('name') == 'price[]') {
                    $('#trigger-element2').val($(this).attr('service_id'));
                    let popupMessage = `<p>Would you like to update ${label ? `<b>${label}</b> in your` : 'your'} 'My Information' page for future Profiles?</p>`;
                    $("#Lname").html(popupMessage);

                    if ($(this).attr('name') != 'license' || ($(this).attr('name') == 'license' &&
                            Current != '')) {
                        $('#change_all').modal('show');
                    }
                    previous = this.value;
                }
            });
        @endif

        $("#change_all").on("hidden.bs.modal", function(e) {

            if ($('#change_all').hasClass('programmatic')) {
                var trigger_elem = $('#trigger-element').val();
            }
        });

        $(document).ready(function() {

            $('#save_change').on("click", function(e) {
                $('#change_all').removeClass('programmatic');
                if ($('#label').val() == 'Gender') {
                    _displayGenderDependentFields($('#current').val());
                }
                $('#change_all').modal('hide');
                call_gender_alert();
            });
            $.each($("input[name^='availability_time']"), function(index, value) {
                let p_element = $(value).attr('id');
                if(p_element.endsWith('_til_ate')){
                    if ($(value).is(':checked')) {
                        var $selects = $('#' + p_element).closest('.parent-row').find('select');
                        $selects.each(function(index){
                            if(index >= 2){
                                $(this).prop('disabled', true).val(0);
                            } else {
                                $(this).prop('disabled', false);
                            }
                        });
                    }

                }else{
                    if ($(value).is(':checked')) {
                        $('#' + p_element).closest('.parent-row').find('select').attr('disabled', true);
                    }
                }

                
            });

            $(document).on('change',
                'input.monday, input.tuesday, input.wednesday, input.thursday, input.friday, input.saturday, input.sunday',
                function() {
                    let shouldRun = "{{($editMode || $existAvailability)?true:false}}";
                    if(!shouldRun){
                        return false;
                    }
                    var p_element = $(this).attr('id');
                    var weekName = $(this).attr('availability_time_key');
                    if ($('#' + p_element).is(":checked")) {
                      if(p_element.endsWith('_til_ate')){
                        var $selects = $('#' + p_element).closest('.parent-row').find('select');
                            $selects.each(function(index){
                                if(index >= 2){
                                    $(this).prop('disabled', true).val(0);
                                } else {
                                    $(this).prop('disabled', false);
                                }
                            });
                      }else{
                        $('#' + p_element).closest('.parent-row').find('select').attr('disabled', true).val(0);
                      }
                        
                    } else {
                        $('#' + p_element).closest('.parent-row').find('select').attr('disabled', false);
                    }
                    if ($('#' + p_element).is(":checked")) {
                        var previous;
                        var Current = $(this).val();
                        var original = $(this).parent().prev().text();
                        let label = original.substring(0, original.lastIndexOf(":"));
                        $('#trigger-element').val("availability_time");
                        $('#trigger-element2').val("");
                        $('#label').val(label);
                        $('#current').val(Current);
                        $('#previous').val(previous);
                        if (weekName != "") {
                            $('#trigger-element2').val(weekName);
                            let popupMessage = `<p>Would you like to update ${label ? `<b>${label}</b> in your` : 'your'} 'My Information' page for future Profiles?</p>`;
                            $("#Lname").html(popupMessage);
                            $('#change_all').modal('show');
                            previous = this.value;
                        }
                    }
                });


            $('.resetdays').click(function() {
                var p_element = $(this);
                var id = $(this).attr('id');
                var element_class = p_element.attr('data-day');

                $('select.' + element_class).prop('selectedIndex', 0);
                $('select.' + element_class).attr('disabled', false)
                var ch = $('input.' + element_class + ":checked").val();
                $('input.' + element_class + ":checked").prop('checked', false);
            });
        });
        $("#close").click(function() {
            $("#comman_modal").modal('hide');
        });

        $("body").on("click", "#defaultImg", setDefaults);

        $(document).ready(function(e) {
            @if (request()->getPathInfo() == '/escort-dashboard/create-profile')
                setDefaults();
            @endif
        });

        function setDefaults() {
            var url = "{{ route('escort.get.default.images') }}";
            $.ajax({
                type: 'POST',
                url: url,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {

                        $("#blah1").attr('src', data.path[1]['path']);
                        $("#blah2").attr('src', data.path[2]['path']);
                        $("#blah3").attr('src', data.path[3]['path']);
                        $("#blah4").attr('src', data.path[4]['path']);
                        $("#blah5").attr('src', data.path[5]['path']);
                        $("#blah6").attr('src', data.path[6]['path']);
                        $("#blah7").attr('src', data.path[7]['path']);
                        $("#blah8").attr('src', data.path[8]['path']);
                        $("#blah9").attr('src', data.path[9]['path']);
                        $(".cl_blash8").attr('src', data.path[8]['path']);
                        $("#blahx").attr('src', data.path[10]['path']);
                        $("#akhVideo").attr('src', data.path[10]['path']);

                        $("#img1").attr('src', data.path[1]['path']);
                        $("#img2").attr('src', data.path[2]['path']);
                        $("#img3").attr('src', data.path[3]['path']);
                        $("#img4").attr('src', data.path[4]['path']);
                        $("#img5").attr('src', data.path[5]['path']);
                        $("#img6").attr('src', data.path[6]['path']);
                        $("#img7").attr('src', data.path[7]['path']);
                        $("#img9").attr('src', data.path[9]['path']);
                        $("#imgx").attr('src', data.path[10]['path']);

                        $("#mediaId1").val(data.path[1]['id']);
                        $("#mediaId2").val(data.path[2]['id']);
                        $("#mediaId3").val(data.path[3]['id']);
                        $("#mediaId4").val(data.path[4]['id']);
                        $("#mediaId5").val(data.path[5]['id']);
                        $("#mediaId6").val(data.path[6]['id']);
                        $("#mediaId7").val(data.path[7]['id']);
                        $("#mediaId8").val(data.path[8]['id']);
                        $("#mediaId9").val(data.path[9]['id']);
                        $("#mediaIdx").val(data.path[10]['id']);
                    } else {

                    }
                }

            });
        }

        $("body").on("click", "#defaultImg2", setDefaults2);

        function setDefaults2() {
            var url = "{{ route('escort.get.default.images') }}";
            $.ajax({
                type: 'POST',
                url: url,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    
                    if (data.error == true) {

                        $("#img9").attr('src', data.path[9]['path']);
                        $("#blah9").attr('src', data.path[9]['path']);
                        $("#mediaId9").val(data.path[9]['id']);
                        $("#blah0").attr('src', data.path[8]['path']);

                    } else {

                    }
                }
            });
        }

        $("body").on('click', '#manageImgId', function() {
            $(".pic").each(function(e) {
                var id = $(this).data('id');
                var src = $(this).attr('src');
                $("#img" + id).attr('src', src);
            });
            $("#upload-sec").modal('hide');
            $("#upload-sec-banner").modal('hide');

        });


        window.Parsley.addValidator('atLeastOneNumber', {
            requirementType: 'string',
            validateString: function(_, parsleyInstance) {
            // List your three fields here (use IDs, classes, or name attrs)
            const vals = [
                parseFloat(document.querySelector('input[name="massage_price[]"]').value) || 0,
                parseFloat(document.querySelector('input[name="incall_price[]"]').value) || 0,
                parseFloat(document.querySelector('input[name="outcall_price[]"]').value) || 0
            ];
            // Pass if any value > 0
            return vals.some(v => v > 0);
            },
            messages: {
            en: 'Please enter a value above zero in at least one field.'
            }
        });


        $(document).ready(function() {
            const parsleyForm = $('#my_escort_profile').parsley({
                excluded: "input[type=number], input[type=hidden]"
            });
            let allowTabChange = false;
            const tabGroupMap = {
            'profile-tab': 'group_one',
            'contact-tab': 'group_two',
            'playmates-tab': 'group_two',
            'pricing-tab': 'group_three',
            };

            let editMode = '{{$editMode}}';
            
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                const tabId     = e.target.id;               // e.g. 'profile-tab'
                const nextGroup = tabGroupMap[tabId];        // e.g. 'group_one'
                const $target   = $(e.target);
                if(!editMode){
                    if (allowTabChange) {
                    allowTabChange = false;
                    return;
                    }

                    e.preventDefault();

                    if (!nextGroup) {
                    allowTabChange = true;
                    return $target.tab('show');
                    }
                    parsleyForm.whenValidate({
                        group: nextGroup
                    }).then(function() {
                    if(validateWhoAmIContent()){
                        allowTabChange = true;
                        $target.tab('show');
                    }
                    else{
                        return false;
                    }
                    updateProgressBar(tabId);
                    }, function() {
                        console.log('Validation failed');
                    });
                }
                else{
                    updateProgressBar(tabId);
                }
            });
            
        });


        $("body").on('click', '.nex_sterp_btn', function(e) {
            var id = $(this).attr('id');
            $(this).removeClass('active');
            $(".nav-link").removeClass('active');
            $("#" + id).addClass('active');
            switch (id) {
                case 'profile-tab': {
                    let dynamic_image = checkProfileDynamicMedia();
                    if (dynamic_image < 8) {
                        Swal.fire('Media',
                            'Please attach media to this profile from the Media Repository or upload a new file (All are mendatory)',
                            'warning');
                        return false;
                    }

                    if(!validateWhoAmIContent()){
                        return false;
                    }
                } break;
                case 'contact-tab': {
                     let existRates = checkRates();
                     let editMode = '{{$editMode}}';
                    if (!existRates && !editMode) {
                        Swal.fire('Rates',
                            'You must complete at least one rate value to proceed.',
                            'warning');
                        return false;
                    }
                } break;
                case 'playmates-tab':{
                    let checkAvailability = validateAvailability();
                    if(checkAvailability){
                        return false;
                    }
                } break;
                default:{
                    
                }
            }
            updateProgressBar(id);
        });

        var updateProgressBar = function(tab_id){
            let progressBar = $('.define_process_bar_color');
            let percentCont = $('#percent');
            switch (tab_id) {
                case 'home-tab': {
                    progressBar.attr('style', 'width :25%');
                    percentCont.html('25%');
                } break;
                case 'profile-tab': {
                    progressBar.attr('style', 'width :50%');
                    percentCont.html('50%');
                } break;
                case 'contact-tab': {
                    progressBar.attr('style', 'width :75%');
                    percentCont.html('75%');
                } break;
                case 'playmates-tab': {
                    progressBar.attr('style', 'width :100%');
                    percentCont.html('100%');
                } break;
            }
        }

        function update_escort(updateButton, form_data) {
            updateButton.prop('disabled', true).html('<div class="spinner-border"></div>');
            var url = "{{ route('escort.update_escort', $escort->id) }}";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {
                        Swal.fire('Error! Unable to update', '', 'error');
                        updateButton.prop('disabled', false).html('Update');
                    } else {
                        Swal.fire('Updated', '', 'success');
                        updateButton.prop('disabled', false).html('Update');
                    }
                }
            });
        }

        function update_escort_default(updateButton, form_data) {
            updateButton.prop('disabled', true).html('<div class="spinner-border"></div>');
            var url = "{{ route('escort.update_escort_default') }}";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                data: form_data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.error == true) {

                        updateButton.prop('disabled', false).html('Yes');
                    } else {
                        updateButton.prop('disabled', false).html('Yes');
                    }
                }
            });
        }
        var textarea = document.getElementById('editor1');

        CKEDITOR.editorConfig = function(config) {
            config.toolbarGroups = [{
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                {
                    name: 'editing',
                    groups: ['find', 'selection', 'spellchecker', 'editing']
                },
                {
                    name: 'links',
                    groups: ['links']
                },
                {
                    name: 'insert',
                    groups: ['insert']
                },
                {
                    name: 'forms',
                    groups: ['forms']
                },
                {
                    name: 'tools',
                    groups: ['tools']
                },
                {
                    name: 'document',
                    groups: ['mode', 'document', 'doctools']
                },
                {
                    name: 'others',
                    groups: ['others']
                },
                '/',
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                },
                {
                    name: 'styles',
                    groups: ['styles']
                },
                {
                    name: 'colors',
                    groups: ['colors']
                },
                {
                    name: 'about',
                    groups: ['about']
                }
            ];

            config.removeButtons =
                'Underline,Subscript,Superscript,PasteText,PasteFromWord,Scayt,Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,Maximize,About,RemoveFormat,Strike';
        };
        let editor = CKEDITOR.replace(textarea); 
        let deleteKey = 46;
        let backspaceKey = 8;
        let leftArrowKey = 37;
        let rightArrowKey = 38;
        let topArrowKey = 39;
        let bottomArrowKey = 40;
        let charLimit = 2500;
        window.onload = function() {
            CKEDITOR.instances.editor1.on('key', function(event) {
                let keyCode = event.data.keyCode;
                var str = CKEDITOR.instances.editor1.getData();
                if (str.length > charLimit) {
                    return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                        .includes(keyCode);
                }
            });
            CKEDITOR.instances.editor1.on('paste', function(event) {
                var keyCode = event.data.keyCode;
                var str = CKEDITOR.instances.editor1.getData();
                if (str.length > charLimit) {
                    return [deleteKey, backspaceKey, leftArrowKey, rightArrowKey, topArrowKey, bottomArrowKey]
                        .includes(keyCode);
                }
            });
        };

        $("body").on("click", "#save_change", function() {
            let profileName = $('input[name="profile_name"]').val();
            let field = $("#trigger-element").val();
            let custom_id = $("#trigger-element2").val();
            let value = $("#current").val();
            $(`.my_service_anal input[name="service_id[]"][value=${custom_id}]`).next().find('i').addClass('js_defaultProfileService');
            $(`.my_service_anal input[name="service_id[]"][value=${custom_id}]`).parents('li').addClass('js_defaultProfileService');
            let span = $(`.my_service_anal input[name="service_id[]"][value=${custom_id}]`).parent().find('.d_profile_name');
           
            if (span.length) {
                span.get(0).firstChild.nodeValue = `Status: Default`;
                span.find('.js_default_action').text('Remove from default');
            }
            update_escort_default($(this), {
                [field]: value,
                custom_id: custom_id
            });
        });
    </script>
@endpush