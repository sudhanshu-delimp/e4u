@extends('layouts.escort')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/app/vendor/file-upload/css/pintura.min.css') }}">
<style type="text/css">
    .parsley-errors-list {
    list-style: none;
    color: rgb(248, 0, 0)
    }
    .how--work {
    margin: 40px auto;
    padding: 0 20px;
    display: grid;
    grid-template-columns: 270px 1fr;
    gap: 24px;
    width: 100%;
    position: relative;
}

.toc {
    position: sticky;
    top: 10px;
    align-self: start;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 10px 24px rgba(2,6,23,.06);
    padding: 16px;
}
.toc a {
    display: block;
    padding: 5px 10px;
    border-radius: 10px;
    color: #0c223d !important;
    text-decoration: none;
    border: 1px solid transparent;
    font-weight: 500;
}
.toc a:hover{
    color: #FF3C5F !important;
}
.card > .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    border-bottom: 1px solid #e5e7eb;
}
.card h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 500;
}

.pill {
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    color: #4b5563;
}
.card > .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 20px;
    border-bottom: 1px solid #e5e7eb;
}
.card h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 500;
}

.pill {
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    color: #4b5563;
}
.card .inner {
    padding: 14px 20px 22px;
}
details[open] {
    /* background: linear-gradient(180deg, #fafbff, #ffffff); */
}
details {
    background: #fafbff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 15px 20px;
    margin: 20px 0;
}

details > summary {
    list-style: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    font-weight: 600;
}
details[open] > summary:first-of-type {
    list-style-type: disclosure-open;
}
.chip {
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 999px;
    background: rgba(125, 211, 252, .15);
    color: var(--accent);
    border: 1px solid rgba(125, 211, 252, .3);
}

.summary-title {
    display: flex;
    align-items: center;
    gap: 10px;
}

.steps p {
    margin-block-start: 1em;
    margin-block-end: 1em;
}

.card {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    box-shadow: 0 10px 24px rgba(2, 6, 23, .06);
    padding: 0;
}
.callout {
    padding: 12px 14px;
    border: 1px dashed #e5e7eb;
    border-radius: 14px;
    background: rgba(94, 161, 255, .08);
}

.summary-title:hover {
    color: #FF3C5F;
}

.summary-title ul {
    padding: 8px 0 8px 24px;
}

