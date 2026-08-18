@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <div class="cal-lg-12 w-100">
         @if($agentNotifications)
         @foreach ($agentNotifications as $notification)
             <x-global.notification-alert :heading="$notification['heading']" :content="$notification['content'] ?? $notification['template_name']" type="success"
             :member="null"
             />
         @endforeach
         @endif
          
      </div>
      <div class="custom-heading-wrapper col-md-12">
         <h1 class="h1">Dashboard</h1>
         <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>

      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
              <h3 class="NotesHeader"><b>Notes:</b></h3>
               <ol>
                  <li>Click the card to view information.</li> 
                  <li>For an expanded summary of card items, refer to the side bar menu under the relevant
                     section.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

   
   <div class="row mb-4">
      
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ route('agent.my.appointment.list') }}">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/my-appointments.png') }}" alt="My Appointments">
                  </div>
                  <h2>
                     My Appointments
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ route('agent.task-list') }}">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/task-list.png') }}" alt="Task List">
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
              <a href="{{ route('agent.my-statistics') }}">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/my-statistics.png') }}" alt=" My Statistics">
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
              <a href="{{ route('agent.advertiser-list') }}?from=dashboard">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/my-advertisers.png') }}" alt="My Advertisers">
                  </div>
                  <h2>
                     My Advertisers
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ route('agent.advertisers') }}">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/my-advertisers.png') }}" alt="Advertisers ">
                  </div>
                  <h2>
                     Advertisers (Summary) 
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}
      
      {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
         <div class="my-custom-box shadow-sm">
             <a href="{{ route('agent.marketing.database.centres') }}?from=dashboard">
                 <div class="box-icon">
                     <img src="{{ asset('assets/dashboard/img/boxicon/icon_logs-stats.png') }}" alt=" Database (Centers)">
                 </div>
                 <h2>
                  Database (Centers)
                 </h2>
             </a>

         </div>
     </div>
     {{-- end --}}
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ route('Fees.my-income') }}?from=dashboard">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/agent/my-income.png') }}" alt="My Income">
                  </div>
                  <h2>
                      My Income
                  </h2>
              </a>

          </div>
      </div>
     
      {{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ url('submit_ticket') }}?from=dashboard">
                  <div class="box-icon">
                      <img src="{{ asset('assets/dashboard/img/boxicon/icon_support-tickets.png') }}" alt="Support Tickets">
                  </div>
                  <h2>
                     Support Tickets
                  </h2>
              </a>

          </div>
      </div>
      {{-- end --}}{{-- box start --}}
      <div class="col-lg-4 box-wrapper">
          <div class="my-custom-box shadow-sm">
              <a href="{{ route('agent.logs-and-status') }}">
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
  </div>




   <div class="row agent-dash d-none">
      <div class="col-lg-8 pr-2">
         <div class="sec-one">
            <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Statistics</h2>
            <div class="row">
               <div class="col-md-3">
                  <div class="card static-sec">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">My Escorts</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">25</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec-2">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">My Massage Centres</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-1.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">Escort Profiles Posted</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">32</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-2.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
               <div class="col-md-3 pl-0">
                  <div class="card static-sec-2">
                     <div class="card-body">
                        <div class="text-xs font-weight-bold mb-1 text-muted">Massage Profiles Posted</div>
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="h2 mb-0 font-weight-bold text-gray-800">125</div>
                           </div>
                           <div class="col-auto">
                              <img src="{{ asset('assets/app/img/account-multiple-3.png')}}">
                           </div>
                        </div>
                     </div>
                     <!-- end card-body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="sec-one pb-4">
            <h2 class="h5 mt-2 mb-4 text-gray-800 font-weight-bold">My Income</h2>
            <div class="row pb-1">
               <div class="col-md-6 pr-0">
                  <div class="card">
                     <div class="card-body pl-2 pr-2 pt-4 pb-4 mt-1">
                        <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                              <div class="text-xs font-weight-bold mb-1 text-muted">Today’s Income</div>
                              <div class="h6 mb-0 font-weight-bold text-gray-800">$ 580.00</div>
                           </div>
                           <div class="col-6">
                              <img src="{{ asset('assets/app/img/account-multiple-4.png')}}" class="img-fluid">
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
                              <img src="{{ asset('assets/app/img/account-multiple-4.png')}}" class="img-fluid">
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
</div>
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">View Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="card-body">
               <div class="row">
                  <div class="col mt-0">
                     <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl pr-3 mt-1">
                           <img src="{{ asset('assets/img/agn-img.png')}}">
                        </div>
                        <div class="ms-3 name">
                           <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                           <h6 class="text-muted mb-0 small">Member ID: E03152 </h6>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body row">
                  <div class="row w-100">
                     <table class="table total-summary">
                        <tbody>
                           <tr>
                              <td class="border-0 w-25"><b>Date:</b></td>
                              <td class="border-0">31/12/2022</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Time: </b></td>
                              <td class="border-0">11:00 AM</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Address:</b></td>
                              <td class="border-0">Western Australia</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Phone Number:</b></td>
                              <td class="border-0">0123456789</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Comments</b></td>
                              <td class="border-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt.</td>
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
<div class="modal fade upload-modal" id="new-ban" tabindex="-1" role="dialog" aria-labelledby="new-ban" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban">View Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
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
<div class="modal fade upload-modal" id="new-ban-2" tabindex="-1" role="dialog" aria-labelledby="new-ban-2" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban-2">Reschedule Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="card-body pb-0">
               <div class="row">
                  <div class="col mt-0">
                     <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl pr-3 mt-1">
                           <img src="{{ asset('assets/img/agn-img.png')}}">
                        </div>
                        <div class="ms-3 name">
                           <h5 class="primery_color normal_heading mb-0" data-toggle="modal" data-target="#Agent_Name"><a class="collapse-item" href="#"><b>Carla Brasil</b></a></h5>
                           <h6 class="text-muted mb-0 small">Member ID: E03152 </h6>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body row">
                  <div class="row w-100">
                     <table class="table total-summary">
                        <tbody>
                           <tr>
                              <td class="border-0 w-25"><b>Date:</b></td>
                              <td class="border-0"><input type="Date" class="form-control w-75" placeholder="Date" value="19-08-2022"></td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Time: </b></td>
                              <td class="border-0"><input type="time" class="form-control w-75" placeholder="Time" value="05:12"></td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Address:</b></td>
                              <td class="border-0">Western Australia</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Phone Number:</b></td>
                              <td class="border-0">0123456789</td>
                           </tr>
                           <tr>
                              <td class="border-0 w-25"><b>Comments</b></td>
                              <td class="border-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Diam egestas erat diam mauris, purus auctor nibh tincidunt.</td>
                           </tr>
                        <tr>
                              <td class="border-0 w-25"></td>
                              <td class="border-0 bg-white"><div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                     </div></td>
                           </tr></tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="new-ban-3" tabindex="-1" role="dialog" aria-labelledby="new-ban-3" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-ban-3">Cancel Appointment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#">
               <h4>Are you sure you want to cancel this Appointment?</h4>
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                        <button type="button" class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger" data-dismiss="modal" aria-label="Close">No</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="modal fade upload-modal" id="new-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="new-task">Create New Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">Importance</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task">
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none">Add New Task</button>
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="edit-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="edit-task">Edit Tasks</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">High</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task" value="Follow up Bill re appointment">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 pr-0">
                  <div class="form-group">
                     <select class="custom-select rounded-0" name="state">
                        <option value="">High</option>
                        <option>Importance</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="form-group">
                     <input type="text" class="form-control rounded-0" required="" placeholder="Task" value="Follow up Bill re appointment">
                  </div>
               </div>
               <div class="col-md-12 mb-3">
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary shadow-none float-right">Save</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade upload-modal" id="delete-task" tabindex="-1" role="dialog" aria-labelledby="new-ban-4" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="delete-task">Delete task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0 agent-tour">
            <form method="post" action="#">
               <h4>Are you sure you want to Delete this task?</h4>
               <div class="row">
                  <div class="col-md-12 mb-3">
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary shadow-none float-right ml-2 border-0">Yes</button>
                        <button type="button" class="btn btn-primary shadow-none float-right ml-2 border-0 bg-danger" data-dismiss="modal" aria-label="Close">No</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@include('modal.console-expiry-password')
@endsection
@section('script')
<script>
   // save logged user details on escord dashboard on page load
        document.addEventListener("DOMContentLoaded", function () {
            let platform = navigator.platform;
            let browser = navigator.userAgent;
            let lastPage = document.referrer;
            let lastVisitedPage= window.location.pathname;

            console.log("platform jiten: " + platform);

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
</script>
@endsection