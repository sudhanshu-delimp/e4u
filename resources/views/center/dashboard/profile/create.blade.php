@extends('layouts.center') @section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0);
    padding: 0;
    }
    .parsley-errors-list li{
    font-size: 14px;
    line-height: 18px;
    margin-top: 6px;
    }

    .prev_step_btn {
    border: 1px solid transparent;
    padding: 10px 21px 10px 20px;
    font-size: 1rem;
    line-height: 1.5;
    background: #FF3C5F;
    color: #fff;
    border-radius: 0.35rem;
    transition: 0.5s;
}
.prev_step_btn .fa-arrow-left {
    color: #fff !important;
}
  
.disabled-form-tab {
    pointer-events: none;
    opacity: 0.5;
}

</style>
@endsection
@section('content')




<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <!--middle content-->
            <div class="row">
                <div class="custom-heading-wrapper col-md-12">
                    <h1 class="h1">New Profile</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                        <p></p>
                        <ol>
                                
                        </ol>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                   <div class="row">
                      <div class="col-lg-2">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 1</div>
                            <p>About us</p>
                         </div>
                      </div>
                      <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 2</div>
                            <p>Services &amp; Rates</p>
                         </div>
                      </div>
                    
                      <div class="col-lg-3">
                        <div class="form_process">
                           <div class="steps_to_filled_from">Step 3</div>
                           <p>Open times</p>
                        </div>
                     </div>
                      
                      <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 4</div>
                            <p>Masseurs</p>
                         </div>
                      </div>
                      {{-- <div class="col-lg-3">
                         <div class="form_process">
                            <div class="steps_to_filled_from">Step 5</div>
                            <p>Check fee summary and pay</p>
                         </div>
                      </div> --}}
                      <div class="col-lg-1">
                        <p id="percent" style="font-size: 48px;font-weight: 700;">25%</p>
                      </div>
                   </div>
                   <div class="manage_process_bar_padding">
                      <div class="progress define_process_bar_width">
                         <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Page Content -->
                    <div class="row">
                        <div class="col-md-12 remove_padding_in_ph" id="tabs">
                            <ul class="dk-tab nav gap_between_btns mb-3" id="myTab" role="tablist">
                                <li class="nav-item m-0">
                                   <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">About us</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Services &amp; Rates</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available" role="tab" aria-controls="contact" aria-selected="false">Open Times</a>
                                </li>
                                <li class="nav-item m-0">
                                   <a class="nav-link" id="massuers-tab" data-toggle="tab" href="#massuers" role="tab" aria-controls="massuers" aria-selected="false">Masseurs</a>
                                </li>
                                {{-- <li class="nav-item m-0">
                                   <a class="nav-link" id="pricing-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact" aria-selected="false">Check fee summary and pay</a>
                                </li> --}}
                                
                                
                            </ul>
                            <form id="my_massage_profile" action="{{ route('center.create-profile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content custom-tab-bg-mc" id="myTabContent">
                                    
                                    @include('center.dashboard.profile.create.aboutme-dash-tab')
                                    @include('center.dashboard.profile.create.services-dash-tab')
                                    @include('center.dashboard.profile.create.available-dash-tab')
                                    @include('center.dashboard.profile.create.massuers-dash-tab')
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<div class="modal programmatic" id="update_info" style="display: none">
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

            <form name="update_single_data" method="post" action="{{route('center.update-single-data')}}">
            <input type="hidden" name="post_field" id="post_field" value="">
            <input type="hidden" name="post_value" id="post_value" value="">

             <input type="hidden" name="post_json" id="post_json" value="">
            <input type="hidden" name="post_type" id="post_type" value="">
                
                <h3 class="my-2"><span id="Lname"><p>Would you like to update <b>
                                <span id="field_name"></span>       
                </b> in your 'My Information' page for future Profiles?</p></span> </h3>
                <div class="modal-footer">
                <button type="button" class="btn-cancel-modal gender_alert" data-dismiss="modal"
                    value="close" id="close_change">No</button>
                <button type="button" class="btn-success-modal" id="update_new_value">Yes</button>
                </div>
            </form>


         </div>
      </div>
   </div>
