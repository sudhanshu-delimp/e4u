@extends('layouts.escort')
@section('content')
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-12 custom-heading-wrapper"><h1 class="h1">Dashboard</h1>
                <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
          </div>
          <div class="col-md-12 mb-4">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                           <li>Click the card to view information.</li> 
                           <li>
                            Some features can be changed here as well as from the relevant subject page. Where you make a change, the relevant subject page will be updated.
                           </li>
                      </ol>
                   </div>
                </div>
          </div>
        </div>
        <div class="row">
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('escort.dashboard.escorts-statistics') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_escort-statistics.png') }}" class="my-svg-icons" alt="Escorts Statistics">
                        </div>
                        <h2>
                            Escorts Statistics
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('escort.dashboard.my-playmates') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-playmates01.png') }}" class="my-svg-icons" alt=" My Playmates">
                        </div>
                        <h2>
                           My Playmates
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm mt-0">
                    <a href="{{ route('escort.dashboard.my-spend') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-spend.png') }}" class="my-svg-icons" alt="My Spend">
                        </div>
                        <h2>
                            My Spend
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('escort.dashboard.my-statistics') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_my-statistics.png') }}" class="my-svg-icons" alt="My Statistics">
                        </div>
                        <h2>
                            My Statistics
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('escort.dashboard.task-list') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_tasklist.png') }}" class="my-svg-icons" alt="Task List">
                        </div>
                        <h2>
                            Task List
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}
            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('escort.dashboard.tour-schedule') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/icon_tour-schedule.png') }}" class="my-svg-icons" alt="Tour Schedule">
                        </div>
                        <h2>
                            My Tour Schedule
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}

            {{-- box start --}}
            <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ route('logs.and.status') }}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/boxicon/agent/logs-and-statistics.png') }}" alt="Logs & Status">
                        </div>
                        <h2>
                        Logs & Status
                        </h2>
                    </a>

                </div>
            </div>
            {{-- end --}}


        <!-- ########## Customise Dashboard ################ -->
        <?php
         $viewers = config('constants.dashboard_viewer.escort');
         if(!empty($viewers))
         {
             $my_view = isset($viewer_array->my_view) ? $viewer_array->my_view : [];
             foreach($viewers as $view) :
             $checked = (  isset($my_view[$view['key']]) && $my_view[$view['key']])? true : false ; 
             if(!$checked)
             continue;
         ?>
                <div class="col-lg-4 box-wrapper">
                <div class="my-custom-box shadow-sm">
                    <a href="{{ url($view['link'])}}">
                        <div class="box-icon">
                            <img src="{{ asset('assets/dashboard/img/'.$view['icon'].'')}}" class="my-svg-icons" alt="{{$view['name']}}">
                        </div>
                        <h2>
                           {{$view['name']}}
                        </h2>
                    </a>

                </div>
                </div>

            <?php
             endforeach;
            } 
            ?>
        <!-- ########## End Customise Dashboard ################ -->

        </div>
        <div class="row my-3">
            <div class="col-lg-12">
                <div class="d-flex align-items-center justify-content-end custom-dash-btn">
                    <a href="{{ route('escort.dashboard.customise-dashboard') }}">Customise Dashboard <i class="fas fa-cog "></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- display none d-none --}}

        <div class="row agent-dash d-none" >
            <div class="col-lg-8 pr-2">
                <div class="sec-one">
                    <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card static-sec">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Profile Views Today</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-0.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Media Views Today</div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-00.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Recommendations This Week
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-000.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="card static-sec-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Reviews Posted This Week
                                            </div>
                                            <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                                        </div>
                                        <div class="col-auto mt-3">
                                            <img src="{{ asset('assets/app/img/account-multiple-0000.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pl-2">
                <div class="sec-one pb-4">
                    <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Spend</h2>
                    <div class="row pb-1">
                        <div class="col-md-6 pr-0">
                            <div class="card">
                                <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Week to Date</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                                        </div>
                                        <div class="col-6">
                                            <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold mb-1 text-muted">Month to Date</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">$ 3588.00</div>
                                        </div>
                                        <div class="col-6">
                                            <img src="{{ asset('assets/app/img/account-multiple-4.png') }}"
                                                class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- display none d-none --}}
        <div class="row mt-3 mb-5 d-none">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7 pr-2">
                <div class="card shadow mb-3">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h2 class="h5 text-gray-800 font-weight-bold">Task List</h2>
                        <span aria-hidden="true"><a href="#"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                    class="img-fluid img_resize_in_smscreen"></a></span>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body task-sec">
                        <div class="d-flex align-items-center mb-2  row">
                            <div class="col-md-12">
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
                            </div>
                            <div class="col-md-12">
                                <div class="text-center small d-flex justify-content-start mt-1 w-100 task-sec">
                                    <span class="mr-2">Importance:</span>
                                    <span class="mr-2">High</span><i class="fas fa-circle text-high mr-2"></i>
                                    <span class="mr-2">Medium</span>
                                    <i class="fas fa-circle text-medium mr-2"></i>
                                    <span class="mr-2">Low</span>
                                    <i class="fas fa-circle text-low"></i>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4 justify-content-between">
                            <label class="font-weight-bold mb-0">Task</label>
                            <div class="text-center ">
                                <label class="font-weight-bold mb-0" style="margin-left: 220px;">Status</label>
                            </div>
                            <div class="text-center">
                                <label class="font-weight-bold mb-0" style="margin-right: 35px">Action</label>
                            </div>
                        </div>
                        {{-- $tasks --}}
                        <div class="card-body pl-1 Dash-table task_table">
                            <div class="table-full-width">
                                <table class="table" >
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
                            <div class="d-flex justify-content-center mt-4 custome_paginator">
                                {{-- {!! $tasks->links() !!} --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mb-3">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                        <h2 class="h5 text-gray-800 font-weight-bold">My Tours Schedule</h2>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body task-sec">
                        <div class="card-body pl-1 Dash-table">
                            <div class="table-responsive-xl">
                                <table class="table apoint-sec">
                                    <thead>
                                        <tr>
                                            <th class="pl-0 w-25" scope="col">Location</th>
                                            <th scope="col">Days</th>
                                            <th scope="col">Arriving</th>
                                            <th scope="col">Departing</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th class="float-right border-0" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="row-color">
                                            <td class="border-0 pl-0 task-color bg-white"><i
                                                    class="fas fa-circle text-primary taski mr-2"></i>Perth</td>
                                            <td class="border-0 task-color bg-white">10</td>
                                            <td class="border-0 task-color bg-white">01-01-2022</td>
                                            <td class="border-0 task-color bg-white">10-01-2022</td>
                                            <td class="theme-color text-center bg-white">
                                                <span class="badge badge-danger-lighten task-1">Completed</span>
                                            </td>
                                            <td class="theme-color text-center pr-0 bg-white">
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
                                                            data-target="#new-ban">View</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-2">Reschedule</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-3">Cancel</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-4">Completed</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-color">
                                            <td class="border-0 pl-0 task-color bg-white"><i
                                                    class="fas fa-circle text-medium taski mr-2"></i>Adelaide</td>
                                            <td class="border-0 task-color bg-white">10</td>
                                            <td class="border-0 task-color bg-white">01-01-2022</td>
                                            <td class="border-0 task-color bg-white">10-01-2022</td>
                                            <td class="theme-color text-center bg-white">
                                                <span class="badge badge-danger-lighten task-1">Completed</span>
                                            </td>
                                            <td class="theme-color text-center pr-0 bg-white">
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
                                                            data-target="#new-ban">View</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-2">Reschedule</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-3">Cancel</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-4">Completed</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-color">
                                            <td class="border-0 pl-0 task-color bg-white"><i
                                                    class="fas fa-circle text-high taski mr-2"></i>Melbourne</td>
                                            <td class="border-0 task-color bg-white">10</td>
                                            <td class="border-0 task-color bg-white">01-01-2022</td>
                                            <td class="border-0 task-color bg-white">10-01-2022</td>
                                            <td class="theme-color text-center bg-white">
                                                <span
                                                    class="badge badge-danger-lighten task-1 bg-warning w-75">Current</span>
                                            </td>
                                            <td class="theme-color text-center pr-0 bg-white">
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
                                                            data-target="#new-ban">View</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-2">Reschedule</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-3">Cancel</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-4">Completed</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="row-color">
                                            <td class="border-0 pl-0 task-color bg-white"><i
                                                    class="fas fa-circle text-info taski mr-2"></i>Sydney</td>
                                            <td class="border-0 task-color bg-white">10</td>
                                            <td class="border-0 task-color bg-white">01-01-2022</td>
                                            <td class="border-0 task-color bg-white">10-01-2022</td>
                                            <td class="theme-color text-center bg-white">
                                                <span
                                                    class="badge badge-danger-lighten task-1 bg-danger w-75">Pending</span>
                                            </td>
                                            <td class="theme-color text-center pr-0 bg-white">
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
                                                            data-target="#new-ban">View</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-2">Reschedule</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-3">Cancel</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#new-ban-4">Completed</a>
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
            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5 pl-2">
                <div class="row agent-dash">
                    <div class="col-lg-12">
                        <div class="sec-one pb-4 rounded" style="background: #5D6D7E;">
                            <h2 class="h5 mt-2 mb-4 text-white">Escort Statistics</h2>
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 pl-3 d-flex flex-row align-items-center justify-content-between border-0">
                                    <h2 class="h5 text-gray-800 font-weight-bold">Followers Online (Legbox)
                                    </h2>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="border-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">In my location:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-0">15</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Outside my location:
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">15</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                                    <h2 class="h5 text-gray-800 font-weight-bold">Finance</h2>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="border-0 leftside-table">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Credit:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-0">$ 500.00</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Loyalty days:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">2</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                                    <h2 class="h5 text-gray-800 font-weight-bold">Logs & Status</h2>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="border-0 leftside-table">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Login count:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-0">526</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Last login:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">11/3/22 | 12:32:02 PM</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Home State:</div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">Western Australia</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1 font-weight-bold">Password Expiry:
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right">Never</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between border-0">
                                    <h2 class="h5 text-gray-800 font-weight-bold">My Playmates</h2>
                                    <h2 class="h5 text-gray-800">5</h2>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="border-0 leftside-table">
                                                        <div class="d-flex followers">
                                                            <div>
                                                                <div class="d-flex">
                                                                    <a href="#"><img
                                                                            src="{{ asset('assets/app/img/ellipse-1.png') }}"
                                                                            class="img-fluid rounded-circle"
                                                                            alt=" "></a>
                                                                    <a href="#"><img
                                                                            src="{{ asset('assets/app/img/ellipse-2.png') }}"
                                                                            class="img-fluid rounded-circle"
                                                                            alt=" "></a>
                                                                    <a href="#"><img
                                                                            src="{{ asset('assets/app/img/ellipse-3.png') }}"
                                                                            class="img-fluid rounded-circle"
                                                                            alt=" "></a>
                                                                    <a href="#"><img
                                                                            src="{{ asset('assets/app/img/ellipse-4.png') }}"
                                                                            class="img-fluid rounded-circle"
                                                                            alt=" "></a>
                                                                    <a href="#"> <img
                                                                            src="{{ asset('assets/app/img/ellipse-5.png') }}"
                                                                            class="img-fluid rounded-circle"
                                                                            alt=" "> </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-0 pt-4"><a class="theme-text-color"
                                                            href="#">See All</a></td>
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
    </div>
    <div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban">View Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="Date" class="form-control" placeholder="Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="time" class="form-control" placeholder="Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder=" ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" placeholder=" ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder=" ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea class="form-control" placeholder=" " rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade upload-modal" id="new-ban-2" tabindex="-1" role="dialog" aria-labelledby="new-ban-2"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban-2">Reschedule Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="Date" class="form-control" placeholder="Date" value="19-08-2022">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="time" class="form-control" placeholder="Time" value="05:12">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder=" " value="Carla Brasil">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" placeholder=" " value="0987654321">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder=" "
                                        value="910 Albany Highway East Victoria Park WA 610
                           ">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Comments</label>
                                    <textarea class="form-control" placeholder=" " rows="3">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary shadow-none float-right">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade upload-modal" id="new-ban-3" tabindex="-1" role="dialog" aria-labelledby="new-ban-3"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban-3">Cancel Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <h4>Are you sure you want to cancel this Appointment?</h4>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                                    <button type="button"
                                        class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                        data-dismiss="modal" aria-label="Close">No</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade upload-modal" id="new-ban-4" tabindex="-1" role="dialog" aria-labelledby="new-ban-4"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban-4">Completed Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <h4>Are you sure you want to mark this Appointment as completed?</h4>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                                    <button type="button"
                                        class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                        data-dismiss="modal" aria-label="Close">No</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- open tour section button -->
    <div class="modal fade upload-modal" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="new-ban-4"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="task_title">New Task</h5>
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
                                    <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0"
                                        id="save_button">Yes</button>
                                    <button type="button"
                                        class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger"
                                        data-dismiss="modal" aria-label="Close" id="cancel_button">No</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .toggle-task-form {
            font-size: 16px;
            /* color: #007bff; */
            display: inline-block;
            margin: 20px 0px;
        }

        .agent-tour .card {
            padding: 5px 12px !important;
        }

        .upload-modal .btn {
            padding: 7px 20px 7px 20px !important;
            background: #087132;
        }
        .page-item:hover .fa {
            color: white !important;
        }

        .page-item:hover .page-link {
            color: white;
        }
    </style>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>

    // save logged user details on escord dashboard on page load
    document.addEventListener("DOMContentLoaded", function () {
        let platform = navigator.platform;
        let browser = navigator.userAgent;
        let lastPage = document.referrer;
        let lastVisitedPage= window.location.pathname;

        fetch("{{ route('user.log-details') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                platform: platform,
                browser: browser,
                last_page: lastPage,
                lastVisitedPage: lastVisitedPage
            })
        }).then(response => response.json())
        .then(data => console.log("Log Saved:", data))
        .catch(error => console.error("Error:", error));
    });

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
