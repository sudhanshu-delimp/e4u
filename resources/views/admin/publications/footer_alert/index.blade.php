@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style type="text/css">
        .parsley-errors-list {
            list-style: none;
            color: rgb(248, 0, 0)
        }

        #cke_1_contents {
            height: 150px !important;
        }
    </style>
@endsection
@section('content')
    @php
        $securityLevel = isset(auth()->user()->staff_detail->security_level)
            ? auth()->user()->staff_detail->security_level
            : 0;
        $addAccess = staffPageAccessPermission($securityLevel, 'add');
        $addAccessEnabled = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';

        $editAccess = staffPageAccessPermission($securityLevel, 'edit');
        $editAccessEnabled = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
    @endphp
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!--middle content-->
        <div class="row">
            <div class="custom-heading-wrapper col-md-12">
                <h1 class="h1"> Alerts</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" style="font-size:16px"><b>Help?</b>
                </span>
            </div>
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes">
                    <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="level-1">
                            <li>You can create an Alert, published in the Footer, for:</li>
                            <ol class="level-2 ">
                                <li>Employment, and adjust lettering accordingly.</li>
                                <li>New features launched in the Website.</li>
                                <li>Scammer Alerts; and</li>
                                <li>Website updates.</li>
                            </ol>
                            <li>Public notices are published on the Home page.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 ">
                @if ($addAccessEnabled)
                    <div class="d-flex justify-content-end gap-20 my-3">
                        <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#Create_Notice">New
                            Notice</button>
                        <button type="button" class="btn-common mr-0" data-toggle="modal" data-target="#Create_Alert">New
                            Alert</button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table" id="AlertTable">
                        <thead class="table-bg">
                            <tr>
                                <th scope="col">Ref</th>
                                <th scope="col">Date Publised</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    <div class="modal fade upload-modal" id="Create_Notice" tabindex="-1" role="dialog"
        aria-labelledby="Create_AlertLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="Create_Notice"><img src="{{ asset('assets/dashboard/img/new-notice.png') }}"
                            alt="alert" class="custompopicon"> New Notice
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form>
                        <div class="row">
                            <div class="col-12 mb-3 d-flex justify-content-start align-items-center">
                                <label class="mb-1 label">Motion : </label>
                                <div class="pl-3">
                                    <input type="radio" name="motion" id="motion" checked>
                                    <lable name="motion"> Static</lable>
                                    <input type="radio" name="motion" id="motion">
                                    <lable name="motion"> Scrolling</lable>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="Descrioption" class="label">Descrioption</label>
                                <textarea class="form-control" id="description" name="description" placeholder="up to 200 characters"
                                    rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label class="form-check-label pr-4" for="exampleCheck1">Date: <span
                                            class="ml-1">{{ date('d-m-Y') }}</span></label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pb-4 mb-2">
                    <button type="button" class="btn-success-modal">Publish</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade upload-modal" id="Create_Alert" tabindex="-1" role="dialog" aria-labelledby="Create_Alert"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <form method="POST" id="AlertForm">
                    @csrf
                    <input type="hidden" id="edit_alert_id" name="edit_alert_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="type_alert"><img src="{{ asset('assets/app/img/alert.png') }}"
                                alt="alert" class="custompopicon"> New Alert
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="label">Select Alert Type</label>
                                <select class="form-control rounded-0" id="alert_type" name="alert_type">
                                    <option value="Employment">Employment</option>
                                    <option value="New Features">New Features</option>
                                    <option value="Scammer Alerts">Scammer Alerts</option>
                                    <option value="Website Updates">Website Updates</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="label">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control rounded-0"
                                    placeholder="Subject ">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="label">Descrioption</label>
                                <textarea class="form-control" id="description" name="description" placeholder="up to 500 characters"
                                    rows="3"></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="label">Message</label>
                                <textarea class="form-control rounded-0" id="message" name="message" placeholder="Message" rows="1"
                                    cols="1"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-0">
                                    <label class="form-check-label pr-4">Date: <span
                                            class="ml-1">{{ date('d-m-Y') }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pb-4 mb-2">
                        <button type="submit" id="submitBtn" class="btn-success-modal">Publish</button>
                    </div>
                </form>
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



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-publications-alert-status="{{ route('admin.publications.alert.status', ['id' => '__ID__']) }}"
        data-publications-alert-edit="{{ route('admin.publications.alert.edit', ['id' => '__ID__']) }}"
        data-publications-alert-update="{{ route('admin.publications.alert.update', ['id' => '__ID__']) }}"
        data-publications-alert-store="{{ route('admin.publications.alert.store') }}"
        data-publications-alert-show="{{ route('admin.publications.alert.show', ['id' => '__ID__']) }}"
        data-publications-alert-index="{{ route('admin.publications.alert.index') }}">

    </div>
@endsection
@push('script')
    <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
    </script>

    <script>
        const mmRoot = $('#manage-route');

        endpoint = {
            csrf_token: mmRoot.data('scrf-token'),
            success_image: mmRoot.data('success-image'),
            error_image: mmRoot.data('error-image'),
            publications_alert_status: mmRoot.data('publications-alert-status'),
            publications_alert_edit: mmRoot.data('publications-alert-edit'),
            publications_alert_store: mmRoot.data('publications-alert-store'),
            publications_alert_show: mmRoot.data('publications-alert-show'),
            publications_alert_index: mmRoot.data('publications-alert-index'),
        }

        function urlFor(tpl, id) {
            return (tpl || '').replace('__ID__', id);
        }

        //Remove Validation Message
        function removeValidationMsg() {
            $('.server-error').remove();
            $('.is-invalid').removeClass('is-invalid');
        }

        //for submit
        function formSubmit(form) {
            let formData = form.serialize();

            $.ajax({
                url: endpoint.publications_alert_store,
                method: "POST",
                _token: endpoint.csrf_token,
                data: formData,
                success: function(response) {

                    if (response.status == true) {
                        $('#Create_Alert').modal('hide');
                        let msg = response.message ? response.message : "Save Successfully";
                        $("#image_icon").attr("src", endpoint.success_image);
                        $('#success_task_title').text('Success');
                        $('#success_form_html').html('<h4>' + (msg || 'Status updated successfully') +
                            '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                        );
                        form[0].reset();
                        $('#successModal').modal('show');
                        setTimeout(function() {
                            $('#successModal').modal('hide');
                            table.ajax.reload(null, false);
                        }, 1200);

                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422 && xhr.responseJSON.status === false) {
                        let errors = xhr.responseJSON.errors;
                        console.log(errors, 'errors');
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
                            'Status updated successfully') +
                        '</h4><button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal" aria-label="Close">OK</button>'
                    );
                    $('#successModal').modal('show');
                }
            })

        }

        $('#AlertForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            formSubmit(form);
        });


        var table = $("#AlertTable").DataTable({
            language: {
                search: "Search: _INPUT_",
                searchPlaceholder: "Search by Ref"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: endpoint.escort_notification_index,
                type: 'GET'
            },
            columns: [{
                    data: 'ref',
                    name: 'ref'
                },
                {
                    data: 'published_date',
                    name: 'published_date',

                },
                {
                    data: 'alert_type',
                    name: 'alert_type'
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
    </script>
@endpush