</div>




@include('center.dashboard.modal.upload_gallery_image')
@include('center.dashboard.modal.remove_gallary_image')
@include('center.dashboard.modal.upload_gallery_video')
@include('center.dashboard.modal.set_default_video')
@include('center.dashboard.modal.remove_gallary_video')

@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@endsection
@push('script')
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/src/extra/validator/comparison.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> -->


<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>

<script>
window.defaultImagesUrl = "{{ route('center.get.default.images') }}";
window.postdefaultImageUrl = "{{ route('center.default.images') }}";
var textarea = document.getElementById('about_us_box');
CKEDITOR.replace('about_us_box');
var updatePosition = 0;
var edit_mode = false;

</script>


<script src="{{ asset('js/massage/create-profile-methods.js') }}"></script> 
<script src="{{ asset('js/massage/profile_and_media_gallery.js') }}"></script>


<script>


    $("body").on("click", "#defaultImg", setDefaults);
   
    $ (document).ready(function(e) {


        $('#language').change(function(){
            var languageValue = $('#language').val();
            $("#show_language").show();
            $(".select_lang").hide();
            var selectedLanguage = $(this).children("option:selected", this).data("name");
            $("#show_language").append("  <div class='selecated_languages' style='display: inline-block'><span class='languages_choosed_from_drop_down'>"+ selectedLanguage +" <small class='remove-lang'>×</small></span> </div> ");
            $("#container_language").append("<input type='hidden' name='language[]' value="+ languageValue +">");
            $("#language option[value='"+languageValue+"']").remove();
        });

         $(document).on('click', '.remove-lang , span.custom--help', function () {
            $(this).closest('.selecated_languages').remove();            
            $(this).closest('.custom-help-contain').toggleClass('help-note-toggle');
        });

        //// ----------- Update Single Data ------------ ///////
         $('.update_profile_data').on('blur change', function () {

                var current_feild  = $(this).attr('id');
                var current_value  = $(this).val();
                
                if(current_value==="")
                return false;    


                var old_value  = $('#profile_'+current_feild).val();

                if(current_feild=='about_title')
                    current_feild = 'about_us_box'

                if (current_value !== old_value) {
                $('#post_field').val(current_feild);
                $('#post_value').val(current_value);
                $('#field_name').text(formatProfileName(current_feild));
                $('#update_info').modal('show');
                }
         });


         $('.update_default_rate').on('blur', function () {

                var duration_id  = $(this).data('duration_id');
                var massage_profile_id  = $(this).data('massage_profile_id');
                var data_type  = $(this).data('data_type');


                var current_value  = $(this).val();
                var current_feild  = $(this).attr('id');

                var current_old_input = 'profile_'+current_feild;
                var old_value  =  $(this).closest('.service_rate_dolor_symbol').find('.'+current_old_input).val();

               
            
                if(current_value==="")
                return false;    


                if (current_value !== old_value) {

                let postData = {
                    duration_id: duration_id,
                    massage_profile_id: massage_profile_id,
                    data_type: data_type,
                    new_value: current_value
                }

                $('#post_json').val(JSON.stringify(postData));
                $('#post_type').val('rate');
                $('#field_name').text('Rate');
                $('#update_info').modal('show');
                }
         });


            function formatProfileName(text) {

                let formattedText = text
                    .split('_')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');

                switch (formattedText) {
                    case 'Phone':
                        return 'Mobile No';

                        case 'About Us Box':
                        return 'Who are We';
                    
                    default:
                        return formattedText;
                }
            }

            $('#update_new_value').on('click', function (e) {
                e.preventDefault();
                swal_waiting_popup({'title':'Updating Data.'});
                let form = $('form[name="update_single_data"]');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.close();
                        $('#update_info').modal('hide');    
                    },
                    error: function (xhr) {
                       Swal.close();
                       $('#update_info').modal('hide');
                    },
                    complete: function () {
                         Swal.close();
                         $('#update_info').modal('hide');
                    }
                });
            });    

        ///////// End Update Single Data //////////////////      


        //$('#profile-tab, #contact-tab, #massuers-tab').addClass('disabled-form-tab');


        const validator = $('#my_massage_profile').validate({
            ignore: function (index, element) {
                return $(element).closest('.tab-pane').length &&
                    !$(element).closest('.tab-pane').hasClass('active');
            },

            errorClass: 'text-danger',
            errorElement: 'small'
        });



        $('.nex_sterp_btn').on('click', function () {

            syncCKEditor();
            let isValid = true;
            let isFirstTab = $('a.nav-link.active').parent().is(':first-child');
            let isSecondTab = $('a.nav-link.active').parent().index() === 1;
            let isThirdTab = $('a.nav-link.active').parent().index() === 2;

            


            if (isFirstTab) 
            {

                console.log('isFirstTab',isFirstTab);

                if(!checkProfileDynamicMedia()){
                return false;
                }
            }

            if(isSecondTab)
            {

                if(!validateSecondTab())
                 return false;    
            }

            if(isThirdTab)
            {

                if(!validateThirdTab())
                 return false; 
            
            }


        
            $('.tab-pane.active :input').each(function () {
                if (!validator.element(this)) {
                    isValid = false;
                }
            });


            if(!checkProfileDynamicMediaVideo()){
                    Swal.fire('Media',
                        'Please attach video to this profile from the Media Repository or upload a new file',
                        'warning');
                    return false;  
            }

            
            if (!validateCKEditor()) {
                isValid = false;
            }

            if (!isValid) return false;


                let nextTab = $('a.nav-link.active')
                    .parent()
                    .next()
                    .find('a[data-toggle="tab"]');

               if (nextTab.length) {
                   
                    nextTab.tab('show');
                    nextTab.removeClass('disabled-form-tab'); 
                    updateProgressBar(nextTab.attr('id'));
                }
        

        });

        $('.prev_step_btn').on('click', function () {

            let prevTab = $('a.nav-link.active')
                .parent()
                .prev()
                .find('a[data-toggle="tab"]');

            if (prevTab.length) {
                prevTab.tab('show');
            }
        });


          
                
          initDragDrop();

          $("#img1, #img2, #img3, #img4, #img5, #img6, #img7, #img9").on('click', function(e) {
                if ($(this).attr('id') == 'img9') {
                    $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec-banner');

                } else {
                    $(".uploadModalTrigger").find("button").attr('data-target', '#exampleModal');

                }
            });

            $(".uploadModalTrigger").on('click', 'button', function() {
                $("#photo_gallery").modal("hide");
                $("#photo_gallery_banner").modal("hide");
            });



        



        $('#my_massage_profile').on('submit', function (e) {
            e.preventDefault();
            submit_form_massage();
            });

            function submit_form_massage() 
            {
                let form = $('#my_massage_profile');
                let formData = new FormData(form[0]);
                swal_waiting_popup({'title':'Creating Profile'});
                $.ajax({
                    url: "{{ route('center.create.profile') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.close();
                        if (response.success === true && response.massage_profile_id) {
                            swal_success_popup(response.message ?? 'Profile created successfully');
                            setTimeout(function () {
                                window.location = 'update-profile/' + response.massage_profile_id;
                            }, 2000); // 2 seconds

                        } 
                        else 
                        {
                            swal_error_popup('Something went wrong');
                        }
                    },

                    error: function (xhr) {
                        Swal.close();
                        let message = 'Error while saving profile';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        swal_error_popup(message);
                    }
                });
            }
        
    });


    


</script>
@endpush