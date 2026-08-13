@extends('layouts.userDashboard')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
    <style>
        .toggle-task-form {
            font-size: 16px;
            /* color: #007bff; */
            display: inline-block;
            margin: 20px 0px;
        }

        .task-1 {
            width: clamp(50%, 8vw, 100%) !important;

        }

        @media (max-width:1024px) {

            .task-1 {
                width: clamp(50%, 40vw, 100%) !important;

            }
        }

        .agent-tour .card {
            padding: 5px 12px !important;
        }

        .page-item:hover .fa {
            color: white !important;
        }

        .page-item:hover .page-link {
            color: white;
        }

        .btn-primary {
            border-color: unset !important;
        }
        .table-responsive{
            overflow: visible
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper justify-content-between">
                <div class="d-flex align-items-center">
                    <h1 class="h1">Task List</h1>
                    <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"
                        aria-expanded="true"><b>Help?</b></span>
                </div>

                <div class="back-to-dashboard">
                    <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                        <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                    </a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                    <div class="card-body">
                        <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>

                        <ol>

                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-10">
                <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-10">
                    <div class="total_listing">
                        <div><span>In Progress Task : </span></div>
                        <div><span class="totalInprogressTask">0</span></div>
                    </div>
                    <div class="total_listing">
                        <div><span>Open Task : </span></div>
                        <div><span class="totalOpenTask">0</span></div>
                    </div>
                    <div class="total_listing">
                        <div><span>Completed Task : </span></div>
                        <div><span class="totalCompletedTask">0</span></div>
                    </div>
                </div>
                <div class="text-center small d-flex justify-content-end align-items-center gap-10 flex-wrap">

                    <span class="mr-2 text-uppercase font-weight-bold">Importance:</span>
                    <span class="d-flex justify-content-start gap-5 align-items-center">High <i
                            class="fas fa-circle text-high mr-2"></i></span>
                    <span class="d-flex justify-content-start gap-5 align-items-center">Medium <i
                            class="fas fa-circle text-medium mr-2"></i></span>

                    <span class="d-flex justify-content-start gap-5 align-items-center">Low <i
                            class="fas fa-circle text-low"></i></span>
                    <button type="submit" id="new_task" name="submit" class="create-tour-sec">New
                        Task</button>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead class="bg-first">
                            <tr>
                                <th>Task</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="taskList">

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4 custome_paginator"></div>
            </div>
        </div>
    </div>

    <!-- open tour section button -->
    <div class="modal fade upload-modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModallabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/reject.png') }}" class="task_title_img custompopicon"
                            alt="New Task"><span id="task_title">New Task</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body agent-tour">
                    <form method="post" id="task_form" action="#">
                        {{ csrf_field() }}
                        <div class="row" id="task_form_html">
                            <h4 id="task_desc">Are you sure you want to mark this Appointment as completed?</h4>
                        </div>

                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <div class="d-flex d-flex justify-content-between align-items-center gap-10">
                                        <div>
                                            <label for="exampleFormControlTextarea1" class="ml-2 showDateLabel"
                                                style="display: none;">Date Created:
                                                {{ \Carbon\Carbon::now()->format('d-m-Y') }}.
                                            </label>
                                            <input type="hidden" name="change_task_id" id="change_task_id">
                                        </div>
                                        <div class="d-flex justify-content-end gap-10 ">
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Yes</button>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close" id="cancel_button">No</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- open success popup model -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog"
        aria-labelledby="successModallabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id=""><img src="{{ asset('assets/dashboard/img/unblock.png') }}"
                            class="success_task_title_img" style="width:32px; margin-right:10px;" alt="New Task"><span
                            id="success_task_title">Task</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="py-4 text-center" id="success_form_html">
                        <h4 id="success_msg" class="custom_modal_text">Are you sure you want to mark this Appointment as
                            completed?</h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close" id="cancel_button">OK</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    

@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // calculate task summary
            let formData = $('#task_form').serialize();
            let actionUrl = '{{ route('viewer.dashboard.ajax-open-task') }}';
            callAjax(formData, actionUrl);

            $(".showDateLabel").hide();

            // Reusable click event
            $(document).on('click', '.create-tour-sec-dropdown, .create-tour-sec', function(e) {
                e.preventDefault();
                $(".showDateLabel").hide();

                let buttonId = $(this).attr('id');
                let taskId = $(this).data('id');
                let taskName = $(this).text();

                if (buttonId === 'new_task') {
                    $(".task_title_img").attr('src', "{{ asset('assets/dashboard/img/add-task.png') }}");
                    $('#task_title').text(taskName);
                    newTask();
                } else if (buttonId === 'edit_task') {
                    $(".task_title_img").attr('src', "{{ asset('assets/dashboard/img/edit-task.png') }}");
                    $('#task_title').text(taskName);
                    editTask(taskId);
                } else if (buttonId === 'view_task') {
                    $(".task_title_img").attr('src', "{{ asset('assets/dashboard/img/website.png') }}");
                    $('#task_title').text(taskName);
                    viewTask(taskId);
                } else if (buttonId === 'complete_task') {
                    $(".task_title_img").attr('src',
                        "{{ asset('assets/dashboard/img/complete-appointment.png') }}");
                    $('#task_title').text(taskName);
                    completeTask(taskId);
                }

                // Show modal
                if(buttonId!="complete_task"){
                    $('#taskModal').modal('show');
                }
                // $('#taskModal').modal('show');
            });

            $('#save_button').on('click', function(e) {
                e.preventDefault(); // prevent the default form submission
                let formData = $('#task_form').serialize();
                let actionUrl = $('#task_form').attr('action');
                callAjax(formData, actionUrl);
            });
        });

        $(document).on('click', '.toggle-task-form', function() {
            $(this).next('.task-form-body').slideToggle();
            $(this).toggleClass('open');

            let icon = $(this).find('i');
            if ($(this).hasClass('open')) {
                icon.removeClass('top-icon-bg fas fa-chevron-down fa-fw').addClass(
                    'top-icon-bg fas fa-chevron-up fa-fw');
            } else {
                icon.removeClass('top-icon-bg fas fa-chevron-up fa-fw').addClass(
                    'top-icon-bg fas fa-chevron-down fa-fw');
            }
        });

        function newTask() {
            let addNewTaskHtml = `
                <div class="mx-auto my-2 col-md-12">
                    <div class="form-group ">
                        <label for="title">Title<span class="text-danger">*</span> </label>
                        <input id="title" placeholder="Enter Title..." name="title" type="text"
                            class="form-control" required>
                    </div>
                    <div class="form-group pt-2 pb-3" data-i="">
                        <label for="exampleFormControlTextarea1">Importance<span class="text-danger">*</span>
                        </label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio1" value="high">
                            <label class="form-check-label" for="inlineRadio1">High</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio2" checked value="medium">
                            <label class="form-check-label"  for="inlineRadio2">Medium</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio3" value="low">
                            <label class="form-check-label" for="inlineRadio3">Low</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"> Task Description 
                        </label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"
                            placeholder="Up to 300 character"></textarea>
                    </div>
                </div>
            `;

            let addUrl = "{{ route('viewer.dashboard.ajax-add-task') }}";
            $('#task_form').attr('action', addUrl);

            $("#task_form_html").html(addNewTaskHtml);
            $("#save_button").show().text('Add');
            $("#cancel_button").text('Cancel');
            $(".showDateLabel").show();
        }

        function editTask(taskId) {
            let editNewTaskHtml = `
                <div class="col-md-12" style="cursor:pointer;">
                    <div class="task-form-body" style="display: block;">
                        <div class="form-group">
                            <input name="task_id" value="${taskId}" type="hidden">
                            <label for="title">Title<span class="text-danger">*</span> </label>
                            <input id="edit_title" placeholder="Enter Title..." name="title" type="text" class="form-control" required>
                        </div>
                        <div class="pt-2 pb-3">
                            <label>Importance<span class="text-danger">*</span></label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input task_priority" type="radio" name="task_priority" id="editinlineRadio1" value="high">
                                <label class="form-check-label" for="editinlineRadio1">High</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input task_priority" type="radio" name="task_priority" id="editinlineRadio2" value="medium" checked>
                                <label class="form-check-label" for="editinlineRadio2">Medium</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input task_priority" type="radio" name="task_priority" id="editinlineRadio3" value="low">
                                <label class="form-check-label" for="editinlineRadio3">Low</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select class="custom-select" name="status" id="edit_status">
                                <option value="open">Open</option>
                                <option value="inprogress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="5" placeholder="Up to 300 characters"></textarea>
                        </div>
                    </div>
                </div>
            `;

            $("#task_form_html").html(editNewTaskHtml);

            let formData = {
                'id': taskId
            };
            fetchAjaxEditData(formData);

            let updateUrl = "{{ route('viewer.dashboard.ajax-update-task') }}";
            $('#task_form').attr('action', updateUrl);

            $("#save_button").show().text('Update');
            $("#cancel_button").text('Cancel');
            $(".showDateLabel").show();
        }

        function fetchAllTaskData() {
            let fetchUrl = "{{ route('viewer.dashboard.ajax-fetch-task') }}";
            var formData = new FormData();
            $.ajax({
                url: fetchUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // alert('Task marked as completed successfully.');
                },
                error: function(xhr) {
                    // alert('Something went wrong. Please try again.');
                    showAlert("Task", 'Something went wrong. Please try again.', "error");
                }
            });
        }

        function fetchAjaxEditData(formData) {
            let editUrl = "{{ route('viewer.dashboard.ajax-edit-task') }}";

            $.ajax({
                url: editUrl,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.task) {
                        $("#edit_title").val(response.task.title);
                        $('input[name="task_priority"][value="' + response.task.priority + '"]').prop('checked',
                            true);
                        $("#edit_status").val(response.task.status);
                        $("#edit_description").text(response.task.description);
                    }
                },
                error: function(xhr) {
                    // alert('Something went wrong. Please try again.');
                    showAlert("Task", 'Something went wrong. Please try again.', "error");
                }
            });
        }

      async  function completeTask(taskId) {
            let formData = {
                'change_task_id': taskId
            };
            // let completeHtml =
            //     `<div class="text-center my-3 col-md-12"><h4 id="task_desc">Are you sure you want to mark selected tasks as completed?</h4></div>`;

            // $("#task_form_html").html(completeHtml);
            // $("#save_button").text('Yes').show();
            // $("#cancel_button").text('Cancel');

            let actionStatusUrl = "{{ route('viewer.dashboard.ajax-change-status') }}";
                
               if (await isConfirm({
                    'action': 'Complete',
                    'text': 'you want to mark selected tasks as completed?.'
                })) {
               callAjax(formData, actionStatusUrl);
            }
        }

        function viewTask(taskId) {
            let viewTaskHtml = `
                <div class="col-md-12" style="cursor:pointer;">
                   <div class="task-form-body" style="display: block;">
                        <div class="task-form-body p-2" style="display: block;">
                            <div class="form-group">
                                <input name="task_id" value="${taskId}" type="hidden">
                                <label for="title">Title<span class="text-danger">*</span> </label>
                                <input id="edit_title" readonly placeholder="Enter Title..." name="title" type="text" class="form-control" required>
                            </div>
                            <div class="pt-2 pb-3">
                                <label>Importance<span class="text-danger">*</span></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input task_priority" disabled type="radio" name="task_priority" id="editinlineRadio1" value="high">
                                    <label class="form-check-label" for="editinlineRadio1">High</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input task_priority" disabled type="radio" name="task_priority" id="editinlineRadio2" value="medium" checked>
                                    <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input task_priority" disabled type="radio" name="task_priority" id="editinlineRadio3" value="low">
                                    <label class="form-check-label" for="editinlineRadio3">Low</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status<span class="text-danger">*</span></label>
                                <select class="custom-select" disabled name="status" id="edit_status">
                                    <option value="open">Open</option>
                                    <option value="inprogress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" readonly id="edit_description" name="description" rows="5" placeholder="Up to 300 characters"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $("#task_form_html").html(viewTaskHtml);

            let formData = {
                'id': taskId
            };
            fetchAjaxEditData(formData);

            $("#save_button").hide();
            $("#cancel_button").text('Cancel');
        }

        function callAjax(formData, actionUrl) {
            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.task_name === 'open') {
                        $('.totalOpenTask').text(response.data.open);
                        $('.totalInprogressTask').text(response.data.inprogress);
                        $('.totalCompletedTask').text(response.data.completed);
                        return true;
                    }

                    if (response.task_name === 'add_task') {
                        loadTasks(1);
                        $('#taskModal').modal('hide');
                        // $("#success_msg").text('Task Added successfully.');
                        showAlert("Task", 'Task has been added successfully', "success");
                        // $('#successModal').modal('show');
                        return true;
                    }

                    if (response.task_name === 'update_task') {
                        loadTasks(1);
                        let openData = $('#task_form').serialize();
                        let openUrl = '{{ route('viewer.dashboard.ajax-open-task') }}';
                        callAjax(openData, openUrl);
                        $('#taskModal').modal('hide');
                        // $("#success_msg").text('Task Updated successfully.');
                        showAlert("Task", 'Task has been updated successfully', "success");
                        // $('#successModal').modal('show');
                        return true;
                    }

                    if (response.task_name === 'complete_task') {
                        loadTasks(1);
                        let openData = $('#task_form').serialize();
                        let openUrl = '{{ route('viewer.dashboard.ajax-open-task') }}';
                        callAjax(openData, openUrl);
                        $('#taskModal').modal('hide');
                        // $("#success_msg").text('Task has been marked as completed');
                        showAlert("Task", 'Task has been marked as completed', "success");
                        // $('#successModal').modal('show');
                        return true;
                    }
                },
                error: function(xhr) {
                    // alert('Something went wrong. Please try again.');
                    showAlert("Task", 'Something went wrong. Please try again.', "error");
                }
            });
        }

        // Initial load
        loadTasks(1);

        // handle pagination click
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            let page = $(this).data('page');
            if (page) {
                loadTasks(page);
            }
        });

        function loadTasks(page = 1) {
            let baseUrl = "{{ route('viewer.dashboard.ajax-fetch-task') }}" + '?page=' + page;
            $.ajax({
                url: baseUrl,
                type: 'GET',
                contentType: 'application/json',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    renderTasks(response.data.data);
                    renderPagination(response.data);
                },
                error: function(xhr) {}
            });
        }

        function renderTasks(tasks) {
            let html = '';

            $.each(tasks, function(index, task) {
                let statusLabel = task.status;
                if (task.status === 'inprogress') {
                    statusLabel = 'In Progress';
                } else if (task.status === 'open') {
                    statusLabel = 'Open';
                } else if (task.status === 'completed') {
                    statusLabel = 'Completed';
                }

                let priorityColor = 'text-high';
                if (task.priority === 'medium') {
                    priorityColor = 'text-medium';
                } else if (task.priority === 'low') {
                    priorityColor = 'text-low';
                }

                let checkboxId = 'task_checkbox_' + task.id;
                let taskId = task.id;
                let menuId = 'dropdownMenuLink_' + task.id;

                html += `
                    <tr>
                        <td class="task-color">
                            <label for="${checkboxId}" class="mb-0 cursor-pointer">
                            <i class="fas fa-circle ${priorityColor} taski mr-2"></i> ${task.title}
                            </label>
                        </td>
                        <td class="td-actions text-center">
                            <span class="custom_badge ${task.status_color_class || ''}">${statusLabel}</span>
                        </td>
                        <td class="theme-color text-center bg-white">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="${menuId}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="${menuId}">
                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="edit_task" data-id="${taskId}">
                                        <i class="fa fa-pen"></i> Edit Task
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="complete_task" data-id="${taskId}">
                                        <i class="fa fa-check-circle"></i> Complete Task
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="view_task" data-id="${taskId}">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });

            $('#taskList').html(html);
        }

        function renderPagination(data) {
            let pagination = `<nav><ul class="pagination">`;

            if (data.current_page > 1) {
                pagination +=
                    `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page - 1}"><i class="fa fa-angle-left"></i></a></li>`;
            } else {
                pagination +=
                    `<li class="page-item page-link border-0 text-muted" style="cursor: not-allowed;"><i class="fa fa-angle-left"></i></li>`;
            }

            for (let i = 1; i <= data.last_page; i++) {
                pagination += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                                <a href="#" class="page-link" data-page="${i}">${i}</a>
                            </li>`;
            }

            if (data.current_page < data.last_page) {
                pagination +=
                    `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page + 1}"><i class="fa fa-angle-right"></i></a></li>`;
            } else {
                pagination +=
                    `<li class="page-item page-link border-0 text-muted" style="cursor: not-allowed;"><i class="fa fa-angle-right"></i></li>`;
            }

            pagination += `</ul></nav>`;
            $('.custome_paginator').html(pagination);
        }
    </script>
@endpush
