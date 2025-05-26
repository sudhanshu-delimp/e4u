@section('style')
<style type="text/css">
   .parsley-errors-list {
   list-style: none;
   color: rgb(248, 0, 0)
   }
   
</style>
@endsection
<footer class="footer_bg_color padding_fifty_top_and_btm custom--footer">
   <section class="footer_mange_padding">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <a href="#"><img src="{{ asset('assets/app/img/logo.png') }}" class="img-fluid" alt="logo"></a>
            </div>
            <div class="col-md-6">
               @if(!auth()->user())
            <ul class="footer_list_style_none footerbtn-flex custom--foter-login">
                  <li class="dropdown">
                     <a style="padding: 5px 15px;width:120px; text-align: center;" class="nav-link dropdown-toggle footer_reg_btn" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Register</a>
                     <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                        <a class="dropdown-item" href="{{ route('advertiser.register') }}">Advertiser</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Viewer</a>
                        <a class="dropdown-item" href="{{ route('agent.register')}}">Agent </a>
                     </div>
                  </li>
                  <li class="dropdown">
                     <a style="padding: 5px 15px; width:120px; text-align: center;" class="nav-link dropdown-toggle   footer_login_btn primery_color" id="navbarDropdownn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="{{ route('register') }}">Log in</a>
                     <div class="dropdown-menu register_dropdown" aria-labelledby="navbarDropdownn">
                        <a class="dropdown-item" href="{{ route('advertiser.login') }}">Advertiser</a>
                        <a class="dropdown-item" href="{{ route('viewer.login') }}">Viewer</a>
                        <a class="dropdown-item" href="{{ route('agent.login') }}">Agent</a>
                        {{--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#global-login-modal">I am a Viewer</a>--}}
                     </div>
                  </li>
               </ul>
               @endif
            </div>
         </div>
         <div class="row">
          <div class="col footer_text_color_white" align="justify">
               <h4>Advertising Statement</h4>
               <p>The primary purpose of this Website is to permit adults to advertise their companionship to other adults.</p>
               <p>Escorts4U helps Advertisers and Users find each other, what happens after that connection is made is up to them. We are not a party to any agreement, or involved in any interaction, between Advertisers and Users.</p>
               <p>Any price indicated in an Advertiser's Profile relates to their time only and nothing else. Any service offered or whatever else that may occur is a mutual decision between consenting adults and is private between them. It is your responsibility to be cognisant of and to comply with the Local Laws.</p><p>Further details may be found in the Terms and Conditions.</p>
            </div>
            <div class="col footer_text_color_white">
               <h4 class="custom-mt">Location </h4>
               <div class="d-flex">
                  <div class="wcustom-50">
                     <ul class="list-group footer_list_style_none">
                        @foreach(config('escorts.profile.cities') as $key => $city)
                        <li><a href="{{route('find.all', [request()->segment(2),'city'=>$key])}}" class="" id="{{$key}}">{{$city}}</a></li>
                        @if($loop->iteration == 4) @break  @endif
                        @endforeach
                        {{--
                        <li><a href="{{ url('all-escorts-list') }}">Brisbane</a></li>
                        <li><a href="{{ url('all-escorts-list') }}">Canberra</a></li>
                        <li><a href="{{ url('all-escorts-list') }}">Darwin</a></li>
                        --}}
                  </ul>
                
                  </div>
                  <div class="wcustom-50">
                     <ul class="list-group footer_list_style_none">
                        @foreach(config('escorts.profile.cities') as $key => $city)
                        @if($loop->iteration > 4)
                        <li><a href="{{route('find.all', [request()->segment(2),'city'=>$key])}}" class="city_id" id="{{$key}}">{{$city}}</a></li>
                        @endif
                        @endforeach
                        {{--
                        <li><a href="{{ url('all-escorts-list') }}">Melbourne</a></li>
                        <li><a href="{{ url('all-escorts-list') }}">Perth</a></li>
                        <li><a href="{{ url('all-escorts-list') }}">Sydney</a></li>
                        --}}
                     </ul>
                  </div>
               </div>
            
            </div>
            <div class="col footer_text_color_white">
               <h4>Legal</h4>
               <div class="d-flex">
                  <div class="">
                     <ul class="list-group footer_list_style_none">
                        <li><a href="{{ url('acceptable-usage-policy')}}">Acceptable Usage Policy</a></li>
                        <li><a href="{{ url('cookie-policy')}}">Cookie Policy</a></li>
                        <li><a href="{{ url('copyright-statement')}}">Copyright Statement</a></li>
                        <li><a href="{{ url('covid-19-statement')}}">Covid-19  Statement</a></li>
                        <li><a href="{{ url('disclaimer-statement')}} ">Disclaimer Statement</a></li>
                     </ul>
                  </div>
                  <div class="">
                     <ul class="list-group footer_list_style_none">
                        <li><a href="{{ url('law-enforcement')}} ">Law Enforcement</a></li>
                        <li><a href="{{ url('privacy-policy')}} ">Privacy Policy</a></li>
                        <li><a href="{{ url('refund-policy')}} ">Refund Policy</a></li>
                        <li><a href="{{ url('spam-policy')}} ">Spam Policy</a></li>
                        <li><a href="{{ url('terms-conditions')}} ">Terms & Conditions</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col footer_text_color_white">
               <h4>Community</h4>
               <div class="d-flex">
                  <div class="">
                     <ul class="list-group footer_list_style_none">
                        <li><a href="{{ url('abbreviations')}} ">Abbreviations</a></li>
                        <li><a href="{{ url('alerts')}} ">Alerts</a></li>
                        <li><a href="{{ url('blogs')}}">Blog</a></li>
                        <li><a href="{{ url('contact-us')}} ">Contact Us</a></li>
                        <li><a href="{{ url('etiquette')}} ">Etiquette</a></li>
                        <li><a href="{{ url('faqs')}} ">FAQs</a></li>
                     </ul>
                  </div>
                  <div class="">
                     <ul class="list-group footer_list_style_none">
                        <li><a href="{{ url('feedback')}}">Feedback</a></li>
                        <li><a href="{{ url('help-for-advertisers')}} ">Help for Advertisers</a></li>
                        <li><a href="{{ url('help-for-agents')}} ">Help for Agents</a></li>
                        <li><a href="{{ url('help-for-massage-centres')}} ">Help for Massage Centres</a></li>
                        <li><a href="{{ url('help-for-viewers')}} ">Help for Viewers</a></li>
                        <li><a href="{{ url('influencer')}} ">Influencer</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col dk-right custom--resurce">
            <h4>Resources</h4>

         <div class="d-flex footer_text_color_white">
               <div class="wcustom-100">
               <ul class="list-group footer_list_style_none ">
               <li><a href="{{('https://agencymanagement.com.au')}}" target="_blank">Agency Management</a></li>
               <li><a href="{{('http://www.nationaluglymugs.com.au')}}" target="_blank">NUM</a></li>
               <li><a href="{{('http://www.peamsaustralia.com.au')}}" target="_blank">PEAMS Australia</a></li>
               <li><a href="{{('http://www.punterbox.com.au')}}" target="_blank">Punterbox</a></li>
                  
               </ul>
               
               </div>
               
            </div>
               
            </div>
         </div>
      </div>
   </section>
   <section class="copy_right_footer_mange_padding">
      <div class="footer_copy_right">
         <div class="row">
            <div class="col-lg-8 col-md-8 footer_text_color_white">
               <div class="custom--copyryt">
               <span><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12Z" stroke="#fff" stroke-width="1.5"></path> <path d="M14 15.6672C13.475 15.8812 12.8952 16 12.2857 16C9.91878 16 8 14.2091 8 12C8 9.79086 9.91878 8 12.2857 8C12.8952 8 13.475 8.11876 14 8.33283" stroke="#fff" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>E4U . 2024</span>  <span>|</span> <div><a href="#" class="cook--seting">Cookie Settings</a></div> <span>|</span><a class="admin-login" href="{{ route('notice.dmca') }}">DMCA Notices</a>
               @if(!auth()->user())
                <span>|</span><a class="admin-login" href="{{ route('admin.login') }}">Login as Admin</a>
                @endif
               </div>
            </div>
            <div class="col-lg-4 col-md-4 manage_alments_in_ds text-right">
               <span class="footer_text_color_white">Last revision: 1st June 2025&nbsp;&nbsp;|&nbsp;&nbsp;</span>
               <span class="footer_text_color_white">Follow us:</span>
               <ul class="footer_social_icons">
                  <li><a href="https://x.com/Escorts46919U" target="_blank"><img src="{{ asset('assets/app/img/twitter-x.png') }}" class="twitter-x-logo" alt="logo"></a></li>
               </ul>
            </div>
         </div>
      </div>
   </section>
   <!-- The Modal -->
   <div class="modal fade show onload--cookiepopup" id="onloadpopup" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-dialog-bottom-right">
         <div class="modal-content  custom--onload--popup">
            <!-- Modal body -->

            <!-- Poup -->
               <!-- <div id="privacy-popup" class="popup-overlay custom--cookie--popup">
                  <div class="popup-content">
                     <div class="popup--header">
                        <h2>Privacy Preference Center</h2>
                        <a id="close-popup" class="close-btn cstm-closeloadbutton">×</a>
                     </div>
                     <div class="popup--content--area">
                        <p>When you visit any website, it may store or retrieve information on your browser, mostly in
                           the form of cookies. This information might be about you, your preferences or your device
                           and is mostly used to make the website work as you expect it to. The information does not
                           usually directly identify you, but it can give you a more personalised web experience.
                        </p>
                        <br>
                        <p>Because we respect your right to privacy, you can choose not to allow some types of
                           cookies. Click on the different category headings to find out more and change our default
                           settings. However, blocking some types of cookies may impact your experience with this
                           Website and our service offering.
                        </p>
                        <a href="#">More information</a>
                        <div class="btn-group">
                           <button class="btn allow">Allow All</button>
                        </div>
                        <div class="consent-section">
                           <h3>Manage Consent Preferences</h3>
                           <div class="accordion-item">
                              <div class="accordion-header">
                                 <span>Functional Cookies</span>
                                 <label class="switch">
                                 <input type="checkbox">
                                 <span class="slider round"></span>
                                 </label>
                              </div>
                              <div class="accordion-content">
                                 <p>These cookies enable the W ebsite to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages
                                    (see Concierge Services). If you do not allow these cookies then some or all of these services may not function properly.
                                 </p>
                              </div>
                           </div>
                           <div class="accordion-item">
                              <div class="accordion-header">
                                 <span>Strictly Necessary Cookies <strong class="always-active">Always Active</strong></span>
                              </div>
                              <div class="accordion-content">
                                 <p>These cookies are necessary for the Website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in, selecting filters within the Advertiser Home Page or filling in any forms. You can set your browser to block or alert you about these cookies, but some parts of the Website may not then work. These cookies do not store any personally identifiable information about you.</p>
                              </div>
                           </div>
                           <div class="accordion-item">
                              <div class="accordion-header">
                                 <span>Performance Cookies</span>
                                 <label class="switch">
                                 <input type="checkbox">
                                 <span class="slider round"></span>
                                 </label>
                              </div>
                              <div class="accordion-content">
                                 <p>These cookies allow us to count visits and traffic sources so we can measure and improve the performance of the Website. They help us to know which pages are the most and least popular and see how visitors move around the Website. All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our Website, and will not be able to monitor its performance.</p>
                              </div>
                           </div>
                           <div class="accordion-item">
                              <div class="accordion-header">
                                 <span>Targeting Cookies</span>
                                 <label class="switch">
                                 <input type="checkbox">
                                 <span class="slider round"></span>
                                 </label>
                              </div>
                              <div class="accordion-content">
                                 <p>These cookies may be set through our Website by our advertising partners (as and when they are appointed). They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites. They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="footer-buttons">
                        <button class="btn reject">Reject All</button>
                        <button class="btn confirm">Confirm My Choices</button>
                     </div>
                  </div>
               </div> -->

                <!-- Modal body -->
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-8 align-self-center">
                     <h4 class="modal-title">Cookie Policy</h4>
                     <p>When clicking on “I accept”, you agree that we and our partners may store and/or access information on your device, such as unique IDs in cookies to process personal data. You may accept or manage your choices by clicking below, including your right to object where legitimate interest is used. You can withdraw your consent or manage your choices at anytime in your My Account settings or the cookie manager. For additional information please refer to our Privacy Policy located in the footer of this Website. Your choices may be signaled to our partners and will not affect browsing data.</p>
                  </div>
                  <div class="col-md-4 align-self-center">
                     <button type="button" class="btn btn-danger close">I Accept</button>
                     <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#cookies-notice">Manage Preferences</button>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
   </div>
   <div class="modal fade defult-modal" id="cookies-notice" tabindex="-1" role="dialog" aria-labelledby="cookies-notice" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title text-white" id="cookies_notice">Cookie Notice</h5>
               <button type="button" class="main_bg_color border-0" data-dismiss="modal" aria-label="Close">
               <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
               </button>
            </div>
            <div class="modal-body">
               When you visit this Website, it will store or retrieve information on your browser. This
               information might be about you, your preferences or your device and is mostly used to
               make the Website work as you expect it to. The information does not usually directly
               identify you, but it can give you a more personalized web experience.
            </div>
            <div class="modal-footer">
               <a href="#" class="termsandconditions_text_color" style="position: absolute;left: 15px;" data-toggle="modal" data-target="#manage-consent">Read more about our Cookie Policy</a>
               <button type="button" class="btn main_bg_color site_btn_primary acceptCookies">Accept All Cookies</button>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade defult-modal" id="manage-consent" tabindex="-1" role="dialog" aria-labelledby="cookies-notice" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header main_bg_color border-0">
               <h5 class="modal-title text-white" id="manage_consent">Manage Consent Preferences</h5>
               <button type="button" class="main_bg_color border-0" data-dismiss="modal" aria-label="Close">
               <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
               </button>
            </div>
            <div class="modal-body pl-0">
               <div class="container-fluid pl-0">
                  <div class="row">
                     <div class="col-md-4 p-x-0 p-y-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                           <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Strictly Necessary Cookies</a>
                           <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Performance Cookies</a>
                           <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Functional Cookies</a>
                        </div>
                     </div>
                     <!-- /#admin-sidebar -->
                     <div class="col-md-8 p-x-3 p-y-1">
                        <div class="tab-content" id="v-pills-tabContent">
                           <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                              These cookies are necessary for the Website to function and cannot
                              be switched off in our systems. They are usually only set in response
                              to actions made by you which amount to a request for services, such
                              as setting your privacy preferences, logging in, selecting filters within
                              the Advertiser Home Page or filling in any forms. You can set your
                              browser to block or alert you about these cookies, but some parts of
                              the Website may not then work. These cookies do not store any
                              personally identifiable information about you.
                              <p class="pt-4"><a href="#" class="termsandconditions_text_color">Always Active</a></p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                              These cookies allow us to count visits and traffic sources so we can
                              measure and improve the performance of the Website. They help us
                              to know which pages are the most and least popular and see how
                              visitors move around the Website. All information these cookies
                              collect is aggregated and therefore anonymous. If you do not allow
                              these cookies we will not know when you have visited our Website,
                              and will not be able to monitor its performance.
                              <div class="custom-control custom-switch pt-2" style="padding-left: 35px;">
                                 <input type="checkbox" class="custom-control-input" id="customSwitch_1">
                                 <label class="custom-control-label" for="customSwitch_1"></label>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                              These cookies enable the Website to provide enhanced functionality
                              and personalisation. They may be set by us or by third party providers
                              whose services we have added to our pages <span class="termsandconditions_text_color">(see Concierge
                              Services).</span> If you do not allow these cookies then some or all of these
                              services may not function properly.
                              <div class="custom-control custom-switch pt-2" style="padding-left: 35px;">
                                 <input type="checkbox" class="custom-control-input" id="customSwitch_2">
                                 <label class="custom-control-label" for="customSwitch_2"></label>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /#admin-main-control -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn main_bg_color site_btn_primary rounded btn-color" id="saveAllCookies">Save All Settings</button>
               <button type="button" class="btn main_bg_color site_btn_primary rounded" style="background: #5D6D7E;border: #5D6D7E;" id="closeCookies">Reject All Cookies</button>
               <button type="button" class="btn main_bg_color site_btn_primary rounded btn-color color-change-id">Save Changes</button>
            </div>
         </div>
      </div>
   </div>
   <div id="myFrontpop" class="modal fade" data-keyboard="false" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <img src="{{ asset('assets/app/img/logo.png') }}" class="img-fluid">
               <!-- <img src="http://localhost/e4u2/public/assets/app/img/logo.png" class="img-fluid"> -->
            </div>
            <div class="modal-body">
               <h5 class="modal-title">User Agreement</h5>
               <p>This Website contains sexually explicit material (<b>Explicit Material</b>). Do NOT continue if:</p>
               <ol class="pl-3">
                  <li>You are not at least 18 years of age or the age of majority in any jurisdiction that
                     you view the Explicit Material (<b>Age of Majority</b>).
                  </li>
                  <li>The Explicit Material offends you.</li>
                  <li>Viewing the Explicit Material is not legal in the location where you view it.</li>
               </ol>
               <p>To access this Website you must be over the Age of Majority and agree with the terms of entry below.</p>
               <p>Your Location:</p>
               <form id="agreeMyForm">
                  <div class="form-group">
                     <select class="form-control loc" id="location_state" required  name="location_state" data-parsley-errors-container="#ch_lock" data-parsley-required-message="Select your location">
                        <option style="font-weight: 500;" value="" disabled selected>No State Selected</option>
                        @foreach(config('escorts.profile.states') as $key => $state)
                        <option style="font-weight: 500;" value="{{$key}}"> {{$state['stateName']}} </option>
                        @endforeach
                     </select>
                     <span id="ch_lock"></span>
                     <p class="pt-2" style="font-size: 14px;">(Geolocation technology is active in this Website (limited to your Capital City and/or State). Identifying your location will pre-select your search criteria)</p>
                  </div>
                  <div class="form-check p-0 pl-2">
                     <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" required  data-parsley-errors-container="#ch_name" data-parsley-required-message="Please acknowledge the Declaration">
                     <p><label class="form-check-label" for="defaultCheck1">
                             I declare I am over the Age of Majority and I agree to the <a href="{{url('terms-conditions')}}"><span>Terms and Conditions</span></a> and <a href="{{url('acceptable-usage-policy')}}"><span>Policies</span></a>.
                         </label>
                        </p>
                     </label>
                     <span id='ch_name' style="color:red"></span>
                  </div>
                  <button type="submit" class="btn btn-secondary btn-sm agree">I agree - Enter Escorts4U</button>
                  <a class="pr-3" href="https://www.google.com/" style="text-align: center;display: flex;" role="button">I disagree -  Leave the Website</a>
               </form>
            </div>
         </div>
      </div>
   </div>

   <!-- Poup -->
      <div id="privacy-popup" class="popup-overlay custom--cookie--popup">
         <div class="popup-content">
            <div class="popup--header">
               <h2>Privacy Preference Center</h2>
               <a id="close-popup" class="close-btn">×</a>
            </div>
         <div class="popup--content--area">
            <p>When you visit any website, it may store or retrieve information on your browser, mostly in
            the form of cookies. This information might be about you, your preferences or your device
            and is mostly used to make the website work as you expect it to. The information does not
            usually directly identify you, but it can give you a more personalised web experience.
            </p><br>
            <p>Because we respect your right to privacy, you can choose not to allow some types of
            cookies. Click on the different category headings to find out more and change our default
            settings. However, blocking some types of cookies may impact your experience with this
            Website and our service offering.</p>
            <a href="#">More information</a>

            <div class="btn-group">
            <button class="btn allow">Allow All</button>
            </div>

                  <div class="consent-section">
               <h3>Manage Consent Preferences</h3>

               <div class="accordion-item">
               <div class="accordion-header">
               <span>Functional Cookies</span>
               <label class="switch">
               <input type="checkbox">
               <span class="slider round"></span>
               </label>
               </div>
               <div class="accordion-content">
               <p>These cookies enable the W ebsite to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages
(see Concierge Services). If you do not allow these cookies then some or all of these services may not function properly.</p>
               </div>
               </div>

               <div class="accordion-item">
               <div class="accordion-header">
               <span>Strictly Necessary Cookies <strong class="always-active">Always Active</strong></span>
               </div>
               <div class="accordion-content">
               <p>These cookies are necessary for the Website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in, selecting filters within the Advertiser Home Page or filling in any forms. You can set your browser to block or alert you about these cookies, but some parts of the Website may not then work. These cookies do not store any personally identifiable information about you.</p>
               </div>
               </div>

               <div class="accordion-item">
               <div class="accordion-header">
               <span>Performance Cookies</span>
               <label class="switch">
               <input type="checkbox">
               <span class="slider round"></span>
               </label>
               </div>
               <div class="accordion-content">
               <p>These cookies allow us to count visits and traffic sources so we can measure and improve the performance of the Website. They help us to know which pages are the most and least popular and see how visitors move around the Website. All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our Website, and will not be able to monitor its performance.</p>
               </div>
               </div>

               <div class="accordion-item">
               <div class="accordion-header">
               <span>Targeting Cookies</span>
               <label class="switch">
               <input type="checkbox">
               <span class="slider round"></span>
               </label>
               </div>
               <div class="accordion-content">
               <p>These cookies may be set through our Website by our advertising partners (as and when they are appointed). They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites. They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.</p>
               </div>
               </div>
               </div>


         </div>

         <div class="footer-buttons">
         <button class="btn reject">Reject All</button>
         <button class="btn confirm">Confirm My Choices</button>
         </div>
         </div>
      </div>
    <!--  -->
</footer>
</section>
<script src="{{ asset('assets/app/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/app/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/app/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/app/js/js.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/js/jqueryuijs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.0/nouislider.min.js"></script>
<script>
   $('#agreeMyForm').parsley({

   });
   $(document).ready(function() {

       var loginForm = $("#loginForm");

       loginForm.submit(function(e) {

           e.preventDefault();
           var form = $(this);
           var url = form.attr('action');
           var formData = new FormData($("#loginForm")[0]);
           console.log(formData);
           var token = $('input[name="_token"]').attr('value');

           $.ajax({
               url: url,
               type: 'POST',
               data: formData,
               dataType: "JSON",
               contentType: false,
               processData: false,
               headers: {
                   'X-CSRF-Token': token
               },
               success: function(data) {
                   window.location.href = "{{ route('find.all') }}";
                   console.log(data);
               },
               error: function(data) {

                   console.log("error: ", data.responseJSON.errors);
                   errorsHtml = '<div class="alert alert-danger"><ul>';

                   $.each(data.responseJSON.errors, function(key, value) {
                       errorsHtml += '<li>' + value + '</li>'; //showing only the first error.
                   });

                   errorsHtml += '</ul></di>';
                   $('#formerror').html(errorsHtml);
               }
           });
       });

       $('#global-login-modal').on('hide.bs.modal', function() {
           $('#loginForm')[0].reset();
           $('#loginForm .alert').remove();
       });
   });

</script>
<!-- script for tip crousal start here -->
<script type="text/javascript">
   var totalItems = $('.item-01').length;
   var currentIndex = $('div.carousel-item').index() + 1;
   var down_index;
   $('.num-01').html('' + currentIndex + '&nbsp;/&nbsp;' + totalItems + '');
   $(".next-01").click(function() {
     currentIndex_active = $('div.carousel-item.active').index() + 2;
     if (totalItems >= currentIndex_active) {
       down_index = $('div.carousel-item.active').index() + 2;
       $('.num-01').html('' + currentIndex_active + '&nbsp;/&nbsp;' + totalItems + '');
     } else {
       down_index = 1; //just to make 0 to go to else part when back button is clicked
       $('.num-01').html('1' + '&nbsp;/&nbsp;' + totalItems + '');

     }
   });

   $(".prev-01").click(function() {
     down_index = down_index - 1;
     if (down_index >= 1) {
       $('.num-01').html('' + down_index + '&nbsp;/&nbsp;' + totalItems + '');
     } else {
       down_index = totalItems; //last slide value
       $('.num-01').html('' + totalItems + '&nbsp;/&nbsp;' + totalItems + '');
     }
   });
   /////////////Cookie Policy//////////////////
   // $(document).ready(function(){
   //     $("#onloadpopup .close").click(function(){
   //         $("#onloadpopup").removeClass("show");
   //         $("#onloadpopup").css('display', 'none');
   //     });

   //     if ($.cookie('onloadpopup') === 'cooki-policy') {
   //         $("#onloadpopup").removeClass("show");
   //         $("#onloadpopup").css('display', 'none');
   //     } else {
   //         $.cookie('onloadpopup', 'cooki-policy', { expires: 5});
   //         $("#onloadpopup").modal('show');
   //     }
   // });

   ////////////
   $(document).ready(function(){
       $(function () {
           var stateId;
           var url = window.location.pathname;
           console.log(url);
          // $(".agree").attr('disabled',true);
           $('body').on('change','.loc',function(){
               var stateId = $(this).val();

           })

           var stateId = $.cookie('state-id');
            console.log('State ID from cookie ji:', stateId);
            
           // $("#defaultCheck1").click(function(){
           //     if (this.checked) {
           //         $(".agree").prop('disabled',false); // If checked enable item
           //    } else {
           //         $('#msg').html("<font color='red'>Please agree</font>");
           //         $('.agree').prop('disabled', true); // If checked disable item
           //     }

           //     console.log("working");
           // })



           $("body").on('click','.close',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');
                   $("#cookies-notice").modal('hide');


           });
           $("body").on('click','.acceptCookies',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');
                   $("#cookies-notice").modal('hide');



           });
           $("body").on('click','#closeCookies',function(){
              $.removeCookie("onloadpopup");
              $.removeCookie("Performance-Cookies");
              $.removeCookie("Functional-Cookies");

              window.location.href ="https://www.google.com/";
           });
           $("body").on('click','#saveAllCookies',function(){



                   $.cookie('onloadpopup', 'cooki-policy', { expires: 5});

                 if ($('#customSwitch_1').is(":checked"))
                 {
                    $.cookie('Performance-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Performance-Cookies', 'off', { expires: 5});
                 }

                 if ($('#customSwitch_2').is(":checked"))
                 {
                    $.cookie('Functional-Cookies', 'on', { expires: 5});
                 } else {

                    $.cookie('Functional-Cookies', 'off', { expires: 5});
                 }

                   $("#myFrontpop").modal("hide");


                   $("#onloadpopup").modal('hide');

                   $("#manage-consent").modal('hide');
                   $("#cookies-notice").modal('hide');


           });

           if($.cookie('onloadpopup') === 'cooki-policy') {
               $("#onloadpopup").modal('hide');
           } else {
               $("#onloadpopup").modal('show');
           }
           $("body").on('click','.agree',function(){

               if ($('#agreeMyForm').parsley().isValid()) {
                  //  var stateId = $('#location_state').data('value');
                   var stateId = $('#location_state').val();
                   $.cookie('user-agreement', 'true', { expires: 5});

                   // $.cookie('state-id', stateId, { expires: 5});
                   $.cookie('state-id', stateId, { expires: 5});
                   $.cookie('session-state-id', stateId);
                   $("#myFrontpop").modal("hide");

                   console.log('Ji ',$.cookie('user-agreement'), $.cookie('session-state-id'));
                    //$("#onloadpopup").modal('show');
               }

           });


           if ($.cookie('user-agreement') === 'true') {
               // $("#myFrontpop").on('hidden.bs.modal', function (e) {
               // });
               // $("#myFrontpop").css('display', 'none');
               //$("#onloadpopup").modal('show');
           } else {
           // $.cookie('user-agreement', 'user-agreement', { expires: 5});
               if(url != "/acceptable-usage-policy") {
                   $("#myFrontpop").modal("show");
                   // $("#myFrontpop").on('shown.bs.modal', function (e) {
                   // });

               }

           }
       });
       console.log("footer");
       var token = $('input[name="_token"]').attr('value');

       $.post({
           type: 'POST',
           url: "{{ route('web.state.name') }}",
           headers: {
                       'X-CSRF-Token': token
                   },
       }).done(function (data) {
           if(data.error == true) {
               console.log(data.stateName);

              //var st_name = $('#location_state').find(":selected").text(data.stateName);
              //var st_name = $('select[name="location_state"]').find(":selected").text(data.stateName);
              $("#location_state").find(`option:contains(${data.stateName})`).prop('selected', true);

           } else {

           }
       });


   });
   console.log($.cookie('user-agreement'));
   ////////////
