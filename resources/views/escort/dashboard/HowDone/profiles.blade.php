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
.how-it-done p {
    margin-bottom: 0.8rem !important;
}

.how-it-done h5 {
    font-weight: 500;
}
</style>
@endsection
@section('content')
<div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
   <div class="row">
        <div class="col-md-12 custom-heading-wrapper">
            <h1 class="h1">Profiles</h1>
            <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
        </div>
    </div>
            <div class="row how-it-done">
              <div class="col-md-12 mt-2 mb-5">
                <div id="accordion" class="myacording-design">
              
                  <!-- + New -->
                  <div class="card">
                    <div class="card-header" id="headingNew">
                      <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseNew" aria-expanded="false">
                          + New
                        </a>
                      </h5>
                    </div>
                    <div id="collapseNew" class="collapse" aria-labelledby="headingNew" data-parent="#accordion">
                      <div class="card-body">
              
                        <h2>Overview</h2>
                        <p>
                          Use this feature to create a New Tour. You can create as many Locations within the Tour as you like, and also as many Profiles for each Location you will be visiting.
                        </p>
                        <p>
                          If you want to be a Pin Up in any of the Locations, if the Pin Up week is available during the days you are at that Location, then you can also add the Pin Up feature to the Location.
                        </p>
              
                        <h2>Features</h2>
                        <ul>
                          <li>Create an entire Tour in the one process</li>
                          <li>Easy to follow</li>
                          <li>Multiple Profile Listings for each Location</li>
                          <li>Include the Pin Up if it is available</li>
                        </ul>
              
                        <h2>How is it done</h2>
                        <hr>
                        <h5>Tour name</h5>
                        <p>
                          To create a Tour you must first give the Tour a name. It is up to you how you label your Tour, but we recommend whatever you decide, you then maintain it. For example you could name a Tour: August2025 (no spaces).
                        </p>
              
                        <h5>Location</h5>
                        <p>
                          The next step is to select your first Location, where the Tour starts from. Click the Location button and by default your Home State will load. You can change the Location to any Location, provided you have created Profiles for the Location you select.
                        </p>
                        <p>
                          The next step is to select the start date and end date for that Location. You can insert the dates manually, or use the calendar pop up.
                        </p>
                        <p>
                          Next, add the Profile you have created for that Location. You can change the Stage Name if you want. If you change the Stage Name you will be asked if you want to save the change to the Profile. If you answer Yes the Profile will update, if you answer No, the Profile will remain unchanged but the new Stage Name will be applied to the Profile for the Tour.
                        </p>
                        <p>
                          Lastly, select the Membership Type you want for the profile. Platinum Membership will load by default.
                        </p>
                        <p>
                          You have now completed your first Location. If you want you can add additional Profiles to the Location by clicking the Add Profile button, and repeating the process. To save the setting, click Add Location, and the next Location will appear. Repeat the procedure until you have completed all the Locations and Profiles for those Locations. As you add a Location, the Tour Creator will auto-fill the start date for the next Location.
                        </p>
                        <p>
                          When you have completed the Tour, click Save.
                        </p>
              
                        <h5>Pin Up</h5>
                        <p>
                          If you want to add the Pin Up feature to any of the Locations, go to Profiles Listed [> Profiles > Listed] and follow the procedure to List Pin Up.
                        </p>
              
                      </div>
                    </div>
                  </div>
              
                  <!-- + Current -->
                  <div class="card">
                    <div class="card-header" id="headingCurrent">
                      <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseCurrent" aria-expanded="false">
                          + Current
                        </a>
                      </h5>
                    </div>
                    <div id="collapseCurrent" class="collapse" aria-labelledby="headingCurrent" data-parent="#accordion">
                      <div class="card-body">
              
                        <h2>Overview</h2>
                        <p>
                          A comprehensive report summarising your Current Tours. You can create short or long Tours. It is entirely up to you, but you must have a minimum of two Locations in the Tour. 
                          You can manage your Tours from the Dashboard My Tour Schedule [> Dashboard > My Tour Schedule] as well as from your Current Tours [> Tours > Current] report.
                        </p>
              
                        <h2>Features</h2>
                        <ul>
                          <li>Manage your current Tour/s from the one location</li>
                          <li>Comprehensive summary of your Tour schedule</li>
                        </ul>
              
                        <h2>How is it done</h2>
                        <p>
                          You can view in detail all the particulars associated with your current Tour. You can also action a Tour from the Action list, such as Edit, Cancel, View and Tour Summary.
                        </p>
                        <p>
                          The edit feature is particularly helpful for changing any Profile's start or finish date, Membership Type or to remove a Profile from the Tour. Any changes to the Tour will automatically adjust your Fee to reflect the changes, including any refund. Refunds will be added to your Account as a Credit to be used for future listings and Tours.
                        </p>
                        <p>
                          The Tour Summary also displays the Fees paid for the Tour.
                        </p>
              
                      </div>
                    </div>
                  </div>
              
                  <!-- + Past -->
                  <div class="card">
                    <div class="card-header" id="headingPast">
                      <h5 class="mb-0">
                        <a class="card-link collapsed" data-toggle="collapse" href="#collapsePast" aria-expanded="false">
                          + Past
                        </a>
                      </h5>
                    </div>
                    <div id="collapsePast" class="collapse" aria-labelledby="headingPast" data-parent="#accordion">
                      <div class="card-body">
              
                        <h2>Overview</h2>
                        <p>
                          All of your completed Tours are retained and can be reactivated as a new Tour.
                        </p>
              
                        <h2>Features</h2>
                        <ul>
                          <li>Historical record of completed Tours</li>
                          <li>Reactivate a Tour</li>
                        </ul>
              
                        <h2>How is it done</h2>
                        <p>
                          View any completed Tour to see a summary of the components to the Tour. If you have a past Tour that has the Locations and Profiles that you want to use in a New Tour, then select from the Action list ‘New Tour’ and the Tour will load for you. Change the start and end dates for Each Location and Save.
                        </p>
              
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
