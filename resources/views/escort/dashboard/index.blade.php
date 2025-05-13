@extends('layouts.escort')
@section('content')
    <div class="container-fluid pl-lg-4">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4">Dashboard</div>
        </div>
        <div class="row agent-dash">
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
        <div class="row mt-3 mb-5">
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
                            {{-- <div class="col-md-12">
                     <input type="submit" id='new_task' value="New Task" class="btn btn-sm btn-primary shadow-none create-tour-sec" name="submit">
                     <input type="submit" id='edit_task' value="Edit Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                     <input type="submit" id='complete_task' value="Complete Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                     <input type="submit" id='view_task' value="View Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                     <input type="submit" id='open_task' value="Open Task" class="btn btn-primary shadow-none create-tour-sec" name="submit">
                  </div> --}}
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
                            <div class="text-center mr-5">
                                <label class="font-weight-bold mb-0">Status</label>
                            </div>
                        </div>
                        <div class="card-body pl-1 Dash-table">
                            <div class="table-full-width">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-high taski mr-2"></i>Follow up Bill re
                                                appointment</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-1">Done</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-high taski mr-2"></i>Check Commission
                                                Statement</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-medium taski mr-2"></i>Prepare Information
                                                Package for Lin's Massage Centre</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-medium taski mr-2"></i>Follow up Carla Brasil
                                                for Visa Application</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-low taski mr-2"></i>Create Tour for Oxi
                                                Miller on 15/08/2022</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-low taski mr-2"></i>Update Home State for
                                                Carla Brasil on 01/09/2022</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0 pl-0 pr-0">
                                                <div class="form-check m-0 p-0">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                        <span class="form-check-sign"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-0 pl-0 task-color"><i
                                                    class="fas fa-circle text-low taski mr-2"></i>Research Joondalup for
                                                Massage Centres</td>
                                            <td class="td-actions text-right border-0">
                                                <span class="badge badge-danger-lighten task-2">Inprogress</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    <h5 class="modal-title" id="new-ban-4">New Task</h5>
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
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Reusable click event
            $('.create-tour-sec').on('click', function(e) {
                e.preventDefault();

                let buttonId = $(this).attr('id');
                let taskName = $(this).text();

                // Set modal content dynamically
                $('#taskModalLabel').text(taskName);
                $('#taskModalContent').text(`You clicked on "${taskName}" button (ID: ${buttonId}).`);

                // Show modal
                $('#taskModal').modal('show');
            });
        });
    </script>
@endsection