</script>
<script>
   $(document).ready(function(){
       $(window).scroll(function () {
       if ($(this).scrollTop() > 50) {
           $('#back-to-top-2').fadeIn();
           } else {
           $('#back-to-top-2').fadeOut();
           }
       });
       // scroll body to 0px on click
       $('#back-to-top-2').click(function () {
           $('body,html').animate({
           scrollTop: 0
           }, 400);
       return false;
       });

    // save btn
    $(".color-change-id").click(function() {
      var mycolor='background-color:#5D6D7E';
      $(".color-change-id").attr("style",mycolor);
    setTimeout(function() {
        $(".color-change-id").attr("style", 'background-color:#0c223d');
    }, 500);
     });
   });

$(document).ready(function () {
    // Show the button only if content is taller than window
    if ($(document).height() > $(window).height()) {
        $('#back-to-bottom-2').show();
    } else {
        $('#back-to-bottom-2').hide();
    }

    // Scroll handler
    $('#back-to-bottom-2').fadeOut();
    $(window).scroll(function () {
        let scrollTop = $(this).scrollTop();
        let windowHeight = $(this).height();
        let documentHeight = $(document).height();

        // Check if at the bottom of the page
        if (scrollTop + windowHeight >= documentHeight - 10) {
            $('#back-to-bottom-2').fadeOut(); // Hide at bottom
        } else if (scrollTop > 10) {
            $('#back-to-bottom-2').fadeIn();  // Show when scrolling
        } else {
            $('#back-to-bottom-2').fadeOut(); // Hide at top
        }
    });

    // Scroll to bottom on click
    $('#back-to-bottom-2').click(function () {
        $('html, body').animate({
            scrollTop: $(document).height() - $(window).height()
        }, 400);
        return false;
    });
});
</script>
<script>
   $(window).on("scroll", function () {
    if ($(this).scrollTop() > 50) {
        $(".home--header").addClass("header--active");
    } else {
        $(".home--header").removeClass("header--active");
    }
});
</script>
<script>
jQuery(document).ready(function(){
jQuery('.custom--cookie--popup .close-btn').click(function(){
jQuery('.custom--cookie--popup').removeClass('cookie--activate');
});	
jQuery('a.cook--seting').click(function(){
jQuery('.custom--cookie--popup').addClass('cookie--activate');
});	
});


$(".accordion-header").on("click", function () {
  const $parent = $(this).parent();

  // Toggle only if it has content (i.e. not Strictly Necessary which is always active)
  if ($parent.find(".accordion-content").length) {
    $parent.toggleClass("active");
  }
});

jQuery(document).ready(function() {
  jQuery('.cstm-closeloadbutton').click(function() {
    jQuery('.onload--cookiepopup').addClass('remove--popup');
    jQuery('.modal-backdrop').addClass('remove--popup');
  });  
});
</script>
<!-- <script>
   $(".accordion-container").click(function() {

     $('html,body').animate({
         scrollTop: $(".set").offset().top
       },
       'slow');
   });


</script> -->



@stack('scripts')
</body>
</html>

