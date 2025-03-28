@extends('layouts.web')
@section('style')
<style>
    .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #3498db;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    }
    /* Safari */
    @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
    }
</style>
@endsection
@section('content')

<section class="padding_top_eight_px padding_bottom_eight_px">
    <div class="container"> 
      <h1 class="home_heading_first margin_btm_twenty_px">Alerts</h1>
 
       <div class="accordion-container">
        
         <div class="set">
                <a>
                 New Features
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                    <div class="accodien_manage_padding_content">
                        <p><strong>Users - E4UChat</strong></p>
                        <p>We are happy to announce that today we have launched our "E4UChat" feature for Users. You can now have private conversations between each other. Simply log on, go to your Dashboard and launch the service.</p>
                        <p class="c-red"><b>Note</b>: Conversations are encrytped.</p>

                        <p><strong>Viewer - Favorites Planner</strong></p>
                        <p>We have today launched the helpful "Favorites Planner" feature for Viewers. You can now view your favorites availablity from your "Planner". Advertisers availablity are listed from a calendar organiser. Simply select your day of interest and your favorites are listed as to when they are available from. A great way to organise your day to visit your favorite Escort.</p>
                        <p class="c-red"><b>Note</b>: Advertisers are not aware you are viewing their Profiles.</p>

                         <p><strong>Viewer - Notes</strong></p>
                        <p>We have today launched the long awaited "Notes" feature for Viewers. You can now add your notes to any of your favourite Escorts from within your Account. Simply log on, go to your Favourites and select the "Notes" feature on the Escort's Profile.</p>
                        <p class="c-red"><b>Note</b>: Advertisers can not see your notes.</p>

                        
                    </div>
                </div>
            </div>


         <div class="set">
                <a class="">
                 Scammer Alerts
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content" style="display: none;">
                    <div class="accodien_manage_padding_content">
                        <p><strong>Be aware of a WhatsApp scam!!!</strong></p>
                        <p>If a person contacts you and they ask you to verify your account data, username, password, email address and also your credit card data, BLOCK THEM IMMEDIATELY. They might pretend to be the owner of Escorts4U and their phone number will often start with and international prefix like +1 or +7.</p>
                        <p class="c-red"><b>Note</b>: Escorts4U will never ask for your PASSWORD, EMAIL or CREDIT CARD data.</p>
                        
                    </div>
                </div>
            </div>

         <div class="set">
                <a class="">
                 Website Updates
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content" style="display: none;">
                    <div class="accodien_manage_padding_content">
                        <p><strong>Launch!!!</strong></p>
                        <p>Escorts4U launches in Australia.</p>
                        <p class="c-red"><b>Note</b>:</p>
                        
                    </div>
                </div>
            </div>         
       </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    var skipSliderage = document.getElementById("skipstepage");
    var skipValuesage = [
    document.getElementById("skip-value-lower-age"),
    document.getElementById("skip-value-upper-age")
    ];
    
    noUiSlider.create(skipSliderage, {
    start: [0, 30],
    connect: true,
    behaviour: "drag",
    step: 1,
    range: {
       min: 18,
       max: 60
    },
    format: {
       from: function (value) {
          return parseInt(value);
       },
       to: function (value) {
          return parseInt(value);
       }
    }
    });
    
    skipSliderage.noUiSlider.on("update", function (values, handle) {
    skipValuesage[handle].innerHTML = values[handle];
    });
    
</script>

@endpush