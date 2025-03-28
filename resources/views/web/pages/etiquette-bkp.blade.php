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
 
       
       <h1 class="home_heading_first margin_btm_twenty_px">Etiquette</h1>
       <div class="accordion-container">
          
          <div class="set">
             <a>
               Intimacy
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>This is the best part of any meeting with an Escort, and to a lessor extent a Masseur. It is
                     what you have been waiting for. So let them make you feel relaxed and comfortable, they
                     know how to and enjoy your time together.</p>
                   <p>But never get so carried away with sexual excitement that you overstep the boundaries.
                     Please, always respect your Escort's wishes and especially the rules put out by the
                     Massage Centre and how you spend your time with the Masseur. You need to ensure that
                     you have good communication and a clear understanding from the beginning of your time
                     together and on what services they provide.</p>
                   <p>There will be times where you just cannot get enough of your Escort, and you will want
                     them to stay longer. Even the Masseur may make you want to stay longer. If your
                     companion has no other engagements, they might be able to stay, but remember, it is at
                     their discretion as to whether they want to extend their time with you. It is expected that
                     you address any additional donation with the Escort at the beginning of any extended time.</p>

                </div>
             </div>
          </div>
          <div class="set">
             <a>
                Reviews

             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                  <p>Our Website provides an opportunity for a review to be provided about your experience
                     with an Escort or Massage Centre. When considering providing a review about your
                     experience always bear in mind what the outcome will be for the Escort and Masseur.
                     Remember, this is their job where they make their living from in what is often considered to
                     be very difficult work.</p>
                  <p>If you do not believe your experience was as you expected it to be, give some thought to
                     whether you over estimated the services, or perhaps you may have been too demanding.
                     Always remember that the Escort and Masseur clearly lay out the services offered in their
                     respective Profiles and it is up to them if they are prepared to offer any additional services
                     to you during your appointment.</p>
                  <p>But it is also important that where an Escort has lied about themselves, it is completely
                     understandable that you might provide a review about your experience for others to read.</p>
                  <p>A review is encouraged, especially when you have something nice to say about your
                     experience with the Escort or Masseur.</p>
                     <p>You have to be <a class="c-red" href="{{ url('register')}}">registered</a> as a Viewer to provide a review. Viewers simply log onto to the
                        Website and click the “Add Review” button at the bottom of the Profile Page.</p>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
               Etiquette
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>When contacting an Escort, or meeting with a Masseur, it is a good idea to provide some
                     information about you. A polite introduction is very helpful as part of getting through any
                     decent screening process from an Escort in particular.</p>
                   <p>Be polite and respectful at all times, in person, on the phone or in any emails or text
                     messages you exchange. The only exception to this would be if you have agreed in
                     advance with an Escort a scenario where you want to play a specific role.</p>
                   <p>Make sure you understand what the Escort offers and what massage service types are
                     provided by a Massage Centre. Read the Advertiser’s Profile carefully ensuring you
                     understand all the elements to the services offered. If you have any requirements which
                     are not specifically offered, they are probably not offered. In any case, you should ask in
                     advance of the appointment. If the Escort has a reference on her Profile or her Website
                     where she details any specific policies, it is important that you read them and respect
                     them. During the appointment, you do need to make sure you clearly communicate what
                     you want with the Escort, otherwise you may end up disappointed. If an Escort ignores
                     your requests, then you can probably assume the Escort does not provide those services. 
                     The same applies with a Masseur. A Masseur provides the services listed in the Massage
                     Centre Profile.
                     </p>
                   <p>Be discreet. If you are going to a private residence, ask for instructions on how to get in.
                     Do not use the Escort's name when calling an intercom, announce yourself only. In
                     hotels, do not ask concierges or other staff anything about the Escort. If there is a
                     problem or you need to ask a question, go back to your car or leave the hotel and call or
                     text. Do not call an Escort from a hotel lobby, in the street outside their apartment or any
                     other situation which might put the Escort (and your) privacy at risk.</p>
                   <p>If you have any allergies, like scents etc, make sure you tell the Escort or Massage
                     Centre. If you have an aversion to tobacco smoke or smokers you probably want to check
                     that too.</p>
                   <p>If the Escort is visiting your home or hotel room, you should ensure it is clean and tidy
                     which is a good way to start an appointment.</p>
                   <p>Do not ask about an Escort's personal life or their professional activities, if they volunteer
                     information, that is fine. Use common sense in your approach with an Escort or Masseur.
                     In the same way, change the subject if you are asked questions you are not prepared to
                     answer. It is also best to avoid discussing another Escort or Massage Centre as this type
                     of gossip can have unpleasant results</p>
                </div>
             </div>
          </div>
          <div class="set">
             <a>
               Future Contact
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>It is a nice, and a welcome gesture, for a client to send a short text or email within a couple
                     of days, thanking the Escort for a lovely time. This is generally appreciated, and further
                     builds rapport, but it must stay at that. It is important that you do not make frequent
                     contact unless making a booking. If you invite your companion out for dinner or to go out
                     socially, you are booking their time and you are expected to make a donation, unless the
                     Escort indicates otherwise. Do not presume the Escort is your friend just because they
                     are having a conversation with you.</p>
                   <p>Much the same applies to a Masseur. Do not presume they are your friend. They would
                     most likely welcome conversation of a general nature, but not conversation where you are
                     seeking to meet them outside of their time at the Massage Centre.</p>
                   <p>Yes, an Escort and Masseur most likely do enjoy your company, but please do not forget it
                     is a business arrangement. Being with an Escort is a wonderful experience, and one to be
                     savoured and enjoyed. The same applies to a Masseur, enjoy the service offering, but that
                     is where it ends. If you treat them well and with the respect they deserve, they will be
                     looking forward to seeing you again.</p>
                </div>
             </div>
          </div>
            <div class="set">
             <a>
               Donations
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>When you meet an Escort, in most cases you will be expected to provide your donation at
                     the start of the appointment. With a Massage Centre, you will always be expected to pay
                     for the nominated service before you meet with the Masseur.</p>
                   <p>It is not normal to get a request to wire or send money in advance, so be suspicious if an
                     Escort asks this of you. Where you request an "Outcall" you may be asked to contribute
                     toward the cost of the taxi. This is completely appropriate, but check first if there is an
                     additional donation that will apply. Check the Advertiser's Profile, there is usually
                     information regarding taxis and the payment of any taxi service where an Outcall has been
                     requested.</p>
                   <p>Do not try to negotiate the amount of the donation on arrival, in this case you should
                     expect to be asked to leave. Assume rates are non-negotiable unless there is good
                     reason to assume otherwise and you negotiate in advance. If you are extending your time
                     with an Escort, you can politely discuss how much more you should donate but do not
                     automatically assume you will be offered a discount.
                     </p>
                   <p>Respect the time period you have booked. Most Escorts, and especially Massage Centres,
                     do not like to have to ask you to leave and many will not 'watch the clock'. However, you
                     are "buying time" with an Escort and should not expect anything for free so respect what
                     you agreed to in advance.
                     </p>
                   <p>If you have to cancel an appointment, do so as far in advance as possible, usually by text
                     is sufficient. If you change your mind, just tell the Escort or Massage Centre, it does
                     happen and the Escort or Massage Centre will very much appreciate your honesty. Do not
                     make appointments and then not turn up as this is just rude and you may be black listed or
                     added to the NUM.</p>
                   <p>Do not make promises you are not going to keep, whether it is for a future appointment,
                     gift or review. You do not owe the Escort or Masseur anything more than the donation or
                     payment for the service and there is no need to promise anything else. Better to be
                     straightforward and honest with each other.</p>
                   <p>Escorts4U provides Advertisers with payment tools using eCommerce applications. Check
                     the Advertiser’s Profile which will indicate payment options as well as whether they will
                     accept payment using the Escorts4U payment gateway. Otherwise, all donations are by
                     cash.</p>
                   
                </div>
             </div>
          </div>
            <div class="set">
             <a>
               Common Sense - Use It!

             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Do not do stupid things or expect Escorts or especially Masseurs to do so</p>
                   <p>Always remember:</p>
                   <ul>
                      <li>If you are not sure what you are doing is right, do not do it</li>
                      <li>To treat an Escort and Masseur with respect and like fellow human beings (they are
                        and never forget that)</li>
                      <li>Make sure you know and understand the <a class="c-red" href="{{ url('law-enforcement')}}">Local Laws</a> and do not get arrested
                     </li>
                      <li>Do not take any drugs to the appointment</li>
                      <li>Do not do anything which feels uncomfortable. If you feel uncomfortable or in danger,
                        leave immediately
                        </li>
                      <li>What the difference is between an Escort and a Masseur and make sure you
                        understand that</li>
                   </ul>
                   <p>Never forget:</p>
                   <ul>
                      <li>To always be careful and to stay safe</li>
                      <li>Escorts and Massage Centres can list you in the NUM if you behave inappropriately.</li>
                   </ul>
                </div>
             </div>
          </div>
            <div class="set">
             <a>
               Sexual Health
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Unprotected sex with an Escort is a very stupid idea. If you are still feeling dumb, do not
                     ask for it unless an Escort explicitly offers the service.
                     </p>
                   <p>Do not brush your teeth within 30 minutes of the start of an appointment. Small abrasions
                     on the gums and mouth can increase the risks from Sexually Transmitted Infections
                     (STIs).</p>
                   <p>Shave any genital areas the day before any appointment, small nicks and cuts are
                     common and this is again a risk-factor for STIs.</p>
                   <p>Bring condoms with you just in case and they should be in a sealed, unopened box.
                     Normally, an Escort will provide condoms and expect you to use theirs. If you have any
                     specific requirements or allergies, you might want to clear that in advance.
                     </p>
                   <p>It is important that you maintain your own health. Here are some tips for you:
                  </p>
                  <p>Where to look:</p>
                  <ul>
                     <li>Lift your penis and have a good look around the genital area
                     </li>
                     <li>Lift your balls and pull back your foreskin</li>
                     <li>Gently squeeze along the shaft of your penis to see if a discharge emerges</li>
                     <li>Look between the area of your anus and penis
                     </li>
                     <li>Check around the anal area</li>
                     <li>Check around the anal area</li>
                  </ul>
                  <p>What to look for:</p>
                  <ul>
                     <li>Sores, blisters, rashes, and warts</li>
                     <li>Itching, redness, swollen glands, unpleasant odour</li>
                     <li>Discharge—if it is milky, thick, yellowish, grayish and/or smelly it could be
                        gonorrhoea or chlamydia</li>
                     <li>Crabs—these are brown or white and look like freckles
                     </li>
                    
                  </ul>
                  <p>Remember, STIs frequently cause no signs or symptoms. Using a condom is essential
                     when meeting with an Escort, even when there are no visible signs when you have
                     checked yourself
                  </p>
                </div>
             </div>
          </div>
            <div class="set">
             <a>
               Personal Hygiene
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>You should approach visiting an Escort and a Masseur in the same way you would for
                     going on a date. Here is a list of tips compiled from talking to a number of Escorts and
                     Massage Centres:
                     </p>
                     <ul>
                        <li>Take a shower before the appointment or at the start of the appointment. An Escort
                           will always offer you the opportunity to shower when you arrive. Showering at the
                           appointment will install confidence in the Escort that you are clean</li>
                        <li>When you undress, place your clothes neatly on a chair or couch provided. Don’t just
                           drop them anywhere on the floor, indicating that you are an inconsiderate person</li>
                        <li>Trim your nails and toenails, no-one likes getting scratched</li>
                        <li>Trim or shave any areas you might want licked or kissed by an Escort, as this shows
                           that you might like this to happen. Leaving areas hairy may well act as a signal that
                           you do not expect this
                           </li>
                        <li>Do not use cologne, deodorant or perfume on any area that you might expect to be
                           licked or sucked by the Escort</li>
                        <li>Mouthwash or chewing gum is often appreciated, as is staying away from strongly
                           smelling foods, such as garlic, onions or curry</li>
                        <li>Do not urinate in the shower (apparently this happens a lot and is really not
                           appreciated by many Escorts and Massage Centres who offer this service)
                           </li>
                        <li>if you need to defecate, do it before you get there, leaving a bad smell or worse is not
                           a great way to start or end an appointment. You are visiting what is a place of
                           residence or work (or both), treat it respectfully</li>
                     </ul>
                </div>
             </div>
          </div>
            <div class="set">
             <a>
               Staying Out of Trouble
             <i class="fa fa-angle-down"></i>
             </a>
             <div class="content">
                <div class="accodien_manage_padding_content">
                   <p>Make sure you are aware of the Local Laws regarding escort services wherever you are. 
                     It is important that you understand how the Local Laws are enforced. The oldest
                     profession in the world has survived pretty much every legal attempt to prohibit it, but this
                     does not mean you can not get in trouble for kerb-crawling, for example, in some places.</p>
                   <p>Keep an eye on your wallet, phone and other valuables. Thefts do happen, especially in
                     countries where it is fairly certain that you are not going to be making a police report. It is
                     wise to not bring any valuables with you including your wallet. Carry your donation in your
                     pocket.</p>
                   <p>if you arrive at a place and you are in any way worried about your physical security or see
                     any danger signs, leave immediately.</p>
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