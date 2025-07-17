@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <!-- Page Heading -->
      <div class="d-flex align-items-center justify-content-between col-md-12">
         <div class="custom-heading-wrapper">
             <h1 class="h1">Dashboard - My Statistics</h1>
             <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
         <div class="back-to-dashboard">
             <a href="{{ url()->previous() ?? route('dashboard.home') }}">
                 <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
             </a>
         </div>
     </div>
      <div class="col-md-12 mb-4">
         <div class="card collapse" id="notes" style="">
            <div class="card-body">
               <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
               <ol>
                 
               </ol>
            </div>
         </div>
      </div>
   </div>

      {{-- first row --}}
      <div class="col-lg-12">                
         <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;">                  
             <div class="col-lg-12">
                 <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics
                 </h4>
             </div>
             <!-- Card Start -->
             <div class="col-md-3 mb-3">
                 <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label">My Escorts
                        </div>
                         <div class="statistics-value">25</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/view-profile.png') }}" alt="icon">
                     </div>
                 </div>
             </div>
             <!-- Card End -->
             <!-- Card Start -->
             <div class="col-md-3 mb-3">
                 <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label">My Massage Centres
                         </div>
                         <div class="statistics-value">125</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/media-view.png') }}" alt="icon">
                     </div>
                 </div>
             </div>
             <!-- Card End -->
             <!-- Card Start -->
             <div class="col-md-3 mb-3">
                 <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label">Escort Profiles Posted
                         </div>
                         <div class="statistics-value">32</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                     </div>
                 </div>
             </div>
             <!-- Card End -->
             <!-- Card Start -->
             <div class="col-md-3 mb-3">
                 <div class="statistics-card d-flex justify-content-between align-items-center shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label">Massage Profiles Posted
                         </div>
                         <div class="statistics-value">125</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
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