@extends('layouts.agent')
@section('style')
    <style>
        .toggle-task-form {
            font-size: 16px;
            /* color: #007bff; */
            display: inline-block;
            margin: 20px 0px;
        }
        .task-1{
            width: clamp(50%, 8vw, 100%) !important;

        }
        @media (max-width:1024px){
            
            .task-1{
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
    </style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Appointment</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                            
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12 p-0">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="mb-2 row">
                        <div class="col-lg-12">
                           <div class="text-center small d-flex justify-content-end align-items-center gap-5 flex-wrap">
                                 
                              <span class="mr-2 text-uppercase font-weight-bold">Importance:</span>
                              <span class="d-flex justify-content-start gap-5 align-items-center">High <i class="fas fa-circle text-high mr-2"></i></span>
                              <span class="d-flex justify-content-start gap-5 align-items-center">Medium  <i class="fas fa-circle text-medium mr-2"></i></span>
                           
                              <span class="d-flex justify-content-start gap-5 align-items-center">Low <i class="fas fa-circle text-low"></i></span>
                              
                           </div>
                        </div>
                        <div class="col-md-12 d-flex align-items-center justify-content-between flex-wrap gap-5">
                           
                            <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-5">
                                <div class="total_listing">
                                    <div><span>In Progress Appointments : </span></div>
                                    <div><span class="totalInprogressTask">03</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Open Appointments : </span></div>
                                    <div><span class="totalOpenTask">11</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Completed Appointments : </span></div>
                                    <div><span class="totalCompletedTask">11</span></div>
                                </div>
                            </div>
                            
                            {{-- <button type="submit" id="edit_appointment" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Edit Task</button>
                                <button type="submit" id="complete_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Complete Task</button>--}}
                            {{-- <button type="submit" id="view_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">View Task</button> --}}
                            {{-- <button type="submit" id="open_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Open Task</button> --}}
                            <div class="text-center small d-flex justify-content-end align-items-center gap-5 flex-wrap">                                
                                <a href="{{ route('agent.view-planner') }}" class="btn-common text-white">View Planner</a>
                                <button type="submit" id="new_appointment" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">New Appointment</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="d-flex align-items-center mt-4 justify-content-between">
                        <label class="font-weight-bold mb-0">Task</label>
                        <div class="text-center ">
                            <label class="font-weight-bold mb-0" style="margin-left: 220px;">Status</label>
                        </div>
                        <div class="text-center">
                            <label class="font-weight-bold mb-0" style="margin-right: 35px">Action</label>
                        </div>
                    </div> --}}
                    {{-- $tasks --}}
                    <div class="card-body p-0 Dash-table task_table">
                        <div class="table-full-width table-responsive">
                            <table class="table table-bordered " >
                                <thead style="background-color: #0C223D; color: #ffffff;">
                                    <tr>
                                        <th>Appointment List</th>
                                        <th class="text-center">Map</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="taskList">
                                    
                                    {{-- @foreach ($tasks as $task)

                                        @php
                                            
                                            $taskBadgeColor = '#f6c23e ';
                                            if($task->status === 'inprogress'){
                                                $taskBadgeColor = '#4e73df ';
                                            }

                                            if($task->status === 'completed'){
                                                $taskBadgeColor = '#1cc88a';
                                            }

                                            $priorityColor = 'text-high';
                                            if($task->priority === 'medium'){
                                                $priorityColor = 'text-medium';
                                            }
                                            if($task->priority === 'low'){
                                                $priorityColor = 'text-low';
                                            }
                                            $checkboxId = 'task_checkbox_' . $task->id;
                                        @endphp
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label" for="{{ $checkboxId }}">
                                                        <input class="form-check-input" id="{{ $checkboxId }}" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color">
                                                <label for="{{ $checkboxId }}" class="mb-0 cursor-pointer">
                                                <i
                                                    class="fas fa-circle {{$priorityColor}} taski mr-2"></i>{{Str::title($task->title)}}
                                                </label></td>
                                            <td class="td-actions text-left border-0 ">
                                                <span class="badge badge-danger-lighten task-1" style="background: {{$taskBadgeColor}}; padding:5px 10px; max-width:120px; width:100%;">{{Str::title($task->status)}}</span>
                                            </td>
                                            <td class="theme-color  pr-0 bg-white" style="border: none;">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button"
                                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i
                                                            class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                        aria-labelledby="dropdownMenuLink" style="">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban">Delete</a>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-4 custome_paginator">
                            {{-- {!! $tasks->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!-- open tour section button -->
    <div class="modal fade upload-modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModallabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="" class="appointment_title_img" style="width:32px; margin-right:10px;" alt="New Task"><span id="task_title">New Task</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" id="task_form" action="#">
                        {{ csrf_field() }}
                        <div class="row" id="task_form_html">
                            <h4 id="task_desc">Are you sure you want to mark this Appointment as completed?</h4>
                        </div>

                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1" class="ml-2 showDateLabel"
                                        style="display: none;">Date Created: {{ \Carbon\Carbon::now()->format('d-m-Y') }}.
                                    </label>
                                    <input type="hidden" name="change_task_id" id="change_task_id">
                                    <button type="submit" class="btn-success-modal float-right ml-2 "
                                        id="save_button">Yes</button>
                                    <button type="button"
                                        class="btn-cancel-modal float-right ml-2"
                                        data-dismiss="modal" aria-label="Close" id="cancel_button">No</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- open success popup model -->
    <div class="modal fade upload-modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModallabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="success_task_title">Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                   <div class="py-4 text-center" id="success_form_html">
                        <h4 id="success_msg">Are you sure you want to mark this Appointment as completed?</h4>
                        <button type="button"
                    class="btn-success-modal mt-3 shadow-none"
                    data-dismiss="modal" aria-label="Close" id="cancel_button">OK</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade upload-modal" id="openMapmodal" tabindex="-1" aria-labelledby="openMapLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="openMapLabel"> <img src="{{ asset('assets/dashboard/img/viewmap.png') }}" style="width:40px; margin-right:10px;" alt="Request Rejected">View Map</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body p-0">
                <!-- Map Container -->
                <div id="mapContainer" style="width:100%; height:100%;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30812395.310645804!2d89.6021919586505!3d-19.486640622600035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2b2bfd076787c5df%3A0x538267a1955b1352!2sAustralia!5e0!3m2!1sen!2sin!4v1753341906368!5m2!1sen!2sin" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // calulcate task summery
            let formData = $('#task_form').serialize(); // serialize form data
            let actionUrl = '{{route("dashboard.ajax-open-task")}}';
            callAjax(formData, actionUrl);

            $(".showDateLabel").hide();
            // Reusable click event
            // $('.create-tour-sec').on('click', function(e) {
            $(document).on('click', '.create-tour-sec-dropdown, .create-tour-sec', function(e) {
                e.preventDefault();
                $(".showDateLabel").hide();

                let buttonId = $(this).attr('id');
                let taskId = $(this).data('id');
                let taskName = $(this).text();

                console.log('hell', buttonId);
                console.log('taskId ', taskId);


                if (buttonId == 'new_appointment') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/new-appointment.png') }}");
                    $('#task_title').text(taskName);
                    newAppointment();
                } else if (buttonId == 'view_planner') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/view-planner.png') }}");
                    $('#task_title').text(taskName);
                    viewPlanner(taskId);
                } else if (buttonId == 'reschedule_appointment') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/rescheduling-appoint.png') }}");
                    $('#task_title').text(taskName);
                    rescheduleAppointment(taskId);
                } else if (buttonId == 'edit_appointment') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/edit-appointment.png') }}");
                    $('#task_title').text(taskName);
                    editAppointment(taskId);
                } else if (buttonId == 'view_appointment') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/view-ppointment.png') }}");
                    $('#task_title').text(taskName);
                    viewAppointment(taskId);
                } else if (buttonId == 'complete_appointment') {
                    $(".appointment_title_img").attr('src', "{{ asset('assets/dashboard/img/complete-appointment.png') }}");
                    $('#task_title').text(taskName);
                    completeAppointment(taskId);
                } else if (buttonId == 'open_task') {
                    $('#task_title').text(taskName);
                    let formData = $('#task_form').serialize(); // serialize form data
                    let actionUrl = '{{route("dashboard.ajax-open-task")}}';
                    callAjax(formData, actionUrl);
                    openTask();
                } else {

                }

                // Show modal
                $('#taskModal').modal('show');
            });

            $('#save_button').on('click', function(e) {
                e.preventDefault(); // prevent the default form submission

                let formData = $('#task_form').serialize(); // serialize form data
                let actionUrl = $('#task_form').attr('action');  // let actionUrl = "{{ route('dashboard.ajax-add-task')}}";

                console.log(formData, actionUrl, ' jitemn');

                callAjax(formData, actionUrl);
                
            });

        });

        $(document).on('click', '.toggle-task-form', function() {
            $(this).next('.task-form-body').slideToggle();
            $(this).toggleClass('open');

            console.log('Toggle clicked');

            if ($(this).hasClass('open')) {
                $(this).find('i').removeClass('top-icon-bg fas fa-chevron-down fa-fw');
                $(this).find('i').addClass('top-icon-bg fas fa-chevron-up fa-fw');
                console.log('Toggle open');
            } else {
                $(this).find('i').removeClass('top-icon-bg fas fa-chevron-up fa-fw');
                $(this).find('i').addClass('top-icon-bg fas fa-chevron-down fa-fw');
                console.log('Toggle close');
            }
        });

        function newAppointment() {
            let addNewAppointHtml = `
                <div class="mx-auto my-2 col-md-11">

                    <!-- Date -->
                    <div class="form-group">
                        <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                        <input id="appointment_date" name="appointment_date" type="date" class="form-control" required>
                    </div>

                    <!-- Time -->
                    <div class="form-group">
                        <label for="appointment_time"><b>Time</b><span class="text-danger">*</span></label>
                        <input id="appointment_time" name="appointment_time" type="time" class="form-control" required>
                    </div>

                    <!-- Advertiser -->
                    <div class="form-group">
                        <label for="advertiser"><b>Advertiser</b><span class="text-danger">*</span></label>
                        <select id="advertiser" name="advertiser" class="form-control" required>
                            <option value="">Select Advertiser</option>
                            <!-- Populate dynamically from Agent's Advertiser List -->
                        </select>
                        <small class="form-text text-muted">Select from agent's advertiser list.</small>
                    </div>

                    <!-- Address with Google Maps integration -->
                <div class="form-group">
                    <label for="address"><b>Address</b><span class="text-danger">*</span></label>
                    <input id="address" name="address" type="text" class="form-control" placeholder="Search or enter address" required>
                    <small class="form-text text-muted">Start typing to search address or add manually.</small>

                    <!-- Hidden fields for latitude and longitude -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <!-- Google Map Preview -->
                    <div id="map" style="height: 250px; width: 100%; margin-top:10px; border: 1px solid #ccc; display:none;"></div>
                </div>

                    <!-- Point of Contact (Edit/View only) -->
                    <div class="form-group d-none" id="poc-field">
                        <label for="poc"><b>Point of Contact</b><span class="text-danger">*</span></label>
                        <input id="poc" name="poc" type="text" class="form-control" placeholder="Enter contact name">
                    </div>

                    <!-- Mobile (Edit/View only) -->
                    <div class="form-group d-none" id="mobile-field">
                        <label for="mobile"><b>Mobile</b></label>
                        <input id="mobile" name="mobile" type="tel" class="form-control" placeholder="Enter mobile number">
                    </div>

                    <!-- Appointment Summary (Edit/View only) -->
                    <div class="form-group d-none" id="summary-field">
                        <label for="summary"><b>Appointment Summary</b></label>
                        <textarea id="summary" name="summary" class="form-control" rows="3" maxlength="500"
                            placeholder="Enter summary (max 500 characters)"></textarea>
                    </div>

                    <!-- Source -->
                    <div class="form-group">
                        <label for="source"><b>Source</b><span class="text-danger">*</span></label>
                        <select id="source" name="source" class="form-control" required>
                            <option value="Database" style="color:red;" selected>Database</option>
                            <option value="Referral" style="color:orange;">Referral</option>
                            <option value="Cold" style="color:brown;">Cold</option>
                        </select>
                    </div>
                    <!-- Importance -->
                    <div class="pt-2 pb-3">
                        <label><b>Importance</b><span class="text-danger">*</span></label><br>
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

                    
                </div>

            `;

            let addUrl = "{{ route('dashboard.ajax-add-task')}}";
            $('#task_form').attr('action',addUrl); 

            $("#task_form_html").html(addNewAppointHtml);
            $("#save_button").show();
            $("#save_button").text('Add');
            $("#cancel_button").text('Cancel');
            $(".showDateLabel").show();
           
            console.log('hey new task');
        }

        function rescheduleAppointment() {
            let resAppointHtml = `
                <div class="mx-auto my-2 col-md-11">

                    <!-- Date -->
                    <div class="form-group">
                        <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                        <input id="appointment_date" name="appointment_date" type="date" class="form-control" required>
                    </div>

                    <!-- Time -->
                    <div class="form-group">
                        <label for="appointment_time"><b>Time</b><span class="text-danger">*</span></label>
                        <input id="appointment_time" name="appointment_time" type="time" class="form-control" required>
                    </div>

                   

                </div>

            `;

            let addUrl = "{{ route('dashboard.ajax-add-task')}}";
            $('#task_form').attr('action',addUrl); 

            $("#task_form_html").html(resAppointHtml);
            $("#save_button").show();
            $("#save_button").text('Reschedule');
            $("#cancel_button").text('Cancel');
            // $(".showDateLabel").show();
           
            console.log('hey new task');
        }
        function viewPlanner() {
            let viewPlannerHtml = `
                <div class="mx-auto my-2 col-md-11">
                    <!-- Planner Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4><b>View Planner</b></h4>
                        <div>
                            <button type="button" class="btn text-white btn-sm me-2 bgc-primary" id="prevBtn">← Previous</button>
                            <button type="button" class="btn btn-primary btn-sm" id="todayBtn" style="">Today</button>
                            <button type="button" class="btn text-white btn-sm ms-2 bgc-primary" id="nextBtn">Next →</button>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="row text-center mb-3">
                        <div class="col">
                            <div class="card shadow-sm p-2">
                                <h6>Appointments Today</h6>
                                <span id="summaryToday" class="fw-bold">0</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm p-2">
                                <h6>Appointments This Week</h6>
                                <span id="summaryWeek" class="fw-bold">0</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm p-2">
                                <h6>Appointments This Month</h6>
                                <span id="summaryMonth" class="fw-bold">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- View Switcher -->
                    <div class="d-flex justify-content-center mb-2">
                        <button  type="button" class="btn bgc-primary text-white mx-2 btn-sm me-1" data-view="day">Day</button>
                        <button  type="button" class="btn bgc-primary text-white mx-2 btn-sm me-1" data-view="week">Week</button>
                        <button  type="button" class="btn bgc-primary text-white mx-2 btn-sm" data-view="month">Month</button>
                    </div>

                    <!-- Planner Body -->
                    <div id="plannerBody" class="border rounded p-3" style="height:350px; overflow:auto;">
                        <!-- Dynamic Slots will render here -->
                    </div>
                </div>
            `;

            let addUrl = "{{ route('dashboard.ajax-add-task')}}";
            $('#task_form').attr('action', addUrl);

            $("#task_form_html").html(viewPlannerHtml);
            $("#save_button").hide(); 
            $("#cancel_button").text('Close');
            $(".showDateLabel").hide();

            // Load Default View (Day)
            loadPlannerView('day');

            console.log('Planner view loaded');
        }
        // Load Planner View
        let currentDate = new Date();

        function loadPlannerView(viewType) {
            let plannerBody = $('#plannerBody');
            plannerBody.empty();

            if (viewType === 'day') {
                loadDayView(plannerBody);
            } else if (viewType === 'week') {
                loadWeekView(plannerBody);
            } else if (viewType === 'month') {
                loadMonthView(plannerBody);
            }
        }

        function loadDayView(container) {
            let html = `<table class="table table-bordered text-center"><tbody>`;
            for (let hour = 8; hour <= 20; hour++) {
                for (let min of ['00', '30']) {
                    if (hour === 20 && min === '30') break;
                    let displayHour = hour > 12 ? hour - 12 : hour;
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    html += `
                        <tr>
                            <td style="width:100px;"><b>${displayHour}:${min} ${ampm}</b></td>
                            <td class="slot" data-time="${hour}:${min}"></td>
                        </tr>
                    `;
                }
            }
            html += `</tbody></table>`;
            container.html(html);
        }

        function loadWeekView(container) {
            let days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            let html = `<table class="table table-bordered text-center">
                <thead>
                    <tr><th>Time</th>`;
            days.forEach(d => html += `<th>${d}</th>`);
            html += `</tr></thead><tbody>`;
            
            for (let hour = 8; hour <= 20; hour++) {
                for (let min of ['00', '30']) {
                    if (hour === 20 && min === '30') break;
                    let displayHour = hour > 12 ? hour - 12 : hour;
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    html += `<tr><td><b>${displayHour}:${min} ${ampm}</b></td>`;
                    for (let i = 0; i < 7; i++) {
                        html += `<td class="slot" data-day="${days[i]}" data-time="${hour}:${min}"></td>`;
                    }
                    html += `</tr>`;
                }
            }
            html += `</tbody></table>`;
            container.html(html);
        }

        function loadMonthView(container) {
            let html = `<table class="table table-bordered text-center"><thead><tr>`;
            let days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            days.forEach(d => html += `<th>${d}</th>`);
            html += `</tr></thead><tbody>`;
            
            let firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            let lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
            let startDay = firstDay.getDay(); // Sunday=0
            if (startDay === 0) startDay = 7;
            
            let dateCounter = 1;
            for (let week = 0; week < 6; week++) {
                html += `<tr>`;
                for (let d = 1; d <= 7; d++) {
                    if ((week === 0 && d < startDay) || dateCounter > lastDay.getDate()) {
                        html += `<td></td>`;
                    } else {
                        html += `<td class="slot" data-date="${dateCounter}"><b>${dateCounter}</b><br></td>`;
                        dateCounter++;
                    }
                }
                html += `</tr>`;
            }
            html += `</tbody></table>`;
            container.html(html);
        }

        // Switch View Buttons
        $(document).on('click', '[data-view]', function() {
            let viewType = $(this).data('view');
            loadPlannerView(viewType);
        });

        function editAppointment(taskId) 
        {

            // let completeHtml =
            //     `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            // var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            // if (checkboxInputs.length === 0) {
            //     $("#task_form_html").html(completeHtml);
            //     $("#save_button").hide();
            //     $("#cancel_button").text('Cancel');
            //     return false;
            // }

            // console.log(checkboxInputs);
            console.log('checkboxInputs');

            let selectedTask = 1;
            let editnewAppointHtml = ``;
            // for (selectedTask; selectedTask <= checkboxInputs.length; selectedTask++) {
                editnewAppointHtml += `
                    <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                        <div class="col-md-12 card shadow-sm rounded-3">
                            <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10" style="background:#C2CFE0;">
                                <h6 class="mb-0 text-dark">Edit Appointment</h6>
                                <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                            </div>

                            <div class="task-form-body p-2" style="display: block; height:350px; overflow:auto;">
                                <!-- Hidden Task ID -->
                                <input name="task_id" value="`+taskId+`" type="hidden">

                            

                                <!-- Date -->
                                <div class="form-group">
                                    <label for="edit_date"><b>Date</b><span class="text-danger">*</span></label>
                                    <input id="edit_date" name="appointment_date" type="date" class="form-control" required>
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    <label for="edit_time"><b>Time</b><span class="text-danger">*</span></label>
                                    <input id="edit_time" name="appointment_time" type="time" class="form-control" required>
                                </div>

                                <!-- Advertiser -->
                                <div class="form-group">
                                    <label for="edit_advertiser"><b>Advertiser</b><span class="text-danger">*</span></label>
                                    <select id="edit_advertiser" name="advertiser" class="form-control" required>
                                        <option value="">Select Advertiser</option>
                                        <!-- Populate dynamically -->
                                    </select>
                                </div>

                                <!-- Address + Google Maps -->
                                <div class="form-group">
                                    <label for="edit_address"><b>Address</b><span class="text-danger">*</span></label>
                                    <input id="edit_address" name="address" type="text" class="form-control" placeholder="Search or enter address" required>
                                    <input type="hidden" id="edit_latitude" name="latitude">
                                    <input type="hidden" id="edit_longitude" name="longitude">
                                    <div id="edit_map" style="height: 250px; margin-top:10px; border: 1px solid #ccc;display:none;"></div>
                                </div>

                                <!-- Point of Contact -->
                                <div class="form-group">
                                    <label for="edit_poc"><b>Point of Contact</b><span class="text-danger">*</span></label>
                                    <input id="edit_poc" name="poc" type="text" class="form-control" placeholder="Enter contact name" required>
                                </div>

                                <!-- Mobile -->
                                <div class="form-group">
                                    <label for="edit_mobile"><b>Mobile</b></label>
                                    <input id="edit_mobile" name="mobile" type="tel" class="form-control" placeholder="Enter mobile number">
                                </div>

                                <!-- Appointment Summary -->
                                <div class="form-group">
                                    <label for="edit_summary"><b>Appointment Summary</b></label>
                                    <textarea id="edit_summary" name="summary" class="form-control" rows="3" maxlength="500" placeholder="Enter summary (max 500 characters)"></textarea>
                                </div>

                                <!-- Source -->
                                <div class="form-group">
                                    <label for="edit_source"><b>Source</b><span class="text-danger">*</span></label>
                                    <select id="edit_source" name="source" class="form-control" required>
                                        <option value="Database" style="color:red;">Database</option>
                                        <option value="Referral" style="color:orange;">Referral</option>
                                        <option value="Cold" style="color:brown;">Cold</option>
                                    </select>
                                </div>
                                <div class="pt-2 pb-3">
                                    <label><b>Importance</b><span class="text-danger">*</span></label><br>
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
                            
                            </div>
                        </div>
                    </div>

                `;
            // }

            $("#task_form_html").html(editnewAppointHtml);
            formData = {
                'id':taskId
            }
            let url = "{{route('dashboard.ajax-edit-task')}}";

            $editTaskData = fetchAjaxEditData(formData);

            let updateUrl = "{{ route('dashboard.ajax-update-task')}}";
            $('#task_form').attr('action',updateUrl); 

            $("#task_form_html").html(editnewAppointHtml);
            $("#save_button").show();
            $("#save_button").text('Update');
            $("#cancel_button").text('Cancel');
            $(".showDateLabel").show();
        }

        function fetchAllTaskData()
        {
            let fetchUrl = "{{ route('dashboard.ajax-fetch-task')}}";
            var formData = new from();
             $.ajax({
                url: fetchUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    // handle success
                    alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function fetchAjaxEditData(formData)
        {
            let editUrl = "{{ route('dashboard.ajax-edit-task')}}";

             $.ajax({
                url: editUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log(response)
                    console.log(response.task)
                    if(response.task){
                        $("#edit_title").val(response.task.title);
                        $('input[name="task_priority"][value="' + response.task.priority + '"]').prop('checked', true);
                        $("#edit_status").val(response.task.status);
                        $("#edit_description").text(response.task.description);
                    }
                    

                    // handle success
                    //alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        function completeAppointment(taskId) {
            // let completeHtml =
            //     `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            // var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            // if (checkboxInputs.length === 0) {
            //     $("#task_form_html").html(completeHtml);
            //     $("#save_button").hide();
            //     $("#cancel_button").text('Cancel');
            //     return false;
            // }

            let selectedTask = 1;
            let completedTaskIds = [];

            // for (selectedTask; selectedTask <= checkboxInputs.length; selectedTask++) {
                // let taskId = $(this).data('id');
                // if (taskId) {
                //     completedTaskIds.push(taskId);
                // }
            // }

            let formData = {
                'task_id': taskId,
            }

            completeHtml =
                `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc">Are you sure you want to mark selected appointment as completed?</h4></div>`;

            $("#task_form_html").html(completeHtml);
            $("#save_button").text('Yes');
            $("#save_button").show();
            $("#cancel_button").text('No');
            let actionStatusUrl = "{{route('dashboard.ajax-change-status')}}";

            console.log('actionStatusUrl');
            console.log(actionStatusUrl);
            $('#task_form').attr('action', actionStatusUrl)
            $("#change_task_id").val(taskId);
            //callAjax(formData, actionStatusUrl);


            // let formData = new FormData();
            // formData.append('task_ids', JSON.stringify(completedTaskIds)); //

            // completeHtml =
            //     `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc">Are you sure you want to mark all selected tasks as completed?</h4></div>`;

            // $("#task_form_html").html(completeHtml);
            // let actionUrl = "{{route('dashboard.ajax-change-status')}}";
            // $("#save_button").text('Yes');
            // $("#save_button").show();
            // $("#cancel_button").text('Cancel');

            // callAjax(formData, actionUrl);
        }

        function viewAppointment(taskId) {
            // let completeHtml =
            //     `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            // var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            // if (checkboxInputs.length === 0) {
            //     $("#task_form_html").html(completeHtml);
            //     $("#save_button").hide();
            //     $("#cancel_button").text('Cancel');
            //     return false; 
            // }

            // console.log(checkboxInputs.length, ' jite');
            let selectedTask = 1;
            let viewAppointmentHtml = ``;

            viewAppointmentHtml += `
                <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                    <div class="col-md-12 card shadow-sm rounded-3">
                        <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10" style="background:#C2CFE0;">
                            <h6 class="mb-0 text-dark">View Appointment</h6>
                            <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                        </div>

                        <div class="task-form-body p-2" style="display: block; height:350px; overflow:auto;">
                            <!-- Hidden Task ID -->
                            <input name="task_id" value="`+taskId+`" type="hidden">

                         

                            <!-- Date -->
                            <div class="form-group">
                                <label for="view_date"><b>Date</b><span class="text-danger">*</span></label>
                                <input id="view_date" name="appointment_date" type="date" class="form-control" required>
                            </div>

                            <!-- Time -->
                            <div class="form-group">
                                <label for="view_time"><b>Time</b><span class="text-danger">*</span></label>
                                <input id="view_time" name="appointment_time" type="time" class="form-control" required>
                            </div>

                            <!-- Advertiser -->
                            <div class="form-group">
                                <label for="view_advertiser"><b>Advertiser</b><span class="text-danger">*</span></label>
                                <select id="view_advertiser" name="advertiser" class="form-control" required>
                                    <option value="">Select Advertiser</option>
                                    <!-- Populate dynamically -->
                                </select>
                            </div>

                            <!-- Address + Google Maps -->
                            <div class="form-group">
                                <label for="view_address"><b>Address</b><span class="text-danger">*</span></label>
                                <input id="view_address" name="address" type="text" class="form-control" placeholder="Search or enter address" required>
                                <input type="hidden" id="view_latitude" name="latitude">
                                <input type="hidden" id="view_longitude" name="longitude">
                                <div id="view_map" style="height: 250px; margin-top:10px; border: 1px solid #ccc;display:none"></div>
                            </div>

                            <!-- Point of Contact -->
                            <div class="form-group">
                                <label for="view_poc"><b>Point of Contact</b><span class="text-danger">*</span></label>
                                <input id="view_poc" name="poc" type="text" class="form-control" placeholder="Enter contact name" required>
                            </div>

                            <!-- Mobile -->
                            <div class="form-group">
                                <label for="view_mobile"><b>Mobile</b></label>
                                <input id="view_mobile" name="mobile" type="tel" class="form-control" placeholder="Enter mobile number">
                            </div>

                            <!-- Appointment Summary -->
                            <div class="form-group">
                                <label for="view_summary"><b>Appointment Summary</b></label>
                                <textarea id="view_summary" name="summary" class="form-control" rows="3" maxlength="500" placeholder="Enter summary (max 500 characters)"></textarea>
                            </div>

                            <!-- Source -->
                            <div class="form-group">
                                <label for="view_source"><b>Source</b><span class="text-danger">*</span></label>
                                <select id="view_source" name="source" class="form-control" required>
                                    <option value="Database" style="color:red;">Database</option>
                                    <option value="Referral" style="color:orange;">Referral</option>
                                    <option value="Cold" style="color:brown;">Cold</option>
                                </select>
                            </div>
                            <div class="pt-2 pb-3">
                                <label><b>Importance</b><span class="text-danger">*</span></label><br>
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
                    </div>
                </div>

            `;

            $("#task_form_html").html(viewAppointmentHtml);
            formData = {
                'id':taskId
            }
            let url = "{{route('dashboard.ajax-edit-task')}}";

            $viewTaskData = fetchAjaxEditData(formData);
            $("#save_button").text('Print');
            $("#save_button").show();
            $("#cancel_button").text('close');
        }

        function openTask(openData) {

            let openHtml = `<div class="col-md-11 mx-auto my-3">
                <div class="card shadow-sm  rounded-3">
                    <div class="card-header text-white" style="background:#C2CFE0;">
                        <h5 class="mb-0 text-dark" >Task Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <strong>Open Tasks:</strong>
                            <span class="badge text-light bg-warning fs-6 p-1 totalOpenTask" >20</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <strong>In Progress Tasks:</strong>
                            <span class="badge bg-primary text-light fs-6 p-1 totalInprogressTask" >30</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <strong>Completed Tasks:</strong>
                            <span class="badge bg-success text-light fs-6 p-1 totalCompletedTask" >20</span>
                        </div>
                    </div>
                </div>
            </div>`;

            $("#task_form_html").html(openHtml);
            //$("#save_button").text('Yes');
            $("#save_button").hide();
            $("#cancel_button").text('Cancel');
        }

        function callAjax(formData, actionUrl) {
            $.ajax({
                url: actionUrl, // form action URL
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log(response);
                    // console.log('response');

                    if(response.task_name == 'open'){
                        $('.totalOpenTask').text(response.data.open);
                        $('.totalInprogressTask').text(response.data.inprogress);
                        $('.totalCompletedTask').text(response.data.completed);
                        return true;
                    }

                    if(response.task_name == 'add_task'){
                        loadTasks(1);
                        $('#taskModal').modal('hide');
                        $("#success_msg").text('Task Added sucessfully.');
                        $('#successModal').modal('show');
                        return true;
                    }

                    if(response.task_name == 'update_task'){
                        loadTasks(1);
                        let formData = $('#task_form').serialize(); // serialize form data
                        let actionUrl = '{{route("dashboard.ajax-open-task")}}';
                        callAjax(formData, actionUrl);
                        $('#taskModal').modal('hide');
                        $("#success_msg").text('Task Updated sucessfully.');
                        $('#successModal').modal('show');
                        return true;
                    }

                    if(response.task_name == 'complete_appointment'){
                        loadTasks(1);
                        $('#taskModal').modal('hide');
                        // calulcate task summery
                        let formData = $('#task_form').serialize(); // serialize form data
                        let actionUrl = '{{route("dashboard.ajax-open-task")}}';
                        callAjax(formData, actionUrl);
                        $('#taskModal').modal('hide');
                        $("#success_msg").text('Task has been mark as completed');
                        $('#successModal').modal('show');
                        return true;
                    }

                    //alert('Task marked as completed successfully.');
                    // Optionally close modal or reset form
                },
                error: function(xhr) {
                    // handle error
                    alert('Something went wrong. Please try again.');
                }
            });
        }

        // $(document).ready(function () {
            loadTasks(1);

            // handle pagination click
            $(document).on('click', '.page-link', function (e) {
                e.preventDefault();
                let page = $(this).data('page');
                loadTasks(page);
            });

            function loadTasks(page = 1) {
               let baseUrl = "{{ route('dashboard.ajax-fetch-task') }}"+'?page='+page;
                 $.ajax({
                    url: baseUrl, // form action URL
                    type: 'GET',
                    contentType: 'application/json',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        console.log(response, response.data)
                        console.log('response, response.data.data')
                        
                        renderTasks(response.data.data); 
                        renderPagination(response.data);  
                    },
                    error: function(xhr) {
                        // handle error
                        //alert('Something went wrong. Please try again.');
                    }
                });
            }

            function renderTasks(tasks) {
               
                let html = '';
                var taskBadgeColor = '#9d1d08 ';
                var priorityColor = 'text-high';

                $.each(tasks, function (index, task) {

                    if(task.status == 'inprogress'){
                        taskBadgeColor = '#4e73df ';
                    }

                    if(task.status == 'completed'){
                        taskBadgeColor = '#1cc88a';
                    }

                    
                    if(task.priority == 'medium'){
                        priorityColor = 'text-medium';
                    }
                    if(task.priority === 'low'){
                        priorityColor = 'text-low';
                    }
                    let checkboxId = 'task_checkbox_' + task.id;
                    let taskId = task.id;

                    html += `<tr>
                    <!-- ye check box hai main comment kar rakha hai-->
                         <!-- <td class=" pr-0">
                            <div class="form-check m-0 p-0">
                                <label class="form-check-label" for="`+checkboxId+`">
                                    <input class="form-check-input" name="task_ids" data-id="`+taskId+`" id="`+checkboxId+`" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </td>-->
                        <td class=" task-color">
                            <label for="`+checkboxId+`" class="mb-0 cursor-pointer">
                            <i
                                class="fas fa-circle `+priorityColor+` taski mr-2"></i>`+task.title+`
                            </label> <small class="text-muted"> ( 09:30 am | 27-07-2025 ) </small></td>
                        <td class='text-center' data-toggle="modal" data-target="#openMapmodal"> <img src="{{ asset('assets/dashboard/img/map.png')}}" style="width:45px; padding-right:10px;cursor:pointer" title="view Location"> </td>    
                        <td class="td-actions text-center ">
                            <span class="badge badge-danger-lighten task-1" style="background: `+taskBadgeColor+`; padding:5px 10px; max-width:120px; width:100%;">`+task.status+`</span>
                        </td>
                        <td class="theme-color text-center bg-white ">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i
                                        class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink" style="">
                                         <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="edit_appointment" data-id=`+taskId+`> <i class="fa fa-pen"></i>Edit Appointment</a>
                                        
                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="reschedule_appointment" data-id=`+taskId+`> <i class="fa fa-calendar"></i>Reschedule Appointment</a>
                                        
                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="complete_appointment" data-id=`+taskId+`> <i class="fa fa-check-circle"></i>Completed Appointment</a>
                                        
                                        <div class="dropdown-divider"></div>
                                         <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown" href="#" id="view_appointment" data-id=`+taskId+`> <i class="fa fa-eye"></i>View Appointment</a>
                                    
                                </div>
                            </div>
                        </td>
                    </tr>`;
                });
                
                $('#taskList').html(html);
            }

            function renderPagination(data) {
                let pagination = `<nav><ul class="pagination">`;

                if (data.current_page > 1) {
                    pagination += `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page - 1}"><i class="fa fa-angle-left"></i></a></li>`;
                }else{
                    pagination += `<li class="page-item page-link">Previous</li>`;
                }

                for (let i = 1; i <= data.last_page; i++) {
                    pagination += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                        <a href="#" class="page-link" data-page="${i}">${i}</a>
                    </li>`;
                }

                if (data.current_page < data.last_page) {
                    pagination += `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page + 1}"><i class="fa fa-angle-right"></i></a></li>`;
                }else{
                    pagination += `<li class="page-item page-link">Next</li>`;
                }

                pagination += `</ul></nav>`;
                $('.custome_paginator').html(pagination);
            }
        // });
    </script>
@endsection
