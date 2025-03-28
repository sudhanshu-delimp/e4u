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










<section class="padding_top_eight_px padding_bottom_eight_px footer-links-si">
   <div class="container">
      <h1 class="home_heading_first">Law Enforcement & Trafficking Policy</h1>
      <h2 class="primery_color normal_heading">Subpoenas and User records</h2>
      <p>As a provider of online services, E4U maintains certain information concerning User
activities on this Website (<b>User Information</b>). Pursuant to our <a href="{{ url('privacy-policy')}}" class="termsandconditions_text_color">Privacy policy</a> , we keep User Information confidential to the extent that it identifies a particular individual, except under certain instances described more fully in our Privacy policy.</p>


<p>One such instance is where Escorts4U is served with either a subpoena, witness
summons, court order, or other legal process that compels for the disclosure of User
Information (<b>Valid Request</b>). Where Escorts4U receives a Valid Request, it will comply by
disclosing the requested information. Escorts4U reserves the right to cooperate with a law
enforcement agency or Court (<b>Authorised Body</b>) and to provide copies of any and all
information requested pursuant to the Valid Request relating to User Information provided
we are able to and the information requested is able to be disclosed lawfully.</p>

<p>If you are a member of an Authorised Body or an attorney seeking information relevant to
a pending litigation, please feel free to email your request setting out your reasons or the
Valid Request, as the case may be, using the following contact information:</p>
<p class="mb-0">Cornitatus Pty Ltd</p>
<p class="mb-0">GPO Box T1756</p>
<p class="mb-0">Perth WA 6101</p>
<p>E: <a href="mailto:" style="color:#FF3C5F;font-size: 16px;">privacy@escorts4u.com.au</a></p>

      <h2 class="primery_color normal_heading">Anti-Human Trafficking</h2>
      <p class="text_decoration_for_a">Escorts4U is committed to addressing the issues associated with and the fight against
human trafficking and will co-operate with law enforcement authorities and agencies in any
investigation of suspected abuse of human rights and trafficking (see also <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and
Conditions</a>).</p>
<p>There are some salient points which will assist you in recognising trafficking, namely:</p>
<ol>
   <li><p class="mb-0">The Advertiser or Masseur may be accompanied by or contacted through another
individual.</p></li>
   <li><p class="mb-0">An individual other than the Advertiser speaks for or appears to maintain control over
the Advertiser, and the Advertiser expresses fear of that individual.</p></li>

</ol>
<p>Where this occurs, look for the following warning signs, and contact the appropriate
authorities where it is necessary. The Advertiser:
</p>

<ul>
      <li><p class="mb-0">has difficulty communicating, whether resulting from a language barrier or fear of
interaction</p></li>
   <li><p class="mb-0">is hesitant to undertake an 'Out Call'</p></li>
   <li><p class="mb-0">may ask you to make payment to another person</p></li>
   <li><p class="mb-0">looks very young, possibly a minor</p></li>
</ul>

<p>Don't hesitate to report trafficking & exploitation. Please report any suspected sexual
exploitation of minors or human trafficking to the Australian government. In case of an
emergency (Australia), call 000.</p>

<div class="container mt-4 px-0 chagneto-policy">
         <h2 class="primery_color normal_heading">Changes to this Policy</h2>
         <p>We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" style="color:#FF3C5F">Terms and Conditions</a> and this Policy from time to time to
                   review the most current version.</p>
           <p>Escorts4U archives all previous versions of this Policy.</p>
           <p><b>This policy was last updated 01-12-18</b></p>
     </div>

<!-- <h2 class="primery_color normal_heading">Changes to this Policy</h2>
      <p class="text_decoration_for_a">We may change or modify this Policy in the future. We will note the date that revisions were last made at the bottom of this page. Any
         revision will take effect upon its posting. It is your responsibility to check the <a href="{{ url('terms-conditions')}}" class="termsandconditions_text_color">Terms and Conditions</a> and this Policy from time to time to
         review the most current version.
      </p>
      <p>Escorts4U archives all previous versions of this Policy.</p>
      <p><b>This policy was last updated 01-12-18</b></p> -->
   </div>
</section>




























<!-- <section class="padding_one_thiry_top padding_bottom_eight_px">

    <div class="container">
 
       <h4>Law Enforcement & Trafficking Policy</h4>
       
 
 
       <div class="accordion-container">
          
          <div class="set">
             <a>
            Subpoenas and User records
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>As a provider of online services, E4U maintains certain information concerning User
activities on this Website (User Information). Pursuant to our <span class="termsandconditions_text_color"><a href="#" class="termsandconditions_text_color">Privacy</a></span> policy, we keep
User Information confidential to the extent that it identifies a particular individual, except
under certain instances described more fully in our Privacy policy.</p>
<span class="custome_span_color">One such instance is where Escorts4U is served with either a subpoena, witness
summons, court order, or other legal process that compels for the disclosure of User
Information (Valid Request). Where Escorts4U receives a Valid Request, it will comply by
disclosing the requested information. Escorts4U reserves the right to cooperate with a law
enforcement agency or Court (Authorised Body) and to provide copies of any and all
information requested pursuant to the Valid Request relating to User Information provided
we are able to and the information requested is able to be disclosed lawfully.</span>
<span class="custome_span_color">If you are a member of an Authorised Body or an attorney seeking information relevant to
a pending litigation, please feel free to email your request setting out your reasons or the
Valid Request, as the case may be, using the following contact information:
</span><br>
<span class="custome_span_color">Cornitatus Pty Ltd<br>
GPO Box T1756<br>
Perth WA 6101</span><br>
<span class="custome_span_color">E: <a href="mailto:privacy@escorts4u.com.au">privacy@escorts4u.com.au</a></span>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
           Anti-Human Trafficking

             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Escorts4U is committed to addressing the issues associated with and the fight against
human trafficking and will co-operate with law enforcement authorities and agencies in any
investigation of suspected abuse of human rights and trafficking (see also <span class="text_decoration_for_a"><a href="#" class="termsandconditions_text_color">Terms and
Conditions</a></span>).</p>
<span class="custome_span_color">There are some salient points which will assist you in recognising trafficking, namely:
</span>
<ol class="font_size_forteenpx" style="color:#686a6c;">
    <li>The Advertiser or Masseuse may be accompanied by or contacted through another
individual.
</li>
    <li>An individual other than the Advertiser speaks for or appears to maintain control over
the Advertiser, and the Advertiser expresses fear of that individual.
</li>
</ol>
<span class="custome_span_color">Where this occurs, look for the following warning signs, and contact the appropriate
authorities where it is necessary. The Advertiser:</span>
<ul class="font_size_forteenpx" style="color:#686a6c;">
    <li>has difficulty communicating, whether resulting from a language barrier or fear of
interaction
</li>
    <li>is hesitant to undertake an 'Out Call'</li>
    <li>may ask you to make payment to another person</li>
    <li>looks very young, possibly a minor</li>
    
</ul>
<span class="custome_span_color">Don't hesitate to report trafficking & exploitation. Please report any suspected sexual
exploitation of minors or human trafficking to the Australian government. In case of an
emergency (Australia), call 000.</span>
                </div>
             </div>
          </div>
            <div class="set">
             <a>
             Changes to this Policy
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p class="custome_span_color">We may change or modify this Policy in the future.We will note the date that revisions were last made atthe bottom of this page.Any revision will take effect upon its posting.It is your responsibility to check the <a class="termsandconditions_text_color" href="#" style="font-size: 14px;">Terms and Conditions</a> and this Policy from time to time to review the most current version.</p>
                </div>
             </div>
          </div>
       </div>
    </div>
</section> -->
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