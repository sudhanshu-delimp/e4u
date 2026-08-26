@extends('layouts.center')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <div class="col-lg-12">
         <div class="d-sm-flex align-items-center justify-content-between">
            <div class="custom-heading-wrapper">
               <h1 class="h1">Our Statistics</h1>
               <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
            </div>
            <div class="back-to-dashboard">
               <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                  <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
               </a>
            </div>
         </div>
      </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
              <h3 class="NotesHeader"><b>Notes:</b></h3>
               
               <ol>
               </ol>
            </div>
         </div>
      </div>
   </div>

   

        {{-- first row --}}
        <div class="col-lg-12 card-wrapper">                
            <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
                <div class="col-lg-12">
                    <h4 class="font-weight-bold" style="color: var(--blue--text);">Our Statistics
                    </h4>
                </div>
                <!-- Card Start -->
                 <div class="col-lg-12 card-list-wrapper">
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profile Views Today</div>
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                        </div>
                    </div>
              
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Upcoming Profiles
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/followers.png') }}" alt="icon">
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
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/view-profile.png') }}" alt="icon">
                        </div>
                    </div>
                
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Profile Views This Week
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/view-profile-time.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                        </div>
                    </div>
                
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Media Views This Weeks
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Year to Date
                            </div>
                            <div class="statistics-value">0</div>
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
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Reviews This Week
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/comment.png') }}" alt="icon">
                        </div>
                    </div>
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/calendar.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Recommendations Today
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                        </div>
                    </div>
                
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label">Recommendations This Week
                            </div>
                            <div class="statistics-value">0</div>
                        </div>
                        <div class="statistics-icon">
                            <img src="{{ asset('assets/dashboard/img/good-quality.png') }}" alt="icon">
                        </div>
                    </div>
               
                    <div class="statistics-card shadow-sm">
                        <div class="statistics-text">
                            <div class="statistics-label"> Year to Date
                            </div>
                            <div class="statistics-value">0</div>
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
</div>
@endsection
@section('script')
@endsection