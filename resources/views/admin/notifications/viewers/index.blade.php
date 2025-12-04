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
                            <h1 class="h1">Viewer Notifications</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol>
                                        <li>You can create a Notification, published at the top of the Viewer’s Dashboard.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="bothsearch-form mb-3">
                                <button type="button" class="create-tour-sec dctour" data-toggle="modal" id=""
                                    data-target="#createNotification">New Notification</button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel with-nav-tabs panel-warning">
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active show" id="tab1warning">
                                            <div class="table-responsive-xl">
                                                <table class="table" id="agentNotificationTable">
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
    <div class="modal fade upload-modal" id="createNotification" tabindex="-1" role="dialog"
        aria-labelledby="createNotification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNotification">
                        <img src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Create
                        Notification
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form method="POST" action="{{ route('admin.agent.notifications.store') }}" id="createNotificationForm"
                        data-parsley-validate novalidate>
                        @csrf
                        <div class="row">

                            <!-- Auto-generated Date (readonly) -->
                            <div class="col-12 mb-3" id="currentDateField">
                                <label class="label" for="currentDate">Current Day</label>
                                <input type="text" class="form-control rounded-0" name="current_day" id="current_day"
                                    value="<?php echo date('d-m-Y'); ?>" data-parsley-required="true" />
                            </div>

                            <!-- Heading Field -->
                            <div class="col-12 mb-3" id="headingField">
                                <label class="label" for="headingField">Heading</label>
                                <input type="text" class="form-control rounded-0 fw-bold" name="heading" id="heading"
                                    placeholder="Heading" data-parsley-required="true" />
                            </div>

                            <!-- Notification Type -->
                            <div class="col-12 mb-3" id="typeField">
                                <label class="label" for="type">Type</label>
                                <select id="type" class="form-control" name="type">
                                    <option value="Ad hoc" selected>Ad hoc</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Notice">Notice</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div class="col-12 mb-3 date_show_hide" id="startDateField">
                                <label class="label" for="startDateField">Start Date</label>
                                <input type="date" name="start_date" id="start_date" placeholder="Start Date"
                                    class="form-control rounded-0" />
                            </div>

                            <!-- Finish Date -->
                            <div class="col-12 mb-3 date_show_hide" id="endDateField">
                                <label class="label" for="endDateField">End Date</label>
                                <input type="date" name="end_date" id="end_date" placeholder="Finish Date"
                                    class="form-control rounded-0" />
                            </div>



                            <!-- Scheduled Section -->
                            <div id="scheduledSection" style="display:none;" class="col-12 mb-3">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="label" for="scheduleType">Recurring Type</label>
                                        <select id="scheduleType" class="form-control rounded-0" name="recurring_type">
                                            <option value="">Select Type</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                            <option value="forever">Forever</option>
                                        </select>
                                    </div>

                                    <!-- Yearly Options -->
                                    <div class="form-group col-lg-12 schedule-options" id="startyearlyOptions"
                                        style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="label" for="startFirstMonth">Start Month</label>
                                                        <select id="startFirstMonth" class="form-control rounded-0 mb-2"
                                                            name="start_month_yearly">
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="label" for="startFirstDate">Start Day</label>
                                                        <select id="startFirstDate" class="form-control rounded-0"
                                                            name="start_day_yearly">
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- 2nd column --}}

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="label" for="endSecondMonth">End Month</label>
                                                        <select id="endSecondMonth" class="form-control rounded-0 mb-2"
                                                            name="end_month_yearly">
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="label" for="endSecondDay">End Day</label>
                                                        <select id="endSecondDay" class="form-control rounded-0"
                                                            name="end_day_yearly">
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Monthly Option -->
                                    <div class="form-group col-lg-12 schedule-options" id="monthlyOptions"
                                        style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="label" for="monthWiseStartDate">Start Day</label>
                                                        <select id="monthWiseStartDate" class="form-control rounded-0"
                                                            name="start_day_monthly">

                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="label" for="monthWiseEndDate">End Day</label>
                                                        <select id="monthWiseEndDate" class="form-control rounded-0"
                                                            name="end_day_monthly">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Week Option -->
                                    <div class="form-group col-lg-12 schedule-options" id="weekOptions"
                                        style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="label" for="weekWiseStartDate">Start Day</label>
                                                        <select id="weekWiseStartDate" class="form-control rounded-0"
                                                            name="start_day_week">

                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="label" for="weekWiseEndDate">End Day</label>
                                                        <select id="weekWiseEndDate" class="form-control rounded-0"
                                                            name="end_day_week">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <!-- Number of Recurring  -->
                            <div id="numberOfRecurring" class="col-12 mb-3" style="display:none;">
                                <label class="label" for="recurring">Number of Recurring</label>
                                <input type="number" id="recurring" name="recurring" class="form-control"
                                    placeholder="Number of Recurring" />
                            </div>

                            <!-- Notice Section -->
                            <div id="noticeSection" class="col-12 mb-3" style="display:none;">
                                <label class="label" for="member_id">Member Id</label>
                                <input type="text" id="member_id" name="member_id" class="form-control"
                                    placeholder="Member Id e.g. 123456" />
                            </div>

                            <!-- Content -->
                            <div class="col-12 mb-3" id="contentField">
                                <label class="label" for="content">Content</label>
                                <textarea id="content" name="content" class="form-control" required placeholder="up to 250 characters..."
                                    maxlength="250" data-parsley-required="true">

                                </textarea>
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

    <!-- Edit of Content Wrapper -->
    <div class="modal fade upload-modal" id="editNotification" tabindex="-1" role="dialog"
        aria-labelledby="editNotification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content basic-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNotification">
                        <img src="{{ asset('assets/dashboard/img/create-notification.png') }}" class="custompopicon"> Edit
                        Notification
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form method="POST" action="#" id="editNotificationForm"
                        data-parsley-validate novalidate>
                        @csrf
                        <div class="row">
                            <!-- Heading Field -->
                            <div class="col-12 mb-3" id="headingField">
                                <input type="hidden" id="edit_notification_id" name="id" />
                                <label class="label" for="headingField">Heading</label>
                                <input type="text" class="form-control rounded-0 fw-bold" name="heading" id="edit_heading"
                                    placeholder="Heading" data-parsley-required="true" />
                            </div>

                            <!-- Content -->
                            <div class="col-12 mb-3" id="contentField">
                                <label class="label" for="content">Content</label>
                                <textarea id="edit_content" name="content"  class="form-control" required placeholder="up to 250 characters..."
                                    maxlength="250" data-parsley-required="true">

                                </textarea>
                            </div>

                        </div>
                        <div class="modal-footer pr-3">
                            <button type="submit" class="btn-success-modal">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
     <!-- Edit of Content Wrapper -->

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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-pdf-download="{{ route('admin.viewer.pdf.download', ['id' => '__ID__']) }}"
        data-viewer-notification-status="{{ route('admin.viewer.notifications.status', ['id' => '__ID__']) }}"
        data-viewer-notification-edit="{{route('admin.viewer.notifications.edit', ['id' => '__ID__'])}}"
        data-viewer-notification-update="{{route('admin.viewer.notifications.update', ['id' => '__ID__'])}}"
        data-viewer-notification-index="{{route('admin.viewer.notification.index')}}"
        data-viewer-notification-store="{{route('admin.viewer.notification.store')}}"
        data-viewer-notification-show="{{route('admin.viewer.notifications.show', ['id' => '__ID__'])}}"
        >

        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>


    @endsection



    @push('script')
        <script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}">
        </script>

        <!-- hide show field js -->

        <script>
            $(document).ready(function() {
                function toggleFields() {
                    var type = $('#type').val();
                    // Hide all conditionally visible fields initially
                    $('#scheduledSection, #noticeSection, #weeklyOptions, #monthlyOptions, #startyearlyOptions, #endyearlyOptions, #numberOfRecurring, #weekOptions').hide();
                    $('#currentDateField, #headingField, #startDateField, #endDateField, #contentField').show();
                    if (type == 'Ad hoc') {
                        // All already shown, no extra fields
                        $("#numberOfRecurring").val('');
                        $("#member_id").val('');
                        $('#scheduledSection').show();
                    } else if (type === 'Notice') {
                        // Notice: Also show member_id
                        $('#noticeSection').show();
                        $("#numberOfRecurring").val('');
                    } else if (type === 'Scheduled') {
                        // Show Schedule Type dropdown
                        $('#scheduledSection, #numberOfRecurring').show();
                        $('.schedule-options, #startDateField, #endDateField').hide();

                        // Reset input fields
                        $('#member_id, #start_date, #end_date').val('');
    
                    }
                }

                //after open Agent Create Nitification modal reset fields
                $('#createNotification').on('shown.bs.modal', function() {
                    $('#createNotificationForm')[0].reset();
                    toggleFields();
                });

                // On schedule type change, show related fields
                $('#scheduleType').change(function() {
                    var scheduleType = $(this).val();
                    $('.schedule-options').hide();
                    if (scheduleType === 'weekly') {
                        $('#weekOptions').show();
                        populateTypeWeekDate("#weekWiseStartDate");
                        populateTypeWeekDate("#weekWiseEndDate");
                        $("#monthWiseStartDate, #monthWiseEndDate, #startFirstMonth, #startFirstDate, #endSecondMonth, #endSecondDay")
                            .empty('');
                        $("#member_id").val('');
                        $('#numberOfRecurring').show();
                        $("#recurring").show();

                    } else if (scheduleType === 'monthly') {
                        $('#monthlyOptions').show();
                        populateTypeMonthDate("#monthWiseStartDate", totalDays);
                        populateTypeMonthDate("#monthWiseEndDate", totalDays);
                        $("#weekWiseStartDate", "#weekWiseEndDate", "#startFirstMonth", "#startFirstDate",
                            "#endSecondMonth", "#endSecondDay").empty('');
                        $("#member_id").val('');
                        $('#numberOfRecurring').show();
                        $("#recurring").show();
                    } else if (scheduleType === 'yearly') {
                        $('#startyearlyOptions').show();
                        $('#endyearlyOptions').show();
                        populateMonths('#startFirstMonth');
                        populateMonths('#endSecondMonth');
                        $("#weekWiseStartDate", "#weekWiseEndDate", "#monthWiseStartDate", "#monthWiseEndDate")
                            .empty('');
                        $("#member_id").val('');
                        $('#numberOfRecurring').show();
                        $("#recurring").show();
                    } else if (scheduleType === 'forever') {
                        $("#weekWiseStartDate", "#weekWiseEndDate",
                            "#monthWiseStartDate, #monthWiseEndDate, #startFirstMonth, #startFirstDate, #endSecondMonth, #endSecondDay"
                        ).empty('');
                        $("#recurring").hide();
                        $("#recurring").val('');
                        $('#numberOfRecurring').hide();
                        // No additional fields shown
                    }
                });

                $('#type').change(toggleFields);
                toggleFields();

                const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                    "October", "November", "December"
                ];
                //Populate month selects
                function populateMonths(selectId) {
                    $(selectId).empty();
                    $(selectId).append(`<option value="">Select</option>`);
                    for (let i = 0; i < months.length; i++) {
                        $(selectId).append($('<option>', {
                            value: i + 1,
                            text: months[i]
                        }));
                    }
                }

                //Get days in month
                function getDaysInMonth(month, year = new Date().getFullYear()) {
                    return new Date(year, month, 0).getDate();
                }

                //Get Selectd Date
                function getSelectedDate(monthId, dayId) {
                    let month = $(monthId).val();
                    let day = $(dayId).val();
                    let year = new Date().getFullYear();
                    return new Date(year, month - 1, day);
                }

                //Match start date and end date
                function matchEndDateToStartDate() {
                    let startDate = getSelectedDate("#startFirstMonth", "#startFirstDate");
                    let endDate = getSelectedDate("#endSecondMonth", "#endSecondDay");
                    if (startDate > endDate) {
                        $("#endSecondMonth").val($("#startFirstMonth").val());
                        populateDays("#endSecondDay", $("#startFirstMonth").val());
                        $("#endSecondDay").val($("#startFirstDate").val());
                    }
                }


                $("#startFirstMonth, #startFirstDate, #endSecondMonth, #endSecondDay").on("change", function() {
                    matchEndDateToStartDate();
                });

                //Populate day selects
                function populateDays(selectId, month) {
                    $(selectId).empty();
                    let days = getDaysInMonth(month);
                    for (let i = 1; i <= days; i++) {
                        $(selectId).append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }


                //When start_month change
                $("#startFirstMonth").on("change", function() {
                    let startMonth = parseInt($(this).val());
                    if (!startMonth) return;
                    // Populate start_day based on start_month
                    populateDays("#startFirstDate", startMonth);

                    //Disable months before start_month in end_month
                    $("#endSecondMonth option").each(function() {
                        let val = parseInt($(this).val());
                        if (val < startMonth) {
                            $(this).prop('disabled', true);
                        } else {
                            $(this).prop('disabled', false);
                        }

                    });

                    // If currently selected endMonth id disabled , rest selection to startMonth
                    let currentEndMonth = parseInt($('#endSecondMonth').val());
                    if (!currentEndMonth || currentEndMonth < startMonth) {
                        populateDays('#endSecondDay', startMonth);
                    }

                });

                // When end_month changes
                $('#endSecondMonth').on("change", function() {
                    let endMonth = parseInt($(this).val());
                    if (!endMonth) return;
                    populateDays("#endSecondDay", endMonth);
                });

                // Trigger change on page load to initialize days for start_month and end_month
                $("#startFirstMonth").change();

                function populateTypeMonthDate(selectDate, totalDays) {
                    for (i = 1; i <= totalDays; i++) {
                        $(selectDate).append(`<option value="${i}">${i}</option>`);
                    }
                }


                //When select Scheduled Type Month
                const today = new Date();
                const totalDays = new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();
                //Fill dropdown with day numbers


                //When Start day changes
                $("#monthWiseStartDate").on('change', function() {
                    const startDate = parseInt($(this).val());
                    //Disable months before start_month in end_month
                    $("#monthWiseEndDate option").each(function() {
                        let val = parseInt($(this).val());
                        if (val < startDate) {
                            $(this).prop('disabled', true);
                        } else {
                            $(this).prop('disabled', false);
                        }

                    });

                });

                //Match start date and end date for type Monthly
                function typeMonthlySelectedDate(dayId) {
                    let month = new Date().getMonth() + 1;
                    let day = $(dayId).val();
                    let year = new Date().getFullYear();
                    return new Date(year, month - 1, day);
                }

                //Match tart date and end date
                function typeMonthlyWiseMatchStartEndDate() {
                    let startDate = typeMonthlySelectedDate("#monthWiseStartDate");
                    let endDate = typeMonthlySelectedDate("#monthWiseEndDate");
                    if (startDate > endDate) {
                        $("#monthWiseEndDate").val($("#monthWiseStartDate").val());
                    }
                }

                $("#monthWiseStartDate, #monthWiseEndDate").on('change', function() {
                    typeMonthlyWiseMatchStartEndDate();
                });

                //Type Week wise event
                // Loop for append week list 
                function populateTypeWeekDate(selectId) {
                    for (i = 1; i <= 7; i++) {
                        $(selectId).append(`<option value="${i}">${i}</option>`);
                    }
                }

                $("#weekWiseStartDate, #weekWiseEndDate").on('change', function() {

                    let startDate = getTypeWeeklySelectedDate("#weekWiseStartDate");
                    let endDate = getTypeWeeklySelectedDate("#weekWiseEndDate");
                    if (startDate > endDate) {
                        $("#weekWiseEndDate").val($("#weekWiseStartDate").val());
                    }
                });

                function getTypeWeeklySelectedDate(dayId) {
                    let day = $(dayId).val();
                    return day;
                }

            });
        </script>



        <script>
            const mmRoot = $('#manage-route');
            endpoint = {
                csrf_token: mmRoot.data('scrf-token'),
                success_image: mmRoot.data('success-image'),
                error_image: mmRoot.data('error-image'),
                pdf_download: mmRoot.data('pdf-download'),
                viewer_notification_status: mmRoot.data('viewer-notification-status'),
                viewer_notification_edit: mmRoot.data('viewer-notification-edit'),
                viewer_notification_update: mmRoot.data('viewer-notification-update'),
                viewer_notification_index: mmRoot.data('viewer-notification-index'),
                viewer_notification_store: mmRoot.data('viewer-notification-store'),
                viewer_notification_show: mmRoot.data('viewer-notification-show'),
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
                        url: endpoint.viewer_notification_store,
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

            var table = $("#agentNotificationTable").DataTable({
                language: {
                    search: "Search: _INPUT_",
                    searchPlaceholder: "Search by Ref..."
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: endpoint.viewer_notification_index,
                    type: 'GET'
                },
                columns: [{ // 👇 New column for row index
                        data: null,
                        name: 'row_index',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            // meta.row starts from 0
                            let idNumber = meta.row + meta.settings._iDisplayStart + 1;
                            // Format like #00001
                            return '#' + idNumber.toString().padStart(5, '0');
                        }
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
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
                    url: endpoint.viewer_notification_show.replace('__ID__', id),
                    type: 'GET',
                    success: function(response) {

                        if (response.success === true || response.status === true) {
                            const d = response.data || response;
                            const rows = [
                                ['Ref', d.ref || ''],
                                ['Heading', d.heading || ''],
                                ['Type', d.type || ''],
                                ['Recurring Type', d.recurring_type || ''],
                                ['Recurring Range', d.recurring_range || ''],
                                ['Number of Recurring', d.num_recurring || ''],
                                ['Status', d.status || 'N/A'],
                                ['Member ID', d.member_id || ''],
                                ['Start Date', d.start_date || ''],
                                ['Finish Date', d.end_date || ''],
                                ['Content', (d.content || '')]
                            ];


                            let html =
                                `<table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;"><tbody>`;
                            rows.forEach(function(r) {
                                html += `
                                        <tr>
                                            <th style="text-align:left; border: 1px solid #ccc; padding: 8px; width:190px;">${r[0]}</th>
                                            <td style="border: 1px solid #ccc; padding: 8px; text-align:left;">${r[1]}</td>
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
                    confirmMsg = 'Are you sure you want to suspend this notification?';
                } else if ($(this).hasClass('js-publish')) {
                    status = 'Published';
                    confirmMsg = 'Are you sure you want to publish this notification?';
                } else if ($(this).hasClass('js-remove')) {
                    status = 'Removed';
                    confirmMsg = 'Are you sure you want to remove this notification?';
                }

                const modal = $('#successModal');
                const body = $('#success_form_html');
                const img = $('#image_icon');
                $('#success_task_title').text('Confirmation');
                img.attr('src', endpoint.error_image);
                body.html(
                    `<h4>${confirmMsg}</h4><div class="d-flex justify-content-center gap-10 mt-3"><button type="button" class="btn-success-modal shadow-none mr-2" id="confirmRemove">Yes</button><button type="button" class="btn-cancel-modal shadow-none" data-dismiss="modal">Cancel</button></div>`
                );
                modal.modal('show');
                body.off('click', '#confirmRemove').on('click', '#confirmRemove', function() {
                    $(this).prop('disabled', true);
                    $.ajax({
                        url: endpoint.viewer_notification_status.replace('__ID__', id),
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

            // Redirect new page and generate pdf
            $('#pdf-download').on('click', function() {
                var notificationId = $(this).attr('data-notification-id');
                var encodedId = btoa(String(notificationId));
                var url = urlFor(endpoint.pdf_download, encodedId);
                window.open(url, '_blank');

            });

            //edit Agent moduel
            $(document).on('click', '.js-edit', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $('#currentDateField, #startDateField, #typeField, #endDateField,  #scheduledSection, #noticeSection, #weeklyOptions, #monthlyOptions, #startyearlyOptions, #endyearlyOptions, #numberOfRecurring, #weekOptions').hide();
               
                $.ajax({
                    url: endpoint.viewer_notification_edit.replace('__ID__', id),
                    type: 'GET',
                    success: function(response) {
                        $('#editNotification').modal('show');
                        $('#editNotificationForm')[0].reset();
                        if (response.status === true) {
                            let n = response.data;
                            $('#edit_notification_id').val(n.id);
                            $('#edit_heading').val(n.heading);
                            $('#edit_content').val(n.content);
                        }
                    },
                    error: function() {
                        container.html('<div class="text-danger">Failed to load details.</div>');
                    }
                });
            });

            //update Agent Notification Module
            $("#editNotificationForm").on('submit', function(e){
                e.preventDefault();
                let id = $("#edit_notification_id").val();
                let form = $(this);
                let formData = form.serialize();
                 $.ajax({
                        url: endpoint.viewer_notification_update.replace('__ID__', id),
                        type: "POST",
                        _token: endpoint.csrf_token,
                        data: formData,
                        success: function(response) {
                            if (response.status === true) {
                                $('#editNotification').modal('hide');
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

            })
        </script>
    @endpush
