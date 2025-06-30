@extends('layouts.escort')
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
    <div class="container-fluid pl-lg-4">        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="v-main-heading h3 mb-2 pt-4 d-flex align-items-center"><h1 class="p-0">Dashboard - My Tours Schedule</h1>
                <h6 class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></h6>
            </div>
            <div class="back-to-dashboard">
                <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                    <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card collapse" id="notes" style="">
                   <div class="card-body">
                      <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                      <p></p>
                      <ol>
                            <li>All of your Tours are listed here for a twelve month period. To view at Tour that is older than 12 months, <a href="{{url('escort-dashboard/list-tour/past')}}" class="custom_links_design">click here</a>.</li>
                            <li>There are multiple functions available to you by clicking Action.
                            </li>
                      </ol>
                   </div>
                </div>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row mt-2">
            <div class="col-lg-12 mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead style="background-color: #0C223D; color: #ffffff;">
                        
                        <tr class="text-center">
                            <th class="text-left">Location</th>
                            <th>Days</th>
                            <th>Commencing</th>
                            <th>Completing</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                            <tr class="">
                                <td class=" task-color bg-white"><i
                                        class="fas fa-circle text-high taski mr-2"></i>Melbourne</td>
                                <td class=" task-color text-center bg-white">10</td>
                                <td class=" task-color text-center bg-white">01-01-2022</td>
                                <td class=" task-color text-center bg-white">10-01-2022</td>
                                <td class="theme-color text-center bg-white">
                                    <span
                                        class="badge badge-danger-lighten task-1 bg-warning w-75">Current</span>
                                </td>
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item" href="{{ url('escort-dashboard/list-tour/current') }}">View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"href="{{ url('escort-dashboard/list-tour/current') }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-3">Cancel</a>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-4">Completed</a>

                                                <div class="dropdown-divider"></div> --}}
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#tour_summary">Tour Summary</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class=" task-color bg-white"><i
                                        class="fas fa-circle text-info taski mr-2"></i>Sydney</td>
                                <td class=" task-color text-center bg-white">10</td>
                                <td class=" task-color text-center bg-white">01-01-2022</td>
                                <td class=" task-color text-center bg-white">10-01-2022</td>
                                <td class="theme-color text-center bg-white">
                                    <span
                                        class="badge badge-danger-lighten task-1 bg-danger w-75">Upcoming</span>
                                </td>
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item" href="{{ url('escort-dashboard/list-tour/current') }}">View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item"href="{{ url('escort-dashboard/list-tour/current') }}">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-3">Cancel</a>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-4">Completed</a>

                                                <div class="dropdown-divider"></div> --}}
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#tour_summary">Tour Summary</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class=" task-color bg-white"><i
                                        class="fas fa-circle text-primary taski mr-2"></i>Perth</td>
                                <td class=" task-color text-center bg-white">10</td>
                                <td class=" task-color text-center bg-white">01-01-2022</td>
                                <td class=" task-color text-center bg-white">10-01-2022</td>
                                <td class="theme-color text-center bg-white">
                                    <span class="badge badge-danger-lighten task-1">Completed</span>
                                </td>
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item" href="{{ url('escort-dashboard/list-tour/past') }}">View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item disabled" >Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-3">Cancel</a>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-4">Completed</a>

                                                <div class="dropdown-divider"></div> --}}
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#tour_summary">Tour Summary</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class=" task-color bg-white"><i
                                        class="fas fa-circle text-medium taski mr-2"></i>Adelaide</td>
                                <td class=" task-color text-center bg-white">10</td>
                                <td class=" task-color text-center bg-white">01-01-2022</td>
                                <td class=" task-color text-center bg-white">10-01-2022</td>
                                <td class="theme-color text-center bg-white">
                                    <span class="badge badge-danger-lighten task-1">Completed</span>
                                </td>
                                <td class="theme-color text-center bg-white">
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i
                                                class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink" style="">
                                            <a class="dropdown-item" href="{{ url('escort-dashboard/list-tour/past') }}">View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item disabled">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-3">Cancel</a>
                                            <div class="dropdown-divider"></div>
                                            {{-- <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#new-ban-4">Completed</a>

                                                <div class="dropdown-divider"></div> --}}
                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#tour_summary">Tour Summary</a>
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
    {{-- Cancel Tour Popup --}}
    <div class="modal fade upload-modal" id="new-ban-3" tabindex="-1" role="dialog" aria-labelledby="new-ban-3"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/travel.png') }}" style="width:45px; padding-right:10px;">
                        <span class="text-white">  Cancel Tour</span>                        
                     </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form>
                        <p>You are about to cancel your Tour. Are you sure you want to cancel your Tour?</p>
                        <div class="note">
                            <h4>Note:</h4>
                            <ol>
                                <li>If you cancel your Tour, any remaining Fees paid will be credited back to
                                    you. Cancellation is immediate.</li>
                                <li>You can reactivate this Tour by going to the Tours group in the menu.</li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-md-12 my-3 d-flex align-items-center justify-content-between">
                                <div class="">Date : <span>{{ now()->format('d-m-Y') }}</span></div>

                                <div class="form-group mb-0">
                                    <button type="button"
                                        class="btn btn-primary shadow-none  ml-2  bg-danger"
                                        data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="submit"
                                            class="btn btn-primary shadow-none  ml-2 " >Cancel Tour</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    
    {{-- Cancel Tour confirmation popup --}}
    <div class="modal fade upload-modal" id="cancel_tour_confirm" tabindex="-1" role="dialog" aria-labelledby="cancel_tour_confirm"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/cancel-travel.png') }}" style="width:45px; padding-right:10px;">
                        <span class="text-white">Cancellation of Tour - Confirmation</span>                        
                     </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <h4>Your Tour has been cancelled and all Profiles associated with the Tour removed from the
                            Website.</h4>
                        
                        <div class="row">
                            <div class="col-md-12 my-3 d-flex align-items-center justify-content-between">
                                <div class="">Date sent: <span>{{ now()->format('d-m-Y') }}</span></div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    {{-- Completed Tour --}}
    <div class="modal fade upload-modal" id="new-ban-4" tabindex="-1" role="dialog" aria-labelledby="new-ban-4"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-ban-4">Completed Tour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <form method="post" action="#">
                        <h4 class="text-center">Are you sure you want to mark this Appointment as completed?</h4>
                        <div class="row">
                            <div class="col-md-12 my-3 text-center">
                                <div class="form-group">  
                                    <button type="button"
                                    class="btn btn-primary shadow-none ml-2  bg-danger"
                                    data-dismiss="modal" aria-label="Close">No</button>
                                    <button type="submit"
                                        class="btn btn-primary shadow-none ml-2 ">Yes</button>
                                  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}
    {{-- Tour Summary popup --}}
    <div class="modal fade upload-modal" id="tour_summary" tabindex="-1" role="dialog" aria-labelledby="tour_summary"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/travel.png') }}" style="width:45px; padding-right:10px;">
                        <span class="text-white" id="tour_summary">Tour Summary</span>                        
                     </h5>
                  
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                <div class="modal-body pb-0 agent-tour">
                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <tr>
                                <th style="color: #0C223D; border-top:1px solid #e3e6f0;">Locations : </th>
                                <td>4</td>
                                <th style="color: #0C223D; border-top:1px solid #e3e6f0">Current Location : </th>
                                <td>Delhi</td>
                            </tr>
                            <tr>
                               
                                <th style="color: #0C223D;">Current Profiles : </th>
                                <td>Priya Sharma</td>
                                <th style="color: #0C223D;">Fees : </th>
                                <td>$1,200</td>
                            </tr> 
                            <tr>
                                <th style="color: #0C223D;">Tour start date : </th>
                                <td>10-06-2025</td>
                                <th style="color: #0C223D;">Tour end date : </th>
                                <td>15-06-2025</td>    
                            </tr> 
                            
                            <tr>
                                <td colspan="4">
                                    
                                    <div class="">Date : <span>{{ now()->format('d-m-Y') }}</span></div>
                                </td>
                            </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

  
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
@endsection
