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
        .parsley-errors-list{
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
                                                            <th scope="col">Ref
                                                            </th>
                                                            <th scope="col">Start</th>

                                                            <th scope="col">Finish</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col" class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-content">
                                                        <tr class="row-color">
                                                            <td class="theme-color">Maintenance</td>
                                                            <td class="theme-color">08-06-2025</td>
                                                            <td class="theme-color">09-06-2025</td>
                                                            <td class="theme-color">Adhoc</td>
                                                            <td class="theme-color">Published</td>

                                                            <td class="theme-color text-center">
                                                                <div class="dropdown no-arrow">
                                                                    <a class="dropdown-toggle" href="#" role="button"
                                                                        id="dropdownMenuLink" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        <i
                                                                            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                                    </a>
                                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                                        aria-labelledby="dropdownMenuLink" style="">
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                            href="#"> <i
                                                                                class="fa fa-fw fa-times"></i> Removed </a>
                                                                        <div class="dropdown-divider"></div>

                                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                            href="#"> <i class="fa fa-eye"></i> View
                                                                        </a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10"
                                                                            href="#"> <i
                                                                                class="fa fa-fw fa-print"></i> Print </a>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
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
                    <form method="POST" id="createNotificationForm"
                        action="{{ route('admin.centres.notifications.store') }}" data-parsley-validate>

                        <div class="row">

                            <!-- Auto-generated Date (readonly) -->
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control rounded-0" placeholder="Date (Auto-generated)"
                                    readonly value="<?php echo date('Y-m-d'); ?>" required />
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
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />

                            </div>

                            <!-- Finish Date -->
                            <div class="col-12 mb-3">
                                <input type="text" name="finish_date" id="finish_date" onfocus="(this.type='date')"
                                    placeholder="Finish Date" class="form-control rounded-0"
                                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required />

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
                                <select id="templateList" class="form-control rounded-0">
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
                                <input type="text" id="memberId" class="form-control"
                                    placeholder="Member Id e.g. 123456">
                            </div>

                            <!-- content -->
                            <div class="col-12 mb-3" id="contentField">
                                <textarea id="content" class="form-control" placeholder="up to 250 characters..."></textarea>

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
                        <h4 id="success_msg">Are you sure you want to mark this Appointment as completed?</h4>
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
    <div id="manage-route" 
        data-scrf-token="{{ csrf_token() }}" 
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        {{-- data-show-appointment="{{ route('agent.appointments.show', ['id' => '__ID__']) }}"> --}}
    @endsection
    @section('script')
        <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
            endpoint = 
                csrf_token: mmRoot.data('scrf-token'),
                success_image: mmRoot.data('success-image'),
                error_image: mmRoot.data('error-image'),   
            }




            $('#createNotificationForm').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                console.log(form);
                if (!form.parsley().isValid()) {
                    form.parsley().validate();
                    return;
                }
                let formData = form.serialize();

                //Ajax request
                $.ajax({
                    url: form.attr('action'),
                    type: "POST",
                     _token: endpoint.csrf_token,
                    data: formData,
                    success: function(response) {
                        $('#success_msg').text(request.message || 'Saved successfully');
                        $('#success_task_title').text('Success');
                        $("#image_icon").attr("src", endpoint.success_image);
                        $('#new_appointment_model').modal('hide');
                        form[0].reset();
                        $('#successModal').modal('show');
                        setTimeout(function() {
                            $('#successModal').modal('hide');
                        }, 2000);
                    }
                })


            });
        </script>


        <script></script>







        <script>
            var table = $("#centerNotificationTable").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Ref..."
                },
                info: true,
                paging: true,
                lengthChange: true,
                searching: true,
                bStateSave: true,
                order: [
                    [1, 'desc']
                ],
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10
            });
        </script>

    @endsection
