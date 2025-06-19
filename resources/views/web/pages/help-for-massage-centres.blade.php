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
 
       
       <h1 class="home_heading_first margin_btm_twenty_px">Help for Massage Centres aa</h1>
          <div class="accordion-container">
               <div class="set">
                  <a>
                    Massage Centre Profiles
                  <i class="fa fa-angle-down"></i>
                  </a>
                  <div class="content">
                     <div class="accodien_manage_padding_content">
                        <div class="border_top_one_px padding_ten_px_top_btm">
                        <div class="row">
                           <div class="col-sm-12">
                               <p class="pt-2"><b>Q: What is a Massage Centre Profile?</b></p>
                                <p class="pbot">A uniquely designed Profile designed entirely for Massage Centres (a world first)
                                    where they can capture all of their Masseurs in the one Massage Centre Profile. Up to
                                    eight Masseur Profiles within the Massage Centre Profile, you only pay the one set
                                    Fee.</p>
                                <p>
                                The Profile focuses on two factors:
                                </p>
                                <ol>
                                 <li> Important information about the Massage Centre, like the business address
                                    (including a Google map), whether showers are available and front and rear entry
                                    and much more.</li>
                                 <li> A summary, including up to three photos, of the Masseur. The summary of the
                                    Masseur includes name, age, nationality, available days and service type and much
                                    more.
                                    </li>
                                </ol>
                              <p>The Massage Centre Profile is the perfect solution for Massage Centres. No need to
                                create many profiles across the one platform, its all correlated within the one Profile
                                and for the one small Fee, delivering substantial savings to the Massage Centre.</p>
                           </div>
                           <div class="col-sm-12">
                            <p class="pt-2"><b>Q: How do I make a great Profile?</b></p>
                             <p class="pbot">If you provide a complete Profile with accurate information, you will increase the
                                number and quality of results you get from it. We have a very comprehensive Profile
                                creator which will help you create a great Profile, including the masseur profiles. Much
                                of the creator is simply tick the box or select from a drop down menu. The Profile
                                creator also pre-loads all of your Profile Information, including Masseurs, which makes
                                it very quick and easy to create a Profile. Spend the time to complete your Profile
                                Information for the Massage centre as well as for each of your Masseurs, you will find
                                the time is well spent. Here are some good tips for you:
                                </p>
                                <ul>
                                    <li>Put a lovely landscape photo up of your Massage Centre for your Banner Image,
                                        like a photo of the premises from the front, or the reception inside</li>
                                    <li>Put real photos up of the Masseurs, up to three for each Masseur. You can also
                                        pload up to 6 photos plus your Thumbnail of your premises. They could be of the
                                        massage rooms, shower facilities and your reception. Make sure you have had
                                        your Masseur photos verified to save time when you post your Profile
                                    </li>
                                    <li>
                                        Take time to provide a good description of your business and the services you offer You can set your services in your Profile Information and Account settings
                                    </li>
                                    <li>
                                        List only the services you provide. The Profile creator has a comprehension
                                        selection of services where you can easily select from your drop down list
                                    </li>
                                    <li>
                                        Make sure your phone number and email address, if you are enabling email, is correct 
                                    </li>
                                    <li>
                                        If you have a video to upload, make sure it is not too long and that the recording is of good quality.
                                    </li>
                                    <li>
                                        Include your social media links if you have any
                                    </li>
                                </ul>
                                <p>
                                    Please do not:
                                </p>
                                <ul>
                                    <li>Post fake listings or fake photos, it will eventually come to our attention and the
                                        Profile will be either suspended or removed</li>
                                    <li>Use ALL CAPS, it looks CHEAP. Clients do not like you yelling at them</li>
                                    <li>Use foul or unacceptable language</li>
                                    <li>Attempt to deceive Viewers. You will get caught out and that may have an effect on
                                        your reputation if a review is posted
                                    </li>
                                    <li>Enable Service Tags for services that you do not provide. Only select Service Tags
                                        for services that you actually provide. Viewers might form a negative view of you
                                        and reflect that view in a Review</li>
                                </ul>
                        </div>
                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: Can I have more than one Profile?</b></p>
                             <p class="pbot">No. As a Massage Centre, which has a Profile which enables up to eight Masseur
                                Profiles, there is no need to have multiple Profiles across the Website.
                                </p>
                                <p> Our Profile creator is very detailed, you will be very satisfied with how we present your
                                    Profile.</p>
                               
                               <p>You can archive your Profile in the Archive Folder so that you do not have to edit or
                                recreate the one Profile across a number of publications. Just switch on and switch off
                                the Profile on a needs basis, or enable auto renew. It is really easy to manage your
                                Profile and post it, especially for the Masseur Profiles.
                                </p>
                        </div>
                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: Can I make Profiles for different Masseurs?</b></p>
                          <p class="pbot">
                            No need to. The Massage Profile has up the eight Masseur Profiles within a Massage
                            Centre Profile. Each Masseur Profile is very detailed and will solve all of your
                            advertising problems experienced with other platforms.
                          </p>
                          <p>
                            As a Massage Centre, you only need to create one Profile, which allows you to post up
                            to 8 Masseur Profiles.                                
                          </p>
                        </div>
                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: How are Profiles ordered?</b></p>
                             <p class="pbot">Profiles within the Massage Centre Home Page are randomised every 2 hours. The
                                search bar in the Website is very powerful and enables Viewers to search Advertisers
                                by: </p>
                                <ul>
                                    <li> State / Capital City</li>
                                    <li>Gender</li>
                                    <li> Rate</li>
                                    <li>Service type, such as Massage, Incall or Outcall; and</li>
                                    <li> Verified Photos</li>
                                </ul>
                             <p>
                                The search bar also has an advanced feature whereby Viewers can also search by
                                Service Tag for:
                             </p>
                             <ul>
                                 <li> Suburb location</li>
                                 <li>Massage services available</li>
                                 <li>Other service types</li>
                             </ul>
                             <p>It is very important that you set your Profile Information for Service Tags accurately so
                                that a Viewer can undertake a search with confidence.</p>
                            <p>
                                By completing your Profile creator and answering all the questions, you enhance your
                                chances of being found with the search bar. We do this to provide the best possible
                                experience for Advertisers and Viewers ensuring that all Advertisers can be found
                                when the Viewer uses the search bar. 
                            </p>
                        </div>

                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: Is fake Media OK?</b></p>
                             <p class="pbot">
                                If you post any fake Media, your Account will be suspended. If we determine that you
                                have other Accounts, they will also be suspended regardless of whether they are
                                genuine or not. There are no excuses and we will not enter into any discussion with
                                you. Posting fake Media is fraud and a breach of intellectual property rights of the
                                owner of the fake media. If you have paid for Profiles and you are Suspended the
                                Credits are not refundable.
                             </p>
                             <p>
                                You will have an opportunity to edit the suspended Profile to remove the fake Media 
                             </p>
                        </div>

                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: Why are my photos marked as fake?</b></p>
                            <p class="pbot">
                                This is the most common complaint from other Advertisers and Viewers about Profiles
                                - fake Media. Further, fake Media is not fair and does not provide for a level playing
                                field for all the Advertisers. Your Media may be marked as fake because of a report
                                from an Advertiser or Viewer. You will receive a warning email from us giving you 48
                                hours to have your Media verified before your Profile is returned to active.
                            </p>
                        </div>

                        <div class="col-sm-12">
                            <p class="pt-2"><b>Q: What is not OK? </b></p>
                            <p class="pbot">
                                If you are an Advertiser and do not follow the Policies, your Account, including any
                                future accounts, will be blocked.
                            </p>
                            <p>
                                It is not acceptable for:
                            </p>
                            <ul>
                                <li>Underage photos or photos of children to appear in any Profile</li>
                                <li>Trafficking, enslavement or anything similar to be promoted</li>
                                <li>Abuse, violence or oppressive behaviour to be directed towards other Advertisers or Viewers</li>
                                <li> Online trolling or other defamation to be directed towards other Advertisers or Viewers</li>
                            </ul>
                            
                        </div>

                        </div>
                     </div>
                  </div>
                  </div>
               </div>

               <!-- Memberships -->

               <div class="set">
                <a>
                 Memberships
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                   <div class="accodien_manage_padding_content">
                      <div class="border_top_one_px padding_ten_px_top_btm">
                      <div class="row">
                         <div class="col-sm-12">
                             <p class="pt-2"><b>Q: What is Membership?</b></p>
                              <p class="pbot">
                                To advertise on Escorts4U we require you to sign up for Membership. It is free, you
                                only pay for Massage Centre Profiles that you post on the Website. Create and refine
                                your Massage Centre Profile and once you are ready to publish, simply go to the
                                Profile creator and in a matter of minutes your Massage Centre Profile is published.
                              </p>
                              <p>
                                Viewers will have full access to your Massage Centre Profile including unrestricted
                                communication rights should you have texting and email services enabled.
                              </p>
                              <p>
                                Your membership includes the posting of up to eight Masseur Profiles within your
                                Massage Centre Profile. The Masseur Profiles are very detailed.
                              </p>
                         </div>

                         <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Are there any great features available to us as Massage Centre?</b></p>
                          <p class="pbot">
                            Yes. We have a number of great features to enhance your Profile and relationship
                            building with Viewers. You can:
                          </p>

                          <ul>
                              <li>Post your Massage Centre logo in the Thumbnail of your Profile</li>
                              <li>Create up to 8 Masseur Profiles within your Profile</li>
                              <li>At your option, each Massage Centre Profile has:
                                  <ul>
                                      <li>A Banner Image</li>
                                      <li>Up to 6 photos plus your Thumbnail</li>
                                      <li>A comprehensive summary of the Masseur, including their name, age, mobile number and much more</li>
                                      <li>The ability to be flagged as a favourite by a Viewer</li>
                                  </ul>
                              </li>
                              <li>Archive your Massage Centre Profile and Media, ready to be activated at any time. 
                                You can also archive all of your Masseurs Profile Information ready to be added to
                                your Massage Centre Profile when the Masseur commences employment at your
                                business.</li>
                                <li> Much more ...</li>
                          </ul>
                      </div>
                      
                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Are there any loyalty programs?</b></p>
                           <p class="pbot">
                            Absolutely. Escorts4U will reward you for your loyalty. A simple program, for every
                            $500.00 in advertising a Massage Centre spends with us, we will reward you with 1
                            day of free advertising. You can use your rewards any time you like, or accumulate
                            your rewards and use them all at once, it is entirely up to you.
                           </p>
                           <p>
                            Discounts to advertising Fees also apply once you spend over a certain amount. The
                            discounts are very generous.
                           </p>
                      </div>

                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Can I get help to manage my Account?</b></p>
                        <p class="pbot">
                            Yes you can. Our support team will help you manage your Account or alternatively,
                            you can reach out to an Agent. An Agent will assist you with:                            
                        </p>
                        <ul>
                            <li>Managing your Account details and Profile Information</li>
                            <li>Managing your Media (photo images and video)</li>
                            <li>Creating your Profile and Masseur Profiles</li>
                            <li>Any of the Concierge Services; and</li>
                            <li>Generally, be there for you</li>
                        </ul>
                        <p>You can appoint an Agent at any time by either:</p>
                        <ul>
                            <li>Nominating the Agent as a part of the registration process; or by</li>
                            <li>Requesting an Agent to be appointed by lodging a request through your Dashboard.</li>
                        </ul>
                        <p>
                            When you appoint an Agent, you enter into an arrangement with the Agent directly for
                            the Agent to provide the Agent Services. The Agent will have full access to your
                            Account.  
                        </p>
                         
                      </div>
                      

                      </div>
                   </div>
                </div>
                </div>
             </div>

                  <!-- Payments -->
             <div class="set">
                <a>
                  Payments
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                   <div class="accodien_manage_padding_content">
                      <div class="border_top_one_px padding_ten_px_top_btm">
                      <div class="row">
                         <div class="col-sm-12">
                             <p class="pt-2"><b>Q: How do I pay for advertising?  </b></p>
                             <p class="pbot">
                                Payment, by Card, is requested when you post a Profile or take up any of the
                                Concierge Services. If you renew your Profile, your Card will be debited automatically.
                             </p>
                         </div>

                         <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Does Escorts4U retain my Card details?</b></p>
                          <p class="pbot">
                            Our secure, third-party payments provider retains your details. Escorts4U does not
                            directly retain your Card details.                            
                          </p>
                      </div>
                      
                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Can I transfer Credits I have earn't from my Loyalty program?</b></p>
                           <p class="pbot">
                            Yes, when you create a Profile, any Credits you have will be displayed and you will have the option to utilise them.
                           </p>
                      </div>

                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: What is the easiest way to pay? </b></p>
                        <p class="pbot">
                            There are effectively three payment options, all with your Card, namely:
                        </p>
                        <ul>
                            <li>Pay as you go. If you post a Profile for 3 days, you can pay for 3 days.</li>
                           
                            <li>Pay in advance. You can pay a lump sum into your Account and then draw down
                                on those funds as you post and renew your Profile.</li>
                            <li>Pay and renew. You pay for the number of days you have selected for your Profile,
                                and elect to automatically renew your Profile each nominated period thereafter (like
                                every 5 days) and for the nominated occurrences (like for 3 renewals).</li>
                        </ul>
                       <p>
                        All transactions are completed using SMS 2FA and are confirmed by email notification to you. You can also view all of your purchase history from your Dashboard.
                       </p>
                      </div>

                      <div class="col-sm-12">
                        <p class="pt-2"><b>Q: How do you set prices? </b></p>
                      <p class="pbot">
                        Our main objective is to provide value-for-money in an effective way. Our pricing is
                        defined on a daily per Location basis with discounts applying for longer booking
                        periods (22 days or more). We only raise prices (and not often) when the number of
                        enquiries and Advertisers goes over a certain level. This is to maintain the number of
                        Massage Centre advertisements at a level where each Profile will continue to receive
                        the number of enquiries the Member expects from us.
                      </p>
                      <p>
                        Remember always, every Massage Profile is randomly rotated every 2 hours.
                      </p>
                       
                    </div>
                       

                      </div>
                   </div>
                </div>
                </div>
             </div>

             <!-- Profile Images and Video -->
             <div class="set">
                <a>
                    Profile Images and Video
                <i class="fa fa-angle-down"></i>
                </a>
                <div class="content">
                   <div class="accodien_manage_padding_content">
                      <div class="border_top_one_px padding_ten_px_top_btm">
                      <div class="row">
                         <div class="col-sm-12">
                             <p class="pt-2"><b>Q: Can I use fake images if they look very similar to me? </b></p>
                             <p class="pbot">
                                Absolutely not. We have a strict policy that all images must belong to the Masseur,
                                and be of themselves. This is mandatory and there is no negotiation on this policy.         
                             </p>
                         </div>

                         <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Is it a requirement to have Media verified?</b></p>
                          <p class="pbot">
                            Image verification is not a requirement, it is optional. However, we highly recommend
                            you have your images verified by us so that you can better establish client trust. You
                            should remember that the biggest complaint from Viewers is fake Media and Profiles. 
                            If a report is made our support staff will investigate and if the Profile is found to have
                            fake Media then the Profile will be Suspended.                            
                          </p>
                      </div>
                      
                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: How do I get my photos verified?</b></p>
                           <p class="pbot">
                            We have our own image verification process. Please <a href="email:privacy@escorts4u.com.au" style="color:#FF3C5F">email us</a> for more information.
                           </p>
                           <p>
                            If you pass our image verification criteria, we will mark your Media with the prestigious
                            E4U Verification Icon, which essentially verifies your Media as being genuine.                            
                           </p>
                      </div>

                      <div class="col-sm-12">
                          <p class="pt-2"><b>Q: Will any images of me be blurred?</b></p>
                        <p class="pbot">
                            We offer a blurring service for a small Fee. You can have up to a maximum of twenty four photo images per month blurred (collectively 3 photo images for eight Masseurs).
                        </p>
                       <p>
                        Facial blurring is always styled with a light blurring effect. The blurring service does
                        not include the removal of large tattoos or alterations to a Masseur’s appearance.
                       </p>
                       <p>
                        All images for blurring must be submitted at the same time and be verified.
                       </p>
                      </div>

                      <div class="col-sm-12">
                        <p class="pt-2"><b>Q: What are the photograph image requirements to advertise?</b></p>
                      <p class="pbot">
                        We have a strict policy on what images you can publish. Your images must:
                      </p>
                      <ul>
                          <li> Be good quality and high resolution </li>
                          <li>Be your own (of your premises). People in any image of your premises is
                            acceptable provided you have their consent</li>
                        <li>Be of the Masseurs</li>
                        <li>Have no large or distracting watermarks (we will watermark your photos for you)</li>
                        <li>Have no photographer's watermarks (they will be removed, or we will request new
                            images without the watermark)
                            </li>
                        <li>
                            Be professional in quality. They do not need to be taken by a professional
                            photographer, but must have a good quality finish                            
                        </li>
                      </ul>
                      <p>
                        You can publish a montage photo image, like for example for your Thumbnail,
                        provided that each of the images contained in the montage are compliant with our
                        policy.
                      </p>
                      <p>
                        We will not publish any images which:
                      </p>
                      <ul>
                          <li>Are low quality (too small, dark, grainy or blurry)</li>
                          <li>We find on non adult services websites, or any photo where we have doubt about the ownership of the image</li>
                          <li>Overly explicit, and most likely do not comply with the <a href="{{ url('faqs')}}" style="color:#FF3C5F">Local Laws</a> or the Classification Laws</li>
                        <li>Have borders or frames that have been added with a photo program (please upload your original images without borders)</li>
                        <li>Have watermarks that have been placed by the photographer to advertise their business</li>
                        <li>Have watermarks of another advertising platform</li>
                        <li>Have your contact details on them, such as email, telephone or website address. (This information is set out in your Profile)</li>
                        <li>Contain magazine covers, publications or video/DVD covers</li>
                      </ul>

                    </div>
                       
                    <div class="col-sm-12">
                        <p class="pt-2"><b>Q: What are the video requirements for inclusion in my Profile?</b></p>
                         <p class="pbot">
                            We have a strict policy on the content of your video you can publish. Your video must:
                         </p>
                         <ul>
                             <li>Be no longer than 30 seconds</li>
                             <li>Be in either mp4 or wav format. You can not provide a link to your video</li>
                             <li>Not contain any sexually explicit content, only contain content of your premises</li>
                             <li>Not contain any of your contact details, such as email, telephone or website address. This information is set out in your Profile</li>
                         </ul>
                         <p>
                            We recommend your videos are brief and highlight the features of your premises.                           
                         </p>
                          
                    </div>
                      </div>
                   </div>
                </div>
                </div>
             </div>

                <!--  Profile Reporting -->
                <div class="set">
                    <a>
                        Profile Reporting
                    <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="content">
                       <div class="accodien_manage_padding_content">
                          <div class="border_top_one_px padding_ten_px_top_btm">
                          <div class="row">
                             <div class="col-sm-12">
                                 <p class="pt-2"><b>Q: Can I see how much business you are generating for us? </b></p>
                                 <p class="pbot">
                                    Yes you certainly can. Logon to your Account and in the Dashboard area you can see statistics, graphs and results which detail:
                                 </p>
                                 <ul>
                                     <li>Clicks on your Profile, including Masseurs</li>
                                     <li>Clicks on your phone number</li>
                                     <li> Clicks on each of your photo images</li>
                                     <li> Views of your video</li>
                                     <li>How many times you have been short listed on the Search Page</li>
                                     <li>How many Viewers have added you to their Legbox</li>
                                     <li>The number of messages sent to you</li>
                                     <li>Clicks to your social media page/s (if you have provided a link)</li>
                                     <li>And many other helpful analytics</li>
                                 </ul>
                                 <p>
                                    If you use Google Analytics you can also find the number of website visitors by looking
                                    in Acquisition &gt; Campaigns &gt; All Campaigns. We know you will not always know about
                                    all the customers we send, but we have tried our best to give you an idea
                                 </p>
                                 <p>
                                    If you have questions about measurement, get in touch, as we greatly appreciate
                                    hearing about your results and any suggestions about how we can improve the
                                    information we present to you.        
                                 </p>
                             </div>
    
                             <div class="col-sm-12">
                              <p class="pt-2"><b>Q: Can I request a report?</b></p>
                              <p class="pbot">
                                Yes you can. Simply go to your Dashboard and select the report type you want and
                                the frequency you want the report to be sent to you.                          
                              </p>


                          </div>
                          
                          
                          </div>
                       </div>
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
                                        <div>
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