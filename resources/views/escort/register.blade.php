@extends('layouts.web')

<style>
    
   p{
       text-align: justify !important;
   }
</style>
@section('content')
<section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image">
   <div class="container">
      <div class="row">
         <div class="col-lg-7 col-md-7">
            <div class="reg_info">
               <h1 class="text-uppercase">Escort Registration</h1>
               <h2>Registration with us is free</h2>
               <p>There are no fees when your create an Account. Fees only apply when you post a Profile or Tour where you are charged according to the number of days and the Membership type you select. See also <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">help for Advertisers</a></span> for more information on Package benefits, Profiles & Tours, Fees and your obligations.</p>
            </div>
         </div>
         <div class="reg_box_form_style col-lg-5 col-md-5">
            <div class="regstractionform">
               <h4>Register now, no Fees for the first 14 days advertising!</h4>
               <form id="escort_registration" action="{{ route('advertiser.register')}}" method="post">
                   @csrf
                  <div class="form-group">
                     <label for="mobileno">Mobile Number</label>
                     <input type="txt" required class="form-control" name="phone" id="mobileno" aria-describedby="emailHelp" placeholder="Please Enter Your Mobile Number" data-parsley-required-message="Your mobile number is required" value="{{ old('phone') }}">
                     <div class="termsandconditions_text_color">
                        <!-- error sms here -->
                     </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1">{{ __('Password') }}</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Make sure you select something unique" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                      <div class="termsandconditions_text_color">
                          <!-- error sms here -->
                          @error('password')
                          <strong>{{ $message }}</strong>
                          @enderror
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="conformPassword">{{ __('Confirm Password') }}</label>
                      <input type="password" class="form-control" id="conformPassword" placeholder="Confirm Password" name="password_confirmation" data-parsley-equalto="#exampleInputPassword1" data-parsley-equalto-message="Password do not match" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.confirm_password')">
                      <div class="termsandconditions_text_color">
                          <!-- error sms here -->
                      </div>
                  </div>
                  <div class="form-group">
                     <label for="conformPassword">Referred By (Agent ID)</label>
                     <input type="txt" class="form-control" id="conformPassword" placeholder="Enter Agent ID">
                     <div class="termsandconditions_text_color">
                        <!-- error sms here -->
                     </div>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" required type="radio" name="type" id="inlineRadio1" value="3"{{ old('type') == 3 ? ' checked' : null }}>
                     <label class="form-check-label" for="inlineRadio1">I am an Escort Agency</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="4"{{ old('type') == 4 ? ' checked' : null }}>
                     <label class="form-check-label" for="inlineRadio2">I am a Massage Center</label>
                 </div>
                  <div class="termsandconditions_text_color">
                     <!-- error sms here -->
                     @error('type')
                     <strong>{{ $message }}</strong>
                     @enderror
                  </div>
                  <div class="form-check">
                      <input type="checkbox" data-parsley-errors-container=".check-tc" class="form-check-input" id="termsandconditions" required data-parsley-required-message="@lang('errors/validation/required.checkbox')">
                      <label class="form-check-label" for="termsandconditions">I have read and agree to the <a href="#" class="termsandconditions_text_color">Terms and Conditions</a></label>
                  </div>
                  <span class="check-tc"></span>
                  <div class="termsandconditions_text_color">
                      <!-- error sms here -->
                  </div>
                  <button type="submit" id="submit_button" class="btn site_btn_primary">Register</button>
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
        $('#escort_registration').parsley({

        });
    });

</script>
@endsection
