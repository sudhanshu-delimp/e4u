@extends('layouts.admin')
@section('style')
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content end here-->{{-- Page Heading   --}}
        <div class="row">
            <div class="d-flex align-items-center justify-content-between col-md-12">
                <div class="custom-heading-wrapper">
                    <h1 class="h1">Data List (Centres)</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>
                @if (request('from') == 'dashboard')
                    <div class="back-to-dashboard">
                        <a href="{{ route('agent.dashboard') }}">
                            <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                       <h3 class="NotesHeader"><b>Notes:</b></h3>
                        <ol>
                            <li>Data Lists are compiled by the Territory.</li>
                            <li>When a Data List is uploaded, it is not automatically assigned to all Agents in their
                                respective Territories. The Data List via Action must be activated.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        {{-- end --}}
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-end flex-wrap gap-10 my-3">
                <button class="btn-success-modal" type="button" data-target="#upload_data_file"
                    data-toggle="modal">Upload</button>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive-xl">
                    <table class="table mb-3" id="databaseCentreTable">
                        <thead class="table-bg">
                            <tr>
                                <th>Date</th>
                                <th>Territory</th>
                                <th>Centres</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- open success popup -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModallabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img id="image_icon" class="custompopicon" src="#"> <span id="success_task_title"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="text-center" id="success_form_html">
                        <h4 id="success_msg"></h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div id="manage-route" data-csrf-token="{{ csrf_token() }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-import-excel="{{ route('admin.dashboard.agent.import-excel', ['id' => '__ID__']) }}"
        data-data-lists="{{ route('admin.dashboard.agent.data-list') }}"
        data-data-status="{{ route('admin.dashboard.agent.data.list.status', ['id' => '__ID__']) }}"
        data-data-edit="{{route('admin.dashboard.agent.data.list.edit', ['id' => '__ID__'])}}"
        data-data-pdf-print="{{route('admin.dashboard.agent.data.list.print', ['id' => '__ID__'])}}"
        >
        @include('admin.modal.data-summary-modal')
        @include('admin.modal.upload-data-file')
    </div>
@endsection

