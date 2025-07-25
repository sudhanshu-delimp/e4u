@extends('layouts.userDashboard')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
    
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-12 custom-heading-wrapper justify-content-between">
       <div class="d-flex align-items-center">
        <h1 class="h1">Viewer Statistics</h1>
        <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
       </div>
        
        <div class="back-to-dashboard">
            <a href="{{ url()->previous() ?? route('user-dashboard') }}">
                <img src="{{ asset('assets/dashboard/img/crossimg.png') }}" alt="Back To Dashboard">
            </a>
        </div>
    </div>
</div>

<div class="row">
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
<!-- Page Heading -->
<div class="row mt-2">  
    <!-- Followers Online (Legbox) -->
    <div class="col-md-6 mb-4">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead style="background-color: #0C223D; color: #ffffff;">
            <tr><th colspan="3" class="text-center">Escorts Online (Legbox)</th></tr>
          </thead>
          <tbody>
            <tr>
              <td class="icon-col"><i class="fas fa-map-marker-alt"></i></td>
              <td>In my Location</td>
              <td class="text-center">15</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-globe"></i></td>
              <td>Outside my Location</td>
              <td class="text-center" style="border-bottom: 2px solid">15</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-wifi"></i>
              </td>
              <td class="text-right font-weight-bold">Online : </td>
              <td class="text-center font-weight-bold">30</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-kiss-wink-heart"></i>

              </td>
              <td class="font-weight-bold">Total Legbox</td>
              <td class="text-center font-weight-bold">30</td>
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
              <td class="icon-col"><i class="far fa-clock"></i></td>
              <td>Last login</td>
              <td class="text-center" colspan="2">20-06-2025 | 12:32:02 PM</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-hourglass-half"></i>

              </td>
              <td>Session duration</td>
              <td class="text-center" colspan="2">1 hrs.</td>
            </tr>
            <tr>
              <td class="icon-col"><i class="fas fa-map"></i></td>
              <td>Home State</td>
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
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush