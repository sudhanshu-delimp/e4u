@extends('layouts.agent')
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

        #upload-demo {
            width: 250px;
            height: 250px;
            padding-bottom: 25px;
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
                {{-- Page Heading   --}}
                <div class="row">
                    <div class="custom-heading-wrapper col-lg-12">
                        <h1 class="h1">Upload your avatar</h1>
                        <span class="helpNoteLink font-weight-bold" data-toggle="collapse" data-target="#notes"
                            aria-expanded="true">Help?</span>
                    </div>
                    <div class="col-md-12 my-2">
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
                {{-- end --}}

                <div class="row">
                    <div class="col-md-12" id="profile_and_tour_options">
                        <x-file-type />
                        <!-- Upload / Current Avatar -->
                        <x-avatar-upload :form-action="route('agent.save.avatar', auth()->user()->id)" />
                        <x-upload-info />

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

   <x-crop-image-modal
        title="Crop Photo"
        subtitle="Adjust your image before uploading"
        button-text="Crop & Continue"
    />

    <div class="modal fade upload-modal" id="conformation_modal" style="display: none">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/remove-image.png') }}" class="custompopicon"
                            id="modal-icon">
                        <span style="color:white" id="modal-title">Remove Avatar</span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            <img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen">
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="custom_modal_text" style="text-align: center;">
                        <span id="comman_str">Are you sure you want to delete your avatar?</span>

                    </h5>
                </div>
                <div class="modal-footer justify-content-center pt-0">
                    <button type="submit" class="btn-success-modal" id="confirmDelete" data-dismiss="modal"
                        id="close">Yes</button>
                    <button type="submit" class="btn-cancel-modal" id="cancelDelete" data-dismiss="modal"
                        id="close">NO</button>
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
                $('.avatar-upload-submit').show();
                //$('.file-upload-image').attr('src', e.target.result);

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


        //SHS

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
                $('.comman_msg').text('Image must be 10MB or less.');
                $("#comman_modal").modal('show');
                try {
                    removeUpload();
                } catch (e) {}
                $('.avatar-upload-submit').hide();
                return false;
            }


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

                    if (data.type == 0) {
                        var msg = "Avatar uploaded successfully!";
                        var url = "{{ asset('avatars/name') }}";
                        url = url.replace('name', data.avatarName);
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        showAlert('Avatar Upload', msg, "success");
                        // $("#comman_modal").modal('show');
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

            $('.comman_msg').text(msg);
            $("#comman_modal").modal('show');
            $(".delete_avatar").hide();
        }


        $('#confirmDelete').on('click', function(e) {
            e.preventDefault();

            try {
                // Show loading state on delete button
                var deleteBtn = $(".delete_avatar");
                var originalText = deleteBtn.html();
                deleteBtn.html('<i class="fas fa-spinner fa-spin"></i>');
                deleteBtn.prop('disabled', true);

                $.ajax({
                    method: 'POST',
                    url: "{{ route('agent.avatar.remove') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        try {
                            if (data.type == 0) {

                                // Update avatar image to default
                                $(".avatarName").attr('src', data.img);

                                // Hide delete button
                                $(".delete_avatar").hide();
                            } else {
                                // Error - show error message
                                showErrorMessage(data.message ||
                                    "Something went wrong. Please try again.");
                            }
                        } catch (error) {
                            showErrorMessage("Error processing server response. Please try again.");
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMsg = "Error occurred while removing avatar.";
                        showErrorMessage(errorMsg);
                    },
                    complete: function() {
                        try {
                            // Reset button state
                            deleteBtn.html(originalText);
                            deleteBtn.prop('disabled', false);
                        } catch (error) {
                            console.error('Error resetting button state:', error);
                        }
                    }
                });
            } catch (error) {
                // console.error('Error in confirmDelete click handler:', error);
                showErrorMessage("An unexpected error occurred. Please try again.");

                // Reset button state
                var deleteBtn = $(".delete_avatar");
                deleteBtn.html('×');
                deleteBtn.prop('disabled', false);
            }
        });

        $('#cancelDelete').on('click', function() {
            // Just close the modal - no action needed
            $("#conformation_modal").modal('hide');
        });

        // Function to show error message
        function showErrorMessage(message) {
            showAlert('Remove Avatar', message, 'error');
        }

        // Bind delete avatar event to show confirmation modal
        // $(document).on('click', '.delete_avatar', function() {
        //     $("#conformation_modal").modal('show');
        // });

        $(document).on('click', '.delete_avatar', function() {
            // $("#conformation_modal").modal('show');
            showAlert('Remove Avatar', "Are you sure you want to delete your avatar?", 'warning', true).then((
                result) => {
                if (result.isConfirmed) {
                    // Perform action to delete avatar
                    $('#confirmDelete').trigger('click');
                }
            });
        });
    </script>
@endpush
