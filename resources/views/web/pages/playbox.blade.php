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
    <h1 class="home_heading_first margin_btm_twenty_px page-title">My Playbox</h1>
    <h5 class="primery_color normal_heading">A unique service for Escorts!</h5>
    <p>Unlike other social platforms, My Playbox has an established fan base for Escorts to
        create their content for. When an Escort posts any content, every Viewer to the Website
        is made aware of the content which they can see and interact with. The Viewer can
        message the Escort, if you are registered and logged on, which are nearly always opened
        and responded to. The service continues to grow as more and more Escorts take up the
        Website as their preferred platform for advertising.
            </p>
            <p>Finally, an advertising platform which brings together all the services to the one website.</p>
 
            <h5 class="primery_color normal_heading">What is this all about?</h5>
            <p>
                My Playbox is an exciting new service designed for Escorts and Viewers to interact and to
        get to know each other better. It is a social platform within the E4U Website that
        revolutionises how Escorts and Viewers connect. All Escorts who are registered with us
        can use the service. It allows them to monetize their content while developing a genuine
        connection with the Viewer.
            </p>
            <h5 class="primery_color normal_heading">How does it work?</h5>
            <p>If an Escort has uploaded content to their Playbox, the My Playbox icon appears on any
        Profile they publish. The Viewer simply clicks the icon which will take them to the Escorts
        Playbox page. This is particularly helpful for Viewers to get to see an Escort who they are
        considering meeting with.</p>
            <h5 class="primery_color normal_heading">What do I have to do as an Escort?</h5>
            <p>All you have to do is register with Escorts4U and then set up your content and pricing
        schedule within your Dashboard. It is very quick and easy to do. Once you have
        completed that, the E4U My Playbox icon will appear on any Profile you publish where
        Viewers can click to go to your content. A Viewer can only access your Playbox from a
        published Profile.</p>
            <h5 class="primery_color normal_heading">What do I have to do as a Viewer?</h5>
            <p>To view an Escort's Playbox, nothing. You can view any Escort's Playbox by clicking the
        My Playbox icon that appears on their Profile.</p>
            <p>If you want to communicate with the Escort, then you will need to <a class="termsandconditions_text_color" href="{{ route('register') }}" class="e4ulinks">register</a> with Escorts4U
        and each time you visit us, login. Once you have logged in, you will not only see the My
        Playbox icon on any Escort’s Profile who has a Playbox, but you will also be able to
        message the Escort (provided you have the Messaging Service enabled in your settings).</p>
            <p>You can view the content on an pay-per-play basis or subscribe to the Escort’s Playbox. What
        a great way to see the Escort before you hook up with them!</p>
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