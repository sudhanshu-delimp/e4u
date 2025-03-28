<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
      <!-- jquery ui cdn -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.structure.min.css"/>
      <!-- jquery ui cdn -->
      <!-- google fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
      <!-- google fonts -->
      <!-- font awsome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>

      <link rel="stylesheet" type="text/css" href="css/style.css">
      <title>reg page</title>
   </head>
   <body>
      <section class="section_bg_color padding_ninty_top_ninty_px padding_ninty_btm_ninty_px angle_bg_image">
         <div class="container">
            <div class="row">
               <div class="col-lg-7 col-md-7">
                  <div class="reg_info">
                     <h1 class="text-uppercase">viewer Registration</h1>
                     <h2> Registration with us is free</h2>
                     <p>You do not have to register to view a Profile or Tour however, if you register you will recieve the following benefits:</p>
                     <div class="register_list_style">
                        <ul>
                           <li>Flag a Profile</li>
                           <li>View your favourite Profiles list (Legbox)</li>
                           <li>Receive Alerts when your favourite Escort is visiting your Location</li>
                           <li>Have a descreet conversation with an Escort (provided they have enabled this feature)</li>
                           <li> Write an Escort review</li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="reg_box_form_style col-lg-5 col-md-5">
                  <div class="regstractionform">
                     <h4>Register now, no fees - ever!</h4>
                      <form action="{{ route('register.store') }}" method="POST" >
                        @csrf

                        <div class="form-group">
                           <label for="exampleInputEmail1">{{ __('E-Mail Address') }}</label>
                           <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="We never display your email address">
                           <div class="termsandconditions_text_color">
								@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="exampleInputPassword1">{{ __('Password') }}</label>
                           <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Make sure you select something unique" name="password" required autocomplete="new-password">
                           <div class="termsandconditions_text_color">
                              <!-- error sms here -->
								@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="conformPassword">{{ __('Confirm Password') }}</label>
                           <input type="password" class="form-control" id="conformPassword" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                           <div class="termsandconditions_text_color">
                              <!-- error sms here -->
                           </div>
                        </div>
                         <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="termsandconditions" name="remember">
                          <label class="form-check-label" for="exampleCheck1">I have read and agree to the <a href="terms-conditions" class="termsandconditions_text_color">Terms and Conditions</a></label>
                        </div>
                          <div class="termsandconditions_text_color">
                              <!-- error sms here -->
                           </div>
                        <button type="submit" class="btn site_btn_primary">{{ __('Register') }}</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- <div class="triangle-down"></div> -->
      <section class="padding_ninty_top_ninty_px padding_ninty_btm_ninty_px">
        <div class="container">
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
      Anonumity - it is up to you
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
  <div class="set">
    <a>
      Member Bennefits
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
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <!-- jquery ui js -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script type="text/javascript" src="js/jqueryuijs.js"></script>
   </body>
</html>
