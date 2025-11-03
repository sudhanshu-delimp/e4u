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
        <div id="content">
            <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
                <div class="row">
                    <div class="custom-heading-wrapper col-md-12">
                        <h1 class="h1">Center Notifications</h1>
                        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="card collapse" id="notes">
                            <div class="card-body">
                                <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                <ol>
                                    <li>You can create a Notification, published at the top of the Massage Centre’s
                                        Dashboard.</li>
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
                                                        <th scope="col">Finish</th>
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
            <!--right side bar end-->
        </div>
    </div>
    <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
<div class="modal fade upload-modal" id="createNotification" tabindex="-1" role="dialog" aria-labelledby="createNotification" aria-hidden="true">
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
                <form method="POST" id="createNotificationForm"
                    action="{{ route('admin.centres.notifications.store') }}" data-parsley-validate>
                    @csrf
                    <div class="row">
                        <!-- Auto-generated Date (readonly) -->
                        <div class="col-12 mb-3">
                            <input type="date" class="form-control rounded-0" placeholder="Date (Auto-generated)"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />
                        </div>

                        <!-- Heading Field -->
                        <div class="col-12 mb-3">
                            <input type="text" name="heading" id="heading"
                                class="form-control rounded-0  fw-bold" placeholder="Heading" required />
                        </div>

                        <!-- Start Date -->
                        <div class="col-12 mb-3">
                            <input type="text" name="start_date" id="start_date" onfocus="(this.type='date')"
                                placeholder="Start Date" class="form-control rounded-0"
                                min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" required />

                        </div>

                        <!-- Finish Date -->
                        <div class="col-12 mb-3">
                            <input type="text" name="finish_date" id="finish_date" onfocus="(this.type='date')"
                                placeholder="Finish Date" class="form-control rounded-0"
                                min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" required />

                        </div>
                        <!-- Type Field (fixed Adhoc Content) -->
                        <div class="col-12 mb-3">
                            <select id="type" onchange="toggleFields()" name="type"
                                class="form-control rounded-0" required>
                                <option value="">-- Select Type --</option>
                                <option value="Adhoc">Adhoc</option>
                                <option value="Template">Template</option>
                                <option value="Notice">Notice</option>
                            </select>
                        </div>


                        <div id="templateSelect" style="display: none;" class="col-12 mb-3">
                            <select id="template_name" name="template_name" class="form-control rounded-0">
                                <option value="">-- Choose a Template --</option>
                                <option value="Check out our Visa services. Go to Concierge and select- Visa.">Check
                                    out our Visa services. Go to Concierge and select- Visa.</option>
                                <option value="Check out of Mobile SIM service. Go to Concierge and select - Visa.">
                                    Check out of Mobile SIM service. Go to Concierge and select - Visa.</option>
                                <option
                                    value="Did you know you can order product online? Go to Concierge and select - Product.">
                                    Did you know you can order product online? Go to Concierge and select - Product.
                                </option>
                                <option
                                    value="Discounts apply when you spend a certain amount with us. Check out our Loyalty Program.">
                                    Discounts apply when you spend a certain amount with us. Check out our Loyalty
                                    Program.</option>
                                <option value="Want to save on Fees, become an Influencer.">Want to save on Fees,
                                    become an Influencer.</option>
                                <option
                                    value="Need an email account? We can help you. Simply go to Concierge and select Email.">
                                    Need an email account? We can help you. Simply go to Concierge and select Email.
                                </option>
                            </select>
                        </div>

                        <!-- Notice Section -->
                        <div id="noticeSection" class="col-12 mb-3" style="display: none;">
                            <input type="text" id="member_id" name="member_id" class="form-control"
                                placeholder="Member Id e.g. 123456">
                        </div>

                        <!-- content -->
                        <div class="col-12 mb-3" id="contentField">
                            <textarea id="content" name="content" class="form-control" placeholder="up to 250 characters..."></textarea>

                        </div>
                    </div>
                    <div class="modal-footer pr-3">
                        <button type="submit" class="btn-success-modal">Save</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>


