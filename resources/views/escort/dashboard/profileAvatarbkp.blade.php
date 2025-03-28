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
<div class="container-fluid pl-3 pl-lg-5">
    <!--middle content start here-->
    <div class="row">
        <div class="col-md-12">
            <div class="v-main-heading h3">Upload your avatar11</div>
        </div>
        <div class="col-md-12 mt-4" id="profile_and_tour_options">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <p class="small" style="font-size: 20px;"><b>Notes:</b></p>
                            <ul>
                                <li>You don't have to have an avatar, it is entirely up to you</li>
                                <li>Your avatar will not be displayed publicly</li>
                                <li>You can remove or change your avatar anytime</li>
                            </ul>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD

                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0">
                            <div class="card-body">
                              <div class="v-main-heading h5">File types</div>
                              <p>When selecting your avatar, please be mindful of the following:</p>
                              <ul>
                                  <li>Yes you can use a photo, but we do not recommend it</li>
                                  <li>Acceptable formats include; .jpg, .gif or .png</li>
                                  <li>.pdf, .psd, .tff, and .doc files are not compatible</li>
                              </ul>
                             <div class="row mt-4">
  <div class="col-lg-4 mt-4"><div class="v-main-heading h5">Upload your avatar</div>
<div class="file-upload">
 

  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>
</div>
  <div class="col-lg-4 mt-4"><div class="v-main-heading h5">Current Avatar</div>
  <img src="{{ asset('assets/dashboard/img/1556626889.jpg') }}" alt="" class="img-rounded">

</div>
  
</div>
=======
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="v-main-heading h5">File types</div>
                            <p>When selecting your avatar, please be mindful of the following:</p>
                            <ul>
                                <li>Yes you can use a photo, but we do not recommend it</li>
                                <li>Acceptable formats include; .jpg, .gif or .png</li>
                                <li>.pdf, .psd, .tff, and .doc files are not compatible</li>
                            </ul>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="v-main-heading h5">Upload your avatar</div>
                                    <div class="file-upload">
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" name="avatar_img" type='file' onchange="readURL(this);" accept="image/*" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <form id="my_avatar" action="{{ route('escort.save.avatar',auth()->user()->id)}}" method="POST" enctype="multipart/form-data">
                                                    <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                                                    <button type="submit" class="remove-image">Save <span class="image-title">Uploaded Image</span></button>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="v-main-heading h5">Current Avatar</div>
                                    <img src="{{ asset('assets/dashboard/img/1556626889.jpg') }}" alt="" class="img-rounded">
                                </div>
>>>>>>> c19d5b5e344da923c8e1aa9048b5111896c889b5
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD

<div class="row mt-4">
           
            <div class="col-md-12 mt-2">
<div id="accordion" class="myacording-design mb-5">

                  <div class="card">
                    <div class="card-header">
                      <a class="card-link" data-toggle="collapse" href="#File_name" aria-expanded="true">
                        Additional Upload Information
                      </a>
                    </div>
                    <div id="File_name" class="collapse show" data-parent="#accordion" style="">
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
=======
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
                            <div id="File_name" class="collapse show" data-parent="#accordion" style="">
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
>>>>>>> c19d5b5e344da923c8e1aa9048b5111896c889b5
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
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
    
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.image-upload-wrap').hide();
    
      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();
    
      $('.image-title').html(input.files[0].name);
    };
    
    reader.readAsDataURL(input.files[0]);
    
    } else {
    removeUpload();
    }
    }
    
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
    $("#my_avatar").on('submit',function(e){
        e.preventDefault();
        console.log("hii");
        $.ajax({
                method: form.attr('method'),
                url:url,
                data:data,
                contentType: false,
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if(!data.error){
                        $.toast({
                            heading: 'Success',
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_services').prop('disabled', false);
                        $('#my_services').html('Updated');
                    } else {
                        $.toast({
                            heading: 'Error',
                            text: 'Records Not update',
                            icon: 'error',
                            loader: true,
                            position: 'top-right',      // Change it to false to disable loader
                            loaderBg: '#9EC600'  // To change the background
                        });
                        $('#my_services').prop('disabled', false);
                        $('#my_services').html('Update');
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
                    $('#my_services').html('Updated');
                }
            });
    });
</script>
@endpush