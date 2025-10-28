@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
   
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Tours</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
        
        <div class="col-md-12 mb-4">
            <div class="card collapse" id="notes" style="">
                <div class="card-body">
                   <h3 class="NotesHeader"><b>Notes:</b> </h3>
                   <ol>
                     <li>Use this feature if you Tour Australia.</li>
                        <li>The principle behind the Tour Creator is that you can have multiple Profiles Listed in
                            multiple Locations. Before you can create and complete a Tour, you must have
                            created all the Profiles you need for the Locations that will be included in your Tour.</li>
                        <li>You can also include Pin Up in any of the Locations that are included in the Tour.</li>
                   </ol>
                </div>
             </div>
        </div>
    </div>
    
            <div class="row how-it-done">
              <div class="col-md-12 mt-2 mb-5">
                <div id="accordion" class="myacording-design">
              
                  <!-- New -->
                  <div class="card">
                    <div class="card-header" id="headingNew">
                      <h2 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew" aria-expanded="false">
                          New
                        </a>
                      </h2>
                    </div>
                    <div id="collapseNew" class="collapse" aria-labelledby="headingNew" data-parent="#accordion">
                      <div class="card-body">
              
                        <h5><b>Overview</b></h5>
                        <div class="">
                            <p>
                            Use this feature to create a New Tour. You can create as many Locations within the Tour as you like, and also as many Profiles for each Location you will be visiting.
                          </p>
                            
                            <p class="my-3">
                            If you want to be a Pin Up in any of the Locations, if the Pin Up week is available during the days you are at that Location, then you can also add the Pin Up feature to the Location.
                            </p>
                          <div class="doc-img my-3">
                             <img src="{{ asset('assets/dashboard/img/new-tour.png') }}" alt="" class="w-100">
                          </div>
                        </div>
              
                        <h5><b>Features</b></h5>
                        <ul class="custom-ul">
                          <li>Create an entire Tour in the one process</li>
                          <li>Easy to follow</li>
                          <li>Multiple Profile Listings for each Location</li>
                          <li>Include the Pin Up if it is available</li>
                        </ul>
              
                        <h5><b>How is it done</b></h5>
                        
                        <h5 class="sec-head">Tour name</h5>
                        <p>
                          To create a Tour you must first give the Tour a name. It is up to you how you label your Tour, but we recommend whatever you decide, you then maintain it. For example you could name a Tour: August2025 (no spaces).
                        </p>
              
                        <h5 class="sec-head">Location</h5>
                        <p>
                          The next step is to select your first Location, where the Tour starts from. Click the Location button and by default your Home State will load. You can change the Location to any Location, provided you have created Profiles for the Location you select.
                        </p>
                        <p>
                          The next step is to select the start date and end date for that Location. You can insert the dates manually, or use the calendar pop up.
                        </p>
                        <p>
                          Next, add the Profile you have created for that Location. You can change the Stage Name if you want. If you change the Stage Name you will be asked if you want to save the change to the Profile. If you answer Yes the Profile will update, if you answer No, the Profile will remain unchanged but the new Stage Name will be applied to the Profile for the Tour.
                        </p>
                        <p>
                          Lastly, select the Membership Type you want for the profile. Platinum Membership will load by default.
                        </p>
                        <p>
                          You have now completed your first Location. If you want you can add additional Profiles to the Location by clicking the Add Profile button, and repeating the process. To save the setting, click Add Location, and the next Location will appear. Repeat the procedure until you have completed all the Locations and Profiles for those Locations. As you add a Location, the Tour Creator will auto-fill the start date for the next Location.
                        </p>
                        <p>
                          When you have completed the Tour, click Save.
                        </p>
              
                        <h5 class="sec-head">Pin Up</h5>
                        <p>
                          If you want to add the Pin Up feature to any of the Locations, go to <a href="{{ route('escort.list', 'current') }}" class="custom_links_design">Profiles Listed</a> and follow the procedure to List Pin Up.
                        </p>
              
                      </div>
                    </div>
                  </div>
              
                  <!-- Current -->
                  <div class="card">
                    <div class="card-header" id="headingCurrent">
                        <h2 class="mb-0">
                          <a class="card-link collapsed" data-toggle="collapse" href="#collapseCurrent" aria-expanded="false">
                            Current
                          </a>
                        </h2>
                    </div>
                    <div id="collapseCurrent" class="collapse" aria-labelledby="headingCurrent" data-parent="#accordion">
                      <div class="card-body">
                        <h5><b>Overview</b></h5>

                        
                        <p>
                          A comprehensive report summarising your Current Tours. You can create short or long Tours. It is entirely up to you, but you must have a minimum of two Locations in the Tour. 
                          You can manage your Tours from the Dashboard <a href="{{ route('escort.dashboard.tour-schedule') }}" class="custom_links_design">My Tour Schedule</a> as well as from your  <a href="{{ url('escort-dashboard/list-tour/current') }}" class="custom_links_design">Current Tours</a> report.
                        </p>
              
                        <h5><b>Features</b></h5>
                        <ul class="custom-ul">
                          <li>Manage your current Tour/s from the one location</li>
                          <li>Comprehensive summary of your Tour schedule</li>
                        </ul>
                        
                          <h5><b>How is it done</b></h5>

                            <div class="row">
                              <div class="col-lg-7">
                                <p>
                                  You can view in detail all the particulars associated with your current Tour. You can also action a Tour from the Action list, such as Edit, Cancel, View and Tour Summary.
                                </p>
                                <p>
                                  The edit feature is particularly helpful for changing any Profile's start or finish date, Membership Type or to remove a Profile from the Tour. Any changes to the Tour will automatically adjust your Fee to reflect the changes, including any refund. Refunds will be added to your Account as a Credit to be used for future listings and Tours.
                                </p>
                                <p>
                                  The Tour Summary also displays the Fees paid for the Tour.
                                </p>
                              </div>
                              <div class="col-lg-5">
                                <div class="doc-img">
                                  <img src="{{ asset('assets/dashboard/img/tour-summarys.png') }}" alt="" class="w-100">
                                </div>
                              </div>
                            </div>
                          
              
                      </div>
                    </div>
                  </div>
              
                  <!-- Past -->
                  <div class="card">
                    <div class="card-header" id="headingPast">
                      <h2 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapsePast" aria-expanded="false">
                          Past
                        </a>
                      </h2>
                    </div>
                    <div id="collapsePast" class="collapse" aria-labelledby="headingPast" data-parent="#accordion">
                      <div class="card-body">
                        <h5><b>Overview</b></h5>
                        <p>
                          All of your completed Tours are retained and can be reactivated as a new Tour.
                        </p>
              
                        <h5><b>Features</b></h5>
                        <ul class="custom-ul">
                          <li>Historical record of completed Tours</li>
                          <li>Reactivate a Tour</li>
                        </ul>
              
                        <h5><b>How is it done</b></h5>
                        <p>
                          View any completed Tour to see a summary of the components to the Tour. If you have a past Tour that has the Locations and Profiles that you want to use in a New Tour, then select from the Action list ‘New Tour’ and the Tour will load for you. Change the start and end dates for Each Location and Save.
                        </p>
              
                      </div>
                    </div>
                  </div>
              
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
    
@endpush
