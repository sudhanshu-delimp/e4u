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
   <div class="container reg_info">
    <h1 class="home_heading_first margin_btm_twenty_px page-title">What is a Massage Centre</h1>
    <h5 class="primery_color normal_heading">What can this Website do for you?</h5>
    <p>
        We set out to bring a convenient platform for Massage Centres to consolidate their
        advertising in the one place for their Masseurs. At great expense, Massage Centres often
        post many advertisements for each of their Masseurs, often across numerous platforms. 
        A Massage Profile enables the Massage Centre to post up to 8 Masseur Profiles in the
        one Profile for the one set Fee.
    </p>

    <h5 class="primery_color normal_heading">What is in a Massage Profile?</h5>
    <p>
        A Massage Profile enables you to post a:
    </p>
    <ul>
        <li>Summary of the key points about your business including your address</li>
        <li>Description of your Massage Centre by way of commentary setting out why Viewers should visit you</li>
       <li>List of the services on offer, such as Nuru, nude and prostate massage</li>
       <li>Summary of your rates in a structured manner</li>
       <li>Summary of the Centre's open times and access </li>
       <li>Profile for each of your Masseurs, up to eight, which includes:
        <ul>
            <li>Their name</li>
            <li>Up to three photos</li>
            <li>Their available days and times</li>
            <li>The services they offer</li>
            <li>Mobile number (if applicable)</li>
            <li>And much more ...</li>
        </ul>
       </li>
    </ul>
    <h2 class="primery_color normal_heading">Registration is free</h2>

      <!-- please register link should redirect on advertiser registration form -->
    <p>
        Simply <a class="termsandconditions_text_color" href="{{ route('advertiser.register') }}" class="e4ulinks">register</a>  with Escorts4U and when you are ready to post a Massage Profile, simply
        create it from your Dashboard. We are available to help you along the way, or you can
        engage an Agent, if you need some assistance creating your Massage Profile or just
        setting up your details in your Account. Check out our <a class="termsandconditions_text_color" href="{{ url('help-for-massage-centres')}}" class="e4ulinks">Help for Massage Centres</a> 
        information summary as well. 
    </p>
    <p><b>Changes to this Guide</b></p>
            <p>This Guide was last updated on 13-07-2024.</p>
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