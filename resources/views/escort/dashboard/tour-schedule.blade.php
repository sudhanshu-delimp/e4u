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
    <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
                <h1 class="h1">My Tours Schedule</h1>
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
                    <table class="table" id="tourScheduleTable">
                        <thead class="bg-first">
                        
                        <tr>
                            <th>Location</th>
                            <th>Tour Name</th>
                            <th>Days</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        
                        {{-- <tbody>
                            @forelse ($tours as $tour)
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $start = \Carbon\Carbon::parse($tour->start_date);
                                    $end = \Carbon\Carbon::parse($tour->end_date);
                                    $tourStatus = 'current';
                                    $colorCode = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                @endphp
                                    <tr class="">
                                <td class=" task-color bg-white"><i
                                        class="fas fa-circle text-high taski mr-2" style="color: {{$colorCode}}"></i>{{$tour->state->name}}</td>
                                <td class=" task-color text-center bg-white">{{$tour->tour->name}}</td>
                                <td class=" task-color text-center bg-white">{{ \Carbon\Carbon::parse($tour->end_date)->diffInDays(\Carbon\Carbon::parse($tour->start_date)) + 1 }}</td>
                                <td class=" task-color text-center bg-white">{{\Carbon\Carbon::parse($tour->start_date)->format('d-m-Y')}}</td>
                                <td class=" task-color text-center bg-white">{{\Carbon\Carbon::parse($tour->end_date)->format('d-m-Y')}}</td>
                               

                                <td class="theme-color text-center bg-white">
                                    @if($tour->status != 'cancelled')
                                        @if ($today->between($start, $end))
                                            <span class="badge badge-danger-lighten task-1 bg-warning w-75">Current</span>
                                        @elseif ($today->lt($start))
                                            <span class="badge badge-danger-lighten task-1 bg-info w-75">Upcoming</span>
                                        @else
                                            <span class="badge badge-danger-lighten task-1 bg-success w-75">Completed</span>
                                            @php $tourStatus = 'past'; @endphp
                                        @endif
                                    @else
                                            <span class="badge badge-danger-lighten task-1 bg-danger w-75">Cancelled</span>
                                    @endif
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
                                            <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 " href="{{ route('escort.view.tour.list',$tourStatus) }}"> <i class="fa fa-eye"></i> View</a>
                                            @if($tourStatus != 'past')
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 "href="{{ route('escort.view.tour.list',$tourStatus) }}"> <i class="fa fa-pen"></i> Edit</a>
                                            @endif
                                            @if($tour->status != 'cancelled')
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 cancelTour" href="#" data-tour-id="{{$tour->id}}" data-toggle="modal"
                                                    data-target="#new-ban-3"> <i class="fa fa-times"></i> Cancel</a>
                                            @else
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 text-muted" href="#" style="background: #e7e7e7; cursor: not-allowed;"> <i class="fa fa-times text-muted" ></i> Cancel</a>
                                            @endif
                                            <div class="dropdown-divider"></div>
                                                <a class="dropdown-item d-flex align-items-center justify-content-start gap-10 showTourSummary" href="#"  data-tour-id="{{$tour->id}}"> <i class="fa fa-list"></i> Tour Summary</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Tours Found!</td>
                                </tr>
                            @endforelse
                        </tbody> --}}
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
                        <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon">
                        <span class="text-white">  Cancel Tour</span>                        
                     </h5>
                    <button type="button" class="close cancelTourcloseSuccessBtn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                                class="img-fluid img_resize_in_smscreen"></span>
                    </button>
                </div>
                
                <div class="modal-body pb-0 agent-tour">
                    <form>
                        <h4>You are about to cancel your Tour. Are you sure you want to cancel your Tour?</h4>
                        <hr style="background-color: #0C223D" class="mt-3">
                        <input type="hidden" id="cancel_tour_id" value="">
                        <div class="note">
                            <p class="font-weight-bold">Notes:</p>
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
                                        class="btn-cancel-modal ml-2"
                                        data-dismiss="modal" aria-label="Close">Cancel</button>
                                        <button type="button"
                                            class="btn-success-modal ml-2 cancelTourbtn" >Cancel Tour</button>
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
                        <img src="{{ asset('assets/dashboard/img/cancel-travel.png') }}" class="custompopicon">
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
                        <img src="{{ asset('assets/dashboard/img/travel.png') }}" class="custompopicon">
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
                                <td class="location_count">4</td>
                                <th style="color: #0C223D; border-top:1px solid #e3e6f0">Current Location : </th>
                                <td class="location_current">Delhi</td>
                            </tr>
                            <tr>
                               
                                <th style="color: #0C223D;">Current Profiles : </th>
                                <td class="current_profile">Priya Sharma</td>
                                <th style="color: #0C223D;">Fees : </th>
                                <td class="current_fees">$1,200</td>
                            </tr> 
                            <tr>
                                <th style="color: #0C223D;">Tour start date : </th>
                                <td class="tour_start_date">10-06-2025</td>
                                <th style="color: #0C223D;">Tour end date : </th>
                                <td class="tour_end_date">15-06-2025</td>    
                            </tr> 
                            
                            <tr>
                                <td colspan="4">
                                    
                                    <div class="current_date">Date : <span>{{ now()->format('d-m-Y') }}</span></div>
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
     <script>
        $(document).ready(function() {

            var tourScheduleTable = $('#tourScheduleTable').DataTable({
                responsive: true,
                language: {
                    search: "Search:",
                    searchPlaceholder: "Search by location...",
                    lengthMenu: "Show _MENU_ entries",
                    zeroRecords: "No matching records found",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries available",
                    infoFiltered: "(filtered from _MAX_ total entries)"
                },
                paging: true,
                ajax: {
                    url: "{{ route('escort.dashboard.get-tour-schedule-ajax') }}",
                    type: "GET"
                },
                columns: [
                    { data: 'state_name', name: 'state_name' },
                    { data: 'tour_name', name: 'tour_name' },
                    { data: 'days', name: 'days' },
                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'status_badge', name: 'status_badge', orderable: false, searchable: false },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false, class:'text-center' }
                ],
                columnDefs: [
                    { targets: [0], className: 'task-color ' }, 
                    { targets: [1, 2, 3, 4], className: 'task-color' },
                    { targets: [5, 6], className: 'theme-color text-light' }
                ]
            });


            $(document).on('click', '.cancelTour', function(e) {
                e.preventDefault();
                let tour_id = $(this).attr('data-tour-id');
                $('#cancel_tour_id').val(tour_id);
            });

            // $(document).on('click', '.cancelTourcloseSuccessBtn', function(e) {
            //     e.preventDefault();
            //     //location.reload();
            // });

            $(document).on('click', '.cancelTourbtn', function(e) {
                e.preventDefault();
                let tourId = $('#cancel_tour_id').val();
                let actionUrl = '{{ route("escort.dashboard.update-tour-status-ajax") }}';
                var formData = {
                    tour_id: tourId,
                    status: 'cancelled'
                };

                callAjax(formData, actionUrl);
            });

            $(document).on('click', '.showTourSummary', function(e) {
                e.preventDefault();
                let tourId = $(this).attr('data-tour-id');
                let actionUrl = '{{ route("escort.dashboard.get-tour-summary-ajax") }}';
                var formData = {
                    tour_id: tourId
                };

                callAjax(formData, actionUrl);
            });

            function formatDate(dateStr) {
                const d = new Date(dateStr);
                const day = String(d.getDate()).padStart(2, '0');
                const month = String(d.getMonth() + 1).padStart(2, '0');
                const year = d.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function callAjax(formData, actionUrl) 
            {
                $.ajax({
                    url: actionUrl, // form action URL
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.type == 'cancel_tour' && response.status == 'success'){
                            $('#cancel_tour_confirm').modal('show');
                            $('#new-ban-3').modal('hide');

                            tourScheduleTable.ajax.reload(null, false); // Reload DataTable without resetting pagination
                        }

                        if(response.type == 'tour_summary' && response.status == 'success'){
                            let currentLocation = $(".live_current_location").text();
                            $(".location_count").text(response.data.tour.locations.length);
                            $(".location_current").text(currentLocation);
                            $(".current_profile").text(response.data.profiles.map(p => p.escort.name).join(', '));
                            $(".current_fees").text('$' + response.fees);

                            $(".tour_start_date").text(formatDate(response.data.start_date));
                            $(".tour_end_date").text(formatDate(response.data.end_date));
                            $('#tour_summary').modal('show');
                        }

                        
                    },
                    error: function(xhr) {
                        // handle error
                        alert('Something went wrong. Please try again.');
                    }
                });
            }

        })
    </script>
@endsection
