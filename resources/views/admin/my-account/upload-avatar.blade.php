@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   label.cabinet input.file{
	position: relative;
	height: 100%;
	width: auto;
	opacity: 0;
	-moz-opacity: 0;
  filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  margin-top:-30px;
}

#upload-demo{
	width: 250px;
	height: 250px;
  padding-bottom:25px;
}
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
    <div class="row">
        
        
        <div class="col-md-12">
            <div class="v-main-heading">
                  <h1>Upload your avatar <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b> </span></h1>
            </div>
            <div class="my-4">
                  <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol>
                            <li>You don't have to have an avatar, it is entirely up to you</li>
                            <li>Your avatar will not be displayed publicly</li>
                            <li>You can remove or change your avatar anytime</li>
                        </ol>
                    </div>
                  </div>
            </div>
        </div>
        <div class="col-md-12" id="profile_and_tour_options">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <h2 class="primery_color normal_heading font-weight-bold">File types</h2>
                            <p>When selecting your avatar, please be mindful of the following:</p>
                            <ul>
                                <li>Yes you can use a photo, but we do not recommend it</li>
                                <li>Acceptable formats include; .jpg, .gif or .png
                                .pdf, .psd, .tff, and .doc files are not compatible</li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-4 mt-4">
                                    <h2 class="primery_color normal_heading font-weight-bold">Upload your avatar</h2>
                                    <form id="my_avatar" action="{{ route('admin.save.avatar',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                                        <div class="file-upload">
                                            <div class="image-upload-wrap">
                                                <input class="file-upload-input gambar item-img" name="avatar_img" type="file" onchange="readURL(this);" accept="image/*">
                                                <div class="drag-text">
                                                    <h3>Drag and drop a file or select add Image</h3>
                                                </div>
                                            </div>
                                            <div class="file-upload-content">
                                                <img class="file-upload-image item-img" src="#" alt="your image" id="item-img-output">
                                                <div class="image-title-wrap">
                                                    
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                                    <button type="submit" class="remove-image crop_image">Save <span class="image-title">Uploaded Image</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4 mt-4 current-avatar">
                                    
                                    <h2 class="primery_color normal_heading font-weight-bold">Current Avatar</h2><!-- <i class="fab fa-twitter delete_avatar"></i> -->
                                    @if(auth()->user()->avatar_img)
                                    <button type="button" class="avatar close delete_avatar" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    @endif
                                    <img src="{{ !auth()->user()->avatar_img ? asset('assets/app/img/service-provider/Frame-408.png') :asset('avatars/'.auth()->user()->avatar_img) }}" alt="" class="img-rounded avatarName">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12 mt-4">
                    <div id="accordion" class="myacording-design mb-5">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#File_name" aria-expanded="true">
                                Additional Upload Information
                                </a>
                            </div>
                            <div id="File_name" class="collapse" data-parent="#accordion" style="">
                                <div class="card-body">
                                    <p style="font-size: 20px;"><b>File name</b> </p>
                                    <p>Only use letters, numbers, underscores, and hyphens in file names.</p>
                                    <p style="font-size: 20px;"><b>File size</b> </p>
                                    <p>We recommend using image files of less than 500 KB for best results, though the limit for an individual image upload is 2 MB.</p>
                                    <p style="font-size: 20px;"><b>Resolution</b> </p>
                                    <p>There is an image resolution limit of 60 MP (megapixels).</p>
                                    <p style="font-size: 20px;"><b>Colour mode</b> </p>
                                    <p>Save images in RGB color mode. Print mode (CMYK) won't render in most browsers.
                                    </p>
                                    <p style="font-size: 20px;"><b>Colour profile</b> </p>
                                    <p>Save images in the sRGB color profile. If images don't look right on mobile devices, it's probably because they don't have an sRGB color profile.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--middle content end here-->
</div>
   </div>
   <!-- End of Main Content -->
   <!-- Footer -->
   <footer class="sticky-footer bg-white">
      <div class="container my-auto">
         <div class="copyright text-center my-auto">
            <span> </span>
         </div>
      </div>
   </footer>
   <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content custome_modal_max_width">
            <div class="modal-header main_bg_color border-0">
                <span style="color: white">Crop Photo</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen">
                    
                </button>
                
            </div>
            <div class="modal-body">
                <div id="upload-demo" class="center-block">
                    {{-- <div class="cr-boundary" aria-dropeffect="none">
                        <img src="{{ asset('assets/app/img/service-provider/Frame-408.png')}}" alt="" class="img-rounded" >
                    </div>
                    <div class="cr-slider-wrap"><input class="cr-slider" type="range" step="0.0001" aria-label="zoom" min="0.0000" max="1.5000" aria-valuenow="0.0913"></div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn main_bg_color site_btn_primary" data-dismiss="modal">Close</button>
                <button type="button" id="cropImageBtn" class="btn main_bg_color site_btn_primary">Crop</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
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
<script>
    // function readURL(input) {
    // if (input.files && input.files[0]) {
    
    // var reader = new FileReader();
    
    // reader.onload = function(e) {
    //   $('.image-upload-wrap').hide();
    
    //   $('.file-upload-image').attr('src', e.target.result);
    //   $('.file-upload-content').show();
    
    //   $('.image-title').html(input.files[0].name);
    // };
    
    // reader.readAsDataURL(input.files[0]);
    
    // } else {
    // removeUpload();
    // }
    // }
    
    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });

        $(".gambar").attr("src");
        var $uploadCrop,
        tempFilename,
        rawImg,
        imageId;
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;
                    
                }
                reader.readAsDataURL(input.files[0]);
            }
            else {
                removeUpload();
            }
        }
    

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 150,
                height: 200,
            },
            enforceBoundary: false,
            enableExif: true
        });

        $('#cropImagePop').on('shown.bs.modal', function(){
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function(){
                console.log( '1jQuery bind complete');
            });
        });

        $('#cropImageBtn').on('click', function (ev) {
            $uploadCrop.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                size: {width: 150, height: 200}
            }).then(function (resp) { 
                $('.file-upload-content').show();
                $('#item-img-output').attr('src', resp);
                //$('.file-upload-image').attr('src', e.target.result);
            
                $('#cropImagePop').modal('hide');
            });
        });

    $("#my_avatar").on('submit',function(e){
        e.preventDefault();
        
        var form = $(this);
        var src = $("#item-img-output").attr('src');
        var url = form.attr('action');
        //console.log("hii"+ src);
        var data = new FormData($('#my_avatar')[0]);

        
        data.append('src',src);
        $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    console.log(data);
                    if(data.type == 0){
                        var msg = "Saved";
                        var url = "{{asset('avatars/name')}}";
                        url = url.replace('name',data.avatarName);
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');
                        $(".avatarName").attr('src',url);
                        $(".file-upload-content").hide();
                        
                        
                        
                    } else {
                        var msg = "Sumthing wrong...";
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#comman_modal").modal('show');
                        location.reload();
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
                    
                }
            });
    });
    $(".delete_avatar").click(function()
    {
        $.post({
                    type: 'POST',
                    url: "{{ route('center.avatar.remove') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                }).done(function (data) {
                    if(data.type == 0) {
                        $('.Lname').html("Saved");
                        $("#my_account_modal").modal('show');
                        console.log("Oops..");
                    } else {
                        $('.Lname').html("Removed");
                       // $("#my_account_modal").modal('show');
                        $("#my_account_modal").show();
                        console.log("ok");
                    }
                });
       
    });

    $("#close").click(function()
    {
        $("#my_account_modal").hide();
        location.reload();
    });
</script>
@endpush