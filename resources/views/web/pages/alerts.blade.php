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
                Employment
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
                <div class="accodien_manage_padding_content custom--alertlist">
                
                    <div>
                        
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div class="set">
            <a>
                New Features
            <i class="fa fa-angle-down"></i>
            </a>
            <div class="content">
                <div class="accodien_manage_padding_content custom--alertlist">
                
                    <div>
                        <p><strong>Viewer - Notes</strong></p>
                        <p>We have today launched the long awaited "Notes" feature for Viewers. You can now add your notes to any of your favourite Escorts from within your Account. Simply log on, go to your Favourites and select the "Notes" feature on the Escort's Profile.</p>
                        <p class="c-red"><b>Note</b>: Advertisers can not see your notes.</p>
                    </div>
                    <div>
                        <p><strong>Users - My Playbox</strong></p>
                        <p>We are excited to announce that My Playbox is now live on the Website. Escorts can now upload their content and earn additional revenue.</p>
                        <p class="c-red"><b>Note</b>: Viewers can see an Escorts Playbox by simply clicking the 'My Playbox' icon located on each Profile.</p>
                        <p class=""><b>Published</b>: 26th January 2024.</p>
                    </div>
                    
                    
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

            <div class="set">
                <a>Changes to this Policy

                <i class="fa fa-angle-down"></i>
                </a>
                
                <div class="content ">
                        <div class="accodien_manage_padding_content">
                            <div class="border_top_one_px padding_ten_px_top_btm">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cms-accordion-content-area">
                                            <!-- level 1 list -->
                                            <p>
                                                We may change or modify these Terms and Conditions in the future. We
                                                will note the date that revisions were last made at the bottom of this
                                                page. Any revision will take effect upon its posting. It is your
                                                responsibility to check the <a href="{{ url('terms-conditions')}}">Terms
                                                    and Conditions</a> from time to time to review the most current
                                                version.
                                            </p>
                                            <p>
                                                Escorts4U archives all previous versions of the Terms and Conditions
                                            </p>
                                            <p><b>This policy was last updated 03-06-2025</b></p>
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