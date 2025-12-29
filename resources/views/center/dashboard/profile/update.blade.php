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
   
</style>
@endsection
@section('content')


@php  
$editMode = request()->segment(2) == 'profile' ? true:false;
@endphp

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
                            <form id="my_massage_profile" action="{{ route('center.setting.profile',request()->segment(3) ) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="tab-content custom-tab-bg-mc" id="myTabContent">
                                    
                                    @include('center.dashboard.profile.partials.aboutme-dash-tab')
                                    @include('center.dashboard.profile.partials.services-dash-tab')
                                    @include('center.dashboard.profile.partials.available-dash-tab')
                                   
                                    @include('center.dashboard.profile.partials.massuers-dash-tab')
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal programmatic" id="change_all" style="display: none">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                {{-- <h5 class="modal-title" id="exampleModalLabel" style="color:white">Logout</h5> --}}
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                </span>
                </button>
            </div>
            <div class="modal-body">    
                <input type="hidden" id="current" name="current">
                <input type="hidden" id="previous" name="previous">
                <input type="hidden" id="label" name="label">
                <input type="hidden" id="trigger-element">
                <h3 class="mb-4 mt-5"><span id="Lname"></span> </h3>
                <h3 class="mb-4 mt-5"><span id="log"></span> </h3>
                <div class="modal-footer">
                    <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal" value="close" id="close_change">Close</button>
                    <button type="button" class="btn main_bg_color site_btn_primary" id="save_change">save</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade upload-modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" data-keyboard="false" data-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document"> {{--NOTE:: use  modal-dialog-scrollable instead of modal-dialog to make body scrollable only--}}
       <div class="modal-content">
           
           
               <div class="modal-content border-0">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle"><img src="/assets/dashboard/img/upload-photos.png" class="custompopicon" alt="cross"> Upload Photos</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
                       </button>
                   </div>


                   <form id="mulitiImage" method="POST" action="{{route('center.upload.gallery')}}" enctype="multipart/form-data">
                    @csrf
                   <div class="modal-body">
                   

            
                       <div class="row">
                           <div class="col-md-12">
                               <div class="container p-0">
                                   <div class="row p-0">
                                       <div class="col-12 p-0">
                                           <div class="photo-sec-popup custom-upload-photo"  id="image_preview">
                                               <a href="#">
                                                   <div class="five_column_content_top img-title-sec justify-content-between wish_span rm" style="z-index: 1;">
                                                     
                                                   </div>
                                                   <label class="newbtn rm">
                                                       <img id="blah" class="item" src="{{ asset('assets/app/img/upload-thum-1.png')}}">
                                                       
                                                       <input name="img[]" id="upload_file" class="pis" onchange="preview_image(this);" type="file" multiple accept="image/*">
                                                   </label>
                                                   <div style="margin-top: -34px;">
                                                   </div>
                                               </a>
                                           </div>
                                           <div class="row mt-2">
                                               <div class="col-lg-12">
                                                   <div class="plate"><label class="newbtn">
                                                       <img id="blah9" class="img-fluid pl-2 pr-2" src="{{ asset('assets/app/img/upload-3.png')}}" style="height: 150px;object-fit: cover;width: 100%;">
                                                       <input name="img[9]" id="pic9" class="pis" onchange="readURL(this);" type="file" accept="image/*" >
                                                       <input type="hidden" name="position[]" id="mediaId9">
                                                       </label>
                                                   </div>
                                               </div>
                                              
                                           </div>
                                       </div>
                                   </div>
                                   
                               </div>
                           </div>
                       </div>
                      
                   </div>
                    </form>
                   <div class="modal-footer">
                     <button type="submit" class="btn-success-modal">Verify Media</button>
                       <button type="button" id="upload_photos" class="btn-success-modal">Upload</button>
                   </div>
               </div>
           
       </div>
   </div>
</div>



@include('escort.dashboard.modal.upload_gallery_image')
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
var textarea = document.getElementById('about_us_box');
CKEDITOR.replace('about_us_box');
var updatePosition = 0;
</script>


<script src="{{ asset('js/massage/create-profile-methods.js') }}"></script> 
<script src="{{ asset('js/massage/profile_and_media_gallery.js') }}"></script>


<script>


    $("body").on("click", "#defaultImg", setDefaults);
   
    $ (document).ready(function(e) {

       


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

            console.log('isThirdTab',isThirdTab);


            // if (isFirstTab) 
            // {

            //     if(!checkProfileDynamicMedia()){
            //     return false;
            //     }
            // }

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
                    $(".uploadModalTrigger").find("button").attr('data-target', '#upload-sec');

                }
            });

            $(".uploadModalTrigger").on('click', 'button', function() {
                $("#photo_gallery").modal("hide");
                $("#photo_gallery_banner").modal("hide");
            });



         @if (request()->getPathInfo() == '/center-dashboard/create-profile')
                setDefaults();
          @endif
        
    });



</script>
@endpush