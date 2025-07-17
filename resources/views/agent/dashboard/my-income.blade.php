@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <!-- Page Heading -->
      <div class="d-flex align-items-center justify-content-between col-md-12">
         <div class="custom-heading-wrapper">
             <h1 class="h1">Dashboard - My Income</h1>
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
   <div class="row">
       {{-- col-6 --}}
       <div class="col-lg-6 my-2">
         <div class="my-spend-box-wrapper">
                 <div class="row">
                       {{-- my spen box --}}
                     <div class="col-lg-6">
                         <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                             <div class="card-body d-flex align-items-center justify-content-between">
                                 
                                 <!-- Text Section -->
                                 <div>
                                     <p class="mb-1 label-text">Today’s Income</p>
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
                     <div class="col-lg-6">
                         <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                             <div class="card-body d-flex align-items-center justify-content-between">
                                 
                                 <!-- Text Section -->
                                 <div>
                                     <p class="mb-1 label-text font-weight-bold">Month to Date</p>
                                     <h4 class="mb-0 amount-text font-weight-bold">$3,588.00</h4>
                                 </div>
                     
                                 <!-- Chart Icon or Image -->
                                 <div class="spend-icons">
                                     <i class="fas fa-calendar-alt"></i>
                                 </div>
                     
                             </div>
                         </div>
                     </div>
                     {{-- end --}}
                 </div>
         </div>
     </div>
     {{-- end --}}
   </div>
     {{-- end --}}
 


</div>
@endsection
@section('script')
@endsection