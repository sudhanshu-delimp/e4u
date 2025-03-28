
@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">

@endsection
@section('content')
<div class="container-fluid">
    <!--middle content start here-->
    <div class="row">
        <div class="col-sm-9 col-md-9 col-lg-9 ">
            <div class="about_me_drop_down_info box_shadow_fill_profile">
                <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                    <h2>Create Profile</h2>
                </div>
                <div class="padding_20_all_side">
                    <form id="create-profile" action="{{ route('center.create.profile')}}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">Name:</label>
                                    <div class="col-sm-7">
                                        <input type="txt" class="form-control form-control-sm removebox_shdow" placeholder="Name" required name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">Phone No:</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control form-control-sm removebox_shdow" placeholder="Phone No" required name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">State:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="state" name="state_id" data-parsley-errors-container="#state-errors" required disabled>
                                        </select>
                                        <span id="state-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">Pin</label>
                                    <div class="col-sm-7">
                                        <input type="txt" class="form-control form-control-sm removebox_shdow" placeholder="Pin Code" required name="pincode">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">Age:</label>
                                    <div class="col-sm-7">
                                        <input type="text" maxlength="2" class="form-control form-control-sm removebox_shdow" placeholder="Age" required name="age">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">Country:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="country" name="country_id" data-parsley-errors-container="#country-errors" required>
                                        </select>
                                        <span id="country-errors"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5" for="exampleFormControlSelect1">City:</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 form-control-sm select_tag_remove_box_sadow width_hundred_present_imp" id="city" name="city_id" data-parsley-errors-container="#city-errors" required disabled>
                                        </select>
                                        <span id="city-errors"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                            <h2>Social Links</h2>
                        </div>

                        <div class="padding_20_all_side">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-facebook-f"></i></span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Facebook" name="social_links[facebook]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-instagram"></i></span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Instagram" name="social_links[insta]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5" for="exampleFormControlSelect1"><span class="manage_social_profile_icons"><i class="fab fa-twitter"></i></span></label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control form-control-sm removebox_shdow" placeholder="Twitter" name="social_links[twitter]" data-parsley-type="url" data-parsley-type-message="Please provide a valid url">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right"><button type="submit" class="save_profile_btn">Update</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="about_me_drop_down_info box_shadow_fill_profile">
                <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                    <h2>Choose Photos/videos</h2>
                </div>
                <div class="padding_20_all_side">
                    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                        <noscript>
                            <input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"/>
                        </noscript>
                        <div class="row fileupload-buttonbar">
                            <div class="col-lg-7">
                                <span class="btn btn-success fileinput-button remove_padding" id="file">
                                <i class="glyphicon glyphicon-plus"></i>
                                <input type="file" name="files[]" class="input_style" multiple />
                                </span>
                                <button type="submit" class="btn btn-primary start remove_padding">
                                <i class="glyphicon glyphicon-upload"></i>
                                <span>Start upload</span>
                                </button>
                                <button type="reset" class="btn btn-warning cancel remove_padding">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Cancel upload</span>
                                </button>
                                <button type="button" class="btn btn-danger delete remove_padding">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete selected</span>
                                </button>
                                <input type="checkbox" class="toggle" />
                                <!-- The global file processing state -->
                                <span class="fileupload-process"></span>
                            </div>
                            <!-- The global progress state -->
                            <div class="col-lg-5 fileupload-progress fade">
                                <!-- The global progress bar -->
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                    <div
                                        class="progress-bar progress-bar-success" style="width: 0%;"></div>
                                </div>
                                <!-- The extended global progress state -->
                                <div class="progress-extended">&nbsp;</div>
                            </div>
                        </div>
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped">
                            <tbody class="files"></tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--middle content end here-->
</div>

