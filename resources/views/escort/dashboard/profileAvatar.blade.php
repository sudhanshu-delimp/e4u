@extends('layouts.escort')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/croppie.css">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        label.cabinet {
            display: block;
            cursor: pointer;
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
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content start here-->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper">
                <h1 class="h1">Upload your avatar</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
            </div>
            <div class="col-md-12 mb-4" id="profile_and_tour_options">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h2 class="primery_color normal_heading"><b>Notes:</b></h2>
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
                <div class="card border-0">
                    <div class="card-body">
                        <h2 class="primery_color normal_heading">File types</h2>
                        <p>When selecting your avatar, please be mindful of the following:</p>
                        <ul>
                            <li>Yes you can use a photo, but we do not recommend it.</li>
                            <li>Acceptable formats include; .jpg, .gif or .png.</li>
                            <li>.pdf, .psd, .tff, and .doc files are not compatible.</li>
                        </ul>
                        <div class="row">
                            <div class="col-lg-4 mt-4">
                                <h2 class="primery_color normal_heading">Upload your avatar</h2>
                                <form id="my_avatar" action="{{ route('escort.save.avatar', auth()->user()->id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    <div class="file-upload">
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input gambar item-img" name="avatar_img"
                                                type='file' onchange="readURL(this);" accept="image/*" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image item-img" src="#" alt="your image"
                                                id="item-img-output" />
                                            <div class="image-title-wrap">

                                                <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                    <span class="image-title">Uploaded Image</span></button>
                                                <button type="submit" class="crop_image btn-success-modal">Save <span
                                                        class="image-title">Uploaded Image</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4 mt-4 current-avatar">

                                <h2 class="primery_color normal_heading">Current Avatar</h2>

                                @if (auth()->user()->hasUploadedAvatar())
                                    <button type="button" class="avatar close delete_avatar" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                @endif
                                <img src="{{ asset(auth()->user()->avatar_url) }}" alt=""
                                    class="img-rounded avatarName">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div id="accordion" class="myacording-design mb-5">
                    <div class="card custom-help-contain">
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
                                <p>We recommend using image files of less than 500 KB for best results, though the limit for
                                    an individual image upload is 2 MB.</p>
                                <p style="font-size: 20px;"><b>Resolution</b> </p>
                                <p>There is an image resolution limit of 60 MP (megapixels).</p>
                                <p style="font-size: 20px;"><b>Colour mode</b> </p>
                                <p>Save images in RGB color mode. Print mode (CMYK) won't render in most browsers.
                                </p>
                                <p style="font-size: 20px;"><b>Colour profile</b> </p>
                                <p>Save images in the sRGB color profile. If images don't look right on mobile devices, it's
                                    probably because they don't have an sRGB color profile.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- crop img --}}
    <x-common.modal id="cropImagePop" title="Crop Photo" size=""
        icon='<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M19 8V2M16 5H22M22 12V17.2C22 18.8802 22 19.7202 21.673 20.362C21.3854 20.9265 20.9265 21.3854 20.362 21.673C19.7202 22 18.8802 22 17.2 22H6.8C5.11984 22 4.27976 22 3.63803 21.673C3.07354 21.3854 2.6146 20.9265 2.32698 20.362C2 19.7202 2 18.8802 2 17.2V6.8C2 5.11984 2 4.27976 2.32698 3.63803C2.6146 3.07354 3.07354 2.6146 3.63803 2.32698C4.27976 2 5.11984 2 6.8 2H12M2.14574 19.9263C2.61488 18.2386 4.1628 17 6 17H13C13.9293 17 14.394 17 14.7804 17.0769C16.3671 17.3925 17.6075 18.6329 17.9231 20.2196C18 20.606 18 21.0707 18 22M14 9.5C14 11.7091 12.2091 13.5 10 13.5C7.79086 13.5 6 11.7091 6 9.5C6 7.29086 7.79086 5.5 10 5.5C12.2091 5.5 14 7.29086 14 9.5Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>'>
        <div class="common-modal-confirm-content">
            <div class="common-modal-crop-wrapper">
                <div id="upload-demo" class="common-modal-crop-area center-block"></div>
            </div>
            <div class="common-modal-hint">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M12 16.75C11.8019 16.7474 11.6126 16.6676 11.4725 16.5275C11.3324 16.3874 11.2526 16.1981 11.25 16V11C11.25 10.8011 11.329 10.6103 11.4697 10.4697C11.6103 10.329 11.8011 10.25 12 10.25C12.1989 10.25 12.3897 10.329 12.5303 10.4697C12.671 10.6103 12.75 10.8011 12.75 11V16C12.7474 16.1981 12.6676 16.3874 12.5275 16.5275C12.3874 16.6676 12.1981 16.7474 12 16.75Z"
                            fill="#ff3c5f"></path>
                        <path
                            d="M12 9.25C11.8019 9.24741 11.6126 9.16756 11.4725 9.02747C11.3324 8.88737 11.2526 8.69811 11.25 8.5V8C11.25 7.80109 11.329 7.61032 11.4697 7.46967C11.6103 7.32902 11.8011 7.25 12 7.25C12.1989 7.25 12.3897 7.32902 12.5303 7.46967C12.671 7.61032 12.75 7.80109 12.75 8V8.5C12.7474 8.69811 12.6676 8.88737 12.5275 9.02747C12.3874 9.16756 12.1981 9.24741 12 9.25Z"
                            fill="#ff3c5f"></path>
                        <path
                            d="M12 21C10.22 21 8.47991 20.4722 6.99987 19.4832C5.51983 18.4943 4.36628 17.0887 3.68509 15.4442C3.0039 13.7996 2.82567 11.99 3.17294 10.2442C3.5202 8.49836 4.37737 6.89472 5.63604 5.63604C6.89472 4.37737 8.49836 3.5202 10.2442 3.17294C11.99 2.82567 13.7996 3.0039 15.4442 3.68509C17.0887 4.36628 18.4943 5.51983 19.4832 6.99987C20.4722 8.47991 21 10.22 21 12C21 14.387 20.0518 16.6761 18.364 18.364C16.6761 20.0518 14.387 21 12 21ZM12 4.5C10.5166 4.5 9.0666 4.93987 7.83323 5.76398C6.59986 6.58809 5.63856 7.75943 5.07091 9.12988C4.50325 10.5003 4.35473 12.0083 4.64411 13.4632C4.9335 14.918 5.64781 16.2544 6.6967 17.3033C7.7456 18.3522 9.08197 19.0665 10.5368 19.3559C11.9917 19.6453 13.4997 19.4968 14.8701 18.9291C16.2406 18.3614 17.4119 17.4001 18.236 16.1668C19.0601 14.9334 19.5 13.4834 19.5 12C19.5 10.0109 18.7098 8.10323 17.3033 6.6967C15.8968 5.29018 13.9891 4.5 12 4.5Z"
                            fill="#ff3c5f"></path>
                    </g>
                </svg> <span> Drag, zoom or reposition the image
                    to get the perfect crop. </span>
            </div>

        </div>

        <x-slot name="footer">

            <button type="button" class="common-modal-btn common-modal-btn-secondary" data-dismiss="modal">
                Cancel
            </button>

            <button type="button" class="common-modal-btn common-modal-btn-primary" id="cropImageBtn"
                data-dismiss="modal">

               Crop & Continue
            </button>

        </x-slot>


    </x-common.modal>

    {{-- remove --}}
    <x-common.modal id="conformation_modal" title="Remove Avatar"
        icon='<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.5 2.5L21.5 7.5M21.5 2.5L16.5 7.5M22 12V17.2C22 18.8802 22 19.7202 21.673 20.362C21.3854 20.9265 20.9265 21.3854 20.362 21.673C19.7202 22 18.8802 22 17.2 22H6.8C5.11984 22 4.27976 22 3.63803 21.673C3.07354 21.3854 2.6146 20.9265 2.32698 20.362C2 19.7202 2 18.8802 2 17.2V6.8C2 5.11984 2 4.27976 2.32698 3.63803C2.6146 3.07354 3.07354 2.6146 3.63803 2.32698C4.27976 2 5.11984 2 6.8 2H12M2.14551 19.9263C2.61465 18.2386 4.16256 17 5.99977 17H12.9998C13.9291 17 14.3937 17 14.7801 17.0769C16.3669 17.3925 17.6073 18.6329 17.9229 20.2196C17.9998 20.606 17.9998 21.0707 17.9998 22M14 9.5C14 11.7091 12.2091 13.5 10 13.5C7.79086 13.5 6 11.7091 6 9.5C6 7.29086 7.79086 5.5 10 5.5C12.2091 5.5 14 7.29086 14 9.5Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>'>
        <div class="common-modal-confirm-content">
            <h4>
                Are you sure you want to delete your avatar?
            </h4>

            <p>
                This action cannot be undone.
            </p>

        </div>

        <x-slot name="footer">

            <button type="button" class="common-modal-btn common-modal-btn-secondary" id="cancelDelete"
                data-dismiss="modal">
                Cancel
            </button>

            <button type="button" class="common-modal-btn common-modal-btn-primary" id="confirmDelete"
                data-dismiss="modal">

                Yes, Remove
            </button>

        </x-slot>

    </x-common.modal>

    {{-- success modal --}}
    <x-common.modal id="upload_avatar" title="Avatar Uploaded" 
        icon='<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16 5L19 2M19 2L22 5M19 2V8M22 12V17.2C22 18.8802 22 19.7202 21.673 20.362C21.3854 20.9265 20.9265 21.3854 20.362 21.673C19.7202 22 18.8802 22 17.2 22H6.8C5.11984 22 4.27976 22 3.63803 21.673C3.07354 21.3854 2.6146 20.9265 2.32698 20.362C2 19.7202 2 18.8802 2 17.2V6.8C2 5.11984 2 4.27976 2.32698 3.63803C2.6146 3.07354 3.07354 2.6146 3.63803 2.32698C4.27976 2 5.11984 2 6.8 2H12M2.14551 19.9263C2.61465 18.2386 4.16256 17 5.99977 17H12.9998C13.9291 17 14.3937 17 14.7801 17.0769C16.3669 17.3925 17.6073 18.6329 17.9229 20.2196C17.9998 20.606 17.9998 21.0707 17.9998 22M14 9.5C14 11.7091 12.2091 13.5 10 13.5C7.79086 13.5 6 11.7091 6 9.5C6 7.29086 7.79086 5.5 10 5.5C12.2091 5.5 14 7.29086 14 9.5Z" stroke="#ff3c5f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>'>
        <div class="common-modal-confirm-content">
            <h4>
                Avatar uploaded successfully!
            </h4>
            <p>
                This action cannot be undone.
            </p>
        </div>

        <x-slot name="footer">

            <button type="button" class="common-modal-btn common-modal-btn-primary" id="confirmDelete"
                data-dismiss="modal">

                Ok
            </button>

        </x-slot>

    </x-common.modal>

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
                width: 150,
                height: 200,
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
                type: 'base64',
                format: 'jpeg',
                size: {
                    width: 150,
                    height: 200
                }
            }).then(function(resp) {
                $('.file-upload-content').show();
                $('#item-img-output').attr('src', resp);
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
                $('.comman_msg').text('Image must be 10MB or less.');
                $("#upload_avatar").modal('show');
                try {
                    removeUpload();
                } catch (e) {}
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
                        var msg = "Avatar uploaded successfully!";
                        var url = "{{ asset('avatars/name') }}";
                        url = url.replace('name', data.avatarName);
                        $('.comman_msg').text(msg);
                        //$("#my_account_modal").show();
                        $("#upload_avatar").modal('show');
                        $(".avatarName").attr('src', url);
                        $(".file-upload-content").hide();

                        // Show the delete button since avatar is now uploaded
                        if ($(".delete_avatar").length === 0) {
                            $(".current-avatar h2").after(
                                `<button type="button" class="avatar close delete_avatar" aria-label="Close"><span aria-hidden="true">×</span></button>`
                            );
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
                }
            });
        });


        function errorModuleShow(data = null) {
            var msg = "Something went wrong. Please try again.";
            try {
                var resp = data && data.responseJSON ? data.responseJSON : data;
                if (resp) {
                    if (resp.message) {
                        msg = resp.message;
                    } else if (resp.errors) {
                        // Prefer src (base64 image) or avatar_img errors
                        var err = resp.errors.src || resp.errors.avatar_img || resp.errors.file || null;
                        if (Array.isArray(err) && err.length) {
                            msg = err[0];
                        } else if (typeof err === 'string') {
                            msg = err;
                        }
                    }
                }
            } catch (e) {}

            $('.comman_msg').text(msg);
            $("#upload_avatar").modal('show');
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
                    url: "{{ route('escort.avatar.remove') }}",
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
                console.error('Error in confirmDelete click handler:', error);
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
            $("#upload_avatar").modal('show');
            $(".delete_avatar").hide();
        }


        // Bind delete avatar event to show confirmation modal
        $(document).on('click', '.delete_avatar', function() {
            $("#conformation_modal").modal('show');
        });
    </script>
@endpush
