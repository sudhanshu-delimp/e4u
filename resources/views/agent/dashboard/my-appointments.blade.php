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
        /* Wider modal for appointment forms */
        .upload-modal .modal-dialog {
            max-width: 960px;
            width: 95%;
        }
        /* Slot grid styles */
        
        #slotGrid {
            display: grid;
            grid-template-columns: repeat(8, minmax(85px, 1fr));
            gap: 10px;
        }
        #slotGrid button{
            margin: 0px !important;
        }
        @media (min-width: 1360px) {
            #slotGrid { grid-template-columns: repeat(8, minmax(85px, 1fr)); }
        }
        @media (max-width: 991px) {
            #slotGrid { grid-template-columns: repeat(6, minmax(85px, 1fr)); }
        }
        @media (max-width: 575px) {
            #slotGrid { grid-template-columns: repeat(4, minmax(85px, 1fr)); }
        }


        #editSlotGrid {
            display: grid;
            grid-template-columns: repeat(8, minmax(85px, 1fr));
            gap: 10px;
        }
        #editSlotGrid button{
            margin: 0px !important;
        }
        @media (min-width: 1360px) {
            #editSlotGrid { grid-template-columns: repeat(8, minmax(85px, 1fr)); }
        }
        @media (max-width: 991px) {
            #editSlotGrid { grid-template-columns: repeat(6, minmax(85px, 1fr)); }
        }
        @media (max-width: 575px) {
            #editSlotGrid { grid-template-columns: repeat(4, minmax(85px, 1fr)); }
        }

        #rescheduleSlotGrid {
            display: grid;
            grid-template-columns: repeat(8, minmax(85px, 1fr));
            gap: 10px;
        }
        #rescheduleSlotGrid button{
            margin: 0px !important;
        }
        @media (min-width: 1360px) {
            #rescheduleSlotGrid { grid-template-columns: repeat(8, minmax(85px, 1fr)); }
        }
        @media (max-width: 991px) {
            #rescheduleSlotGrid { grid-template-columns: repeat(6, minmax(85px, 1fr)); }
        }
        @media (max-width: 575px) {
            #rescheduleSlotGrid { grid-template-columns: repeat(4, minmax(85px, 1fr)); }
        }


        .slot-btn {
            background: #ffffff;
            color: #0C223D;
            border: 1px solid #0C223D;
            border-radius: 8px;
            padding: 12px 10px;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            width: 100%;
            transition: background-color .15s ease, color .15s ease, box-shadow .15s ease, border-color .15s ease;
        }
        .slot-btn:hover {
            background: #e8f0fe;
<<<<<<< HEAD
            border-color: #0C223D;;
            color: #0C223D;;
=======
            border-color: #ff3c5f;
            color: #ff3c5f;
>>>>>>> 4f0884388fbf36f88e0b3e3be6a37f36d001af18
        }
        .slot-btn.selected {
            background: #ff3c5f;
            color: #ffffff;
            border-color: #ff3c5f;
            box-shadow: 0 0 0 2px rgba(26,115,232,.15);
        }
        .slot-btn.disabled,
        .slot-btn:disabled {
            background: #f1f3f4;
            color: #9aa0a6;
            border-color: #e0e0e0;
            cursor: not-allowed;
        }
        .modal-dialog .appointment_madal{
            width: 900px !important;
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
                                    <div><span class="totalInProgrssAppointment">0</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Over Due Appointments : </span></div>
                                    <div><span class="totalOverDueAppointment">0</span></div>
                                </div>
                                <div class="total_listing">
                                    <div><span>Completed Appointments : </span></div>
                                    <div><span class="totalCompletedAppointment">0</span></div>
                                </div>
                            </div>
                            <div class="text-center small d-flex justify-content-end align-items-center gap-5 flex-wrap">
                                <a href="{{ route('agent.appointment.booking.list') }}" class="btn-common text-white">View Planner</a>
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
        <div class="modal-dialog appointment_madal modal-dialog-centered" role="document">
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
                                    <label for="advertiser"><b>Advertiser's name</b><span class="text-danger">*</span></label>
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

                                <!-- Time (Grid) -->
                                <div class="form-group">
                                    <label><b>Time Slot</b><span class="text-danger">*</span></label>
                                    <div id="slotGrid"></div>
                                    <input type="hidden" id="new_start_time" name="new_start_time">
                                    <input type="hidden" id="new_end_time" name="new_end_time">
                                    <small class="form-text text-muted">Select continuous 30-minute slots.</small>
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
                                        <p class="m-0">Date Created: {{ date('d-m-Y') }}.</p>
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
                    <form method="POST" action="#" id="rescheduleAppointmentForm" data-parsley-validate>
                        <div class="row" id="task_form_button">
                            <div class="col-md-12 mb-3">
                                <input type="hidden" id="reschedule_appointment_id" name="reschedule_advertiser_id" value="">
                                <!-- Date -->
                                <div class="form-group">
                                    <label for="appointment_date"><b>Date</b><span class="text-danger">*</span></label>
                                    <input id="reschedule_date" name="reschedule_date" type="date"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                        class="form-control" required="">
                                </div>

                                <!-- Time -->
                                <input type="hidden" id="reschedule_start_time" name="start_time" value="">
                                <input type="hidden" id="reschedule_end_time" name="end_time" value="">

                                <div class="form-group">
                                    <label>Select New Time Slots (Continuous)</label>
                                    <div id="rescheduleSlotGrid" class="slot-grid-container" style=""></div>
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
                                        <input type="hidden" name="complete_advertiser_id" id="complete_advertiser_id" value="">

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
                                    {{-- <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10"
                                        style="background:#C2CFE0;">
                                        <h6 class="mb-0 text-dark">Edit Appointment</h6>
                                        <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                                    </div> --}}

                                    <div class="task-form-body p-2" style="display: block;  overflow:auto;">
                                        <!-- Hidden Task ID -->

                                        <!-- Advertiser -->
                                        <div class="form-group">
                                            <label for="edit_advertiser"><b>Advertiser’s name</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="edit_advertiser" name="advertiser" class="form-control" required>
                                                <option value="">Select Advertiser</option>
                                                <!-- Populate dynamically -->
                                            </select>
                                        </div>

                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="edit_date"><b>Date</b><span class="text-danger">*</span></label>
                                            <input id="edit_date" name="appointment_date"  type="date"
                                            class="form-control" 
                                            required
                                            {{-- min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  --}}
                                            >
                                        </div>

                                        <!-- Time Slot -->
                                        <input type="hidden" id="edit_start_time" name="start_time" value="">
                                        <input type="hidden" id="edit_end_time" name="end_time" value="">

                                        <div class="form-group">
                                            <label>Select Time Slots (Continuous)</label>
                                            <div id="editSlotGrid" class="slot-grid-container" >
                                            </div>
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
                    <form method="post" action="#" >
                        <div class="row" id="task_form_button">
                            <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                                <div class="col-md-12 card shadow-sm rounded-3">
                                    {{-- <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10"
                                        style="background:#C2CFE0;">
                                        <h6 class="mb-0 text-dark">View Appointment</h6>
                                        <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>
                                    </div> --}}

                                    <div class="task-form-body p-2" style="display: block; ">
                                        <!-- Hidden Task ID -->
                                        <input name="task_id" value="31" type="hidden">

                                        <div class="form-group">
                                            <label for="view_advertiser"><b>Advertiser’s name</b><span class="text-danger">*</span></label>
                                            <input id="view_advertiser" name="view_advertiser" type="text" class="form-control" readonly>
                                        </div>

                                        <!-- Date -->
                                        <div class="form-group">
                                            <label for="view_date"><b>Date</b><span class="text-danger">*</span></label>
                                            <input id="view_date" name="view_date" type="text"  class="form-control" readonly>
                                        </div>

                                        <!-- Time -->
                                        <div class="form-group">
                                            <label>Appointment Time:</label>
                                            <p id="view_appointment_time_display" class="form-control-static">--</p>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>Location:</label>
                                            <p id="view_appointment_address_display" class="form-control-static">--</p>
                                            <div id="view_map_container" style="height: 300px; width: 100%; border: 1px solid #ccc; margin-top: 10px;"></div>
                                        </div> --}}
                                        <!-- Advertiser -->
                                        <!-- Address + Google Maps -->
                                        <div class="form-group">
                                            <label for="view_address"><b>Address</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="view_address" name="view_address" type="text" class="form-control" readonly>
                                            <input type="hidden" id="view_latitude" name="view_latitude">
                                            <input type="hidden" id="view_longitude" name="view_longitude">
                                            <div id="view_map"
                                                style="height: 250px; margin-top:10px; border: 1px solid #ccc;display:none">
                                            </div>
                                        </div>

                                        <!-- Point of Contact -->
                                        <div class="form-group">
                                            <label for="view_poc"><b>Point of Contact</b><span
                                                    class="text-danger">*</span></label>
                                            <input id="view_poc" name="view_poc" type="text" class="form-control"  readonly>
                                        </div>

                                        <!-- Mobile -->
                                        <div class="form-group">
                                            <label for="view_mobile"><b>Mobile</b></label>
                                            <input id="view_mobile" type="tel" class="form-control" readonly>
                                        </div>

                                        <!-- Appointment Summary -->
                                        <div class="form-group">
                                            <label for="view_summary"><b>Appointment Summary</b></label>
                                            <textarea id="view_summary" class="form-control" rows="3" maxlength="500" readonly></textarea>
                                        </div>

                                        <!-- Source -->
                                        <div class="form-group">
                                            <label for="view_source"><b>Source</b><span
                                                    class="text-danger">*</span></label>
                                            <select id="view_source" name="source" class="form-control" readonly>
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
    data-appointment-count="{{ route('agent.appointment.count') }}"
    data-appointment-pdf-download="{{ route('agent.appointment.pdf.download', ['id' => '__ID__']) }}"
     >
    @endsection
    @section('script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('services.google_map.api_key')}}&libraries=places&callback=initAutocomplete"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

    <script>
    // Google Maps helpers with two-way sync between input, map, and hidden lat/lng
    var E4U_MAPS = {
        instances: {},
        geocoder: null
    };

    function ensureGeocoder() {
        if (!E4U_MAPS.geocoder) {
            E4U_MAPS.geocoder = new google.maps.Geocoder();
        }
        return E4U_MAPS.geocoder;
    }

    function reverseGeocodeToInput(latLng, inputEl) {
        var geocoder = ensureGeocoder();
        geocoder.geocode({ location: latLng }, function(results, status) {
            if (status === 'OK' && results && results[0] && inputEl) {
                inputEl.value = results[0].formatted_address || inputEl.value;
            }
        });
    }

    function initAddressMap(opts) {
        try {
            if (!window.google || !google.maps) { return; }
            var mapId = opts.mapId, inputId = opts.inputId, latId = opts.latId, lngId = opts.lngId;
            var mapEl = document.getElementById(mapId);
            var inputEl = document.getElementById(inputId);
            var latEl = document.getElementById(latId);
            var lngEl = document.getElementById(lngId);
            if (!mapEl || !inputEl || !latEl || !lngEl) { return; }

            // Show map container only if we already have coordinates (e.g., Edit flow)
            // Prevent double init per map element
            if (E4U_MAPS.instances[mapId]) {
                // If we re-open modal, also try to recenter using current values
                var existing = E4U_MAPS.instances[mapId];
                var lat = parseFloat(latEl.value);
                var lng = parseFloat(lngEl.value);
                if (!isNaN(lat) && !isNaN(lng)) {
                    var ll = { lat: lat, lng: lng };
                    existing.map.setCenter(ll);
                    existing.marker.setPosition(ll);
                    // Ensure map is visible if we now have coordinates (Edit case)
                    if (mapEl.style.display === 'none') {
                        mapEl.style.display = 'block';
                        google.maps.event.trigger(existing.map, 'resize');
                        existing.map.setCenter(ll);
                    }
                }
                return;
            }

            var startLat = parseFloat(latEl.value);
            var startLng = parseFloat(lngEl.value);
            var hasStart = !isNaN(startLat) && !isNaN(startLng);
            var defaultCenter = hasStart ? { lat: startLat, lng: startLng } : (opts.defaultCenter || { lat: -23.4042066, lng: 119.9962819 }); // Sydney fallback

            var map = new google.maps.Map(mapEl, {
                center: defaultCenter,
                zoom: hasStart ? 15 : 13,
                streetViewControl: false,
                mapTypeControl: false
            });

            var marker = new google.maps.Marker({
                position: defaultCenter,
                map: map,
                draggable: true
            });

            // If we have starting coordinates, show the map immediately (e.g., Edit modal)
            if (hasStart) {
                mapEl.style.display = 'block';
                google.maps.event.trigger(map, 'resize');
                map.setCenter(defaultCenter);
            }

            // Store
            E4U_MAPS.instances[mapId] = { map: map, marker: marker };

            // Autocomplete binding (guard to avoid double-init)
            var autocomplete;
            if (inputEl.getAttribute('data-gpa-init') !== '1') {
                autocomplete = new google.maps.places.Autocomplete(inputEl, { types: ['address'], fields: ['geometry', 'formatted_address'] });
                inputEl.setAttribute('data-gpa-init', '1');
            }

            var updateLatLngFields = function(latLng) {
                latEl.value = latLng.lat();
                lngEl.value = latLng.lng();
            };

            var setMarkerAndCenter = function(latLng, updateAddress) {
                marker.setPosition(latLng);
                map.panTo(latLng);
                updateLatLngFields(latLng);
                if (updateAddress) {
                    reverseGeocodeToInput(latLng, inputEl);
                }
            };

            if (autocomplete) {
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    if (place && place.geometry && place.geometry.location) {
                        // Reveal the map when a place is selected for the first time
                        if (mapEl.style.display === 'none') {
                            mapEl.style.display = 'block';
                            google.maps.event.trigger(map, 'resize');
                        }
                        setMarkerAndCenter(place.geometry.location, false);
                        if (place.formatted_address) {
                            inputEl.value = place.formatted_address;
                        }
                    }
                });
            }

            // Hide map if address is cleared
            inputEl.addEventListener('input', function(){
                if (!this.value.trim()) {
                    mapEl.style.display = 'none';
                }
            });

            map.addListener('click', function(e) {
                setMarkerAndCenter(e.latLng, true);
            });

            marker.addListener('dragend', function(e) {
                setMarkerAndCenter(e.latLng, true);
            });

            // If no lat/lng preset, do not auto-show via geolocation; keep hidden until user selects an address
        } catch (e) {
            console.error('Map init error', e);
        }
    }

    // Google script callback - initialize New Appointment map by default
    function initAutocomplete() {
        initAddressMap({ mapId: 'map', inputId: 'new_address', latId: 'new_latitude', lngId: 'new_longitude' });
    }
    $(document).ready(function() {

        var table = $('#taskList').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: false,
            searching: false,
            order: [[0, 'desc']],
            
            ajax: {
                url: "{{ route('agent.appointments.datatable') }}",
                type: 'GET'
            },
            columns: [
                { 
                    data: 'appointment_list', 
                    name: 'appointment_list',
                    orderable: false, 
                    searchable: false, 
                    searchable: false // explicitly set again for clarity
                },
                { data: 'map', name: 'map', orderable: false, searchable: false, className: 'text-center' },
                { data: 'status_badge', name: 'status', orderable: false, searchable: false, className: 'text-center' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-center' },
            ]
        });

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
            appointment_count: mmRoot.data('appointment-count'),
            pdf_download: mmRoot.data('appointment-pdf-download'),
            
        }

        function urlFor(tpl, id){ return (tpl || '').replace('__ID__', id); }
        // get Advertiser List data and append inside the option list
        $('#new_appointment').on('click', function() {
            initAutocomplete();
            $('#new_appointment_model').modal('show');
            ajaxRequest(endpoint.get_adverser, {}, 'GET',null , successPopulateAdvisorDropdown,  errorPopulateAdvisorDropdown);
        });

        // Initialize map + autocomplete after modal is visible (ensures container sizes)
        $('#new_appointment_model').on('shown.bs.modal', function() {
            if (typeof google !== 'undefined' && google.maps) {
                initAddressMap({ mapId: 'map', inputId: 'new_address', latId: 'new_latitude', lngId: 'new_longitude' });
            }
        });

        // Initialize Edit map + autocomplete after modal is visible
        $('#edit_appointment').on('shown.bs.modal', function() {
            if (typeof google !== 'undefined' && google.maps) {
                initAddressMap({ mapId: 'edit_map', inputId: 'edit_address', latId: 'edit_latitude', lngId: 'edit_longitude' });
            }
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

     
        //Advisor/date change -> load grid data
        $('#new_advertiser, #new_appointment_date').on('change', function() {
            let advertiserId = $('#new_advertiser').val();
            let date = $('#new_appointment_date').val();
            if (advertiserId && date) {
                ajaxRequest(endpoint.get_slot_list + `?mode=grid&advertiser_id=${encodeURIComponent(advertiserId)}&date=${encodeURIComponent(date)}`, {}, 'GET', null, loadNewAppointmentSlots, errorResponseForNewAppointment);
            }
        });

        function to12HourLabel(hhmm) {
            try {
                if (!hhmm) { return ''; }
                var parts = String(hhmm).split(':');
                var h = parseInt(parts[0], 10);
                var m = parts[1] || '00';
                var ampm = h >= 12 ? 'PM' : 'AM';
                h = h % 12; if (h === 0) h = 12;
                return h.toString().padStart(2, '0') + ':' + m + ' ' + ampm;
            } catch (e) { return hhmm; }
        }

        function addMinutes(hhmm, mins) {
            var parts = hhmm.split(':');
            var h = parseInt(parts[0], 10);
            var m = parseInt(parts[1], 10);
            var total = h * 60 + m + mins;
            var nh = Math.floor(total / 60) % 24;
            var nm = total % 60;
            return String(nh).padStart(2, '0') + ':' + String(nm).padStart(2, '0');
        }

        function diffMinutes(a, b) {
            var ap = a.split(':'), bp = b.split(':');
            return (parseInt(bp[0], 10) * 60 + parseInt(bp[1], 10)) - (parseInt(ap[0], 10) * 60 + parseInt(ap[1], 10));
        }

        function isContinuous(arr) {
            for (let i = 1; i < arr.length; i++) {
                if (diffMinutes(arr[i - 1], arr[i]) !== 30) return false;
            }
            return true;
        }

        function populateUnifiedSlotGrid(resp, config) {
            const data = resp && resp.data ? resp.data : { all: [], booked: [] };
            const all = data.all || [];
            const booked = new Set(data.booked || []);
            const grid = $(config.gridId);
            grid.empty();
            const selected = new Set();

            
            // Convert current times to minutes only if they exist (for Edit/Reschedule)
            const currentStartInMin = config.currentStart ? (parseInt(config.currentStart.split(':')[0]) * 60 + parseInt(config.currentStart.split(':')[1])) : null;
            const currentEndInMin = config.currentEnd ? (parseInt(config.currentEnd.split(':')[0]) * 60 + parseInt(config.currentEnd.split(':')[1])) : null;
            
            // ----------------------------------------------------------------------
            // --- Inner Helper: updateHidden (Dynamic IDs use config) ---
            function updateHidden() {
                if (selected.size === 0) {
                    $(config.startTimeId).val('');
                    $(config.endTimeId).val('');
                    return;
                }
                const arr = Array.from(selected).sort();
                $(config.startTimeId).val(arr[0]);
                // end is last + 30 mins
                var end = addMinutes(arr[arr.length - 1], 30);
                $(config.endTimeId).val(end);
            }
            // ----------------------------------------------------------------------

            all.forEach(function(slot) {
                let isDisabled = booked.has(slot);
                let isCurrentSelected = false;

                if (currentStartInMin !== null) {
                    const slotInMin = parseInt(slot.split(':')[0]) * 60 + parseInt(slot.split(':')[1]);
                    
                    // Check if slot belongs to CURRENT appointment's time range
                    isCurrentSelected = slotInMin >= currentStartInMin && slotInMin < currentEndInMin;
                    
                    // If it's the current selected slot, it must NOT be disabled.
                    if (isCurrentSelected) {
                        isDisabled = false; 
                    }
                }
                
                const label = to12HourLabel(slot); // Assuming to12HourLabel is globally available
                const btn = $(`<button type="button" class="slot-btn${isDisabled ? ' disabled' : ''}" ${isDisabled ? 'disabled' : ''} data-slot="${slot}">${label}</button>`);
                
                // Pre-select the current booking's slots (Only for Edit/Reschedule)
                if (isCurrentSelected) {
                    selected.add(slot);
                    btn.addClass('selected');
                }

                // Click Handler (Same continuity logic)
                if (!isDisabled) {
                    btn.on('click', function() {
                        const val = $(this).data('slot');
                        if (selected.has(val)) {
                            selected.delete(val);
                            $(this).removeClass('selected');
                        } else {
                            selected.add(val);
                            const arr = Array.from(selected).sort();
                            if (!isContinuous(arr)) {
                                selected.delete(val);
                                $(this).removeClass('selected');
                                // Use your standard error notification logic here
                                $('#success_task_title').text('Error');
                                $('#image_icon').attr('src', endpoint.error_image);
                                $('#success_msg').text('Please select continuous 30-minute slots.');
                                $('#successModal').modal('show');
                                return;
                            }
                            $(this).addClass('selected');
                        }
                        updateHidden();
                    });
                }
                grid.append(btn);
            });

            // Initial update of hidden fields with pre-selected values (or clear for Add)
            updateHidden();
        }

        function loadNewAppointmentSlots(resp) {
            populateUnifiedSlotGrid(resp, {
                gridId: '#slotGrid',
                startTimeId: '#new_start_time',
                endTimeId: '#new_end_time',
                currentStart: null, // No pre-selection for new appointment
                currentEnd: null
            });
        }

        var rescheduleAppointmentId = null; 
        var rescheduleAdvertiserId = null; // Store Advertiser ID temporarily

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
            // Ensure time range selected via grid
            if (!$('#new_start_time').val() || !$('#new_end_time').val()) {
                $('#success_task_title').text('Error');
                $('#image_icon').attr('src', endpoint.error_image);
                $('#success_msg').text('Please select one or more continuous 30-minute slots.');
                $('#successModal').modal('show');
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
            // reload after added new record
            table.ajax.reload(null, false);
             //update new count in the current list page
             appointmentCountUpdate();

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
                     const currentStart = a.start_time || '00:00'; // Adjust based on your API response
                     const currentEnd = a.end_time || '00:00';     // Adjust based on your API response
                    
                     ajaxRequest(endpoint.get_slot_list + `?mode=grid&advertiser_id=${encodeURIComponent(a.advertiser_id)}&current_id=${encodeURIComponent(a.id)}&date=${encodeURIComponent(a.date)}`, {}, 'GET', null, function(r){
                        // 2. Populate the new grid
                       // populateEditSlotGrid(r, currentStart, currentEnd); 
                       populateUnifiedSlotGrid(r, {
                            gridId: '#editSlotGrid',
                            startTimeId: '#edit_start_time',
                            endTimeId: '#edit_end_time',
                            currentStart: currentStart, 
                            currentEnd: currentEnd
                        });
                    });
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
                // After fields are populated, ensure the edit map is initialized and visible if lat/long exist
               if (typeof google !== 'undefined' && google.maps) {
                        initAddressMap({ mapId: 'edit_map', inputId: 'edit_address', latId: 'edit_latitude', lngId: 'edit_longitude' });
                }
            }, function(xhr){ console.log('load edit failed', xhr); });
        });

        // On change of advertiser/date in edit modal, reload time slots
        $('#edit_advertiser, #edit_date').on('change', function(){
            let advertiserId = $('#edit_advertiser').val();
            let date = $('#edit_date').val();
            if (!advertiserId || !date) { 
                $('#editSlotGrid').empty();
                $('#edit_start_time').val('');
                $('#edit_end_time').val('');
                return;
            }

                // For manual changes, there is no pre-selected slot, so pass null for current times
            ajaxRequest(endpoint.get_slot_list + `?mode=grid&advertiser_id=${encodeURIComponent(advertiserId)}&date=${encodeURIComponent(date)}&current_id=${encodeURIComponent(currentAppointmentId)}`, {}, 'GET', null, function(response){
                //populateEditSlotGrid(response, null, null);
                populateUnifiedSlotGrid(response, {
                gridId: '#editSlotGrid',
                startTimeId: '#edit_start_time',
                endTimeId: '#edit_end_time',
                currentStart: null, 
                currentEnd: null
            });
            });
        });

        $(document).on('click', '[data-target="#view_appointment"][data-toggle="modal"]', function(){
            appointmentCountUpdate();
            currentAppointmentId = $(this).data('id');
            ajaxRequest(urlFor(endpoint.show_tpl, currentAppointmentId), {}, 'GET', endpoint.csrf_token, function(resp){
                var a = resp.data || {};
                 const timeDisplay = `${a.formatted_start_time || 'N/A'} - ${a.formatted_end_time || 'N/A'}`;
                $('#view_appointment_time_display').text(timeDisplay);
                $('#view_date').val(a.date ? a.date.split('-').reverse().join('-') : '');
                $('#view_time').val(a.time);
                $('#view_advertiser').val(a.advertiser.name);
                $('#view_address').val(a.address);
                $('#view_latitude').val(a.lat);
                $('#view_longitude').val(a.long);
                $('#view_poc').val(a.point_of_contact);
                $('#view_mobile').val(a.mobile);
                $('#view_summary').val(a.summary);
                $('#view_source').val((a.source || '').charAt(0).toUpperCase()+ (a.source || '').slice(1));
                $("#view_appointment .task_priority[value="+ (a.importance || 'medium') + "]").prop('checked', true);

            }, function(xhr){ console.log('load view failed', xhr); });
        });

        // Redirect to PDF download on Print
        $('#view_appointment form').on('submit', function(e){
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            //var url = urlFor(endpoint.pdf_download, encodeURIComponent(currentAppointmentId));

            var encodedId = btoa(String(currentAppointmentId)); // Base64
            var url = urlFor(endpoint.pdf_download, encodedId);
            window.open(url, '_blank');
        });


       $(document).on('click', '[data-target="#reschedule_appointment"][data-toggle="modal"]', function(){
            rescheduleAppointmentId = $(this).data('id'); 
            ajaxRequest(urlFor(endpoint.show_tpl, rescheduleAppointmentId), {}, 'GET', endpoint.csrf_token, function(resp){
                var a = resp.data || {};
                console.log(a.date);
                $('#reschedule_appointment_id').val(a.id);
                rescheduleAdvertiserId = a.advertiser_id;
                $('#reschedule_date').val(a.date);
                if (rescheduleAdvertiserId && a.date) {
                    const currentStart = a.start_time || null; 
                    const currentEnd = a.end_time || null;
                    ajaxRequest(endpoint.get_slot_list + `?mode=grid&advertiser_id=${encodeURIComponent(rescheduleAdvertiserId)}&current_id=${encodeURIComponent(a.id)}&date=${encodeURIComponent(a.date)}`, {}, 'GET', null, function(r){
                        populateUnifiedSlotGrid(r, {
                            gridId: '#rescheduleSlotGrid',
                            startTimeId: '#reschedule_start_time',
                            endTimeId: '#reschedule_end_time',
                            currentStart: currentStart, 
                            currentEnd: currentEnd
                        });
                   });
                }
            });
        });

        // Reschedule date change -> reload slots
        $('#reschedule_date').on('change', function(){
           
            let date = $(this).val();
            if (!rescheduleAdvertiserId || !date) { 
                $('#rescheduleSlotGrid').empty();
                $('#reschedule_start_time').val('');
                $('#reschedule_end_time').val('');
                return;
            }
           
            ajaxRequest(endpoint.get_slot_list + `?mode=grid&advertiser_id=${encodeURIComponent(rescheduleAdvertiserId)}&date=${encodeURIComponent(date)}&current_id=${encodeURIComponent(rescheduleAppointmentId)}`, {}, 'GET', null, function(r){
                        populateUnifiedSlotGrid(r, { 
                        gridId: '#rescheduleSlotGrid',
                        startTimeId: '#reschedule_start_time',
                        endTimeId: '#reschedule_end_time',
                        currentStart: null, 
                        currentEnd: null
                    });
            });
        });

        // Submit Edit Appointment
        $('#edit_appointment form').on('submit', function(e){
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            var payload = {
                date: $('#edit_date').val(),
                start_time: $('#edit_start_time').val(),
                end_time: $('#edit_end_time').val(), 
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

             if (!payload.start_time || !payload.end_time) {
               alert('select one or more continuous 30-minute slots.');
                return; 
            }
            ajaxRequest(urlFor(endpoint.update_tpl, currentAppointmentId), payload, 'POST', endpoint.csrf_token, function(resp){
                $('#edit_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment updated');
                $('#successModal').modal('show');
                setTimeout(function(){ $('#successModal').modal('hide'); }, 2000);
                table.ajax.reload(null, false);
               //update new count in the current list page
               appointmentCountUpdate();

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
            var appointmentId = $('#reschedule_appointment_id').val();
            if (!appointmentId) { 
                alert('No appointment selected for reschedule');
                return; 
            }
            var payload = {
                date: $('#reschedule_date').val(),
                start_time: $('#reschedule_start_time').val(),    
                end_time: $('#reschedule_end_time').val()
            };

            if(!payload.start_time || !payload.end_time) {
                alert('Please select one or more continuous 30-minute slots.');
                return;
            }
            ajaxRequest(urlFor(endpoint.reschedule_tpl, appointmentId), payload, 'POST', endpoint.csrf_token, function(resp){
                $('#reschedule_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment rescheduled');
                $('#successModal').modal('show');
                //table reload after uodate table
                table.ajax.reload(null, false);
                //update new count in the current list page
                appointmentCountUpdate();

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

        $(document).on('click', '[data-target="#complete_appointment"][data-toggle="modal"]', function(){
            currentAppointmentId = $(this).data('id');
            $('#complete_appointment #complete_advertiser_id').val(currentAppointmentId);
           
        });


        $('#complete_appointment form').on('submit', function(e){
            currentAppointmentId = $('#complete_advertiser_id').val();
            console.log(currentAppointmentId);
            e.preventDefault();
            if (!currentAppointmentId) { return; }
            ajaxRequest(urlFor(endpoint.complete_tpl, currentAppointmentId), {}, 'POST', endpoint.csrf_token, function(resp){
                $('#complete_appointment').modal('hide');
                $('#success_task_title').text('Success');
                $('#image_icon').attr('src', endpoint.success_image);
                $('#success_msg').text(resp.message || 'Appointment completed');
                $('#successModal').modal('show');
                //update datetable due to update status
                table.ajax.reload(null, false); 
                //update new count in the current list page
                appointmentCountUpdate();
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

        function appointmentCountUpdate(){
            ajaxRequest(endpoint.appointment_count, {}, 'GET', null, function(resp){
                var countVal  = resp.data || {};
                console.log('countVal');
                $('.totalInProgrssAppointment').text(countVal.in_progress || 0);
                $('.totalOverDueAppointment').text(countVal.overdue || 0);
                $('.totalCompletedAppointment').text(countVal.completed || 0);
            }, function(xhr){ console.log('load view failed', xhr); });
        }
        appointmentCountUpdate();

       
    });



    </script>



    @endsection
