@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <style>
        .swal-button {
            background-color: #242a2c;
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
                            <h1 class="h1">Agent Notifications</h1>
                            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
                        </div>
                        <div class="col-md-12 mb-4">
                            <div class="card collapse" id="notes">
                                <div class="card-body">
                                    <h3 class="NotesHeader"><b>Notes:</b> </h3>
                                    <ol>
                                        <li>You can create a Notification, published at the top of the Agent’s Dashboard.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                                                <table class="table" id="agentNotificationTable">
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
                    <form method="POST" action="{{route('admin.agent.notifications.store')}}" id="createNotificationForm" data-parsley-validate>
                        @csrf
                        <div class="row">

                            <!-- Auto-generated Date (readonly) -->
                            <div class="col-12 mb-3" id="currentDateField">
                                <label class="label" for="currentDate">Current Day</label>
                                <input type="text" class="form-control rounded-0" placeholder="Date (Auto-generated)" required value="<?php echo date('d-m-Y'); ?>" />
                            </div>

                            <!-- Heading Field -->
                            <div class="col-12 mb-3" id="headingField">
                                <label class="label" for="headingField">Heading</label>
                                <input type="text" class="form-control rounded-0 fw-bold" name="heading" required id="heading" placeholder="Heading" />
                            </div>

                            <!-- Notification Type -->
                            <div class="col-12 mb-3" id="typeField">
                                <label class="label" for="type">Type</label>
                                <select id="type" class="form-control" name="type" required>
                                    <option value="adhoc" selected>Adhoc</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="notice">Notice</option>
                                </select>
                            </div>

                            <!-- Start Date -->
                            <div class="col-12 mb-3 date_show_hide" id="startDateField">
                                <label class="label" for="startDateField">Start Date</label>
                                <input type="date" name="start_date" id="start_date" placeholder="Start Date" required class="form-control rounded-0" />
                            </div>

                            <!-- Finish Date -->
                            <div class="col-12 mb-3 date_show_hide" id="endDateField">
                                <label class="label" for="endDateField">End Date</label>
                                <input type="date" name="end_date" id="end_date" placeholder="Finish Date" required class="form-control rounded-0" />
                            </div>



                            <!-- Scheduled Section -->
                            <div id="scheduledSection" style="display:none;" class="col-12 mb-3">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label class="label" for="scheduleType">Recurring Type</label>
                                        <select id="scheduleType" class="form-control rounded-0" name="scheduleType" >
                                            <option value="">Select Schedule Type</option>
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
                                                        <select id="startFirstMonth" class="form-control rounded-0 mb-2"  name="startFirstMonth">
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="label" for="startFirstDate">Start Day</label>
                                                        <select id="startFirstDate" class="form-control rounded-0"  name="startFirstDate">
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- 2nd column --}}

                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="label" for="endSecondMonth">End Month</label>
                                                        <select id="endSecondMonth" class="form-control rounded-0 mb-2"  name="endSecondMonth">
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="label" for="endSecondDay">End Day</label>
                                                        <select id="endSecondDay" class="form-control rounded-0"  name="endSecondDay">
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
                                                        <select id="monthWiseStartDate" class="form-control rounded-0" required name="monthWiseStartDate">

                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="label" for="monthWiseEndDate">End Day</label>
                                                        <select id="monthWiseEndDate" class="form-control rounded-0" required name="monthWiseEndDate">

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
                                                        <select id="weekWiseStartDate" class="form-control rounded-0" required name="weekWiseStartDate">

                                                        </select>
                                                    </div>

                                                    <div class="col-6">
                                                        <label class="label" for="weekWiseEndDate">End Day</label>
                                                        <select id="weekWiseEndDate" class="form-control rounded-0" required name="weekWiseEndDate">

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
                                <input type="number" id="recurring" name="recurring" class="form-control"  placeholder="Number of Recurring" required />
                            </div>

                            <!-- Notice Section -->
                            <div id="noticeSection" class="col-12 mb-3" style="display:none;">
                                <label class="label" for="member_id">Member Id</label>
                                <input type="text" id="member_id" name="member_id" class="form-control"  placeholder="Member Id e.g. 123456" required />
                            </div>

                            <!-- Content -->
                            <div class="col-12 mb-3" id="contentField">
                                <label class="label" for="content">Content</label>
                                <textarea id="content" class="form-control" required placeholder="up to 250 characters..." maxlength="250"></textarea>
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

    <div id="manage-route" data-scrf-token="{{ csrf_token() }}"
        data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
        data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
        data-pdf-download="{{ route('admin.centres.pdf.download', ['id' => '__ID__']) }}">

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

        <script>
            var table = $("#agentNotificationTable").DataTable({
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

            //
        </script>

        <!-- hide show field js -->

        <script>
            $(document).ready(function() {
                function toggleFields() {
                    var type = $('#type').val();


                    // Hide all conditionally visible fields initially
                    $('#scheduledSection').hide();
                    $('#noticeSection').hide();
                    $('#weeklyOptions').hide();
                    $('#monthlyOptions').hide();
                    $('#startyearlyOptions').hide();
                    $('#endyearlyOptions').hide();
                    $('#numberOfRecurring').hide();
                    $('#weekOptions').hide();

                    $('#currentDateField').show();
                    $('#headingField').show();
                    $('#startDateField').show();
                    $('#endDateField').show();
                    $('#contentField').show();

                    if (type === 'adhoc') {
                        // Adhoc: Show date, heading, type, start_date, end_date, content
                        // All already shown, no extra fields
                    } else if (type === 'notice') {
                        // Notice: Also show member_id
                        $('#noticeSection').show();
                    } else if (type === 'scheduled') {
                        // Show Schedule Type dropdown
                        $('#scheduledSection').show();
                        $('#numberOfRecurring').show();
                        // Hide all schedule options until selection
                        $('.schedule-options').hide();
                        $('#startDateField').hide();
                        $('#endDateField').hide();
                    }
                }

                // On schedule type change, show related fields
                $('#scheduleType').change(function() {
                    var scheduleType = $(this).val();
                    $('.schedule-options').hide();
                    if (scheduleType === 'weekly') {
                        $('#weekOptions').show();
                    } else if (scheduleType === 'monthly') {
                        $('#monthlyOptions').show();
                    } else if (scheduleType === 'yearly') {
                        $('#startyearlyOptions').show();
                        $('#endyearlyOptions').show();
                    } else if (scheduleType === 'forever') {
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
                    // console.log('on click......');
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

                //append Months
                populateMonths('#startFirstMonth');
                populateMonths('#endSecondMonth');

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
                populateTypeMonthDate("#monthWiseStartDate", totalDays);
                populateTypeMonthDate("#monthWiseEndDate", totalDays);

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
                    console.log(startDate, endDate);
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

                populateTypeWeekDate("#weekWiseStartDate");
                populateTypeWeekDate("#weekWiseEndDate");

                $("#weekWiseStartDate, #weekWiseEndDate").on('change', function() {

                    let startDate = getTypeWeeklySelectedDate("#weekWiseStartDate");
                    let endDate = getTypeWeeklySelectedDate("#weekWiseEndDate");
                    console.log(startDate, endDate);
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
                    console.log(formData);
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
                console.log(form);
                ensureParsleyAndSubmit(form);
            });
        </script>
    @endpush
