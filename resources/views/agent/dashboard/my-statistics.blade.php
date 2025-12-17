@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <!-- Page Heading -->
      <div class="d-flex align-items-center justify-content-between col-md-12">
         <div class="custom-heading-wrapper">
             <h1 class="h1">My Statistics</h1>
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
                    <li>You can view all of your statistics here.</li>
                    <li>For an expanded summary on any of your statistics, go to Analytics in the side bar menu.</li>
               </ol>
            </div>
         </div>
      </div>
   </div>

      {{-- 1st row --}}
      <div class="col-lg-12 card-wrapper">                
         <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;"> 
            {{-- 1st --}}
             <div class="col-lg-12">
                 <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics - Memberships (Advertisers)
                 </h4>
             </div>
            <div class="col-lg-12 card-list-wrapper">
                 <div class="statistics-card shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label font-weight-bold">New today</div>
                         <div class="statistics-value">4</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                     </div>
                 </div>
            
                 <div class="statistics-card shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label font-weight-bold">New this week
                         </div>
                         <div class="statistics-value">7</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                     </div>
                 </div>
            
                 <div class="statistics-card shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label font-weight-bold">New this month
                         </div>
                         <div class="statistics-value">25</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                     </div>
                 </div>
            
                 <div class="statistics-card shadow-sm">
                     <div class="statistics-text">
                         <div class="statistics-label font-weight-bold">Total
                         </div>
                         <div class="statistics-value">423</div>
                     </div>
                     <div class="statistics-icon">
                         <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                     </div>
                 </div>
         </div>
             {{-- 2nd --}}
             <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics (Escorts)

                </h4>
            </div>
           <div class="col-lg-12 card-list-wrapper">
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New today
                       </div>
                        <div class="statistics-value">1</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this week
                        </div>
                        <div class="statistics-value">3</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this month
                        </div>
                        <div class="statistics-value">10</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">Total
                        </div>
                        <div class="statistics-value">78</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
         </div>
            
             {{-- 3rd --}}
             <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics (Massage Centres)

                </h4>
            </div>
           <div class="col-lg-12 card-list-wrapper">
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New today
                       </div>
                        <div class="statistics-value">3</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this week
                        </div>
                        <div class="statistics-value">4</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this month
                        </div>
                        <div class="statistics-value">15</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">Total
                        </div>
                        <div class="statistics-value">345</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/membership.png') }}" alt="icon">
                    </div>
                </div>
         </div>
         </div>
     </div>
     {{-- end --}}


      {{-- 2nd row --}}
      <div class="col-lg-12 card-wrapper">                
        <div class="row p-4 rounded my-2" style="background-color: #c2cfe052;"> 
           {{-- 1st --}}
            <div class="col-lg-12">
                <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics - Profiles (Advertisers)
                </h4>
            </div>
            <div class="col-lg-12 card-list-wrapper">
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New today
                       </div>
                        <div class="statistics-value">4</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this week
                        </div>
                        <div class="statistics-value">7</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">New this month
                        </div>
                        <div class="statistics-value">25</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                    </div>
                </div>
           
                <div class="statistics-card shadow-sm">
                    <div class="statistics-text">
                        <div class="statistics-label font-weight-bold">Total
                        </div>
                        <div class="statistics-value">423</div>
                    </div>
                    <div class="statistics-icon">
                        <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                    </div>
                </div>
        </div>
            {{-- 2nd --}}
            <div class="col-lg-12">
               <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics (Escorts)

               </h4>
           </div>
           <div class="col-lg-12 card-list-wrapper">
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New today
                      </div>
                       <div class="statistics-value">1</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New this week
                       </div>
                       <div class="statistics-value">3</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New this month
                       </div>
                       <div class="statistics-value">10</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">Total
                       </div>
                       <div class="statistics-value">78</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
        </div>
           
            {{-- 3rd --}}
            <div class="col-lg-12">
               <h4 class="font-weight-bold" style="color: var(--blue--text);">My Statistics (Massage Centres)

               </h4>
           </div>
            <div class="col-lg-12 card-list-wrapper">
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New today
                      </div>
                       <div class="statistics-value">3</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New this week
                       </div>
                       <div class="statistics-value">4</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">New this month
                       </div>
                       <div class="statistics-value">15</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
          
               <div class="statistics-card shadow-sm">
                   <div class="statistics-text">
                       <div class="statistics-label font-weight-bold">Total
                       </div>
                       <div class="statistics-value">345</div>
                   </div>
                   <div class="statistics-icon">
                       <img src="{{ asset('assets/dashboard/img/add-user.png') }}" alt="icon">
                   </div>
               </div>
            </div>
        </div>
    </div>
    {{-- end --}}
 


</div>
@endsection
@section('script')
@endsection