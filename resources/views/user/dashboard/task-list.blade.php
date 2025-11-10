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
<div class="container-fluid  pl-3 pl-lg-5 pr-3 pr-lg-5">
    
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-12 custom-heading-wrapper justify-content-between">
       <div class="d-flex align-items-center">
        <h1 class="h1">Task List</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
       </div>
        
        <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 my-2">
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
            <div class="col-lg-12 p-0">
                <!-- Card Body -->
                <div class="card-body task-sec">
                    <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-10">
                        {{-- <div class="d-flex align-items-center justify-content-start flex-wrap gap-10">
                            <button type="submit" id="new_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">New Task</button>
                            <button type="submit" id="edit_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Edit Task</button>
                            <button type="submit" id="complete_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Complete Task</button>
                            <button type="submit" id="view_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">View Task</button>
                            <button type="submit" id="open_task" name="submit"
                                class="btn btn-sm btn-primary shadow-none create-tour-sec">Open Task</button>
                            
                        </div> --}}
                        
                        <div class="mb-2 d-flex align-items-center justify-content-between flex-wrap gap-10">
                            <div class="total_listing">
                                <div><span>In Progress Task : </span></div>
                                <div><span>01</span></div>
                            </div>
                            <div class="total_listing">
                                <div><span>Open task : </span></div>
                                <div><span>01</span></div>
                            </div>
                        </div>
                        <div class="text-center small d-flex justify-content-end align-items-center gap-10 flex-wrap">
                            <span class="mr-2 text-uppercase font-weight-bold">Importance:</span>
                            <span class="d-flex justify-content-start gap-5 align-items-center">High <i class="fas fa-circle text-high mr-2"></i></span>
                            <span class="d-flex justify-content-start gap-5 align-items-center">Medium  <i class="fas fa-circle text-medium mr-2"></i></span>
                           
                            <span class="d-flex justify-content-start gap-5 align-items-center">Low <i class="fas fa-circle text-low"></i></span>
                            
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
                            <table class="table table-bordered " id="taskListreport">
                                <thead style="background-color: #0C223D; color: #ffffff;">
                                    <tr>
                                        <th >Task</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td class=" task-color">
                                                <label for="task_checkbox_18" class="mb-0 cursor-pointer">
                                                <i class="fas fa-circle text-high taski mr-2"></i>Testing
                                                </label></td>
                                            <td class="td-actions text-center ">
                                                <span class="badge badge-danger-lighten task-1" style="background: #4e73df ; padding:5px 10px; max-width:120px; width:100%;">In Progress
    
                                                </span>
                                            </td>
                                            <td class="theme-color text-center bg-white ">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#add_mytask"> <i class="fa fa-plus-circle"></i>  New Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#edit_mytask"> <i class="fa fa-pen"></i>  Edit Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#complete_mytask"> <i class="fa fa-check-circle"></i> Complete Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#view_mytask"> <i class="fa fa-eye"></i> View Task</a>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class=" task-color">
                                                <label for="task_checkbox_17" class="mb-0 cursor-pointer">
                                                <i class="fas fa-circle text-medium taski mr-2"></i>clear task 1
                                                </label></td>
                                            <td class="td-actions text-center ">
                                                <span class="badge badge-danger-lighten task-1" style="background: #9d1d08 ; padding:5px 10px; max-width:120px; width:100%;">open</span>
                                            </td>
                                            <td class="theme-color text-center bg-white ">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#add_mytask"> <i class="fa fa-plus-circle"></i>  New Task</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#edit_mytask"> <i class="fa fa-pen"></i>  Edit Task</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#complete_mytask"> <i class="fa fa-check-circle"></i> Complete Task</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#view_mytask"> <i class="fa fa-eye"></i> View Task</a>
                                                    
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class=" task-color">
                                                <label for="task_checkbox_16" class="mb-0 cursor-pointer">
                                                <i class="fas fa-circle text-low taski mr-2"></i>Hiper task
                                                </label></td>
                                            <td class="td-actions text-center ">
                                                <span class="badge badge-danger-lighten task-1" style="background: #1cc88a; padding:5px 10px; max-width:120px; width:100%;">Completed</span>
                                            </td>
                                            <td class="theme-color text-center bg-white ">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                    </a>
                                                    <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#add_mytask"> <i class="fa fa-plus-circle"></i>  New Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 disabled" href="#" data-toggle="modal" data-target="#edit_mytask"> <i class="fa fa-pen"></i>  Edit Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#complete_mytask"> <i class="fa fa-check-circle"></i> Complete Task</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#view_mytask"> <i class="fa fa-eye"></i> View Task</a>
                                                        
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4 custome_paginator">
                            {{-- {!! $tasks->links() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
 {{-- Add New Task Modal --}}
 <div class="modal fade upload-modal" id="add_mytask" tabindex="-1" role="dialog" aria-labelledby="add_mytaskModallabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task_title"><img src="{{ asset('assets/dashboard/img/add-task.png') }}"
                    class="custompopicon"> New Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="task_form" action="#">
                    <div class="form-group ">
                        <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
                        <input id="title" placeholder="Enter Title..." name="title" type="text"
                            class="form-control" required>
                        @error('title')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group pt-2 pb-3" data-i="">
                        <label for="exampleFormControlTextarea1"><b>Importance</b><span class="text-danger">*</span>
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
                        <label for="exampleFormControlTextarea1"><b>Task Description</b>
                        </label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"
                            placeholder="Up to 300 character"></textarea>
                    </div>
                    <div class="row" id="task_form_button">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-end">
                                <div>
                                    <button type="submit" class="btn-cancel-modal ml-2 " data-dismiss="modal" aria-label="Close">Cancel</button>
                                    <button type="submit" class="btn-success-modal ml-2 "
                                    id="save_button">Save</button>
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
{{-- Edit Task Modal --}}
<div class="modal fade upload-modal" id="edit_mytask" tabindex="-1" role="dialog" aria-labelledby="edit_mytaskModallabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task_title"> <img src="{{ asset('assets/dashboard/img/edit-task.png') }}"
                    class="custompopicon"> Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="task_form" action="#">
                    <div class="form-group ">
                        <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
                        <input id="title" placeholder="Enter Title..." name="title" type="text"
                            class="form-control" required value="Testing">
                        @error('title')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group pt-2 pb-3" data-i="">
                        <label for="exampleFormControlTextarea1"><b>Importance</b><span class="text-danger">*</span>
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
                        <label for="status"><b>Status</b><span class="text-danger">*</span></label>
                        <select class="custom-select" name="status" id="status">
                            <option value="open">Open</option>
                            <option value="inprogress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><b>Task Description</b>
                        </label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"
                            placeholder="Up to 300 character" value="testing..."></textarea>
                    </div>
                    <div class="row" id="task_form_button">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-end">
                               
                            <div>
                                <button type="submit" class="btn-cancel-modal ml-2 "
                                id="save_button"  data-dismiss="modal" aria-label="Close">Cancel</button>
                                <button type="submit" class="btn-success-modal ml-2 "
                                id="save_button">Update</button>
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

{{-- View Task Modal --}}
<div class="modal fade upload-modal" id="view_mytask" tabindex="-1" role="dialog" aria-labelledby="view_mytaskModallabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="task_title"> <img src="{{ asset('assets/dashboard/img/website.png') }}"
                    class="custompopicon"> View Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                            class="img-fluid img_resize_in_smscreen"></span>
                </button>
            </div>
            <div class="modal-body pb-0 agent-tour">
                <form method="post" id="view_task_form" action="#">
                    <div class="form-group">
                        <label for="title"><b>Title</b><span class="text-danger">*</span></label>
                        <input id="title" name="title" type="text" class="form-control" required value="Testing" disabled>
                        @error('title')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group pt-2 pb-3">
                        <label><b>Importance</b><span class="text-danger">*</span></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" value="high" disabled>
                            <label class="form-check-label">High</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" value="medium" checked disabled>
                            <label class="form-check-label">Medium</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input task_priority" type="radio" name="task_priority" value="low" disabled>
                            <label class="form-check-label">Low</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="status"><b>Status</b><span class="text-danger">*</span></label>
                        <select class="custom-select" name="status" id="status" disabled>
                            <option value="open">Open</option>
                            <option value="inprogress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><b>Task Description</b></label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Up to 300 character" disabled>testing...</textarea>
                    </div>

                    <div class="row" id="task_form_button">
                        <div class="col-md-12 mb-3">
                            <div class="form-group d-flex align-items-center justify-content-end">
                                <div>
                                    <button type="button" class="btn-success-modal ml-2" id="edit_button">Edit</button>
                                    <button type="submit" class="btn-success-modal ml-2 d-none" id="update_button">Update</button>
                                    <button type="button" class="btn-cancel-modal ml-2" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
  var table = $("#taskListreport").DataTable({
    language: {
        search: "Search: _INPUT_",
        searchPlaceholder: "Search by Status"
    },
    info: true,
    paging: true,
    lengthChange: true,
    searching: true,
    bStateSave: true,
    order: [[1, 'desc']], // default sort on 2nd column (index starts from 0)
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    pageLength: 10,
    
    columnDefs: [
        { targets: 2, orderable: false }
    ]
});

   
</script>

{{-- JavaScript to enable editing --}}
<script>
    document.getElementById('edit_button').addEventListener('click', function () {
        // Enable form fields
        document.querySelectorAll('#view_task_form input, #view_task_form textarea, #view_task_form select').forEach(function (el) {
            el.disabled = false;
        });

        // Show Update button
        document.getElementById('update_button').classList.remove('d-none');

        // Hide Edit button
        this.classList.add('d-none');
    });
</script>
    <script>
        $(document).ready(function() {

            $(".showDateLabel").hide();
            // Reusable click event
            $('.create-tour-sec').on('click', function(e) {
                e.preventDefault();
                $(".showDateLabel").hide();

                let buttonId = $(this).attr('id');
                let taskName = $(this).text();

                console.log('hell', buttonId);
                console.log('hellsd', taskName);


                if (buttonId == 'new_task') {
                    $('#task_title').text(taskName);
                    newTask();
                } else if (buttonId == 'edit_task') {
                    $('#task_title').text(taskName);
                    editTask();
                } else if (buttonId == 'view_task') {
                    $('#task_title').text(taskName);
                    viewTask();
                } else if (buttonId == 'complete_task') {
                    $('#task_title').text(taskName);
                    completeTask();
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

        function newTask() {
            let addNewTaskHtml = `
                <div class="mx-auto my-2 col-md-11">
                    <div class="form-group ">
                        <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
                        <input id="title" placeholder="Enter Title..." name="title" type="text"
                            class="form-control" required>
                        @error('title')
                            <div class="text-danger text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group pt-2 pb-3" data-i="">
                        <label for="exampleFormControlTextarea1"><b>Importance</b><span class="text-danger">*</span>
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
                        <label for="exampleFormControlTextarea1"><b>Task Description</b>
                        </label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"
                            placeholder="Up to 300 character"></textarea>
                    </div>
                    
                </div>
            `;

            let addUrl = "{{ route('dashboard.ajax-add-task')}}";
            $('#task_form').attr('action',addUrl); 

            $("#task_form_html").html(addNewTaskHtml);
            $("#save_button").show();
            $("#save_button").text('Add');
            $("#cancel_button").text('Cancel');
            $(".showDateLabel").show();
           
            console.log('hey new task');
        }

        function editTask() 
        {

            let completeHtml =
                `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            if (checkboxInputs.length === 0) {
                $("#task_form_html").html(completeHtml);
                $("#save_button").hide();
                $("#cancel_button").text('Cancel');
                return false;
            }

            console.log(checkboxInputs);
            console.log('checkboxInputs');

            let selectedTask = 1;
            let editNewTaskHtml = ``;
            for (selectedTask; selectedTask <= checkboxInputs.length; selectedTask++) {
                editNewTaskHtml += `
                    <div class="task-form-wrapper mx-auto mb-4 col-md-11" style="cursor:pointer;">
                        <div class=" col-md-12 card shadow-sm  rounded-3">
                            <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10" style="background:#C2CFE0; ">
                                <h6 class="mb-0 text-dark">Task Summary</h6> <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>                            
                            </div>
                            <div class="task-form-body p-2" style="display: none;">
                                <!-- Your original form HTML -->
                                <div class="form-group">
                                    <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
                                    <input id="title" placeholder="Enter Title..." name="title" type="text" class="form-control" required>
                                </div>

                                <div class="pt-2 pb-3">
                                    <label><b>Importance</b><span class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio1" value="high">
                                        <label class="form-check-label" for="inlineRadio1">High</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio2" value="medium" checked>
                                        <label class="form-check-label" for="inlineRadio2">Medium</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio3" value="low">
                                        <label class="form-check-label" for="inlineRadio3">Low</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status"><b>Status</b><span class="text-danger">*</span></label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="open">Open</option>
                                        <option value="inprogress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1"><b>Description</b></label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Up to 300 characters"></textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                `;
            }

            $("#task_form_html").html(editNewTaskHtml);

            // $editTaskData = fetchAjaxEditData(formData);

            // let editNewTaskHtml = `
            //     <div class="mx-auto my-2 col-md-11">
            //         <div class="form-group ">
            //             <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
            //             <input id="title" placeholder="Enter Title..." name="title" type="text"
            //                 class="form-control" required>
            //             @error('title')
            //                 <div class="text-danger text-sm">{{ $message }}</div>
            //             @enderror
            //         </div>
            //         <div class="pt-2 pb-3" data-i="">
            //             <label for="exampleFormControlTextarea1"><b>Importance</b><span class="text-danger">*</span>
            //             </label><br>
            //             <div class="form-check form-check-inline">
            //                 <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio1" value="high">
            //                 <label class="form-check-label" for="inlineRadio1">High</label>
            //             </div>
            //             <div class="form-check form-check-inline">
            //                 <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio2" checked value="medium">
            //                 <label class="form-check-label"  for="inlineRadio2">Medium</label>
            //             </div>
            //             <div class="form-check form-check-inline">
            //                 <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio3" value="low">
            //                 <label class="form-check-label" for="inlineRadio3">Low</label>
            //             </div>
            //         </div>
            //         <div class="form-group ">
            //             <label for="status"><b>Status</b><span class="text-danger">*</span> </label>
            //             <select class="custom-select" aria-label="Default select example" name="" id="">
            //                 <option value="open" >Open</option>
            //                 <option value="inprogress">In Progress</option>
            //                 <option value="completed">Completed</option>
            //             </select>
            //             @error('title')
            //                 <div class="text-danger text-sm">{{ $message }}</div>
            //             @enderror
            //         </div>
            //         <div class="form-group">
            //             <label for="exampleFormControlTextarea1"><b>Description</b>
            //             </label>
            //             <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"
            //                 placeholder="Up to 300 character"></textarea>
            //         </div>
            //     </div>
            // `;

            let updateUrl = "{{ route('dashboard.ajax-update-task')}}";
            $('#task_form').attr('action',updateUrl); 

            $("#task_form_html").html(editNewTaskHtml);
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
                url: actionUrl, // form action URL
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

        function completeTask() {
            let completeHtml =
                `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            if (checkboxInputs.length === 0) {
                $("#task_form_html").html(completeHtml);
                $("#save_button").hide();
                $("#cancel_button").text('Cancel');
                return false;
            }

            let selectedTask = 1;
            let completedTaskIds = [];

            for (selectedTask; selectedTask <= checkboxInputs.length; selectedTask++) {
                let taskId = $(this).data('id');
                if (taskId) {
                    completedTaskIds.push(taskId);
                }
            }

            let formData = new FormData();
            formData.append('task_ids', JSON.stringify(completedTaskIds)); //

            completeHtml =
                `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc">Are you sure you want to mark all selected tasks as completed?</h4></div>`;

            $("#task_form_html").html(completeHtml);
            $("#save_button").text('Yes');
            $("#save_button").show();
            $("#cancel_button").text('Cancel');
            let actionStatusUrl = "{{route('dashboard.ajax-change-status')}}";
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

        function viewTask() {
            let completeHtml =
                `<div class="mx-2 my-2 col-md-11"><h4 id="task_desc" class="text-danger">Please select at least one task!</h4></div>`;
            var checkboxInputs = $(".task_table input[type='checkbox']:checked");

            if (checkboxInputs.length === 0) {
                $("#task_form_html").html(completeHtml);
                $("#save_button").hide();
                $("#cancel_button").text('Cancel');
                return false; 
            }

            console.log(checkboxInputs.length, ' jite');
            let selectedTask = 1;
            let viewTaskHtml = ``;
            for (selectedTask; selectedTask <= checkboxInputs.length; selectedTask++) {
                viewTaskHtml += `
                    <div class="task-form-wrapper mx-auto my-2 col-md-11" style="cursor:pointer;">
                        <div class=" col-md-12 card shadow-sm  rounded-3">
                            <div class="toggle-task-form card-header cursor-pointer text-white d-flex justify-content-between align-items-center g-10" style="background:#C2CFE0; ">
                                <h6 class="mb-0 text-dark">Task Summary</h6> <i class="top-icon-bg fas fa-chevron-down fa-fw"></i>                            
                            </div>
                            <div class="task-form-body p-2" style="display: none;">
                                <!-- Your original form HTML -->
                                <div class="form-group">
                                    <label for="title"><b>Title</b><span class="text-danger">*</span> </label>
                                    <input id="title" placeholder="Enter Title..." name="title" type="text" class="form-control" required>
                                </div>

                                <div class="pt-2 pb-3">
                                    <label><b>Importance</b><span class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio1" value="high">
                                        <label class="form-check-label" for="inlineRadio1">High</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio2" value="medium" checked>
                                        <label class="form-check-label" for="inlineRadio2">Medium</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input task_priority" type="radio" name="task_priority" id="inlineRadio3" value="low">
                                        <label class="form-check-label" for="inlineRadio3">Low</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status"><b>Status</b><span class="text-danger">*</span></label>
                                    <select class="custom-select" name="status" id="status">
                                        <option value="open">Open</option>
                                        <option value="inprogress">In Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1"><b>Description</b></label>
                                    <textarea class="form-control" name="description" rows="5" placeholder="Up to 300 characters"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="edit_button btn btn-success shadow-none float-right ml-2 " >Edit</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                `;
            }

            $("#task_form_html").html(viewTaskHtml);
            //$("#save_button").text('Yes');
            $("#save_button").hide();
            $("#cancel_button").text('Cancel');
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

            function renderPagination(data) {
                let pagination = `<nav><ul class="pagination">`;

                if (data.current_page > 1) {
                    pagination += `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page - 1}"><i class="fa fa-angle-left"></i></a></li>`;
                }else{
                    pagination += `<li class="page-item page-link"><i class="fa fa-angle-left"></i></li>`;
                }

                for (let i = 1; i <= data.last_page; i++) {
                    pagination += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                        <a href="#" class="page-link" data-page="${i}">${i}</a>
                    </li>`;
                }

                if (data.current_page < data.last_page) {
                    pagination += `<li class="page-item"><a href="#" class="page-link" data-page="${data.current_page + 1}"><i class="fa fa-angle-right"></i></a></li>`;
                }else{
                    pagination += `<li class="page-item page-link"><i class="fa fa-angle-right"></i></li>`;
                }

                pagination += `</ul></nav>`;
                $('.custome_paginator').html(pagination);
            }
        // });
    </script>
@endpush