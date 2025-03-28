@extends('layouts.web')
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image">
   <div class="container">
      <div class="row">
         <div class="col-lg-7 col-md-7">
            <div class="reg_info">
               <h1 class="text-uppercase">Escort Login</h1>
               <h2>Login with us is free</h2>
               <p>There are no fees when your create an Account. Fees only apply when you post a Profile or Tour where you are charged according to the number of days and the Membership type you select. See also <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">help for Advertisers</a></span> for more information on Package benefits, Profiles & Tours, Fees and your obligations.</p>
            </div>
         </div>
         <div class="reg_box_form_style col-lg-5 col-md-5">
            <div class="regstractionform">
               <h4>Login now</h4>
               <form id="escort_login" action="{{ route('advertiser.login')}}" method="post">
                   @csrf
                  <div class="form-group">
                     <label for="mobileno">Mobile Number</label>
                     <input type="txt" required class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp" placeholder="Please Enter Your Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ old('phone') }}">
                     <div class="termsandconditions_text_color">
                         @error('phone')

                                 {{ $message }}
                         @enderror
                     </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('Password') }}</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please Enter Your Password" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                      <div class="termsandconditions_text_color">
                          <!-- error sms here -->
                          @error('password')
                              {{ $message }}
                          @enderror
                      </div>
                  </div>




                  <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>



<section class="padding_three_hundred padding_bottom_eight_px">
   <div class="container">

      <h4 class="termsandconditions_text_color">ALERT:</h4>
      <ol>
        <li>Victorian Advertisers require a SWA exception number or license number, like for example, SWA20188XE. The license number will be displayed on any Profile you publish</li>
        <li>Massage centers in Queensland require a SWA exception number or license number, like for example, SWA20188XE. The license number will be displayed on any Profile you publish.</li>
      </ol>


      <div class="accordion-container">
         <div class="set">
            <a>
            Password Requirements
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Profile Options
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
           Accommodation & Travel Services
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Products
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Products
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
         <div class="set">
            <a>
            Visa and Migration Advice
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
           <div class="set">
            <a>
            Any Question?
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
               <div class="accodien_manage_padding_content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
@section('script')

<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<script>

    $(function() {
        $('#escort_login').parsley({

        });
    });

</script>
@endsection
