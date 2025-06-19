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
    <div class="container-fluid pl-lg-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4"><h1 class="p-0">Dashboard - My Spend</h1></div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        <div class="row my-3">
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Week to Date</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-calendar-week"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}

            
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Month to Date</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Year to date</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-calendar"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Same period last year</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$1280.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-calendar-minus"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">Other Services
                </h4>
            </div>
             {{-- my spen box --}}
             <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Email account</p>
                            <h4 class="mb-0 amount-text font-weight-bold">100</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-envelope"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}

            
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Mobile SIM	</p>
                            <h4 class="mb-0 amount-text font-weight-bold">10</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-sim-card"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Product</p>
                            <h4 class="mb-0 amount-text font-weight-bold">120</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-box"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text">Support (E4U)</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$1280.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-tools"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- my spen box --}}
            <div class="col-lg-3">
                <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        
                        <!-- Text Section -->
                        <div>
                            <p class="mb-1 label-text font-weight-bold">Year to date total	</p>
                            <h4 class="mb-0 amount-text font-weight-bold">$1280.00</h4>
                        </div>
            
                        <!-- Chart Icon or Image -->
                        <div class="spend-icons">
                            <i class="fas fa-chart-pie"></i>
                        </div>
            
                    </div>
                </div>
            </div>
            {{-- end --}}
        </div>
        <div class="row my-5 d-none">  
            <!-- Advertising Table -->
            <div class="col-md-6 mb-4">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr><th colspan="3" class="text-center">Advertising</th></tr>
                    {{-- <tr>
                      <th>Icon</th>
                      <th>Description</th>
                      <th class="text-center">Value</th>
                    </tr> --}}
                  </thead>
                  <tbody>
                    <tr>
                      <td class="icon-col"><i class="fas fa-hourglass-start"></i></td>
                      <td>Week to date</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-chart-bar"></i></td>
                      <td>Same period last year</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="far fa-calendar-alt"></i></td>
                      <td>Month to date</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-calendar-week"></i></td>
                      <td>Same period last year</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-chart-line"></i></td>
                      <td>Year to date</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-chart-bar"></i></td>
                      <td>Same period last year</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        
            <!-- Other Services Table -->
            <div class="col-md-6 mb-4">
              
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr><th colspan="3" class="text-center">Other Services</th></tr>
                    {{-- <tr>
                      <th>Icon</th>
                      <th>Service</th>
                      <th class="text-center">Value</th>
                    </tr> --}}
                  </thead>
                  <tbody>
                    <tr>
                      <td class="icon-col"><i class="fas fa-envelope"></i></td>
                      <td>Email account</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-sim-card"></i></td>
                      <td>Mobile SIM</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-box"></i></td>
                      <td>Product</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-tools"></i></td>
                      <td>Support (E4U)</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                    <tr>
                      <td class="icon-col"><i class="fas fa-chart-pie"></i></td>
                      <td>Year to date total</td>
                      <td class="text-center">$[value]</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx1 = document.getElementById('miniChart1').getContext('2d');
        new Chart(ctx1, {
          type: 'bar',
          data: {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            datasets: [{
              data: [12, 9, 7, 6, 8, 14, 10],
              backgroundColor: '#ff4d6d',
              borderRadius: 4
            }]
          },
          options: {
            responsive: false,
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: { enabled: false },
            scales: {
              x: { display: false },
              y: { display: false }
            }
          }
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
