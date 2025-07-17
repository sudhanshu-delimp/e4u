@extends('layouts.agent')
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <!-- Page Heading -->
   <div class="row">
      <!-- Page Heading -->
      <div class="d-flex align-items-center justify-content-between col-md-12">
         <div class="custom-heading-wrapper">
             <h1 class="h1">Dashboard - Advertisers (summary)</h1>
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
                    <div class="col-lg-12">
                        <h4 class="font-weight-bold" style="color: var(--blue--text);">Top Advertisers
                        </h4>
                    </div>
                        {{-- my spen box --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                            
                            <div class="card-body">                                
                                <!-- Text Section -->
                                <h4 class="mb-0 user-type-text font-weight-bold">Escort</h4>
                                <p class="font-weight-bold esc-name">Carla Brasil</p>
                                <div class=" d-flex align-items-center justify-content-start gap-10">
                                   
                                    <div class="spend">
                                        <small class="mb-1">Spend</small>
                                        <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                                    </div>
                                    <div class="commission">
                                        <small class="mb-1">Commission</small>
                                        <h4 class="mb-0 amount-text font-weight-bold">$232.00</h4>
                                    </div> <!-- Chart Icon or Image -->
                                   <div class="chart-img">
                                    <img src="{{ asset('assets/dashboard/img/graph.png') }}" alt="">
                                   </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                    {{-- my spen box --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                            <div class="card-body">                                
                                <!-- Text Section -->
                                <h4 class="mb-0 user-type-text font-weight-bold">Massage Center</h4>
                                <p class="font-weight-bold esc-name">Lin's Massage

                                </p>
                                <div class=" d-flex align-items-center justify-content-start gap-10">
                                   
                                    <div class="spend">
                                        <small class="mb-1">Spend</small>
                                        <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                                    </div>
                                    <div class="commission">
                                        <small class="mb-1">Commission</small>
                                        <h4 class="mb-0 amount-text font-weight-bold">$232.00</h4>
                                    </div> <!-- Chart Icon or Image -->
                                   <div class="chart-img">
                                    <img src="{{ asset('assets/dashboard/img/graph.png') }}" alt="">
                                   </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                </div>
            </div>
        </div>
        {{-- end --}}

        {{-- col-6 --}}
        <div class="col-lg-6 my-2">
            <div class="my-spend-box-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="font-weight-bold" style="color: var(--blue--text);">Registrations
                        </h4>
                    </div>
                        {{-- my spen box --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                            <div class="card-body">                                
                                <!-- Text Section -->
                                <h4 class="mb-0 user-type-text font-weight-bold">Escort</h4>
                                <p class="font-weight-bold esc-name">Week to Date</p>
                                <div class=" d-flex align-items-center justify-content-between">                                    
                                    <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                                   
                                    <!-- Chart Icon or Image -->
                                    <div class="spend-icons">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- end --}}
                    {{-- my spen box --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm border-1 mb-2 py-3 px-2 my-spend-box">
                            <div class="card-body">                                
                                <!-- Text Section -->
                                <h4 class="mb-0 user-type-text font-weight-bold">Massaage Center</h4>
                                <p class="font-weight-bold esc-name">Week to Date</p>
                                <div class=" d-flex align-items-center justify-content-between">                                    
                                    <h4 class="mb-0 amount-text font-weight-bold">$580.00</h4>
                                   
                                    <!-- Chart Icon or Image -->
                                    <div class="spend-icons">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                        
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



    <div class="row mt-4"> 
        <div class="col-lg-12 mb-2">
            <h4 class="font-weight-bold" style="color: var(--blue--text);">Monitoring
            </h4>
        </div>
        <!-- Monitoring -->
        <div class="col-md-6 mb-4">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #0C223D; color: #ffffff;">
                <tr><th colspan="3" class="text-center">My Advertisers Online</th></tr>
              </thead>
              <tbody>
                <tr>
                  <td class="icon-col"><i class="fas fa-map-marker-alt"></i></td>
                  <td>In my Territory
                </td>
                  <td class="text-center">15</td>
                </tr>
                <tr>
                  <td class="icon-col"><i class="fas fa-globe"></i></td>
                  <td>Outside my Territory
                </td>
                  <td class="text-center">15</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      
        <!-- Logs & Status -->
        <div class="col-md-6 mb-4">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead style="background-color: #0C223D; color: #ffffff;">
                <tr><th colspan="4" class="text-center">Logs & Status</th></tr>
              </thead>
              <tbody>
                <tr>
                  <td class="icon-col"><i class="fas fa-sign-in-alt"></i></td>
                  <td>Login count</td>
                  <td class="text-center" colspan="2">526</td>
                </tr>
               
                <tr>
                  <td class="icon-col"><i class="fas fa-map"></i></td>
                  <td>Territory</td>
                  <td class="text-center" colspan="2">Western Australia
                </td>
                </tr>
                <tr>
                  <td class="icon-col"><i class="fas fa-key"></i></td>
                  <td>Password expiry</td>
                  <td class="text-center">Never</td>
                  <td class="text-center">
                    <button type="submit" class="save_profile_btn"  data-target="#resetPasswordDate" data-toggle="modal">Change</button>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div> 


</div>


{{--reset password expiry date modal  --}}
<div class="modal fade upload-modal" id="resetPasswordDate" tabindex="-1" role="dialog" aria-labelledby="resetPasswordDatelabel"
aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                <img src="{{ asset('assets/dashboard/img/reset-password.png')}}" style="width:45px; padding-right:10px;">
                <span class="text-white">Reset Password Expiry</span>                        
             </h5>
          
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                        class="img-fluid img_resize_in_smscreen"></span>
            </button>
        </div>
        <div class="modal-body pb-0 agent-tour">
            <form method="post"  action="#">
                <!-- Password Expiry Options -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label><strong>Password Expiry</strong></label><br>
            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_expiry" id="expiry_never" value="never">
                            <label class="form-check-label" for="expiry_never">Never</label>
                        </div>
            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_expiry" id="expiry_30" value="30" checked>
                            <label class="form-check-label" for="expiry_30">Renew every 30 days</label>
                        </div>
            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_expiry" id="expiry_60" value="60">
                            <label class="form-check-label" for="expiry_60">Renew every 60 days</label>
                        </div>
            
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="password_expiry" id="expiry_90" value="90">
                            <label class="form-check-label" for="expiry_90">Renew every 90 days</label>
                        </div>
                        <hr>
                        <small class="text-muted">
                            Unless you set your preferred Password Expiry, by default your password will renew every 30 days.
                        </small>
                    </div>
                </div>
            
                <!-- Save Button -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary shadow-none float-right ml-2" id="save_button">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
</div>  
{{-- end --}}


{{--reset password expiry date confirmations popup modal  --}}
<div class="modal fade upload-modal" id="resetPasswordSaved" tabindex="-1" role="dialog" aria-labelledby="resetPasswordSavedlabel"
aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">
              <img src="{{ asset('assets/dashboard/img/reset-password.png')}}" style="width:45px; padding-right:10px;">
              <span class="text-white">Password Expiry</span>                        
          </h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png') }}"
                      class="img-fluid img_resize_in_smscreen"></span>
          </button>
      </div>
      <div class="modal-body">
          <h1 class="popu_heading_style mb-0 mt-4" style="text-align: center;">
          <span id="comman_str"></span>
          <span class="comman_msg">Saved</span>
          </h1>
      </div>
      <div class="modal-footer" style="justify-content: center;">
          <button type="submit" class="btn main_bg_color site_btn_primary" data-dismiss="modal" id="close">Ok</button>
      </div>
  </div>
</div>
</div>  
{{-- end --}}
@endsection
@section('script')
@endsection