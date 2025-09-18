@extends('layouts.agent')
@section('style')
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

        .pac-container {
             z-index: 2000 !important; 
        }

        li.parsley-required {
         list-style: none;
        }
        .parsley-errors-list{
            padding-left: 0px;
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
                                <span class="d-flex justify-content-start gap-5 align-items-center">High <i
                                        class="fas fa-circle text-high mr-2"></i></span>
                                <span class="d-flex justify-content-start gap-5 align-items-center">Medium <i
                                        class="fas fa-circle text-medium mr-2"></i></span>

                                <span class="d-flex justify-content-start gap-5 align-items-center">Low <i
                                        class="fas fa-circle text-low"></i></span>

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
                            <div class="text-center small d-flex justify-content-end align-items-center gap-5 flex-wrap">
                                <a href="{{ route('agent.view-planner') }}" class="btn-common text-white">View Planner</a>
                                <button type="button" class="btn-common" data-toggle="modal" id="new_appointment">New
                                    Appointment</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 Dash-table task_table">
                        <div class="table-full-width table-responsive">
                            <table class="table table-bordered " id="taskList">
                                <thead style="background-color: #0C223D; color: #ffffff;">
                                    <tr>
                                        <th>Appointment List</th>
                                        <th class="text-center">Map</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
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
    <!-- New appointment Popup -->
    <div class="modal fade upload-modal" id="new_appointment_model" tabindex="-1" role="dialog"
        aria-labelledby="new_appointmentlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/new-appointment.png') }}"
                            alt="New Appointment" class="custompopicon"> New Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form id="newAppointmentForm" method="post" action="{{ route('agent.appointments.store') }}" data-parsley-validate>
                        @csrf
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <!-- Advertiser -->
                                <div class="form-group">
                                    <label for="advertiser"><b>Advertiser</b><span class="text-danger">*</span></label>
                                    <select id="new_advertiser" name="new_advertiser" class="form-control" required>
                                        <option value="">Select Advertiser</option>
                                    </select>
                                    <small class="form-text text-muted">Select from agent's advertiser list.</small>
                                </div>

                                <!-- Date -->
                                <div class="form-group">
                                    <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                                    <input 
                                        id="new_appointment_date" 
                                        name="new_appointment_date" 
                                        type="date"
                                        class="form-control" 
                                        required
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                       
                                    >
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    <label for="appointment_time"><b>Time Slot</b><span class="text-danger">*</span></label>
                                    <select id="new_appointment_time_slot" name="new_appointment_time_slot" class="form-control" required>
                                        <option value="">Select Time Slot</option>
                                    </select>
                                </div>



                                <!-- Address with Google Maps integration -->
                                <div class="form-group">
                                    <label for="address"><b>Address</b><span class="text-danger">*</span></label>
                                    <input id="new_address" name="new_address" type="text" class="form-control"
                                        placeholder="Search or enter address" required>
                                    <small class="form-text text-muted">Start typing to search address or add
                                        manually.</small>

                                    <!-- Hidden fields for latitude and longitude -->
                                    <input type="hidden" id="new_latitude" name="new_latitude">
                                    <input type="hidden" id="new_longitude" name="new_longitude">

                                    <!-- Google Map Preview -->
                                    <div id="map"
                                        style="height: 250px; width: 100%; margin-top:10px; border: 1px solid #ccc; display:none;">
                                    </div>
                                </div>

                              
                                <!-- Source -->
                                <div class="form-group">
                                    <label for="source"><b>Source</b><span class="text-danger">*</span></label>
                                    <select id="new_source" name="new_source" class="form-control" required>
                                        <option value="database" style="color:red;" selected>Database</option>
                                        <option value="referral" style="color:orange;">Referral</option>
                                        <option value="cold" style="color:brown;">Cold</option>
                                    </select>
                                </div>
                                <!-- Importance -->
                                <div class="pt-2 pb-3">
                                    <label><b>Importance</b><span class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio"
                                            name="new_task_priority" value="high">
                                        <label class="form-check-label" for="editinlineRadio1">High</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio"
                                            name="new_task_priority" value="medium" checked>
                                        <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio"
                                            name="new_task_priority" value="low">
                                        <label class="form-check-label" for="editinlineRadio3">Low</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="m-0">Date Created: {{ date('m-d-Y') }}.</p>
                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                            <button type="submit" class="btn-success-modal">Add</button>
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
    {{-- end --}}



    <!-- Reschedule Appointment Popup -->
    <div class="modal fade upload-modal" id="reschedule_appointment" tabindex="-1" role="dialog"
        aria-labelledby="reschedule_appointmentlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/rescheduling-appoint.png') }}"
                            alt="Reschedule Appointment" class="custompopicon"> Reschedule Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <!-- Date -->
                                <div class="form-group">
                                    <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                                    <input id="appointment_date" name="appointment_date" type="date"
                                        class="form-control" required="">
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    <label for="appointment_time"><b>Time</b><span class="text-danger">*</span></label>
                                    <input id="appointment_time" name="appointment_time" type="time"
                                        class="form-control" required="">
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="m-0">Date Created: 02-09-2025.</p>
                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                            <button type="submit" class="btn-success-modal">Reschedule</button>
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
    {{-- end --}}

    <!-- Completed Appointment Popup -->
    <div class="modal fade upload-modal" id="complete_appointment" tabindex="-1" role="dialog"
        aria-labelledby="complete_appointmentlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/complete-appointment.png') }}"
                            alt="Completed Appointment" class="custompopicon"> Completed Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <h4 id="task_desc">Are you sure you want to mark selected appointment as completed?</h4>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-end">

                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close">No</button>
                                            <button type="submit" class="btn-success-modal">Yes</button>
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
    {{-- <input id="new_oneaddress" name="new_oneaddress" type="text" class="form-control"  > --}}
    
   
    {{-- end --}}

    <!-- Edit appointment Popup -->
    <div class="modal fade upload-modal" id="edit_appointment" tabindex="-1" role="dialog"
        aria-labelledby="edit_appointmentlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/edit-appointment.png') }}"
                            alt="New Appointment" class="custompopicon"> Edit Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#" id="editAppointmentForm" data-parsley-validate>
                        <div class="row" id="task_form_button">
                            <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                                <div class="col-md-12 card shadow-sm rounded-3">
                                    <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10"
                                        style="background:#C2CFE0;">
                                        <h6 class="mb-0 text-dark">Edit Appointment</h6>
                                        <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                                    </div>

                                    <div class="task-form-body p-2" style="display: block; height:350px; overflow:auto;">
                                        <!-- Hidden Task ID -->

                                        <!-- Advertiser -->
                                        <div class="form-group">
                                            <label for="edit_advertiser"><b>Advertiser</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="edit_advertiser" name="advertiser" class="form-control" required>
                                                <option value="">Select Advertiser</option>
                                                <!-- Populate dynamically -->
                                            </select>
                                        </div>

                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="edit_date"><b>Date</b><span class="text-danger">*</span></label>
                                            <input id="edit_date" name="appointment_date" type="date"
                                                class="form-control" required>
                                        </div>

                                        <!-- Time Slot -->
                                        <div class="form-group">
                                            <label for="edit_appointment_time_slot"><b>Time Slot</b><span class="text-danger">*</span></label>
                                            <select id="edit_appointment_time_slot" name="appointment_time" class="form-control" required>
                                                <option value="">Select Time Slot</option>
                                            </select>
                                        </div>

                                        

                                        <!-- Address + Google Maps -->
                                        <div class="form-group">
                                            <label for="edit_address"><b>Address</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="edit_address" name="address" type="text" class="form-control"
                                                placeholder="Search or enter address" required>
                                            <input type="hidden" id="edit_latitude" name="latitude">
                                            <input type="hidden" id="edit_longitude" name="longitude">
                                            <div id="edit_map"
                                                style="height: 250px; margin-top:10px; border: 1px solid #ccc;display:none;">
                                            </div>
                                        </div>

                                        <!-- Point of Contact -->
                                        <div class="form-group">
                                            <label for="edit_poc"><b>Point of Contact</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="edit_poc" name="poc" type="text" class="form-control"
                                                placeholder="Enter contact name" required>
                                        </div>

                                        <!-- Mobile -->
                                        <div class="form-group">
                                            <label for="edit_mobile"><b>Mobile</b></label>
                                            <input id="edit_mobile" name="mobile" type="tel" class="form-control"
                                                placeholder="Enter mobile number">
                                        </div>

                                        <!-- Appointment Summary -->
                                        <div class="form-group">
                                            <label for="edit_summary"><b>Appointment Summary</b></label>
                                            <textarea id="edit_summary" name="summary" class="form-control" rows="3" maxlength="500"
                                                placeholder="Enter summary (max 500 characters)"></textarea>
                                        </div>

                                        <!-- Source -->
                                        <div class="form-group">
                                            <label for="edit_source"><b>Source</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="edit_source" name="source" class="form-control" required>
                                                <option value="Database" style="color:red;">Database</option>
                                                <option value="Referral" style="color:orange;">Referral</option>
                                                <option value="Cold" style="color:brown;">Cold</option>
                                            </select>
                                        </div>
                                        <div class="pt-2 pb-3">
                                            <label><b>Importance</b><span class="text-danger">*</span></label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="high">
                                                <label class="form-check-label" for="editinlineRadio1">High</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="medium" checked>
                                                <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="low">
                                                <label class="form-check-label" for="editinlineRadio3">Low</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="m-0">Date Created: <span id="edit_date_created_text">--</span>.</p>
                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close">Cancel</button>
                                            <button type="submit" class="btn-success-modal">Update</button>
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
    {{-- end --}}

    <!-- View Appointment Popup -->
    <div class="modal fade upload-modal" id="view_appointment" tabindex="-1" role="dialog"
        aria-labelledby="view_appointmentlabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> <img src="{{ asset('assets/dashboard/img/view-ppointment.png') }}"
                            alt="New Appointment" class="custompopicon"> View Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <div class="row" id="task_form_button">
                            <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                                <div class="col-md-12 card shadow-sm rounded-3">
                                    <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10"
                                        style="background:#C2CFE0;">
                                        <h6 class="mb-0 text-dark">View Appointment</h6>
                                        <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                                    </div>

                                    <div class="task-form-body p-2" style="display: block; height:350px; overflow:auto;">
                                        <!-- Hidden Task ID -->
                                        <input name="task_id" value="31" type="hidden">



                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="view_date"><b>Date</b><span class="text-danger">*</span></label>
                                            <input id="view_date" name="appointment_date" type="date"
                                                class="form-control" required="">
                                        </div>

                                        <!-- Time -->
                                        <div class="form-group">
                                            <label for="view_time"><b>Time</b><span class="text-danger">*</span></label>
                                            <input id="view_time" name="appointment_time" type="time"
                                                class="form-control" required="">
                                        </div>

                                        <!-- Advertiser -->
                                        <div class="form-group">
                                            <label for="view_advertiser"><b>Advertiser</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="view_advertiser" name="advertiser" class="form-control"
                                                required="">
                                                <option value="">Select Advertiser</option>
                                                <!-- Populate dynamically -->
                                            </select>
                                        </div>

                                        <!-- Address + Google Maps -->
                                        <div class="form-group">
                                            <label for="view_address"><b>Address</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="view_address" name="address" type="text" class="form-control"
                                                placeholder="Search or enter address" required="">
                                            <input type="hidden" id="view_latitude" name="latitude">
                                            <input type="hidden" id="view_longitude" name="longitude">
                                            <div id="view_map"
                                                style="height: 250px; margin-top:10px; border: 1px solid #ccc;display:none">
                                            </div>
                                        </div>

                                        <!-- Point of Contact -->
                                        <div class="form-group">
                                            <label for="view_poc"><b>Point of Contact</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="view_poc" name="poc" type="text" class="form-control"
                                                placeholder="Enter contact name" required="">
                                        </div>

                                        <!-- Mobile -->
                                        <div class="form-group">
                                            <label for="view_mobile"><b>Mobile</b></label>
                                            <input id="view_mobile" name="mobile" type="tel" class="form-control"
                                                placeholder="Enter mobile number">
                                        </div>

                                        <!-- Appointment Summary -->
                                        <div class="form-group">
                                            <label for="view_summary"><b>Appointment Summary</b></label>
                                            <textarea id="view_summary" name="summary" class="form-control" rows="3" maxlength="500"
                                                placeholder="Enter summary (max 500 characters)"></textarea>
                                        </div>

                                        <!-- Source -->
                                        <div class="form-group">
                                            <label for="view_source"><b>Source</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="view_source" name="source" class="form-control" required="">
                                                <option value="Database" style="color:red;">Database</option>
                                                <option value="Referral" style="color:orange;">Referral</option>
                                                <option value="Cold" style="color:brown;">Cold</option>
                                            </select>
                                        </div>
                                        <div class="pt-2 pb-3">
                                            <label><b>Importance</b><span class="text-danger">*</span></label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="high">
                                                <label class="form-check-label" for="editinlineRadio1">High</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="medium" checked="">
                                                <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" value="low">
                                                <label class="form-check-label" for="editinlineRadio3">Low</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-end">

                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close">Close</button>
                                            <button type="submit" class="btn-success-modal">Print</button>
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
    {{-- end --}}

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


    <!-- map view popup -->
    <div class="modal fade upload-modal" id="openMapmodal" tabindex="-1" aria-labelledby="openMapLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="openMapLabel"> <img
                            src="{{ asset('assets/dashboard/img/viewmap.png') }}" style="width:40px; margin-right:10px;"
                            alt="Request Rejected">View Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-0">
                    <!-- Map Container -->
                    <div id="mapContainer" style="width:100%; height:100%;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30812395.310645804!2d89.6021919586505!3d-19.486640622600035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2b2bfd076787c5df%3A0x538267a1955b1352!2sAustralia!5e0!3m2!1sen!2sin!4v1753341906368!5m2!1sen!2sin"
                            width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>

            </div>
        </div>
    </div>


    <div id="manage-route"
    data-get-adverser="{{ route('get.adverser') }}"
    data-get-slot-list="{{ route('get.slot.list') }}"
    data-save-appointment="{{ route('agent.appointments.store') }}"
    data-scrf-token="{{csrf_token()}}"
    data-success-image="{{ asset('assets/dashboard/img/unblock.png') }}"
    data-error-image="{{ asset('assets/dashboard/img/alert.png') }}"
    data-show-appointment="{{ route('agent.appointments.show', ['id' => '__ID__']) }}"
    data-update-appointment="{{ route('agent.appointments.update', ['id' => '__ID__']) }}"
    data-reschedule-appointment="{{ route('agent.appointments.reschedule', ['id' => '__ID__']) }}"
    data-complete-appointment="{{ route('agent.appointments.complete', ['id' => '__ID__']) }}"
     >
    @endsection
    @section('script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google_map.api_key')}}&libraries=places&callback=initAutocomplete"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

    <script>
    // Generic Google Places Autocomplete initializer
    function initPlacesAutocomplete(inputId, latId, lngId) {
        try {
            var input = document.getElementById(inputId);
            if (!input || !window.google || !google.maps || !google.maps.places) { return; }
            if (input.getAttribute('data-gpa-init') === '1') { return; }
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['address'],
                fields: ['geometry']
            });
            input.setAttribute('data-gpa-init', '1');
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (place && place.geometry && place.geometry.location) {
                    var latEl = document.getElementById(latId);
                    var lngEl = document.getElementById(lngId);
                    if (latEl) { latEl.value = place.geometry.location.lat(); }
                    if (lngEl) { lngEl.value = place.geometry.location.lng(); }
                }
            });
        } catch (e) {
            console.error('Places autocomplete init error', e);
        }
    }
    // Google script callback - initialize for New Appointment field by default
    function initAutocomplete() {
        initPlacesAutocomplete('new_address', 'new_latitude', 'new_longitude');
    }
    $(document).ready(function() {
        const mmRoot = $('#manage-route');
        endpoint = {
            get_adverser: mmRoot.data('get-adverser'),
            get_slot_list: mmRoot.data('get-slot-list'),
            save_appointment: mmRoot.data('save-appointment'),
            csrf_token: mmRoot.data('scrf-token'),
            success_image : mmRoot.data('success-image'),
            error_image : mmRoot.data('error-image'),
            show_tpl: mmRoot.data('show-appointment'),
            update_tpl: mmRoot.data('update-appointment'),
            reschedule_tpl: mmRoot.data('reschedule-appointment'),
            complete_tpl: mmRoot.data('complete-appointment'),
            
        }
        function urlFor(tpl, id){ return (tpl || '').replace('__ID__', id); }
        // get Advertiser List data and append inside the option list
        $('#new_appointment').on('click', function() {
            initAutocomplete();
            $('#new_appointment_model').modal('show');
            ajaxRequest(endpoint.get_adverser, {}, 'GET',null , successPopulateAdvisorDropdown,  errorPopulateAdvisorDropdown);
        });

        // Initialize autocomplete after modal is visible (ensures input has size)
        $('#new_appointment_model').on('shown.bs.modal', function() {
            if (typeof google !== 'undefined' && google.maps && google.maps.places) {
                initPlacesAutocomplete('new_address', 'new_latitude', 'new_longitude');
            }
           // $('#new_address').trigger('focus');
        });

        // Initialize Edit autocomplete after modal is visible
        $('#edit_appointment').on('shown.bs.modal', function() {
            if (typeof google !== 'undefined' && google.maps && google.maps.places) {
                initPlacesAutocomplete('edit_address', 'edit_latitude', 'edit_longitude');
            }
           // $('#edit_address').trigger('focus');
        });

        function successPopulateAdvisorDropdown(response, targetSelector = '#new_advertiser', selectedId = null) {
            let dropdown = $(targetSelector);
            dropdown.empty().append('<option value="">Select Advisor</option>');
            if (response && response.data && Array.isArray(response.data)) {
                response.data.forEach(function(advisor) {
                    let displayText = advisor.name ? advisor.name + ' (' + advisor.member_id + ')' : advisor.member_id;
                    dropdown.append(`<option value="${advisor.id}">${displayText}</option>`);
                });
            }
            if (selectedId !== null && selectedId !== undefined) {
                dropdown.val(String(selectedId));
            }
        }
        // Error: Handle failure
        function errorPopulateAdvisorDropdown(xhr, status, error, targetSelector = '#new_advertiser') {
            let dropdown = $(targetSelector);
            dropdown.empty().append('<option >Something is worng!!</option>');
            console.error("❌ AJAX Error:", status, error);
        }

     
        //Advisor on change
        $('#new_advertiser, #new_appointment_date').on('change', function() {
            let advertiserId = $('#new_advertiser').val();
            let date = $('#new_appointment_date').val();
            if (advertiserId && date) {
                ajaxRequest(endpoint.get_slot_list + `?advertiser_id=${encodeURIComponent(advertiserId)}&date=${encodeURIComponent(date)}`, {}, 'GET', null, successPopulateTimeSlot, errorResponseForNewAppointment);
            }
        });

        function successPopulateTimeSlot(response, targetSelector = '#new_appointment_time_slot', selectedValue = null, opts = { appendMissing: false }) {
            const dropdown = $(targetSelector);
            dropdown.empty().append('<option value="">Select Time Slot</option>');
            if (response && response.data && Array.isArray(response.data)) {
                response.data.forEach(function(slot) {
                    dropdown.append(`<option value="${slot}">${slot}</option>`);
                });
            }
            if (selectedValue !== null && selectedValue !== undefined) {
                dropdown.val(String(selectedValue));
            }
        }

        let table = $('#taskList').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            
            ajax: {
                url: "{{ route('agent.appointments.datatable') }}",
                type: 'GET'
            },
            columns: [
                { data: 'appointment_list', name: 'appointment_list' },
                { data: 'map', name: 'map', orderable: false, searchable: false, className: 'text-center' },
                { data: 'status_badge', name: 'status', orderable: true, searchable: true, className: 'text-center' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' },
            ]
        });

        function ajaxRequest(url, data = {}, method = 'GET', token = null, successCallback = null, errorCallback = null) {
            $.ajax({
                url: url,
                type: method,
                _token: token,
                dataType: 'json',
                data: data,
                success: function(response) {
                    if (typeof successCallback === 'function') {
                        successCallback(response);
                    }
                },
                error: function(xhr, status, error) {
                    if (typeof errorCallback === 'function') {
                        errorCallback(xhr, status, error);
                    } else {
                        console.log('Ajax Error', status, error);
                    }
                }
            });
        }

        // Open map modal with row address
        $(document).on('click', '#taskList tbody td:nth-child(2) [data-toggle="modal"]', function(){
            var addr = $(this).find('.address-text').text() || '';
            if (addr) {
                var enc = encodeURIComponent(addr);
                $('#openMapmodal iframe').attr('src', 'https://www.google.com/maps?q='+enc+'&output=embed');
            }
        });

        // Submit New Appointment via AJAX with Parsley validation
        $('#newAppointmentForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            if (!form.parsley().isValid()) {
                form.parsley().validate();
                return;
            }
            ajaxRequest(endpoint.save_appointment, form.serialize(), 'POST', endpoint.csrf_token, successAppointmentCreate, errorAppointmentCreate);
        });

        function successAppointmentCreate(request){
            $('#success_msg').text(request.message || 'Saved successfully');
            $('#success_task_title').text('Success');
            $("#image_icon").attr("src", endpoint.success_image);
            $('#newAppointmentForm')[0].reset(); 
            $('#new_appointment_model').modal('hide');
                $('#successModal').modal('show');
                setTimeout(function(){ $('#successModal').modal('hide'); }, 2000);
        }

        function errorAppointmentCreate(xhr, status, error){
            let msg = 'Something went wrong';
            if (xhr.responseJSON && xhr.responseJSON.message) { msg = xhr.responseJSON.message; }
            $("#image_icon").attr("src", endpoint.error_image);
            $('#success_task_title').text('Error');
            $('#success_msg').text(msg);
            $('#successModal').modal('show');
            
        }

        // Action dropdown handlers
        var currentAppointmentId = null;
        $(document).on('click', '[data-target="#edit_appointment"][data-toggle="modal"]', function(){
            currentAppointmentId = $(this).data('id');
            ajaxRequest(urlFor(endpoint.show_tpl, currentAppointmentId), {}, 'GET', endpoint.csrf_token, function(resp){
                var a = resp.data || {};
                $('#edit_date').val(a.date);
                // Populate advertisers first, then set selected
                ajaxRequest(endpoint.get_adverser, {}, 'GET', null, function(resAdv){
                    successPopulateAdvisorDropdown(resAdv, '#edit_advertiser', a.advertiser_id || '');
                });
                // Populate time slots for current advertiser/date
                if (a.advertiser_id && a.date) {
                    ajaxRequest(endpoint.get_slot_list + `?advertiser_id=${encodeURIComponent(a.advertiser_id)}&current_id=${encodeURIComponent(a.id)}&date=${encodeURIComponent(a.date)}`, {}, 'GET', null, function(r){
                        successPopulateTimeSlot(r, '#edit_appointment_time_slot', a.formatted_time || a.time || '', { appendMissing: true });
                    });
                } else {
                    $('#edit_appointment_time_slot').empty().append('<option value="">Select Time Slot</option>');
                }
                $('#edit_address').val(a.address);
                $('#edit_latitude').val(a.lat);
                $('#edit_longitude').val(a.long);
                $('#edit_poc').val(a.point_of_contact);
                $('#edit_mobile').val(a.mobile);
                $('#edit_summary').val(a.summary);
                $('#edit_source').val((a.source || '').charAt(0).toUpperCase()+ (a.source || '').slice(1));
                $("#edit_appointment .task_priority[value="+ (a.importance || 'medium') + "]").prop('checked', true);
                // Created at text if available
                if (a.created_at_formatted) {
                    $('#edit_date_created_text').text(a.created_at_formatted);
                } else if (a.created_at) {
                    $('#edit_date_created_text').text(a.created_at);
                } else {
                    $('#edit_date_created_text').text('--');
                }
            }, function(xhr){ console.log('load edit failed', xhr); });
        });

        // On change of advertiser/date in edit modal, reload time slots
        $('#edit_advertiser, #edit_date').on('change', function(){
            let advertiserId = $('#edit_advertiser').val();
            let date = $('#edit_date').val();
            if (advertiserId && date) {
                const dropdown = $('#edit_appointment_time_slot');
                const prev = dropdown.val();
                ajaxRequest(endpoint.get_slot_list + `?advertiser_id=${encodeURIComponent(advertiserId)}&date=${encodeURIComponent(date)}`, {}, 'GET', null, function(response){
                    successPopulateTimeSlot(response, '#edit_appointment_time_slot', prev || null);
                });
            }
        });

        $(document).on('click', '[data-target="#view_appointment"][data-toggle="modal"]', function(){
            currentAppointmentId = $(this).data('id');
            ajaxRequest(urlFor(endpoint.show_tpl, currentAppointmentId), {}, 'GET', endpoint.csrf_token, function(resp){
                var a = resp.data || {};
                $('#view_date').val(a.date);
                $('#view_time').val(a.time);
                $('#view_advertiser').val(a.advertiser_id);
                $('#view_address').val(a.address);
                $('#view_latitude').val(a.lat);
                $('#view_longitude').val(a.long);
                $('#view_poc').val(a.point_of_contact);
                $('#view_mobile').val(a.mobile);
                $('#view_summary').val(a.summary);
                $('#view_source').val((a.source || '').charAt(0).toUpperCase()+ (a.source || '').slice(1));
            }, function(xhr){ console.log('load view failed', xhr); });
        });

        $(document).on('click', '[data-target="#reschedule_appointment"][data-toggle="modal"]', function(){
            currentAppointmentId = $(this).data('id');
            ajaxRequest(urlFor(endpoint.show_tpl, currentAppointmentId), {}, 'GET', endpoint.csrf_token, function(resp){
                var a = resp.data || {};
                $('#reschedule_appointment #appointment_date').val(a.date);
                $('#reschedule_appointment #appointment_time').val(a.time);
            }, function(xhr){ console.log('load reschedule failed', xhr); });
        });

        // Submit Edit Appointment
        $('#edit_appointment form').on('submit', function(e){
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            var payload = {
                date: $('#edit_date').val(),
                time: $('#edit_appointment_time_slot').val(),
                advertiser_id: $('#edit_advertiser').val(),
                address: $('#edit_address').val(),
                lat: $('#edit_latitude').val(),
                long: $('#edit_longitude').val(),
                source: ($('#edit_source').val()||'').toString().toLowerCase(),
                importance: $("#edit_appointment .task_priority:checked").val(),
                point_of_contact: $('#edit_poc').val(),
                mobile: $('#edit_mobile').val(),
                summary: $('#edit_summary').val()
            };
            ajaxRequest(urlFor(endpoint.update_tpl, currentAppointmentId), payload, 'POST', endpoint.csrf_token, function(resp){
                $('#edit_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment updated');
                $('#successModal').modal('show');
                setTimeout(function(){ $('#successModal').modal('hide'); }, 2000);
                $('#taskList').DataTable().ajax.reload(null, false);
            }, function(xhr){
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Update failed';
                $('#success_task_title').text('Error');
                $('#image_icon').attr('src', endpoint.error_image);
                $('#success_msg').text(msg);
                $('#successModal').modal('show');
            });
        });

        // Submit Reschedule
        $('#reschedule_appointment form').on('submit', function(e){
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            var payload = {
                date: $('#reschedule_appointment #appointment_date').val(),
                time: $('#reschedule_appointment #appointment_time').val()
            };
            ajaxRequest(urlFor(endpoint.reschedule_tpl, currentAppointmentId), payload, 'POST', endpoint.csrf_token, function(resp){
                $('#reschedule_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment rescheduled');
                $('#successModal').modal('show');
                setTimeout(function(){ $('#successModal').modal('hide'); }, 2000);
                $('#taskList').DataTable().ajax.reload(null, false);
            }, function(xhr){
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Reschedule failed';
                $('#success_task_title').text('Error');
                $('#image_icon').attr('src', endpoint.error_image);
                $('#success_msg').text(msg);
                $('#successModal').modal('show');
            });
        });

        // Submit Completed (Yes button inside form)
        $('#complete_appointment form').on('submit', function(e){
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            ajaxRequest(urlFor(endpoint.complete_tpl, currentAppointmentId), {}, 'POST', endpoint.csrf_token, function(resp){
                $('#complete_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment completed');
                $('#successModal').modal('show');
                setTimeout(function(){ $('#successModal').modal('hide'); }, 2000);
                $('#taskList').DataTable().ajax.reload(null, false);
            }, function(xhr){
                var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Complete failed';
                $('#success_task_title').text('Error');
                $('#image_icon').attr('src', endpoint.error_image);
                $('#success_msg').text(msg);
                $('#successModal').modal('show');
            });
        });




        function errorResponseForNewAppointment(xhr, status, error) {
            console.log(error, 'error');
            alert('Error: ' + error);
        }

        

    });
    </script>




    @endsection
