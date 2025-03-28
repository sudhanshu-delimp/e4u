@extends('layouts.center')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>.steps_to_filled_from {
   color: #192A3E;
   font-weight: 700;
   }
</style>
@stop
@section('content')
<!-- Content Wrapper -->
<div class="container-fluid">
   <!--middle content-->
   <div class="row">
      <div class="col-md-9">
         <div class="row">
            <div class="col-lg-3">
               <div class="form_process">
                  <div class="steps_to_filled_from">Step 1</div>
                  <p>About us</p>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form_process">
                  <div class="steps_to_filled_from">Step 2</div>
                  <p>Services &amp; Rates</p>
               </div>
            </div>
            <div class="col-lg-2">
               <div class="form_process">
                  <div class="steps_to_filled_from">Step 3</div>
                  <p>Open times</p>
               </div>
            </div>
            <div class="col-lg-3">
               <div class="form_process">
                  <div class="steps_to_filled_from">Step 4</div>
                  <p>Check fee summary and pay</p>
               </div>
            </div>
            <div class="col-lg-1">
               <p style="font-size: 48px;font-weight: 700;">25%</p>
            </div>
         </div>
         <div class="manage_process_bar_padding">
            <div class="progress define_process_bar_width">
               <div class="progress-bar define_process_bar_color" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-9">
         <!-- Begin Page Content -->
         <div class="row">
            <div class="col-md-12 remove_padding_in_ph">
               <ul class="dk-tab nav gap_between_btns" id="myTab" role="tablist">
                  <li class="nav-item m-0">
                     <a class="nav-link active" id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">About us</a>
                  </li>
                  <li class="nav-item m-0">
                     <a class="nav-link" id="profile-tab" data-toggle="tab" href="#services" role="tab" aria-controls="profile" aria-selected="false">Services &amp; Rates</a>
                  </li>
                  <li class="nav-item m-0">
                     <a class="nav-link" id="contact-tab" data-toggle="tab" href="#available" role="tab" aria-controls="contact" aria-selected="false">Open times</a>
                  </li>
                  <li class="nav-item m-0">
                     <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact" aria-selected="false">Check fee summary and pay</a>
                  </li>
               </ul>
               <div class="tab-content tab-content-bg" id="myTabContent">
                  <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                     <form id="update_about_me" action="#" method="POST" enctype="multipart/form-data" novalidate="">
                        <input type="hidden" name="_token" value=" ">  
                        <div class="col-lg-12">
                           <div class="member-id pl-0 pb-2 pt-3">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
                              </svg>
                              <span>Member ID: E4U208</span>
                           </div>
                        </div>
                        <div class="about_me_drop_down_info profile-sec">
                           <div class="row tab-input- pl-2 pt-4">
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                 <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">
                                    Profile Name</label>
                                    <div class="col-sm-7">
                                       <input type="text" value="" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                 <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile start date:</label>
                                    <div class="col-sm-7">
                                       <input type="date" value="" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-4 col-md-12 col-sm-12">
                                 <div class="form-group row tab-about-me-row-padding">
                                    <label class="col-sm-5 font-weight-500" for="exampleFormControlSelect1">Profile start date:</label>
                                    <div class="col-sm-7">
                                       <input type="date" value="" name="license" class="form-control form-control-sm select_tag_remove_box_sadow" id="">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="about_me_drop_down_info profile-sec">
                           <div class="row p-4">
                              <div class="col-lg-2" style="background: #EEEEEE;">
                                 <div class="col manage_upload_btn m-0 pt-4">
                                    <div class="banner_reco_font preview">
                                       <label for="banner-video-upload" class="custom-file-upload">
                                       <i class="fas fa-plus-circle"></i>
                                       </label>
                                       <input id="banner-video-upload" type="file" name="banner_video">
                                       <p>Add image</p>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-8 about-details mb-3 pl-4">
                                 <div class="about-me-box-one-name p-0">New Harmony Nature Massage</div>
                                 <div class="about-me-box-one-number">Perth - 0438 028 728 </div>
                                 <div class="about-me-box-one-map">
                                    <svg width="14" height="21" viewBox="0 0 14 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M7 10C6.33696 10 5.70107 9.73661 5.23223 9.26777C4.76339 8.79893 4.5 8.16304 4.5 7.5C4.5 6.83696 4.76339 6.20107 5.23223 5.73223C5.70107 5.26339 6.33696 5 7 5C7.66304 5 8.29893 5.26339 8.76777 5.73223C9.23661 6.20107 9.5 6.83696 9.5 7.5C9.5 7.8283 9.43534 8.15339 9.3097 8.45671C9.18406 8.76002 8.99991 9.03562 8.76777 9.26777C8.53562 9.49991 8.26002 9.68406 7.95671 9.8097C7.65339 9.93534 7.3283 10 7 10V10ZM7 0.5C5.14348 0.5 3.36301 1.2375 2.05025 2.55025C0.737498 3.86301 0 5.64348 0 7.5C0 12.75 7 20.5 7 20.5C7 20.5 14 12.75 14 7.5C14 5.64348 13.2625 3.86301 11.9497 2.55025C10.637 1.2375 8.85652 0.5 7 0.5V0.5Z" fill="#FF3C5F"></path>
                                    </svg>
                                    Southern Road Mentone, VIC 3194 
                                 </div>
                                 <div class="about-md-box-social">                         <a href="face.com">
                                    <img src="{{ asset('/assets/dashboard/img/facebook.svg') }}">
                                    </a>                        <a href="instagram.com">
                                    <img src="{{ asset('/assets/dashboard/img/insta.svg') }}">
                                    </a>                        <a href="twitter.co.in">
                                    <img src="{{ asset('/assets/dashboard/img/twitter.svg') }}">
                                    </a>                     
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="pull-right" style="text-align: end;">
                                    <a href="#" id="saveProfilename">
                                       <span>Edit</span> 
                                       <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M13.5325 3.77992C13.825 3.48742 13.825 2.99992 13.5325 2.72242L11.7775 0.967422C11.5 0.674922 11.0125 0.674922 10.72 0.967422L9.34 2.33992L12.1525 5.15242L13.5325 3.77992ZM0.25 11.4374V14.2499H3.0625L11.3575 5.94742L8.545 3.13492L0.25 11.4374Z" fill="#90A0B7"></path>
                                       </svg>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="about_me_drop_down_info profile-sec p-4">
                           <div class="about_me_heading_in_first_tab fill_profile_headings_global border-0">
                              <h2>About me</h2>
                           </div>
                           <div id="accordion" class="myacording-design mb-5">
                              <div class="card" style="border: #90A0B7 solid 1px;">
                                 <div class="card-header">
                                    <a class="card-link collapsed" data-toggle="collapse" href="#additional_information" aria-expanded="false">
                                    Additional information about us
                                    </a>
                                 </div>
                                 <div id="additional_information" class="collapse" data-parent="#accordion" style="">
                                    <div class="card-body">
                                       <div class="tab-pane fade show active" id="aboutme" role="tabpanel" aria-labelledby="home-tab">
                                          <input type="hidden" name="_token" value="tVXo0LPNVhdC8y1csTS01uA5ltKSXXKQC2qa5j0E">  
                                          <!-- upload video  -->
                                          <div class="about_me_drop_down_info ">
                                             <div class="padding_20_all_side">
                                                <!--New Row from here-->
                                                <div class="row">
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                         <span style="color:red">*</span>Building</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="gender" required="">
                                                               <option>Apartment</option>
                                                               <option>House</option>
                                                               <option>Shop</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Parking</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Front</option>
                                                               <option>Front &amp; Rear</option>
                                                               <option>Front, Rear &amp; Street</option>
                                                               <option>Rear</option>
                                                               <option>Rear &amp; Street</option>
                                                               <option>Street</option>
                                                               <option>Street &amp; Front</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Entry</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Front</option>
                                                               <option>Rear</option>
                                                               <option>Front &amp; Rear</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Type</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option>Bed</option>
                                                               <option>Table</option>
                                                               <option>Table or bed</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">
                                                         <span style="color:red">*</span>Shower</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="gender" required="">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Yes</option>
                                                               <option>No</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Ambiance</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="" name="orientation">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Front</option>
                                                               <option>Front &amp; Rear</option>
                                                               <option>Front, Rear &amp; Street</option>
                                                               <option>Rear</option>
                                                               <option>Rear &amp; Street</option>
                                                               <option>Street</option>
                                                               <option>Street &amp; Front</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Security</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Front</option>
                                                               <option>Rear</option>
                                                               <option>Front &amp; Rear</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Payment</label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Bed</option>
                                                               <option>Table</option>
                                                               <option>Table or bed</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Loyalty program
                                                         </label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Bed</option>
                                                               <option>Table</option>
                                                               <option>Table or bed</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <div class="col-lg-4 col-md-12 col-sm-12" style="margin-top: -20px;">
                                                      <div class="form-group row tab-about-me-row-padding">
                                                         <label class="col-sm-4 font-weight-500" for="exampleFormControlSelect1">Languages
                                                         </label>
                                                         <div class="col-sm-8">
                                                            <select class="form-control form-control-sm select_tag_remove_box_sadow" id="ethnicity" name="ethnicity">
                                                               <option value="default" selected="">-- Not Set --</option>
                                                               <option>Bed</option>
                                                               <option>Table</option>
                                                               <option>Table or bed</option>
                                                            </select>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-md-12 text-right">
                                                      <button id="read-more" type="submit" class="save_profile_btn">Reset</button>
                                                      <button id="read-more" type="submit" class="save_profile_btn">Update</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                     <div class="about_me_drop_down_info profile-sec p-4">
                        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                           <h2>Who am I ?</h2>
                        </div>
                        <div class="padding_20_all_side">
                           <div class="whoiamtitle">Enter Your Title Here</div>
                           <form id="update_abut_who_am_i" action="#" method="POST">
                              <input type="hidden" name="_token" value=" ">                    
                              <div class="row">
                                 <div class="col-12">
                                    <textarea id="editor1">
                                    </textarea>
                                 </div>
                              </div>
                              <div class="row pt-3">
                                 <div class="col-md-12 text-right">
                                    <button id="update_who_am_i" type="submit" class="save_profile_btn">Update</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab_btm_btns_preview_and_next">
                        <div class="row pt-3 pb-2">
                           <div class="col-md-12 text-right mb-2 a_text_white_hover">
                              <a href="{{ asset('/escort-profile/46') }}" class="save_profile_btn">Preview</a>
                              <a href="#services" class="nex_sterp_btn" id="profile-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false">Next Step
                              <i class="fas fa-arrow-right"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="profile-tab">
                     <div class="col-lg-12">
                        <div class="member-id pl-0 pl-0 pb-2 pt-3">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
                           </svg>
                           <span>Member ID: E4U208</span>
                        </div>
                     </div>
                     <div class="about_me_drop_down_info profile-sec p-4">
                        <div class="fill_profile_headings_global">
                           <h2>My Services</h2>
                        </div>
                        <div class="padding_20_all_side">
                           <form id="myServices" action="#" method="POST">
                              <input type="hidden" name="_token" value=" ">                
                              <div class="pt-2 pb-2">
                                 <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 full-width-for-ipad-select">
                                       <div class="form-group row">
                                          <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Massage services</label>
                                          <div class="col-sm-7">
                                             <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                                <option value="" selected="" disable="">--Select--</option>
                                                <option id="Anal" value="1">Anal</option>
                                                <option id="BJ - natural" value="2">BJ - natural</option>
                                                <option id="BJ - protected" value="3">BJ - protected</option>
                                                <option id="Body slide" value="4">Body slide</option>
                                                <option id="Cum in mouth" value="5">Cum in mouth</option>
                                                <option id="Cum over body" value="6">Cum over body</option>
                                                <option id="Cum over face" value="7">Cum over face</option>
                                                <option id="Deep throat" value="8">Deep throat</option>
                                                <option id="Face sit - arse" value="9">Face sit - arse</option>
                                                <option id="Face sit - pussy" value="10">Face sit - pussy</option>
                                                <option id="Fingering" value="11">Fingering</option>
                                                <option id="GFE" value="12">GFE</option>
                                                <option id="Happy ending" value="13">Happy ending</option>
                                                <option id="Kissing" value="14">Kissing</option>
                                                <option id="Kissing - French" value="15">Kissing - French</option>
                                                <option id="Massage Nuru" value="16">Massage Nuru</option>
                                                <option id="Massage Prostate" value="17">Massage Prostate</option>
                                                <option id="Massage Tantric" value="18">Massage Tantric</option>
                                                <option id="Massage Thai" value="19">Massage Thai</option>
                                                <option id="Masturbation" value="20">Masturbation</option>
                                                <option id="Multiple positions" value="21">Multiple positions</option>
                                                <option id="My cum" value="22">My cum</option>
                                                <option id="Nipple sucking" value="23">Nipple sucking</option>
                                                <option id="Oral" value="24">Oral</option>
                                                <option id="PSE" value="25">PSE</option>
                                                <option id="Reverse oral (69)" value="26">Reverse oral (69)</option>
                                                <option id="Rimming" value="27">Rimming</option>
                                                <option id="Role play" value="28">Role play</option>
                                                <option id="Sexy lingerie" value="29">Sexy lingerie</option>
                                                <option id="Shared shower" value="30">Shared shower</option>
                                                <option id="Strapon" value="31">Strapon</option>
                                                <option id="Stiptease" value="32">Stiptease</option>
                                                <option id="Uniforms " value="33">Uniforms </option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                       <div class="manage_tag_style">
                                          <ul id="selected_service_one">
                                             <li class="mb-2" id="hideenclassOne_1">
                                                <div class="my_service_anal hideenclassOne1">
                                                   <span class="dollar-sign">Anal</span>
                                                   <input type="number" class="dollar-before input_border" name="price[]" placeholder="" value="120" min="0" step="10" max="200">
                                                   <input type="hidden" name="service_id[]" value="1" placeholder="test test ">
                                                   <span id="span_id" data-id="1">
                                                   <i class="fas fa-times-circle akh1" id="id_1" value="1" data-sname="Anal" data-val="1"></i>
                                                   </span>
                                                </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="pt-2 pb-2">
                                 <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 full-width-for-ipad-select">
                                       <div class="form-group row">
                                          <label class="font-weight-500 col-sm-5" for="exampleFormControlSelect1">Other service types</label>
                                          <div class="col-sm-7">
                                             <select class="form-control form-control-sm select_tag_remove_box_sadow" id="service_id_one">
                                                <option value="" selected="" disable="">--Select--</option>
                                                <option id="Anal" value="1">Anal</option>
                                                <option id="BJ - natural" value="2">BJ - natural</option>
                                                <option id="BJ - protected" value="3">BJ - protected</option>
                                                <option id="Body slide" value="4">Body slide</option>
                                                <option id="Cum in mouth" value="5">Cum in mouth</option>
                                                <option id="Cum over body" value="6">Cum over body</option>
                                                <option id="Cum over face" value="7">Cum over face</option>
                                                <option id="Deep throat" value="8">Deep throat</option>
                                                <option id="Face sit - arse" value="9">Face sit - arse</option>
                                                <option id="Face sit - pussy" value="10">Face sit - pussy</option>
                                                <option id="Fingering" value="11">Fingering</option>
                                                <option id="GFE" value="12">GFE</option>
                                                <option id="Happy ending" value="13">Happy ending</option>
                                                <option id="Kissing" value="14">Kissing</option>
                                                <option id="Kissing - French" value="15">Kissing - French</option>
                                                <option id="Massage Nuru" value="16">Massage Nuru</option>
                                                <option id="Massage Prostate" value="17">Massage Prostate</option>
                                                <option id="Massage Tantric" value="18">Massage Tantric</option>
                                                <option id="Massage Thai" value="19">Massage Thai</option>
                                                <option id="Masturbation" value="20">Masturbation</option>
                                                <option id="Multiple positions" value="21">Multiple positions</option>
                                                <option id="My cum" value="22">My cum</option>
                                                <option id="Nipple sucking" value="23">Nipple sucking</option>
                                                <option id="Oral" value="24">Oral</option>
                                                <option id="PSE" value="25">PSE</option>
                                                <option id="Reverse oral (69)" value="26">Reverse oral (69)</option>
                                                <option id="Rimming" value="27">Rimming</option>
                                                <option id="Role play" value="28">Role play</option>
                                                <option id="Sexy lingerie" value="29">Sexy lingerie</option>
                                                <option id="Shared shower" value="30">Shared shower</option>
                                                <option id="Strapon" value="31">Strapon</option>
                                                <option id="Stiptease" value="32">Stiptease</option>
                                                <option id="Uniforms " value="33">Uniforms </option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                       <div class="manage_tag_style">
                                          <ul id="selected_service_one">
                                             <li class="mb-2" id="hideenclassOne_1">
                                                <div class="my_service_anal hideenclassOne1">
                                                   <span class="dollar-sign">Anal</span>
                                                   <input type="number" class="dollar-before input_border" name="price[]" placeholder="" value="120" min="0" step="10" max="200">
                                                   <input type="hidden" name="service_id[]" value="1" placeholder="test test ">
                                                   <span id="span_id" data-id="1">
                                                   <i class="fas fa-times-circle akh1" id="id_1" value="1" data-sname="Anal" data-val="1"></i>
                                                   </span>
                                                </div>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12 text-right">
                                    <button id="my_services" type="submit" class="save_profile_btn">Update</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="about_me_drop_down_info profile-sec p-4">
                        <div class="about_me_heading_in_first_tab fill_profile_headings_global">
                           <h2>Rates</h2>
                        </div>
                        <div class="padding_20_all_side">
                           <form id="storeRate" action="#" method="Post">
                              <input type="hidden" name="_token" value=" ">                
                              <div class="row">
                                 <div class="col-lg-8 col-md-12 col-sm-12 full-width-for-ipad-select horizontal-scroll-rates">
                                    <div class="rate_first_row row">
                                       <div class="col-3">
                                       </div>
                                       <div class="col-3 rate-img-center">
                                          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="30" height="30" rx="15" fill="#0C223D"/>
                                             <path d="M19.8424 18C20.1693 18 20.4449 18.12 20.6692 18.36C20.8935 18.6 21.0037 18.88 20.9999 19.2L16.4214 21L12.4302 19.8V14.4H13.542L17.6872 16.014C17.9837 16.138 18.1319 16.362 18.1319 16.686C18.1319 16.874 18.0673 17.038 17.9381 17.178C17.8088 17.318 17.6454 17.392 17.4477 17.4H15.8512L14.8534 16.998L14.6653 17.562L15.8512 18H19.8424ZM17.5617 9.738C17.9647 9.246 18.4778 9 19.1012 9C19.6182 9 20.0553 9.2 20.4126 9.6C20.7699 10 20.96 10.46 20.9828 10.98C20.9828 11.392 20.7927 11.884 20.4126 12.456C20.0325 13.028 19.6581 13.506 19.2894 13.89C18.9207 14.274 18.3448 14.844 17.5617 15.6C16.7711 14.844 16.1895 14.274 15.817 13.89C15.4445 13.506 15.0701 13.028 14.6938 12.456C14.3175 11.884 14.1331 11.392 14.1407 10.98C14.1407 10.436 14.3251 9.976 14.6938 9.6C15.0625 9.224 15.5072 9.024 16.028 9C16.6362 9 17.1474 9.246 17.5617 9.738ZM9 14.4H11.2898V21H9V14.4Z" fill="#FF3C5F"/>
                                          </svg>
                                       </div>
                                       <div class="col-3 rate-img-center">
                                          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="30" height="30" rx="15" fill="#0C223D"/>
                                             <path d="M15.3333 9C16.1732 9 16.9786 9.33363 17.5725 9.92749C18.1664 10.5214 18.5 11.3268 18.5 12.1667C18.5 13.0065 18.1664 13.812 17.5725 14.4058C16.9786 14.9997 16.1732 15.3333 15.3333 15.3333C14.4935 15.3333 13.688 14.9997 13.0942 14.4058C12.5003 13.812 12.1667 13.0065 12.1667 12.1667C12.1667 11.3268 12.5003 10.5214 13.0942 9.92749C13.688 9.33363 14.4935 9 15.3333 9ZM15.3333 16.9167C18.8325 16.9167 21.6667 18.3337 21.6667 20.0833V21.6667H9V20.0833C9 18.3337 11.8342 16.9167 15.3333 16.9167Z" fill="#FF3C5F"/>
                                          </svg>
                                       </div>
                                       <div class="col-3 rate-img-center">
                                          <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <rect width="30" height="30" rx="15" fill="#0C223D"/>
                                             <path d="M20.0417 18.458V20.0413H10.5417V18.458C10.5417 18.458 10.5417 15.2913 15.2917 15.2913C20.0417 15.2913 20.0417 18.458 20.0417 18.458ZM17.6667 11.333C17.6667 10.8633 17.5274 10.4041 17.2664 10.0135C17.0054 9.62296 16.6345 9.31855 16.2005 9.1388C15.7666 8.95904 15.289 8.912 14.8283 9.00364C14.3676 9.09528 13.9444 9.32148 13.6123 9.65363C13.2801 9.98578 13.0539 10.409 12.9623 10.8697C12.8707 11.3304 12.9177 11.8079 13.0975 12.2419C13.2772 12.6759 13.5816 13.0468 13.9722 13.3077C14.3628 13.5687 14.8219 13.708 15.2917 13.708C15.9216 13.708 16.5256 13.4578 16.971 13.0124C17.4164 12.567 17.6667 11.9629 17.6667 11.333ZM20.2 15.3388C20.6328 15.7381 20.9816 16.2195 21.2263 16.7551C21.471 17.2906 21.6065 17.8695 21.625 18.458V20.0413H24V18.458C24 18.458 24 15.7268 20.2 15.3388ZM19.25 8.95801C19.0108 8.95815 18.7731 8.99554 18.5454 9.06884C19.0086 9.73303 19.2569 10.5233 19.2569 11.333C19.2569 12.1427 19.0086 12.933 18.5454 13.5972C18.7731 13.6705 19.0108 13.7079 19.25 13.708C19.8799 13.708 20.484 13.4578 20.9294 13.0124C21.3748 12.567 21.625 11.9629 21.625 11.333C21.625 10.7031 21.3748 10.099 20.9294 9.65363C20.484 9.20823 19.8799 8.95801 19.25 8.95801ZM11.3333 12.9163H8.95833V10.5413H7.375V12.9163H5V14.4997H7.375V16.8747H8.95833V14.4997H11.3333V12.9163Z" fill="#FF3C5F"/>
                                          </svg>
                                       </div>
                                    </div>
                                    <div class="rate_first_row">
                                       <input type="hidden" name="duration_id[]" value="1">
                                       <div class="form-group row">
                                          <label class="col-3" for="exampleFormControlSelect1">30 Minutes: </label>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="rate_first_row">
                                       <input type="hidden" name="duration_id[]" value="7">
                                       <div class="form-group row">
                                          <label class="col-3" for="exampleFormControlSelect1">45 Minutes: </label>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="rate_first_row">
                                       <input type="hidden" name="duration_id[]" value="8">
                                       <div class="form-group row">
                                          <label class="col-3" for="exampleFormControlSelect1">60 Minutes:</label>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="massage_price" name="massage_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="incall_price" name="incall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                          <div class="col-3">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <span>$</span>
                                                <input min="0" type="number" class="form-control form-control-sm select_tag_remove_box_sadow" id="outcall_price" name="outcall_price[]" value="" step="10" max="200">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12 text-right">
                                    <button id="store_rate" type="submit" class="save_profile_btn">Update</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="tab_btm_btns_preview_and_next">
                        <div class="row pt-3 pb-3">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-12 a_text_white_hover previous_bt_center_in_sm">
                              <a class="nex_sterp_btn btn_width_hundred" id="home-tab" data-toggle="tab" href="#aboutme" role="tab" aria-controls="home" aria-selected="true">
                              <i class="fas fa-arrow-left"></i>Previous Step</a>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-12 text-right a_text_white_hover previous_bt_center_in_sm">
                              <a href="{{ asset('/escort-profile/46') }}" class="save_profile_btn">Preview</a>
                              <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">Next Step
                              <i class="fas fa-arrow-right"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="available" role="tabpanel" aria-labelledby="contact-tab">
                     <div class="about_me_drop_down_info profile-sec pl-5 pt-4 pb-4 ml-0">
                        <div class="padding_20_all_side my-availability-mon">
                           <form class="my-availability-mon-sun" id="myability" action="#" method="Post" novalidate="">
                              <input type="hidden" name="_token" value=" ">               
                              <div class="row">
                                 <div class="col-12">
                                    <div class="form-group row">
                                       <label class="col-0 pr-5" for="exampleFormControlSelect1">Monday:</label>
                                       <input type="hidden" value="monday">
                                       <div class="col-11 p-0 monday">
                                          <div class="row">
                                             <div class="col-3">
                                                <div class="service_rate_dolor_symbol form-group" @disabled(true)="">
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_from" id="mon_hh_from" data-parsley-gt="#mon_hh_to">
                                                   <option value="" selected="">HH</option>
                                                   <option vlaue="1">01</option>
                                                   <option vlaue="2" selected="">02</option>
                                                   <option vlaue="3">03</option>
                                                   <option vlaue="4">04</option>
                                                   <option vlaue="5">05</option>
                                                   <option vlaue="6">06</option>
                                                   <option vlaue="7">07</option>
                                                   <option vlaue="8">08</option>
                                                   <option vlaue="9">09</option>
                                                   <option vlaue="10">10</option>
                                                   <option vlaue="11">11</option>
                                                   <option vlaue="12">12</option>
                                                </select>
                                                <span>:</span>
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="mon_mm_from" name="mon_mm_from">
                                                   <option value="" selected="">MM</option>
                                                   <option value="00"> 00</option>
                                                   <option value="10"> 10</option>
                                                   <option value="20" selected=""> 20</option>
                                                   <option value="30"> 30</option>
                                                   <option value="40"> 40</option>
                                                   <option value="50"> 50</option>
                                                   <option value="59"> 59</option>
                                                </select>
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_from">
                                                   <option value="" selected="">--</option>
                                                   <option value="AM" selected="">AM</option>
                                                   <option vlaue="PM">PM</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-0 pr-3">
                                             <span>to</span>
                                          </div>
                                          <div class="col-3 p-0">
                                             <div class="service_rate_dolor_symbol form-group">
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_hh_to" id="mon_hh_to">
                                                   <option value="" selected="">HH</option>
                                                   <option vlaue="1">01</option>
                                                   <option vlaue="2">02</option>
                                                   <option vlaue="3">03</option>
                                                   <option vlaue="4" selected="">04</option>
                                                   <option vlaue="5">05</option>
                                                   <option vlaue="6">06</option>
                                                   <option vlaue="7">07</option>
                                                   <option vlaue="8">08</option>
                                                   <option vlaue="9">09</option>
                                                   <option vlaue="10">10</option>
                                                   <option vlaue="11">11</option>
                                                   <option vlaue="12">12</option>
                                                </select>
                                                <span>:</span>
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" name="mon_mm_to" id="mon_mm_to">
                                                   <option value="" selected="">MM</option>
                                                   <option value="00"> 00</option>
                                                   <option value="10"> 10</option>
                                                   <option value="20" selected=""> 20</option>
                                                   <option value="30"> 30</option>
                                                   <option value="40"> 40</option>
                                                   <option value="50"> 50</option>
                                                   <option value="59"> 59</option>
                                                </select>
                                                <select class="form-control form-control-sm select_tag_remove_box_sadow monday" id="" name="mon_time_to">
                                                   <option value="" selected="">--</option>
                                                   <option value="AM" selected="">AM</option>
                                                   <option vlaue="PM">PM</option>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="col-4 pl-2">
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="unavailable" data-parsley-multiple="covidreport">
                                                <label class="form-check-label" for="inlineRadio1">Close</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="By Appointment" data-parsley-multiple="covidreport">
                                                <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                <input class="form-check-input monday" type="radio" name="availability_time[monday]" id="monday" value="Available 24 hours" data-parsley-multiple="covidreport">
                                                <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                                             </div>
                                          </div>
                                          <div class="col-1">
                                             <div class="resetdays-icon">
                                                <input type="button" value="Reset" class="resetdays" data-day="monday" id="resetMonday">
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0 pr-5" for="exampleFormControlSelect1">Tuesday:</label>
                        <input type="hidden" value="tuesday">
                        <div class="col-11 p-0 tuesday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_from" id="tue_hh_from">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="tue_mm_from" name="tue_mm_from">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_from">
                        <option value="" selected="" disable="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_hh_to" id="tue_hh_to">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" name="tue_mm_to" id="tue_mm_to">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow tuesday" id="" name="tue_time_to">
                        <option value="" selected="" disable="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="unavailable" data-parsley-multiple="covidreport" checked="">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input tuesday" type="radio" name="availability_time[tuesday]" id="tuesday" value="Available 24 hours" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="tuesday" id="resetTuesday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0 pr-4" for="exampleFormControlSelect1">Wednesday:</label>
                        <input type="hidden" value="wednesday">
                        <div class="col-11 p-0 wednesday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_from" id="wed_hh_from">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="wed_mm_from" name="wed_mm_from">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_from">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_hh_to" id="wed_hh_to">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" name="wed_mm_to" id="wed_mm_to">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow wednesday" id="" name="wed_time_to">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="unavailable" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input wednesday" type="radio" name="availability_time[wednesday]" id="wednesday" value="Available 24 hours" data-parsley-multiple="covidreport" checked="">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="wednesday" id="resetWednesday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0" for="exampleFormControlSelect1" style="padding-right: 3em;">Thursday:</label>
                        <input type="hidden" value="thursday">
                        <div class="col-11 p-0 thursday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_from" id="thu_hh_from">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="thu_mm_from" name="thu_mm_from">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_from">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_hh_to" id="thu_hh_to">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" name="thu_mm_to" id="thu_mm_to">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow thursday" id="" name="thu_time_to">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="unavailable" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input thursday" type="radio" name="availability_time[thursday]" id="thursday" value="Available 24 hours" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="thursday" id="resetThursday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0" for="exampleFormControlSelect1" style="padding-right: 4.5em;">Friday:</label>
                        <input type="hidden" value="friday">
                        <div class="col-11 p-0 friday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_from" id="fri_hh_from">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="fri_mm_from" name="fri_mm_from">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_from">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_hh_to" id="fri_hh_to">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" name="fri_mm_to" id="fri_mm_to">
                        <option value="" selected="">MM</option>
                        <option value="00">00</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow friday" id="" name="fri_time_to">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="unavailable" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input friday" type="radio" name="availability_time[friday]" id="friday" value="Available 24 hours" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="friday" id="resetFriday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0" for="exampleFormControlSelect1" style="padding-right: 3em;">Saturday:</label>
                        <input type="hidden" value="saturday">
                        <div class="col-11 p-0 saturday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_from" id="sat_hh_from">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="sat_mm_from" name="sat_mm_from">
                        <option value="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_from">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_hh_to" id="sat_hh_to">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" name="sat_mm_to" id="sat_mm_to">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow saturday" id="" name="sat_time_to">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="unavailable" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input saturday" type="radio" name="availability_time[saturday]" id="saturday" value="Available 24 hours" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="saturday" id="resetSaturday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-12">
                        <div class="form-group row">
                        <label class="col-0" for="exampleFormControlSelect1" style="padding-right: 3.8em;">Sunday:</label>
                        <input type="hidden" value="sunday">
                        <div class="col-11 p-0 sunday">
                        <div class="row">
                        <div class="col-3">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_from" id="">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_mm_from">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="" name="sun_time_from">
                        <option value="" selected="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-0 pr-3">
                        <span>to</span>
                        </div>
                        <div class="col-3 p-0">
                        <div class="service_rate_dolor_symbol form-group">
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_hh_to" id="">
                        <option value="" selected="">HH</option>
                        <option vlaue="1">01</option> <option vlaue="2">02</option> <option vlaue="3">03</option> <option vlaue="4">04</option> <option vlaue="5">05</option> <option vlaue="6">06</option> <option vlaue="7">07</option> <option vlaue="8">08</option> <option vlaue="9">09</option> <option vlaue="10">10</option> <option vlaue="11">11</option> <option vlaue="12">12</option>                                            </select>
                        <span>:</span>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" name="sun_mm_to" id="">
                        <option value="" selected="">MM</option>
                        <option value="00"> 00</option> <option value="10"> 10</option> <option value="20"> 20</option> <option value="30"> 30</option> <option value="40"> 40</option> <option value="50"> 50</option> <option value="59"> 59</option>                                            </select>
                        <select class="form-control form-control-sm select_tag_remove_box_sadow sunday" id="sun_time_to" name="sun_time_to">
                        <option value="">--</option>
                        <option value="AM">AM</option>
                        <option vlaue="PM">PM</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-4 pl-2">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="unavailable" data-parsley-multiple="covidreport" checked="">
                        <label class="form-check-label" for="inlineRadio1">Close</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="By Appointment" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">By Appointment</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input sunday" type="radio" name="availability_time[sunday]" id="sunday" value="Available 24 hours" data-parsley-multiple="covidreport">
                        <label class="form-check-label" for="inlineRadio1">Available 24 hours</label>
                        </div>
                        </div>
                        <div class="col-1">
                        <div class="resetdays-icon">
                        <input type="button" value="Reset" class="resetdays" data-day="sunday" id="resetSunday">
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row pt-3">
                        <div class="col-11 text-right">
                        <button id="my_abilities" type="submit" class="save_profile_btn">Save</button>
                        </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="col-lg-12">
                     <div class="member-id pl-0 pb-2 pt-3">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M8 0C9.06087 0 10.0783 0.421427 10.8284 1.17157C11.5786 1.92172 12 2.93913 12 4C12 5.06087 11.5786 6.07828 10.8284 6.82843C10.0783 7.57857 9.06087 8 8 8C6.93913 8 5.92172 7.57857 5.17157 6.82843C4.42143 6.07828 4 5.06087 4 4C4 2.93913 4.42143 1.92172 5.17157 1.17157C5.92172 0.421427 6.93913 0 8 0ZM8 10C12.42 10 16 11.79 16 14V16H0V14C0 11.79 3.58 10 8 10Z" fill="#C2CFE0"></path>
                        </svg>
                        <span>Member ID: E4U208</span>
                     </div>
                  </div>
                  <div class="about_me_drop_down_info ">
                     <div class="padding_20_all_side payment_form_bg">
                        <form id="" action="" method="POST">
                           <div class="row margin_zero_for_row">
                              <div class="col-lg-6 col-md-6 col-12 mb-2">
                                 <div class="paymnt_summery mb-3 summary-bg">
                                    <h4 class="mb-4">Summary</h4>
                                    <hr>
                                    <p>
                                       <span class="bold_text">Profile Name:</span>xyz
                                    </p>
                                    <p>
                                       <span class="bold_text">Location:</span>Nepal
                                    </p>
                                    <p>
                                       <span class="bold_text">Start Date:</span>12/03/2022
                                    </p>
                                    <p>
                                       <span class="bold_text">Duration:</span>10 Day
                                    </p>
                                    <p>
                                       <span class="bold_text">Membership Type:</span>Platinum
                                    </p>
                                    <p>
                                       <span class="bold_text">Daily rate:</span>$0
                                    </p>
                                    <p>
                                       <span class="bold_text">Fees:</span>$0
                                    </p>
                                    <div class="mt-4 pl-2">
                                       <p>
                                          <span class="bold_text">Discounts:</span>$0
                                       </p>
                                       <div class="total_amount">
                                          <h5 class="bold_text">Total:
                                             <span>$0</span>
                                          </h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-12">
                                 <div class="summary-bg">
                                    <h4 class="mb-4">Payment</h4>
                                    <hr>
                                    <div class="form-group">
                                       <label for="">Name on Card
                                       <span style="color:red">*</span>
                                       </label>
                                       <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                                       <label class="payment_card_colors" for="">
                                       <i class="fab fa-cc-visa"></i>
                                       <i class="fab fa-cc-mastercard"></i>
                                       </label>
                                    </div>
                                    <div class="form-group">
                                       <label for="">Card Number
                                       <span style="color:red">*</span>
                                       </label>
                                       <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                                    </div>
                                    <div class="form-group">
                                       <label for="">Expiry
                                       <span style="color:red">*</span>
                                       </label>
                                       <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text" placeholder="Month/Year">
                                    </div>
                                    <div class="form-group">
                                       <label for="">CSV
                                       <span style="color:red">*</span>
                                       </label>
                                       <input class="form-control form-control-sm select_tag_remove_box_sadow" type="text">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
                  <!-- check out btns -->
                  <div class="tab_btm_btns_preview_and_next">
                     <div class="row pt-3 pb-3">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-12 a_text_white_hover previous_bt_center_in_sm margin_for_check_out">
                           <a href="#available" class="nex_sterp_btn" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false">
                           <i class="fas fa-arrow-left"></i>Previous Step</a>
                           <a href="#" class="nex_sterp_btn btn_width_hundred">Save Profile</a>
                           <a href="{{ asset('/escort-profile/46') }}" class="save_profile_btn">Preview Profile</a>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-12 text-center a_text_white_hover previous_bt_center_in_sm">
                           <!-- <a href="#" class="save_profile_btn">Preview</a> -->
                           <a href="#" class="nex_sterp_btn btn-block">Checkout
                           <i class="fas fa-arrow-right"></i>
                           </a>
                        </div>
                     </div>
                  </div>
                  <!-- check out btns -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- End of Main Content -->
