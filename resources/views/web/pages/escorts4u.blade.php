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
    <h1 class="home_heading_first margin_btm_twenty_px page-title">What Escorts4U is About</h1>

    <h2 class="primery_color normal_heading">What is this Website for?</h2>
    <p>
        We set out to bring Advertisers of escort and massage centre services and Viewers
        together through a simple but convenient platform. Advertisers set out a detailed
        informative Profile where they propose their services and companionship where Viewers
        can then make contact directly. We do not act as an intermediary, and nor do we play any
        role in, or receive any payment from, any transaction which may result from a mutual
        meeting.
    </p>
    <h2 class="primery_color normal_heading">What we do and don't do</h2>
    <p>We do not:</p>
    <ul>
        <li>Post advertisements which are not created and paid for by the Advertiser</li>
        <li>Create ghost Profiles (fake advertisements created by the service provider)</li>
        <li>Allow an expired Profile to remain posted on the Website</li>
        <li>Allow fake Profiles and Media to be published </li>
        <li>Provide fake statistics and analytics to the Advertiser</li>
        <li>Operate cookies, bots or spyware to crawl all over you</li>
    </ul>

    <p>We do:</p>
    <ul>
       <li>Provide an open, transparent and professional Website</li>
       <li>Remove the Profile or Tour when it expires</li>
       <li>Offer a range of features not available on other websites (like our Concierge Services and My Playbox)</li>
       <li>Make ourselves available to you to address your issues and concerns</li>
       <li>Have Agents available to Advertisers to assist them with the management of their Account, Profiles and Tours</li>
       <li>To the best of our ability, provide you with as much anonymity as possible</li>
    </ul>

    <h2 class="primery_color normal_heading">A modern approach</h2>
    <p>
        Escorts4U is a modern concept designed to bring Advertisers and Viewers together
        through an innovative, but stylish adult directory, exclusively designed for independent
        Escorts and Massage Centres, with absolutely no banner advertising, social marketing or
        spam. The Website deploys modern concepts to present information in a friendly and
        concise manner. Not forgetting the Viewers, they can also register to receive benefits
        including the ability to write a review about their experience. Membership is absolutely
        free to everyone. Advertisers only pay for the Services they use.
    </p>
    <h2 class="primery_color normal_heading">A one stop Profile</h2>
    <p>
        The Website is designed having in mind what the Viewer ideally wants to know about the
        Advertiser, whilst at the same time remembering what the Advertiser wants to convey to
        Viewers about themselves their services and companionship.
    </p>
    <p>
        When viewing a Profile, you will have time to enjoy each of them, by flagging those which
        get your attention, or going one step further by adding the Advertiser to your Legbox and then reviewing your Legbox (favourites) at any time (after
        registration). A Viewer can also shortlist and then view the shortlist of Advertisers from the
        Advertiser Home Page. There is a lot of information about the Advertiser for you to make
        an informed decision. Profiles are presented in a professional manner so as to let your
        imagination take you there, including video, where the Advertiser has provided one.
    </p>
    <p>
        All of our Advertisers are independent, except where they engage an Agent to assist
        them with posting their Profiles and Tours. It is just you and your chosen companion.                
    </p>
    <p>
        Privacy is very important to everyone. There are a range of options available to both the
        Advertiser and Viewer to make contact with each other very easy, including Alerts. We
        have applied a one stop shop approach for Advertisers.
    </p>
    <p>
        Not only do Advertisers have a convenient and powerful Website to advertise, we also
        bring to the Website other important services to assist Advertisers. We have partnered
        with quality service providers to bring:
    </p>
    <ul>
        <li>Accommodation and travel services - book online with us</li>
        <li>Products - order your products online and have them delivered to your door</li>
        <li>Telecommunications services - Mobile SIM and email accounts. Easy to set up, no need to go through all the rigorous processes at your local telco shop </li>
        <li>Visa & Migration advice. Professional advice for all of your visa and migration
            requirements, including education placement and management services and advice</li>
    </ul>
    <p>
        Escorts4U set out to create a business model that focuses on what the needs of an Escort
        and Massage Centre are, having regard to their everyday requirements. Advertisers can,
        through the Website, organise all of their needs to undertake their companionship. There
        is no need to remember website addresses and passwords across a range of websites, it
        is all here in the one place: advertise, book your travel and accommodation, order your
        SIM and email account (if required), have product delivered to you and if you need any
        visa or migration advice, just ask.                
    </p>
    <p>And of course there is the My Playbox service. A unique service that permits Escorts to
upload Content for Users to view either as a pay-per-view or by subscription.
    </p>
    <h2 class="primery_color normal_heading">Your experience</h2>
    <p>
        Advertisers are focused in providing you with a memorable experience. There are not too
        many occasions in life more exhilarating than the intimacy of a new partner for the first
        time.
    </p>
    <p>
        Think about the excitement of meeting, the emotion between each of you, and the
        pleasure that follows. If your experience was a wonderful one, please write a review about
        your experience (registration required).
    </p>
    <div class="container mt-4 px-0 chagneto-policy">
        <hr style="border: none; border-top: 1px solid #ccc; margin-top: 40px; margin-bottom: 20px;">
        <h2 class="primery_color normal_heading">Changes to this Guide</h2>
        <p><b>This Guide was last updated on 19-05-2025</b></p>
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