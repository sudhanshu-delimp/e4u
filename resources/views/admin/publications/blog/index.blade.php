@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
        }

        #cke_1_contents {
            height: 250px !important;
        }

        .custom_w_blog {
            max-width: 1000px !important;
        }
    </style>
@stop
@section('content')
    @php
        $securityLevel = isset(auth()->user()->staff_detail->security_level)
            ? auth()->user()->staff_detail->security_level
            : 0;
        $editAccess = staffPageAccessPermission($securityLevel, 'edit');
        $editAccessEnabled = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
        $addAccess = staffPageAccessPermission($securityLevel, 'add');
        $addAccessEnabled = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
    @endphp
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                    <div class="row">
                        <div class="custom-heading-wrapper col-md-12">
                            <h1 class="h1">Blog</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol class="pl-4">
                                        <li>You can create a Notification, published at the top of the Website.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="bothsearch-form mb-3">
                                @if ($addAccessEnabled)
                                    <button type="button" class="create-tour-sec dctour" data-toggle="modal"
                                        data-target="#createBlog">
                                        Add Blog</button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table" id="BlogListTable">
                                                    <thead class="table-bg">
                                                        <tr>
                                                            <th scope="col">#
                                                            </th>
                                                            <th scope="col">Images</th>
                                                            <th scope="col">Title</th>
                                                            {{-- <th scope="col">
                                                                Short Description
                                                            </th> --}}
                                                            <th scope="col">Posted Date</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--right side bar end-->
            </div>
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    {{-- add blog popup modal --}}
    <div class="modal fade upload-modal" id="createBlog" tabindex="-1" role="dialog" aria-labelledby="createBlog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom_w_blog" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBlogTitle"> <img
                            src="{{ asset('assets/dashboard/img/title-blog.png') }}" class="custompopicon"> Create Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form id="addBlogForm" method="POST" accept="" enctype="multipart/form-data">
                        <input type="hidden" name="edit_blog_id" id="edit_blog_id">
                        @csrf
                        <div class="row" style="max-height: 600px; overflow-y: auto;">
                            <!-- Blog Title -->
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control rounded-0 fw-bold" name="title" id="title"
                                    placeholder="Blog Title" />
                            </div>

                            <!-- Upload Image Section (Top of Form) -->
                            <div class="col-12 mb-4">
                                <label for="blog_image" id="fileLabel" class="w-100">
                                    <div id="drop-area" class="upload-box text-center p-4 w-100">
                                        <div id="imageshowHide">
                                            <input type="file" id="blog_image" name="blog_image" accept="image/*"
                                                onchange="handleFiles(this.files)" hidden>
                                            <img src="{{ asset('assets/dashboard/img/cloud-image.png') }}" width="50" />
                                            <p class="mb-1 font-weight-bold">Drop your image here, or <span
                                                    style="color: var(--peach)">browse</span></p>
                                            <small class="text-muted">Supports: JPG, JPEG, PNG</small>
                                        </div>
                                        <div id="preview" class="mt-3"></div>
                                    </div>
                                </label>
                            </div>


                            <!-- Blog Content with CKEditor -->
                            <div class="col-12 mb-3">
                                <textarea class="form-control rounded-0" id="description" name="description" rows="5"
                                    placeholder="Blog Content"></textarea>
                            </div>

                            <!-- SEO Meta Title -->
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control rounded-0" name="meta_title" id="meta_title"
                                    placeholder="SEO Meta Title (optional)" />
                            </div>

                            <!-- SEO Meta Description -->
                            <div class="col-12 mb-3">
                                <textarea class="form-control rounded-0" name="meta_description" id="meta_description" rows="2"
                                    placeholder="Meta Description (optional)"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer pr-3">
                            <button type="submit" class="btn-success-modal" id="submitBtn"
                                form="addBlogForm">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- End-->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- open success popup -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog"
        aria-labelledby="successModallabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img id="image_icon" class="custompopicon" src="{{ asset('assets/dashboard/img/unblock.png') }}">
                        <span id="success_task_title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        {{-- <span aria-hidden="true"><img src="{{ asset('assets/app/img/alert.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span> --}}
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="py-4 text-center" id="success_form_html">
                        <h4 id="success_msg"></h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-publications-blog-alert="{{ asset('assets/app/img/alert.png') }}"
        data-publications-blog-icon="{{ asset('assets/dashboard/img/title-blog.png') }}"
        data-publications-blog-status="{{ route('admin.publications.blog.status', ['id' => '__ID__']) }}"
        data-publications-blog-edit="{{ route('admin.publications.blog.edit', ['id' => '__ID__']) }}"
        data-publications-blog-update="{{ route('admin.publications.blog.update', ['id' => '__ID__']) }}"
        data-publications-blog-store="{{ route('admin.publications.blog.store') }}"
        data-publications-blog-show="{{ route('admin.publications.blog.show', ['id' => '__ID__']) }}"
        data-publications-blog-index="{{ route('admin.publications.blog.index') }}">

    </div>


@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>
    <script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>


    <script>
        const mmRoot = $('#manage-route');
        //setup text editor
        CKEDITOR.replace('description');

        endpoint = {
            csrf_token: mmRoot.data('scrf-token'),
            success_image: mmRoot.data('success-image'),
            alert_image: mmRoot.data('publications-blog-alert'),
            blog_icon: mmRoot.data('publications-blog-icon'),
            publications_blog_status: mmRoot.data('publications-blog-status'),
            publications_blog_edit: mmRoot.data('publications-blog-edit'),
            publications_blog_store: mmRoot.data('publications-blog-store'),
            publications_blog_show: mmRoot.data('publications-blog-show'),
            publications_blog_index: mmRoot.data('publications-blog-index'),
        }

        function urlFrom(tpl, id) {
            return (tpl || '').replace('__ID__', id);
        }

        //Remove Validation Message
        function removeValidationMsg() {
            $('.server-error').remove();
            $('.is-invalid').removeClass('is-invalid');
        }

        //DataTable initialization
        var table = $("#BlogListTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref or Title"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: endpoint.publications_blog_index,
                type: 'GET'
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'image',
                    name: 'image',

                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'posted_date',
                    name: 'posted_date'

                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            order: [],
            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            pageLength: 10
        });


        $('#addBlogForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            syncCkEditor();
            formSubmit(form);
        });

        //Edit Blog form
        $(document).on('click', '.js-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            removeValidationMsg();
            //call ajax
            $.ajax({
                url: endpoint.publications_blog_edit.replace('__ID__', id),
                method: 'GET',
                success: function(response) {
                    if (response.status === true) {
                        let n = response.data;
                        console.log(n);
                        $('#edit_blog_id').val(n.id);
                        $("#title").val(n.title);
                        if (n.blog_image) {
                            $('#preview').html(
                                `<img src="${n.blog_image}" style="max-width: 200px;"  alt="Preview Image">`
                            );
                        }
                        CKEDITOR.instances.description.setData(n.description);
                        $('#meta_title').val(n.meta_title);
                        $('#meta_description').val(n.meta_description);

                        // Change modal title
                        $('#createBlogTitle').html(
                            `<img src="${endpoint.blog_icon}" alt="alert" class="custompopicon"> Edit Blog`
                        );
                        // Change button text to Update
                        $('#submitBtn').text('Update');
                        $('#createBlog').modal('show');
                    } else {
                        alert('data not found...');
                    }


                }
            })

        });


        function formSubmit(form) {
            let formData = new FormData(form[0]);

            $.ajax({
                url: endpoint.publications_blog_store,
                method: "POST",
                _token: endpoint.csrf_token,
                data: formData,
                processData: false, // important
                contentType: false, // important
                success: function(response) {
                    $('#createBlog').modal('hide');
                    //Clear CkEditor first

                    let msg = response.message ? response.message : "Save Successfully";
                    $('#success_task_title').text('Success');
                    $('#success_form_html').html('<h4>' + (msg || 'Status updated successfully') +
                        '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                    );
                    $('#successModal').modal('show');
                    setTimeout(function() {
                        $('#successModal').modal('hide');
                        table.ajax.reload(null, false);
                    }, 1200);

                },
                error: function(xhr) {
                    if (xhr.status == 422 && xhr.responseJSON.status == false) {
                        let errors = xhr.responseJSON.errors;
                        $('.server-error').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        if (errors) {
                            $.each(errors, function(field, message) {
                                let input = $('[name="' + field + '"]');
                                input.addClass('is-invalid');
                                input.after(
                                    '<small class="text-danger server-error">' + message +
                                    '</small>'
                                );
                            });
                            return;
                        }

                    }

                    let msg = 'Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    $("#image_icon").attr("src", endpoint.error_image);
                    $('#success_task_title').text('Error');
                    $('#success_form_html').html('<h4>' + (msg ||
                            'Something went wrong.') +
                        '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                    );
                    $('#successModal').modal('show');

                }
            })

        }

        $('#createBlog').on('hidden.bs.modal', function() {
            // Define form properly
            const form = $(this).find('#addBlogForm');
            form[0].reset();

            // Clear CKEditor (update ID)
            if (typeof CKEDITOR !== 'undefined') {
                CKEDITOR.instances['description'].setData('');
            }

            //clear image preview
            $('#preview > img').remove();
            $('#blog_image').val('');


            // Clear YOUR image elements
            $('#edit_blog_id').val('');
            $('#blog_image').val('');
            $('#createBlogTitle').html(
                `<img src="${endpoint.blog_icon}" alt="alert" class="custompopicon"> Create Blog`
            );
            $('#submitBtn').text('Save');
            //$('img.thumb').attr('src', '').hide();
        });




        CKEDITOR.editorConfig = function(config) {

            config.allowedContent = true; // Allow all HTML content
            config.pasteFilter = null; // Disable paste filtering
            config.forcePasteAsPlainText = false;

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

        //update CKediter content before Ajax sub

        function syncCkEditor() {
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
        }

        //Uodate Blog Status
        $(document).on('click', '.js-withdrawn, .js-publish, .js-remove, .js-suspend', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            let status = '';
            let confirmMsg = '';

            if ($(this).hasClass('js-suspend')) {
                status = "Suspended";
                confirmMsg = 'Are you sure you want suspend this blog ?';
            } else if ($(this).hasClass('js-publish')) {
                status = 'Published';
                confirmMsg = 'Are you sure you want to publish this blog  ?';
            } else if ($(this).hasClass('js-remove')) {
                status = 'Removed';
                confirmMsg = 'Are you sure you want to remove the blog ?';
            }

            const modal = $('#successModal');
            const body = $('#success_form_html');
            const title = $('#success_task_title').text('Confirmation');
            const img = $('#image_icon');
            img.attr('src', endpoint.alert_image);

            body.html(
                `<h4>${confirmMsg}</h4>
                <div class="d-flex justify-content-center gap-10 mt-3">
                    <button type="button" class="btn-success-modal shadow-none mr-2" id="confirmRemove">Yes</button>
                    <button type="button" class="btn-cancel-modal shadow-none" data-dismiss="modal">Cancel</button>
                </div>`
            );
            modal.modal('show');
            body.off('click', '#confirmRemove').on('click', '#confirmRemove', function() {
                $(this).prop('disabled', true);

                $.ajax({
                    url: endpoint.publications_blog_status.replace('__ID__', id),
                    type: 'POST',
                    data: {
                        _token: endpoint.csrf_token,
                        status: status
                    },
                    success: function(response) {
                        console.log(response, 'success');
                        $('#success_task_title').text('Success');
                        $('#image_icon').attr('src', endpoint.success_image);
                        $('#success_form_html').html(`
                        <h4> ${(response.message || 'Status updated successfully')} </h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>
                        `);
                        setTimeout(function() {
                            modal.modal('hide');
                            table.ajax.reload(null, false);
                        }, 1000);
                    },
                    error: function(xhr) {
                        console.log(xhr, 'error');
                        let msg = 'Something went wrong';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        $('#success_task_title').text('Error');
                        $('#image_icon').attr('src', endpoint.alert_image);
                        $('#success_form_html').html('<h4>' + (msg ||
                                'Something went wrong.') +
                            '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                        );
                    }
                })
            })


        });
    </script>

    <script>
        const dropArea = document.getElementById('drop-area');

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        function handleFiles(files) {
            const preview = document.getElementById('preview');
            const fileInput = document.getElementById('blog_image'); // Get input
            preview.innerHTML = ''; // Clear previous

            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    // Create DataTransfer to set files (bypasses security)
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput.files = dt.files; // Now input has the file!
                    console.log(fileInput.files); // For verification

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '200px'; // Optional style
                        preview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.innerHTML = '<small class="text-danger">Invalid file type</small>';
                }
            }
        }
    </script>
@endpush