<div class="modal fade upload-modal " id="view-listing" tabindex="-1" role="dialog" aria-labelledby="view-listingLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content basic-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="view-listings"><img src="{{ asset('assets/dashboard/img/create-notification.png') }}" alt="alert" style="width:29px;">
                    View Notification
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div id="listingModalContent">
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pb-4 mb-2">
                <button type="button" class="btn-cancel-modal" data-dismiss="modal">Close</button>
                <button  type="submit" id="pdf-download" data-notification-id="" >Print</button>
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
    data-pdf-download="{{route('admin.centres.pdf.download', ['id' => '__ID__'])}}"> 
    

</div>
@endsection
@section('script') <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
</script>
<script>
    function toggleFields() {
        var type = document.getElementById('type').value;

        var templateSelect = document.getElementById('templateSelect');
        var noticeSection = document.getElementById('noticeSection');
        var contentField = document.getElementById('contentField');

        if (type === 'Template') {
            templateSelect.style.display = 'block';
            noticeSection.style.display = 'none';
            contentField.style.display = 'none';
        } else if (type === 'Notice') {
            templateSelect.style.display = 'none';
            noticeSection.style.display = 'block';
            contentField.style.display = 'block';
        } else if (type === 'Adhoc') {
            templateSelect.style.display = 'none';
            noticeSection.style.display = 'none';
            contentField.style.display = 'block';
        } else {
            templateSelect.style.display = 'none';
            noticeSection.style.display = 'none';
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
    }
    function urlFor(tpl, id){ return (tpl || '').replace('__ID__', id); }

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
                url: form.attr('action'),
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
            url: "{{ route('admin.centres.notifications.index') }}",
            type: 'GET'
        },
        columns: [{
                data: 'ref',
                name: 'ref'
            },
            {
                data: 'start_date',
                name: 'start_date'
            },
            {
                data: 'finish_date',
                name: 'finish_date'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
        ],
        order: [
            [1, 'desc']
        ],
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
            url: "{{ route('admin.centres.notifications.show', ['id' => '__ID__']) }}".replace('__ID__', id),
            type: 'GET',
            success: function(response) {
                if (response.status === true) {
                    const d = response.data || {};
                    const rows = [
                        ['Ref', d.ref || ''],
                        ['Heading', d.heading || ''],
                        ['Type', d.type || ''],
                        ['Status', d.status || ''],
                        ['Member ID', d.member_id || ''],
                        ['Start Date', d.start_date || ''],
                        ['Finish Date', d.finish_date || ''],
                        [d.template_name ? 'Template Name' : 'Content', (d.template_name || d.content || '')]
                    ];
                    let html = `
                            <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
                              <tbody>
                        `;
                    rows.forEach(function(r) {
                        html += `
                                <tr>
                                    <td style="text-align:left; border: 1px solid #ccc; padding: 8px;"><strong>${r[0]}</strong></td>
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

    $(document).on('click', '.js-remove', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const modal = $('#successModal');
        const body = $('#success_form_html');
        const img = $('#image_icon');
        $('#success_task_title').text('Confirmation');
        img.attr('src', endpoint.error_image);
        body.html('<h4>Are you sure you want to remove this notification?</h4>\
                <div class="d-flex justify-content-center gap-10 mt-3">\
                    <button type="button" class="btn-success-modal shadow-none mr-2" id="confirmRemove">Yes, Remove</button>\
                    <button type="button" class="btn-cancel-modal shadow-none" data-dismiss="modal">Cancel</button>\
                </div>');
        modal.modal('show');

        body.off('click', '#confirmRemove').on('click', '#confirmRemove', function() {
            // Disable button to prevent duplicate
            $(this).prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.centres.notifications.remove', ['id' => '__ID__']) }}".replace('__ID__', id),
                type: 'POST',
                data: {
                    _token: endpoint.csrf_token
                },
                success: function(response) {
                    $('#success_task_title').text('Success');
                    img.attr('src', endpoint.success_image);
                    body.html('<h4>' + (response.message || 'Status updated successfully') + '</h4>\
                            <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>');
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
                    img.attr('src', endpoint.error_image);
                    body.html('<h4>' + msg + '</h4>\
                            <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>');
                }
            });
        });
    });

    // Redirect new page and generate pdf
    $('#pdf-download').on('click', function () {
        var notificationId = $(this).attr('data-notification-id');
        var encodedId = btoa(String(notificationId));
        var url = urlFor(endpoint.pdf_download, encodedId);
        window.open(url, '_blank');
        
    });

 
</script>




@endsection