<!-- Footer -->
<footer class="sticky-footer bg-white">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span> </span>
      </div>
   </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script>
   var editor_id2 = document.getElementById("editor2");
       var editor_id3 = document.getElementById("editor3");
       let editor2 = CKEDITOR.replace(editor_id2);
       let editor3 = CKEDITOR.replace(editor_id3);
   
   
       var textarea = document.getElementById('editor1');
       let editor = CKEDITOR.replace(textarea);
   
       $('#select2-dropdown').select2({
           createTag: function (params) {
               var term = $.trim(params.term);
   
               if (term === '') {
                   return null;
               }
               return {
                   id: term,
                   text: term,
                   newTag: true // add additional parameters
               }
           },
           tags: false,
           minimumInputLength: 2,
           tokenSeparators: [','],
           ajax: {
               url: "{{ route('country.list') }}",
               dataType: "json",
               type: "GET",
               data: function (params) {
                   console.log(params);
                   var queryParameters = {
                       query: params.term
                   }
                   return queryParameters;
               },
               processResults: function (data) {
                   return {
                       results: $.map(data, function (item) {
   
                           return {
                               text: item.name,
                               id: item.id
                           }
                       })
                   };
               }
           }
       });
</script>
<script>
   //jQuery time
   var current_fs, next_fs, previous_fs; //fieldsets
   var left, opacity, scale; //fieldset properties which we will animate
   var animating; //flag to prevent quick multi-click glitches
   
   $(".next").click(function(){
      if(animating) return false;
      animating = true;
      
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();
      
      //activate next step on progressbar using the index of next_fs
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
      
      //show the next fieldset
      next_fs.show(); 
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
         step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            //scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
         });
            next_fs.css({'left': left, 'opacity': opacity});
         }, 
         duration: 800, 
         complete: function(){
            current_fs.hide();
            animating = false;
         }, 
         //this comes from the custom easing plugin
         easing: 'easeInOutBack'
      });
   });
   
   $(".previous").click(function(){
      if(animating) return false;
      animating = true;
      
      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();
      
      //de-activate current step on progressbar
      $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
      
      //show the previous fieldset
      previous_fs.show(); 
      //hide the current fieldset with style
      current_fs.animate({opacity: 0}, {
         step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            //left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
         }, 
         duration: 800, 
         complete: function(){
            current_fs.hide();
            animating = false;
         }, 
         //this comes from the custom easing plugin
         easing: 'easeInOutBack'
      });
   });
   
   $(".submit").click(function(){
      return false;
   })
</script>>
<script type="text/javascript">
   $('#userProfile').parsley({
   
   });
   
   
   
   $('#userProfile').on('submit', function(e) {
     e.preventDefault();
   
     var form = $(this);
   
     if (form.parsley().isValid()) {
   
       var url = form.attr('action');
       var data = new FormData(form[0]);
       $.ajax({
         method: form.attr('method'),
         url: url,
         data: data,
         contentType: false,
         processData: false,
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(data) {
           console.log(data);
           if (data.error == true) {
             $.toast({
               heading: 'Success',
               text: 'Details successfully saved',
               icon: 'success',
               loader: true,
                             position: 'top-right', // Change it to false to disable loader
                             loaderBg: '#9EC600' // To change the background
                           });
                           location.reload();
   
           } else {
             $.toast({
               heading: 'Error',
               text: 'Records Not update',
               icon: 'error',
               loader: true,
                             position: 'top-right', // Change it to false to disable loader
                             loaderBg: '#9EC600' // To change the background
                           });
   
           }
         },
   
       });
     }
   });
   
   
   
   
   
</script>
@endpush