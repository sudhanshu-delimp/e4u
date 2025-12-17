@extends('layouts.escort')

@section('style')
<style>
    .table thead {
  background-color: var(--blue--text);
  color: #fff;
}
.icon-col {
  font-size: 18px;
  text-align: left;
  color: var(--blue--text);
}
h5 {
  color: var(--blue--text);
}
</style>
@endsection
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Statistics</h1>
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
        {{-- end --}}

        {{-- first row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics 
                    </h4>
                </div>
                <!-- Card Start -->
                 <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profile Views Today</div>
                            <div class="statistics-value">{{$myStatistics['mystatistics_profile_views_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/view-profile.png') }}" alt="icon">
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Media Views Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['mystatistics_media_views_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Recommendations This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['mystatistics_recommendations_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                        </div>
                    </div>
                    <!-- Card End -->
                    <!-- Card Start -->
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Reviews Posted This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['mystatistics_reviews_posted_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                        </div>
                    </div>
                    <!-- Card End -->
                 </div>
            </div>
        </div>
        {{-- end --}}
        
        {{-- second row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">Critical Information
                    </h4>
                </div>
                 <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profiles Currently Posted
                            </div>
                            <div class="statistics-value">{{$myStatistics['critical_information_profile_currenlty_posted']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                        </div>
                    </div>
              
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Upcoming Profiles
                            </div>
                            <div class="statistics-value">{{$myStatistics['critical_information_upcoming_profile']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/followers.png') }}" alt="icon">
                        </div>
                    </div>
              
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">My Playbox Subscriptions
                            </div>
                            <div class="statistics-value">{{$myStatistics['critical_information_my_playbox_subscription']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/likes.png') }}" alt="icon">
                        </div>
                    </div>
                 </div>    
            </div>
        </div>
        {{-- end --}}
        
        {{-- third row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">Profile Statistics
                    </h4>
                </div>
                <!-- Card Start -->
                 <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profile Views Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_profile_views_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/view-profile.png') }}" alt="icon">
                        </div>
                    </div>
                
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profile Views This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_profile_views_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/view-profile-time.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_profile_year_to_date']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
              
                
              
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Playbox Views Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_playbox_views_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/likes.png') }}" alt="icon">
                        </div>
                    </div>
                
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Playbox Views This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_playbox_views_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/likes.png') }}" alt="icon">
                        </div>
                    </div>
                
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">{{$myStatistics['profile_statistics_playbox_year_to_date']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
                <!-- Card End -->
            </div> 
        </div>
        {{-- end --}}

        
        
        {{-- fourth row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">Media Statistics
                    </h4>
                </div>
                <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Media Views Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['media_statistics_media_views_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                        </div>
                    </div>
                
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Media Views This Weeks
                            </div>
                            <div class="statistics-value">{{$myStatistics['media_statistics_media_views_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Year to Date
                            </div>
                            <div class="statistics-value">{{$myStatistics['media_statistics_media_year_to_date']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
                <!-- Card End -->
            </div>
        </div>
        {{-- end --}}
        
        {{-- third row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">Feedback
                    </h4>
                </div>
                 <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Reviews Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_reviews_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Reviews This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_reviews_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_reviews_year_to_date']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Recommendations Today
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_recommendations_today']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                        </div>
                    </div>
                
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Recommendations This Week
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_recommendations_this_week']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">{{$myStatistics['feedback_recommendations_year_to_date']}}</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
                </div>
                <!-- Card End -->
            </div> 
        </div>
        {{-- end --}}
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
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
                        <div class=" col-md-12 card shadow-sm border-0 rounded-3">
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
                        <div class=" col-md-12 card shadow-sm border-0 rounded-3">
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
                                        class="edit_button btn btn-success shadow-none float-right ml-2 border-0" >Edit</button>
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
                <div class="card shadow-sm border-0 rounded-3">
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
                        <td class="border-0 pl-0 pr-0">
                            <div class="form-check m-0 p-0">
                                <label class="form-check-label" for="`+checkboxId+`">
                                    <input class="form-check-input" name="task_ids" data-id="`+taskId+`" id="`+checkboxId+`" type="checkbox" value="">
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </td>
                        <td class="border-0 pl-0 task-color">
                            <label for="`+checkboxId+`" class="mb-0 cursor-pointer">
                            <i
                                class="fas fa-circle `+priorityColor+` taski mr-2"></i>`+task.title+`
                            </label></td>
                        <td class="td-actions text-left border-0 ">
                            <span class="badge badge-danger-lighten task-1" style="background: `+taskBadgeColor+`; padding:5px 10px; max-width:120px; width:100%;">`+task.status+`</span>
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
                    </tr>`;
                });
                
                $('#taskList').html(html);
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
@endsection
