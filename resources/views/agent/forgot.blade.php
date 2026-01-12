@extends('layouts.web')
@section('content')

<div class="container">
      <section class="login_page_pt_pb_of_outer_section">
        <div class="row text-center" style="z-index: 9999;position: relative;top: 2.5rem;">
               <div class="col-md-12">
                   <a href="#"><img src="{{ asset('assets/app/img/e4u_forget.png')}}" class="" alt="logo" style="max-width:150px; width:100%"></a>
               </div>
           </div>
         <section class="innersection_padding_from_all_side box_shdow_of_login_form forgot_pass">
            <div class="row align-items-center">
               <div class="col-md-12 order-md-0 order-sm-1 order-1">
                  
                  <h4 class="welcome_sub_login_heading text-center pt-4 pb-3"><strong>Forget Password</strong></h4>
                  <form action="#" method="post">
                      @csrf
                        
                        <div class="form-group label_margin_zero_for_login">
                           
                           <input type="text" required class="form-control" name="password" placeholder="Create new password">
                           
                        </div>

                         <div class="form-group label_margin_zero_for_login">
                           
                           <input type="text" required class="form-control" name="password" placeholder="Create new password">
                           
                        </div>
                       
                       <div class="row login-bottom-des">
                          
                           <div class="col-md-12">
                                <button type="submit" class="btn site_btn_primary">Update Password </button> 
                                <h6>Or</h6>
                                <a href="{{ route('advertiser.login')}}"><h5>Login</h5></a>
                           </div>
                       </div>
                       
                     </form>
               </div>
              
            </div>
         </section>
      </section>
      </div>






@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

@endsection