@endsection
@section('script')
<!-- file upload plugin start here -->
<script id="template-upload" type="text/x-tmpl">
     {% for (var i=0, file; file=o.files[i]; i++) { %}
         <tr class="template-upload fade{%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
             <td>
                 <span class="preview"></span>
             </td>
             <td>
                 <p class="name">{%=file.name%}</p>
                 <strong class="error text-danger"></strong>
             </td>
             <td>
                 <p class="size">Processing...</p>
                 <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
             </td>
             <td>
                 {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                   <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                       <i class="glyphicon glyphicon-edit"></i>
                       <span>Edit</span>
                   </button>
                 {% } %}
                 {% if (!i && !o.options.autoUpload) { %}
                     <button class="btn btn-primary btn-primary remove_padding start" disabled>
                         <i class="glyphicon glyphicon-upload"></i>
                         <span>Start</span>
                     </button>
                 {% } %}
                 {% if (!i) { %}
                     <button class="btn btn-warning btn-primary remove_padding cancel">
                         <i class="glyphicon glyphicon-ban-circle"></i>
                         <span>Cancel</span>
                     </button>
                 {% } %}
             </td>
         </tr>
     {% } %}
  </script>
  <!-- The template to display files available for download -->
  <script id="template-download" type="text/x-tmpl">
     {% for (var i=0, file; file=o.files[i]; i++) { %}
         <tr class="template-download fade{%=file.thumbnailUrl?' image':''%}">
             <td>
                 <span class="preview">
                     {% if (file.thumbnailUrl) { %}
                         <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                     {% } %}
                 </span>
             </td>
             <td>
                 <p class="name">
                     {% if (file.url) { %}
                         <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                     {% } else { %}
                         <span>{%=file.name%}</span>
                     {% } %}
                 </p>
                 {% if (file.error) { %}
                     <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                 {% } %}
             </td>
             <td>
                 <span class="size">{%=o.formatFileSize(file.size)%}</span>
             </td>
             <td>
                 {% if (file.deleteUrl) { %}
                     <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                         <i class="glyphicon glyphicon-trash"></i>
                         <span>Delete</span>
                     </button>
                     <input type="checkbox" name="delete" value="1" class="toggle">
                 {% } else { %}
                     <button class="btn btn-warning remove_padding cancel">
                         <i class="glyphicon glyphicon-ban-circle"></i>
                         <span>Cancel</span>
                     </button>
                 {% } %}
             </td>
         </tr>
     {% } %}
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="{{ asset('assets/app/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-process.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-image.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-audio.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-video.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/jquery.fileupload-ui.js') }}"></script>
<script src="{{ asset('assets/app/vendor/file-upload/js/demo.js') }}"></script>

    <!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="module">

    // import Pintura Image Editor functionality:
    import {
        openDefaultEditor
    } from '../assets/app/vendor/file-upload/js/vendor/pintura.min.js';
    $(function() {
        $('#fileupload').fileupload('option', {
            // When editing a file use Pintura Image Editor:
            edit: function(file) {
                return new Promise((resolve, reject) => {
                    const editor = openDefaultEditor({
                        src: file,
                        imageCropAspectRatio: 1,
                    });
                    editor.on('process', ({
                        dest
                    }) => {
                        resolve(dest);
                    });
                    editor.on('close', () => {
                        resolve(file);
                    });
                });
            }
        });
    });

</script>

<script type="text/javascript">

    $('#create-profile').parsley({

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
                console.log(params);
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


    $('#country').select2({
        allowClear: true,
        placeholder :'Select Country',
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
            url: "{{ route('country.list') }}",
            dataType: "json",
            type: "GET",
            data: function(params) {
                console.log(params);
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

    $('#create-profile').on('submit', function(e) {
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
                            text: 'Record successfully update',
                            icon: 'success',
                            loader: true,
                            position: 'top-right', // Change it to false to disable loader
                            loaderBg: '#9EC600' // To change the background
                        });
                        //window.location.href = data.url;
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
                }
            });
        }
    });

    $('#country').on('change', function(e) {
        if($(this).val()) {
            $('#state').prop('disabled', false);
        } else {
            $('#state').prop('disabled', true);
        }
    });

    $('#state').on('change', function(e) {
        if($(this).val()) {
            $('#city').prop('disabled', false);
        } else {
            $('#city').prop('disabled', true);
        }
    });

</script>

@endsection
