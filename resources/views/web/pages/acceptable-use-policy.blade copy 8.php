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
<section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
       <h4 class="termsandconditions_text_color">ALERT:</h4>
       <ol>
         <li>Victorian Advertisers require a SWA exception number or license number, like for example, SWA20188XE. The license number will be displayed on any Profile you publish.</li>
         <li>Massage Centres in Queensland must have their business telephone number registered with the Prostitution Licensing Authority (Queensland) and display the number on any Profile it publishes.</li>
       </ol>
 
 
       <div class="accordion-container">
          <div class="set">
             <a>
             Password Requirements 
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <div class="border_top_one_px padding_ten_px_top_btm">
                   <div class="row">
                      <div class="col-lg-3 col-md-4 col-12">
                         <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0">
                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1 lowercase character</li>
                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1 number</li>
                         </ul>                        
                      </div>
                      <div class="col-lg-3 col-md-4 col-12">
                         <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx mb-0">
                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1 uppercase character</li>
                            <li><span class="correct_symbole_font_weight">&#10003;</span> At least 1 special character</li>
                           
                         </ul>
                      </div>
                      <div class="col-lg-3 col-md-4 col-12">
                         <ul class="padding_zero_px_ul_ol list_style_none font_size_forteenpx">
                            <li><span class="correct_symbole_font_weight">&#10003;</span> 8 characters minimum</li>
                             <li><span class="correct_symbole_font_weight">&#10003;</span> 50 characters maximum</li>
                         </ul>
                      </div>
                   </div>
                </div>
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
                   <p>Create a Profile with a few simple steps. Our Profile creator will calculate the Fee along the way. You will always know what the Fees are before you commit to posting your Profile. You can also create a Profile and archive it until you are ready to post it. Create as many Profiles as you like.</p>
                   <span class="text_decoration_for_a custome_span_color">Go to <a href="#" class="termsandconditions_text_color">help for Advertisers</a> for details on Membership Packages associated with each Membership Type.</span>
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
                   <p>Escorts4U has partnered with a leading provider of online booking services for accommodation and travel. For more information go to <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Help for Advertisers</a></span> and select "Travel & accommodation".</p>
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
                   <p>Escorts4U has partnered with the Condom Man where you can order products online and they will be delivered to your door. For more information about ordering <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">products</a></span> go to Products. (This service is only available to Perth Escorts).</p>
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
                   <p>Escorts4U has partnered with an experienced advisor in this complex area. For more information about these services go to <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Help for Advertisers</a></span> and select "Visa applications & banking". Our partner can also provide advice on education placements. You can submit an enquiry with our partner.</p>
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
                   <p>We have many sources you can access for help and information. See <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">help for Advertisers</a></span> and <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">FAQs</a></span>, or if you still can not find the answer, <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">contact us</a></span> directly.</p>
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