.steps ul {
    margin: 8px 0 8px 8px;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">How is it Done – Profiles</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
    </div>
            <div class="row">
               <div class="col-md-12 mt-2 mb-5">
                 <div id="accordion" class="myacording-design">
             
                   <!-- Overview -->
                   <div class="card">
                     <div class="card-header" id="headingOverview">
                       <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseOverview" aria-expanded="false">
                           New
                         </a>
                       </h5>
                     </div>
                     <div id="collapseOverview" class="collapse show" aria-labelledby="headingOverview" data-parent="#accordion">
                       <div class="card-body">
                        <h5 class="d_sub_heading">Overview</h5>
                         <p>Use this feature to create your Profiles for all of your Locations (particularly if you Tour). You can edit any of the pre-loaded data along the way. The Profile Creator will ask you if you want to update your My Information or not. If you choose No, your default settings will stay the same, and the data setting you have changed will only apply to the Profile you are creating.</p>
                         <h5 class="mt-4 d_sub_heading">Features</h5>
                         <ol class="pl-3">
                           <li>About Me</li>
                           <li>My Services & Rates</li>
                           <li>My Availability</li>
                           <li>Playmates</li>
                        </ol>
                        <h5 class="mt-4 d_sub_heading">How is it done</h5>
                        <p>The Profile Creator completes your information in four steps. You can change any pre-loaded data along the way and the Creator will ask you if you want to update your settings. If you say Yes the data is updated, if you say No, your settings remain the same and the changes you made are only applied to the Profile you are creating.</p>
                        </div>
                     </div>
                   </div>
             
                   <!-- Features -->
                   <div class="card">
                     <div class="card-header" id="headingFeatures">
                       <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFeatures" aria-expanded="false">
                          Step 1 - About Me
                         </a>
                       </h5>
                     </div>
                     <div id="collapseFeatures" class="collapse" aria-labelledby="headingFeatures" data-parent="#accordion">
                       <div class="card-body">
                         <p>This step requires the most input. If you have already completed your data under <a href="/escort-dashboard/profile-information" class="custom_links_design">My Information</a> [> My Account > My Information], then the data will have pre-loaded. Check that every field, or at the very least the fields that you want to be published in your Profile, are complete.</p>
                         <p class="mt-4 d_sub_heading"> <b>About Me is divided into four parts:</b></p>
                         <h5 class="mt-3 d_sub_heading"> Location Information</h5>
                         <p>Some of these fields are pre-loaded with your data. You will need to complete the following:</p>
                         <ol class="pl-3">
                           <li><h5 class="mt-3 d_sub_heading">Profile Name.</h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  It would be helpful if you are consistent when naming your Profiles. 
                                  We recommend you adapt a protocol that relates to the Location. 
                                  For example, if you are creating a Profile for the Location NSW, then 
                                  you could name the Profile <b>Sydney01</b> and the second Profile, 
                                  if you create a second for the Location NSW, <b>Sydney02</b>, and so on.
                                </p>
                              </div>
                              <div>
                                <img class="img-fluid rounded shadow-sm" 
                                     src="{{ asset('assets/app/img/11.png')}}" 
                                     alt="Profile Naming Guide" 
                                     style="max-width: 300px;">
                              </div>
                            </div>
                            
                          </li>
                          <li>
                            <h5 class="mt-3 d_sub_heading"> Stage Name </h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  This is your name you will use for your Profile. You can select a Stage Name from your existing list or create a new Stage Name. Any new Stage Name you create will be added to your list of Stage Names. Any Stage Names that are currently in use, for the Location, will not appear in the list.
                                </p>
                              </div>
                              
                            </div>
                          </li>
                          <li>
                            <h5 class="mt-3 d_sub_heading"> Location </h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  The Location, by default, will be your Home State. If you are presently in another Location, and that is where you want to list your Profile, then change the Location to where you are, like Victoria for example. Always remember, to List a Profile, you must have a Profile/s saved for the Location you intent to create a Listing for.
                                </p>
                              </div>
                              
                            </div>
                          </li>
                          <li>
                            <h5 class="mt-3 d_sub_heading"> City </h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  The city name will load by default according to the Location you have selected.
                                </p>
                              </div>
                              
                            </div>
                          </li>
                          <li>
                            <h5 class="mt-3 d_sub_heading"> Street Address  </h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  This is optional. We recommend you include the address you are staying at but without the street number. This is particularly helpful to your clients so that they have an idea about where in the city you are staying, which helps them with timing and importantly where to park.
                                </p>
                              </div>
                              
                            </div>
                          </li>
                          <li>
                            <h5 class="mt-3 d_sub_heading"> Mobile  </h5>
                            <div class="d-flex align-items-center">
                              <div class="pr-3">
                                <p>
                                  Your mobile number will pre-load from your My Account settings.
                                </p>
                              </div>
                              
                            </div>
                          </li>
                        </ol>
                        </div>
                     </div>
                   </div>
             
                   <!-- How is it done -->
                   <div class="card">
                     <div class="card-header" id="headingHow">
                      <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseMedia" aria-expanded="false">
                          Media - Photos
                         </a>
                       </h5>
                     </div>
                     <div id="collapseMedia" class="collapse" aria-labelledby="headingMedia" data-parent="#accordion">
                      <div class="card-body">
                        <p>There are two mandatory sets of photos required for your Profile, your Banner image, which appears across the top of your Profile, and your Thumbnail and supporting images. If you have set up your <a href="/escort-dashboard/archive-view-photos" class="custom_links_design">Media</a> [Media > Photos], it will pre-load. If you have not set up your default Media, you can do so from the Creator, and you will be asked if you want to update your default Media. The Creator will also permit you to clip images.</p>
                       
                        <ol class="pl-3">
                          <li><h5 class="mt-3 d_sub_heading">Thumbnail</h5>
                           <div class="d-flex align-items-center">
                             <div class="pr-3">
                               <p>
                                You can change any of your images from your default images. The Creator will ask you if you want to update your default images if you have made any changes. If you answer Yes, your default images will update. If you answer NO, your default images will remain unchanged, but the new image/s you selected will be attached to the Profile you are creating.
                               </p>
                             </div>
                             <div>
                               <img class="img-fluid rounded shadow-sm" 
                                    src="{{ asset('assets/app/img/12.png')}}" 
                                    alt="Profile Naming Guide" 
                                    style="max-width: 300px;">
                             </div>
                           </div>
                           <p>Your Thumbnail image is what will appear in the Listings and is the default image on your Profile. Viewers can scroll through your images, as well as click and view from a pop up.</p>
                           
                         </li>
                         <li>
                           <h5 class="mt-3 d_sub_heading"> Banner </h5>
                           <div class="d-flex align-items-center">
                             <div class="pr-3">
                               <p>
                                Your Banner image sits across the top of your Profile. We recommend you select an image that is landscape in nature. If you do not have an image, your can select from our template images. The images represent a range of erotic lingerie.
                               </p>
                             </div>
                             
                           </div>
                         </li>
                        
                       </ol>
                       </div>
                    </div>
                   </div>

                   <div class="card">
                    <div class="card-header" id="headingHow">
                     <h5 class="mb-0">
                       <a class="card-link collapsed" data-toggle="collapse" href="#collapseVideo" aria-expanded="false">
                        Media - Video
                        </a>
                      </h5>
                    </div>
                    <div id="collapseVideo" class="collapse" aria-labelledby="headingVideo" data-parent="#accordion">
                     <div class="card-body">
                       <p>You can load up to six videos into your Media. The default video, three in total, will pre-load in the Creator. You cab change any of your videos within the Creator. Where you change a video the Creator will ask you if you want to update your default video. If you say Yes the data is updated, if you say No, your settings remain the same and the change/s you made are only applied to the Profile you are creating.</p>
                      <p class="mt-2">Your video is displayed in the Media pop up on your profile. If you have video available to Viewers, your Profile will also display a camera indicating that video is available for viewing.</p>
                      
                      </div>
                   </div>
                  </div>
             
                 </div>
               </div>
             </div>
             
         </div>

@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
    
@endpush
