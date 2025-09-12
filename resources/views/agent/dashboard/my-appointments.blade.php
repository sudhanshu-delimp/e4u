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
                                <button type="button" class="btn-common" data-toggle="modal"
                                    data-target="#new_appointment">New Appointment</button>
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
                                <tbody>
                                    <tr>

                                        <td class=" task-color">
                                            <label for="task_checkbox_33" class="mb-0 cursor-pointer">
                                                <i class="fas fa-circle text-medium taski mr-2"></i>zdfgaf
                                            </label> <small class="text-muted"> ( 09:30 am | 27-07-2025 ) </small>
                                        </td>
                                        <td class="text-center" data-toggle="modal" data-target="#openMapmodal"> <img
                                                src="http://e4u.test/assets/dashboard/img/map.png"
                                                style="width:45px; padding-right:10px;cursor:pointer" title="view Location">
                                        </td>
                                        <td class="td-actions text-center ">
                                            <span class="badge badge-danger-lighten task-1"
                                                style="background: #1cc88a; padding:5px 10px; max-width:120px; width:100%;">completed</span>
                                        </td>
                                        <td class="theme-color text-center bg-white ">
                                            <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                    aria-labelledby="dropdownMenuLink" style="">
                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                                                        href="#" data-target="#edit_appointment" data-toggle="modal">
                                                        <i class="fa fa-pen"></i>Edit Appointment</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                                                        href="#" data-target="#reschedule_appointment"
                                                        data-toggle="modal"> <i class="fa fa-calendar"></i>Reschedule
                                                        Appointment</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                                                        href="#" data-target="#complete_appointment"
                                                        data-toggle="modal"> <i class="fa fa-check-circle"></i>Completed
                                                        Appointment</a>

                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 create-tour-sec-dropdown"
                                                        href="#" data-target="#view_appointment"
                                                        data-toggle="modal"> <i class="fa fa-eye"></i>View Appointment</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
    <!-- New appointment Popup -->
    <div class="modal fade upload-modal" id="new_appointment" tabindex="-1" role="dialog"
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
                    <form method="post" id="task_form" action="#">
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                 <!-- Advertiser -->
                                <div class="form-group">
                                    <label for="advertiser"><b>Advertiser</b><span class="text-danger">*</span></label>
                                    <select id="advertiser" name="advertiser" class="form-control" required>
                                        <option value="">Select Advertiser</option>
                                        <!-- Populate dynamically from Agent's Advertiser List -->
                                    </select>
                                    <small class="form-text text-muted">Select from agent's advertiser list.</small>
                                </div>

                                <!-- Date -->
                                <div class="form-group">
                                    <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                                    <input id="appointment_date" name="appointment_date" type="date"
                                        class="form-control" required>
                                </div>

                                <!-- Time -->
                                <div class="form-group">
                                    <label for="appointment_time"><b>Time</b><span class="text-danger">*</span></label>
                                    <input id="appointment_time" name="appointment_time" type="time"
                                        class="form-control" required>
                                </div>

                               

                                <!-- Address with Google Maps integration -->
                                <div class="form-group">
                                    <label for="address"><b>Address</b><span class="text-danger">*</span></label>
                                    <input id="address" name="address" type="text" class="form-control"
                                        placeholder="Search or enter address" required>
                                    <small class="form-text text-muted">Start typing to search address or add
                                        manually.</small>

                                    <!-- Hidden fields for latitude and longitude -->
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">

                                    <!-- Google Map Preview -->
                                    <div id="map"
                                        style="height: 250px; width: 100%; margin-top:10px; border: 1px solid #ccc; display:none;">
                                    </div>
                                </div>

                                <!-- Point of Contact (Edit/View only) -->
                                <div class="form-group d-none" id="poc-field">
                                    <label for="poc"><b>Point of Contact</b><span
                                            class="text-danger">*</span></label>
                                    <input id="poc" name="poc" type="text" class="form-control"
                                        placeholder="Enter contact name">
                                </div>

                                <!-- Mobile (Edit/View only) -->
                                <div class="form-group d-none" id="mobile-field">
                                    <label for="mobile"><b>Mobile</b></label>
                                    <input id="mobile" name="mobile" type="tel" class="form-control"
                                        placeholder="Enter mobile number">
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
                                        <input class="form-check-input task_priority" type="radio" name="task_priority"
                                            id="editinlineRadio1" value="high">
                                        <label class="form-check-label" for="editinlineRadio1">High</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority"
                                            id="editinlineRadio2" value="medium" checked>
                                        <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority"
                                            id="editinlineRadio3" value="low">
                                        <label class="form-check-label" for="editinlineRadio3">Low</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="m-0">Date Created: 02-09-2025.</p>
                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close" id="cancel_button">Cancel</button>
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Add</button>
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
                    <form method="post" id="task_form" action="#">
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
                                                aria-label="Close" id="cancel_button">Cancel</button>
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Reschedule</button>
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
                    <form method="post" id="task_form" action="#">
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <h4 id="task_desc">Are you sure you want to mark selected appointment as completed?</h4>

                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-end">

                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close" id="cancel_button">No</button>
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Yes</button>
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
                    <form method="post" id="task_form" action="#">
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
                                        <input name="task_id" value="`+taskId+`" type="hidden">



                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="edit_date"><b>Date</b><span class="text-danger">*</span></label>
                                            <input id="edit_date" name="appointment_date" type="date"
                                                class="form-control" required>
                                        </div>

                                        <!-- Time -->
                                        <div class="form-group">
                                            <label for="edit_time"><b>Time</b><span class="text-danger">*</span></label>
                                            <input id="edit_time" name="appointment_time" type="time"
                                                class="form-control" required>
                                        </div>

                                        <!-- Advertiser -->
                                        <div class="form-group">
                                            <label for="edit_advertiser"><b>Advertiser</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="edit_advertiser" name="advertiser" class="form-control" required>
                                                <option value="">Select Advertiser</option>
                                                <!-- Populate dynamically -->
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
                                                    name="task_priority" id="editinlineRadio1" value="high">
                                                <label class="form-check-label" for="editinlineRadio1">High</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" id="editinlineRadio2" value="medium" checked>
                                                <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" id="editinlineRadio3" value="low">
                                                <label class="form-check-label" for="editinlineRadio3">Low</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="m-0">Date Created: 02-09-2025.</p>
                                        <div>
                                            <button type="button" class="btn-cancel-modal" data-dismiss="modal"
                                                aria-label="Close" id="cancel_button">Cancel</button>
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Update</button>
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
                    <form method="post" id="task_form" action="#">
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
                                                    name="task_priority" id="editinlineRadio1" value="high">
                                                <label class="form-check-label" for="editinlineRadio1">High</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" id="editinlineRadio2" value="medium"
                                                    checked="">
                                                <label class="form-check-label" for="editinlineRadio2">Medium</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input task_priority" type="radio"
                                                    name="task_priority" id="editinlineRadio3" value="low">
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
                                                aria-label="Close" id="cancel_button">Close</button>
                                            <button type="submit" class="btn-success-modal"
                                                id="save_button">Print</button>
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
                    <h5 class="modal-title" id="success_task_title">Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="py-4 text-center" id="success_form_html">
                        <h4 id="success_msg">Are you sure you want to mark this Appointment as completed?</h4>
                        <button type="button" class="btn-success-modal mt-3 shadow-none" data-dismiss="modal"
                            aria-label="Close" id="cancel_button">OK</button>
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
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        
        let table = new DataTable('#taskList', {
          //  dom: 't', // This removes the search box and pagination dropdown
        });


        // ajax function
        /**
 * Reusable AJAX function
 * @param {string} url - The API endpoint
 * @param {object} data - Data to send (default empty)
 * @param {string} method - HTTP method (GET, POST, etc.)
 * @param {function} successCallback - Function to run on success
 * @param {function} errorCallback - Function to run on error
 */

function ajaxRequest(url, data= {}, method='GET', successCallback = null, errorCallback = null){
    $.ajax({
        url: url,
        type: type,
        dateType: 'json',
        success: function(response){
            if(typeof successCallback === 'function'){
                successCallback(response);
            }
        },
        error: function(xhr,status, error){
            if(typeof errorCallback === 'function'){
                errorCallback(xhr,status, error);
            }else{
                console.log('Ajax Error', status, error);
            }
        }
    });
}

function successResponseForMewAppointment(response){
    $('#success_msg').text(response.message);
    $('#successModal').modal('show');   
}

function errorResponseForNewAppointment(xhr, status, error){
    alert('Error: ' + error);   
}


    </script>
@endsection