@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>


    <script>
        const mmRoot = $('#manage-route');
        const endpoint = {
            csrf_token: mmRoot.data('csrf-token'),
            success_image: mmRoot.data('success-image'),
            error_image: mmRoot.data('error-image'),
            import_excel: mmRoot.data('import-excel'),
            data_list: mmRoot.data('data-lists'),
            data_status: mmRoot.data('data-status'),
            data_edit : mmRoot.data('data-edit'),
            data_pdf_print: mmRoot.data('data-pdf-print'),
        };






        $(document).ready(function() {

            var table = $("#databaseCentreTable").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Territory."
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: endpoint.data_list,
                    type: 'GET'
                },
                columns: [{
                        data: 'date',
                        name: 'date',
                        searchable: false
                    },
                    {
                        data: 'territory_name',
                        name: 'territory_name',
                        searchable: true,

                    },
                    {
                        data: 'centres',
                        name: 'centres',
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        searchable: false
                    },
                ],
                order: [],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10
            });


            function updateSelectedFileName(input) {
                var selectedFile = input && input.files && input.files.length ? input.files[0] : null;
                var fileName = selectedFile ? selectedFile.name : 'No file selected';
                $('#fileName').html('<strong class="text-success">' + fileName + '</strong>');
            }

            // File select - filename show
            $('#excelFile').change(function() {
                updateSelectedFileName(this);
            });
            var currentAjax = null;

            function urlFor(tpl, id) {
                return (tpl || '').replace('__ID__', id);
            }

            // Form submit
            $('#importForm').submit(function(e) {
                e.preventDefault();

                // Cancel previous
                if (currentAjax) currentAjax.abort();

                var formData = new FormData(this);
                formData.append('_token', endpoint.csrf_token);
                var $uploadBtn = $('#uploadBtn');
                var $loader = $('#uploadLoader');
                var $fileName = $('#fileName');
                var $messages = $('#messageContainer');

                // File check
                if (!$('#excelFile')[0].files.length) {
                    showMessage('error', 'Please select an excel file!');
                    return;
                }

                // Loader ON
                $uploadBtn.prop('disabled', true).text('Uploading...');
                $loader.removeClass('d-none');
                $fileName.html('<span class="spinner-border spinner-border-sm mr-1"></span>Processing...');
                $messages.empty();

                currentAjax = $.ajax({
                    url: endpoint.import_excel,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                });

                currentAjax.done(function(response) {
                    console.log(response, 'response');
                    // Success - Server message show
                    showMessage('success', response.message);
                    // Reload Data-table
                    table.ajax.reload(null, false);
                    // Reset after 2 sec
                    setTimeout(function() {
                        $('#importForm')[0].reset();
                        $('#fileName').text('No file selected');
                        $('#upload_data_file').modal('hide');
                    }, 3000);
                });

                currentAjax.fail(function(xhr) {
                    console.log(xhr, 'xhr');
                    // Error - Server message show
                    var response = xhr.responseJSON || {};
                    var msg = response.message || 'Upload failed!';
                    showMessage('error', msg);
                });

                currentAjax.always(function() {
                    // Loader OFF
                    $uploadBtn.prop('disabled', false).text('Upload');
                    $loader.addClass('d-none');
                    updateSelectedFileName($('#excelFile')[0]);
                    currentAjax = null;
                });
            });



            // Message function
            function showMessage(type, message) {
                var alertClass = type == 'success' ? 'alert-success' : 'alert-danger';
                var html = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>' +
                    '</div>';

                $('#messageContainer').html(html);
                setTimeout(function() {
                    $('#messageContainer .alert').alert('close');
                }, 3000);
            }

            //Status update function
            $(document).on('click', '.js-suspend, .js-pending, .js-active', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                let status = '';
                let confirmMsg = '';
                if ($(this).hasClass('js-suspend')) {
                    status = 'Suspended';
                    confirmMsg = 'Are you sure you want to suspend this centres?';
                } else if ($(this).hasClass('js-active')) {
                    status = 'Active';
                    confirmMsg = 'Are you sure you want to activate this centres?';
                } else if ($(this).hasClass('js-pending')) {
                    status = 'Pending';
                    confirmMsg = 'Are you sure you want to mark this centre as pending?';
                }

                const modal = $('#successModal');
                const body = $('#success_form_html');
                const title = $('#success_task_title').text('Confirmation');
                const img = $('#image_icon');

                img.attr('src', endpoint.error_image);
                body.html(
                    `
                        <h4 class="custom_modal_text">${confirmMsg}</h4><div class="d-flex justify-content-center gap-10 my-3"><button type="button" class="btn-success-modal shadow-none mr-2" id="confirmRemove">Yes</button><button type="button" class="btn-cancel-modal shadow-none" data-dismiss="modal">Cancel</button></div>`
                );
                modal.modal('show');

                body.off('click', '#confirmRemove').on('click', '#confirmRemove', function() {
                    $(this).prop('disabled', true);
                    $.ajax({
                        url: endpoint.data_status.replace('__ID__', id),
                        type: 'POST',
                        data: {
                            _token: endpoint.csrf_token,
                            status: status
                        },
                        success: function(response) {
                            $('#sucess_task_title').text('Success');
                            $('#image_icon').attr('src', endpoint.success_image);
                            $('#success_form_html').html('<h4>' + (response.message ||
                                    'Status updated successfully') +
                                '</h4><button type="button" class="btn-success-modal my-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                            );
                            table.ajax.reload(null, false);
                            steTimeout(function() {
                                modal.modal('hide');
                            }, 1000);
                        },
                        error: function(xhr) {
                            let mag = 'Something went wrong';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            $('#success_task_title').text('Error');
                            $('#image_icon').attr('src', endpoint.error_image);
                            $('#success_form_html').html('<h4>' + msg +
                                '</h4><button type="button" class="btn-success-modal my-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                            );
                        }
                    });
                });

            });

            $(document).on('click', '.js-summary', function(e){
                e.preventDefault();
                let id = $(this).data('id');
                $('#pdf-download').attr('data-pdf-id', id);
                let territoryName = $(this).data('territory-name');

                    let name = $(this).data('name') ?? '[Territory]';

                    // Title update
                    $('#modal_territory_name').text(territoryName);

                    // Loader ON — table & error OFF
                    $('#modal_loader').show();
                    $('#modal_table_wrapper').hide();
                    $('#modal_error').hide();
                    $('#modal_table_body').empty();

                    // Bootstrap modal open (show() nahi — ye galat hai)
                    $('#view_data_summary').modal('show');

                $.ajax({
                    url: endpoint.data_edit.replace('__ID__', id),
                    type: 'GET',
                    success : function(response) {
                        const d = response.data || {};
                        if(response.status == true){
                            $('#modal_loader').hide();
                            $('#modal_table_wrapper').show();
                            $('#modal_table_body').html(d);
                        }
                    },
                    error: function() {
                         $('#modal_loader').hide();
                         $('#modal_error').show();
                    }

                });
            });



                    // Redirect new page and generate pdf
            $('#pdf-download').on('click', function() {
                var notificationId = $(this).attr('data-pdf-id');
                var encodedId = btoa(String(notificationId));
                var url = urlFor(endpoint.data_pdf_print, encodedId);
                window.open(url, '_blank');

            });


        });
    </script>
@endpush
