@extends('layouts.web')
@section('content')

<div class="container">
      <section class="login_page_pt_pb_of_outer_section">
         <section class="innersection_padding_from_all_side box_shdow_of_login_form">
            <div class="row align-items-center">
               <div class="col-md-6 order-md-0 order-sm-1 order-1">
                  <div class="welcone_login_page_heading">
                     <h1 class="text-uppercase">WELCOME TO E4U</h1>
                  </div>
                  <h4 class="welcome_sub_login_heading">Login</h4>
                  <form id="escort_login" action="{{ route('advertiser.login')}}" method="post">
                      @csrf
                        <div class="form-group label_margin_zero_for_login">
                           <label for="exampleInputmobilenumber">Email</label>
                           <input type="txt" required class="form-control" name="email" id="mobileno" aria-describedby="emailHelp" placeholder="Please Enter Your Email" data-parsley-required-message="Your Email is required" value="{{ old('email') }}">
                           <div class="termsandconditions_text_color">
                               @error('phone')

                                       {{ $message }}
                               @enderror
                           </div>
                        </div>
                        <div class="form-group label_margin_zero_for_login">
                           <label for="exampleInputPassword1">{{ __('Password') }}</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please Enter Your Password" name="password" required autocomplete="new-password" data-parsley-required-message="@lang('errors/validation/required.password')" data-parsley-pattern-message="@lang('errors/validation/valid.password')">
                           <div class="termsandconditions_text_color">
                               <!-- error sms here -->
                               @error('password')
                                   {{ $message }}
                               @enderror
                           </div>
                        </div>
                       <!--<div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                           <label class="form-check-label" for="inlineRadio1">I am an Escort</label>
                        </div>
                        <div class="form-check form-check-inline">
                           <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                           <label class="form-check-label" for="inlineRadio2">I am an Agent</label>
                       </div>-->
                        <button type="submit" id="submit_button" class="btn site_btn_primary">Login</button>
                     </form>
               </div>
               <div class="col-md-6 order-md-1 order-sm-0 order-0 mb-2">
                  <img src="{{ asset('assets/app/img/newlogin.png')}}" class="img-fluid">
               </div>
            </div>
         </section>
      </section>
      </div>






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
