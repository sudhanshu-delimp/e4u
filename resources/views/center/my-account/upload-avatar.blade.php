@extends('layouts.center')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
    <style>
        .swal-button {
            background-color: #242a2c;
        }

        label.cabinet input.file {
            position: relative;
            height: 100%;
            width: auto;
            opacity: 0;
            -moz-opacity: 0;
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
            margin-top: -30px;
        }

    </style>
@stop
@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <!--middle content start here-->
                <div class="row">
                    <div class="col-md-12 custom-heading-wrapper">
                        <h1 class="h1">Upload your avatar</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true"><b>Help?</b></span>
                    </div>
                    <div class="col-md-12 mb-4" id="profile_and_tour_options">
                        <div class="card collapse" id="notes" style="">
                            <div class="card-body">
                                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                                <ol>
                                    <li>You don't have to have an avatar, it is entirely up to you.</li>
                                    <li>Your avatar will not be displayed publicly.</li>
                                    <li>You can remove or change your avatar anytime.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <!-- File Types -->
                         <x-file-type />  

                        <!-- Upload / Current Avatar -->
                        <x-avatar-upload
                            :form-action="route('center.save.avatar', auth()->user()->id)"
                        />
                        
                    </div>
                </div>
                 <x-upload-info />  
        </div>
    </div>
    <!--middle content end here-->
    </div>
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
    
    <x-crop-image-modal
        title="Crop Photo"
        subtitle="Adjust your image before uploading"
        button-text="Crop & Continue"
    />
    
    
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

        $('.avatar-upload-submit').hide();

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
            placeholder: 'Select City',
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
            placeholder: 'Select State',
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
            if ($(this).val()) {
                $('#state').prop('disabled', false);
                $('#state').select2('open');
            } else {
                $('#state').prop('disabled', true);
            }
        });

        $('#state').on('change', function(e) {
            if ($(this).val()) {
                $('#city').prop('disabled', false);
                $('#city').select2('open');
            } else {
                $('#city').prop('disabled', true);
            }
        });
    </script>
    <script>
        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
            $('.avatar-upload-submit').hide();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
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
                reader.onload = function(e) {
                    $('.upload-demo').addClass('ready');
                    $('#cropImagePop').modal('show');
                    rawImg = e.target.result;

                }
                reader.readAsDataURL(input.files[0]);
            } else {
                removeUpload();
            }
        }

        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                  type: 'circle',
            },
            enforceBoundary: false,
            enableExif: true
        });




        $('#cropImagePop').on('shown.bs.modal', function() {
            // alert('Shown pop');
            $uploadCrop.croppie('bind', {
                url: rawImg
            }).then(function() {
                console.log('1jQuery bind complete');
            });
        });


        $('#cropImageBtn').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport',
                format: 'png',
                size: {
                    width: 200,
                    height: 200
                }
            }).then(function(resp) {
                $('.file-upload-content').show();
                $('#item-img-output').attr('src', resp);
                // Show Reset + Save Avatar buttons after crop
                $('.avatar-upload-submit').show();
                $('#cropImagePop').modal('hide');
            });

        });

        function getBase64SizeBytes(base64) {
            try {
                if (!base64 || base64.indexOf(',') === -1) return 0;
                var b64 = base64.split(',')[1];
                var padding = (b64.match(/=+$/) || [''])[0].length;
                return Math.floor((b64.length * 3) / 4) - padding;
            } catch (e) {
                return 0;
            }
        }

        $("#my_avatar").on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $("#modal-title").text("Upload Your Avatar");
            $("#modal-icon").attr("src", "/assets/dashboard/img/upload-photos.png");
            var src = $("#item-img-output").attr('src');
            // Client-side 2MB check before sending AJAX
            var maxBytes = 10 * 1024 * 1024;
            var inputEl = $('.file-upload-input')[0];
            var oversize = false;
            if (inputEl && inputEl.files && inputEl.files[0]) {
                oversize = inputEl.files[0].size > maxBytes;
            } else if (src && src.indexOf('data:image/') === 0) {
                oversize = getBase64SizeBytes(src) > maxBytes;
            }
            if (oversize) {
                showAlert('error', 'Error', 'Image must be 10MB or less.');
                try {
                    removeUpload();
                } catch (e) {}
                $('.avatar-upload-submit').hide();
                return false;
            }

            swal_waiting_popup({
                'title': 'Your avatar is being uploaded...'
            });
            var url = form.attr('action');
            var data = new FormData($('#my_avatar')[0]);
            data.append('src', src);
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
                    Swal.close();
                    if (data.type == 0) {
                        var url = "{{ asset('avatars/name') }}";
                        url = url.replace('name', data.avatarName);
                        showAlert('success', 'Upload Successful','Avatar uploaded successfully!');
                        $(".avatarName").attr('src', url);
                        $(".file-upload-content").hide();
                        $('.avatar-upload-submit').hide();
                        // Show the delete button since avatar is now uploaded
                       if ($(".delete_avatar").length === 0) {
 
                            $(".avatar-actions").append(`
                                <button type="button" class="remove-avatar-btn delete_avatar">
                                <!-- SVG -->
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                <path
                                                        d="M10 12L14 16M14 12L10 16M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3411 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3411 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698 15.4671 5.18807 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698 8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                        stroke="#ffffff"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round">
                                </path>
                                </svg>
                                                Remove
                                </button>
                            `);
                            
                        } else {
                            $(".delete_avatar").show();
                        }
 
                    } else {
                        errorModuleShow(data);
                    }
                },
                error: function(data) {
                    Swal.close();
                    errorModuleShow(data);
                    $('.avatar-upload-submit').hide();
                }
            });
        });


        function errorModuleShow(data = null) {
            var msg = "";
            try {
                var resp = null;
                if (data && data.responseJSON) {
                    resp = data.responseJSON;
                } else if (data && data.responseText) {
                    try {
                        resp = JSON.parse(data.responseText);
                    } catch (e) {}
                } else {
                    resp = data;
                }

                if (resp) {
                    if (typeof resp === 'string') {
                        msg = resp;
                    } else if (resp.message) {
                        msg = resp.message;
                    } else if (resp.errors) {
                        var errors = resp.errors;
                        var first = null;
                        if (Array.isArray(errors)) {
                            first = errors[0];
                        } else if (errors.src) {
                            first = Array.isArray(errors.src) ? errors.src[0] : errors.src;
                        } else if (errors.avatar_img) {
                            first = Array.isArray(errors.avatar_img) ? errors.avatar_img[0] : errors.avatar_img;
                        } else if (errors.file) {
                            first = Array.isArray(errors.file) ? errors.file[0] : errors.file;
                        }
                        if (first) msg = first;
                    }
                }
            } catch (e) {}

            showAlert('error', 'Error', msg);
            $(".delete_avatar").hide();
        }


        // Bind delete avatar event to show confirmation modal
      $(document).on('click', '.delete_avatar', function(e) {
        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Remove Avatar',
            text: 'Are you sure you want to delete your avatar?',
            showCancelButton: true,
            confirmButtonText: 'Yes, Remove',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#0b2545',
            cancelButtonColor: '#ff3c5f',
            allowOutsideClick: false,
            allowEscapeKey: false
        }).then(function(result) {

        if (!result.isConfirmed) {
            return;
        }

        var deleteBtn = $(".delete_avatar");
        var originalText = deleteBtn.html();

        deleteBtn.html('<i class="fas fa-spinner fa-spin"></i>');
        deleteBtn.prop('disabled', true);

        $.ajax({
            method: 'POST',
            url: "{{ route('center.avatar.remove') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(data) {

                if (data.type == 0) {

                    $(".avatarName").attr('src', data.img);
                    $(".delete_avatar").hide();

                    showAlert(
                        'success',
                        'Success',
                        'Avatar removed successfully!'
                    );

                } else {

                    showAlert(
                        'error',
                        'Error',
                        data.message || 'Something went wrong. Please try again.'
                    );
                }
            },

            error: function(xhr, status, error) {

                showAlert(
                    'error',
                    'Error',
                    'Error occurred while removing avatar.'
                );
            },

            complete: function() {

                deleteBtn.html(originalText);
                deleteBtn.prop('disabled', false);
            }
        });
    });
});

       
    </script>
@endpush
