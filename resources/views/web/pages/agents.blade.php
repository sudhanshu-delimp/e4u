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
    <h1 class="home_heading_first margin_btm_twenty_px page-title">What is an Agent</h1>
    <h2 class="primery_color normal_heading">We are here to help Advertisers</h2>
    <p>
        Not only did Escorts4U set out to bring Advertisers of escort and massage centre services
        together with Viewers through a modern and convenient platform, we also set out to make
        that journey a simple one as far as possible for the Advertiser.
    </p>
    <p>
        The Advertiser's Dashboard offers many features for Escorts and Massage Centres to
        use, but we understand that not every Escort or Massage Centre is able to navigate
        through all the features. To assist Advertisers, Escorts4U offers Advertisers a way to get
        help by connecting them with an Agent.                
    </p>
    <h2 class="primery_color normal_heading">What is an Agent</h2>
    <p>
        An Agent is a business or person who organises an Advertiser's Profile and / or Tour on
        their behalf, and generally looks after their Account. We put Agents in contact with
        Advertisers when the Advertiser has requested help (see also <a class="termsandconditions_text_color" href="{{ url('help-for-advertisers')}}" class="e4ulinks">Help for Advertisers</a>).
    </p>
    <h2 class="primery_color normal_heading">How does an Agent get rewarded?</h2>
    <p>
        When an Agent is put in contact with an Advertiser, the two of them discuss a fee for the
        work the Agent will undertake for the Advertiser. Those arrangements are between the
        Agent and the Advertiser. We do provide Agents with guidelines on what to charge for other
        services. An Agent will also receive a percentage of the Fees paid to us by Advertisers for
        all advertising placed by the Advertiser on the Website (posting their Profile or Tour) and a
        set up payment for all Massage Centres the Agent persuades to register with us.
    </p>
    <h2 class="primery_color normal_heading">How to become an Agent</h2>

    <!-- please register link should redirect on agent registration form -->
    <p> 
        Simply <a class="termsandconditions_text_color" href="{{ route('agent.register') }}" class="e4ulinks">register</a> with us and when a request is made by an Advertiser, your details will be
        made available to them. You can also seek out Massage Centres with a view to having
        them register with Escorts4U where you will receive a payment for your services.
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