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
   <!--middle content start here-->
    <!-- Page Heading -->
    <div class="row">
        <div class="custom-heading-wrapper col-md-12">
            <h1 class="h1">Add Report</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes" aria-expanded="true"><b>Help?</b></span>
         </div>
      <div class="col-md-12 mb-4">
          <div class="card collapse" id="notes" style="">
            <div class="card-body">
                <p class="mb-0" style="font-size: 20px;"><b>Notes:</b> </p>
                <ol>
                  <li>The Punterbox register <b>(Punterbox)</b> is a free service to all Viewers. You can use the
                     Punterbox service at any time.</li>
                     <li>Complete the form to add an incident to Punterbox. When completing the form please
                        ensure all of the details are correct and you have selected the correct option under
                        Incident Nature to describe the incident as well as for Rating. Please ensure your report
                       complies with the <a href="{{ route('user.code-of-conduct') }}" class="custom_links_design">Code of Conduct</a>. </li>
                     <li>
                        Punterbox a closed publication for Viewers only. Each entry contains personal reports,
                        provided by the Viewer, of incidents involving a problem Escort. Punterbox makes these
                        reports available to help other Viewers avoid problem Escorts, and as an extension of
                        the “word of mouth” warnings given by Viewers between each other.
                     </li>
                     <li>Incident Nature filter meanings:</li>
                     <ol class="level-2">
                        <li>Fake means the Escort that you met is not the same person represented in the
                           Escort’s profile photographs, or the photographs are genuine but the Escort is
                           significantly older than represented by the Profile photographs.</li>
                        <li>Under performed means the Escort did less well in the provision of the advertised
                           services than other Escorts of a similar description and of your expectation.</li>
                        <li>Liar means the content of the Escort’s Profile, or a portion of it, is false (for
                           example a trans Escort may describe their penis as 7" but in fact it is 5", or the
                           Escort may say natural sucking is permitted but insists on covered when you
                           engage).</li>
                        <li>Starfish means an Escort who does not participate either emotionally and/or
                           physically with you when you engage. They effectively “lay on their back” while you
                           undertake in sexual intercourse. They give the appearance of reluctantly taking
                           part.</li>
                        <li>Overpriced means the Escort may take on the appearance as shown in their
                           profile, provide the services described in their profile, but in your opinion is
                           overpriced when you assess the Escort by their overall stature, or make an
                           objective comparison to other Escorts of a similar stature you may have met with.
                           Effectively the Escort cost more than, in your view, they are worth.</li>
                     </ol>
                     <li>E4U makes no claims:</li>
                     <ol class="level-2">
                        <li>as to the accuracy or legitimacy of the allegations; and</li>
                        <li>nor do we investigate the authenticity of the Reports (provided in confidence by
                           Viewers)
                           </li>
                     </ol>
                </ol>
            </div>
          </div>
      </div>
  </div>
  <!-- Page Heading -->
   <div class="row">
      <div class="col-md-9 add-punterbox-report">
         <form>
            <div class="form-group">
                <label class="required">Incident Date</label>
                <input type="date" class="form-control">
            </div>
            <div class="form-group">
                <label class="required">Incident State</label>
                <select class="custom-select">
                        <option selected>Please Choose</option>
                        <option>NSW</option>
                        <option>VIC</option>
                        <option>QLD</option>
                    </select>
            </div>

            <div class="form-group">
                <label class="required">Incident Location</label>
                <input type="text" class="form-control" placeholder="Which city were you in">
            </div>

            <div class="form-group">
                <label>Escort's Name</label>
                <input type="text" class="form-control" placeholder="If known">
            </div>

            <div class="form-group">
                <label class="required">Escort's Mobile</label>
                <input type="text" class="form-control" placeholder="No spaces or any other characters - just numbers">
            </div>

            <div class="form-group">
                <label>Escort's Email</label>
                <input type="email" class="form-control" placeholder="If known">
            </div>

            <div class="form-group">
                <label class="required">Incident Nature</label>
                <select class="custom-select">
                  <option selected>Please Choose</option>
                  <option>Fraud</option>
                  <option>No Show</option>
                  <option>Violence</option>
               </select>
            </div>

            <div class="form-group">
                <label>Platform</label>
                <input type="text" class="form-control" placeholder="If known">
            </div>

            <div class="form-group">
                <label>Profile Link</label>
                <input type="text" class="form-control" placeholder="Link or Membership ID or Ref">
            </div>

            <div class="form-group">
                <label class="required">What Happened</label>
                <textarea class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label class="required d-block">Rating</label>
                <div class="form-check d-flex align-items-center">
                    <input class="form-check-input" type="radio" name="rating" id="rate1">
                    <label class="form-check-label" for="rate1">Do not book</label>
                </div>
                <div class="form-check d-flex align-items-center">
                    <input class="form-check-input" type="radio" name="rating" id="rate2">
                    <label class="form-check-label" for="rate2">Exercise caution</label>
                </div>
                <div class="form-check d-flex align-items-center">
                    <input class="form-check-input" type="radio" name="rating" id="rate3">
                    <label class="form-check-label" for="rate3">Safe</label>
                </div>
            </div>

            <button type="submit" class="save_profile_btn">Add Report</button>
            <small class="d-block mt-2">Your report will remain <em>Pending</em> until approved by our Operations team.</small>
        </form>
      </div>
   </div>
   <!--middle content end here-->
</div>
@endsection
@push('script')
<!-- file upload plugin start here -->
<!-- file upload plugin end here -->
<script type="text/javascript" src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
@endpush