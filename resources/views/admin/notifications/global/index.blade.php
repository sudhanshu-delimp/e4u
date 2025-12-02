@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">

    <style>
        .swal-button {
            background-color: #242a2c;
        }

        #cke_1_contents {
            height: 150px !important;
        }

        li.parsley-required {
            list-style: none;
        }

        .parsley-errors-list {
            padding-left: 0px;
        }
    </style>
@stop
@section('content')
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">

            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Global Notifications</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>You can create a Notification, published at the top of the Website.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="bothsearch-form mb-3">
                            <button type="button" class="create-tour-sec dctour" data-toggle="modal"
                                data-target="#createNotification">New Notification</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel with-nav-tabs panel-warning">
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active show" id="tab1warning">
                                        <div class="table-responsive-xl">
                                            <table class="table" id="centerNotificationTable">
                                                <thead class="table-bg">
                                                    <tr>
                                                        <th scope="col">Ref</th>
                                                        <th scope="col">Start</th>
                                                        <th scope="col">End</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-content"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    <div class="modal fade upload-modal" id="createNotification" tabindex="-1" role="dialog"
        aria-labelledby="createNotification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNotification"> <img
                            src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Create
                        Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form method="POST" id="createNotificationForm" action="{{ route('admin.global.notification.store') }}"
                        data-parsley-validate>
                        @csrf
                        <div class="row">
                            <!-- Auto-generated Date (readonly) -->
                            <div class="col-12 mb-3">
                                <label class="label">Current Date</label>
                                <input type="text" class="form-control rounded-0" name="current_day" id="current_day"
                                    value="<?php echo date('d-m-Y'); ?>" data-parsley-required="true" />
                            </div>

                            <!-- Heading Field -->
                            <div class="col-12 mb-3">
                                <label class="label">Heading</label>
                                <input type="text" name="heading" id="heading" class="form-control rounded-0  fw-bold"
                                    placeholder="Heading" required />
                                <input type="hidden" name="edit_notification_id" id="edit_notification_id">
                            </div>

                            <!-- Start Date -->
                            <div class="col-12 mb-3">
                                <label class="label">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control js_datepicker" placeholder="Start Date"
                                    class="form-control rounded-0" min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}"
                                    required />

                            </div>

                            

                            <!-- Finish Date -->
                            <div class="col-12 mb-3">
                                <label class="label">End Date</label>
                                <input type="date" name="end_date" id="end_date" placeholder="End Date"
                                    class="form-control rounded-0" min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}"
                                    required />

                            </div>
                            <!-- Type Field (fixed Adhoc Content) -->
                            <div class="col-12 mb-3">
                                <label class="label">Select Type</label>
                                <select id="type" onchange="toggleFields()" name="type"
                                    class="form-control rounded-0" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="Ad hoc">Ad hoc</option>
                                    <option value="Template">Template</option>
                                </select>
                            </div>


                            <div id="templateSelect" style="display: none;" class="col-12 mb-3">
                                <label class="label">Select Template</label>
                                <select id="template_name" name="template_name" class="form-control rounded-0">
                                    <option value="">-- Choose a Template --</option>
                                    <option
                                        value="We will be undertaking website maintenance on Monday evening from 11:00pm until 4:00am WST. The website will remain live and unaffected.">
                                        We will be undertaking website maintenance on Monday evening from 11:00pm until 4:00am WST. The website will remain live and unaffected.</option>

                                    <option
                                        value="Have you checked out our new service - My Playbox!! Complement your income and start using this free service.">
                                        Have you checked out our new service - My Playbox!! Complement your income and start using this free service..</option>

                                    <option
                                        value="Do you tour? Our Tour creator makes the whole process a quick and easy experience. Check it out!">
                                        Do you tour? Our Tour creator makes the whole process a quick and easy experience. Check it out!
                                    </option>

                                    <option
                                        value="Would you like to have the best Profile on here but English is not your first language? Request a Support Agent and let them do all the work for you.">
                                        Would you like to have the best Profile on here but English is not your first language? Request a Support Agent and let them do all the work for you..</option>

                                    <option
                                        value="Did you know that if you create ‘Credit’ in your account, discounts apply.">
                                        Did you know that if you create ‘Credit’ in your account, discounts apply.</option>

                                    <option
                                        value="Looking for something different to do? Why not become a Support Agent. Enquire with us.">
                                        Looking for something different to do? Why not become a Support Agent. Enquire with us.
                                    </option>
                                </select>
                            </div>


                            <!-- content -->
                            <div class="col-12 mb-3" id="contentField">
                                <label class="label">Content</label>
                                <textarea id="edit_content" name="content" class="form-control" placeholder="up to 250 characters..."></textarea>

                            </div>
                        </div>
                        <div class="modal-footer pr-3">
                            <button type="button" class="btn-cancel-modal" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="submitBtn" class="btn-success-modal">Save</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade upload-modal " id="view-listing" tabindex="-1" role="dialog"
        aria-labelledby="view-listingLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="view-listings"><img
                            src="{{ asset('assets/dashboard/img/create-notification.png') }}" alt="alert"
                            style="width:29px;">
                        View Notification
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div id="listingModalContent">
                                <table
                                    style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-4 mb-2">
                    <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                    <button type="submit" id="pdf-download" data-notification-id="">Print</button>
                </div>
            </div>
        </div>
    </div>
    <!-- open success popup -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog"
        aria-labelledby="successModallabel" aria-hidden="true" data-backdrop="static">
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
                    <div class="py-4 text-center" id="success_form_html">
                        <h4 id="success_msg"></h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-pdf-download="{{ route('admin.global.pdf.download', ['id' => '__ID__']) }}"
        data-global-notification-status="{{ route('admin.global.notifications.status', ['id' => '__ID__']) }}"
        data-global-notification-edit="{{ route('admin.global.notifications.edit', ['id' => '__ID__']) }}"
        data-global-notification-update="{{ route('admin.global.notifications.update', ['id' => '__ID__']) }}"
        data-global-notification-store="{{ route('admin.global.notification.store') }}"
        data-global-notification-index="{{ route('admin.global.notification.index') }}"
        data-global-notification-show="{{ route('admin.global.notifications.show', ['id' => '__ID__']) }}">


    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        function toggleFields() {
            var type = document.getElementById('type').value;

            var templateSelect = document.getElementById('templateSelect');
           // var noticeSection = document.getElementById('noticeSection');
            var contentField = document.getElementById('contentField');

            if (type === 'Template') {
                templateSelect.style.display = 'block';
                //noticeSection.style.display = 'none';
                contentField.style.display = 'none';
            } else if (type === 'Ad hoc') {
                templateSelect.style.display = 'none';
                //noticeSection.style.display = 'none';
                contentField.style.display = 'block';
            } else {
                templateSelect.style.display = 'none';
                //noticeSection.style.display = 'none';
                contentField.style.display = 'none';
            }
        }
    </script>
    <script>
        const mmRoot = $('#manage-route');
        endpoint = {
            csrf_token: mmRoot.data('scrf-token'),
            success_image: mmRoot.data('success-image'),
            error_image: mmRoot.data('error-image'),
            pdf_download: mmRoot.data('pdf-download'),
            global_notification_status: mmRoot.data('global-notification-status'),
            global_notification_edit: mmRoot.data('global-notification-edit'),
            global_notification_store: mmRoot.data('global-notification-store'),
            global_notification_show: mmRoot.data('global-notification-show'),
            global_notification_index: mmRoot.data('global-notification-index'),
        }

        function urlFor(tpl, id) {
            return (tpl || '').replace('__ID__', id);
        }

        function ensureParsleyAndSubmit(form) {
            function proceed() {
                try {
                    if ($.fn.parsley) {
                        var instance = form.parsley();
                        if (!instance.isValid()) {
                            instance.validate();
                            return;
                        }
                    }
                } catch (e) {
                    // ignore and continue with submit
                }

                let formData = form.serialize();
                $.ajax({
                    url: endpoint.global_notification_store,
                    type: "POST",
                    _token: endpoint.csrf_token,
                    data: formData,
                    success: function(response) {
                        if (response.status === true) {
                            $('#createNotification').modal('hide');
                            let msg = response.message ? response.message : 'Saved successfully';
                            $("#image_icon").attr("src", endpoint.success_image);
                            $('#success_task_title').text('Success');
                            $('#success_msg').text(msg);
                            form[0].reset();
                            $('#successModal').modal('show');
                            setTimeout(function() {
                                $('#successModal').modal('hide');
                                table.ajax.reload(null, false);
                            }, 1200);
                        }

                    },
                    error: function(xhr) {
                        let msg = 'Something went wrong';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        $("#image_icon").attr("src", endpoint.error_image);
                        $('#success_task_title').text('Error');
                        $('#success_msg').text(msg);
                        $('#successModal').modal('show');
                    }
                });
            }

            if (!$.fn.parsley) {
                $.getScript('https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js')
                    .done(function() {
                        proceed();
                    })
                    .fail(function() {
                        proceed();
                    });
            } else {
                proceed();
            }
        }

        $('#createNotificationForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            ensureParsleyAndSubmit(form);

        });

        // Reset form when modal is hidden
        $('#createNotification').on('hide.bs.modal', function() {
            $('#createNotificationForm')[0].reset();
            $('#edit_notification_id').val('');
            $('#submitBtn').text('Save');
            $('#current_date').prop('readonly', false);
            $('#start_date').prop('readonly', false);
            $('#end_date').prop('readonly', false);
            $('#type').prop('disabled', false);
            // Reset modal title
            $(this).find('h5.modal-title').html(
                '<img src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Create Notification'
            );

        });
    </script>

    <script>
        var table = $("#centerNotificationTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: endpoint.global_notification_index,
                type: 'GET'
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'start_date',
                    name: 'start_date',

                },
                {
                    data: 'end_date',
                    name: 'end_date'
                },
                {
                    data: 'type',
                    name: 'type'
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

        // Event delegation for dynamic action buttons
        $(document).on('click', '.js-view', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            const container = $('#listingModalContent');
            container.html('<div class="text-center py-3">Loading...</div>');
            $.ajax({
                url: endpoint.global_notification_show.replace('__ID__', id),
                type: 'GET',
                success: function(response) {
                    console.log(response, 'response');
                    if (response.status === true) {
                        const d = response.data || {};
                        const rows = [
                            ['Ref', d.ref || ''],
                            ['Heading', d.heading || ''],
                            ['Type', d.type || ''],
                            ['Status', d.status || ''],
                            ['Start Date', d.start_date || ''],
                            ['End Date', d.end_date || ''],
                            [d.template_name ? 'Template Name' : 'Content', (d.template_name || d
                                .content || '')]
                        ];
                        let html = `
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                              <tbody>
                        `;
                        rows.forEach(function(r) {
                            html += `
                                <tr>
                                    <th style="text-align:left; border: 1px solid #ccc; padding: 8px; width:190px;">${r[0]}</th>
                                    <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">${r[1] || ''}</td>
                                </tr>
                            `;
                        });
                        html += '</tbody></table>';
                        container.html(html);
                        $('#pdf-download').attr('data-notification-id', id);
                        $('#view-listing').modal('show');
                    } else {
                        container.html('<div class="text-danger">Failed to load details.</div>');
                    }
                },
                error: function() {
                    container.html('<div class="text-danger">Failed to load details.</div>');
                }
            });
        });

        $(document).on('click', '.js-print', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            // Implement print logic
        });

        $(document).on('click', '.js-suspend, .js-publish, .js-remove', function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            let status = '';
            let confirmMsg = '';
            if ($(this).hasClass('js-suspend')) {
                status = 'Suspended';
                confirmMsg = 'Are you sure you want to suspend this notification';
            } else if ($(this).hasClass('js-publish')) {
                status = 'Published';
                confirmMsg = 'Are you sure you want to publish this notification';
            } else if ($(this).hasClass('js-remove')) {
                status = 'Removed';
                confirmMsg = 'Are you sure you want to remove the notification';
            }

            const modal = $('#successModal');
            const body = $('#success_form_html');
            const title = $('#success_task_title').text('Confirmation');
            const img = $('#image_icon');

            img.attr('src', endpoint.error_image);
            body.html(
                `
                <h4>${confirmMsg}</h4><div class="d-flex justify-content-center gap-10 mt-3"><button type="button" class="btn-success-modal shadow-none mr-2" id="confirmRemove">Yes</button><button type="button" class="btn-cancel-modal shadow-none" data-dismiss="modal">Cancel</button></div>`
            );
            modal.modal('show');
            body.off('click', '#confirmRemove').on('click', '#confirmRemove', function() {
                $(this).prop('disabled', true);
                $.ajax({
                    url: endpoint.global_notification_status.replace('__ID__', id),
                    type: 'POST',
                    data: {
                        _token: endpoint.csrf_token,
                        status: status
                    },
                    success: function(response) {
                        $('#success_task_title').text('Success');
                        $('#image_icon').attr('src', endpoint.success_image);
                        $('#success_form_html').html('<h4>' + (response.message ||
                                'Status updated successfully') +
                            '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                        );
                        setTimeout(function() {
                            modal.modal('hide');
                            table.ajax.reload(null, false);
                        }, 1000);
                    },
                    error: function(xhr) {
                        let msg = 'Something went wrong';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        $('#success_task_title').text('Error');
                        $('#image_icon').attr('src', endpoint.error_image);
                        $('#success_form_html').html('<h4>' + msg +
                            '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                        );
                    }
                });
            });
        });

        $(document).on('click', '.js-edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            const container = $('#listingModalContent');
            container.html('<div class="text-center py-3">Loading...</div>');
            $('#createNotificationForm')[0].reset();
            // $('#edit_notification_id').val(id);
            $('#submitBtn').text('Save');
            $('#current_date').prop('readonly', true);
            $('#start_date').prop('readonly', true);
            $('#end_date').prop('readonly', true);
            $('#type').prop('disabled', true);
            // Reset modal title
            $(this).find('h5.modal-title').html(
                '<img src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Create Notification'
            );

            $.ajax({
                url: endpoint.global_notification_edit.replace('__ID__', id),
                type: 'GET',
                success: function(response) {
                    if (response.status === true) {
                        let n = response.data;
                        // Populate form fields
                        $('#edit_notification_id').val(n.id);
                        $('#heading').val(n.heading);
                        $('#start_date').val(n.start_date || '');
                        $('#end_date').val(n.end_date || '');
                        $('#type').val(n.type || 'Ad hoc').trigger('change');
                        $('#edit_content').val(n.content || '');
                        if (n.template_name) {
                            $('#template_name').val(n.template_name);
                        }

                        // Make date fields readonly in edit mode
                        ['#current_date', '#start_date', '#end_date'].forEach(id => $(id).prop(
                            'readonly', true));
                        $('#type').prop('disabled', true);
                        // Change button text to Update
                        $('#submitBtn').text('Update');

                        // Change modal title
                        $('#createNotification').find('h5.modal-title').html(
                            '<img src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Edit Notification'
                        );

                        // Show modal
                        $('#createNotification').modal('show');

                        // Reset form action

                    } else {
                        container.html('<div class="text-danger">Failed to load details.</div>');
                    }
                },
                error: function() {
                    container.html(`<div class="text-danger">Failed to load details.</div>`);
                }
            });

        });



        // Redirect new page and generate pdf
        $('#pdf-download').on('click', function() {
            var notificationId = $(this).attr('data-notification-id');
            var encodedId = btoa(String(notificationId));
            var url = urlFor(endpoint.pdf_download, encodedId);
            window.open(url, '_blank');

        });
    </script>




@endsection
